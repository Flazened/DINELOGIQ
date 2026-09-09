<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index()
    {
        // Data order (mock)
        $orders = [
            [
                'id' => 1,
                'time' => '12.45 WIB',
                'table' => 'Table 4',
                'customer' => 'Budi Santoso',
                'items' => 'Shoyu ramen x2, Ocha x1',
                'total' => 110000,
                'status' => 'ongoing'
            ],
            [
                'id' => 2,
                'time' => '13.39 WIB',
                'table' => 'Table 1',
                'customer' => 'Andi Santoso',
                'items' => 'Shoyu ramen x1, Gyoza x1',
                'total' => 75000,
                'status' => 'completed'
            ]
        ];

        return view('admin.order', compact('orders'));
    }

    public function store(Request $request)
    {
        // Nanti simpan ke database
        return redirect()->route('admin.order.index')->with('success', 'Order berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // Nanti update ke database
        return redirect()->route('admin.order.index')->with('success', 'Order berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Nanti hapus dari database
        return redirect()->route('admin.order.index')->with('success', 'Order berhasil dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        // Nanti update status di database
        return redirect()->back()->with('success', 'Status order diperbarui!');
    }

    public function salesReport()
    {
        // Nanti generate laporan dari database
        $report = [
            'total_sales' => 1850000,
            'total_orders' => 15,
            'top_menu' => 'Shoyu Ramen',
            'revenue_today' => 450000
        ];

        return view('admin.reports-sales', compact('report'));
    }
}