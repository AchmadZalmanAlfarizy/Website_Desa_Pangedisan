<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'no_hp',
        'nik',
        'role',
        'password',
        'foto',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMasyarakat(): bool
    {
        return $this->role === 'masyarakat';
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }

    public function penduduk()
    {
        return $this->hasOne(Penduduk::class);
    }

    public function arsipDokumen()
    {
        return $this->hasMany(ArsipDokumen::class);
    }
}
