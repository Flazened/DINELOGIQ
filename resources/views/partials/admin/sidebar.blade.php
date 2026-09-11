    <!-- SIDEBAR -->
    <aside class="w-72 bg-[#201B1B] text-white flex flex-col justify-between shadow-xl z-50 p-6">
        <div>
            <!-- LOGO -->
            <div class="py-6 text-center border-b border-white/10 mb-8">
                <!-- Ganti path gambar dengan path lokal Anda -->
                <img src="{{ asset('img/Logo/Logo-Pure.png') }}" alt="Dinelogiq Logo" class="w-24 mx-auto mb-2 drop-shadow-md">
                <h1 class="title-font text-2xl font-bold tracking-widest text-[#FFF1C7]">ADMIN</h1>
            </div>
            
            <!-- NAV MENU -->
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="flex  tems-center gap-4 py-3.5 px-6 rounded-xl bg-[#7F0017] text-white font-bold shadow-md transition">
                    <i class="fa-solid fa-chart-line text-xl w-6"></i>
                    <span class="text-lg">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.menu') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl hover:bg-white/5 text-gray-300 hover:text-white transition group">
                    <i class="fa-solid fa-utensils text-xl w-6 group-hover:scale-105 transition"></i>
                    <span class="text-lg">Manage Menu</span>
                </a>

                <a href="{{ route('admin.order') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl hover:bg-white/5 text-gray-300 hover:text-white transition group">
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