<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuManagementController extends Controller
{
    public function index()
    {
        // Data menu (mock)
        $menus = [
            ['id' => 1, 'name' => 'Edamame', 'price' => 12650, 'category' => 'Appetizer', 'status' => 'unavailable'],
            ['id' => 2, 'name' => 'Shoyu Ramen', 'price' => 55000, 'category' => 'Main dish', 'status' => 'available'],
            ['id' => 3, 'name' => 'Miso Soup', 'price' => 15000, 'category' => 'Side dish', 'status' => 'available'],
            ['id' => 4, 'name' => 'Kakigori', 'price' => 20000, 'category' => 'Dessert', 'status' => 'available'],
            ['id' => 5, 'name' => 'Hot Ocha', 'price' => 8000, 'category' => 'Hot drinks', 'status' => 'available'],
            ['id' => 6, 'name' => 'Genmaicha', 'price' => 10000, 'category' => 'Cold drinks', 'status' => 'available'],
        ];

        return view('admin.menu', compact('menus'));
    }

    public function create()
    {
        $categories = ['Appetizer', 'Main dish', 'Side dish', 'Dessert', 'Hot drinks', 'Cold drinks'];
        return view('admin.menu-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'status' => 'required|in:available,unavailable'
        ]);

        // Nanti simpan ke database
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Data menu (mock)
        $menu = ['id' => $id, 'name' => 'Edamame', 'price' => 12650, 'category' => 'Appetizer', 'status' => 'unavailable'];
        $categories = ['Appetizer', 'Main dish', 'Side dish', 'Dessert', 'Hot drinks', 'Cold drinks'];

        return view('admin.menu-edit', compact('menu', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'status' => 'required|in:available,unavailable'
        ]);

        // Nanti update ke database
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Nanti hapus dari database
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }

    public function toggleActive($id)
    {
        // Nanti toggle status di database
        return redirect()->back()->with('success', 'Status menu diperbarui!');
    }
}