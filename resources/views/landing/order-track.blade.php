<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINELOGIQ - Lacak Detail Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F0EDE5]">

    @include('partials.landing.header')

    <div class="max-w-5xl mx-auto my-12 px-4 sm:px-6">
        <div class="bg-white rounded-4xl shadow-2xl p-6 sm:p-10 border-t-8 border-[#7F0017]">
            
            <div class="flex items-center justify-between pb-6 border-b border-gray-200">
                <a href="{{ route('cart') }}" class="flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#7F0017] transition">
                    <img src="{{ asset('img/Icon/back.png') }}" class="w-6 h-6" alt="Kembali">
                    <span>Kembali ke Keranjang</span>
                </a>
                <a href="{{ route('order.history') }}" class="text-sm font-bold text-[#7F0017] hover:underline">
                    Lihat Riwayat Pesanan Saya →
                </a>
            </div>

            <div class="text-center my-6">
                <h1 class="text-3xl sm:text-4xl font-black text-gray-900 mb-2">Lacak & Detail Pesanan</h1>
                <p class="text-gray-500 text-sm max-w-md mx-auto">
                    Pantau status penyajian hidangan Anda dari dapur restoran secara real-time.
                </p>
            </div>

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-600 text-white font-bold rounded-2xl text-center shadow-md">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('order.track') }}" method="GET" class="flex flex-col sm:flex-row gap-3 max-w-xl mx-auto mb-10">
                <input type="text" 
                       name="order_number" 
                       value="{{ $orderNumber ?? '' }}" 
                       placeholder="Masukkan Nomor Order (e.g. ORD-...)" 
                       required 
                       class="flex-1 border-2 border-gray-300 rounded-2xl px-5 py-3 text-base font-bold tracking-wider uppercase focus:outline-none focus:border-[#7F0017]">
                <button type="submit" class="bg-[#7F0017] hover:bg-amber-900 text-white font-extrabold px-8 py-3 rounded-2xl shadow-md duration-200">
                    Lacak Pesanan
                </button>
            </form>

            @if(!empty($order))
                <div class="bg-gray-50 border border-gray-200 rounded-3xl p-6 lg:p-8 shadow-inner space-y-8">
                    
                    <!-- Header Info Order -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-6 border-b border-gray-200 gap-4">
                        <div>
                            <span class="text-xs uppercase font-extrabold text-gray-400">Nomor Pesanan</span>
                            <h2 class="text-2xl sm:text-3xl font-black text-[#7F0017]">{{ $order->order_number }}</h2>
                            <p class="text-sm text-gray-600 mt-1">
                                Pemesan: <span class="font-bold text-gray-900">{{ $order->customer_name }}</span> • 
                                Nomor Meja: <span class="font-extrabold text-gray-900">Meja {{ $order->table_number }}</span>
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <div>
                            @php
                                $badgeStyle = match($order->status) {
                                    'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
                                    'processing' => 'bg-blue-100 text-blue-800 border-blue-300',
                                    'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                                    'cancelled' => 'bg-red-100 text-red-800 border-red-300',
                                    default => 'bg-gray-100 text-gray-800'
                                };
                            @endphp
                            <span class="inline-block px-4 py-2 border rounded-full font-black text-sm uppercase tracking-wider {{ $badgeStyle }}">
                                Status: {{ $order->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Progress Bar / Timeline Status -->
                    <div>
                        <p class="text-xs font-extrabold uppercase text-gray-400 tracking-wider mb-4 text-center">Status Pembuatan Makanan</p>
                        <div class="grid grid-cols-3 text-center gap-2">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg {{ in_array($order->status, ['pending', 'processing', 'completed']) ? 'bg-[#7F0017] text-white shadow-md' : 'bg-gray-200 text-gray-500' }}">
                                    1
                                </div>
                                <span class="text-xs font-extrabold mt-2 text-gray-800">Diterima Restoran</span>
                                <span class="text-[10px] text-gray-400">Pesanan masuk ke sistem</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg {{ in_array($order->status, ['processing', 'completed']) ? 'bg-[#7F0017] text-white shadow-md' : 'bg-gray-200 text-gray-500' }}">
                                    2
                                </div>
                                <span class="text-xs font-extrabold mt-2 text-gray-800">Dimasak di Dapur</span>
                                <span class="text-[10px] text-gray-400">Chef sedang meracik menu</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg {{ $order->status === 'completed' ? 'bg-emerald-600 text-white shadow-md' : 'bg-gray-200 text-gray-500' }}">
                                    3
                                </div>
                                <span class="text-xs font-extrabold mt-2 text-gray-800">Selesai / Disajikan</span>
                                <span class="text-[10px] text-gray-400">Hidangan telah diantar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Produk yang Dipesan -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                        <h3 class="font-extrabold text-xl text-gray-900 mb-4 pb-3 border-b border-gray-100 flex items-center justify-between">
                            <span>Detail Produk yang Dipesan</span>
                            <span class="text-xs font-bold text-gray-400">{{ count($order->items) }} Jenis Menu</span>
                        </h3>

                        <div class="divide-y divide-gray-100 space-y-4">
                            @foreach($order->items as $item)
                                <div class="pt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ asset('img/Food/' . ($item->menuItem->image ?? 'ShoyuRamen.png')) }}" 
                                             class="w-16 h-16 rounded-xl object-cover shadow-sm border border-gray-100"
                                             onerror="this.src='{{ asset('img/Food/ShoyuRamen.png') }}'">
                                        <div>
                                            <h4 class="font-black text-lg text-gray-900">{{ $item->menu_item_name }}</h4>
                                            <p class="text-xs text-gray-500">
                                                Rp {{ number_format($item->menu_item_price, 0, ',', '.') }} × {{ $item->quantity }} Porsi
                                            </p>
                                            @if(!empty($item->notes))
                                                <p class="text-xs text-gray-400 italic mt-0.5">Catatan: "{{ $item->notes }}"</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-right w-full sm:w-auto">
                                        <span class="text-xs text-gray-400 block sm:inline">Subtotal:</span>
                                        <span class="font-black text-lg text-gray-900">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Ringkasan Pembayaran -->
                        <div class="border-t-2 border-gray-200 mt-6 pt-4 space-y-2">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Metode Pembayaran:</span>
                                <span class="font-extrabold uppercase text-gray-800">{{ $order->payment_method }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Status Bayar:</span>
                                <span class="font-bold text-emerald-600">Terverifikasi</span>
                            </div>
                            <div class="flex justify-between items-center text-xl font-black text-gray-900 pt-2 border-t border-gray-100">
                                <span>Total Pembayaran:</span>
                                <span class="text-[#7F0017] text-2xl">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

            <div class="text-center mt-10">
                <a href="{{ route('menu') }}" class="inline-block bg-[#7F0017] text-white font-bold px-8 py-3 rounded-full hover:bg-amber-900 duration-200 shadow-md">
                    Pesan Hidangan Lainnya
                </a>
            </div>

        </div>
    </div>

    @include('partials.landing.footer')

</body>
</html>
