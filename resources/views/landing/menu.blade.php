<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DINELOGIQ - MENU</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- ==========================================
         HEADER & HERO SECTION
    ========================================== --}}
    @include('partials.landing.header')
    
    <img src="{{ asset('img/Background/Menu-Header-BG.png') }}" class="w-full" alt="Menu Header Background">

    {{-- ==========================================
         FILTER & SEARCH BAR SECTION
    ========================================== --}}
    <div class="bg-[#F0EDE5] h-40 w-full flex justify-between px-20 items-center">
        <!-- Filter Button -->
        <section class="bg-black w-40 h-20 rounded-[40px] flex justify-center items-center shadow-md">
            <h1 class="text-white text-2xl font-black">Filter</h1>
        </section>
        
        <!-- Search Input -->
        <section class="h-18 w-280 border-3 border-black rounded-[200px] flex items-center justify-between bg-white/70">
            <input 
                id="menuSearchInput"
                class="text-black px-10 text-2xl focus:outline-none w-full bg-transparent" 
                type="text" 
                placeholder="Search for ramen, appetizer, drinks...">
            <img src="{{ asset('img/Icon/search.png') }}" alt="Search Icon" class="mr-10 h-auto w-8">
        </section>
    </div>

    <div class="bg-black w-full h-[1px]"></div>

    {{-- ==========================================
         MENU CATEGORIES SECTION
    ========================================== --}}
    <div class="bg-[#F0EDE5] h-auto pb-16 w-full">
        <p class="text-black flex justify-center py-10 text-4xl font-medium">Find Dishes - Discover Our Menu</p>
        
        <div class="flex justify-center">
            <div class="grid grid-cols-3 gap-8 px-10 max-w-7xl">
                @foreach($categories as $cat)
                    <a href="#category-{{ \Illuminate\Support\Str::slug($cat['name']) }}" class="flex justify-between items-center px-6 rounded-[38px] bg-[#004643] border-5 border-[#667080] h-20 w-80 hover:scale-105 duration-300 shadow-md">
                        <img src="{{ asset('img/Food/' . $cat['icon']) }}" class="h-12 w-auto object-contain" alt="{{ $cat['name'] }} Icon">
                        <p class="text-white font-medium text-[22px]">{{ $cat['name'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ==========================================
         MENU ITEMS LIST SECTION
    ========================================== --}}
    <div class="bg-[#201B1B] h-auto w-auto py-20 px-5">

        <!-- Section Header & Cart -->
        <div class="flex justify-between px-10 items-center mb-10">
            <div class="mx-auto pl-20">
                <p class="text-[#F9FF43] text-7xl font-bold tracking-wide">Our Menu</p>
            </div>
            <a href="{{ route('cart') }}" class="bg-[#004643] h-15 w-32 rounded-[40px] flex items-center justify-center hover:scale-105 duration-300 shadow-lg">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/Icon/Cart.png') }}" class="h-7 w-auto" alt="Cart Icon">
                    <span class="text-white text-[28px] font-bold">{{ $cartCount ?? 0 }}</span>
                </div>
            </a>
        </div>

        @if(session('success'))
            <div class="max-w-4xl mx-auto mb-10 p-4 bg-emerald-700 text-white font-bold rounded-2xl text-center shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Loop Dinamis Kategori dan Menu --}}
        @forelse($menus as $catName => $items)
            <div class="mt-20 category-block" id="category-{{ \Illuminate\Support\Str::slug($catName) }}">
                <p class="ml-15 text-4xl text-white font-semibold tracking-wide border-b border-white/20 pb-4 inline-block">
                    {{ $categoryLabels[$catName] ?? strtoupper($catName) }}
                </p>
                <div class="flex justify-start flex-wrap gap-8 px-10 mt-10">
                    @forelse($items as $item)
                        <section class="menu-card bg-white h-135 w-96 rounded-[24px] hover:scale-105 duration-300 shadow-xl overflow-hidden flex flex-col justify-between" data-name="{{ strtolower($item['name']) }}">
                            <a href="{{ route('detail', ['id' => $item['id']]) }}" class="block p-5">
                                <img src="{{ asset('img/Food/' . $item['image']) }}" 
                                     class="h-72 w-full object-cover rounded-2xl shadow-sm" 
                                     alt="{{ $item['name'] }}"
                                     onerror="this.src='{{ asset('img/Food/ShoyuRamen.png') }}'">
                                <div class="mt-5">
                                    <p class="text-3xl font-bold text-gray-900 leading-tight">{{ $item['name'] }}</p>
                                    <p class="text-2xl font-extrabold text-[#7F0017] mt-2">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                            </a>

                            <div class="px-5 pb-5 flex items-center justify-between pt-2 border-t border-gray-100">
                                <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $item['id'] }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-[#7F0017] hover:bg-amber-900 text-white font-bold text-sm px-5 py-2.5 rounded-full duration-200">
                                        + Add to Cart
                                    </button>
                                </form>
                                <a href="{{ route('detail', ['id' => $item['id']]) }}" class="flex items-center gap-1 text-gray-500 hover:text-black font-semibold text-sm">
                                    <span>Detail</span>
                                    <img src="{{ asset('img/Icon/next.png') }}" class="h-5 w-auto" alt="Next Icon">
                                </a>
                            </div>
                        </section>
                    @empty
                        <p class="text-gray-400 italic ml-15">Belum ada menu di kategori ini.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="text-center py-20">
                <p class="text-white text-3xl font-bold">Katalog menu sedang dipersiapkan.</p>
            </div>
        @endforelse

    </div>

    {{-- ==========================================
         FOOTER SECTION
    ========================================== --}}
    @include('partials.landing.footer')

    <script>
        // Client-side quick filter
        const searchInput = document.getElementById('menuSearchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.toLowerCase().trim();
                const cards = document.querySelectorAll('.menu-card');

                cards.forEach(card => {
                    const name = card.getAttribute('data-name') || '';
                    if (!query || name.includes(query)) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    </script>

</body>
</html>
