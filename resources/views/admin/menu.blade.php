<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management - Admin DINELOGIQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        body { font-family: 'Lato', sans-serif; background-color: #EDEDED; }
        .title-font { font-family: 'Cinzel', serif; }
        .input-dark { background-color: #333333; color: #FFFFFF; border: 1px solid #444444; }
        .input-dark:focus { border-color: #7F0017; outline: none; }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-72 bg-[#201B1B] text-white flex flex-col justify-between shadow-xl z-50 p-6">
        <div>
            <!-- LOGO -->
            <div class="py-6 text-center border-b border-white/10 mb-8">
                <img src="{{ asset('img/Logo/Logo-Pure.png') }}" alt="Dinelogiq Logo" class="w-24 mx-auto mb-2 drop-shadow-md">
                <h1 class="title-font text-2xl font-bold tracking-widest text-[#FFF1C7]">ADMIN</h1>
            </div>
            
            <!-- NAV MENU -->
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl hover:bg-white/5 text-gray-300 shadow-md transition">
                    <i class="fa-solid fa-chart-line text-xl w-6"></i>
                    <span class="text-lg">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.menu') }}" class="flex items-center gap-4 py-3.5 px-6 rounded-xl bg-[#7F0017] text-white font-bold transition group">
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

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col overflow-hidden bg-[#EDEDED]">
        
        <!-- HEADER -->
        <header class="h-24 bg-white border-b border-gray-200 px-10 flex justify-between items-center shadow-sm">
            <div class="flex flex-col">
                <h2 class="title-font text-3xl font-bold text-[#7F0017]">Menu Management</h2>
                <p class="text-sm text-gray-400 font-medium">Kelola daftar menu restoran dan status ketersediaan</p>
            </div>

            <!-- USER BADGE -->
            <div class="flex items-center gap-4 bg-[#D9D9D9] px-6 py-2 rounded-full">
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-900 leading-tight">Admin Dinelogiq</p>
                    <p class="text-[11px] font-bold text-[#7F0017]">Super Admin</p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-[#F4C430] flex items-center justify-center bg-white text-[#F4C430]">
                    <i class="fa-solid fa-circle-user text-3xl"></i>
                </div>
            </div>
        </header>

        <!-- CONTAINER CONTENT -->
        <div class="flex-1 overflow-y-auto p-10 space-y-6">
            
            @if(session('success'))
                <div class="p-4 bg-emerald-600 text-white font-bold rounded-2xl shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Top Actions Bar -->
            <div class="flex justify-between items-center">
                <p class="text-gray-600 font-bold">Total: {{ count($menus) }} Menu Terdaftar</p>
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
                            <th class="py-5 px-6 w-16 text-center border-r border-white/20">Id</th>
                            <th class="py-5 px-6">MENU NAME</th>
                            <th class="py-5 px-6">Price</th>
                            <th class="py-5 px-6">CATEGORY</th>
                            <th class="py-5 px-6 text-center">Status</th>
                            <th class="py-5 px-6 text-center">Control</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm font-medium text-gray-700">
                        @forelse($menus as $menu)
                            <tr class="hover:bg-gray-50/70 transition">
                                <td class="py-5 px-6 text-center font-bold text-gray-900 border-r border-gray-200">{{ $menu->id }}</td>
                                <td class="py-5 px-6 text-gray-800 font-bold flex items-center gap-3">
                                    <img src="{{ asset('img/Food/' . ($menu->image ?? 'ShoyuRamen.png')) }}" class="w-10 h-10 object-cover rounded-lg" onerror="this.src='{{ asset('img/Food/ShoyuRamen.png') }}'">
                                    <span>{{ $menu->name }}</span>
                                </td>
                                <td class="py-5 px-6 text-gray-700 font-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                <td class="py-5 px-6 font-bold text-[#004643]">{{ $menu->category->name ?? 'Uncategorized' }}</td>
                                <td class="py-5 px-6 text-center">
                                    <form action="{{ route('admin.menu.toggle.controller', $menu->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-3.5 py-1.5 rounded-full text-xs font-bold border transition {{ $menu->status === 'available' ? 'bg-[#EFFDF1] text-[#3A9764] border-emerald-300 hover:bg-emerald-100' : 'bg-[#FEF2F2] text-[#C10000] border-red-300 hover:bg-red-100' }}">
                                            ● {{ ucfirst($menu->status) }}
                                        </button>
                                    </form>
                                </td>
                                <td class="py-5 px-6">
                                    @php
                                        $menuData = [
                                            'id' => $menu->id,
                                            'name' => $menu->name,
                                            'price' => $menu->price,
                                            'category' => $menu->category->name ?? '',
                                            'status' => $menu->status,
                                            'description' => $menu->description ?? '',
                                            'image' => $menu->image ?? '',
                                        ];
                                    @endphp
                                    <div class="flex items-center justify-center gap-3">
                                        <button type="button" onclick='openEditMenuModal(@json($menuData))' class="w-8 h-8 rounded-lg bg-[#EFF6FF] text-[#2361DC] hover:bg-[#2361DC] hover:text-white flex items-center justify-center transition border border-blue-200" title="Edit Menu">
                                            <i class="fa-regular fa-pen-to-square text-sm"></i>
                                        </button>
                                        <button type="button" onclick='openDeleteMenuModal({{ $menu->id }}, @json($menu->name))' class="w-8 h-8 rounded-lg bg-[#FEF2F2] text-[#C10000] hover:bg-[#C10000] hover:text-white flex items-center justify-center transition border border-red-200" title="Delete Menu">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-500 font-bold">Belum ada menu di database.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- ================== MODAL CREATE / EDIT ================== -->
    <div id="menuModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 px-4 backdrop-blur-sm">
        <div class="w-full max-w-lg rounded-2xl bg-[#262626] shadow-2xl overflow-hidden relative">
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#7F0017] rounded-full pointer-events-none"></div>
            
            <div class="relative p-8">
                <h3 id="modalTitle" class="title-font text-2xl font-bold text-white mb-6">Create a new menu</h3>

                <form id="menuForm" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <div>
                        <label class="block text-sm font-bold text-white mb-1">Menu Name</label>
                        <input id="menuName" name="name" type="text" required placeholder="e.g. Shoyu ramen" class="w-full rounded-lg input-dark px-4 py-3 text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-white mb-1">Price (Rp)</label>
                        <input id="menuPrice" name="price" type="number" required placeholder="e.g. 55000" class="w-full rounded-lg input-dark px-4 py-3 text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-white mb-1">Category</label>
                        <select id="menuCategory" name="category" required class="w-full rounded-lg input-dark px-4 py-3 text-sm font-medium">
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-white mb-1">Image Filename (di public/img/Food/)</label>
                        <input id="menuImage" name="image" type="text" placeholder="e.g. ShoyuRamen.png" class="w-full rounded-lg input-dark px-4 py-3 text-sm font-medium">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-white mb-1">Status</label>
                        <select id="menuStatus" name="status" class="w-full rounded-lg input-dark px-4 py-3 text-sm font-medium">
                            <option value="available">● Available</option>
                            <option value="unavailable">● Unavailable</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button" class="w-36 h-[50px] px-6 py-2.5 bg-[#D9D9D9] text-[#262626] text-sm font-bold rounded-2xl transition hover:bg-[#C4C4C4]" onclick="closeMenuModal()">Cancel</button>
                        <button type="submit" id="modalSubmitBtn" class="w-36 h-[50px] px-8 py-2.5 bg-[#7F0017] text-white text-sm font-bold rounded-2xl transition shadow-md hover:bg-[#BC002C]">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================== MODAL DELETE ================== -->
    <div id="deleteModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 px-4 backdrop-blur-sm">
        <div class="w-full max-w-sm rounded-2xl bg-[#262626] shadow-2xl overflow-hidden p-8 text-center">
            <div class="w-20 h-20 mx-auto bg-[#FF003C] rounded-2xl flex items-center justify-center mb-4">
                <i class="fa-solid fa-trash-can text-3xl text-white"></i>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Delete the item?</h3>
            <p id="deleteItemName" class="text-gray-400 text-sm mb-6"></p>
            
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-center gap-4">
                    <button type="button" class="w-32 h-[50px] px-6 py-2.5 bg-[#D9D9D9] text-[#262626] text-sm font-bold rounded-2xl transition hover:bg-[#C4C4C4]" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="w-32 h-[50px] px-6 py-2.5 bg-[#7F0017] text-white text-sm font-bold rounded-2xl transition shadow-md hover:bg-[#BC002C]">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const menuModal = document.getElementById('menuModal');
        const modalTitle = document.getElementById('modalTitle');
        const menuForm = document.getElementById('menuForm');
        const formMethod = document.getElementById('formMethod');
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');

        function openAddMenuModal() {
            modalTitle.innerText = "Create a new menu";
            menuForm.action = "{{ route('admin.menu-controller.store') }}";
            formMethod.value = "POST";
            document.getElementById('menuName').value = '';
            document.getElementById('menuPrice').value = '';
            document.getElementById('menuImage').value = '';
            document.getElementById('menuStatus').value = 'available';
            
            menuModal.classList.remove('hidden');
            menuModal.classList.add('flex');
        }

        function openEditMenuModal(menu) {
            modalTitle.innerText = "Edit Menu";
            menuForm.action = "/admin/menu-controller/" + menu.id;
            formMethod.value = "PUT";

            document.getElementById('menuName').value = menu.name || '';
            document.getElementById('menuPrice').value = menu.price || '';
            document.getElementById('menuCategory').value = menu.category || '';
            document.getElementById('menuImage').value = menu.image || '';
            document.getElementById('menuStatus').value = menu.status || 'available';
            
            menuModal.classList.remove('hidden');
            menuModal.classList.add('flex');
        }

        function closeMenuModal() {
            menuModal.classList.add('hidden');
            menuModal.classList.remove('flex');
        }

        function openDeleteMenuModal(id, name) {
            deleteForm.action = "/admin/menu-controller/" + id;
            document.getElementById('deleteItemName').innerText = name || '';
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        }

        function closeDeleteModal() {
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
        }

        menuModal.addEventListener('click', function (e) {
            if (e.target === menuModal) closeMenuModal();
        });
        deleteModal.addEventListener('click', function (e) {
            if (e.target === deleteModal) closeDeleteModal();
        });
    </script>
</body>
</html>
