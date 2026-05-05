# Black Box Testing - Sistem Pelayanan Administrasi Desa Pagendisan

## 📋 Daftar Isi
1. [Pengenalan Black Box Testing](#pengenalan-black-box-testing)
2. [Lingkungan Testing](#lingkungan-testing)
3. [Akun Testing](#akun-testing)
4. [Test Scenarios](#test-scenarios)
5. [Checklist Testing](#checklist-testing)

---

## Pengenalan Black Box Testing

**Black Box Testing** adalah metode pengujian perangkat lunak yang berfokus pada **input dan output tanpa melihat internal code**. Tester menguji fungsionalitas berdasarkan:
- ✅ Requirement yang diberikan
- ✅ User behavior / use cases
- ✅ Input validation
- ✅ Error handling
- ✅ Data integrity

### Tujuan Testing
- Memverifikasi semua fitur berfungsi sesuai spesifikasi
- Mengidentifikasi bug atau error handling yang kurang
- Memastikan user experience yang baik
- Validasi data di database

---

## Lingkungan Testing

### Setup Awal
```bash
# 1. Jalankan development server
php artisan serve

# 2. Database sudah fresh seeded dengan data default
php artisan migrate:fresh --seed

# 3. Server berjalan di http://localhost:8000
```

### Browser yang Direkomendasikan
- Chrome/Chromium (Latest)
- Firefox (Latest)
- Edge (Latest)

### Data Testing
- Email Admin: `admin@desa-pagendisan.com`
- Password: `password`
- Email User: `user@desa-pagendisan.com`
- Password: `password`

---

## Akun Testing

| No | Role | Email | Password | Status |
|----|------|-------|----------|--------|
| 1 | Admin | admin@desa-pagendisan.com | password | Active |
| 2 | User | user@desa-pagendisan.com | password | Active |

---

## Test Scenarios

### 🔐 **MODULE 1: AUTHENTICATION**

#### TC-AUTH-001: Login Sukses - Admin
**Precondition:** User berada di halaman login
**Steps:**
1. Masukkan email: `admin@desa-pagendisan.com`
2. Masukkan password: `password`
3. Klik tombol "Login"

**Expected Result:**
- ✅ Login berhasil
- ✅ Redirect ke `/admin/dashboard`
- ✅ Session terbuat dengan user ID admin
- ✅ Navbar menampilkan nama "Admin"

---

#### TC-AUTH-002: Login Sukses - User (Masyarakat)
**Precondition:** User berada di halaman login
**Steps:**
1. Masukkan email: `user@desa-pagendisan.com`
2. Masukkan password: `password`
3. Klik tombol "Login"

**Expected Result:**
- ✅ Login berhasil
- ✅ Redirect ke `/user/dashboard`
- ✅ Session terbuat dengan user ID masyarakat
- ✅ Navbar menampilkan nama user

---

#### TC-AUTH-003: Login Gagal - Email Tidak Terdaftar
**Precondition:** User berada di halaman login
**Steps:**
1. Masukkan email: `notregistered@email.com`
2. Masukkan password: `password`
3. Klik tombol "Login"

**Expected Result:**
- ❌ Login gagal
- ✅ Pesan error ditampilkan
- ✅ User tetap di halaman login
- ✅ Input email masih terisi

---

#### TC-AUTH-004: Login Gagal - Password Salah
**Precondition:** User berada di halaman login
**Steps:**
1. Masukkan email: `admin@desa-pagendisan.com`
2. Masukkan password: `salahpassword`
3. Klik tombol "Login"

**Expected Result:**
- ❌ Login gagal
- ✅ Pesan error ditampilkan
- ✅ User tetap di halaman login

---

#### TC-AUTH-005: Register Masyarakat Sukses
**Precondition:** User berada di halaman register
**Steps:**
1. Masukkan Nama: `Test User`
2. Masukkan Email: `testuser@email.com`
3. Masukkan Password: `password123`
4. Masukkan Konfirmasi Password: `password123`
5. Klik tombol "Register"

**Expected Result:**
- ✅ Register berhasil
- ✅ User dibuat dengan role "user"
- ✅ Redirect ke halaman login
- ✅ User dapat login dengan email baru

---

#### TC-AUTH-006: Register Gagal - Email Sudah Terdaftar
**Precondition:** User berada di halaman register
**Steps:**
1. Masukkan Nama: `Duplicate User`
2. Masukkan Email: `admin@desa-pagendisan.com`
3. Masukkan Password: `password123`
4. Masukkan Konfirmasi Password: `password123`
5. Klik tombol "Register"

**Expected Result:**
- ❌ Register gagal
- ✅ Pesan error "Email sudah terdaftar"
- ✅ User tetap di halaman register

---

#### TC-AUTH-007: Logout Sukses
**Precondition:** User sudah login
**Steps:**
1. Klik tombol "Logout" di navbar
2. Konfirmasi logout jika ada

**Expected Result:**
- ✅ Session terhapus
- ✅ Redirect ke halaman login
- ✅ User tidak bisa akses halaman admin/user

---

### 📊 **MODULE 2: ADMIN DASHBOARD**

#### TC-DASH-001: Dashboard Admin Terbuka Sempurna
**Precondition:** Login sebagai admin
**Steps:**
1. Navigasi ke `/admin/dashboard`

**Expected Result:**
- ✅ Dashboard terbuka tanpa error
- ✅ Menampilkan statistik: Total Penduduk, Total Pengajuan, Total Surat
- ✅ Chart 12 bulan terakhir tampil
- ✅ Recent pengajuan menampilkan data terbaru

---

#### TC-DASH-002: Filter Berdasarkan Tahun di Dashboard
**Precondition:** Admin berada di dashboard
**Steps:**
1. Pilih tahun yang berbeda (jika ada dropdown tahun)
2. Perhatikan chart dan data terupdate

**Expected Result:**
- ✅ Chart terupdate dengan data tahun yang dipilih
- ✅ Statistik jumlah disesuaikan

---

### 👥 **MODULE 3: DATA PENDUDUK**

#### TC-PND-001: Lihat Daftar Penduduk
**Precondition:** Login sebagai admin
**Steps:**
1. Navigasi ke menu "Data Penduduk"
2. Halaman list penduduk terbuka

**Expected Result:**
- ✅ Tabel penduduk ditampilkan
- ✅ Menampilkan kolom: NIK, Nama, No. Telp, Email, Aksi
- ✅ Pagination berfungsi jika data lebih dari 10

---

#### TC-PND-002: Search Penduduk Berdasarkan NIK
**Precondition:** Berada di halaman list penduduk
**Steps:**
1. Klik kolom pencarian
2. Masukkan NIK penduduk (misal: `3214567890123456`)
3. Klik "Search" atau tunggu auto-search

**Expected Result:**
- ✅ Hanya menampilkan penduduk dengan NIK yang cocok
- ✅ Jika tidak ada hasil: "Data tidak ditemukan"

---

#### TC-PND-003: Search Penduduk Berdasarkan Nama
**Precondition:** Berada di halaman list penduduk
**Steps:**
1. Klik kolom pencarian
2. Masukkan nama penduduk (misal: `Budi`)
3. Klik "Search" atau tunggu auto-search

**Expected Result:**
- ✅ Menampilkan semua penduduk dengan nama mengandung "Budi"
- ✅ Case-insensitive search

---

#### TC-PND-004: Tambah Penduduk Baru
**Precondition:** Admin di halaman list penduduk
**Steps:**
1. Klik tombol "Tambah Penduduk"
2. Isi form:
   - NIK: `1234567890123456`
   - Nama: `Penduduk Test`
   - No. Telp: `081234567890`
   - Alamat: `Jl. Test No. 1`
   - Email: `penduduk@test.com` (optional)
3. Klik "Simpan"

**Expected Result:**
- ✅ Penduduk berhasil ditambah
- ✅ Redirect ke list penduduk
- ✅ Data muncul di tabel dengan icon success notification
- ✅ Database: Penduduk terekam dengan benar

---

#### TC-PND-005: Edit Penduduk
**Precondition:** Admin di halaman list penduduk
**Steps:**
1. Cari penduduk yang ingin diedit
2. Klik tombol "Edit"
3. Ubah data (misal: Nama menjadi `Budi Santoso`)
4. Klik "Simpan"

**Expected Result:**
- ✅ Data berhasil diupdate
- ✅ Redirect ke list penduduk
- ✅ Perubahan data terlihat di tabel
- ✅ Success notification muncul

---

#### TC-PND-006: Hapus Penduduk
**Precondition:** Admin di halaman list penduduk
**Steps:**
1. Cari penduduk yang ingin dihapus
2. Klik tombol "Hapus"
3. Konfirmasi hapus

**Expected Result:**
- ✅ Penduduk berhasil dihapus
- ✅ Data hilang dari tabel
- ✅ Confirmation alert muncul sebelum delete
- ✅ Database: Record terhapus

---

#### TC-PND-007: Validasi Input NIK (Duplikat)
**Precondition:** Admin menambah penduduk baru
**Steps:**
1. Masukkan NIK yang sudah ada di database
2. Klik "Simpan"

**Expected Result:**
- ❌ Form tidak disimpan
- ✅ Error message: "NIK sudah terdaftar"
- ✅ User tetap di form

---

---

### 📄 **MODULE 4: JENIS SURAT**

#### TC-JENIS-001: Lihat Daftar Jenis Surat
**Precondition:** Login sebagai admin
**Steps:**
1. Navigasi ke menu "Jenis Surat"

**Expected Result:**
- ✅ Tabel jenis surat ditampilkan
- ✅ Menampilkan kolom: ID, Nama Surat, Kode, Biaya, Persyaratan, Aksi

---

#### TC-JENIS-002: Tambah Jenis Surat Baru
**Precondition:** Admin di halaman list jenis surat
**Steps:**
1. Klik tombol "Tambah Jenis Surat"
2. Isi form:
   - Nama Surat: `Surat Izin Usaha`
   - Kode: `SKU`
   - Deskripsi: `Surat izin menjalankan usaha`
   - Biaya: `50000`
   - Persyaratan: `KTP, Surat Pernyataan, Foto Usaha`
3. Klik "Simpan"

**Expected Result:**
- ✅ Jenis surat berhasil ditambah
- ✅ Muncul di tabel
- ✅ Data terekam di database

---

#### TC-JENIS-003: Edit Jenis Surat
**Precondition:** Admin di halaman list jenis surat
**Steps:**
1. Klik tombol "Edit" pada jenis surat
2. Ubah biaya menjadi `60000`
3. Klik "Simpan"

**Expected Result:**
- ✅ Data berhasil diupdate
- ✅ Biaya di tabel berubah menjadi `60000`

---

#### TC-JENIS-004: Hapus Jenis Surat (Jika Tidak Ada Pengajuan)
**Precondition:** Admin di halaman list jenis surat, surat belum ada pengajuan
**Steps:**
1. Klik tombol "Hapus"
2. Konfirmasi hapus

**Expected Result:**
- ✅ Jenis surat berhasil dihapus
- ✅ Data hilang dari tabel

---

---

### 📋 **MODULE 5: PENGAJUAN SURAT (USER)**

#### TC-PEN-001: User Dashboard Terbuka
**Precondition:** Login sebagai user masyarakat
**Steps:**
1. Navigasi ke `/user/dashboard`

**Expected Result:**
- ✅ Dashboard user tampil
- ✅ Menampilkan: Total Pengajuan, Disetujui, Ditolak, Menunggu
- ✅ Recent applications muncul

---

#### TC-PEN-002: Ajukan Surat Baru - Form Muncul Sempurna
**Precondition:** User login, di dashboard user
**Steps:**
1. Klik tombol "Ajukan Surat Baru"
2. Halaman form pengajuan terbuka

**Expected Result:**
- ✅ Form terbuka tanpa error
- ✅ Menampilkan dropdown jenis surat
- ✅ Persyaratan ditampilkan sesuai jenis surat (dynamic)
- ✅ File upload field muncul

---

#### TC-PEN-003: Ajukan Surat - Pilih Jenis Surat
**Precondition:** User di halaman form pengajuan
**Steps:**
1. Klik dropdown "Jenis Surat"
2. Pilih salah satu jenis surat (misal: `Surat Keterangan Tidak Mampu`)

**Expected Result:**
- ✅ Jenis surat terpilih
- ✅ Persyaratan di-update secara dynamic
- ✅ File upload field muncul (jumlah sesuai persyaratan)

---

#### TC-PEN-004: Ajukan Surat - Upload File
**Precondition:** User sudah pilih jenis surat
**Steps:**
1. Klik "Upload File" pada field persyaratan
2. Pilih file PDF/JPG dari komputer (misal: `ktp.pdf`)
3. Tunggu file terupload
4. Ulangi untuk file lainnya

**Expected Result:**
- ✅ File berhasil diupload
- ✅ Nama file ditampilkan
- ✅ Preview/download link tersedia
- ✅ File tersimpan di storage

---

#### TC-PEN-005: Ajukan Surat - Submit Lengkap
**Precondition:** User sudah isi semua field dan upload file
**Steps:**
1. Pastikan semua field terisi:
   - Jenis Surat: Terisi
   - Semua file persyaratan terupload
2. Klik tombol "Ajukan"

**Expected Result:**
- ✅ Pengajuan berhasil disimpan
- ✅ Redirect ke halaman riwayat pengajuan
- ✅ Status: "Menunggu Persetujuan"
- ✅ Notification: "Pengajuan berhasil diajukan"
- ✅ Database: Pengajuan terekam dengan status `pending`

---

#### TC-PEN-006: Lihat Riwayat Pengajuan
**Precondition:** User login, sudah pernah mengajukan surat
**Steps:**
1. Navigasi ke menu "Riwayat Pengajuan"

**Expected Result:**
- ✅ Tabel riwayat tampil
- ✅ Kolom: No., Jenis Surat, Tgl. Pengajuan, Status, Aksi
- ✅ Status ditampilkan dengan warna: 
  - Kuning = Pending
  - Hijau = Approved
  - Merah = Rejected
- ✅ Pagination berfungsi

---

#### TC-PEN-007: Lihat Detail Pengajuan
**Precondition:** User di halaman riwayat pengajuan
**Steps:**
1. Klik tombol "Lihat Detail" pada salah satu pengajuan

**Expected Result:**
- ✅ Modal/halaman detail terbuka
- ✅ Menampilkan:
  - Jenis surat
  - Tanggal pengajuan
  - Status
  - File yang diupload
  - Catatan admin (jika ada)
- ✅ Tombol download tersedia (jika sudah disetujui)

---

#### TC-PEN-008: Download Surat (Jika Approved)
**Precondition:** Pengajuan sudah disetujui
**Steps:**
1. Buka detail pengajuan
2. Klik tombol "Download Surat" atau "Download PDF"

**Expected Result:**
- ✅ File PDF surat berhasil didownload
- ✅ File terbuka/tersimpan di komputer
- ✅ Konten surat sesuai data

---

#### TC-PEN-009: Ajukan Surat - Validasi File Required
**Precondition:** User di halaman form pengajuan
**Steps:**
1. Pilih jenis surat
2. Tanpa upload file apapun, klik "Ajukan"

**Expected Result:**
- ❌ Form tidak disimpan
- ✅ Error message: "File persyaratan harus diupload"
- ✅ Highlight field yang kosong

---

---

### ✅ **MODULE 6: PENGAJUAN SURAT (ADMIN)**

#### TC-ADMIN-PEN-001: Lihat Daftar Pengajuan
**Precondition:** Login sebagai admin
**Steps:**
1. Navigasi ke menu "Kelola Pengajuan"

**Expected Result:**
- ✅ Tabel pengajuan tampil
- ✅ Kolom: No., Pemohon, Jenis Surat, Tgl. Pengajuan, Status, Aksi
- ✅ Filter berdasarkan status (Pending, Approved, Rejected)
- ✅ Pagination berfungsi

---

#### TC-ADMIN-PEN-002: Filter Pengajuan - Status Pending
**Precondition:** Admin di halaman kelola pengajuan
**Steps:**
1. Klik filter "Status: Pending"
2. Halaman terupdate

**Expected Result:**
- ✅ Hanya menampilkan pengajuan dengan status "Pending"
- ✅ Jumlah data berkurang

---

#### TC-ADMIN-PEN-003: Lihat Detail Pengajuan
**Precondition:** Admin di halaman kelola pengajuan
**Steps:**
1. Klik tombol "Lihat Detail" pada pengajuan

**Expected Result:**
- ✅ Modal/halaman detail terbuka
- ✅ Menampilkan:
  - Data lengkap pemohon
  - Jenis surat
  - Semua file persyaratan dengan link download
  - Tanggal pengajuan
  - Catatan pengajuan (jika ada)
- ✅ Tombol Setujui / Tolak / Selesai tersedia

---

#### TC-ADMIN-PEN-004: Setujui Pengajuan
**Precondition:** Admin membuka detail pengajuan dengan status pending
**Steps:**
1. Klik tombol "Setujui"
2. (Optional) Masukkan catatan persetujuan
3. Klik "Confirm"

**Expected Result:**
- ✅ Status pengajuan berubah menjadi "Approved"
- ✅ Surat otomatis dibuat dan disimpan
- ✅ Notifikasi dikirim ke user
- ✅ User bisa download surat
- ✅ Tabel terupdate

---

#### TC-ADMIN-PEN-005: Tolak Pengajuan
**Precondition:** Admin membuka detail pengajuan dengan status pending
**Steps:**
1. Klik tombol "Tolak"
2. Masukkan alasan penolakan (wajib)
3. Klik "Confirm"

**Expected Result:**
- ✅ Status pengajuan berubah menjadi "Rejected"
- ✅ Catatan alasan ditampilkan
- ✅ Notifikasi dikirim ke user
- ✅ Tabel terupdate

---

#### TC-ADMIN-PEN-006: Selesaikan Pengajuan (Dari Approved)
**Precondition:** Admin membuka detail pengajuan dengan status approved
**Steps:**
1. Klik tombol "Selesai"
2. Klik "Confirm"

**Expected Result:**
- ✅ Status pengajuan berubah menjadi "Completed"
- ✅ Tabel terupdate
- ✅ Pengajuan tidak muncul di list pending lagi

---

#### TC-ADMIN-PEN-007: Search Pengajuan Berdasarkan Nama Pemohon
**Precondition:** Admin di halaman kelola pengajuan
**Steps:**
1. Masukkan nama pemohon di search box (misal: `Budi`)
2. Tekan Enter atau tunggu auto-search

**Expected Result:**
- ✅ Hanya menampilkan pengajuan dari pemohon dengan nama mengandung "Budi"

---

---

### 📦 **MODULE 7: ARSIP DOKUMEN**

#### TC-ARSIP-001: Lihat Daftar Arsip Dokumen
**Precondition:** Login sebagai admin
**Steps:**
1. Navigasi ke menu "Arsip Dokumen"

**Expected Result:**
- ✅ Tabel arsip tampil
- ✅ Kolom: No., Nama File, Tipe, Tgl. Upload, Aksi
- ✅ Pagination berfungsi

---

#### TC-ARSIP-002: Upload Dokumen Baru
**Precondition:** Admin di halaman arsip
**Steps:**
1. Klik tombol "Upload Dokumen"
2. Isi form:
   - Nama Dokumen: `Peraturan Desa 2024`
   - Keterangan: `Peraturan mengenai retribusi desa`
   - File: Pilih file PDF
3. Klik "Upload"

**Expected Result:**
- ✅ File berhasil diupload
- ✅ Redirect ke list arsip
- ✅ Dokumen muncul di tabel
- ✅ File tersimpan di storage: `storage/app/public/`

---

#### TC-ARSIP-003: Download Dokumen
**Precondition:** Admin di halaman arsip
**Steps:**
1. Klik tombol "Download" pada dokumen

**Expected Result:**
- ✅ File berhasil didownload
- ✅ File terbuka/tersimpan di komputer
- ✅ Nama file sesuai original

---

#### TC-ARSIP-004: Hapus Dokumen
**Precondition:** Admin di halaman arsip
**Steps:**
1. Klik tombol "Hapus" pada dokumen
2. Konfirmasi hapus

**Expected Result:**
- ✅ Dokumen berhasil dihapus
- ✅ Data hilang dari tabel
- ✅ File terhapus dari storage

---

#### TC-ARSIP-005: Validasi File Upload - Tipe File
**Precondition:** Admin akan upload dokumen
**Steps:**
1. Coba upload file non-PDF (misal: .exe, .zip)
2. Klik "Upload"

**Expected Result:**
- ❌ Upload gagal
- ✅ Error message: "File harus PDF"

---

---

### 👤 **MODULE 8: MANAJEMEN PENGGUNA (ADMIN)**

#### TC-USER-001: Lihat Daftar Pengguna
**Precondition:** Login sebagai admin
**Steps:**
1. Navigasi ke menu "Manajemen Pengguna"

**Expected Result:**
- ✅ Tabel pengguna tampil
- ✅ Kolom: No., Nama, Email, Role, Status, Aksi
- ✅ Pagination berfungsi

---

#### TC-USER-002: Cari Pengguna Berdasarkan Email
**Precondition:** Admin di halaman manajemen pengguna
**Steps:**
1. Masukkan email di search box
2. Tekan Enter atau tunggu auto-search

**Expected Result:**
- ✅ Menampilkan pengguna dengan email yang cocok

---

#### TC-USER-003: Toggle Status Pengguna (Aktif → Nonaktif)
**Precondition:** Admin melihat pengguna dengan status aktif
**Steps:**
1. Klik tombol "Toggle" atau icon status
2. Confirm perubahan

**Expected Result:**
- ✅ Status berubah menjadi "Nonaktif"
- ✅ Pengguna tidak bisa login lagi
- ✅ Tabel terupdate

---

#### TC-USER-004: Toggle Status Pengguna (Nonaktif → Aktif)
**Precondition:** Admin melihat pengguna dengan status nonaktif
**Steps:**
1. Klik tombol "Toggle"
2. Confirm perubahan

**Expected Result:**
- ✅ Status berubah menjadi "Aktif"
- ✅ Pengguna bisa login lagi
- ✅ Tabel terupdate

---

---

### 👤 **MODULE 9: PROFIL USER**

#### TC-PROF-001: Lihat Profil User
**Precondition:** User login
**Steps:**
1. Klik icon profil/nama di navbar
2. Pilih "Profil"

**Expected Result:**
- ✅ Halaman profil terbuka
- ✅ Menampilkan:
  - Foto profil
  - Nama lengkap
  - Email
  - No. Telp
  - Alamat

---

#### TC-PROF-002: Edit Data Profil
**Precondition:** User di halaman profil
**Steps:**
1. Klik tombol "Edit"
2. Ubah nama menjadi `Budi Santoso Edited`
3. Klik "Simpan"

**Expected Result:**
- ✅ Data berhasil diupdate
- ✅ Navbar menampilkan nama terbaru
- ✅ Success notification muncul

---

#### TC-PROF-003: Upload Foto Profil
**Precondition:** User di halaman edit profil
**Steps:**
1. Klik area foto profil
2. Pilih file gambar (JPG/PNG)
3. Klik "Simpan"

**Expected Result:**
- ✅ Foto berhasil diupload
- ✅ Foto tampil di profil
- ✅ Foto ditampilkan di navbar juga

---

#### TC-PROF-004: Ganti Password
**Precondition:** User di halaman profil
**Steps:**
1. Klik "Ganti Password"
2. Masukkan password lama: `password`
3. Masukkan password baru: `newpassword123`
4. Konfirmasi password: `newpassword123`
5. Klik "Simpan"

**Expected Result:**
- ✅ Password berhasil diubah
- ✅ Success notification muncul
- ✅ User bisa login dengan password baru

---

#### TC-PROF-005: Validasi Ganti Password - Password Lama Salah
**Precondition:** User akan ganti password
**Steps:**
1. Klik "Ganti Password"
2. Masukkan password lama: `salahpassword`
3. Masukkan password baru: `newpassword123`
4. Klik "Simpan"

**Expected Result:**
- ❌ Ganti password gagal
- ✅ Error message: "Password lama salah"

---

---

### 🔒 **MODULE 10: SECURITY & AUTHORIZATION**

#### TC-SEC-001: User Tidak Bisa Akses Halaman Admin
**Precondition:** Login sebagai user
**Steps:**
1. Coba akses URL: `http://localhost:8000/admin/dashboard`

**Expected Result:**
- ❌ Akses ditolak
- ✅ Redirect ke `/user/dashboard` atau login
- ✅ Notification: "Unauthorized"

---

#### TC-SEC-002: Admin Bisa Akses Halaman User (Jika Diizinkan)
**Precondition:** Login sebagai admin
**Steps:**
1. Coba akses URL: `http://localhost:8000/user/dashboard`

**Expected Result:**
- ✅ Admin bisa akses (atau redirect ke admin dashboard)
- *Sesuai policy aplikasi*

---

#### TC-SEC-003: User Non-Login Tidak Bisa Akses Dashboard
**Precondition:** Logout dari semua akun
**Steps:**
1. Coba akses URL: `http://localhost:8000/admin/dashboard`

**Expected Result:**
- ❌ Akses ditolak
- ✅ Redirect ke halaman login

---

#### TC-SEC-004: CSRF Token Protection
**Precondition:** User akan submit form
**Steps:**
1. Periksa form (Developer Tools → Inspect Element)
2. Cari input CSRF token

**Expected Result:**
- ✅ CSRF token field ada di form: `@csrf`
- ✅ Token tidak kosong
- ✅ Setiap form memiliki token

---

---

### 🔄 **MODULE 11: DATA INTEGRITY & FLOW**

#### TC-DATA-001: Pengajuan Dihapus jika Penduduk Dihapus
**Precondition:** Ada penduduk dengan pengajuan
**Steps:**
1. Admin hapus penduduk tersebut
2. Cek database atau list pengajuan

**Expected Result:**
- ✅ Pengajuan terhapus otomatis (cascade delete)
- *Atau* Sistem menolak hapus dengan pesan

---

#### TC-DATA-002: Data Surat Terekam Lengkap
**Precondition:** User mengajukan surat
**Steps:**
1. Ajukan surat
2. Admin setujui
3. Check database tabel `surat`

**Expected Result:**
- ✅ Tabel surat terekam dengan lengkap:
  - ID, pengajuan_id, file_path, created_at, updated_at

---

#### TC-DATA-003: Perubahan Status Pengajuan Tercatat Timeline
**Precondition:** Pengajuan ada
**Steps:**
1. Catat waktu awal (pending)
2. Admin setujui (catat waktu)
3. Check database updated_at

**Expected Result:**
- ✅ Kolom `updated_at` terupdate dengan benar
- ✅ Timestamp sesuai waktu perubahan

---

---

## ✅ Checklist Testing

### Pre-Testing
- [ ] Environment setup (PHP 8.2+, Laravel 11, MySQL 8)
- [ ] Database fresh & seeded
- [ ] Development server running
- [ ] Akses http://localhost:8000
- [ ] Browser dev tools ready

### Authentication (MODULE 1)
- [ ] TC-AUTH-001: Login Admin
- [ ] TC-AUTH-002: Login User
- [ ] TC-AUTH-003: Login - Email invalid
- [ ] TC-AUTH-004: Login - Password invalid
- [ ] TC-AUTH-005: Register berhasil
- [ ] TC-AUTH-006: Register - Email duplicate
- [ ] TC-AUTH-007: Logout

### Dashboard (MODULE 2)
- [ ] TC-DASH-001: Dashboard Admin tampil
- [ ] TC-DASH-002: Filter tahun dashboard

### Data Penduduk (MODULE 3)
- [ ] TC-PND-001: List penduduk
- [ ] TC-PND-002: Search NIK
- [ ] TC-PND-003: Search Nama
- [ ] TC-PND-004: Tambah penduduk
- [ ] TC-PND-005: Edit penduduk
- [ ] TC-PND-006: Hapus penduduk
- [ ] TC-PND-007: Validasi NIK duplikat

### Jenis Surat (MODULE 4)
- [ ] TC-JENIS-001: List jenis surat
- [ ] TC-JENIS-002: Tambah jenis surat
- [ ] TC-JENIS-003: Edit jenis surat
- [ ] TC-JENIS-004: Hapus jenis surat

### Pengajuan Surat - User (MODULE 5)
- [ ] TC-PEN-001: User dashboard
- [ ] TC-PEN-002: Form pengajuan muncul
- [ ] TC-PEN-003: Pilih jenis surat
- [ ] TC-PEN-004: Upload file
- [ ] TC-PEN-005: Submit pengajuan
- [ ] TC-PEN-006: Lihat riwayat
- [ ] TC-PEN-007: Lihat detail pengajuan
- [ ] TC-PEN-008: Download surat
- [ ] TC-PEN-009: Validasi file required

### Pengajuan Surat - Admin (MODULE 6)
- [ ] TC-ADMIN-PEN-001: List pengajuan
- [ ] TC-ADMIN-PEN-002: Filter status
- [ ] TC-ADMIN-PEN-003: Lihat detail
- [ ] TC-ADMIN-PEN-004: Setujui pengajuan
- [ ] TC-ADMIN-PEN-005: Tolak pengajuan
- [ ] TC-ADMIN-PEN-006: Selesaikan pengajuan
- [ ] TC-ADMIN-PEN-007: Search pengajuan

### Arsip Dokumen (MODULE 7)
- [ ] TC-ARSIP-001: List arsip
- [ ] TC-ARSIP-002: Upload dokumen
- [ ] TC-ARSIP-003: Download dokumen
- [ ] TC-ARSIP-004: Hapus dokumen
- [ ] TC-ARSIP-005: Validasi tipe file

### Manajemen Pengguna (MODULE 8)
- [ ] TC-USER-001: List pengguna
- [ ] TC-USER-002: Search pengguna
- [ ] TC-USER-003: Toggle status aktif
- [ ] TC-USER-004: Toggle status nonaktif

### Profil User (MODULE 9)
- [ ] TC-PROF-001: Lihat profil
- [ ] TC-PROF-002: Edit profil
- [ ] TC-PROF-003: Upload foto profil
- [ ] TC-PROF-004: Ganti password
- [ ] TC-PROF-005: Validasi password lama

### Security (MODULE 10)
- [ ] TC-SEC-001: User tidak akses admin
- [ ] TC-SEC-002: Authorization check
- [ ] TC-SEC-003: Non-login akses blocked
- [ ] TC-SEC-004: CSRF token ada

### Data Integrity (MODULE 11)
- [ ] TC-DATA-001: Cascade delete
- [ ] TC-DATA-002: Surat data lengkap
- [ ] TC-DATA-003: Timeline tercatat

---

## 📝 Testing Summary Template

```
Tanggal Testing: [Tanggal]
Tester: [Nama]
Environment: [Dev/Staging/Production]

Total Test Cases: 56
Passed: ___/56
Failed: ___/56
Blocked: ___/56

Critical Issues:
1. [Issue 1]
2. [Issue 2]

Recommendations:
1. [Rekomendasi 1]
2. [Rekomendasi 2]

Status: ☐ PASS ☐ FAIL ☐ BLOCKED
```

---

## 🚀 Testing Best Practices

1. **Clear Environment** - Fresh database setiap testing cycle
2. **Test Data** - Gunakan akun test yang sudah disediakan
3. **Documentation** - Catat setiap hasil test
4. **Bug Report** - Lapor bug dengan detail: steps, actual result, expected result
5. **Regression** - Test ulang setelah fix
6. **Cross-browser** - Test di minimal 2 browser berbeda

---

**Terakhir Update:** May 5, 2026  
**Version:** 1.0  
**Status:** Ready for Testing
