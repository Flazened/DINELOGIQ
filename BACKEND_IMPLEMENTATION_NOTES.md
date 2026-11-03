# DINELOGIQ — Backend Implementation Notes

> **Dokumen terakhir diperbarui:** 2026-10-21  
> **Tujuan:** Catatan teknis lengkap untuk mengimplementasikan backend Laravel yang menghubungkan seluruh alur **Menu → Cart → Checkout → Order → Admin Management** ke database, **tanpa merusak frontend yang sudah selesai**.

---

## 1. Kondisi Proyek Saat Ini

### 1.1 Stack Teknologi

| Komponen | Versi / Detail |
|---|---|
| Framework | Laravel `^13.17` |
| PHP | `^8.3` |
| Database (container) | MariaDB `10.11` (docker-compose.yml) |
| Database (.env aktif) | **SQLite** — perlu diubah ke MariaDB |
| Session Driver | `database` |
| Frontend Build | Vite + Tailwind CSS |
| PHPUnit | `^12.5.12` |

### 1.2 Konfigurasi Container (docker-compose.yml)

```yaml
db:
  image: mariadb:10.11
  environment:
    MYSQL_ROOT_PASSWORD: 
    MYSQL_DATABASE: dinelogiq
    MYSQL_USER: root
    MYSQL_PASSWORD: 123
  ports:
    - "3307:3306"

app:
  ports:
    - "8000:8000"
    - "5173:5173"
  environment:
    DB_HOST: db
    DB_PORT: 3306
    DB_DATABASE: dinelogiq
    DB_USERNAME: dinelogiq_user
    DB_PASSWORD: secretpassword

phpmyadmin:
  ports:
    - "8080:80"
```

### 1.3 .env Saat Ini (PERLU DISESUAIKAN)

```env
# KONDISI SEKARANG — SQLite
DB_CONNECTION=sqlite

# HARUS DIUBAH KE (untuk development di container):
DB_CONNECTION=mariadb
DB_HOST=db           # atau 127.0.0.1 jika tanpa container
DB_PORT=3306         # atau 3307 jika dari host ke container
DB_DATABASE=dinelogiq
DB_USERNAME=dinelogiq_user
DB_PASSWORD=secretpassword
```

> **PENTING:** Jika develop tanpa Docker, bisa tetap gunakan SQLite. Migrations harus kompatibel keduanya.

---

## 2. Struktur Direktori Aktual

### 2.1 Controllers

```
app/Http/Controllers/
├── Controller.php
├── AuthController.php                      # Login/logout (stub — belum fungsional)
├── Guest/
│   ├── HomeController.php                  # return view('landing.home')
│   ├── MenuController.php                  # ⚠ DATA MOCK — hardcoded array
│   ├── CartController.php                  # ⚠ DATA MOCK — session + hardcoded $mockMenus
│   ├── OrderController.php                 # ⚠ DATA MOCK — session-only storage
│   ├── DetailController.php                # return view('landing.detail') — hardcoded
│   ├── ContactController.php               # return view('landing.contact')
│   └── LocationController.php              # return view('landing.location')
└── Admin/
    ├── DashboardController.php             # ⚠ DATA MOCK — hardcoded $stats
    ├── MenuManagementController.php         # ⚠ DATA MOCK — hardcoded array, CRUD stubs
    └── OrderManagementController.php        # ⚠ DATA MOCK — hardcoded orders, status stubs
```

### 2.2 Blade Templates

```
resources/views/
├── welcome.blade.php
├── layouts/
│   └── app.blade.php                       # (kosong)
├── partials/
│   ├── landing/
│   │   ├── header.blade.php
│   │   └── footer.blade.php
│   └── admin/
│       ├── header.blade.php
│       └── sidebar.blade.php
├── landing/
│   ├── home.blade.php
│   ├── menu.blade.php                      # Iterasi $menus per kategori
│   ├── cart.blade.php                      # ⚠ Hardcoded Hokkaido Ramen, JS-only checkout
│   ├── detail.blade.php                    # Hardcoded Shoyu Ramen detail
│   ├── contact.blade.php
│   └── location.blade.php
└── admin/
    ├── dashboard.blade.php                 # Hardcoded stats cards
    ├── menu.blade.php                      # Tabel + modal create/edit/delete (JS-only)
    └── order.blade.php                     # Tabel order (hardcoded 2 baris)
```

