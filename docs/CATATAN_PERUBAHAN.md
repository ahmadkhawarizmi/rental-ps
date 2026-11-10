# Catatan Perubahan

## File Diubah
- routes/web.php
- resources/views/dashboard.blade.php
- app/Models/Category.php, Vehicle.php, Customer.php
- app/Http/Controllers/CategoryController.php, VehicleController.php, CustomerController.php, RentalTransactionController.php

## Masalah
- Dashboard statis dan link rusak.
- Penghapusan tidak dicegah meskipun data terkait.
- Transaksi tidak menggunakan DB transaction/lock.

## Perbaikan
- Dashboard menampilkan data DB.
- Guard penghapusan kategori/kendaraan/pelanggan.
- Store/update/return menggunakan DB::transaction dan lockForUpdate.

## Pengujian
- php -l lulus.
- php artisan route:list lulus.

## Langkah Manual
- Jalankan sail up dan uji alur secara manual.
