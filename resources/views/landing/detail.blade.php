<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DINELOGIQ - {{ $menuItem->name ?? 'Detail Menu' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F0EDE5]">

    @include('partials.landing.header')
    
    <div class="bg-[#7F0017] w-full min-h-screen px-4 sm:px-6 lg:px-12 py-10">
        <div class="max-w-6xl mx-auto bg-white w-full rounded-4xl shadow-2xl p-6 sm:p-10 lg:p-12 relative overflow-hidden">
            
            <!-- Ornamen Estetika Background -->
            <div class="absolute -top-16 -right-16 w-48 h-48 bg-amber-100/50 rounded-full pointer-events-none"></div>

            <!-- Tombol Kembali & Kategori Badge -->
            <div class="flex items-center justify-between mb-8 relative z-10">
                <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-[#7F0017] font-bold transition">
                    <img src="{{ asset('img/Icon/back.png') }}" alt="back" class="h-10 w-10 hover:scale-105 duration-200">
                    <span class="text-sm">Kembali ke Menu</span>
                </a>

                <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-[#004643] text-white shadow-sm">
                    {{ $menuItem->category->name ?? 'Menu Unggulan' }}
                </span>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-600 text-white font-bold rounded-2xl text-center shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-10 lg:gap-14 relative z-10">

                <!-- KIRI: Gambar Menu Utama -->
                <div class="flex flex-col items-center">
                    <div class="bg-[#E4DEB9] rounded-full p-8 w-72 h-72 sm:w-96 sm:h-96 lg:w-[420px] lg:h-[420px] flex justify-center items-center shadow-inner relative group">
                        <img src="{{ asset('img/Food/' . ($menuItem->image ?? 'ShoyuRamen.png')) }}" 
                             alt="{{ $menuItem->name ?? 'Menu' }}" 
                             class="w-full h-full object-contain drop-shadow-2xl rounded-full group-hover:scale-105 duration-300"
                             onerror="this.src='{{ asset('img/Food/ShoyuRamen.png') }}'">
                        
                        <div class="absolute bottom-4 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-gray-800 shadow-md">
                            Chef's Recommendation
                        </div>
                    </div>

                    <p class="text-xs text-gray-400 mt-4 italic text-center">
                        Disajikan segar dan hangat dengan bahan pilihan setiap hari
                    </p>
                </div>

                <!-- KANAN: Form Kustomisasi Interaktif -->
                <div class="flex-1 w-full">
                    
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h1 class="font-black text-3xl sm:text-4xl lg:text-5xl text-gray-900 leading-tight">
                                {{ $menuItem->name ?? 'Shoyu Ramen' }}
                            </h1>
                            <p class="mt-2 text-2xl font-black text-[#7F0017]">
                                Rp <span id="basePriceDisplay">{{ number_format($menuItem->price, 0, ',', '.') }}</span>
                            </p>
                        </div>
                        
                        <button onclick="toggleLike(this)" class="p-2 rounded-full hover:bg-gray-100 transition" title="Sukai menu ini">
                            <img src="{{ asset('img/Icon/Like.png') }}" alt="Favorite" class="h-8 w-8 duration-200">
                        </button>
                    </div>

                    <p class="text-gray-600 text-sm sm:text-base mt-4 leading-relaxed border-b border-gray-100 pb-5">
                        {{ $menuItem->description ?? 'Nikmati perpaduan cita rasa autentik khas DINELOGIQ yang diracik khusus untuk memanjakan lidah Anda.' }}
                    </p>

                    <!-- FORM PEMESANAN & ADD-ONS INTERAKTIF -->
                    <form id="addToCartForm" action="{{ route('cart.add') }}" method="POST" class="mt-6 space-y-6">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menuItem->id }}">
                        <input type="hidden" name="notes" id="finalNotes">

                        <!-- 1. Pilihan Ukuran / Porsi (Jika Ada) -->
                        @if(!empty($customization['has_size']) && !empty($customization['sizes']))
                            <div>
                                <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-wider mb-2">
                                    Pilih Porsi / Ukuran:
                                </label>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                    @foreach($customization['sizes'] as $idx => $size)
                                        <label class="size-card border-2 {{ $idx == 1 || count($customization['sizes']) == 1 ? 'border-[#7F0017] bg-red-50 text-[#7F0017]' : 'border-gray-200 bg-white text-gray-700' }} rounded-2xl p-3 cursor-pointer flex flex-col items-center justify-center transition duration-200 hover:border-[#7F0017]">
                                            <input type="radio" 
                                                   name="size_option" 
                                                   value="{{ $size['code'] }}" 
                                                   data-extra="{{ $size['extra_price'] }}"
                                                   data-label="{{ $size['label'] }}"
                                                   class="hidden" 
                                                   {{ $idx == 1 || count($customization['sizes']) == 1 ? 'checked' : '' }}
                                                   onchange="handleSizeChange(this)">
                                            <span class="font-extrabold text-sm">{{ $size['label'] }}</span>
                                            @if($size['extra_price'] != 0)
                                                <span class="text-[11px] font-bold {{ $size['extra_price'] > 0 ? 'text-amber-700' : 'text-emerald-700' }}">
                                                    {{ $size['extra_price'] > 0 ? '+Rp ' . number_format($size['extra_price'], 0, ',', '.') : '-Rp ' . number_format(abs($size['extra_price']), 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="text-[11px] text-gray-400">Harga Standar</span>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- 2. Opsi Kemanisan & Es (Khusus Minuman) -->
                        @if(!empty($customization['sweetness']))
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-wider mb-2">
                                        Tingkat Kemanisan:
                                    </label>
                                    <select id="sweetnessSelect" class="w-full border-2 border-gray-200 rounded-2xl px-4 py-2.5 text-sm font-bold text-gray-800 bg-white focus:outline-none focus:border-[#7F0017]">
                                        @foreach($customization['sweetness'] as $sweet)
                                            <option value="{{ $sweet }}">{{ $sweet }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if(!empty($customization['ice']))
                                    <div>
                                        <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-wider mb-2">
                                            Pilihan Es Batu:
                                        </label>
                                        <select id="iceSelect" class="w-full border-2 border-gray-200 rounded-2xl px-4 py-2.5 text-sm font-bold text-gray-800 bg-white focus:outline-none focus:border-[#7F0017]">
                                            @foreach($customization['ice'] as $ice)
                                                <option value="{{ $ice }}">{{ $ice }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- 3. Opsi Kepedasan (Khusus Ramen / Makanan Utama) -->
                        @if(!empty($customization['spiciness']))
                            <div>
                                <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-wider mb-2">
                                    Tingkat Kepedasan Kuah:
                                </label>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                    @foreach($customization['spiciness'] as $sIdx => $spice)
                                        <label class="spice-card border-2 {{ $sIdx == 0 ? 'border-[#7F0017] bg-red-50 text-[#7F0017]' : 'border-gray-200 bg-white text-gray-700' }} rounded-xl p-2.5 text-center cursor-pointer text-xs font-bold transition hover:border-[#7F0017]">
                                            <input type="radio" name="spice_option" value="{{ $spice }}" {{ $sIdx == 0 ? 'checked' : '' }} class="hidden" onchange="handleSpiceChange(this)">
                                            <span>{{ $spice }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- 4. Opsi Seasoning (Khusus Appetizer) -->
                        @if(!empty($customization['seasonings']))
                            <div>
                                <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-wider mb-2">
                                    Pilihan Bumbu Tabur:
                                </label>
                                <select id="seasoningSelect" class="w-full border-2 border-gray-200 rounded-2xl px-4 py-2.5 text-sm font-bold text-gray-800 bg-white focus:outline-none focus:border-[#7F0017]">
                                    @foreach($customization['seasonings'] as $seasoning)
                                        <option value="{{ $seasoning }}">{{ $seasoning }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- 5. KARTU ADD-ONS POPULER YANG SESUAI KATEGORI -->
                        @if(!empty($customization['addons']) && count($customization['addons']) > 0)
                            <div class="pt-2">
                                <div class="flex items-center justify-between mb-3">
                                    <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider">
                                        {{ $customization['title'] ?? 'Add-ons Populer' }}
                                    </label>
                                    <span class="text-[11px] text-gray-400 italic">Pilih yang Anda sukai</span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($customization['addons'] as $addon)
                                        <div class="addon-card border-2 border-gray-200 hover:border-[#7F0017] rounded-2xl p-3 cursor-pointer transition-all duration-200 bg-white flex items-center justify-between shadow-sm"
                                             onclick="toggleAddon(this, {{ $addon['price'] }}, '{{ addslashes($addon['name']) }}')">
                                            
                                            <div class="flex items-center gap-3">
                                                @if(!empty($addon['image']))
                                                    <img src="{{ asset('img/Food/' . $addon['image']) }}" 
                                                         class="w-12 h-12 object-contain rounded-xl p-1 bg-gray-50 border border-gray-100" 
                                                         alt="{{ $addon['name'] }}">
                                                @else
                                                    <span class="text-2xl p-1.5 rounded-xl bg-gray-50 border border-gray-100">{{ $addon['icon'] ?? '✨' }}</span>
                                                @endif
                                                
                                                <div>
                                                    <p class="font-extrabold text-xs text-gray-900 leading-tight">{{ $addon['name'] }}</p>
                                                    <p class="text-xs font-black text-[#7F0017] mt-0.5">+Rp {{ number_format($addon['price'], 0, ',', '.') }}</p>
                                                </div>
                                            </div>

                                            <div class="addon-checkbox w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center text-white transition text-xs font-black">
                                                ✓
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- 6. Catatan Khusus untuk Dapur -->
                        <div>
                            <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-wider mb-1">
                                Catatan Tambahan (Opsional):
                            </label>
                            <input type="text" 
                                   id="customerNotesInput" 
                                   placeholder="Contoh: jangan terlalu panas, sendok dipisah" 
                                   class="w-full border-2 border-gray-200 rounded-2xl px-4 py-2.5 text-sm focus:outline-none focus:border-[#7F0017]">
                        </div>

                        <!-- 7. SECTION TOTAL & SUBMIT (LIVE CALCULATOR) -->
                        <div class="bg-gray-50 p-5 rounded-3xl border border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-5 shadow-inner">
                            
                            <!-- Counter Kuantitas -->
                            <div>
                                <label class="block text-xs font-extrabold text-gray-500 uppercase mb-1">Jumlah Porsi</label>
                                <div class="inline-flex items-center border-2 border-gray-300 rounded-2xl bg-white px-2 py-1 shadow-sm">
                                    <button type="button" onclick="adjustQty(-1)" class="w-8 h-8 flex items-center justify-center text-xl font-black text-gray-600 hover:bg-gray-100 rounded-full">−</button>
                                    <input type="number" id="detailQty" name="quantity" value="1" min="1" max="99" class="w-12 text-center font-black text-lg focus:outline-none" onchange="calculateLiveTotal()">
                                    <button type="button" onclick="adjustQty(1)" class="w-8 h-8 flex items-center justify-center text-xl font-black text-gray-600 hover:bg-gray-100 rounded-full">+</button>
                                </div>
                            </div>

                            <!-- Total Amount Display -->
                            <div class="text-center sm:text-right">
                                <span class="text-xs uppercase font-extrabold text-gray-400 tracking-wider">Total Harga Pesanan</span>
                                <p class="text-3xl font-black text-[#7F0017] tracking-tight">
                                    Rp <span id="liveTotalDisplay">{{ number_format($menuItem->price, 0, ',', '.') }}</span>
                                </p>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="button" onclick="submitCustomizedOrder()" class="w-full sm:w-auto bg-[#7F0017] hover:bg-amber-900 text-white font-black text-base px-9 py-4 rounded-full duration-300 shadow-xl hover:scale-105 flex items-center justify-center gap-2">
                                <img src="{{ asset('img/Icon/Cart.png') }}" class="h-5 w-auto filter invert brightness-0" alt="Cart">
                                <span>Add to Cart</span>
                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

    @include('partials.landing.footer')

    <script>
        const initialMenuPrice = {{ (int) $menuItem->price }};
        let currentSizeExtra = 0;
        let selectedSizeLabel = 'Medium';
        let selectedAddons = []; // list of {name, price}
        let currentQty = 1;

        // Inisialisasi awal jika ada opsi size
        document.addEventListener('DOMContentLoaded', () => {
            const checkedSize = document.querySelector('input[name="size_option"]:checked');
            if (checkedSize) {
                currentSizeExtra = parseInt(checkedSize.dataset.extra) || 0;
                selectedSizeLabel = checkedSize.dataset.label || 'Regular';
            }
            calculateLiveTotal();
        });

        function handleSizeChange(radio) {
            document.querySelectorAll('.size-card').forEach(card => {
                card.classList.remove('border-[#7F0017]', 'bg-red-50', 'text-[#7F0017]');
                card.classList.add('border-gray-200', 'bg-white', 'text-gray-700');
            });

            const parentCard = radio.closest('.size-card');
            parentCard.classList.remove('border-gray-200', 'bg-white', 'text-gray-700');
            parentCard.classList.add('border-[#7F0017]', 'bg-red-50', 'text-[#7F0017]');

            currentSizeExtra = parseInt(radio.dataset.extra) || 0;
            selectedSizeLabel = radio.dataset.label || '';
            calculateLiveTotal();
        }

        function handleSpiceChange(radio) {
            document.querySelectorAll('.spice-card').forEach(card => {
                card.classList.remove('border-[#7F0017]', 'bg-red-50', 'text-[#7F0017]');
                card.classList.add('border-gray-200', 'bg-white', 'text-gray-700');
            });
            const parentCard = radio.closest('.spice-card');
            parentCard.classList.remove('border-gray-200', 'bg-white', 'text-gray-700');
            parentCard.classList.add('border-[#7F0017]', 'bg-red-50', 'text-[#7F0017]');
        }

        function toggleAddon(card, price, addonName) {
            const index = selectedAddons.findIndex(a => a.name === addonName);
            const checkbox = card.querySelector('.addon-checkbox');

            if (index > -1) {
                // Batalkan seleksi
                selectedAddons.splice(index, 1);
                card.classList.remove('border-[#7F0017]', 'bg-red-50/70', 'shadow-md');
                card.classList.add('border-gray-200', 'bg-white');
                checkbox.classList.remove('bg-[#7F0017]', 'border-[#7F0017]');
                checkbox.classList.add('border-gray-300', 'text-transparent');
            } else {
                // Aktifkan seleksi
                selectedAddons.push({ name: addonName, price: price });
                card.classList.remove('border-gray-200', 'bg-white');
                card.classList.add('border-[#7F0017]', 'bg-red-50/70', 'shadow-md');
                checkbox.classList.remove('border-gray-300', 'text-transparent');
                checkbox.classList.add('bg-[#7F0017]', 'border-[#7F0017]');
            }

            calculateLiveTotal();
        }

        function adjustQty(amount) {
            const qtyInput = document.getElementById('detailQty');
            let current = parseInt(qtyInput.value) || 1;
            current = Math.max(1, current + amount);
            qtyInput.value = current;
            currentQty = current;
            calculateLiveTotal();
        }

        function formatRupiah(amount) {
            return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function calculateLiveTotal() {
            const qtyInput = document.getElementById('detailQty');
            currentQty = parseInt(qtyInput.value) || 1;

            const addonsTotal = selectedAddons.reduce((sum, item) => sum + item.price, 0);
            const unitPrice = Math.max(0, initialMenuPrice + currentSizeExtra + addonsTotal);
            const grandTotal = unitPrice * currentQty;

            document.getElementById('liveTotalDisplay').innerText = formatRupiah(grandTotal);
        }

        function submitCustomizedOrder() {
            let notesParts = [];

            // Porsi / Size
            if (selectedSizeLabel) {
                notesParts.push('Porsi: ' + selectedSizeLabel);
            }

            // Sweetness
            const sweetness = document.getElementById('sweetnessSelect');
            if (sweetness) {
                notesParts.push('Manis: ' + sweetness.value);
            }

            // Ice
            const ice = document.getElementById('iceSelect');
            if (ice) {
                notesParts.push('Es: ' + ice.value);
            }

            // Spice
            const checkedSpice = document.querySelector('input[name="spice_option"]:checked');
            if (checkedSpice) {
                notesParts.push('Kepedasan: ' + checkedSpice.value);
            }

            // Seasoning
            const seasoning = document.getElementById('seasoningSelect');
            if (seasoning) {
                notesParts.push('Bumbu: ' + seasoning.value);
            }

            // Add-ons
            if (selectedAddons.length > 0) {
                const addonNames = selectedAddons.map(a => a.name).join(', ');
                notesParts.push('Add-ons: ' + addonNames);
            }

            // Catatan pembeli
            const custNotes = document.getElementById('customerNotesInput').value.trim();
            if (custNotes) {
                notesParts.push('Catatan: ' + custNotes);
            }

            document.getElementById('finalNotes').value = notesParts.join(' | ');
            document.getElementById('addToCartForm').submit();
        }

        function toggleLike(btn) {
            btn.classList.toggle('scale-125');
            setTimeout(() => btn.classList.remove('scale-125'), 200);
        }
    </script>
</body>
</html>
