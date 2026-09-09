<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data combo (hardcode dulu)
        $combos = [
            [
                'name' => 'COMBO 1',
                'description' => 'Japanese Shoyu Ramen and Creamy Matcha',
                'price' => 64000,
                'original_price' => 75000,
                'image' => 'HomeCombo1.png'
            ],
            [
                'name' => 'COMBO 2',
                'description' => 'Japanese Shoyu Ramen and Creamy Matcha',
                'price' => 64000,
                'original_price' => 75000,
                'image' => 'HomeCombo2.png'
            ],
            [
                'name' => 'COMBO 3',
                'description' => 'Japanese Shoyu Ramen and Creamy Matcha',
                'price' => 64000,
                'original_price' => 75000,
                'image' => 'HomeCombo3.png'
            ],
            [
                'name' => 'COMBO 4',
                'description' => 'Japanese Shoyu Ramen and Creamy Matcha',
                'price' => 64000,
                'original_price' => 75000,
                'image' => 'HomeCombo4.png'
            ]
        ];

        // Data team
        $team = [
            ['name' => 'Felix Yonathan', 'role' => 'UI/UX Designer'],
            ['name' => 'Michael Yusliardy', 'role' => 'Full Stack Developer'],
            ['name' => 'Nicholas Jonathan', 'role' => 'UI/UX Designer'],
            ['name' => 'Devon Austin.V', 'role' => 'UI/UX Designer']
        ];

        return view('landing.home', compact('combos', 'team'));
    }
}