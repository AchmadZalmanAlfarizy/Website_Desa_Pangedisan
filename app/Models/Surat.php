<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';

    protected $fillable = [
        'no_surat',
        'pengajuan_id',
        'penduduk_id',
        'jenis_surat_id',
        'tanggal_surat',
        'keperluan',
        'isi_surat',
        'file_surat',
        'ttd_kepala_desa',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public static function generateNoSurat(string $kodeJenis): string
    {
        $year  = date('Y');
        $month = date('m');
        $last  = static::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
        return sprintf('%04d/%s/PGD/%s/%s', $last + 1, $kodeJenis, $month, $year);
    }
}
