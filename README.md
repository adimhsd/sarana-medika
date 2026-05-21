# Saranamedika

Sistem informasi berbasis web untuk pengelolaan data dan transaksi internal CV. Sarana Medika.

## Tech Stack

- PHP
- CodeIgniter 2.1.4
- MySQL / MariaDB
- Apache
- Bootstrap 2
- jQuery
- TCPDF untuk PDF
- PHPExcel untuk export Excel

## Fitur Utama

- Login dan autentikasi user
- Manajemen data barang
- Manajemen data customer
- Manajemen data supplier
- Manajemen data pegawai
- Pembelian dan penjualan
- Cetak laporan PDF
- Export laporan Excel

## Struktur Singkat Project

- `application/` untuk controller, model, view, helper, dan library kustom
- `assets/` untuk CSS, JavaScript, font, dan gambar
- `system/` untuk core CodeIgniter
- `db_toko.sql` untuk dump database

## Menjalankan Project

### Opsi 1: XAMPP atau Laragon

1. Siapkan PHP 5.6 agar kompatibel dengan project legacy ini.
2. Copy folder project ke web root.
3. Buat database bernama `db_toko`.
4. Import file `db_toko.sql`.
5. Sesuaikan konfigurasi database di `application/config/database.php`.
6. Akses project melalui browser.

### Opsi 2: Docker

1. Jalankan container Apache, PHP 5.6, dan MySQL 5.7.
2. Mount folder project ke container web.
3. Import `db_toko.sql` ke database `db_toko`.
4. Set koneksi database ke host container database.

## Catatan

- Project ini termasuk legacy, jadi paling aman dijalankan di lingkungan PHP lama yang sesuai.
- Untuk deployment modern, disarankan migrasi bertahap ke driver database `mysqli` dan upgrade framework.
