<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';

    protected $fillable = [
        'no_pengajuan',
        'user_id',
        'jenis_surat_id',
        'keperluan',
        'keterangan',
        'dokumen_pendukung',
        'status',
        'catatan_admin',
        'tanggal_pengajuan',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function surat()
    {
        return $this->hasOne(Surat::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending'   => '<span class="badge bg-warning text-dark">Pending</span>',
            'diproses'  => '<span class="badge bg-info">Diproses</span>',
            'selesai'   => '<span class="badge bg-success">Selesai</span>',
            'ditolak'   => '<span class="badge bg-danger">Ditolak</span>',
            default     => '<span class="badge bg-secondary">Unknown</span>',
        };
    }

    public static function generateNoPengajuan(): string
    {
        $year  = date('Y');
        $month = date('m');
        $last  = static::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
        return sprintf('PGJ/%s/%s/%04d', $year, $month, $last + 1);
    }
}
