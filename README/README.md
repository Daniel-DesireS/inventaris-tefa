# Inventaris TEFA

## Deskripsi

Aplikasi Inventaris TEFA berbasis Laravel untuk mengelola data barang dan peminjaman.

## Fitur

* Login dan Logout (Laravel Breeze)
* Dashboard Statistik
* CRUD Barang
* CRUD Peminjaman
* Upload Foto Barang
* Pencarian Barang
* Pencarian Peminjaman
* Filter Status Peminjaman
* Notifikasi Stok Menipis
* Pengurangan Stok Otomatis Saat Dipinjam
* Penambahan Stok Otomatis Saat Dikembalikan

## Database

### Tabel Peminjam

* id
* nama_peminjam
* kelas
* jurusan
* no_hp

### Tabel Barang

* id
* nama_barang
* kategori_barang
* stok
* kondisi_barang
* foto

### Tabel Peminjaman

* id
* peminjam_id
* barang_id
* tanggal_pinjam
* tanggal_kembali
* jumlah_pinjam
* status_peminjaman

## Teknologi

* Laravel 12
* Bootstrap 5
* MySQL
* Laravel Breeze
* GitHub

## Cara Menjalankan

1. Clone repository
2. composer install
3. cp .env.example .env
4. php artisan key:generate
5. php artisan migrate --seed
6. php artisan storage:link
7. php artisan serve

## Author

Dimas