### 2.3 Database (Saat Ini)

```
database/
├── factories/
│   └── UserFactory.php
├── migrations/
│   ├── 0001_01_01_000000_create_users_table.php
│   ├── 0001_01_01_000001_create_cache_table.php
│   └── 0001_01_01_000002_create_jobs_table.php
└── seeders/
    └── DatabaseSeeder.php
```

**TIDAK ADA** migration untuk `categories`, `menu_items`, `orders`, atau `order_items`.

### 2.4 Models

Hanya `User.php` (default Laravel). **TIDAK ADA** model kustom.

### 2.5 Gambar Aktual di `public/img/`

#### Food/

| Filename | Konteks Penggunaan |
|---|---|
| `Edamame.png` | Menu: Appetizer |
| `ShoyuRamen.png` | Menu: Main Course |
| `ShoyuRamen-Detail.png` | Detail page |
| `MisoSoup.png` | Menu: Side Dish |
| `KakiGori.png` | Menu: Dessert |
| `HotOcha.png` | Menu: Hot Drinks |
| `Genmaicha.png` | Menu: Cold Drinks |
| `HokkaidoRamen.png` | Cart page (hardcoded) |
| `Menu-1.png` ~ `Menu-6.png` | Category filter icons |
| `Home-1.png`, `Home-2.png` | Home page |
| `HomeCombo1.png` ~ `HomeCombo4.png` | Home combo section |
| `Detail-1.png` ~ `Detail-3.png` | Add-ons di detail page |

#### Background/

`BG-Contact-1.png`, `BG-Food-Home.png`, `BG-Footer.png`, `BG-Header-Home.png`, `BG-Home-Chill.png`, `BG-Location-1.png`, `BG-Location-2.png`, `Menu-BG-Map.png`, `Menu-Header-BG.png`, `Orderinway.png`

#### Icon/

`back.png`, `Bca.png`, `Cart.png`, `Contact-location.png`, `Contact-mail.png`, `Contact-telephone.png`, `Dana.png`, `delete.png`, `Done-checkout.png`, `Email.png`, `E-Money.png`, `Home.png`, `Indonesia.png`, `Like.png`, `Location-checkout.png`, `next.png`, `Payment-checkout.png`, `Protect.png`, `search.png`, `Telephone.png`, `VisaCard.png`

#### Logo/

`Call.png`, `Clock.png`, `Facebook.png`, `Gmail.png`, `Instagram.png`, `Location.png`, `Logo-Pure.png`, `Logo-Under.png`, `LogoWithName.png`, `LogoWithNameBlack.png`, `Tiktok.png`, `Twitter.png`, `Whatsapp.png`

---

## 3. Route Map Aktual

### 3.1 Guest Routes

| Method | URI | Route Name | Controller@Method |
|---|---|---|---|
| GET | `/` | — | Closure → `welcome` view |
| GET | `/home` | `home` | `Guest\HomeController@index` |
| GET | `/menu` | `menu` | `Guest\MenuController@index` |
| GET | `/menu/{id}` | `menu.show` | `Guest\MenuController@show` |
| GET | `/cart` | `cart` | `Guest\CartController@index` |
| GET | `/detail` | `detail` | `Guest\DetailController@index` |
| GET | `/location` | `location` | `Guest\LocationController@index` |
| GET | `/contact` | `contact` | `Guest\ContactController@index` |
| POST | `/cart/add` | `cart.add` | `Guest\CartController@add` |
| PUT | `/cart/update` | `cart.update` | `Guest\CartController@update` |
| DELETE | `/cart/remove/{id}` | `cart.remove` | `Guest\CartController@remove` |
| DELETE | `/cart/clear` | `cart.clear` | `Guest\CartController@clear` |
| POST | `/order/store` | `order.store` | `Guest\OrderController@store` |
| GET | `/order/success/{id}` | `order.success` | `Guest\OrderController@success` |
| GET | `/order/track` | `order.track` | `Guest\OrderController@track` |
| GET | `/order/history` | `order.history` | `Guest\OrderController@history` |

### 3.2 Admin Routes

