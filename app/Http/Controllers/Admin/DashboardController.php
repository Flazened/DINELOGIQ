<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_menu' => MenuItem::count(),
            'total_order' => Order::whereIn('status', ['pending', 'processing'])->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
            'total_customer' => Order::distinct('customer_phone')->count('customer_phone'),
        ];

        $recentOrders = Order::with('items')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
