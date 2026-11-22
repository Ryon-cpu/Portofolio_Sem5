# Portofolio Fiqtoril

Website portofolio pribadi bergaya CV untuk menampilkan profil, perjalanan akademik, keahlian, proyek, pencapaian, dan kanal kontak. Aplikasi ini dibuat sebagai proyek pembelajaran dan menyediakan dashboard admin untuk mengelola konten portofolio.

## Fitur

- Tampilan responsif untuk desktop dan perangkat mobile.
- Bagian profil, data diri, ringkasan, keahlian, proyek, pencapaian, dan kontak.
- Animasi mengetik berulang pada headline.
- Tautan kontak langsung dan media sosial.
- Dashboard admin untuk mengelola konten, gambar, dan pesan.
- Backend Laravel dengan penyimpanan konten di database.

## Teknologi

- PHP 8.3+
- Laravel 13
- Vue 3
- Tailwind CSS 4
- Vite 8
- SQLite (konfigurasi awal)

## Persyaratan

- PHP 8.3 atau lebih baru beserta ekstensi yang dibutuhkan Laravel.
- Composer.
- Node.js dan npm.
- SQLite, atau database lain yang didukung Laravel setelah konfigurasi `.env` disesuaikan.

## Instalasi lokal

Jalankan perintah berikut dari folder proyek menggunakan PowerShell:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
if (-not (Test-Path database/database.sqlite)) { New-Item -ItemType File database/database.sqlite }
npm ci
```

Isi variabel admin di `.env` sebelum menjalankan seeder:

```dotenv
ADMIN_NAME="Nama Admin"
ADMIN_EMAIL="admin@example.com"
ADMIN_PASSWORD="gunakan-password-yang-kuat"
```

Lanjutkan dengan migrasi, data awal, tautan penyimpanan, dan build frontend:

```powershell
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

Buka alamat yang ditampilkan oleh `php artisan serve`. Halaman admin tersedia di `/admin`; masuk menggunakan email dan kata sandi admin yang diatur di `.env`.

Untuk pengembangan frontend dengan hot reload, jalankan `npm run dev` di terminal terpisah saat server Laravel aktif.

## Pengujian

```powershell
php artisan test
```

## Catatan keamanan

- Jangan commit file `.env` atau membagikan nilai rahasia di dalamnya.
- Gunakan kata sandi admin yang kuat dan berbeda untuk setiap lingkungan.
- Sebelum deployment, atur `APP_ENV=production`, `APP_DEBUG=false`, kredensial database, dan konfigurasi aplikasi sesuai lingkungan tujuan.
