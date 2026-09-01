<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Admin</title>
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
                
                <a href="{{ route('admin.menu') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl bg-[#7F0017] text-white hover:text-white font-bold transition group">
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

        <!-- CONTAINER CONTENT -->
        <div class="flex-1 overflow-y-auto p-10 space-y-6">
            
            <!-- Top Actions Bar -->
            <div class="flex justify-end">
                <button type="button" 
                        onclick="openAddMenuModal()"
                        class="flex items-center gap-2 bg-[#7F0017] hover:bg-[#BC002C] text-white px-7 py-3 rounded-full font-bold text-xs tracking-wider shadow-md transition">
                    <i class="fa-solid fa-plus text-sm"></i>
                    <span>ADD MENU</span>
                </button>
            </div>

            <!-- Table Card Container -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-300/60 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#7F0017] text-white text-xs tracking-wider uppercase font-bold">
                            <th class="py-5 px-8 w-20 text-center border-r border-white/20">Id</th>
                            <th class="py-5 px-8">MENU NAME</th>
                            <th class="py-5 px-8">Price</th>
                            <th class="py-5 px-8">CATEGORY</th>
                            <th class="py-5 px-8 text-center">Status</th>
                            <th class="py-5 px-8 text-center">Control</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm font-medium text-gray-700">
                        <!-- Menu Item 1 -->
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-6 px-8 text-center font-bold text-gray-900 border-r border-gray-200">1</td>
                            <td class="py-6 px-8 text-gray-600">Edamame</td>
                            <td class="py-6 px-8 text-gray-600">Rp12.650</td>
                            <td class="py-6 px-8 font-bold text-[#004643]">Appetizer</td>
                            <td class="py-6 px-8 text-center">
                                <select class="bg-[#FEF2F2] text-[#C10000] text-xs font-semibold px-3 py-1.5 rounded-full outline-none border border-[#FFDEDE] cursor-pointer">
                                    <option value="unavailable" selected>Unavailable</option>
                                    <option value="available">Available</option>
                                </select>
                            </td>
                            <td class="py-6 px-8">
                                <div class="flex items-center justify-center gap-3">
                                    <button onclick='openEditMenuModal({"id": 1, "name": "Edamame", "price": 12650, "category": "Appetizer", "status": "unavailable"})' class="w-8 h-8 rounded-lg bg-[#EFF6FF] text-[#2361DC] hover:bg-[#2361DC] hover:text-white flex items-center justify-center transition border border-blue-200">
                                        <i class="fa-regular fa-pen-to-square text-sm"></i>
                                    </button>
                                    <button onclick='openDeleteMenuModal(1)' class="w-8 h-8 rounded-lg bg-[#FEF2F2] text-[#C10000] hover:bg-[#C10000] hover:text-white flex items-center justify-center transition border border-red-200">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Menu Item 2 -->
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="py-6 px-8 text-center font-bold text-gray-900 border-r border-gray-200">2</td>
                            <td class="py-6 px-8 text-gray-600">Shoyu Ramen</td>
                            <td class="py-6 px-8 text-gray-600">Rp55.000</td>
                            <td class="py-6 px-8 font-bold text-[#004643]">Main dish</td>
                            <td class="py-6 px-8 text-center">
                                <select class="bg-[#EFFDF1] text-[#3A9764] text-xs font-semibold px-3 py-1.5 rounded-full outline-none border border-emerald-200 cursor-pointer">
                                    <option value="available" selected>Available</option>
                                    <option value="unavailable">Unavailable</option>
                                </select>
                            </td>
                            <td class="py-6 px-8">
                                <div class="flex items-center justify-center gap-3">
                                    <button onclick='openEditMenuModal({"id": 2, "name": "Shoyu Ramen", "price": 55000, "category": "Main dish", "status": "available"})' class="w-8 h-8 rounded-lg bg-[#EFF6FF] text-[#2361DC] hover:bg-[#2361DC] hover:text-white flex items-center justify-center transition border border-blue-200">
                                        <i class="fa-regular fa-pen-to-square text-sm"></i>
                                    </button>
                                    <button onclick='openDeleteMenuModal(2)' class="w-8 h-8 rounded-lg bg-[#FEF2F2] text-[#C10000] hover:bg-[#C10000] hover:text-white flex items-center justify-center transition border border-red-200">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- ================== MODAL CREATE / EDIT (DESAIN FIGMA) ================== -->
    <div id="menuModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 px-4 backdrop-blur-sm">
        <div class="w-full max-w-lg rounded-2xl bg-[#262626] shadow-2xl overflow-hidden relative">
            <!-- Ornamen merah di pojok kanan atas -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#7F0017] rounded-full pointer-events-none"></div>
            
            <div class="relative p-8">
                <h3 id="modalTitle" class="title-font text-2xl font-bold text-white mb-6">Create a new menu</h3>

                <form id="menuForm" class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-white mb-1">Menu Name</label>
                        <input id="menuName" name="name" type="text" required placeholder="e.g. Shoyu ramen" class="w-full rounded-lg input-dark px-4 py-3 text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-white mb-1">Price</label>
                        <input id="menuPrice" name="price" type="number" required placeholder="Rp ..." class="w-full rounded-lg input-dark px-4 py-3 text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-white mb-1">Category</label>
                        <select id="menuCategory" name="category" required class="w-full rounded-lg input-dark px-4 py-3 text-sm font-medium">
                            <option value="Appetizer">Appetizer</option>
                            <option value="Main dish">Main dish</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Beverage">Beverage</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-white mb-1">Status</label>
                        <select id="menuStatus" name="status" class="w-full rounded-lg input-dark px-4 py-3 text-sm font-medium">
                            <option value="available">● Available</option>
                            <option value="unavailable">● Unavailable</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-6">
                        <button type="button" class="w-40 h-[60px] px-6 py-2.5 bg-[#D9D9D9] text-[#262626] text-sm font-bold rounded-2xl transition hover:bg-[#C4C4C4]" onclick="closeMenuModal()">Cancel</button>
                        <button type="button" class="w-40 h-[60px] px-8 py-2.5 bg-[#7F0017] text-white text-sm font-bold rounded-2xl transition shadow-md hover:bg-[#BC002C]" onclick="closeMenuModal()">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================== MODAL DELETE (DESAIN FIGMA) ================== -->
    <div id="deleteModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 px-4 backdrop-blur-sm">
        <div class="w-full max-w-sm rounded-2xl bg-[#262626] shadow-2xl overflow-hidden p-8 text-center">
            <div class="w-20 h-20 mx-auto bg-[#FF003C] rounded-2xl flex items-center justify-center mb-4">
                <i class="fa-solid fa-trash-can text-3xl text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-6">Delete the item?</h3>
            
            <div class="flex justify-center gap-4">
                <button type="button" class="w-40 h-[60px] px-6 py-2.5 bg-[#D9D9D9] text-[#262626] text-sm font-bold rounded-2xl transition hover:bg-[#C4C4C4]" onclick="closeDeleteModal()">Cancel</button>
                <button type="button" class="w-40 h-[60px] px-8 py-2.5 bg-[#7F0017] text-white text-sm font-bold rounded-2xl transition shadow-md hover:bg-[#BC002C]" onclick="closeDeleteModal()">Delete</button>
            </div>
        </div>
    </div>

    <script>
        const menuModal = document.getElementById('menuModal');
        const modalTitle = document.getElementById('modalTitle');

        const deleteModal = document.getElementById('deleteModal');

        function openAddMenuModal() {
            modalTitle.innerText = "Create a new menu";
            document.getElementById('menuName').value = '';
            document.getElementById('menuPrice').value = '';
            document.getElementById('menuCategory').value = 'Main dish';
            document.getElementById('menuStatus').value = 'available';
            
            menuModal.classList.remove('hidden');
            menuModal.classList.add('flex');
            document.body.classList.add('modal-open');
        }

        function openEditMenuModal(menu) {
            modalTitle.innerText = "Edit an menu";
            document.getElementById('menuName').value = menu.name || '';
            document.getElementById('menuPrice').value = menu.price || '';
            document.getElementById('menuCategory').value = menu.category || 'Main dish';
            document.getElementById('menuStatus').value = menu.status || 'available';
            
            menuModal.classList.remove('hidden');
            menuModal.classList.add('flex');
            document.body.classList.add('modal-open');
        }

        function closeMenuModal() {
            menuModal.classList.add('hidden');
            menuModal.classList.remove('flex');
            document.body.classList.remove('modal-open');
        }

        function openDeleteMenuModal(id) {
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
            document.body.classList.add('modal-open');
        }

        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
            document.body.classList.remove('modal-open');
        }

        menuModal.addEventListener('click', function (event) {
            if (event.target === menuModal) {
                closeMenuModal();
            }
        });

        deleteModal.addEventListener('click', function (event) {
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>