# Materi Pembelajaran

## Laravel dan MVC
Laravel menggunakan pola MVC: Model (data), View (tampilan), Controller (logika).

## Route, Controller, Model, Migration, Blade
- Route: memetakan URL ke controller (routes/web.php).
- Controller: memproses request dan mengembalikan view.
- Model: representasi tabel (Eloquent).
- Migration: definisi skema database.
- Blade: template view.

## Relasi
Category 1..* Vehicle 1..* RentalTransaction *..1 Customer.

## CRUD dan Validasi
Gunakan $request->validate() dan $fillable.

## Eloquent ORM dan Route-Model Binding
Controller menerima model otomatis dari parameter route.

## Foreign Key
restrictOnDelete mencegah penghapusan data yang masih dipakai.

## Durasi dan Total Biaya
total_days = max(1, diffInDays(rental_date, return_date)); total_price = total_days * price_per_day.

## Status dan Pengembalian
Transaksi berjalan -> selesai; kendaraan disewa -> tersedia.

## Database Transaction
DB::transaction + lockForUpdate menjaga konsistensi.

## Debugging
Baca error, cek log storage/logs/laravel.log, gunakan php -l.
