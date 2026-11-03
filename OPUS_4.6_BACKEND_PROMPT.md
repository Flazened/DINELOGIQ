# MASTER PROMPT: DINELOGIQ BACKEND IMPLEMENTATION (CLAUDE OPUS 4.6)

> **ROLE & MISSION**
> Anda adalah Senior Backend Engineer & Laravel Architect kelas dunia yang bekerja dengan agen AI Claude Opus 4.6.
> Tugas Anda adalah mengimplementasikan backend Laravel secara penuh dan permanen pada repository **DINELOGIQ** agar alur **Product Discovery → Guest Cart → Checkout → Order Storage → Admin Order & Menu Management** berfungsi 100% terkoneksi dengan database, **tanpa merusak, menghapus, atau mengubah desain antarmuka (UI/UX) Blade dan styling Tailwind yang sudah selesai**.

---

## ⚠️ PERATURAN KRITIS (NON-NEGOTIABLE RULES)

1. **JANGAN MERUSAK FRONTEND**:
   - Seluruh Blade view (`landing/menu.blade.php`, `landing/cart.blade.php`, `landing/detail.blade.php`, `admin/dashboard.blade.php`, `admin/menu.blade.php`, `admin/order.blade.php`, dll.) sudah memiliki styling visual, warna brand, hierarki layout, dan elemen visual yang sudah disetujui.
   - Jangan menulis ulang tampilan dari awal. Cukup hubungkan data dinamis (`@foreach`, `{{ $variable }}`), sematkan form action/CSRF token, atur atribut `name` pada input field, dan pastikan interaktivitas JavaScript tetap berjalan selaras dengan respon server.
2. **GUEST ORDERING FIRST**:
   - Pelanggan **TIDAK DIWAJIBKAN** registrasi atau login untuk memesan makanan.
   - Keranjang belanja (cart) berbasis session (`session('cart')`).
   - Riwayat pesanan lokal tamu dilacak menggunakan `session_id` atau nomor order unik (`order_number`).
3. **CASE-SENSITIVE ASSETS**:
   - Direktori gambar `public/img/Food/` menggunakan format PascalCase pada nama file (contoh: `Edamame.png`, `ShoyuRamen.png`, `MisoSoup.png`, `KakiGori.png`, `HotOcha.png`, `Genmaicha.png`, `HokkaidoRamen.png`). Jangan mengubah nama file di disk menjadi lowercase/kebab-case, dan pastikan string yang disimpan di database sama persis dengan file di filesystem.
4. **HARGA & INTEGRITAS TRANSAKSI (PRICE SNAPSHOT)**:
   - Jangan pernah mempercayai harga yang dikirim dari browser/klien saat checkout.
   - Harga item wajib diambil (snapshot) langsung dari database tabel `menu_items` pada saat order disimpan ke tabel `order_items`.
   - Gunakan `DB::transaction(...)` untuk memastikan pembuatan header order dan detail order item terjadi secara atomik.

---

## DOKUMEN REFERENSI TEKNIS

