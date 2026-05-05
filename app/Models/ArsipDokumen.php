<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipDokumen extends Model
{
    protected $table = 'arsip_dokumen';

    protected $fillable = [
        'judul',
        'kode_arsip',
        'kategori',
        'deskripsi',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'tahun',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileSizeFormattedAttribute(): string
    {
        $size = $this->file_size;
        if ($size >= 1048576) return round($size / 1048576, 2) . ' MB';
        if ($size >= 1024) return round($size / 1024, 2) . ' KB';
        return $size . ' B';
    }
}
