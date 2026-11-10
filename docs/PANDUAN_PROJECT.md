# Panduan Project Sistem Rental Kendaraan

## Tujuan Aplikasi
Mengelola kategori, kendaraan, pelanggan, dan transaksi rental kendaraan.

## Teknologi
Laravel 13, MySQL, Laravel Sail, Docker, Blade, Vite.

## Struktur Folder Penting
- app/Http/Controllers
- app/Models
- database/migrations
- resources/views
- routes/web.php

## Cara Menjalankan
1. Buka Docker Desktop.
2. Di WSL: `cd /mnt/c/Users/HP/Documents/Project/sistem-rental`
3. `./vendor/bin/sail up -d`
4. `./vendor/bin/sail artisan migrate`
5. `./vendor/bin/sail npm run dev`

## Migration Aman
Gunakan `./vendor/bin/sail artisan migrate` (tidak menghapus data). Jangan gunakan migrate:fresh/db:wipe.

## Fitur dan Alur
Dashboard -> Kategori -> Kendaraan -> Pelanggan -> Transaksi Rental -> Pengembalian.
