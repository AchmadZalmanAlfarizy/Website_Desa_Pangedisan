# Sistem Pelayanan Administrasi Desa Pagendisan

Sistem informasi manajemen pelayanan administrasi berbasis web untuk **Desa Pagendisan, Kecamatan Winong, Kabupaten Pati**.

---

## Fitur Utama

### Untuk Admin (Perangkat Desa)
- **Dashboard** — Statistik penduduk, pengajuan, chart 12 bulan terakhir
- **Data Penduduk** — CRUD lengkap dengan pencarian & filter
- **Jenis Surat** — Manajemen jenis surat beserta persyaratan
- **Kelola Pengajuan** — Setujui / tolak pengajuan, buat surat otomatis
- **Arsip Dokumen** — Upload, download, manajemen arsip
- **Manajemen Pengguna** — CRUD akun, toggle aktif/nonaktif

### Untuk Masyarakat
- **Dashboard Personal** — Statistik pengajuan pribadi
- **Ajukan Surat** — Form pengajuan online dengan persyaratan dinamis
- **Riwayat Pengajuan** — Tracking status pengajuan real-time
- **Download Surat** — Unduh surat dalam format PDF
- **Profil** — Edit data diri dan foto profil

---

## Teknologi

| Stack | Versi |
|-------|-------|
| PHP | 8.2+ |
| Laravel | 11.x |
| MySQL | 8.0+ |
| Bootstrap | 5.3.2 |
| Bootstrap Icons | 1.11.3 |
| Chart.js | 4.4.0 |
| barryvdh/laravel-dompdf | 3.1.2 |
| spatie/laravel-permission | 6.25.0 |

---

## Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@desa-pagendisan.com` | `password` |
| Masyarakat | `user@desa-pagendisan.com` | `password` |

---

## Cara Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
# Edit DB_DATABASE=desa_pangedisan di .env
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

---

## Alur Pengajuan Surat

```
Warga login → Pilih Jenis Surat → Isi Form → Kirim Pengajuan
    ↓
Admin review → Pilih data penduduk → Setujui / Tolak
    ↓
Warga download PDF surat
```

---

*Dibuat untuk keperluan Tugas Akhir / Skripsi.*

<!--
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
