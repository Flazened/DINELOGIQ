<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Data menu lengkap
        $menus = [
            'Appetizer' => [
                ['name' => 'Edamame', 'image' => 'Edamame.png', 'price' => 12650]
            ],
            'Main Course' => [
                ['name' => 'Shoyu ramen', 'image' => 'ShoyuRamen.png', 'price' => 55000]
            ],
            'Side Dish' => [
                ['name' => 'Miso soup', 'image' => 'MisoSoup.png', 'price' => 15000]
            ],
            'Dessert' => [
                ['name' => 'Kakigori', 'image' => 'KakiGori.png', 'price' => 20000]
            ],
            'Hot drinks' => [
                ['name' => 'Hot ocha', 'image' => 'HotOcha.png', 'price' => 8000]
            ],
            'Cold Drinks' => [
                ['name' => 'Genmaicha', 'image' => 'Genmaicha.png', 'price' => 10000]
            ]
        ];

        // Category labels
        $categoryLabels = [
            'Appetizer' => 'APPETIZERS - GOURMET BITES',
            'Main Course' => 'MAIN COURSE - CHEF\'S SIGNATURE',
            'Side Dish' => 'SIDE DISH - PERFECT PAIRING\'S',
            'Dessert' => 'DESSERT - DIVINE ENDINGS',
            'Hot drinks' => 'HOT DRINKS - WARMING INFUSIONS',
            'Cold Drinks' => 'COLD DRINKS - CHILLED ELIXIRS'
        ];

        // Category icons (untuk filter)
        $categories = [
            ['name' => 'Appetizer', 'icon' => 'Menu-1.png'],
            ['name' => 'Main Course', 'icon' => 'Menu-2.png'],
            ['name' => 'Side Dish', 'icon' => 'Menu-3.png'],
            ['name' => 'Dessert', 'icon' => 'Menu-4.png'],
            ['name' => 'Hot drinks', 'icon' => 'Menu-5.png'],
            ['name' => 'Cold Drinks', 'icon' => 'Menu-6.png']
        ];

        // Cart count
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return view('landing.menu', compact('menus', 'categoryLabels', 'categories', 'cartCount'));
    }

    public function show($id)
    {
        // Untuk detail menu (nanti)
    }
}