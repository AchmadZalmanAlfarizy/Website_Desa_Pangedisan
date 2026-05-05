<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Pengajuan;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_penduduk'  => Penduduk::where('status_hidup', 'Hidup')->count(),
            'laki_laki'       => Penduduk::where('jenis_kelamin', 'Laki-laki')->where('status_hidup', 'Hidup')->count(),
            'perempuan'       => Penduduk::where('jenis_kelamin', 'Perempuan')->where('status_hidup', 'Hidup')->count(),
            'total_pengajuan' => Pengajuan::count(),
            'pending'         => Pengajuan::where('status', 'pending')->count(),
            'diproses'        => Pengajuan::where('status', 'diproses')->count(),
            'selesai'         => Pengajuan::where('status', 'selesai')->count(),
            'ditolak'         => Pengajuan::where('status', 'ditolak')->count(),
            'total_surat'     => Surat::count(),
            'total_user'      => User::where('role', 'masyarakat')->count(),
        ];

        // Chart data: pengajuan per bulan (12 bulan terakhir)
        $chartData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $chartData[] = [
                'month' => $month->format('M Y'),
                'count' => Pengajuan::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count(),
            ];
        }

        $pengajuanTerbaru = Pengajuan::with(['user', 'jenisSurat'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'chartData', 'pengajuanTerbaru'));
    }
}