| Method | URI | Route Name | Controller@Method |
|---|---|---|---|
| GET | `/admin/dashboard` | `admin.dashboard` | `Admin\DashboardController@index` |
| GET | `/admin/menu` | `admin.menu` | `Admin\MenuManagementController@index` |
| GET | `/admin/order` | `admin.order` | `Admin\OrderManagementController@index` |
| Resource | `/admin/menu-controller` | `admin.menu-controller.*` | `Admin\MenuManagementController` (except show) |
| PATCH | `/admin/menu-controller/{id}/toggle` | `admin.menu.toggle.controller` | `...@toggleActive` |
| Resource | `/admin/order-controller` | `admin.order-controller.*` | `Admin\OrderManagementController` (except create/edit/show) |
| PATCH | `/admin/order-controller/{id}/status` | `admin.order.status.controller` | `...@updateStatus` |
| GET | `/admin/reports/sales-controller` | `admin.reports.sales.controller` | `...@salesReport` |

---

## 4. Database Schema yang Harus Dibuat

### 4.1 Tabel `categories`

```php
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name', 50);              // 'Appetizer', 'Main Course', dll
    $table->string('slug', 60)->unique();     // 'appetizer', 'main-course'
    $table->string('label')->nullable();      // 'APPETIZERS - GOURMET BITES'
    $table->string('icon')->nullable();       // 'Menu-1.png'
    $table->integer('sort_order')->default(0);
    $table->timestamps();
});
```

### 4.2 Tabel `menu_items`

```php
Schema::create('menu_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
    $table->string('name', 100);
    $table->string('slug', 120)->unique();
    $table->text('description')->nullable();
    $table->unsignedInteger('price');         // dalam Rupiah, tanpa desimal
    $table->string('image')->nullable();      // nama file: 'Edamame.png'
    $table->enum('status', ['available', 'unavailable'])->default('available');
    $table->timestamps();
});
```

### 4.3 Tabel `orders`

```php
Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('order_number', 30)->unique();  // 'ORD-20261021-AB12CD'
    $table->string('customer_name', 100);
    $table->string('customer_phone', 20);
    $table->unsignedTinyInteger('table_number');
    $table->string('payment_method', 20);          // 'cash', 'e-money', 'visa', 'bca', 'dana'
    $table->unsignedInteger('total_amount');
    $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
    $table->text('notes')->nullable();
    $table->string('session_id')->nullable()->index();  // untuk guest tracking
    $table->timestamps();
});
```

### 4.4 Tabel `order_items`

```php
Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
    $table->foreignId('menu_item_id')->constrained('menu_items')->restrictOnDelete();
    $table->string('menu_item_name', 100);           // snapshot nama saat order
    $table->unsignedInteger('menu_item_price');       // snapshot harga saat order
    $table->unsignedSmallInteger('quantity');
    $table->unsignedInteger('subtotal');
    $table->text('notes')->nullable();
    $table->timestamps();
});
```

### 4.5 Entity Relationship

```
categories  1───∞  menu_items
orders      1───∞  order_items
menu_items  1───∞  order_items  (+ snapshot kolom name/price)
```

---

## 5. Eloquent Models yang Harus Dibuat

### 5.1 `Category` Model

```php
// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'label', 'icon', 'sort_order'];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
```

### 5.2 `MenuItem` Model

```php
// app/Models/MenuItem.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description',
        'price', 'image', 'status'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }
}
```

### 5.3 `Order` Model

```php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'customer_name', 'customer_phone',
        'table_number', 'payment_method', 'total_amount',
        'status', 'notes', 'session_id'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
```

### 5.4 `OrderItem` Model

```php
// app/Models/OrderItem.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'menu_item_id', 'menu_item_name',
        'menu_item_price', 'quantity', 'subtotal', 'notes'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }
}
```

---

## 6. Database Seeder

Seeder harus memasukkan data menu yang **persis sesuai** dengan data mock yang ada di controller dan blade saat ini:

