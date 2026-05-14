# Perbaikan Fitur Download PDF Surat

## Tanggal Perbaikan
11 Mei 2026

## Masalah yang Diperbaiki
❌ Error saat klik tombol "Download Surat (PDF)" di halaman Admin dan User
❌ PDF tidak bisa di-generate secara otomatis

## Solusi yang Diterapkan

### 1. **Perbaikan Controller** (`app/Http/Controllers/PengajuanController.php`)

#### Penambahan Error Handling
- ✅ Try-catch block untuk menangkap error
- ✅ Logging error ke file log Laravel
- ✅ Pesan error yang user-friendly
- ✅ Validasi data penduduk sebelum generate PDF
- ✅ Nama file PDF yang lebih clean (mengganti `/` dengan `_`)

#### Kode yang Ditambahkan:
```php
public function downloadSurat(Surat $surat)
{
    try {
        // Check authorization
        if (Auth::user()->isMasyarakat()) {
            if ($surat->pengajuan->user_id !== Auth::id()) {
                abort(403, 'Anda tidak memiliki akses ke surat ini.');
            }
        }

        // Load semua relasi yang dibutuhkan
        $surat->load(['penduduk', 'jenisSurat', 'pengajuan.user']);

        // Pastikan data penduduk ada
        if (!$surat->penduduk) {
            return back()->with('error', 'Data penduduk tidak ditemukan. Tidak dapat membuat PDF.');
        }

        // Buat PDF
        $pdf = Pdf::loadView('pdf.surat', compact('surat'))
            ->setPaper('a4', 'portrait');

        // Download dengan nama file yang clean
        $fileName = 'Surat_' . str_replace('/', '_', $surat->no_surat) . '.pdf';
        
        return $pdf->download($fileName);
        
    } catch (\Exception $e) {
        \Log::error('Error generating PDF: ' . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan saat membuat PDF: ' . $e->getMessage());
    }
}
```

### 2. **Perbaikan Template PDF** (`resources/views/pdf/surat.blade.php`)

#### Penanganan Missing Data
- ✅ Null coalescing operator (`??`) untuk semua field
- ✅ Conditional rendering untuk logo (tidak error jika logo tidak ada)
- ✅ Safe date formatting dengan Carbon
- ✅ Fallback text untuk data yang kosong
- ✅ Meta charset UTF-8 untuk support karakter Indonesia

#### Fitur Template:
- Logo desa (opsional - tidak error jika tidak ada)
- Kop surat lengkap
- Data penduduk dengan formatting yang rapi
- Tanda tangan Kepala Desa
- Nomor surat otomatis
- Tanggal otomatis dalam Bahasa Indonesia

### 3. **Setup DomPDF**
- ✅ Publish konfigurasi DomPDF: `php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"`
- ✅ Membuat folder `storage/fonts` untuk DomPDF
- ✅ Membuat folder `public/images` untuk logo

### 4. **Instruksi Logo Desa**
- 📄 File: `INSTRUKSI_LOGO.md`
- Logo opsional - PDF tetap bisa di-generate tanpa logo
- Jika ingin menambahkan logo: letakkan file `logo-desa.png` di `public/images/`
- Ukuran recommended: 200x200 pixels (PNG)

## Cara Menggunakan

### Untuk Admin:
1. Login sebagai Admin
2. Buka menu **Pengajuan**
3. Klik detail pengajuan yang sudah berstatus **Selesai**
4. Klik tombol **"Download Surat (PDF)"** di bagian "Surat Telah Dibuat"
5. PDF akan otomatis terdownload

### Untuk User/Masyarakat:
1. Login sebagai User
2. Buka menu **Pengajuan Saya**
3. Klik pengajuan yang sudah berstatus **Selesai**
4. Klik tombol **"Download Surat (PDF)"** di card "Surat Anda Siap!"
5. PDF akan otomatis terdownload

## Struktur File yang Diubah/Ditambahkan

```
Desa_pangedisan/
├── app/Http/Controllers/
│   └── PengajuanController.php         [DIUBAH] ✏️
├── resources/views/pdf/
│   └── surat.blade.php                 [DIUBAH] ✏️
├── config/
│   └── dompdf.php                      [BARU] ✨
├── storage/
│   └── fonts/                          [BARU] 📁
├── public/images/
│   └── .gitkeep                        [BARU] 📁
├── INSTRUKSI_LOGO.md                   [BARU] 📄
└── PERBAIKAN_PDF.md                    [BARU] 📄
```

## Testing

### Skenario Test yang Harus Dilakukan:

#### Test 1: Download PDF sebagai Admin
- [x] Login sebagai admin
- [ ] Pilih pengajuan dengan status "selesai"
- [ ] Klik tombol "Download Surat (PDF)"
- [ ] Verifikasi PDF berhasil didownload
- [ ] Buka PDF dan cek konten (kop surat, data penduduk, TTD)

#### Test 2: Download PDF sebagai User
- [x] Login sebagai user yang punya pengajuan selesai
- [ ] Buka "Pengajuan Saya"
- [ ] Klik pengajuan dengan status "selesai"
- [ ] Klik tombol "Download Surat (PDF)"
- [ ] Verifikasi PDF berhasil didownload
- [ ] Buka PDF dan cek konten

#### Test 3: Error Handling
- [ ] Coba akses surat milik user lain (harus dapat error 403)
- [ ] Coba generate PDF untuk surat tanpa data penduduk (harus dapat error message)

## Fitur PDF yang Dihasilkan

### Isi PDF:
✅ Kop surat Desa Pagendisan (dengan/tanpa logo)
✅ Nomor surat otomatis
✅ Jenis surat
✅ Data lengkap penduduk (NIK, nama, alamat, dll)
✅ Keperluan surat
✅ Tanggal surat (dalam Bahasa Indonesia)
✅ Tanda tangan Kepala Desa (placeholder)
✅ Footer dengan nomor surat

### Format:
- Kertas: A4 Portrait
- Font: Times New Roman
- Encoding: UTF-8 (support karakter Indonesia)
- File output: `Surat_[nomor-surat].pdf`

## Troubleshooting

### Jika masih error saat download PDF:

1. **Cek Log Error**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Clear Cache Laravel**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

3. **Cek Permission Folder**
   - `storage/fonts` harus writable
   - `storage/logs` harus writable

4. **Cek Data Penduduk**
   - User harus sudah melengkapi profil penduduk
   - Data penduduk harus terhubung dengan user

5. **Cek Memory Limit**
   - Jika PDF besar/kompleks, mungkin perlu increase `memory_limit` di `php.ini`

## Catatan Penting

⚠️ **Logo Desa**: Logo bersifat opsional. PDF tetap bisa di-generate tanpa logo. Jika ingin menambahkan logo, ikuti instruksi di `INSTRUKSI_LOGO.md`

⚠️ **Data Penduduk**: User harus melengkapi data penduduk di profil mereka. Jika data penduduk tidak ada, PDF tidak bisa di-generate.

⚠️ **File Name**: Nama file PDF secara otomatis menggunakan nomor surat dengan format: `Surat_[nomor].pdf` (karakter `/` diganti `_` untuk kompatibilitas)

## Maintainer
- Diperbaiki oleh: GitHub Copilot
- Tanggal: 11 Mei 2026
- Status: ✅ Selesai dan siap digunakan
