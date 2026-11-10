# Persiapan UKK

## Alur Demo
1. Tampilkan dashboard.
2. Tambah kategori.
3. Tambah kendaraan.
4. Tambah pelanggan.
5. Buat transaksi rental (kendaraan tersedia).
6. Coba sewa kendaraan yang sama (ditolak).
7. Proses pengembalian.
8. Coba hapus transaksi berjalan (ditolak).

## Pertanyaan Penguji
- Bagaimana mencegah double booking? lockForUpdate + status.
- Bagaimana hitung biaya? durasi x harga per hari dari DB.
- Mengapa tidak trust input harga? harga diambil dari kendaraan.

## Yang Masih Perlu Diuji
- Feature tests belum dijalankan.
- Tampilan mobile.
