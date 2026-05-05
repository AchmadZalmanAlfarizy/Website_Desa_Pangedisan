# PANDUAN SETUP & DEPLOYMENT - Sistem Pelayanan Desa Pagendisan

## 📋 INFORMASI SISTEM

**Nama Aplikasi:** Sistem Administrasi & Pelayanan Desa Pagendisan  
**Technology Stack:** Laravel 11 + Bootstrap 5 + MySQL 8  
**Version:** 1.0 (Release)  
**Status:** ✅ SIAP PRODUKSI

---

## 🔐 AKUN LOGIN DEFAULT

### Admin Account
- **Email:** `admin@desa-pagendisan.com`
- **Password:** `password`
- **Role:** Admin (Akses penuh ke semua menu)

### Masyarakat Account (Untuk Testing)
- **Email:** `user@desa-pagendisan.com`
- **Password:** `password`
- **Role:** Masyarakat (Hanya bisa akses dashboard pribadi & pengajuan)

**⚠️ PENTING:** Ubah password ini setelah deploy ke production!

---

## 🚀 CARA MENJALANKAN APLIKASI

### Requirement
- **PHP:** 8.2 atau lebih tinggi
- **MySQL:** 5.7 atau lebih tinggi
- **Composer:** Latest version
- **Node.js:** Optional (hanya jika ada build frontend)

### Step 1: Clone/Copy Project
```bash
# Jika dari git
git clone <repository-url>
cd Desa_pangedisan

# Atau copy folder project
cd c:\laragon\www\Desa_pangedisan
```

### Step 2: Install Dependencies
```bash
composer install
npm install  # Jika diperlukan
```

### Step 3: Setup Environment
```bash
# Copy .env.example ke .env (jika belum ada)
cp .env.example .env

# Edit .env dengan setting yang sesuai:
APP_URL=http://127.0.0.1:8000        # URL aplikasi
APP_DEBUG=false                        # Set ke false untuk production
DB_HOST=localhost                      # Host database
DB_PORT=3306                           # Port database
DB_DATABASE=desa_pangedisan           # Nama database
DB_USERNAME=root                       # User database
DB_PASSWORD=                          # Password database (kosong untuk local)
SESSION_DRIVER=file                   # Driver session (file/database)
```

### Step 4: Generate Application Key
```bash
php artisan key:generate
```

### Step 5: Database Migration & Seeding
```bash
# Fresh migration (untuk fresh install)
php artisan migrate:fresh --seed

# Atau migrate saja (jika database sudah ada)
php artisan migrate
php artisan db:seed
```

### Step 6: Storage Link
```bash
php artisan storage:link
```

### Step 7: Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 8: Jalankan Development Server
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

**Buka di browser:** `http://127.0.0.1:8000`

---

## 📁 STRUKTUR FOLDER PROJECT

```
Desa_pangedisan/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controllers untuk handling logic
│   │   └── Middleware/       # Middleware untuk auth & validasi
│   ├── Models/               # Model database (User, Penduduk, etc)
│   └── ...
├── config/                   # Konfigurasi aplikasi
├── database/
│   ├── migrations/           # File migrasi database
│   ├── seeders/              # File seeder untuk dummy data
│   └── ...
├── resources/
│   ├── views/                # File Blade template (HTML)
│   ├── css/                  # File CSS
│   └── js/                   # File JavaScript
├── routes/
│   ├── web.php               # Route untuk web (login, dashboard, etc)
│   └── api.php               # Route untuk API
├── storage/
│   ├── app/                  # File upload
│   ├── logs/                 # Log aplikasi
│   └── framework/            # Cache & session
├── public/
│   ├── css/                  # CSS compiled
│   ├── js/                   # JS compiled
│   └── uploads/              # Folder public untuk uploads
├── .env                      # Environment variables (JANGAN di-commit)
├── .gitignore                # File yang tidak perlu di-commit
├── composer.json             # PHP dependencies
├── package.json              # NPM dependencies
└── DATABASE_QUERIES_LENGKAP.md  # Query database (PENTING!)
```

---

## 🔧 KONFIGURASI PENTING

### .env Configuration

```env
# Application
APP_NAME="Desa Pagendisan"
APP_ENV=local                 # local/production
APP_DEBUG=true               # true untuk debug, false untuk production
APP_URL=http://127.0.0.1:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desa_pangedisan
DB_USERNAME=root
DB_PASSWORD=

# Session
SESSION_DRIVER=file           # file/database/cookie
SESSION_LIFETIME=120
SESSION_DOMAIN=null
SESSION_PATH=/

# Mail (jika ingin fitur kirim email)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=noreply@desa-pagendisan.com
MAIL_FROM_NAME="Desa Pagendisan"
```

### APP_DEBUG vs Production

