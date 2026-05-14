#!/usr/bin/env php
<?php
/**
 * Script untuk verifikasi dan membantu setup gambar background hero
 * Run: php public/images/setup-hero-image.php
 */

$imagePath = __DIR__ . '/kantor-desa.jpg';

if (file_exists($imagePath)) {
    echo "\n✅ Gambar kantor-desa.jpg sudah ditemukan!\n";
    echo "📏 Ukuran file: " . round(filesize($imagePath) / 1024 / 1024, 2) . " MB\n";
    echo "✨ Background hero sudah siap digunakan.\n\n";
} else {
    echo "\n❌ File kantor-desa.jpg belum ditemukan di public/images/\n";
    echo "📝 Instruksi:\n";
    echo "1. Simpan gambar Kantor Desa ke folder: public/images/\n";
    echo "2. Rename menjadi: kantor-desa.jpg\n";
    echo "3. Ukuran recommended: minimal 1920x1080 pixels\n";
    echo "4. Refresh browser setelah upload\n\n";
}
?>
