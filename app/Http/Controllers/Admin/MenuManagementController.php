<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuManagementController extends Controller
{
    public function index()
    {
        $menus = MenuItem::with('category')->latest()->get();
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.menu', compact('menus', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.menu', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'status' => 'required|in:available,unavailable',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        // Cari atau buat kategori jika diinput string
        $category = Category::where('name', $validated['category'])
            ->orWhere('id', $validated['category'])
            ->first();

        if (!$category) {
            $category = Category::create([
                'name' => $validated['category'],
                'slug' => Str::slug($validated['category']),
            ]);
        }

        MenuItem::create([
            'category_id' => $category->id,
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . rand(100, 999),
            'price' => (int) $validated['price'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? 'ShoyuRamen.png',
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = MenuItem::with('category')->findOrFail($id);
        $categories = Category::orderBy('sort_order')->get();

        return response()->json([
            'menu' => $menu,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $menu = MenuItem::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'status' => 'required|in:available,unavailable',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $category = Category::where('name', $validated['category'])
            ->orWhere('id', $validated['category'])
            ->first();

        if ($category) {
            $menu->category_id = $category->id;
        }

        $menu->name = $validated['name'];
        $menu->price = (int) $validated['price'];
        $menu->status = $validated['status'];
        if (isset($validated['description'])) {
            $menu->description = $validated['description'];
        }
        if (isset($validated['image']) && !empty($validated['image'])) {
            $menu->image = $validated['image'];
        }
        $menu->save();

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = MenuItem::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menu')->with('success', 'Menu berhasil dihapus!');
    }

    public function toggleActive($id)
    {
        $menu = MenuItem::findOrFail($id);
        $menu->status = $menu->status === 'available' ? 'unavailable' : 'available';
        $menu->save();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'status' => $menu->status,
                'message' => 'Status menu berhasil diubah!',
            ]);
        }

        return redirect()->back()->with('success', 'Status menu berhasil diubah!');
    }
}