**Development:**
```env
APP_DEBUG=true       # Menampilkan error detail
APP_ENV=local
```

**Production:**
```env
APP_DEBUG=false      # Jangan tampilkan error detail
APP_ENV=production
```

---

## 📊 DATABASE QUERIES

Untuk operasi database, lihat file **DATABASE_QUERIES_LENGKAP.md** yang berisi:
- Query SELECT semua data
- Query INSERT data baru
- Query UPDATE data
- Query analisis & statistik
- Query backup & restore
- Dan banyak lagi!

---

## 🔐 SECURITY BEST PRACTICES

### 1. Ubah Password Admin
```bash
php artisan tinker
>>> use App\Models\User;
>>> use Illuminate\Support\Facades\Hash;
>>> $user = User::find(1);
>>> $user->password = Hash::make('password-baru-yang-aman');
>>> $user->save();
>>> exit
```

### 2. Ubah Email Admin (Optional)
```bash
php artisan tinker
>>> use App\Models\User;
>>> $user = User::find(1);
>>> $user->email = 'admin-baru@desa-pagendisan.com';
>>> $user->save();
>>> exit
```

### 3. Setup HTTPS
```env
# Di production, gunakan HTTPS
APP_URL=https://desa-pagendisan.com

# Pastikan server di-configure untuk HTTPS/SSL
```

### 4. Setup Environment Variable Sensitive
```env
# Jangan hardcode sensitive data di .env
# Gunakan environment variable dari server/container

# Contoh di server:
export DB_PASSWORD='password-yang-aman'
export MAIL_PASSWORD='app-password-gmail'
```

### 5. Backup Database Regularly
```bash
# Daily backup script
mysqldump -u root desa_pangedisan > /backup/desa_pangedisan_$(date +\%Y\%m\%d).sql

# Kompres backup
gzip /backup/desa_pangedisan_*.sql
```

---

## 📱 FITUR UTAMA APLIKASI

### Admin (role: admin)
✅ Dashboard dengan statistik pengajuan  
✅ Manajemen Data Penduduk (CRUD)  
✅ Manajemen Jenis Surat (CRUD)  
✅ Manajemen Pengajuan Surat (approve/reject)  
✅ Generate Surat Digital (PDF)  
✅ Manajemen Arsip Dokumen  
✅ Manajemen User  

### Masyarakat (role: masyarakat)
✅ Dashboard pribadi  
✅ Pengajuan Surat Baru  
✅ Tracking Status Pengajuan  
✅ Download Surat (PDF)  
✅ View Profile  

---

## 🐛 TROUBLESHOOTING

### Masalah: Login tidak bisa
**Solusi:**
1. Pastikan database sudah di-migrate: `php artisan migrate`
2. Pastikan seeder sudah dijalankan: `php artisan db:seed`
3. Clear config cache: `php artisan config:clear`
4. Restart dev server

### Masalah: Database connection error
**Solusi:**
1. Cek MySQL sudah running
2. Cek .env DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD benar
3. Jalankan: `php artisan migrate`

### Masalah: Upload file tidak bisa
**Solusi:**
1. Pastikan storage link sudah dibuat: `php artisan storage:link`
2. Cek folder permissions: `chmod -R 775 storage bootstrap/cache`

### Masalah: PDF tidak bisa generate
**Solusi:**
1. Package DomPDF sudah di-install (sudah included)
2. Pastikan fonts folder writable: `chmod -R 775 storage`

### Masalah: Session hilang setelah login
**Solusi:**
1. Ubah SESSION_DRIVER ke `file` di .env
2. Clear config: `php artisan config:clear`
3. Restart dev server

---

## 📞 SUPPORT & DOCUMENTATION

### Database Query
File: **DATABASE_QUERIES_LENGKAP.md**  
Berisi semua query SQL yang diperlukan untuk operasi & maintenance

### API Documentation
File: **routes/api.php** (jika ada API)

### Code Documentation
Baca comments di dalam file:
- `app/Http/Controllers/`
- `app/Models/`

---

## ✨ NEXT STEPS - IMPROVEMENT

Rekomendasi untuk improvement di masa depan:

1. **Email Notification:** Setup email untuk notifikasi pengajuan
2. **SMS Gateway:** Integrasi SMS untuk notifikasi via SMS
3. **Mobile App:** Build mobile app (React Native/Flutter)
4. **API REST:** Expose API untuk integrasi dengan sistem lain
5. **Two-Factor Authentication:** Tambah 2FA untuk security
6. **Audit Log:** Catat semua aktivitas user
7. **Export Data:** Fitur export ke Excel/PDF
8. **QR Code:** Generate QR code di surat untuk validasi

---

**Last Updated:** May 5, 2026  
**Created By:** AI Assistant  
**Status:** Ready for Production ✅
