<?php

namespace App\Http\Controllers;

use App\Models\ArsipDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArsipDokumenController extends Controller
{
    public function index(Request $request)
    {
        $query = ArsipDokumen::with('user');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('judul', 'like', "%$s%")
                  ->orWhere('kode_arsip', 'like', "%$s%");
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $arsip = $query->latest()->paginate(15)->withQueryString();
        $kategoriList = ArsipDokumen::distinct()->pluck('kategori');

        return view('admin.arsip.index', compact('arsip', 'kategoriList'));
    }

    public function create()
    {
        $kategoriList = ArsipDokumen::distinct()->pluck('kategori');
        return view('admin.arsip.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'kode_arsip' => 'nullable|string|max:50',
            'kategori'   => 'required|string|max:100',
            'deskripsi'  => 'nullable|string',
            'tahun'      => 'nullable|integer|min:2000|max:2100',
            'file'       => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ]);

        $file      = $request->file('file');
        $filePath  = $file->store('arsip', 'public');

        ArsipDokumen::create([
            'judul'      => $request->judul,
            'kode_arsip' => $request->kode_arsip,
            'kategori'   => $request->kategori,
            'deskripsi'  => $request->deskripsi,
            'tahun'      => $request->tahun,
            'file_path'  => $filePath,
            'file_name'  => $file->getClientOriginalName(),
            'file_type'  => $file->getMimeType(),
            'file_size'  => $file->getSize(),
            'user_id'    => Auth::id(),
        ]);

        return redirect()->route('admin.arsip.index')
            ->with('success', 'Dokumen arsip berhasil diunggah.');
    }

    public function download(ArsipDokumen $arsip)
    {
        if (!Storage::disk('public')->exists($arsip->file_path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return response()->download(
            Storage::disk('public')->path($arsip->file_path),
            $arsip->file_name ?: basename($arsip->file_path)
        );
    }

    public function destroy(ArsipDokumen $arsip)
    {
        Storage::disk('public')->delete($arsip->file_path);
        $arsip->delete();

        return redirect()->route('admin.arsip.index')
            ->with('success', 'Arsip berhasil dihapus.');
    }
}
