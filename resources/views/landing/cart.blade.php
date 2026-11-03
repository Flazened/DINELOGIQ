<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINELOGIQ - Cart, History & Tracking</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#7F0017]">

    @include('partials.landing.header')
    
    <div class="w-full min-h-screen px-4 sm:px-8 lg:px-12 py-10">
        
        @if(session('success'))
            <div class="max-w-7xl mx-auto mb-6 p-4 bg-emerald-600 text-white font-bold rounded-2xl text-center shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto mb-6 p-4 bg-red-600 text-white font-bold rounded-2xl text-center shadow-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Quick Navigation Header (Cart, History, Track) -->
        <div class="max-w-7xl mx-auto mb-8 flex flex-wrap items-center justify-between gap-4 bg-white/10 backdrop-blur-md p-4 rounded-3xl border border-white/20">
            <div class="flex items-center gap-3">
                <span class="text-white font-black text-2xl tracking-wide flex items-center gap-2">
                    <img src="{{ asset('img/Icon/Cart.png') }}" class="h-7 w-auto" alt="Cart">
                    Pesanan Tamu
                </span>
            </div>
            
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('order.history') }}" class="bg-white/20 hover:bg-white text-white hover:text-[#7F0017] font-bold text-sm px-5 py-2.5 rounded-full transition duration-300 flex items-center gap-2 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Riwayat Pembelian
                </a>

                <a href="{{ route('order.track') }}" class="bg-amber-400 hover:bg-amber-300 text-gray-900 font-extrabold text-sm px-5 py-2.5 rounded-full transition duration-300 flex items-center gap-2 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Lacak Pesanan
                </a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">
            <!-- Left Side: Cart Active Items -->
            <div class="h-auto w-full lg:w-2/3 space-y-8">
                
                <!-- Active Cart Card -->
                <div class="bg-white rounded-4xl p-6 lg:p-8 shadow-2xl">
                    <div class="flex px-2 py-3 justify-between items-center border-b border-gray-200">
                        <div class="flex items-center gap-3">
                            <h2 class="font-black text-2xl text-gray-900">Keranjang Saat Ini</h2>
                            <span class="bg-[#7F0017] text-white text-xs font-extrabold px-3 py-1 rounded-full">
                                {{ count($items) }} Menu
                            </span>
                        </div>
                        @if(!empty($items))
                            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan semua item di keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-red-600 hover:text-red-800 transition">
                                    Hapus Semua
                                </button>
                            </form>
                        @endif
                    </div>

                    @if(empty($items))
                        <div class="text-center py-12">
                            <img src="{{ asset('img/Icon/Cart.png') }}" class="h-16 w-auto mx-auto opacity-30 mb-3 filter grayscale" alt="Empty Cart">
                            <p class="text-xl font-bold text-gray-600 mb-1">Keranjang Belanja Kosong</p>
                            <p class="text-gray-400 text-sm mb-5">Silakan tambahkan hidangan favorit Anda dari menu.</p>
                            <a href="{{ route('menu') }}" class="inline-block bg-[#7F0017] text-white font-bold px-7 py-2.5 rounded-full hover:bg-amber-900 duration-200 shadow-md text-sm">
                                Buka Katalog Menu
                            </a>
                        </div>
                    @else
                        <div class="space-y-4 mt-6">
                            @foreach($items as $item)
                                <div class="bg-[#FAFAFA] flex flex-col sm:flex-row justify-between items-center p-4 rounded-2xl border border-gray-100 shadow-sm gap-4 hover:border-gray-300 transition">
                                    <div class="flex items-center gap-4 w-full sm:w-auto">
                                        <img src="{{ asset('img/Food/' . $item['image']) }}" 
                                             class="h-20 w-20 object-cover rounded-xl shadow-inner"
                                             onerror="this.src='{{ asset('img/Food/ShoyuRamen.png') }}'">
                                        <div>
                                            <p class="font-extrabold text-lg text-gray-900">{{ $item['name'] }}</p>
                                            <p class="text-xs font-semibold text-gray-500">Rp {{ number_format($item['price'], 0, ',', '.') }} / porsi</p>
                                            @if(!empty($item['notes']))
                                                <p class="text-xs italic text-gray-400 mt-1">"{{ $item['notes'] }}"</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between sm:justify-end gap-5 w-full sm:w-auto">
                                        {{-- Quantity Controls --}}
                                        <div class="inline-flex items-center border-2 border-[#D1DADD] rounded-xl h-9 px-2 gap-1 bg-white">
                                            <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="menu_id" value="{{ $item['id'] }}">
                                                <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                                <button type="submit" class="w-7 h-7 flex items-center justify-center text-base font-bold hover:bg-gray-100 rounded-full text-gray-700">−</button>
                                            </form>

                                            <div class="bg-[#D1DADD] h-4 w-[2px]"></div>
                                            <span class="w-7 text-center text-sm font-bold text-gray-800">{{ $item['quantity'] }}</span>
                                            <div class="bg-[#D1DADD] h-4 w-[2px]"></div>

                                            <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="menu_id" value="{{ $item['id'] }}">
                                                <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                                <button type="submit" class="w-7 h-7 flex items-center justify-center text-base font-bold hover:bg-gray-100 rounded-full text-gray-700">+</button>
                                            </form>
                                        </div>

                                        <p class="font-black text-base text-[#7F0017] min-w-[90px] text-right">
                                            Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                        </p>

                                        {{-- Delete Button --}}
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="hover:opacity-75 transition p-1" title="Hapus menu">
                                                <img src="{{ asset('img/Icon/delete.png') }}" class="w-6 h-6" alt="Delete">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Section: Riwayat Pesanan Saya & Detail Produk Pembelian -->
                @if(isset($recentOrders) && $recentOrders->isNotEmpty())
                    <div class="bg-white rounded-4xl p-6 lg:p-8 shadow-2xl">
                        <div class="flex items-center justify-between pb-4 border-b border-gray-200 mb-6">
                            <div>
                                <h3 class="font-black text-2xl text-gray-900">Riwayat Pembelian Anda</h3>
                                <p class="text-xs text-gray-500">Daftar transaksi dan detail produk yang Anda pesan dalam kunjungan ini</p>
                            </div>
                            <a href="{{ route('order.history') }}" class="text-xs font-bold text-[#7F0017] hover:underline">
                                Lihat Semua →
                            </a>
                        </div>

                        <div class="space-y-6">
                            @foreach($recentOrders as $order)
                                <div class="border border-gray-200 rounded-3xl p-5 bg-[#FAFAFA] hover:shadow-md transition">
                                    <div class="flex flex-wrap justify-between items-center pb-3 border-b border-gray-200 gap-2">
                                        <div>
                                            <span class="text-[11px] font-extrabold text-gray-400 uppercase">Nomor Order</span>
                                            <p class="text-lg font-black text-[#7F0017]">{{ $order->order_number }}</p>
                                            <p class="text-xs text-gray-500">Meja {{ $order->table_number }} • {{ $order->created_at->format('H:i') }} WIB</p>
                                        </div>
                                        
                                        <div class="flex items-center gap-3">
                                            @php
                                                $badgeClass = match($order->status) {
                                                    'pending' => 'bg-amber-100 text-amber-800 border-amber-300',
                                                    'processing' => 'bg-blue-100 text-blue-800 border-blue-300',
                                                    'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
                                                    'cancelled' => 'bg-red-100 text-red-800 border-red-300',
                                                    default => 'bg-gray-100 text-gray-800'
                                                };
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-black uppercase border {{ $badgeClass }}">
                                                {{ $order->status }}
                                            </span>
                                            <a href="{{ route('order.track', ['order_number' => $order->order_number]) }}" class="bg-[#7F0017] text-white hover:bg-amber-900 px-3.5 py-1.5 rounded-xl font-bold text-xs transition shadow-sm">
                                                Lacak
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Detail Produk per Item Pesanan -->
                                    <div class="pt-4 space-y-3">
                                        <p class="text-xs font-extrabold text-gray-600 uppercase tracking-wider">Detail Produk Dipesan:</p>
                                        @foreach($order->items as $item)
                                            <div class="flex items-center justify-between text-sm py-1 bg-white p-3 rounded-xl border border-gray-100">
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ asset('img/Food/' . ($item->menuItem->image ?? 'ShoyuRamen.png')) }}" 
                                                         class="w-12 h-12 rounded-lg object-cover shadow-sm"
                                                         onerror="this.src='{{ asset('img/Food/ShoyuRamen.png') }}'">
                                                    <div>
                                                        <p class="font-bold text-gray-900">{{ $item->menu_item_name }}</p>
                                                        <p class="text-xs text-gray-500">Rp {{ number_format($item->menu_item_price, 0, ',', '.') }} × {{ $item->quantity }} porsi</p>
                                                        @if(!empty($item->notes))
                                                            <p class="text-[11px] text-gray-400 italic">"{{ $item->notes }}"</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-extrabold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-4 pt-3 border-t border-gray-200 flex justify-between items-center text-sm">
                                        <span class="text-gray-500 font-semibold">Total Pembayaran:</span>
                                        <span class="text-lg font-black text-[#7F0017]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <!-- Right Side: Order Summary & Quick Tracker Widget -->
            <div class="h-fit w-full lg:w-1/3 space-y-6">
                
                <!-- Order Summary Card -->
                <div class="bg-white rounded-4xl p-6 lg:p-8 shadow-2xl">
                    <p class="flex justify-center pb-4 text-2xl font-black text-gray-900 border-b border-gray-100">Ringkasan Biaya</p>
                    
                    <div class="flex justify-between mt-6 gap-2">
                        <input type="text" 
                               id="voucherInput"
                               placeholder="Voucher Diskon"
                               class="w-2/3 border border-gray-300 rounded-2xl h-11 px-4 text-sm focus:outline-none focus:border-[#7F0017]">
                        <button onclick="applyVoucher()" class="font-bold h-11 w-1/3 border border-gray-300 text-[#677A7E] rounded-2xl hover:bg-gray-100 transition text-sm">
                            Apply
                        </button>
                    </div>

                    <div class="flex flex-col mt-6 space-y-2 text-sm">
                        <div class="py-2 flex justify-between px-2">
                            <p class="text-[#677A7E]">Subtotal Makanan:</p>
                            <p class="font-bold text-gray-800">Rp {{ number_format($subtotal ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="py-2 flex justify-between px-2">
                            <p class="text-[#677A7E]">Biaya Layanan:</p>
                            <p class="font-bold text-emerald-600">Gratis</p>
                        </div>
                        <div class="py-2 flex justify-between px-2">
                            <p class="text-[#677A7E]">Pajak Restoran:</p>
                            <p class="font-bold text-gray-800">Sudah Termasuk</p>
                        </div>
                        <hr class="my-2 border-gray-200">
                        <div class="py-2 flex justify-between px-2 items-center">
                            <p class="font-black text-xl text-gray-900">Total Akhir:</p>
                            <p class="font-black text-2xl text-[#7F0017]">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col items-center mt-6">
                        @if(!empty($items))
                            <button onclick="openCheckoutModal()" 
                                    class="bg-[#7F0017] text-white font-extrabold text-xl h-14 rounded-full w-full hover:bg-amber-900 duration-300 shadow-xl hover:scale-105">
                                Checkout ({{ count($items) }} Menu)
                            </button>
                        @else
                            <button disabled 
                                    class="bg-gray-200 text-gray-400 font-bold text-base h-14 rounded-full w-full cursor-not-allowed">
                                Keranjang Kosong
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Lacak Pesanan Cepat Widget -->
                <div class="bg-white rounded-4xl p-6 lg:p-8 shadow-2xl border-t-4 border-amber-400">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-black text-lg text-gray-900">Lacak Pembelian</h4>
                            <p class="text-xs text-gray-500">Cek proses memasak di dapur</p>
                        </div>
                    </div>

                    <form action="{{ route('order.track') }}" method="GET" class="mt-4">
                        <label class="block text-xs font-bold text-gray-600 mb-1">Nomor Pesanan (Order No)</label>
                        <div class="flex gap-2">
                            <input type="text" 
                                   name="order_number" 
                                   placeholder="ORD-..." 
                                   required 
                                   class="flex-1 border border-gray-300 rounded-xl px-3 py-2 text-sm uppercase font-bold focus:outline-none focus:border-[#7F0017]">
                            <button type="submit" class="bg-[#7F0017] hover:bg-amber-900 text-white font-bold px-4 py-2 rounded-xl text-sm transition">
                                Lacak
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- Checkout Modal Form -->
    <!-- ========================================================================= -->
    <div id="checkoutModal" class="hidden fixed inset-0 bg-black/60 z-50 overflow-y-auto backdrop-blur-sm">
        <div class="min-h-full flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl w-full max-w-4xl shadow-2xl relative overflow-hidden">
                
                <button onclick="closeCheckout()" class="absolute top-6 left-6 z-10 p-1 hover:bg-gray-100 rounded-full transition">
                    <img src="{{ asset('img/Icon/back.png') }}" alt="Back" class="h-8 w-8">
                </button>

                <div class="p-8 lg:p-12">
                    <!-- Progress Steps -->
                    <div class="flex items-center justify-center mb-8">
                        <div class="flex items-center">
                            <div id="step1Icon" class="w-10 h-10 rounded-full bg-[#7F0017] text-white flex items-center justify-center font-bold">
                                <img src="{{ asset('img/Icon/Location-checkout.png') }}" class="w-5 h-5">
                            </div>
                            <div id="line1" class="w-24 sm:w-32 h-1 bg-gray-300 mx-2 transition-all"></div>
                            <div id="step2Icon" class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">
                                <img src="{{ asset('img/Icon/Payment-checkout.png') }}" class="w-5 h-5">
                            </div>
                        </div>
                    </div>

                    <form id="orderForm" action="{{ route('order.store') }}" method="POST">
                        @csrf
                        
                        <!-- Step 1: Personal & Table Information -->
                        <div id="step1" class="checkout-step">
                            <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Informasi Pemesan</h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Nama Pemesan <span class="text-red-500">*</span></label>
                                    <input type="text" name="customer_name" id="customerName" required placeholder="Contoh: Budi Santoso" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-[#7F0017]">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
                                    <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden focus-within:border-[#7F0017]">
                                        <div class="flex items-center px-3 bg-gray-100 border-r border-gray-300">
                                            <img src="{{ asset('img/Icon/Indonesia.png') }}" class="w-5 h-5 mr-1.5">
                                            <span class="text-sm font-semibold text-gray-700">+62</span>
                                        </div>
                                        <input type="tel" name="customer_phone" id="customerPhone" required placeholder="8123456789" class="w-full px-4 py-3 focus:outline-none">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Nomor Meja Restoran <span class="text-red-500">*</span></label>
                                    <input type="number" name="table_number" id="tableNumber" required min="1" max="99" value="1" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-[#7F0017]">
                                    <span class="text-xs text-gray-400">Pilih nomor meja tempat Anda duduk (1 - 99)</span>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Catatan Tambahan (Opsional)</label>
                                    <input type="text" name="notes" id="orderNotes" placeholder="Catatan untuk chef / pelayan" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-[#7F0017]">
                                </div>
                            </div>

                            <button type="button" onclick="goToStep2()" class="w-full bg-[#7F0017] text-white font-extrabold text-lg py-4 rounded-full hover:bg-amber-900 duration-300 shadow-xl">
                                Lanjut ke Pembayaran
                            </button>
                        </div>

                        <!-- Step 2: Payment Selection -->
                        <div id="step2" class="checkout-step hidden">
                            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Metode Pembayaran</h2>
                            <p class="text-gray-500 text-sm mb-6">Pilih salah satu metode pembayaran di bawah ini:</p>
                            
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                                <label class="border-2 border-[#7F0017] bg-red-50 rounded-2xl p-4 cursor-pointer hover:border-[#7F0017] transition-all payment-option flex flex-col items-center justify-center">
                                    <input type="radio" name="payment_method" value="qris" checked class="hidden" onchange="selectPayment(this)">
                                    <img src="{{ asset('img/Icon/Dana.png') }}" class="h-10 w-auto mb-2">
                                    <span class="text-xs font-bold text-gray-800">QRIS / E-Wallet</span>
                                </label>
                                <label class="border-2 border-gray-200 rounded-2xl p-4 cursor-pointer hover:border-[#7F0017] transition-all payment-option flex flex-col items-center justify-center">
                                    <input type="radio" name="payment_method" value="bca" class="hidden" onchange="selectPayment(this)">
                                    <img src="{{ asset('img/Icon/Bca.png') }}" class="h-10 w-auto mb-2">
                                    <span class="text-xs font-bold text-gray-800">Bank Transfer</span>
                                </label>
                                <label class="border-2 border-gray-200 rounded-2xl p-4 cursor-pointer hover:border-[#7F0017] transition-all payment-option flex flex-col items-center justify-center">
                                    <input type="radio" name="payment_method" value="visa" class="hidden" onchange="selectPayment(this)">
                                    <img src="{{ asset('img/Icon/VisaCard.png') }}" class="h-10 w-auto mb-2">
                                    <span class="text-xs font-bold text-gray-800">Credit / Debit</span>
                                </label>
                                <label class="border-2 border-gray-200 rounded-2xl p-4 cursor-pointer hover:border-[#7F0017] transition-all payment-option flex flex-col items-center justify-center">
                                    <input type="radio" name="payment_method" value="cash" class="hidden" onchange="selectPayment(this)">
                                    <img src="{{ asset('img/Icon/Payment-checkout.png') }}" class="h-10 w-auto mb-2">
                                    <span class="text-xs font-bold text-gray-800">Bayar di Kasir</span>
                                </label>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-200 mb-8 flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-bold">Total yang Harus Dibayar</p>
                                    <p class="text-2xl font-black text-[#7F0017]">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1.5 rounded-full">
                                    ✓ Siap Diproses
                                </span>
                            </div>

                            <div class="flex gap-4">
                                <button type="button" onclick="goToStep1()" class="w-1/3 bg-gray-200 text-gray-700 font-bold text-lg py-4 rounded-full hover:bg-gray-300 duration-200">
                                    Kembali
                                </button>
                                <button type="submit" class="w-2/3 bg-[#7F0017] text-white font-extrabold text-lg py-4 rounded-full hover:bg-amber-900 duration-300 shadow-xl">
                                    Konfirmasi & Buat Pesanan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.landing.footer')

    <script>
        function openCheckoutModal() {
            document.getElementById('checkoutModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            goToStep1();
        }

        function closeCheckout() {
            document.getElementById('checkoutModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function goToStep1() {
            document.getElementById('step1').classList.remove('hidden');
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1Icon').className = 'w-10 h-10 rounded-full bg-[#7F0017] text-white flex items-center justify-center font-bold';
            document.getElementById('step2Icon').className = 'w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold';
            document.getElementById('line1').className = 'w-24 sm:w-32 h-1 bg-gray-300 mx-2 transition-all';
        }

        function goToStep2() {
            const name = document.getElementById('customerName').value.trim();
            const phone = document.getElementById('customerPhone').value.trim();
            const table = document.getElementById('tableNumber').value;

            if (!name || !phone || !table) {
                alert('Silakan lengkapi nama pemesan, nomor telepon, dan nomor meja.');
                return;
            }

            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
            document.getElementById('step2Icon').className = 'w-10 h-10 rounded-full bg-[#7F0017] text-white flex items-center justify-center font-bold';
            document.getElementById('line1').className = 'w-24 sm:w-32 h-1 bg-[#7F0017] mx-2 transition-all';
        }

        function selectPayment(radio) {
            document.querySelectorAll('.payment-option').forEach(opt => {
                opt.classList.remove('border-[#7F0017]', 'bg-red-50');
                opt.classList.add('border-gray-200');
            });
            radio.closest('.payment-option').classList.remove('border-gray-200');
            radio.closest('.payment-option').classList.add('border-[#7F0017]', 'bg-red-50');
        }

        function applyVoucher() {
            const input = document.getElementById('voucherInput');
            if (input.value.trim()) {
                alert('Voucher "' + input.value.trim() + '" berhasil diterapkan!');
                input.value = '';
            } else {
                alert('Silakan masukkan kode voucher terlebih dahulu.');
            }
        }
    </script>

</body>
</html>
