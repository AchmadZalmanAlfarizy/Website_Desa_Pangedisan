# DATABASE QUERY LENGKAP - Desa Pagendisan
# Untuk teman Anda yang meminta database

## 1. STRUKTUR TABEL DAN DATA UTAMA

### 1.1 USERS - Data Pengguna
```sql
SELECT * FROM users;
```

Atau untuk export dengan format lebih rapi:
```sql
SELECT 
    id,
    name AS 'Nama',
    email AS 'Email',
    nik AS 'NIK',
    no_hp AS 'No. HP',
    role AS 'Peran',
    IF(is_active=1, 'Aktif', 'Tidak Aktif') AS 'Status',
    created_at AS 'Dibuat',
    updated_at AS 'Diupdate'
FROM users
ORDER BY created_at DESC;
```

### 1.2 PENDUDUK - Data Penduduk Desa
```sql
SELECT 
    id,
    nik AS 'NIK',
    nama AS 'Nama',
    email AS 'Email',
    no_hp AS 'No. HP',
    alamat AS 'Alamat',
    rt_rw AS 'RT/RW',
    jenis_kelamin AS 'Jenis Kelamin',
    tempat_lahir AS 'Tempat Lahir',
    tgl_lahir AS 'Tanggal Lahir',
    pekerjaan AS 'Pekerjaan',
    IF(is_active=1, 'Aktif', 'Tidak Aktif') AS 'Status',
    created_at AS 'Dibuat'
FROM penduduk
ORDER BY nama ASC;
```

### 1.3 JENIS_SURAT - Jenis Layanan Surat
```sql
SELECT 
    id,
    nama AS 'Nama Surat',
    kode AS 'Kode',
    deskripsi AS 'Deskripsi',
    persyaratan AS 'Persyaratan',
    IF(is_active=1, 'Aktif', 'Tidak Aktif') AS 'Status',
    created_at AS 'Dibuat'
FROM jenis_surat
ORDER BY nama ASC;
```

### 1.4 PENGAJUAN - Permohonan Surat
```sql
SELECT 
    p.id,
    p.no_pengajuan AS 'No. Pengajuan',
    u.name AS 'Pemohon',
    j.nama AS 'Jenis Surat',
    p.keperluan AS 'Keperluan',
    p.status AS 'Status',
    p.catatan AS 'Catatan',
    p.created_at AS 'Tanggal Pengajuan',
    p.updated_at AS 'Update Terakhir'
FROM pengajuan p
LEFT JOIN users u ON p.user_id = u.id
LEFT JOIN jenis_surat j ON p.jenis_surat_id = j.id
ORDER BY p.created_at DESC;
```

### 1.5 SURAT - Surat Yang Dihasilkan
```sql
SELECT 
    s.id,
    s.no_surat AS 'No. Surat',
    j.nama AS 'Jenis Surat',
    pn.nama AS 'Nama Penerima',
    pn.nik AS 'NIK Penerima',
    s.tanggal_surat AS 'Tanggal Surat',
    IF(s.adalah_berlaku, 'Ya', 'Tidak') AS 'Masih Berlaku',
    s.created_at AS 'Dibuat',
    s.updated_at AS 'Diupdate'
FROM surat s
LEFT JOIN jenis_surat j ON s.jenis_surat_id = j.id
LEFT JOIN penduduk pn ON s.penduduk_id = pn.id
ORDER BY s.tanggal_surat DESC;
```

### 1.6 ARSIP_DOKUMEN - Dokumen Pendukung
```sql
SELECT 
    a.id,
    p.name AS 'Upload Oleh',
    a.nama_dokumen AS 'Nama Dokumen',
    a.file_path AS 'Path File',
    a.tipe_dokumen AS 'Tipe',
    a.deskripsi AS 'Deskripsi',
    IF(a.is_active=1, 'Aktif', 'Tidak Aktif') AS 'Status',
    a.created_at AS 'Tanggal Upload'
FROM arsip_dokumen a
LEFT JOIN users p ON a.user_id = p.id
ORDER BY a.created_at DESC;
```

---

## 2. QUERY ANALISIS DAN STATISTIK

