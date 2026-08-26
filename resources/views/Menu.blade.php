<!-- resources/views/menu.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dinelogiq — Our Menu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-charcoal font-sans">

    {{-- ================= HERO + NAVBAR ================= --}}
    <header class="bg-maroon px-6 pb-16 pt-6">

        {{-- Navbar --}}
        <nav class="max-w-5xl mx-auto flex justify-center">
            <ul class="flex flex-wrap gap-8 text-paper font-medium text-sm md:text-base">
                <li><a href="#" class="hover:text-gold transition">Home</a></li>
                <li><a href="#" class="text-gold border-b-2 border-gold pb-1">Menu</a></li>
                <li><a href="#" class="hover:text-gold transition">Location</a></li>
                <li><a href="#" class="hover:text-gold transition">Contact</a></li>
                <li><a href="#" class="hover:text-gold transition">About</a></li>
            </ul>
        </nav>

        {{-- Hero content --}}
        <div class="relative max-w-3xl mx-auto text-center mt-10">
            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@latest/assets/svg/1f33f.svg"
                class="hidden md:block absolute -left-24 top-1/2 -translate-y-1/2 w-40 opacity-90 -rotate-12"
                alt="leaf">
            <img src="https://cdn.jsdelivr.net/gh/twitter/twemoji@latest/assets/svg/1f33f.svg"
                class="hidden md:block absolute -right-24 top-1/2 -translate-y-1/2 w-40 opacity-90 rotate-12 scale-x-[-1]"
                alt="leaf">

            {{-- Sumpit: posisi kanan atas teks, miring --}}
            <img src="{{ asset('storage/chopstick.png') }}" alt="Chopstick"
                class="absolute right-18 md:right-22 -top-12 md:-top-14 w-28 md:w-40 rotate-12">

            <h1 class="text-paper text-3xl md:text-5xl font-extrabold italic drop-shadow-lg mt-16 md:mt-20">Welcome to
            </h1>
            <h2 class="text-paper text-2xl md:text-4xl font-black uppercase mt-1 tracking-wide drop-shadow-lg">
                Our Luxurious Menu
            </h2>
            <div class="mt-6 text-6xl">🍜</div>
        </div>
    </header>

    {{-- ================= FILTER & SEARCH ================= --}}
    <section class="bg-[#EFE9DD] px-6 py-8">
        <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-4">
            <button class="bg-ink text-paper font-semibold px-6 py-3 rounded-full whitespace-nowrap">
                Filter
            </button>
            <div class="relative w-full">
                <input type="text" placeholder='What do you want to eat e.g "ramen"'
                    class="w-full bg-paper border border-slate/30 rounded-full pl-5 pr-12 py-3 text-sm text-charcoal placeholder-slate focus:outline-none focus:ring-2 focus:ring-teal">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-slate absolute right-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                </svg>
            </div>
        </div>

        <div class="max-w-4xl mx-auto text-center mt-8">
            <h3 class="text-charcoal font-semibold text-lg mb-6">Find Dishes – Discover Our Menu</h3>

            @php
                $categories = [
                    ['label' => 'Appetizer', 'icon' => '🍤'],
                    ['label' => 'Main course', 'icon' => '🍲'],
                    ['label' => 'Side dish', 'icon' => '🥗'],
                    ['label' => 'Dessert', 'icon' => '🍨'],
                    ['label' => 'Hot drinks', 'icon' => '🍵'],
                    ['label' => 'Cold drink', 'icon' => '🥤'],
                ];
            @endphp

            <div class="flex flex-wrap justify-center gap-4">
                @foreach ($categories as $cat)
                    <button class="category-pill">
                        <span>{{ $cat['icon'] }}</span> {{ $cat['label'] }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= MENU SECTIONS ================= --}}
    <main class="px-6 py-10">

        {{-- Judul + cart --}}
        <div class="max-w-5xl mx-auto flex items-center justify-between mb-10">
            <div></div>
            <h2 class="text-gold text-2xl font-bold text-center flex-1">Our Menu</h2>
            <button class="flex items-center gap-2 bg-teal text-paper px-4 py-2 rounded-full font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                0
            </button>
        </div>

        @php
            $menuSections = [
                [
                    'title' => 'Appetizers – Gourmet Bites',
                    'items' => [
                        ['name' => 'Edamame', 'img' => 'https://placehold.co/400x300/2f4f2f/ffffff?text=Edamame'],
                        ['name' => 'Edamame', 'img' => 'https://placehold.co/400x300/2f4f2f/ffffff?text=Edamame'],
                        ['name' => 'Edamame', 'img' => 'https://placehold.co/400x300/2f4f2f/ffffff?text=Edamame'],
                    ],
                ],
                [
                    'title' => "Main Course – Chef's Signature",
                    'items' => [
                        ['name' => 'Shoyu ramen', 'img' => 'https://placehold.co/400x300/8a5a3b/ffffff?text=Shoyu+Ramen'],
                        ['name' => 'Shoyu ramen', 'img' => 'https://placehold.co/400x300/8a5a3b/ffffff?text=Shoyu+Ramen'],
                        ['name' => 'Shoyu ramen', 'img' => 'https://placehold.co/400x300/8a5a3b/ffffff?text=Shoyu+Ramen'],
                    ],
                ],
                [
                    'title' => "Side Dish – Perfect Pairing's",
                    'items' => [
                        ['name' => 'Miso soup', 'img' => 'https://placehold.co/400x300/1e3a3a/ffffff?text=Miso+Soup'],
                        ['name' => 'Miso soup', 'img' => 'https://placehold.co/400x300/1e3a3a/ffffff?text=Miso+Soup'],
                        ['name' => 'Miso soup', 'img' => 'https://placehold.co/400x300/1e3a3a/ffffff?text=Miso+Soup'],
                    ],
                ],
                [
                    'title' => 'Dessert – Divine Endings',
                    'items' => [
                        ['name' => 'Kakigori', 'img' => 'https://placehold.co/400x300/6b8f47/ffffff?text=Kakigori'],
                        ['name' => 'Kakigori', 'img' => 'https://placehold.co/400x300/6b8f47/ffffff?text=Kakigori'],
                        ['name' => 'Kakigori', 'img' => 'https://placehold.co/400x300/6b8f47/ffffff?text=Kakigori'],
                    ],
                ],
                [
                    'title' => 'Hot Drinks – Warming Infusions',
                    'items' => [
                        ['name' => 'Hot ocha', 'img' => 'https://placehold.co/400x300/6b7a2a/ffffff?text=Hot+Ocha'],
                        ['name' => 'Hot ocha', 'img' => 'https://placehold.co/400x300/6b7a2a/ffffff?text=Hot+Ocha'],
                        ['name' => 'Hot ocha', 'img' => 'https://placehold.co/400x300/6b7a2a/ffffff?text=Hot+Ocha'],
                    ],
                ],
                [
                    'title' => 'Cold Drinks – Chilled Elixirs',
                    'items' => [
                        ['name' => 'Genmaicha', 'img' => 'https://placehold.co/400x300/7a8a5a/ffffff?text=Genmaicha'],
                        ['name' => 'Genmaicha', 'img' => 'https://placehold.co/400x300/7a8a5a/ffffff?text=Genmaicha'],
                        ['name' => 'Genmaicha', 'img' => 'https://placehold.co/400x300/7a8a5a/ffffff?text=Genmaicha'],
                    ],
                ],
            ];
        @endphp

        @foreach ($menuSections as $section)
            <div class="max-w-5xl mx-auto mb-14">
                <h3 class="section-title uppercase">{{ $section['title'] }}</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($section['items'] as $item)
                        <div class="menu-card">
                            <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}">
                            <div class="flex items-center justify-between px-4 py-3">
                                <span class="font-bold text-charcoal">{{ $item['name'] }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-charcoal" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </main>

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-[linear-gradient(180deg,#7F0017_0%,#4a000d_100%)] text-paper px-6 py-10">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center gap-2 font-bold text-lg mb-2">
                    <span>🍥</span> Dinelogiq
                </div>
            </div>

            <div>
                <h4 class="font-bold mb-3">DISCOVER MORE</h4>
                <ul class="space-y-1 text-sm text-paper/80">
                    <li><a href="#" class="hover:text-gold">Home</a></li>
                    <li><a href="#" class="hover:text-gold">Menu</a></li>
                    <li><a href="#" class="hover:text-gold">Location</a></li>
                    <li><a href="#" class="hover:text-gold">About</a></li>
                    <li><a href="#" class="hover:text-gold">Terms & Condition</a></li>
                    <li><a href="#" class="hover:text-gold">Privacy & Policy</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold mb-3">VISIT US IN</h4>
                <p class="text-sm text-paper/80 mb-4">Jl. Sisingamangaraja, Blok 3E</p>
                <h4 class="font-bold mb-1">OPENING HOURS</h4>
                <p class="text-sm text-paper/80 mb-4">Everyday 8AM – 11PM</p>
                <h4 class="font-bold mb-1">CONTACT US</h4>
                <p class="text-sm text-paper/80">082155487766</p>
                <p class="text-sm text-paper/80">dinelogiqon@outlook.co</p>
            </div>
        </div>

        <div class="max-w-5xl mx-auto flex items-center gap-4 mt-8 text-sm text-paper/70">
            <span>Copyright © 2026 Dinelogiq</span>
        </div>
    </footer>

</body>

</html>