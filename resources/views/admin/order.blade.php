<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management - Admin DINELOGIQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        body { font-family: 'Lato', sans-serif; background-color: #EDEDED; }
        .title-font { font-family: 'Cinzel', serif; }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-[#201B1B] text-white flex flex-col justify-between shadow-xl z-50 p-6">
        <div>
            <!-- LOGO -->
            <div class="py-6 text-center border-b border-white/10 mb-8">
                <img src="{{ asset('img/Logo/Logo-Pure.png') }}" alt="Dinelogiq Logo" class="w-24 mx-auto mb-2 drop-shadow-md">
                <h1 class="title-font text-2xl font-bold tracking-widest text-[#FFF1C7]">ADMIN</h1>
            </div>
            
            <!-- NAV MENU -->
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl hover:bg-white/5 text-gray-300 shadow-md transition">
                    <i class="fa-solid fa-chart-line text-xl w-6"></i>
                    <span class="text-lg">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.menu') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl hover:bg-white/5 text-gray-300 hover:text-white transition group">
                    <i class="fa-solid fa-utensils text-xl w-6 group-hover:scale-105 transition"></i>
                    <span class="text-lg">Manage Menu</span>
                </a>

                <a href="{{ route('admin.order') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl bg-[#7F0017] text-white font-bold transition group">
                    <i class="fa-solid fa-clipboard-list text-xl w-6 group-hover:scale-105 transition"></i>
                    <span class="text-lg">Manage Order</span>
                </a>

                <a href="{{ route('home') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl hover:bg-white/5 text-gray-300 hover:text-white transition group mt-8">
                    <i class="fa-solid fa-house text-xl w-6 group-hover:scale-105 transition"></i>
                    <span class="text-lg">View Website</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col overflow-hidden bg-[#EDEDED]">
        
        <!-- HEADER -->
        <header class="h-24 bg-white border-b border-gray-200 px-10 flex justify-between items-center shadow-sm">
            <div class="flex flex-col">
                <h2 class="title-font text-3xl font-bold text-[#7F0017]">Order Management</h2>
                <p class="text-sm text-gray-400 font-medium">Pantau pesanan pelanggan secara real-time</p>
            </div>

            <!-- USER BADGE -->
            <div class="flex items-center gap-4 bg-[#D9D9D9] px-6 py-2 rounded-full">
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-900 leading-tight">Admin Dinelogiq</p>
                    <p class="text-[11px] font-bold text-[#7F0017]">Super Admin</p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-[#F4C430] flex items-center justify-center bg-white text-[#F4C430]">
                    <i class="fa-solid fa-circle-user text-3xl"></i>
                </div>
            </div>
        </header>

        <!-- TABLE CONTENT AREA -->
        <div class="flex-1 overflow-y-auto p-10">
            
            @if(session('success'))
                <div class="p-4 mb-6 bg-emerald-600 text-white font-bold rounded-2xl shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-t-2xl rounded-b-2xl shadow-sm border border-gray-300 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#7F0017] text-white">
                        <tr>
                            <th class="px-4 py-4 title-font tracking-wider text-xs font-bold text-center w-16">Id</th>
                            <th class="px-4 py-4 title-font tracking-wider text-xs font-bold text-center">Order No</th>
                            <th class="px-4 py-4 title-font tracking-wider text-xs font-bold text-center">Time</th>
                            <th class="px-4 py-4 title-font tracking-wider text-xs font-bold text-center">Table</th>
                            <th class="px-4 py-4 title-font tracking-wider text-xs font-bold">Customer</th>
                            <th class="px-4 py-4 title-font tracking-wider text-xs font-bold">Item Pesanan</th>
                            <th class="px-4 py-4 title-font tracking-wider text-xs font-bold text-center">Total</th>
                            <th class="px-4 py-4 title-font tracking-wider text-xs font-bold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-xs font-semibold text-gray-700">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="px-4 py-5 text-center font-bold text-gray-900 border-r border-gray-200">{{ $order->id }}</td>
                                <td class="px-4 py-5 text-center font-black text-[#7F0017] border-r border-gray-200">
                                    {{ $order->order_number }}
                                </td>
                                <td class="px-4 py-5 text-center text-gray-500 border-r border-gray-200">
                                    {{ $order->created_at->format('H:i') }} WIB
                                </td>
                                <td class="px-4 py-5 text-center font-bold text-gray-800 border-r border-gray-200">
                                    Meja {{ $order->table_number }}
                                </td>
                                <td class="px-4 py-5 text-gray-900 font-bold border-r border-gray-200">
                                    {{ $order->customer_name }}
                                    <span class="block text-[10px] text-gray-400 font-normal">{{ $order->customer_phone }}</span>
                                </td>
                                <td class="px-4 py-5 text-gray-600 border-r border-gray-200 max-w-xs">
                                    {{ $order->items->map(fn($i) => $i->menu_item_name . ' ×' . $i->quantity)->join(', ') }}
                                </td>
                                <td class="px-4 py-5 text-center font-extrabold text-gray-900 border-r border-gray-200">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-5 text-center">
                                    <form action="{{ route('admin.order.status.controller', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="relative inline-block">
                                            @php
                                                $statusColor = match($order->status) {
                                                    'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
                                                    'processing' => 'bg-blue-100 text-blue-800 border-blue-300',
                                                    'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                                                    'cancelled' => 'bg-red-100 text-red-800 border-red-300',
                                                    default => 'bg-gray-100 text-gray-800 border-gray-300'
                                                };
                                            @endphp
                                            <select name="status" onchange="this.form.submit()" class="appearance-none font-bold px-3 py-1.5 pr-6 rounded-full text-xs outline-none cursor-pointer border {{ $statusColor }}">
                                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            <i class="fa-solid fa-chevron-down text-[9px] text-gray-600 absolute right-2.5 top-3 pointer-events-none"></i>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-12 text-gray-500 font-bold">
                                    Belum ada pesanan yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>
