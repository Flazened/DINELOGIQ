<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Proses checkout (simpan ke session dulu, nanti ke database)
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'table_number' => 'required|integer|min:1|max:99',
            'payment_method' => 'required|in:cash,qris',
            'notes' => 'nullable|string|max:500'
        ]);

        // 2. Ambil data dari session (keranjang)
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu')->with('error', 'Keranjang kosong!');
        }

        // 3. Hitung total & siapkan data items
        $total = 0;
        $itemsData = [];

        $mockMenus = [
            1 => ['name' => 'Edamame', 'price' => 12650],
            2 => ['name' => 'Shoyu Ramen', 'price' => 55000],
            3 => ['name' => 'Miso Soup', 'price' => 15000],
            4 => ['name' => 'Kakigori', 'price' => 20000],
            5 => ['name' => 'Hot Ocha', 'price' => 8000],
            6 => ['name' => 'Genmaicha', 'price' => 10000],
        ];

        foreach ($cart as $menuId => $details) {
            if (isset($mockMenus[$menuId])) {
                $subtotal = $mockMenus[$menuId]['price'] * $details['quantity'];
                $total += $subtotal;
                $itemsData[] = [
                    'menu_id' => $menuId,
                    'name' => $mockMenus[$menuId]['name'],
                    'quantity' => $details['quantity'],
                    'price' => $mockMenus[$menuId]['price'],
                    'subtotal' => $subtotal,
                    'notes' => $details['notes'] ?? ''
                ];
            }
        }

        // 4. Generate nomor order unik
        $orderNumber = 'ORD-' . date('Ymd') . '-' . Str::upper(Str::random(6));

        // 5. Simpan ke session dulu (nanti pindah ke database)
        $order = [
            'order_number' => $orderNumber,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'table_number' => $request->table_number,
            'items' => $itemsData,
            'total_amount' => $total,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'notes' => $request->notes ?? '',
            'created_at' => now()->toDateTimeString()
        ];

        $orders = session()->get('orders', []);
        $orders[] = $order;
        session()->put('orders', $orders);

        // 6. Kosongkan keranjang
        session()->forget('cart');

        // 7. Redirect ke halaman sukses
        return redirect()->route('order.success', ['id' => count($orders) - 1])
                         ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Halaman sukses pesanan
     */
    public function success($id)
    {
        $orders = session()->get('orders', []);
        $order = $orders[$id] ?? null;

        if (!$order) {
            abort(404, 'Pesanan tidak ditemukan');
        }

        return view('landing.order-success', compact('order'));
    }

    /**
     * Tracking pesanan
     */
    public function track(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string'
        ]);

        $orders = session()->get('orders', []);
        $order = null;

        foreach ($orders as $o) {
            if ($o['order_number'] === $request->order_number) {
                $order = $o;
                break;
            }
        }

        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan!');
        }

        return view('landing.order-track', compact('order'));
    }

    /**
     * Riwayat pesanan
     */
    public function history()
    {
        $orders = session()->get('orders', []);
        $orders = array_reverse($orders); // Terbaru di atas

        return view('landing.order-history', compact('orders'));
    }
}