```php
// database/seeders/MenuSeeder.php

$categories = [
    ['name' => 'Appetizer',   'slug' => 'appetizer',   'label' => 'APPETIZERS - GOURMET BITES',     'icon' => 'Menu-1.png', 'sort_order' => 1],
    ['name' => 'Main Course', 'slug' => 'main-course',  'label' => "MAIN COURSE - CHEF'S SIGNATURE", 'icon' => 'Menu-2.png', 'sort_order' => 2],
    ['name' => 'Side Dish',   'slug' => 'side-dish',    'label' => "SIDE DISH - PERFECT PAIRING'S",  'icon' => 'Menu-3.png', 'sort_order' => 3],
    ['name' => 'Dessert',     'slug' => 'dessert',      'label' => 'DESSERT - DIVINE ENDINGS',       'icon' => 'Menu-4.png', 'sort_order' => 4],
    ['name' => 'Hot drinks',  'slug' => 'hot-drinks',   'label' => 'HOT DRINKS - WARMING INFUSIONS', 'icon' => 'Menu-5.png', 'sort_order' => 5],
    ['name' => 'Cold Drinks', 'slug' => 'cold-drinks',  'label' => 'COLD DRINKS - CHILLED ELIXIRS',  'icon' => 'Menu-6.png', 'sort_order' => 6],
];

$menuItems = [
    // category_slug => items
    'appetizer'  => [['name' => 'Edamame',      'price' => 12650, 'image' => 'Edamame.png']],
    'main-course'=> [['name' => 'Shoyu ramen',   'price' => 55000, 'image' => 'ShoyuRamen.png']],
    'side-dish'  => [['name' => 'Miso soup',     'price' => 15000, 'image' => 'MisoSoup.png']],
    'dessert'    => [['name' => 'Kakigori',      'price' => 20000, 'image' => 'KakiGori.png']],
    'hot-drinks' => [['name' => 'Hot ocha',      'price' =>  8000, 'image' => 'HotOcha.png']],
    'cold-drinks'=> [['name' => 'Genmaicha',     'price' => 10000, 'image' => 'Genmaicha.png']],
];
```

> **KRITIS:** Nama file gambar harus **case-sensitive** dan sesuai dengan file yang ada di `public/img/Food/`. Misalnya `KakiGori.png` bukan `kakigori.png`.

---

## 7. Alur Guest Cart (Session-Based)

### 7.1 Struktur Session Cart Saat Ini

```php
// Struktur session('cart') yang SUDAH dipakai controller:
session('cart') = [
    menu_item_id => [
        'quantity' => int,
        'notes'    => string
    ],
    // ...
];
```

### 7.2 Alur yang Harus Diimplementasikan

```
[Menu Page] ──POST cart.add──→ [CartController@add]
     │                              │
     │                         Validasi menu_id ada di DB
     │                         Simpan ke session('cart')
     │                              │
     ▼                              ▼
[Cart Page] ←─────────────── [CartController@index]
     │                         Query menu_items dari DB berdasarkan ID di session
     │                         Hitung subtotal & total
     │
     ├─PUT cart.update──→ Update quantity di session
     ├─DELETE cart.remove/{id}──→ Hapus item dari session
     ├─DELETE cart.clear──→ Kosongkan session('cart')
     │
     └─POST order.store──→ [OrderController@store]
                              │
                         Validasi input (customer_name, phone, table_number, payment_method)
                         DB::transaction {
                           1. Ambil menu_items dari DB berdasarkan ID di session
                           2. Buat Order record
                           3. Buat OrderItem records (snapshot harga dari DB)
                           4. Hitung total_amount dari order_items
                         }
                         Kosongkan session('cart')
                         Redirect ke order.success/{order_id}
```

### 7.3 Validasi Add to Cart

Field yang dikirim dari form (sesuai controller saat ini):
- `menu_id` (integer) — ID menu_item
- `quantity` (integer, min:1)
- `notes` (nullable string)

### 7.4 Validasi Checkout (Order Store)

Field yang dikirim (sesuai `OrderController@store` saat ini):
- `customer_name` (required, string, max:100)
- `customer_phone` (required, string, max:20)
- `table_number` (required, integer, min:1, max:99)
- `payment_method` (required, in: cash, e-money, visa, bca, dana)
- `notes` (nullable, string, max:500)

> **CATATAN:** `cart.blade.php` saat ini menggunakan checkout flow di **JavaScript modal** (3 steps). Form field-nya menggunakan `id` attribute bukan `name` attribute. Ini perlu diadaptasi agar form benar-benar submit ke server, ATAU controller menerima AJAX request.

---

## 8. Cart Blade — Kondisi Khusus

### 8.1 Masalah Utama