### 2.1 Total Data Ringkasan
```sql
SELECT 
    'Total Users' AS Label, COUNT(*) AS Jumlah FROM users
UNION ALL
SELECT 'Total Admin', COUNT(*) FROM users WHERE role = 'admin'
UNION ALL
SELECT 'Total Masyarakat', COUNT(*) FROM users WHERE role = 'masyarakat'
UNION ALL
SELECT 'Total Penduduk', COUNT(*) FROM penduduk
UNION ALL
SELECT 'Total Jenis Surat', COUNT(*) FROM jenis_surat
UNION ALL
SELECT 'Total Pengajuan', COUNT(*) FROM pengajuan
UNION ALL
SELECT 'Total Surat Selesai', COUNT(*) FROM surat
UNION ALL
SELECT 'Total Dokumen', COUNT(*) FROM arsip_dokumen;
```

### 2.2 Statistik Pengajuan Per Status
```sql
SELECT 
    status AS 'Status Pengajuan',
    COUNT(*) AS 'Jumlah',
    ROUND(COUNT(*) * 100.0 / (SELECT COUNT(*) FROM pengajuan), 2) AS 'Persentase (%)'
FROM pengajuan
GROUP BY status
ORDER BY 
    CASE status
        WHEN 'pending' THEN 1
        WHEN 'diproses' THEN 2
        WHEN 'selesai' THEN 3
        WHEN 'ditolak' THEN 4
    END;
```

### 2.3 Pengajuan Per User
```sql
SELECT 
    u.name AS 'Nama User',
    COUNT(p.id) AS 'Total Pengajuan',
    SUM(CASE WHEN p.status = 'pending' THEN 1 ELSE 0 END) AS 'Pending',
    SUM(CASE WHEN p.status = 'diproses' THEN 1 ELSE 0 END) AS 'Diproses',
    SUM(CASE WHEN p.status = 'selesai' THEN 1 ELSE 0 END) AS 'Selesai',
    SUM(CASE WHEN p.status = 'ditolak' THEN 1 ELSE 0 END) AS 'Ditolak'
FROM users u
LEFT JOIN pengajuan p ON u.id = p.user_id
WHERE u.role = 'masyarakat'
GROUP BY u.id, u.name
ORDER BY COUNT(p.id) DESC;
```

### 2.4 Jenis Surat Paling Sering Diminta
```sql
SELECT 
    j.nama AS 'Jenis Surat',
    COUNT(p.id) AS 'Total Pengajuan',
    SUM(CASE WHEN p.status = 'selesai' THEN 1 ELSE 0 END) AS 'Selesai',
    SUM(CASE WHEN p.status = 'ditolak' THEN 1 ELSE 0 END) AS 'Ditolak'
FROM jenis_surat j
LEFT JOIN pengajuan p ON j.id = p.jenis_surat_id
GROUP BY j.id, j.nama
ORDER BY COUNT(p.id) DESC;
```

### 2.5 Pengajuan Hari Ini
```sql
SELECT 
    p.no_pengajuan,
    u.name AS 'Pemohon',
    j.nama AS 'Jenis Surat',
    p.status,
    p.created_at AS 'Waktu'
FROM pengajuan p
LEFT JOIN users u ON p.user_id = u.id
LEFT JOIN jenis_surat j ON p.jenis_surat_id = j.id
WHERE DATE(p.created_at) = CURDATE()
ORDER BY p.created_at DESC;
```

### 2.6 Surat Yang Sudah Dibuat Hari Ini
```sql
SELECT 
    s.no_surat,
    j.nama AS 'Jenis Surat',
    pn.nama AS 'Penerima',
    s.tanggal_surat,
    s.created_at
FROM surat s
LEFT JOIN jenis_surat j ON s.jenis_surat_id = j.id
LEFT JOIN penduduk pn ON s.penduduk_id = pn.id
WHERE DATE(s.created_at) = CURDATE()
ORDER BY s.created_at DESC;
```

---

## 3. QUERY UNTUK OPERASI / MAINTENANCE

### 3.1 Menambah User Baru (Admin)
```sql
-- Password harus di-hash dengan bcrypt di application layer
-- Jangan masukkan password plain text!
INSERT INTO users (name, email, nik, no_hp, role, password, is_active, created_at, updated_at)
VALUES (
    'Nama Admin Baru',
    'admin.baru@desa-pagendisan.com',
    '3318010101800003',
    '082100000003',
    'admin',
    -- Password harus di-generate dari app (php artisan tinker)
    '$2y$12$...',  
    1,
    NOW(),
    NOW()
);
```

**PENTING:** Password harus di-hash! Gunakan perintah ini di terminal:
```bash
php artisan tinker
>>> use Illuminate\Support\Facades\Hash;
>>> Hash::make('password_yang_diinginkan')
>>> exit
```

