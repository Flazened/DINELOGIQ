<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $dbCategories = Category::with(['menuItems' => function ($query) {
            $query->available();
        }])->orderBy('sort_order')->get();

        $menus = [];
        $categoryLabels = [];
        $categories = [];

        foreach ($dbCategories as $cat) {
            $menus[$cat->name] = $cat->menuItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'image' => $item->image,
                    'price' => $item->price,
                    'description' => $item->description,
                ];
            })->toArray();

            $categoryLabels[$cat->name] = $cat->label ?? strtoupper($cat->name);
            $categories[] = [
                'name' => $cat->name,
                'icon' => $cat->icon ?? 'Menu-1.png',
            ];
        }

        // Cart count from session
        $cart = session()->get('cart', []);
        $cartCount = 0;
        foreach ($cart as $item) {
            $cartCount += is_array($item) ? ($item['quantity'] ?? 1) : (int) $item;
        }

        return view('landing.menu', compact('menus', 'categoryLabels', 'categories', 'cartCount'));
    }

    public function show($id)
    {
        $menuItem = MenuItem::with('category')->findOrFail($id);
        $detailController = new DetailController();
        $customization = $detailController->getCustomizationOptions($menuItem);

        return view('landing.detail', compact('menuItem', 'customization'));
    }
}
