<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        body { font-family: 'Lato', sans-serif; background-color: #EDEDED; }
        .title-font { font-family: 'Cinzel', serif; }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-[#201B1B] text-white flex flex-col justify-between shadow-xl z-50 p-6">
        <div>
            <!-- LOGO -->
            <div class="py-6 text-center border-b border-white/10 mb-8">
                <!-- Ganti path gambar dengan path lokal Anda -->
                <img src="/img/Logo/logo.png" alt="Dinelogiq Logo" class="w-24 mx-auto mb-2 drop-shadow-md">
                <h1 class="title-font text-2xl font-bold tracking-widest text-[#FFF1C7]">ADMIN</h1>
            </div>
            
            <!-- NAV MENU -->
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl bg-[#7F0017] text-white font-bold shadow-md transition">
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

        <!-- SIGN OUT BUTTON -->
        <div>
            <a href="#" class="flex items-center justify-center gap-3 py-3.5 px-6 rounded-xl bg-[#7F0017] hover:bg-[#BC002C] text-white font-bold transition shadow-md">
                <i class="fa-solid fa-right-from-bracket text-lg"></i>
                <span class="text-lg">Sign Out</span>
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col overflow-hidden bg-[#EDEDED]">
        
        <!-- HEADER -->
        <header class="h-24 bg-white border-b border-gray-200 px-10 flex justify-between items-center shadow-sm">
            <div class="flex flex-col">
                <h2 class="title-font text-3xl font-bold text-[#7F0017]">Dashboard</h2>
                <p class="text-sm text-gray-400 font-medium">Welcome back, flazened!</p>
            </div>

            <!-- USER BADGE -->
            <div class="flex items-center gap-4 bg-[#D9D9D9] px-6 py-2 rounded-full">
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-900 leading-tight">flazened</p>
                    <p class="text-[11px] font-bold text-[#7F0017]">Super Admin</p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-[#F4C430] flex items-center justify-center bg-white text-[#F4C430]">
                    <i class="fa-solid fa-circle-user text-3xl"></i>
                </div>
            </div>
        </header>

        <!-- DASHBOARD CONTENT -->
        <div class="flex-1 overflow-y-auto p-10 space-y-8">
            
            <!-- STAT CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Total Menu -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider">TOTAL MENU</h3>
                        <p class="text-4xl font-extrabold text-gray-900 mt-1">20</p>
                    </div>
                    <div class="w-12 h-12 bg-[#cfddff] rounded-xl flex items-center justify-center text-[#1f3c88]">
                        <i class="fa-solid fa-user-group text-lg"></i>
                    </div>
                </div>

                <!-- Card 2: Total Active Order -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 card-hover flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider">TOTAL Active Order</h3>
                        <p class="text-4xl font-extrabold text-gray-900 mt-1">8</p>
                    </div>
                    <div class="w-12 h-12 bg-[#fffae9] rounded-xl flex items-center justify-center text-[#F4C430]">
                        <i class="fa-solid fa-palette text-lg"></i>
                    </div>
                </div>

                <!-- Card 3: System Status -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border-2 border-[#02ff02] card-hover flex justify-between items-center">
                    <div>
                        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider">SYSTEM STATUS</h3>
                        <p class="text-3xl font-extrabold text-[#12d700] mt-1">Active</p>
                    </div>
                    <div class="w-12 h-12 bg-[#e1ffdb] rounded-xl flex items-center justify-center text-[#12d700]">
                        <i class="fa-solid fa-circle-check text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- WELCOME BANNER -->
            <div class="bg-[#f8f8f8] rounded-3xl shadow-sm p-12 border border-gray-200/60 relative overflow-hidden">
                <!-- Background Accents -->
                <div class="absolute -right-16 -bottom-16 w-80 h-80 bg-gray-200/50 rounded-full pointer-events-none"></div>
                <div class="absolute -left-12 -bottom-12 w-48 h-48 bg-[#fff1c7] rounded-full pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col items-center text-center">
                    <!-- Icon Shield -->
                    <div class="w-16 h-16 bg-[#7F0017] rounded-2xl flex items-center justify-center mb-6 shadow-md">
                        <i class="fa-solid fa-shield-halved text-2xl text-[#F4C430]"></i>
                    </div>

                    <h3 class="title-font text-3xl font-bold text-[#7F0017] mb-2">Dinelogiq Control Center</h3>
                    <p class="text-gray-600 text-lg italic mb-8">
                        "Inspiring creativity and managing excellence."
                    </p>

                    <!-- Banner Buttons -->
                    <div class="flex gap-4">
                        <a href="#" class="bg-[#7F0017] text-white px-8 py-2.5 rounded-full font-bold hover:bg-[#BC002C] transition shadow-md">
                            System Logs
                        </a>
                        <a href="#" class="bg-transparent border border-[#1f3c88] text-[#1f3c88] px-8 py-2.5 rounded-full font-bold hover:bg-white transition">
                            Settings
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>