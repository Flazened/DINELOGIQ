<div align="center">

  <h1>🍽️ DINELOGIQ</h1>
  <p><b>A Modern, Intelligent Restaurant Management & POS Solution</b></p>

  <p>
    <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"></a>
    <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"></a>
    <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS"></a>
    <a href="https://podman.io"><img src="https://img.shields.io/badge/Podman-892CA0?style=for-the-badge&logo=podman&logoColor=white" alt="Podman"></a>
    <a href="https://mariadb.org"><img src="https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white" alt="MariaDB"></a>
  </p>

  <p>
    <img src="https://img.shields.io/github/last-commit/Flazened/DINELOGIQ?style=flat-square&color=blue" alt="Last Commit">
    <img src="https://img.shields.io/github/repo-size/Flazened/DINELOGIQ?style=flat-square&color=green" alt="Repo Size">
    <img src="https://img.shields.io/github/license/Flazened/DINELOGIQ?style=flat-square&color=orange" alt="License">
  </p>

  <sub>Streamlining dining management, order workflows, and table logistics in one unified platform.</sub>

</div>

---

---
## 📋 Daftar Isi

- [Teknologi](#-teknologi)
- [Prasyarat](#-prasyarat)
- [Instalasi & Menjalankan dengan Docker/Podman](#-instalasi--menjalankan-dengan-dockerpodman)
- [Mode Pengembangan (Development)](#-mode-pengembangan-development)
- [Mode Produksi (Production)](#-mode-produksi-production)
- [Akses Aplikasi](#-akses-aplikasi)
- [Struktur Proyek](#-struktur-proyek)
- [Troubleshooting](#-troubleshooting)
- [Kontribusi](#-kontribusi)

---

## 🧰 Teknologi

| Teknologi | Keterangan |
|-----------|------------|
| **Laravel 11** | Backend framework PHP |
| **Tailwind CSS v4** | Styling modern dengan utility-first |
| **Vite** | Build tool & hot-reload untuk aset frontend |
| **MariaDB 10.11** | Database management system |
| **phpMyAdmin** | Manajemen database via GUI |
| **Docker / Podman** | Containerization untuk development & production |

---

## ✅ Prasyarat

Pastikan Anda telah menginstal salah satu container engine di bawah ini:

- [Docker](https://docs.docker.com/get-docker/) + [Docker Compose](https://docs.docker.com/compose/install/)
- **ATAU**
- [Podman](https://podman.io/) + [podman-compose](https://github.com/containers/podman-compose)

> **Catatan:** Project ini telah diuji dengan **Podman v4.x** dan **Docker v24.x**.

Port yang dibutuhkan (pastikan tidak ada aplikasi lain yang menggunakan):
- `8000` → Aplikasi Laravel
- `3307` → Database MariaDB (dipetakan dari 3306)
- `8080` → phpMyAdmin

---

## 🚀 Instalasi & Menjalankan dengan Docker/Podman

### 1. Clone repositori
```bash
git clone https://github.com/Flazened/DINELOGIQ.git
cd DINELOGIQ
```

### 2. Siapkan file environment
```bash
cp .env.example .env
```

> **Catatan:** Konfigurasi database di `.env` sudah disesuaikan dengan `docker-compose.yml`. Jangan ubah kecuali Anda tahu apa yang dilakukan.

### 3. Jalankan container

#### 🔵 Menggunakan Docker:
```bash
docker-compose up -d
```

#### 🔴 Menggunakan Podman:
```bash
podman-compose up -d
```

Perintah di atas akan otomatis:
- ✅ Membangun dan menjalankan container untuk **app**, **db**, dan **phpmyadmin**
- ✅ Menginstal dependensi PHP (Composer) dan Node.js (NPM)
- ✅ Menjalankan migrasi database
- ✅ Menjalankan server Laravel di `http://localhost:8000`
- ✅ Menjalankan Vite development server di `http://localhost:5173`

### 4. Akses Aplikasi
Buka browser dan akses: [http://localhost:8000](http://localhost:8000)

---

## 🔧 Mode Pengembangan (Development)

Secara default, project ini berjalan dalam **mode development** dengan fitur **hot-reload** dari Vite.

### Fitur Mode Development:
- ✅ Setiap perubahan pada file `resources/css/app.css` atau `resources/js/app.js` akan langsung terlihat (tanpa refresh manual)
- ✅ Debugging lebih mudah dengan source map
- ✅ Error detail di console browser

### Melihat Log Container:
```bash
# Docker
docker logs -f dinelogiq_app

# Podman
podman logs -f dinelogiq_app
```

### Menghentikan Container:
```bash
# Docker
docker-compose down

# Podman
podman-compose down
```

---

## 🚢 Mode Produksi (Production)

Jika Anda ingin menjalankan aplikasi dalam mode produksi (file CSS/JS di-minify dan di-optimasi), ubah bagian `command` di `docker-compose.yml`:

```yaml
command: >
  sh -c "composer install --no-interaction &&
         npm install &&
         npm run build &&   # ← Ganti dari "npm run dev" menjadi "npm run build"
         php artisan key:generate &&
         php artisan migrate --force &&
         php artisan serve --host=0.0.0.0 --port=8000"
```

Atau jalankan build manual:
```bash
# Masuk ke container
docker exec -it dinelogiq_app bash
# atau
podman exec -it dinelogiq_app bash

# Build untuk production
npm run build
```

---

## 🌐 Akses Aplikasi

| Service | URL | Deskripsi |
|---------|-----|-----------|
| **Aplikasi Utama** | [http://localhost:8000](http://localhost:8000) | Halaman utama Laravel |
| **Vite Dev Server** | [http://localhost:5173](http://localhost:5173) | Server hot-reload aset (hanya development) |
| **phpMyAdmin** | [http://localhost:8080](http://localhost:8080) | Manajemen database via GUI |

### 🔐 Database Credentials (phpMyAdmin)
| Field | Value |
|-------|-------|
| **Username** | `root` |
| **Password** | `root` |

Atau gunakan user khusus:
- **Username:** `dinelogiq_user`
- **Password:** `secretpassword`

---

## 📁 Struktur Proyek

```
DINELOGIQ/
├── app/                    # Kode utama Laravel
│   ├── Http/Controllers/   # Controller
│   ├── Models/             # Model Eloquent
│   └── Providers/          # Service Providers
├── bootstrap/              # Bootstrap Laravel
├── config/                 # File konfigurasi
├── database/               # Migrasi & seeder
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── public/                 # Aset publik
│   └── build/              # Hasil build Vite (CSS & JS)
├── resources/              # Aset frontend
│   ├── css/app.css         # Tailwind CSS v4 dengan @theme
│   ├── js/app.js           # JavaScript entry point
│   └── views/              # Blade templates
│       ├── menu.blade.php
│       └── welcome.blade.php
├── routes/                 # Definisi route
├── storage/                # Storage Laravel
├── tests/                  # Unit & Feature tests
├── .env                    # Environment variables (buat sendiri)
├── .env.example            # Contoh environment variables
├── docker-compose.yml      # Konfigurasi container
├── package.json            # Dependensi Node.js
├── vite.config.js          # Konfigurasi Vite
├── composer.json           # Dependensi PHP
└── README.md               # Dokumentasi ini
```

---

## 🔍 Troubleshooting

### ❌ `vite` command not found
**Solusi:** Jalankan `npm install` di host atau di dalam container.
```bash
docker exec -it dinelogiq_app npm install
```

### ❌ `.env` file not found error
**Solusi:** Copy `.env.example` ke `.env`:
```bash
cp .env.example .env
```

### ❌ Port 8000 sudah digunakan
**Solusi:** Ganti port di `docker-compose.yml`:
```yaml
ports:
  - "8001:8000"  # Ganti 8000 dengan port lain
```

### ❌ Hot reload tidak berjalan
**Solusi:** Pastikan Vite berjalan di container:
```bash
docker exec -it dinelogiq_app ps aux | grep vite
```
Jika tidak ada, restart container:
```bash
docker-compose restart app
```

### ❌ Perubahan CSS tidak muncul
**Solusi:** Force refresh browser (`Ctrl+F5` atau `Cmd+Shift+R`), atau clear cache browser.

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Berikut langkah-langkahnya:

1. Fork repositori ini
2. Buat branch baru (`git checkout -b fitur-anda`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur X'`)
4. Push ke branch (`git push origin fitur-anda`)
5. Buat Pull Request

### Panduan Kontribusi:
- Pastikan kode Anda mengikuti standar PSR-12 (PHP) dan Prettier (JS/CSS)
- Tulis deskripsi yang jelas pada Pull Request
- Test terlebih dahulu di environment development

---

## 📝 Lisensi

Project ini bersifat open-source dan dapat digunakan untuk keperluan belajar atau komersial.

---

## 🙏 Terima Kasih

Dibangun dengan ❤️ menggunakan:
- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Vite](https://vitejs.dev)
- [Docker](https://docker.com) / [Podman](https://podman.io)

---

**DINELOGIQ** — Nikmati pengalaman kuliner Anda! 🍜
```

---

## 📝 Cara Menggunakan README Ini:

1. **Copy** semua kode di atas
2. **Paste** ke file `README.md` di project Anda
3. **Sesuaikan** bagian-bagian yang perlu (misalnya link demo, screenshot, dll)
4. **Commit & Push** ke GitHub

---

## ✨ Keunggulan README Ini:

| Fitur | Keterangan |
|-------|------------|
| ✅ **Docker & Podman** | Support kedua container engine |
| ✅ **Development & Production** | Mode running dijelaskan dengan jelas |
| ✅ **Troubleshooting** | Solusi untuk masalah umum |
| ✅ **Struktur Proyek** | Memudahkan navigasi kode |
| ✅ **Badges** | Tampilan lebih profesional |
| ✅ **Kontribusi** | Panduan untuk contributor |

---
