<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Tampilkan halaman keranjang
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $items = [];
        $total = 0;

        // Mock data menu (sementara)
        $mockMenus = [
            1 => ['name' => 'Edamame', 'price' => 12650],
            2 => ['name' => 'Shoyu Ramen', 'price' => 55000],
            3 => ['name' => 'Miso Soup', 'price' => 15000],
            4 => ['name' => 'Kakigori', 'price' => 20000],
            5 => ['name' => 'Hot Ocha', 'price' => 8000],
            6 => ['name' => 'Genmaicha', 'price' => 10000],
        ];

        foreach ($cart as $id => $details) {
            if (isset($mockMenus[$id])) {
                $subtotal = $mockMenus[$id]['price'] * $details['quantity'];
                $items[] = [
                    'id' => $id,
                    'name' => $mockMenus[$id]['name'],
                    'price' => $mockMenus[$id]['price'],
                    'quantity' => $details['quantity'],
                    'subtotal' => $subtotal,
                    'notes' => $details['notes'] ?? ''
                ];
                $total += $subtotal;
            }
        }

        return view('landing.cart', compact('items', 'total'));
    }

    /**
     * Tambah item ke keranjang
     */
    public function add(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->menu_id])) {
            $cart[$request->menu_id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->menu_id] = [
                'quantity' => $request->quantity,
                'notes' => $request->notes ?? ''
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Menu ditambahkan ke keranjang!');
    }

    /**
     * Update quantity item di keranjang
     */
    public function update(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->menu_id])) {
            $cart[$request->menu_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui!');
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

        return redirect()->route('cart.index')->with('success', 'Item dihapus!');
    }

    /**
     * Kosongkan keranjang
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan!');
    }
}