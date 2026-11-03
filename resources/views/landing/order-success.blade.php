<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINELOGIQ - Pesanan Berhasil!</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F0EDE5]">

    @include('partials.landing.header')

    <div class="max-w-4xl mx-auto my-12 px-6">
        <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12 text-center border-t-8 border-[#7F0017]">
            
            <div class="w-24 h-24 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-3xl lg:text-4xl font-black text-gray-900 mb-2">Terima Kasih Atas Pesanan Anda!</h1>
            <p class="text-gray-600 mb-6 text-lg">Pesanan Anda telah diterima oleh dapur DINELOGIQ dan sedang disiapkan.</p>

            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 max-w-lg mx-auto mb-8 shadow-sm">
                <p class="text-xs uppercase font-extrabold text-amber-800 tracking-wider mb-1">Nomor Pesanan Unik</p>
                <p class="text-3xl font-black text-[#7F0017] tracking-wider">{{ $order->order_number }}</p>
                <div class="mt-4 pt-4 border-t border-amber-200/60 flex justify-around text-sm text-gray-700">
                    <div>
                        <span class="block text-xs text-gray-500">Nomor Meja</span>
                        <span class="font-extrabold text-lg text-gray-900">Meja {{ $order->table_number }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500">Status</span>
                        <span class="inline-block px-3 py-1 bg-amber-200 text-amber-900 font-bold rounded-full text-xs uppercase mt-1">
                            {{ $order->status }}
                        </span>
                    </div>
                    <div>
                        <span class="block text-xs text-gray-500">Metode Bayar</span>
                        <span class="font-extrabold text-lg text-gray-900 uppercase">{{ $order->payment_method }}</span>
                    </div>
                </div>
            </div>

            <!-- Rincian Item -->
            <div class="text-left border border-gray-200 rounded-2xl p-6 mb-8 bg-[#FAFAFA]">
                <h3 class="font-bold text-lg text-gray-900 mb-4 border-b pb-2">Rincian Menu</h3>
                <div class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <div class="py-3 flex justify-between items-center text-sm">
                            <div>
                                <span class="font-bold text-gray-900">{{ $item->menu_item_name }}</span>
                                <span class="text-gray-500">× {{ $item->quantity }}</span>
                                @if(!empty($item->notes))
                                    <p class="text-xs text-gray-400 italic">Catatan: {{ $item->notes }}</p>
                                @endif
                            </div>
                            <span class="font-extrabold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="border-t-2 border-gray-300 pt-4 mt-2 flex justify-between items-center text-lg font-black text-gray-900">
                    <span>Total Pembayaran:</span>
                    <span class="text-[#7F0017] text-2xl">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('order.track', ['order_number' => $order->order_number]) }}" class="bg-[#7F0017] hover:bg-amber-900 text-white font-bold py-3.5 px-8 rounded-full duration-200 shadow-md">
                    Lacak Status Pesanan
                </a>
                <a href="{{ route('menu') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3.5 px-8 rounded-full duration-200">
                    Kembali ke Menu
                </a>
            </div>

        </div>
    </div>

    @include('partials.landing.footer')

</body>
</html>
