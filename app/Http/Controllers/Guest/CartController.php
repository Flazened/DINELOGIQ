<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Tampilkan halaman keranjang belanja
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = [];
        $subtotal = 0;

        if (!empty($cart)) {
            $menuIds = array_keys($cart);
            $menuItems = MenuItem::whereIn('id', $menuIds)->get()->keyBy('id');

            foreach ($cart as $id => $details) {
                if (isset($menuItems[$id])) {
                    $menu = $menuItems[$id];
                    $qty = is_array($details) ? ($details['quantity'] ?? 1) : (int) $details;
                    $notes = is_array($details) ? ($details['notes'] ?? '') : '';
                    $itemSubtotal = $menu->price * $qty;

                    $items[] = [
                        'id' => $menu->id,
                        'name' => $menu->name,
                        'price' => $menu->price,
                        'image' => $menu->image ?? 'HokkaidoRamen.png',
                        'quantity' => $qty,
                        'subtotal' => $itemSubtotal,
                        'notes' => $notes,
                    ];

                    $subtotal += $itemSubtotal;
                }
            }
        }

        // Biaya pengiriman dan pajak opsional
        $deliveryFee = 0;
        $taxFee = 0;
        $total = $subtotal + $deliveryFee + $taxFee;

        // Ambil riwayat pesanan sesi saat ini untuk ditampilkan di cart
        $sessionId = session()->getId();
        $recentOrders = Order::with('items.menuItem')
            ->where('session_id', $sessionId)
            ->latest()
            ->take(5)
            ->get();

        return view('landing.cart', compact('items', 'subtotal', 'deliveryFee', 'taxFee', 'total', 'recentOrders'));
    }

    /**
     * Tambah item ke keranjang
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:255',
        ]);

        $menuId = (int) $validated['menu_id'];
        $quantity = (int) $validated['quantity'];
        $notes = $validated['notes'] ?? '';

        $cart = session()->get('cart', []);

        if (isset($cart[$menuId])) {
            $currentQty = is_array($cart[$menuId]) ? $cart[$menuId]['quantity'] : (int) $cart[$menuId];
            $cart[$menuId] = [
                'quantity' => $currentQty + $quantity,
                'notes' => $notes ?: (is_array($cart[$menuId]) ? ($cart[$menuId]['notes'] ?? '') : ''),
            ];
        } else {
            $cart[$menuId] = [
                'quantity' => $quantity,
                'notes' => $notes,
            ];
        }

        session()->put('cart', $cart);

        if ($request->expectsJson() || $request->wantsJson()) {
            $totalCount = array_sum(array_column($cart, 'quantity'));
            return response()->json([
                'success' => true,
                'message' => 'Menu berhasil ditambahkan ke keranjang!',
                'cartCount' => $totalCount,
            ]);
        }

        return redirect()->route('cart')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update kuantitas item di keranjang
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $menuId = (int) $validated['menu_id'];
        $quantity = (int) $validated['quantity'];

        $cart = session()->get('cart', []);

        if ($quantity <= 0) {
            unset($cart[$menuId]);
        } else {
            $currentNotes = isset($cart[$menuId]) && is_array($cart[$menuId]) ? ($cart[$menuId]['notes'] ?? '') : '';
            $cart[$menuId] = [
                'quantity' => $quantity,
                'notes' => $currentNotes,
            ];
        }

        session()->put('cart', $cart);

        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Keranjang diperbarui!']);
        }

        return redirect()->route('cart')->with('success', 'Keranjang berhasil diperbarui!');
    }

    /**
     * Hapus item dari keranjang
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Item berhasil dihapus dari keranjang!');
    }

    /**
     * Kosongkan keranjang
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart')->with('success', 'Keranjang berhasil dikosongkan!');
    }
}
