<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINELOGIQ - Riwayat Pembelian & Detail Produk</title>
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
                <a href="{{ route('order.track') }}" class="text-sm font-bold text-[#7F0017] hover:underline">
                    Lacak dengan Nomor Order →
                </a>
            </div>

            <div class="my-6">
                <h1 class="text-3xl sm:text-4xl font-black text-gray-900 mb-2">Riwayat Pembelian</h1>
                <p class="text-gray-500 text-sm">
                    Daftar seluruh pesanan Anda beserta detail hidangan yang telah diproses oleh restoran kami.
                </p>
            </div>

            @if($orders->isEmpty())
                <div class="text-center py-16 bg-gray-50 rounded-3xl border border-gray-200">
                    <img src="{{ asset('img/Icon/Cart.png') }}" class="h-16 w-auto mx-auto opacity-30 mb-3 filter grayscale" alt="Empty">
                    <p class="text-xl font-bold text-gray-700 mb-1">Belum Ada Riwayat Pesanan</p>
                    <p class="text-sm text-gray-400 mb-6 max-w-sm mx-auto">
                        Anda belum memesan menu apapun dalam sesi ini. Silakan kunjungi halaman menu untuk mulai memesan!
                    </p>
                    <a href="{{ route('menu') }}" class="inline-block bg-[#7F0017] text-white font-bold px-8 py-3 rounded-full hover:bg-amber-900 duration-200 shadow-md">
                        Mulai Pesan Sekarang
                    </a>
                </div>
            @else
                <div class="space-y-8">
                    @foreach($orders as $ord)
                        <div class="border border-gray-200 rounded-3xl p-6 hover:shadow-lg transition bg-white shadow-sm">
                            
                            <!-- Header Kartu Pesanan -->
                            <div class="flex flex-col sm:flex-row justify-between sm:items-center pb-4 border-b border-gray-200 gap-3">
                                <div>
                                    <span class="text-[11px] uppercase font-extrabold text-gray-400 tracking-wider">Nomor Pesanan</span>
                                    <h3 class="text-2xl font-black text-[#7F0017]">{{ $ord->order_number }}</h3>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        {{ $ord->created_at->format('d M Y, H:i') }} WIB • 
                                        <span class="font-bold text-gray-800">Meja {{ $ord->table_number }}</span> • 
                                        Pemesan: <span class="font-semibold text-gray-800">{{ $ord->customer_name }}</span>
                                    </p>
                                </div>
                                <div class="flex items-center gap-3">
                                    @php
                                        $badgeColor = match($ord->status) {
                                            'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
                                            'processing' => 'bg-blue-100 text-blue-800 border-blue-300',
                                            'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                                            'cancelled' => 'bg-red-100 text-red-800 border-red-300',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                    @endphp
                                    <span class="px-3.5 py-1.5 rounded-full text-xs font-black uppercase border {{ $badgeColor }}">
                                        {{ $ord->status }}
                                    </span>
                                    <a href="{{ route('order.track', ['order_number' => $ord->order_number]) }}" class="bg-[#7F0017] hover:bg-amber-900 text-white font-bold text-xs px-4 py-2 rounded-xl transition shadow-sm">
                                        Lacak Status
                                    </a>
                                </div>
                            </div>

                            <!-- Detail Produk yang Dipesan -->
                            <div class="pt-5 space-y-3">
                                <p class="text-xs font-extrabold uppercase text-gray-500 tracking-wider">Detail Produk:</p>
                                
                                <div class="space-y-3">
                                    @foreach($ord->items as $item)
                                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-gray-50 border border-gray-100">
                                            <div class="flex items-center gap-3 sm:gap-4">
                                                <img src="{{ asset('img/Food/' . ($item->menuItem->image ?? 'ShoyuRamen.png')) }}" 
                                                     class="w-14 h-14 rounded-xl object-cover shadow-sm border border-gray-200"
                                                     onerror="this.src='{{ asset('img/Food/ShoyuRamen.png') }}'">
                                                <div>
                                                    <h4 class="font-black text-base text-gray-900">{{ $item->menu_item_name }}</h4>
                                                    <p class="text-xs text-gray-500 font-medium">
                                                        Rp {{ number_format($item->menu_item_price, 0, ',', '.') }} × {{ $item->quantity }} Porsi
                                                    </p>
                                                    @if(!empty($item->notes))
                                                        <p class="text-[11px] text-gray-400 italic">Catatan: "{{ $item->notes }}"</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="font-extrabold text-base text-gray-900">
                                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Footer Tagihan -->
                            <div class="mt-5 pt-4 border-t border-gray-200 flex flex-wrap justify-between items-center text-sm gap-2">
                                <div class="text-xs text-gray-500">
                                    <span>Metode: <b class="uppercase text-gray-800">{{ $ord->payment_method }}</b></span>
                                    @if(!empty($ord->notes))
                                        <span class="ml-3">Catatan Order: "{{ $ord->notes }}"</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-gray-600">Total Transaksi:</span>
                                    <span class="text-xl font-black text-[#7F0017]">Rp {{ number_format($ord->total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

            <div class="text-center mt-12">
                <a href="{{ route('menu') }}" class="inline-block bg-[#7F0017] text-white font-bold px-8 py-3 rounded-full hover:bg-amber-900 duration-200 shadow-md text-sm">
                    Kembali Memesan Menu
                </a>
            </div>

        </div>
    </div>

    @include('partials.landing.footer')

</body>
</html>
