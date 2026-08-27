# LIMS Lite

**Laboratory Inventory Management System** — Sistem manajemen inventaris laboratorium FKG UGM.

Aplikasi web untuk mengelola alat & bahan laboratorium, mulai dari konfigurasi master data,
pencatatan transaksi (peminjaman, supply, permintaan), laporan barang keluar/masuk,
hingga analitik penggunaan.

---

## 🧰 Tech Stack

| Komponen  | Teknologi                          |
|-----------|------------------------------------|
| Backend   | Laravel 11 (PHP 8.3)               |
| Frontend  | Blade + Tailwind CSS v3 + Alpine.js |
| Database  | SQLite (`database/database.sqlite`) |
| Build     | Vite                               |

---

## ✨ Fitur Utama

### 🔐 Autentikasi & Unit
- Login berbasis database (password di-hash dengan `Hash::check`)
- Pemilihan unit kerja (multi-unit)
- Multi role: Super Admin, Admin, Admin Lab, Dosen, Mahasiswa
- **Password default semua akun:** `password123`

### ⚙️ Konfigurasi (Master Data)
CRUD lengkap untuk:
- Unit / Laboratorium
- Satuan
- Jenis Barang
- Jenis Pengguna
- Pengguna
- Supplier

### 🧪 Alat & Bahan
- Data barang per unit, semua barang, dan barang kedaluwarsa (expire)
- CRUD barang

### 🔄 Transaksi
- **Peminjaman** — langsung tercatat (tanpa approval) dan otomatis mengurangi stok
- **Supply** — menambah stok barang
- **Permintaan** — pencatatan permintaan dengan perubahan status
- Penghapusan data peminjaman otomatis mengembalikan stok

### 📊 Laporan & Analitik
- Laporan barang keluar
- Laporan barang masuk
- Dashboard dan analitik (dibaca dari database melalui `DataProvider`)

### 📦 Stok
- Kartu stok berjalan + opname fisik

---

## 🚀 Menjalankan Aplikasi

### Prasyarat
- PHP 8.3+
- Composer 2.x
- Node.js & npm
- SQLite

### Langkah-langkah

```bash
# 1. Install dependensi backend
composer install

# 2. Install dependensi frontend & build assets
npm install
npm run build

# 3. Siapkan database & seed data awal
php artisan migrate:fresh --seed

# 4. Jalankan server
php artisan serve --host=127.0.0.1 --port=8000
```

Buka `http://127.0.0.1:8000` lalu login.

### Akun Default

| Username      | Role        |
|---------------|-------------|
| `admin`       | Super Admin |
| `admin.umum`  | Admin       |
| `lab.anatomi` | Admin Lab   |
| `raka.mhs`    | Mahasiswa   |
| `sri.hartati` | Dosen       |

> Password semua akun: `password123`

---

## 📝 Catatan Environment (Windows / Laragon)

Jika PHP/Composer tidak tersedia di PATH global, awali setiap perintah dengan:

```powershell
$env:Path = "C:\laragon\bin\php\php-8.3.16-Win32-vs16-x64;C:\laragon\bin\composer;" + $env:Path
```

---

## 📂 Struktur Penting

```
app/
├── Http/Controllers/   # Dashboard, Konfigurasi, Barang, Transaksi, Laporan, Analitik, Auth
├── Models/             # Barang, JenisBarang, JenisPengguna, KartuStok, Peminjaman,
│                       # Permintaan, Satuan, Supplier, Supply, Unit, User
└── Support/
    └── DataProvider.php  # Sumber data untuk dashboard, laporan, dan analitik

database/
├── migrations/         # 0000_..._create_lims_tables.php (+ kolom LIMS di users)
└── seeders/
    └── LimsSeeder.php  # Seed data awal (unit, barang, transaksi, akun)

resources/views/
├── layouts/            # app.blade.php & guest.blade.php
├── partials/           # sidebar, topbar, footer
├── components/         # icon.blade.php
├── auth/               # login, register, pilih unit
├── dashboard/
├── konfigurasi/        # CRUD master data
├── barang/
├── transaksi/          # peminjaman, supply, permintaan
├── laporan/
└── analitik/

routes/
└── web.php             # Seluruh route aplikasi
```

---

## 🧱 Perintah Berguna

| Perintah                          | Keterangan                         |
|-----------------------------------|------------------------------------|
| `npm run dev`                     | Build asset mode development (Vite)|
| `npm run build`                   | Build asset produksi               |
| `php artisan migrate:fresh --seed`| Reset database + isi data awal     |
| `php artisan serve`               | Jalankan development server        |
