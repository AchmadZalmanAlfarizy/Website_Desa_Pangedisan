<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Models\Pengajuan;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    // ===== ADMIN =====

    public function adminIndex(Request $request)
    {
        $query = Pengajuan::with(['user', 'jenisSurat']);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('no_pengajuan', 'like', "%$s%")
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%$s%"));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuan = $query->latest()->paginate(15)->withQueryString();

        return view('admin.pengajuan.index', compact('pengajuan'));
    }

    public function adminShow(Pengajuan $pengajuan)
    {
        $pengajuan->load(['user', 'jenisSurat', 'surat.penduduk']);
        // Ambil data penduduk user yang mengajukan
        $userPenduduk = Penduduk::where('user_id', $pengajuan->user_id)->first();
        return view('admin.pengajuan.show', compact('pengajuan', 'userPenduduk'));
    }

    public function approve(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        $pengajuan->update([
            'status'        => 'diproses',
            'catatan_admin' => $request->catatan_admin,
        ]);

        // Ambil data penduduk dari user yang mengajukan
        $penduduk = Penduduk::where('user_id', $pengajuan->user_id)->first();

        // Jika tidak ada, kembalikan error
        if (!$penduduk) {
            return redirect()->route('admin.pengajuan.show', $pengajuan)
                ->with('error', 'Data penduduk user tidak ditemukan. User belum melengkapi data kependudukan.');
        }

        $noSurat   = Surat::generateNoSurat($pengajuan->jenisSurat->kode);

        Surat::create([
            'no_surat'      => $noSurat,
            'pengajuan_id'  => $pengajuan->id,
            'penduduk_id'   => $penduduk->id,
            'jenis_surat_id'=> $pengajuan->jenis_surat_id,
            'tanggal_surat' => now()->toDateString(),
            'keperluan'     => $pengajuan->keperluan,
        ]);

        return redirect()->route('admin.pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan disetujui dan surat berhasil dibuat.');
    }

    public function selesai(Pengajuan $pengajuan)
    {
        $pengajuan->update([
            'status'          => 'selesai',
            'tanggal_selesai' => now(),
        ]);

        return redirect()->route('admin.pengajuan.index')
            ->with('success', 'Status pengajuan diubah menjadi Selesai.');
    }

    public function reject(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:500',
        ]);

        $pengajuan->update([
            'status'        => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return redirect()->route('admin.pengajuan.index')
            ->with('success', 'Pengajuan berhasil ditolak.');
    }

    // ===== USER =====

    public function userIndex(Request $request)
    {
        $pengajuan = Pengajuan::with('jenisSurat')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.pengajuan.index', compact('pengajuan'));
    }

    public function userCreate()
    {
        $jenisSurat = JenisSurat::where('is_active', true)->get();
        return view('user.pengajuan.create', compact('jenisSurat'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'jenis_surat_id'    => 'required|exists:jenis_surat,id',
            'keperluan'         => 'required|string|max:255',
            'keterangan'        => 'nullable|string|max:1000',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = [
            'no_pengajuan'   => Pengajuan::generateNoPengajuan(),
            'user_id'        => Auth::id(),
            'jenis_surat_id' => $request->jenis_surat_id,
            'keperluan'      => $request->keperluan,
            'keterangan'     => $request->keterangan,
            'status'         => 'pending',
        ];

        if ($request->hasFile('dokumen_pendukung')) {
            $data['dokumen_pendukung'] = $request->file('dokumen_pendukung')
                ->store('dokumen', 'public');
        }

        Pengajuan::create($data);

        return redirect()->route('user.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dikirim. Silakan tunggu proses verifikasi.');
    }

    public function userShow(Pengajuan $pengajuan)
    {
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403);
        }
        $pengajuan->load(['jenisSurat', 'surat.penduduk']);
        return view('user.pengajuan.show', compact('pengajuan'));
    }

    // ===== PDF =====

    public function downloadSurat(Surat $surat)
    {
        // Check authorization
        if (Auth::user()->isMasyarakat()) {
            if ($surat->pengajuan->user_id !== Auth::id()) {
                abort(403);
            }
        }

        $surat->load(['penduduk', 'jenisSurat', 'pengajuan.user']);

        $pdf = Pdf::loadView('pdf.surat', compact('surat'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('surat-' . $surat->no_surat . '.pdf');
    }
}