File `landing/cart.blade.php` (605 baris) **TIDAK** menggunakan data dari controller. Semuanya hardcoded:
- Produk "Hokkaido Ramen" dengan gambar `HokkaidoRamen.png` hardcoded
- Harga Rp 57.000 hardcoded di JavaScript (`const basePrice = 57000`)
- Delivery Rp 7.500 dan Tax Rp 12.000 hardcoded
- Quantity dikelola JavaScript lokal (`increaseQty()`, `decreaseQty()`)
- Checkout flow 3-step semuanya JavaScript modal (tidak submit ke server)
- Input form menggunakan `id` attribute (`firstName`, `lastName`, `phoneNumber`, `email`), bukan `name` attribute
- **Tidak ada** `<form>` tag yang submit ke route
- Step 3 "Purchase" langsung menampilkan "order on the way" tanpa menyimpan apapun

### 8.2 Checkout Form Fields (di Blade saat ini)

**Step 1 — Personal Information:**
- `id="firstName"` — First Name
- `id="lastName"` — Last Name  
- `id="phoneNumber"` — Phone (+62 prefix)
- `id="email"` — Email
- `id="city"` — City (select)
- `id="address"` — Address

**Step 2 — Payment:**
- `name="payment"` radio: `e-money`, `visa`, `bca`, `dana`
- `id="sameAddress"` checkbox

**Step 3 — Success:**
- "Thank you! Your order is on the way."
- Buttons: "Back to Home", "Track Your Order"

### 8.3 Strategi Integrasi

Cart blade perlu diubah agar:
1. **Loop `$items`** dari controller (bukan hardcode Hokkaido Ramen)
2. Quantity +/- menggunakan form submit (POST/PUT) atau AJAX ke `cart.update`
3. Delete menggunakan form DELETE ke `cart.remove/{id}`
4. Checkout "Purchase" button mengirim **hidden form** ke `order.store` dengan:
   - Gabungkan `firstName` + `lastName` → `customer_name`
   - `phoneNumber` → `customer_phone`
   - Tambahkan `table_number` field (saat ini TIDAK ada di form!)
   - `payment` radio → `payment_method`
5. Setelah success, redirect ke `order.success/{id}` (bukan tampilkan step 3 modal)

**HATI-HATI:** Jaga visual CSS dan animasi modal yang sudah ada.

---

## 9. Menu Blade — Kondisi Khusus

### 9.1 Variabel yang Dikirim Controller

Controller saat ini mengirim:
```php
compact('menus', 'categoryLabels', 'categories', 'cartCount')
```

Namun Blade `landing/menu.blade.php` **TIDAK** menggunakan variabel tersebut — menu items hardcoded langsung di HTML per section.

### 9.2 Strategi

Blade `landing/menu.blade.php` harus diubah agar me-loop `$menus` secara dinamis:

```blade
@foreach($menus as $categoryName => $items)
    <div class="mt-30">
        <p class="ml-15 text-5xl text-white">{{ $categoryLabels[$categoryName] }}</p>
        <div class="flex justify-between flex-wrap px-5">
            @foreach($items as $item)
                <section class="bg-white h-130 w-100 rounded-[20px] mt-30 hover:scale-105 duration-300">
                    <a href="{{ route('menu.show', $item->id) }}">
                        <img src="{{ asset('img/Food/' . $item->image) }}" 
                             class="h-90 w-90 ml-5 mt-5 object-cover rounded-2xl" 
                             alt="{{ $item->name }}">
                        <div class="flex px-5 py-10 justify-between">
                            <p class="text-4xl font-bold">{{ $item->name }}</p>
                            <img src="{{ asset('img/Icon/next.png') }}" class="h-8 w-auto">
                        </div>
                    </a>
                </section>
            @endforeach
        </div>
    </div>
@endforeach
```

---

## 10. Admin Pages — Integrasi

### 10.1 Dashboard (`admin/dashboard.blade.php`)

Hardcoded stats: `Total Menu = 20`, `Active Order = 8`, `System Status = Active`

Harus diganti query:
```php
$stats = [
    'total_menu'  => MenuItem::count(),
    'total_order' => Order::whereIn('status', ['pending', 'processing'])->count(),
    'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
];
```

### 10.2 Admin Menu (`admin/menu.blade.php`)

