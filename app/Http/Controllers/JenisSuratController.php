<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = JenisSurat::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('nama', 'like', "%$s%")->orWhere('kode', 'like', "%$s%");
        }

        $jenisSurat = $query->latest()->paginate(15)->withQueryString();

        return view('admin.jenis-surat.index', compact('jenisSurat'));
    }

    public function create()
    {
        return view('admin.jenis-surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'         => 'required|string|max:255',
            'kode'         => 'required|string|max:20|unique:jenis_surat,kode',
            'deskripsi'    => 'nullable|string',
            'persyaratan'  => 'nullable|string',
            'is_active'    => 'boolean',
        ]);

        JenisSurat::create($request->all());

        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    public function edit(JenisSurat $jenisSurat)
    {
        return view('admin.jenis-surat.edit', compact('jenisSurat'));
    }

    public function update(Request $request, JenisSurat $jenisSurat)
    {
        $request->validate([
            'nama'         => 'required|string|max:255',
            'kode'         => 'required|string|max:20|unique:jenis_surat,kode,' . $jenisSurat->id,
            'deskripsi'    => 'nullable|string',
            'persyaratan'  => 'nullable|string',
            'is_active'    => 'boolean',
        ]);

        $jenisSurat->update($request->all());

        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil diperbarui.');
    }

    public function destroy(JenisSurat $jenisSurat)
    {
        $jenisSurat->delete();
        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil dihapus.');
    }
}