Baca dan patuhi arsitektur yang telah diuraikan pada file:
👉 [`BACKEND_IMPLEMENTATION_NOTES.md`](file:///home/flazened/Projects/Code/Project/School/DINELOGIQ/BACKEND_IMPLEMENTATION_NOTES.md)

---

## INSTRUKSI KERJA BERTAHAP (STEP-BY-STEP EXECUTION)

### TAHAP 1: AUDIT REPOSITORY & LINGKUNGAN KERJA
1. Periksa file konfigurasi `.env`, `docker-compose.yml`, dan `composer.json`.
   - Pastikan koneksi database berjalan (apakah SQLite untuk pengujian cepat atau MariaDB `dinelogiq` sesuai Docker environment).
   - Pastikan migrasi default Laravel (`users`, `cache`, `jobs`) sudah siap.
2. Audit direktori:
   - `app/Http/Controllers/Guest/` dan `app/Http/Controllers/Admin/`
   - `resources/views/landing/` dan `resources/views/admin/`
   - `public/img/Food/`, `public/img/Icon/`, `public/img/Background/`, `public/img/Logo/`
3. Catat nama route pada `routes/web.php` dan pastikan tidak ada route yang dihapus atau dipatahkan.

---

### TAHAP 2: DATABASE SCHEMA & ELOQUENT MODELS
Buat migrasi dan model Eloquent yang tepat dan terelasi:

1. **Migration: `create_categories_table`**
   - `id`: unsigned big integer primary key
   - `name`: string(50) (e.g. 'Appetizer', 'Main Course', 'Side Dish', 'Dessert', 'Hot drinks', 'Cold Drinks')
   - `slug`: string(60) unique
   - `label`: string(100) nullable (e.g. 'APPETIZERS - GOURMET BITES')
   - `icon`: string(100) nullable (e.g. 'Menu-1.png')
   - `sort_order`: integer default 0
   - `timestamps`

2. **Migration: `create_menu_items_table`**
   - `id`: unsigned big integer primary key
   - `category_id`: foreignId constrained to `categories` on delete cascade
   - `name`: string(100)
   - `slug`: string(120) unique
   - `description`: text nullable
   - `price`: unsigned integer (harga dalam Rupiah)
   - `image`: string(100) (nama file gambar di `public/img/Food/`)
   - `status`: enum('available', 'unavailable')->default('available')
   - `timestamps`

3. **Migration: `create_orders_table`**
   - `id`: unsigned big integer primary key
   - `order_number`: string(40) unique (format: `ORD-YYYYMMDD-XXXXXX`)
   - `customer_name`: string(100)
   - `customer_phone`: string(30)
   - `table_number`: unsignedTinyInteger
   - `payment_method`: string(30) (e.g. 'e-money', 'visa', 'bca', 'dana', 'cash', 'qris')
   - `total_amount`: unsigned integer
   - `status`: enum('pending', 'processing', 'completed', 'cancelled')->default('pending')
   - `notes`: text nullable
   - `session_id`: string(100) nullable indexed (untuk melacak riwayat pesanan tamu)
   - `timestamps`

4. **Migration: `create_order_items_table`**
   - `id`: unsigned big integer primary key
   - `order_id`: foreignId constrained to `orders` on delete cascade
   - `menu_item_id`: foreignId constrained to `menu_items` on delete restrict
   - `menu_item_name`: string(100) (snapshot nama produk)
   - `menu_item_price`: unsigned integer (snapshot harga produk saat dibeli)
   - `quantity`: unsignedSmallInteger
   - `subtotal`: unsigned integer
   - `notes`: text nullable
   - `timestamps`

5. **Models**:
   - `App\Models\Category`: Relasi `hasMany(MenuItem::class)`
   - `App\Models\MenuItem`: Relasi `belongsTo(Category::class)`, `scopeAvailable()`
   - `App\Models\Order`: Relasi `hasMany(OrderItem::class)`
   - `App\Models\OrderItem`: Relasi `belongsTo(Order::class)`, `belongsTo(MenuItem::class)`

6. **Database Seeders**:
   - Buat seeder dengan data menu kanonikal yang mencocokkan gambar aktual di `public/img/Food/`:
     - **Appetizer**: Edamame (Rp 12.650, `Edamame.png`)
     - **Main Course**: Shoyu ramen (Rp 55.000, `ShoyuRamen.png`), Hokkaido Ramen (Rp 57.000, `HokkaidoRamen.png`)
     - **Side Dish**: Miso soup (Rp 15.000, `MisoSoup.png`)
     - **Dessert**: Kakigori (Rp 20.000, `KakiGori.png`)
     - **Hot drinks**: Hot ocha (Rp 8.000, `HotOcha.png`)
     - **Cold Drinks**: Genmaicha (Rp 10.000, `Genmaicha.png`)
   - Daftarkan seeder di `DatabaseSeeder.php` dan jalankan migrasi seeder.

---

### TAHAP 3: PRODUCT & MENU INTEGRATION
1. Refactor `App\Http\Controllers\Guest\MenuController`:
   - Ambil data kategori beserta item menunya yang berstatus `'available'` dari database menggunakan Eloquent eager loading (`Category::with(['menuItems' => fn($q) => $q->available()])->orderBy('sort_order')->get()`).
   - Sediakan format variabel yang kompatibel dengan Blade: `$menus`, `$categoryLabels`, `$categories`, dan `$cartCount`.
   - Implementasikan method `show($id)` untuk menampilkan detail menu tertentu (`landing/detail.blade.php`), mengambil data item dinamis dari database.
2. Perbarui `resources/views/landing/menu.blade.php`:
   - Ubah looping kategori dan card produk dari yang sebelumnya hardcoded menjadi loop data Eloquent/array dari controller.
   - Pertahankan seluruh styling Tailwind CSS (kelas ukuran, border, background `#201B1B`, kartu putih, hover scale).
   - Tampilkan badge jumlah item cart secara dinamis sesuai isi session.
   - Sambungkan link kartu menu ke route detail menu (`route('menu.show', $item->id)`).
3. Perbarui `resources/views/landing/detail.blade.php`:
   - Buat halaman menampilkan nama, harga, deskripsi, dan gambar produk terpilih dari database.
   - Sediakan form POST ke `route('cart.add')` dengan CSRF token, `menu_id`, dan `quantity`.

---

### TAHAP 4: GUEST CART IMPLEMENTATION
1. Refactor `App\Http\Controllers\Guest\CartController`:
   - `index()`: Ambil session `cart`. Ambil data produk asli dari tabel `menu_items` berdasarkan ID yang ada di cart. Hitung subtotal tiap item dan total keseluruhan. Jangan gunakan mock array!
   - `add(Request $request)`: Validasi `menu_id` (wajib ada di tabel `menu_items`), `quantity` (min:1). Tambahkan ke session `cart`.
   - `update(Request $request)`: Validasi `menu_id` dan `quantity`. Perbarui jumlah di session `cart`.
   - `remove($id)`: Hapus item dari session `cart`.
   - `clear()`: Kosongkan session `cart`.
2. Adaptasi `resources/views/landing/cart.blade.php`:
   - Jangan merusak modal multi-step checkout yang sudah ada.
   - Ubah list produk di tabel keranjang utama agar me-loop `$items` dari controller.
   - Hubungkan tombol kuantitas (+ / -) dan delete agar mengirimkan request yang valid ke `cart.update` dan `cart.remove`.
   - Sinkronkan ringkasan pesanan (subtotal, estimasi pajak/biaya jika ada, dan total).

---

### TAHAP 5: GUEST CHECKOUT & ORDER PERSISTENCE
1. Tangani Mismatch Form Checkout:
   - Form modal step di `cart.blade.php` memiliki input: First Name, Last Name, Phone Number, Email, City, Address, serta opsi Payment (e-money, visa, bca, dana).
   - Sesuaikan pengiriman form pada step konfirmasi/purchase agar mengirimkan:
     - `customer_name`: gabungan First Name & Last Name (atau sediakan input name yang sesuai).
     - `customer_phone`: nomor telepon yang diinput.
     - `table_number`: sediakan input nomor meja (1-99) yang jelas pada form modal agar pesanan meja restoran tercatat akurat.
     - `payment_method`: nilai metode pembayaran yang dipilih (e-money, visa, bca, dana, cash, qris).
     - `notes`: catatan khusus (opsional).
2. Refactor `App\Http\Controllers\Guest\OrderController@store`:
   - Validasi data input secara ketat di server.
   - Pastikan session `cart` tidak kosong.
   - Mulai `DB::beginTransaction()`.
   - Ambil harga terkini setiap item langsung dari database (`MenuItem::find($id)`).
   - Buat record pada tabel `orders` dengan nomor order unik (misal: `ORD-` + tanggal + random string 6 digit).
   - Buat record pada tabel `order_items` dengan menyimpan snapshot nama menu, harga menu saat ini, quantity, dan subtotal.
   - Hitung total amount final dan simpan.
   - Simpan `session()->getId()` pada order untuk tracking tamu.
   - `DB::commit()`.
   - Kosongkan session `cart`.
   - Redirect ke `route('order.success', $order->id)` dengan pesan sukses.
3. Lengkapi View Pendukung:
   - Sediakan/lengkapilah view `landing/order-success.blade.php`, `landing/order-track.blade.php`, dan `landing/order-history.blade.php` dengan UI bertema DINELOGIQ (warna maroon `#7F0017`, font Poppins/Cinzel, dan ornamen yang serasi) agar flow checkout selesai dengan sempurna.

---

### TAHAP 6: ADMIN MANAGEMENT INTEGRATION
1. `Admin\DashboardController@index`:
   - Hitung statistik riil dari database:
     - Total Menu: `MenuItem::count()`
     - Total Active Orders: `Order::whereIn('status', ['pending', 'processing'])->count()`
     - Total Revenue: `Order::where('status', 'completed')->sum('total_amount')`
   - Teruskan `$stats` ke `admin/dashboard.blade.php` dan tampilkan di kartu metrik.
2. `Admin\MenuManagementController`:
   - `index()`: Ambil semua menu beserta relasi kategorinya dari database (`MenuItem::with('category')->latest()->get()`).
   - `store()`: Validasi nama, harga, category_id, status, dan simpan menu baru ke database.
   - `update()`: Perbarui data menu yang ada.
   - `destroy()`: Hapus menu dari database (atau beri proteksi jika sudah pernah dipesan).
   - `toggleActive()`: Ubah status menu antara `available` dan `unavailable`.
   - Update `resources/views/admin/menu.blade.php` agar modal "ADD MENU", "EDIT", dan "DELETE" mengeksekusi form action ke route admin yang sesuai (`admin.menu-controller.store`, `admin.menu-controller.update`, `admin.menu-controller.destroy`).
3. `Admin\OrderManagementController`:
   - `index()`: Ambil daftar order dari database beserta item-itemnya (`Order::with('items')->latest()->get()`).
   - `updateStatus()`: Terima status baru (`pending`, `processing`, `completed`, `cancelled`) dan simpan perubahan status ke database.
   - Update `resources/views/admin/order.blade.php` agar me-loop data pesanan riil dan dropdown status langsung memicu perubahan status ke server via form patch / AJAX request.

---

### TAHAP 7: TESTING & VALIDASI REGRESI
1. Jalankan test otomatis dengan PHPUnit / Pest:
   - Buat Feature Test: `tests/Feature/GuestOrderFlowTest.php`
     - Test 1: Menambahkan produk ke keranjang belanja (session tersimpan).
     - Test 2: Memperbarui jumlah dan menghapus item dari keranjang.
     - Test 3: Melakukan checkout dan memastikan data tersimpan di tabel `orders` dan `order_items` dengan snapshot harga yang benar.
     - Test 4: Memastikan keranjang belanja kosong setelah checkout selesai.
     - Test 5: Admin dapat melihat pesanan dan mengubah status pesanan.
     - Test 6: Admin dapat menambah, mengubah, dan menghapus menu.
2. Jalankan test suite:
   ```bash
   php artisan test
   ```
3. Verifikasi UI:
   - Buka route `/menu`, `/cart`, `/admin/dashboard`, `/admin/menu`, `/admin/order` untuk memastikan tidak ada error 500, file gambar 404, atau tata letak CSS yang rusak.

---

## FORMAT LAPORAN AKHIR
Setelah selesai melakukan pengerjaan, Opus 4.6 harus melaporkan:
1. Ringkasan migrasi, model, dan controller yang dibuat atau dimodifikasi.
2. Hasil eksekusi `php artisan migrate --seed`.
3. Hasil eksekusi pengujian fitur (`php artisan test`).
4. Konfirmasi bahwa seluruh alur guest checkout telah diuji dan database menyimpan data order secara permanen tanpa merusak frontend.