- Tabel saat ini hardcoded 2 row (Edamame, Shoyu Ramen)
- Modal create/edit menggunakan JavaScript (`openAddMenuModal()`, `openEditMenuModal(menu)`, `openDeleteMenuModal(id)`)
- Form button **TIDAK** submit ke server (hanya `closeMenuModal()`)
- Field di modal form: `name`, `price`, `category` (select), `status` (select)
- Category options di modal: `Appetizer`, `Main dish`, `Dessert`, `Beverage` (BERBEDA dari kategori di guest menu!)
- Perlu: Loop `$menus`, form submit ke admin resource routes

### 10.3 Admin Order (`admin/order.blade.php`)

- Tabel hardcoded 2 row (Budi Santoso, Andi Santoso)
- Kolom: Id, Time, Table, Customer, Item, Total, Status
- Status select: `Ongoing`/`Completed` (BERBEDA dari enum di controller: `pending/processing/completed/cancelled`)
- Perlu: Loop `$orders` with items, wire status select change ke `admin.order.status.controller`

---

## 11. Implementasi Checklist

### Phase 1: Foundation

- [ ] Ubah `.env` → `DB_CONNECTION=mariadb` (atau biarkan sqlite untuk dev lokal)
- [ ] Buat migration: `create_categories_table`
- [ ] Buat migration: `create_menu_items_table`
- [ ] Buat migration: `create_orders_table`
- [ ] Buat migration: `create_order_items_table`
- [ ] Jalankan `php artisan migrate`
- [ ] Buat model: `Category`, `MenuItem`, `Order`, `OrderItem`
- [ ] Buat seeder: `CategorySeeder`, `MenuItemSeeder`
- [ ] Jalankan `php artisan db:seed`

### Phase 2: Guest Menu & Cart

- [ ] Ubah `Guest\MenuController@index` → query dari DB, pertahankan format variabel
- [ ] Ubah `Guest\MenuController@show` → query single menu item
- [ ] Ubah `Guest\CartController@index` → query menu_items dari DB berdasarkan session IDs
- [ ] Ubah `Guest\CartController@add` → validasi `menu_id` exists di DB
- [ ] `CartController@update` dan `@remove` — tetap session-based
- [ ] Update `landing/menu.blade.php` agar loop `$menus` dari controller

### Phase 3: Order / Checkout

- [ ] Ubah `Guest\OrderController@store` → `DB::transaction`, buat Order + OrderItems
- [ ] Snapshot harga: ambil `price` dari `menu_items` table, BUKAN dari session
- [ ] Generate `order_number` unik: `'ORD-' . date('Ymd') . '-' . Str::upper(Str::random(6))`
- [ ] Simpan `session()->getId()` di order untuk guest tracking
- [ ] Ubah `@success` → query Order dari DB (bukan session)
- [ ] Ubah `@track` → query Order dari DB by order_number
- [ ] Ubah `@history` → query Orders by session_id
- [ ] Update `landing/cart.blade.php` agar checkout form submit ke `order.store`

### Phase 4: Admin

- [ ] Ubah `Admin\DashboardController@index` → query stats dari DB
- [ ] Ubah `Admin\MenuManagementController@index` → query menu_items with category
- [ ] Wire `@store` → create MenuItem di DB
- [ ] Wire `@update` → update MenuItem di DB
- [ ] Wire `@destroy` → delete MenuItem dari DB
- [ ] Wire `@toggleActive` → toggle status di DB
- [ ] Ubah `Admin\OrderManagementController@index` → query orders with items
- [ ] Wire `@updateStatus` → update order status di DB
- [ ] Wire `@salesReport` → aggregate query dari orders

### Phase 5: Blade Template Updates

- [ ] `landing/menu.blade.php` — loop dari DB data
- [ ] `landing/cart.blade.php` — loop dari `$items`, wire checkout form
- [ ] `landing/detail.blade.php` — dinamis berdasarkan menu_item ID
- [ ] `admin/dashboard.blade.php` — gunakan `$stats` dari DB
- [ ] `admin/menu.blade.php` — loop `$menus`, wire modal forms ke routes
- [ ] `admin/order.blade.php` — loop `$orders`, wire status select

### Phase 6: Testing