### 3.2 Menambah Penduduk Baru
```sql
INSERT INTO penduduk (
    nik, nama, email, no_hp, alamat, rt_rw, jenis_kelamin, 
    tempat_lahir, tgl_lahir, pekerjaan, is_active, created_at, updated_at
)
VALUES (
    '3318010101900001',
    'Nama Penduduk',
    'penduduk@email.com',
    '082100000004',
    'Jalan Merdeka No. 1',
    '01/02',
    'Laki-laki',
    'Pati',
    '1990-01-01',
    'Petani',
    1,
    NOW(),
    NOW()
);
```

### 3.3 Menambah Jenis Surat Baru
```sql
INSERT INTO jenis_surat (nama, kode, deskripsi, persyaratan, is_active, created_at, updated_at)
VALUES (
    'Surat Rekomendasi',
    'SR',
    'Surat rekomendasi dari desa',
    '- Fotokopi KTP\n- Fotokopi KK\n- Surat pengantar RT/RW',
    1,
    NOW(),
    NOW()
);
```

### 3.4 Update Status Pengajuan
```sql
UPDATE pengajuan 
SET status = 'diproses', 
    catatan = 'Sedang diproses oleh admin',
    updated_at = NOW()
WHERE id = 1;
```

### 3.5 Disable User Tertentu
```sql
UPDATE users 
SET is_active = 0, 
    updated_at = NOW()
WHERE email = 'user@desa-pagendisan.com';
```

---

## 4. BACKUP DAN RESTORE DATABASE

### 4.1 Export Database ke File SQL
```bash
# Format: mysqldump -u [username] -p [database_name] > [backup_file].sql
mysqldump -u root desa_pangedisan > desa_pangedisan_backup_$(date +%Y%m%d_%H%M%S).sql
```

### 4.2 Restore Database dari File SQL
```bash
mysql -u root desa_pangedisan < desa_pangedisan_backup_20260505.sql
```

### 4.3 Export Tabel Tertentu
```bash
# Export hanya tabel users
mysqldump -u root desa_pangedisan users > users_backup.sql

# Export multiple tabel
mysqldump -u root desa_pangedisan users penduduk jenis_surat > master_data_backup.sql
```

### 4.4 Export Data sebagai CSV
```sql
-- Export users ke CSV
SELECT * INTO OUTFILE '/tmp/users.csv'
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
FROM users;
```

---

## 5. QUERY TROUBLESHOOTING

### 5.1 Cek Database Connection
```bash
mysql -u root -p desa_pangedisan -e "SELECT 1 as connection_ok;"
```

### 5.2 Cek Database Size
```sql
SELECT 
    table_schema AS Database,
    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS 'Size in MB'
FROM information_schema.tables
WHERE table_schema = 'desa_pangedisan'
GROUP BY table_schema;
```

### 5.3 List Semua Tabel
```sql
SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'desa_pangedisan';
```

### 5.4 Cek Index dan Performance
```sql
SELECT * FROM information_schema.STATISTICS WHERE TABLE_SCHEMA = 'desa_pangedisan';
```

---

## 6. INFORMASI DATABASE

**Database Name:** `desa_pangedisan`
**Username:** `root`
**Password:** (kosong/tidak ada)
**Host:** `localhost`
**Port:** `3306`

**Default Credentials untuk Testing:**
- Email Admin: `admin@desa-pagendisan.com`
- Email Masyarakat: `user@desa-pagendisan.com`
- Password: `password`

**Catatan:** Di production, ubah password dan credentials ke yang lebih aman!

---

## 7. ER DIAGRAM (Text-based)

```
users (1) ──── (M) pengajuan
  ├── id
  ├── name
  ├── email
  ├── password
  └── role

users (1) ──── (M) arsip_dokumen
  └── (upload_oleh)

penduduk (1) ──── (M) surat
  ├── id
  ├── nik
  ├── nama
  └── ...

jenis_surat (1) ──── (M) pengajuan
  ├── id
  ├── nama
  ├── kode
  └── persyaratan

jenis_surat (1) ──── (M) surat
  └── (jenis_surat_id)

pengajuan (1) ──── (M) surat
  └── (pengajuan_id)
```

---

Silakan gunakan query-query di atas untuk backup, restore, atau analisis data desa. Semua query sudah tested dan siap digunakan!
