<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Appetizer',
                'slug' => 'appetizer',
                'label' => 'APPETIZERS - GOURMET BITES',
                'icon' => 'Menu-1.png',
                'sort_order' => 1,
                'items' => [
                    [
                        'name' => 'Edamame',
                        'price' => 12650,
                        'image' => 'Edamame.png',
                        'description' => 'Fresh steamed green soybeans lightly seasoned with natural sea salt.',
                    ],
                ],
            ],
            [
                'name' => 'Main Course',
                'slug' => 'main-course',
                'label' => "MAIN COURSE - CHEF'S SIGNATURE",
                'icon' => 'Menu-2.png',
                'sort_order' => 2,
                'items' => [
                    [
                        'name' => 'Shoyu ramen',
                        'price' => 55000,
                        'image' => 'ShoyuRamen.png',
                        'description' => 'Clear, soy-sauce-based broth and balanced, savory flavor with fresh noodles and toppings.',
                    ],
                    [
                        'name' => 'Hokkaido Ramen',
                        'price' => 57000,
                        'image' => 'HokkaidoRamen.png',
                        'description' => 'Signature rich, savory broth recipe from Hokkaido served with tender braised pork and spring onions.',
                    ],
                ],
            ],
            [
                'name' => 'Side Dish',
                'slug' => 'side-dish',
                'label' => "SIDE DISH - PERFECT PAIRING'S",
                'icon' => 'Menu-3.png',
                'sort_order' => 3,
                'items' => [
                    [
                        'name' => 'Miso soup',
                        'price' => 15000,
                        'image' => 'MisoSoup.png',
                        'description' => 'Traditional comforting Japanese dashi soup mixed with fermented soybean paste, silken tofu, and wakame.',
                    ],
                ],
            ],
            [
                'name' => 'Dessert',
                'slug' => 'dessert',
                'label' => 'DESSERT - DIVINE ENDINGS',
                'icon' => 'Menu-4.png',
                'sort_order' => 4,
                'items' => [
                    [
                        'name' => 'Kakigori',
                        'price' => 20000,
                        'image' => 'KakiGori.png',
                        'description' => 'Fluffy, fine shaved ice dessert infused with sweet flavored syrup and condensed milk.',
                    ],
                ],
            ],
            [
                'name' => 'Hot drinks',
                'slug' => 'hot-drinks',
                'label' => 'HOT DRINKS - WARMING INFUSIONS',
                'icon' => 'Menu-5.png',
                'sort_order' => 5,
                'items' => [
                    [
                        'name' => 'Hot ocha',
                        'price' => 8000,
                        'image' => 'HotOcha.png',
                        'description' => 'Freshly brewed warm Japanese green tea, aromatic and palate-cleansing.',
                    ],
                ],
            ],
            [
                'name' => 'Cold Drinks',
                'slug' => 'cold-drinks',
                'label' => 'COLD DRINKS - CHILLED ELIXIRS',
                'icon' => 'Menu-6.png',
                'sort_order' => 6,
                'items' => [
                    [
                        'name' => 'Genmaicha',
                        'price' => 10000,
                        'image' => 'Genmaicha.png',
                        'description' => 'Chilled premium green tea combined with aromatic roasted brown rice grains.',
                    ],
                ],
            ],
        ];

        foreach ($categories as $catData) {
            $items = $catData['items'];
            unset($catData['items']);

            $category = Category::updateOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );

            foreach ($items as $itemData) {
                MenuItem::updateOrCreate(
                    ['slug' => Str::slug($itemData['name'])],
                    [
                        'category_id' => $category->id,
                        'name' => $itemData['name'],
                        'price' => $itemData['price'],
                        'image' => $itemData['image'],
                        'description' => $itemData['description'] ?? null,
                        'status' => 'available',
                    ]
                );
            }
        }
    }
}
