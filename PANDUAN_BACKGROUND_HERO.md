# Panduan Menggunakan Gambar Kantor Desa sebagai Background Hero

## Langkah-Langkah

### 1. Simpan Gambar Kantor Desa
Gambar yang Anda upload perlu disimpan ke folder yang benar:

**Path Folder:** `public/images/`
**Nama File:** `kantor-desa.jpg`
**Path Lengkap:** `public/images/kantor-desa.jpg`

### 2. Cara Upload Gambar

#### Opsi A: Menggunakan File Manager (Paling Mudah)
1. Buka file explorer di komputer Anda
2. Navigasi ke: `c:\laragon\www\Desa_pangedisan\public\images\`
3. Copy file gambar Kantor Desa ke folder tersebut
4. Rename file menjadi: `kantor-desa.jpg`

#### Opsi B: Menggunakan Terminal/Command Prompt
```bash
# Copy file dari tempat download ke folder images
copy "C:\Users\YourUsername\Downloads\kantor-desa.jpg" "c:\laragon\www\Desa_pangedisan\public\images\"
```

### 3. Verifikasi Gambar
Setelah upload, periksa:
- ✅ File ada di: `c:\laragon\www\Desa_pangedisan\public\images\kantor-desa.jpg`
- ✅ Format file: JPG (atau PNG)
- ✅ Ukuran file: Lebih dari 1MB untuk hasil terbaik

### 4. Refresh Browser
1. Buka browser
2. Refresh halaman landing (Ctrl + F5 atau Cmd + Shift + R)
3. Gambar Kantor Desa akan tampil sebagai background hero section

## Kualitas dan Ukuran

- **Dimensi Recommended:** Minimal 1920x1080 pixels (HD)
- **Aspect Ratio:** 16:9 atau lebih lebar
- **Format:** JPG (best) atau PNG
- **File Size:** 2-5 MB (untuk performa optimal)

## Penyesuaian Styling

Jika Anda ingin menyesuaikan:

### Mengubah Tingkat Overlay (Kegelapan)
Edit `resources/views/landing.blade.php`, cari:
```css
background: linear-gradient(
    135deg,
    rgba(15, 23, 42, 0.75) 0%,    /* Ubah 0.75 untuk lebih terang/gelap */
    rgba(30, 58, 138, 0.65) 50%,
    rgba(30, 64, 175, 0.7) 100%
);
```

- `0.75` = 75% opacity (lebih gelap)
- Ubah menjadi `0.5` = 50% opacity (lebih terang)
- Ubah menjadi `0.9` = 90% opacity (lebih gelap)

### Mengubah Parallax Effect
Ganti `background-attachment: fixed;` dengan:
- `background-attachment: scroll;` untuk efek normal (tidak parallax)

## Troubleshooting

### ❌ Gambar Tidak Muncul
1. Cek path file: `public/images/kantor-desa.jpg`
2. Pastikan nama file persis (case-sensitive)
3. Clear browser cache: Ctrl + Shift + Delete
4. Refresh page: Ctrl + F5

### ❌ Teks Tidak Terbaca
Tingkatkan opacity overlay (ubah nilai 0.75 menjadi 0.85 atau 0.9)

### ❌ Gambar Pixelated
Gunakan gambar dengan resolusi lebih tinggi (minimal 1920x1080)

## Default Fallback
Jika file `kantor-desa.jpg` tidak ditemukan, sistem akan menampilkan gradient biru standar (tidak error).

## Tips Estetika
- Gunakan gambar dengan komposisi yang seimbang
- Pastikan Kantor Desa berada di tengah/pusat frame
- Hindari background yang terlalu cerah (akan membuat text tidak terbaca)
- Untuk hasil terbaik, gunakan foto dengan lighting yang bagus (siang hari)

---

**Status:** ✅ Landing page sudah siap dengan background image kantor desa
**File yang diubah:** `resources/views/landing.blade.php`
