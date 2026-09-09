<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Data statistik (mock)
        $stats = [
            'total_menu' => 20,
            'total_order' => 8,
            'total_revenue' => 1250000,
            'total_customer' => 45
        ];

        return view('admin.dashboard', compact('stats'));
    }
}