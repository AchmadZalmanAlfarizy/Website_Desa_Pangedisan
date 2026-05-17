<?php

namespace App\Http\Controllers;

use App\Models\ArsipDokumen;
use App\Models\JenisSurat;
use App\Models\Penduduk;
use App\Models\Pengajuan;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

        $surat = Surat::create([
            'no_surat'      => $noSurat,
            'pengajuan_id'  => $pengajuan->id,
            'penduduk_id'   => $penduduk->id,
            'jenis_surat_id'=> $pengajuan->jenis_surat_id,
            'tanggal_surat' => now()->toDateString(),
            'keperluan'     => $pengajuan->keperluan,
        ]);

        // ===== Buat Arsip Otomatis =====
        try {
            // Load relasi untuk PDF
            $surat->load(['penduduk', 'jenisSurat', 'pengajuan.user']);

            // Generate PDF
            $pdf = Pdf::loadView('pdf.surat', compact('surat'))
                ->setPaper('a4', 'portrait');

            // Siapkan path file
            $filename = 'Surat_' . str_replace('/', '_', $surat->no_surat) . '.pdf';
            $path = 'arsip/surat/' . now()->format('Y/m') . '/' . $filename;

            // Simpan PDF ke storage
            Storage::disk('public')->put($path, $pdf->output());

            // Ambil ukuran file
            $fileSize = Storage::disk('public')->size($path);

            // Buat record di arsip_dokumen
            ArsipDokumen::create([
                'judul'       => $surat->jenisSurat->nama . ' - ' . ($penduduk->nama_lengkap ?? $pengajuan->user->name),
                'kode_arsip'  => $surat->no_surat,
                'kategori'    => $surat->jenisSurat->nama,
                'deskripsi'   => 'Arsip otomatis dari pengajuan ' . $pengajuan->no_pengajuan . ' - ' . $pengajuan->keperluan,
                'tahun'       => now()->year,
                'file_path'   => $path,
                'file_name'   => $filename,
                'file_type'   => 'application/pdf',
                'file_size'   => $fileSize,
                'user_id'     => Auth::id(),
            ]);
        } catch (\Exception $e) {
            Log::error('Error membuat arsip otomatis: ' . $e->getMessage());
            // Tidak menggagalkan approve() jika arsip gagal dibuat
        }

        return redirect()->route('admin.pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan disetujui, surat berhasil dibuat, dan arsip otomatis tersimpan.');
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

    public function userEdit(Pengajuan $pengajuan)
    {
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403);
        }
        if ($pengajuan->status !== 'pending') {
            return redirect()->route('user.pengajuan.show', $pengajuan)
                ->with('error', 'Pengajuan hanya dapat diedit saat berstatus Pending.');
        }
        $jenisSurat = JenisSurat::where('is_active', true)->get();
        return view('user.pengajuan.edit', compact('pengajuan', 'jenisSurat'));
    }

    public function userUpdate(Request $request, Pengajuan $pengajuan)
    {
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403);
        }
        if ($pengajuan->status !== 'pending') {
            return redirect()->route('user.pengajuan.show', $pengajuan)
                ->with('error', 'Pengajuan hanya dapat diedit saat berstatus Pending.');
        }

        $request->validate([
            'jenis_surat_id'    => 'required|exists:jenis_surat,id',
            'keperluan'         => 'required|string|max:255',
            'keterangan'        => 'nullable|string|max:1000',
            'dokumen_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = [
            'jenis_surat_id' => $request->jenis_surat_id,
            'keperluan'      => $request->keperluan,
            'keterangan'     => $request->keterangan,
        ];

        if ($request->hasFile('dokumen_pendukung')) {
            // Delete old file if exists
            if ($pengajuan->dokumen_pendukung) {
                Storage::disk('public')->delete($pengajuan->dokumen_pendukung);
            }
            $data['dokumen_pendukung'] = $request->file('dokumen_pendukung')
                ->store('dokumen', 'public');
        }

        $pengajuan->update($data);

        return redirect()->route('user.pengajuan.show', $pengajuan)
            ->with('success', 'Pengajuan berhasil diperbarui.');
    }

    public function userCancel(Pengajuan $pengajuan)
    {
        if ($pengajuan->user_id !== Auth::id()) {
            abort(403);
        }
        if ($pengajuan->status !== 'pending') {
            return redirect()->route('user.pengajuan.show', $pengajuan)
                ->with('error', 'Pengajuan hanya dapat dibatalkan saat berstatus Pending.');
        }

        // Delete uploaded document if exists
        if ($pengajuan->dokumen_pendukung) {
            Storage::disk('public')->delete($pengajuan->dokumen_pendukung);
        }

        $pengajuan->delete();

        return redirect()->route('user.pengajuan.index')
            ->with('success', 'Pengajuan berhasil dibatalkan.');
    }

    // ===== PDF =====

    public function downloadSurat(Surat $surat)
    {
        try {
            // Check authorization
            /** @var \App\Models\User $user */
            $user = Auth::user();
            
            if ($user->isMasyarakat()) {
                if ($surat->pengajuan->user_id !== Auth::id()) {
                    abort(403, 'Anda tidak memiliki akses ke surat ini.');
                }
            }

            // Load semua relasi yang dibutuhkan
            $surat->load(['penduduk', 'jenisSurat', 'pengajuan.user']);

            // Pastikan data penduduk ada
            if (!$surat->penduduk) {
                return back()->with('error', 'Data penduduk tidak ditemukan. Tidak dapat membuat PDF.');
            }

            // Buat PDF
            $pdf = Pdf::loadView('pdf.surat', compact('surat'))
                ->setPaper('a4', 'portrait');

            // Download dengan nama file yang clean
            $fileName = 'Surat_' . str_replace('/', '_', $surat->no_surat) . '.pdf';
            
            return $pdf->download($fileName);
            
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuat PDF: ' . $e->getMessage());
        }
    }
}
