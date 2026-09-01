<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Admin</title>
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl hover:bg-white/5 text-gray-300 shadow-md transition">
                    <i class="fa-solid fa-chart-line text-xl w-6"></i>
                    <span class="text-lg">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.menu') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl hover:bg-white/5 text-gray-300 hover:text-white transition group">
                    <i class="fa-solid fa-utensils text-xl w-6 group-hover:scale-105 transition"></i>
                    <span class="text-lg">Manage Menu</span>
                </a>

                <a href="{{ route('admin.order') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl bg-[#7F0017] text-white hover:text-white font-bold transition group">
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

        <!-- TABLE CONTENT AREA -->
        <div class="flex-1 overflow-y-auto p-10">
            <div class="bg-white rounded-t-2xl rounded-b-lg shadow-sm border border-gray-300 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#7F0017] text-white">
                        <tr>
                            <th class="px-4 py-3.5 title-font tracking-wider text-xs font-bold text-center w-16">Id</th>
                            <th class="px-4 py-3.5 title-font tracking-wider text-xs font-bold text-center">Time</th>
                            <th class="px-4 py-3.5 title-font tracking-wider text-xs font-bold text-center">Table</th>
                            <th class="px-4 py-3.5 title-font tracking-wider text-xs font-bold text-center">Customer</th>
                            <th class="px-4 py-3.5 title-font tracking-wider text-xs font-bold text-center">Item</th>
                            <th class="px-4 py-3.5 title-font tracking-wider text-xs font-bold text-center">Total</th>
                            <th class="px-4 py-3.5 title-font tracking-wider text-xs font-bold text-center">Status</th>
                            <th class="px-4 py-3.5 title-font tracking-wider text-xs font-bold text-center w-20">Control</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-xs font-semibold text-gray-700">
                        
                        <!-- Row 1 -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-5 text-center font-bold text-gray-900 border-r border-gray-200">1</td>
                            <td class="px-4 py-5 text-center text-gray-600 border-r border-gray-200">12.45 WIB</td>
                            <td class="px-4 py-5 text-center text-gray-600 border-r border-gray-200">Table 4</td>
                            <td class="px-4 py-5 text-center text-gray-800 border-r border-gray-200">Budi Santoso</td>
                            <td class="px-4 py-5 text-center text-gray-600 border-r border-gray-200">Shoyu ramen x2, Ocha x1</td>
                            <td class="px-4 py-5 text-center font-bold text-gray-900 border-r border-gray-200">Rp110.000</td>
                            <td class="px-4 py-5 text-center border-r border-gray-200">
                                <div class="relative inline-block">
                                    <select class="appearance-none bg-[#fef3c7] text-[#b45309] font-bold px-3 py-1 pr-6 rounded-full text-[11px] outline-none cursor-pointer border border-amber-200">
                                        <option value="ongoing" selected>Ongoing</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down text-[9px] text-[#b45309] absolute right-2.5 top-2.5 pointer-events-none"></i>
                                </div>
                            </td>
                            <td class="px-4 py-5 text-center">
                                <button type="button" onclick="return confirm('Delete order #1?')" class="w-6 h-6 rounded bg-red-100 text-red-600 hover:bg-red-200 transition inline-flex items-center justify-center text-xs">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-5 text-center font-bold text-gray-900 border-r border-gray-200">2</td>
                            <td class="px-4 py-5 text-center text-gray-600 border-r border-gray-200">13.39 WIB</td>
                            <td class="px-4 py-5 text-center text-gray-600 border-r border-gray-200">Table 1</td>
                            <td class="px-4 py-5 text-center text-gray-800 border-r border-gray-200">Andi Santoso</td>
                            <td class="px-4 py-5 text-center text-gray-600 border-r border-gray-200">Shoyu ramen x1, Gyoza x1</td>
                            <td class="px-4 py-5 text-center font-bold text-gray-900 border-r border-gray-200">Rp75.000</td>
                            <td class="px-4 py-5 text-center border-r border-gray-200">
                                <div class="relative inline-block">
                                    <select class="appearance-none bg-[#dcfce7] text-[#15803d] font-bold px-3 py-1 pr-6 rounded-full text-[11px] outline-none cursor-pointer border border-green-200">
                                        <option value="ongoing">Ongoing</option>
                                        <option value="completed" selected>Completed</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down text-[9px] text-[#15803d] absolute right-2.5 top-2.5 pointer-events-none"></i>
                                </div>
                            </td>
                            <td class="px-4 py-5 text-center">
                                <button type="button" onclick="return confirm('Delete order #2?')" class="w-6 h-6 rounded bg-red-100 text-red-600 hover:bg-red-200 transition inline-flex items-center justify-center text-xs">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>