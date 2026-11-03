<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->latest()->get();

        return view('admin.order', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.menuItem')->findOrFail($id);

        if (request()->expectsJson()) {
            return response()->json($order);
        }

        return view('admin.order', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,ongoing',
        ]);

        $order = Order::findOrFail($id);

        // Map status 'ongoing' jika dari frontend admin ke 'processing'
        $status = $validated['status'];
        if ($status === 'ongoing') {
            $status = 'processing';
        }

        $order->status = $status;
        $order->save();

        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Status pesanan berhasil diperbarui!',
                'status' => $order->status,
            ]);
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.order')->with('success', 'Pesanan berhasil dihapus!');
    }

    public function salesReport()
    {
        $totalSales = Order::where('status', 'completed')->sum('total_amount');
        $totalOrders = Order::count();
        $revenueToday = Order::where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total_amount');

        $topItem = OrderItem::select('menu_item_name', \DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('menu_item_name')
            ->orderByDesc('total_qty')
            ->first();

        $report = [
            'total_sales' => $totalSales,
            'total_orders' => $totalOrders,
            'top_menu' => $topItem ? $topItem->menu_item_name : 'Belum ada data',
            'revenue_today' => $revenueToday,
        ];

        return response()->json($report);
    }
}
