<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('id');
        $menuItem = $id 
            ? MenuItem::with('category')->find($id) 
            : MenuItem::where('name', 'like', '%Shoyu%')->first();

        if (!$menuItem) {
            $menuItem = MenuItem::first();
        }

        $customization = $this->getCustomizationOptions($menuItem);

        return view('landing.detail', compact('menuItem', 'customization'));
    }

    /**
     * Mendapatkan opsi kustomisasi dan add-ons yang relevan sesuai kategori kuliner
     */
    public function getCustomizationOptions($menuItem)
    {
        $categoryName = strtolower($menuItem->category->name ?? '');

        // 1. Minuman Dingin (Cold Drinks)
        if (str_contains($categoryName, 'cold')) {
            return [
                'type' => 'beverage_cold',
                'title' => 'Kustomisasi Minuman Dingin',
                'description' => 'Pilih tingkat kemanisan, es batu, dan topping segar yang pas untuk minuman Anda',
                'has_size' => true,
                'sizes' => [
                    ['code' => 'R', 'label' => 'Regular', 'extra_price' => 0],
                    ['code' => 'L', 'label' => 'Large (+Rp 4.000)', 'extra_price' => 4000],
                ],
                'sweetness' => ['Normal Sweet (100%)', 'Less Sweet (50%)', 'No Sugar (0%)'],
                'ice' => ['Normal Ice', 'Less Ice', 'No Ice'],
                'addons' => [
                    ['id' => 'honey', 'name' => 'Madu Murni (Pure Honey)', 'price' => 3000, 'icon' => '🍯'],
                    ['id' => 'lemon', 'name' => 'Irisan Lemon Segar', 'price' => 2000, 'icon' => '🍋'],
                    ['id' => 'grass_jelly', 'name' => 'Cincau Hitam Lembut', 'price' => 3000, 'icon' => '🧋'],
                    ['id' => 'chia_seed', 'name' => 'Biji Chia Organik', 'price' => 2000, 'icon' => '🌱'],
                ],
            ];
        }

        // 2. Minuman Hangat (Hot drinks)
        if (str_contains($categoryName, 'hot') || str_contains($categoryName, 'drink')) {
            return [
                'type' => 'beverage_hot',
                'title' => 'Kustomisasi Minuman Hangat',
                'description' => 'Sesuaikan rasa hangat minuman teh autentik Jepang Anda',
                'has_size' => true,
                'sizes' => [
                    ['code' => 'R', 'label' => 'Regular Cangkir', 'extra_price' => 0],
                    ['code' => 'L', 'label' => 'Pot / Teko (+Rp 5.000)', 'extra_price' => 5000],
                ],
                'sweetness' => ['Tanpa Gula (Original)', 'Gula Terpisah', 'Sedikit Manis'],
                'addons' => [
                    ['id' => 'honey', 'name' => 'Madu Murni (Pure Honey)', 'price' => 3000, 'icon' => '🍯'],
                    ['id' => 'lemon', 'name' => 'Irisan Lemon Segar', 'price' => 2000, 'icon' => '🍋'],
                    ['id' => 'ginger', 'name' => 'Sari Jahe Hangat', 'price' => 2000, 'icon' => '🫚'],
                ],
            ];
        }

        // 3. Dessert (Kakigori dll)
        if (str_contains($categoryName, 'dessert')) {
            return [
                'type' => 'dessert',
                'title' => 'Topping Manis Populer',
                'description' => 'Tambahkan kelezatan ekstra pada dessert dingin Anda',
                'has_size' => false,
                'addons' => [
                    ['id' => 'condensed_milk', 'name' => 'Extra Susu Kental Manis', 'price' => 2000, 'icon' => '🥛'],
                    ['id' => 'red_bean', 'name' => 'Ogura Sweet Red Bean', 'price' => 4000, 'icon' => '🫘'],
                    ['id' => 'mochi', 'name' => 'Mochi Chewy Bites (3 pcs)', 'price' => 4000, 'icon' => '🍡'],
                    ['id' => 'matcha_sauce', 'name' => 'Saus Matcha Kental', 'price' => 3000, 'icon' => '🍵'],
                ],
            ];
        }

        // 4. Appetizer (Edamame dll)
        if (str_contains($categoryName, 'appetizer')) {
            return [
                'type' => 'appetizer',
                'title' => 'Pilihan Bumbu & Seasoning',
                'description' => 'Pilih bumbu tabur favorit untuk camilan pembuka Anda',
                'has_size' => true,
                'sizes' => [
                    ['code' => 'R', 'label' => 'Porsi Standar', 'extra_price' => 0],
                    ['code' => 'L', 'label' => 'Porsi Sharing (+Rp 7.000)', 'extra_price' => 7000],
                ],
                'seasonings' => ['Original Sea Salt (Garam Laut)', 'Spicy Chili Togarashi', 'Garlic Butter Glaze'],
                'addons' => [
                    ['id' => 'garlic_chips', 'name' => 'Bawang Putih Goreng Gurih', 'price' => 3000, 'icon' => '🧄'],
                    ['id' => 'spicy_mayo', 'name' => 'Saus Mayo Pedas Jepang', 'price' => 3000, 'icon' => '🌶️'],
                ],
            ];
        }

        // 5. Side Dish (Miso soup dll)
        if (str_contains($categoryName, 'side')) {
            return [
                'type' => 'side_dish',
                'title' => 'Isian & Topping Sup',
                'description' => 'Lengkapi kehangatan sup dengan isian ekstra segar',
                'has_size' => false,
                'addons' => [
                    ['id' => 'silken_tofu', 'name' => 'Extra Tahu Sutra Lembut', 'price' => 3000, 'icon' => '🧊'],
                    ['id' => 'wakame', 'name' => 'Rumput Laut Wakame', 'price' => 2000, 'icon' => '🌿'],
                    ['id' => 'green_onion', 'name' => 'Daun Bawang Segar', 'price' => 2000, 'image' => 'Detail-2.png'],
                ],
            ];
        }

        // 6. Default: Main Course (Ramen & Makanan Berat Gurih)
        return [
            'type' => 'ramen',
            'title' => 'Topping & Add-ons Ramen Populer',
            'description' => 'Perkaya mangkuk ramen Anda dengan topping autentik pilihan chef',
            'has_size' => true,
            'sizes' => [
                ['code' => 'S', 'label' => 'Small (-Rp 5.000)', 'extra_price' => -5000],
                ['code' => 'M', 'label' => 'Medium (Reguler)', 'extra_price' => 0],
                ['code' => 'L', 'label' => 'Large (+Rp 8.000)', 'extra_price' => 8000],
            ],
            'spiciness' => ['Level 0 (Original Gurih)', 'Level 1 (Pedas Santai)', 'Level 2 (Pedas Mantap)', 'Level 3 (Extra Pedas)'],
            'addons' => [
                ['id' => 'sweetcorn', 'name' => 'Sweetcorn Manis', 'price' => 2000, 'image' => 'Detail-1.png'],
                ['id' => 'green_onion', 'name' => 'Green Onion Iris', 'price' => 2000, 'image' => 'Detail-2.png'],
                ['id' => 'uzumaki', 'name' => 'Naruto Maki (Uzumaki)', 'price' => 5000, 'image' => 'Detail-3.png'],
                ['id' => 'ramen_egg', 'name' => 'Ajitsuke Tamago (Telur Ramen)', 'price' => 6000, 'icon' => '🥚'],
                ['id' => 'nori_sheets', 'name' => 'Nori Rumput Laut Krispi', 'price' => 3000, 'icon' => '🍙'],
            ],
        ];
    }
}
