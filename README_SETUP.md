# Aplikasi Input Lagu - Dokumentasi Setup

## Deskripsi Aplikasi
Aplikasi web untuk input dan manajemen lagu dengan fitur:
- Login/Register dengan 2 role: admin dan petugas_koor
- Dashboard dengan informasi ringkas
- Menu Informasi (CRUD untuk admin, read-only untuk petugas_koor)
- Menu Input Lagu dengan form dan history
- Menu Chat real-time antar user
- Menu Bahan Lagu (khusus admin) dengan fitur pencarian

## Persyaratan Sistem
- PHP 8.1 atau lebih tinggi
- Composer
- Node.js dan NPM
- MySQL/MariaDB
- XAMPP (untuk database lokal)

## Langkah-langkah Instalasi

### 1. Persiapan Environment
```bash
# Pastikan PHP, Composer, dan Node.js sudah terinstall
php --version
composer --version
node --version
npm --version
```

### 2. Setup Database (XAMPP)
1. Jalankan XAMPP Control Panel
2. Start Apache dan MySQL
3. Buka phpMyAdmin (http://localhost/phpmyadmin)
4. Buat database baru dengan nama: `song_input_app`

### 3. Konfigurasi Aplikasi
1. Masuk ke direktori project:
```bash
cd D:\Project\QDev\projectOne
```

2. Install dependencies PHP:
```bash
composer install
```

3. Install dependencies Node.js:
```bash
npm install
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=song_input_app
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database
1. Jalankan migrasi:
```bash
php artisan migrate
```

2. Jalankan seeder untuk membuat user default:
```bash
php artisan db:seed
```

### 5. Build Assets
```bash
npm run build
```

### 6. Menjalankan Aplikasi
1. Start Laravel development server:
```bash
php artisan serve
```

2. Buka browser dan akses: http://localhost:8000

## User Default
Setelah menjalankan seeder, tersedia 2 user default:

### Admin
- Email: admin@example.com
- Password: password
- Role: admin

### Petugas Koordinator
- Email: petugas@example.com
- Password: password
- Role: petugas_koor

## Fitur Aplikasi

### 1. Dashboard
- Menampilkan statistik lagu
- Informasi terbaru
- Quick access ke semua menu

### 2. Menu Informasi
- **Admin**: Dapat create, read, update, delete informasi
- **Petugas Koor**: Hanya dapat melihat informasi
- Upload gambar disimpan dalam database (base64)

### 3. Menu Input Lagu
- Form input dengan validasi (semua field wajib diisi)
- History data per user
- Status: diproses/diterima
- Admin dapat mengubah status lagu

### 4. Menu Chat
- Chat real-time antar user
- Interface seperti aplikasi chat pada umumnya
- Auto-refresh setiap 5 detik

### 5. Menu Bahan Lagu (Admin Only)
- Melihat semua lagu dari semua user
- Fitur pencarian berdasarkan judul lagu, nama petugas, atau tanggal
- Detail lagu dalam modal popup

## Struktur File Penting
```
projectOne/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── InformationController.php
│   │   ├── SongController.php
│   │   └── ChatController.php
│   └── Models/
│       ├── User.php
│       ├── Information.php
│       ├── Song.php
│       └── Chat.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── dashboard.blade.php
│       ├── information/
│       ├── songs/
│       └── chat/
└── routes/
    └── web.php
```

## Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "SQLSTATE[HY000] [1049] Unknown database"
- Pastikan database `song_input_app` sudah dibuat di phpMyAdmin
- Periksa konfigurasi database di file `.env`

### Error: "Vite manifest not found"
```bash
npm run build
```

### Error: "Permission denied"
```bash
# Di Linux/Mac
chmod -R 775 storage bootstrap/cache
```

### Error: "Key not found"
```bash
php artisan key:generate
```

## Pengembangan Lebih Lanjut

### Menambah User Baru
1. Register melalui halaman register
2. Atau tambah manual melalui seeder/tinker

### Backup Database
```bash
# Export dari phpMyAdmin atau command line
mysqldump -u root -p song_input_app > backup.sql
```

### Update Aplikasi
```bash
# Pull changes (jika menggunakan git)
git pull origin main

# Update dependencies
composer install
npm install

# Run migrations
php artisan migrate

# Build assets
npm run build
```

## Catatan Keamanan
- Ganti password default user setelah instalasi
- Jangan gunakan konfigurasi development di production
- Aktifkan HTTPS di production
- Backup database secara berkala

## Support
Jika mengalami masalah, periksa:
1. Log Laravel di `storage/logs/laravel.log`
2. Error log PHP
3. Console browser untuk error JavaScript
4. Pastikan semua service (Apache, MySQL) berjalan di XAMPP
