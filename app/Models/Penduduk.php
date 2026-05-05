<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = 'penduduk';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'dusun',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan',
        'kewarganegaraan',
        'no_kk',
        'status_hidup',
        'foto',
        'user_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function surat()
    {
        return $this->hasMany(Surat::class);
    }

    public function getUmurAttribute(): int
    {
        return $this->tanggal_lahir->age;
    }
}
