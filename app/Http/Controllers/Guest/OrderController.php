<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Proses checkout dan simpan pesanan ke database
     */
    public function store(Request $request)
    {
        // 1. Sanitasi dan normalisasi input nama & telepon jika berasal dari form modal (first_name + last_name)
        if (!$request->has('customer_name') && ($request->has('firstName') || $request->has('first_name'))) {
            $firstName = $request->input('firstName', $request->input('first_name', ''));
            $lastName = $request->input('lastName', $request->input('last_name', ''));
            $request->merge([
                'customer_name' => trim($firstName . ' ' . $lastName),
            ]);
        }

        if (!$request->has('customer_phone') && ($request->has('phoneNumber') || $request->has('phone_number'))) {
            $request->merge([
                'customer_phone' => $request->input('phoneNumber', $request->input('phone_number')),
            ]);
        }

        if (!$request->has('payment_method') && $request->has('payment')) {
            $request->merge([
                'payment_method' => $request->input('payment'),
            ]);
        }

        // 2. Validasi data pesanan
        $validated = $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:30',
            'table_number' => 'nullable|integer|min:1|max:99',
            'payment_method' => 'required|string|max:30',
            'notes' => 'nullable|string|max:500',
        ]);

        $tableNumber = $validated['table_number'] ?? 1;

        // 3. Validasi isi keranjang dari session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Keranjang belanja Anda masih kosong!');
        }

        // 4. Proses penyimpanan atomik ke database dengan harga snapshot
        $order = DB::transaction(function () use ($validated, $tableNumber, $cart) {
            $menuIds = array_keys($cart);
            $menuItems = MenuItem::whereIn('id', $menuIds)->get()->keyBy('id');

            $totalAmount = 0;
            $itemsToCreate = [];

            foreach ($cart as $id => $details) {
                if (isset($menuItems[$id])) {
                    $menu = $menuItems[$id];
                    $qty = is_array($details) ? ($details['quantity'] ?? 1) : (int) $details;
                    $itemNotes = is_array($details) ? ($details['notes'] ?? '') : '';
                    $itemPrice = (int) $menu->price; // Snapshot harga asli dari DB
                    $itemSubtotal = $itemPrice * $qty;

                    $totalAmount += $itemSubtotal;

                    $itemsToCreate[] = [
                        'menu_item_id' => $menu->id,
                        'menu_item_name' => $menu->name,
                        'menu_item_price' => $itemPrice,
                        'quantity' => $qty,
                        'subtotal' => $itemSubtotal,
                        'notes' => $itemNotes,
                    ];
                }
            }

            if (empty($itemsToCreate)) {
                throw new \Exception('Item yang dipilih tidak ditemukan dalam katalog menu kami.');
            }

            // Generate nomor pesanan unik
            $orderNumber = 'ORD-' . date('Ymd') . '-' . Str::upper(Str::random(6));

            // Buat record order utama
            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'table_number' => $tableNumber,
                'payment_method' => $validated['payment_method'],
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
                'session_id' => session()->getId(),
            ]);

            // Buat record order items
            foreach ($itemsToCreate as $itemData) {
                $order->items()->create($itemData);
            }

            return $order;
        });

        // 5. Kosongkan keranjang belanja
        session()->forget('cart');

        return redirect()->route('order.success', ['id' => $order->id])
            ->with('success', 'Pesanan Anda berhasil dibuat!');
    }

    /**
     * Halaman konfirmasi dan sukses pesanan
     */
    public function success($id)
    {
        $order = Order::with('items.menuItem')->findOrFail($id);

        return view('landing.order-success', compact('order'));
    }

    /**
     * Lacak pesanan berdasarkan order_number
     */
    public function track(Request $request)
    {
        $orderNumber = $request->query('order_number') ?? $request->input('order_number');

        $order = null;
        if ($orderNumber) {
            $order = Order::with('items')->where('order_number', trim($orderNumber))->first();
            if (!$order) {
                return redirect()->back()->with('error', 'Pesanan dengan nomor tersebut tidak ditemukan!');
            }
        }

        return view('landing.order-track', compact('order', 'orderNumber'));
    }

    /**
     * Riwayat pesanan untuk sesi pengguna saat ini
     */
    public function history()
    {
        $sessionId = session()->getId();
        $orders = Order::with('items')
            ->where('session_id', $sessionId)
            ->latest()
            ->get();

        return view('landing.order-history', compact('orders'));
    }
}
