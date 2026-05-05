<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table = 'jenis_surat';

    protected $fillable = [
        'nama',
        'kode',
        'deskripsi',
        'persyaratan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }

    public function surat()
    {
        return $this->hasMany(Surat::class);
    }
}
