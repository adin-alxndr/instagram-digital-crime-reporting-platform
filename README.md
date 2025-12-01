<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Digital Forensik System

Sistem Manajemen Insiden Digital Forensik - Aplikasi web untuk mengelola insiden keamanan siber, korban, dan barang bukti digital.


## Fitur
📊 Dashboard

- Statistik real-time insiden 
- Total insiden
- insiden dalam investigasi
- insiden selesai
- Total korban yang terdaftar
- Aktivitas terbaru

🚨 Manajemen Insiden

- Tambah insiden baru dengan detail lengkap
- Edit dan perbarui status insiden
- Lihat detail insiden dengan barang bukti terkait
- Hapus insiden dengan konfirmasi
- Filter berdasarkan status

👥 Manajemen Korban

- Daftarkan korban insiden baru
- Lihat daftar korban dengan jumlah insiden
- Edit data korban
- Hapus data korban

📦 Manajemen Barang Bukti

- Simpan informasi barang bukti digital
- Track hash SHA256 untuk integritas data
- Link barang bukti dengan insiden terkait
- Informasi lokasi fisik dan penyimpanan
- Catatan waktu pengambilan barang bukti
## Deployment

Clone Repository

```bash
  git clone https://github.com/yourusername/digital-forensik-system.git
cd digital-forensik-system
```

Install Dependencies

```bash
composer install
```

Setup Environment

```bash
cp .env.example .env
```

Edit file .env dan sesuaikan konfigurasi:
```bash
APP_NAME="Digital Forensik System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ihs_2025
DB_USERNAME=root
DB_PASSWORD=
```

Generate Application Key

```bash
php artisan key:generate
```

Jalankan Migrations

```bash
php artisan migrate
```

Jalankan Server

```bash
php artisan serve
```

## Acknowledgements

 - [Awesome Readme Templates](https://awesomeopensource.com/project/elangosundar/awesome-README-templates)
 - [Awesome README](https://github.com/matiassingers/awesome-readme)
 - [How to write a Good readme](https://bulldogjob.com/news/449-how-to-write-a-good-readme-for-your-github-project)