- [ ] Feature test: tambah item ke cart via session
- [ ] Feature test: full checkout flow (guest → order tersimpan di DB)
- [ ] Feature test: admin CRUD menu
- [ ] Feature test: admin update order status
- [ ] Regresi: semua halaman guest render tanpa error
- [ ] Regresi: gambar masih muncul (path benar)

---

## 12. Risiko dan Catatan Penting

### 12.1 Jangan Merusak Frontend

- **JANGAN** mengubah nama route yang sudah ada
- **JANGAN** mengubah path gambar di `public/img/`
- **JANGAN** menghapus CSS/JS yang sudah berfungsi
- Setiap perubahan Blade harus memastikan tampilan visual tetap sama

### 12.2 Case Sensitivity Gambar

Nama file di `public/img/Food/` menggunakan PascalCase:
- `ShoyuRamen.png` ✅ bukan `shoyu-ramen.png` ❌
- `KakiGori.png` ✅ bukan `kakigori.png` ❌
- `HotOcha.png` ✅ bukan `hot-ocha.png` ❌

Kolom `image` di database harus menyimpan **nama file persis** seperti di filesystem.

### 12.3 Cart Session vs Checkout Form — MISMATCH

Blade `cart.blade.php` checkout menggunakan JavaScript modal dengan input `id` attributes:
- `firstName`, `lastName`, `phoneNumber`, `email`, `city`, `address` (Step 1)
- `payment` radio buttons: `e-money`, `visa`, `bca`, `dana` (Step 2)

Namun `OrderController@store` validation mengharapkan:
- `customer_name`, `customer_phone`, `table_number`, `payment_method`, `notes`

**Perbedaan kritis:**
1. Form punya `firstName` + `lastName` → controller butuh `customer_name` (gabungkan)
2. Form punya `email`, `city`, `address` → controller **TIDAK** punya field ini
3. Form **TIDAK** punya `table_number` → controller **WAJIB** field ini
4. Form `payment` values: `e-money/visa/bca/dana` → controller expects: `cash,qris` (berbeda!)

**Resolusi:** Selaraskan form dan controller — tambahkan `table_number` ke form, tambahkan `name` attribute ke input fields, update validation rules agar match.

### 12.4 Hokkaido Ramen — Item Fiktif di Cart

`cart.blade.php` hardcode "Hokkaido Ramen" dengan gambar `HokkaidoRamen.png`, tapi item ini **tidak ada** di data menu mock maupun di seeder yang direncakan. File gambar `HokkaidoRamen.png` ada di filesystem.

**Opsi:**
- Tambahkan "Hokkaido Ramen" ke seeder (kategori Main Course, harga 57000) agar konsisten
- Atau ubah cart blade agar sepenuhnya dinamis (dan Hokkaido Ramen hanya muncul jika di-add dari menu)

### 12.5 Admin Category Mismatch

Admin modal form (`admin/menu.blade.php`) category options:
- `Appetizer`, `Main dish`, `Dessert`, `Beverage`

Guest menu categories (controller & blade):
- `Appetizer`, `Main Course`, `Side Dish`, `Dessert`, `Hot drinks`, `Cold Drinks`

**Perlu dikonsolidasikan** — admin form harus load categories dari database, bukan hardcode.

### 12.6 Admin Routes Duplikasi

Ada dua set admin routes:
1. Simple GET: `admin.dashboard`, `admin.menu`, `admin.order`
2. Resource: `admin/menu-controller` dan `admin/order-controller` (full CRUD)

Simple GET routes dipakai di sidebar navigation Blade. Resource routes untuk CRUD actions. Pastikan form di modal submit ke resource route yang benar (`admin.menu-controller.store`, dll).

### 12.7 Missing Blade Templates

Beberapa views yang direferensikan controller **TIDAK ADA** sebagai file:
- `admin.menu-create` (dari `MenuManagementController@create`)
- `admin.menu-edit` (dari `MenuManagementController@edit`)
- `admin.reports-sales` (dari `OrderManagementController@salesReport`)
- `landing.order-success` (dari `OrderController@success`)
- `landing.order-track` (dari `OrderController@track`)
- `landing.order-history` (dari `OrderController@history`)

Ini harus dibuat, ATAU controller diubah agar menggunakan view yang sudah ada (misalnya modal di `admin.menu`).
