<header class="relative z-10">
  <!-- Background dengan gradient -->
  <div class="bg-gradient-to-b from-black/70 h-32 bg-[#7F0017]">
    <!-- Navigasi -->
    <nav class="">
      <ul class="conatiner mx-auto justify-center py-6 flex gap-20">
        <li><a href="{{ route('home') }}" class="text-white font-bold text-2xl hover:text-yellow-400 underline-offset-8
            {{ request()->routeIs('home') ? 'underline decoration-amber-300' : ''}}
            ">Home</a></li>
        <li><a href="{{ route('menu') }}" class="text-white font-bold text-2xl hover:text-yellow-400 underline-offset-8
            {{ request()->routeIs('menu') ? 'underline decoration-amber-300' : ''}}
            ">Menu</a></li>
        <li><a href="{{ route('location') }}" class="text-white font-bold text-2xl hover:text-yellow-400 underline-offset-8
            {{ request()->routeIs('location') ? 'underline decoration-amber-300' : ''}}
            ">Location</a></li>
        <li><a href="{{ route('contact') }}" class="text-white font-bold text-2xl hover:text-yellow-400 underline-offset-8
            {{ request()->routeIs('contact') ? 'underline decoration-amber-300' : ''}}
            ">Contact</a></li>
        <li><a href="{{ route('cart') }}" class="text-white font-bold text-2xl hover:text-yellow-400 underline-offset-8
            {{ request()->routeIs('cart') ? 'underline decoration-amber-300' : ''}}
            ">Cart</a></li>
      </ul>
    </nav>
  </div>
</header>