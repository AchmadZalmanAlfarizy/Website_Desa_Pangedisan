<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Penduduk::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nama_lengkap', 'like', "%$s%")
                  ->orWhere('nik', 'like', "%$s%")
                  ->orWhere('alamat', 'like', "%$s%");
            });
        }

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('status_hidup')) {
            $query->where('status_hidup', $request->status_hidup);
        }

        $penduduk = $query->latest()->paginate(15)->withQueryString();

        return view('admin.penduduk.index', compact('penduduk'));
    }

    public function create()
    {
        return view('admin.penduduk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'              => 'required|string|size:16|unique:penduduk,nik',
            'nama_lengkap'     => 'required|string|max:255',
            'tempat_lahir'     => 'required|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'jenis_kelamin'    => 'required|in:Laki-laki,Perempuan',
            'alamat'           => 'required|string',
            'rt'               => 'nullable|string|max:5',
            'rw'               => 'nullable|string|max:5',
            'dusun'            => 'nullable|string|max:100',
            'agama'            => 'required|string',
            'status_perkawinan'=> 'required|string',
            'pekerjaan'        => 'nullable|string|max:100',
            'pendidikan'       => 'nullable|string|max:100',
            'no_kk'            => 'nullable|string|max:16',
            'status_hidup'     => 'required|in:Hidup,Meninggal',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('penduduk', 'public');
        }

        Penduduk::create($validated);

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function show(Penduduk $penduduk)
    {
        return view('admin.penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        return view('admin.penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $validated = $request->validate([
            'nik'              => 'required|string|size:16|unique:penduduk,nik,' . $penduduk->id,
            'nama_lengkap'     => 'required|string|max:255',
            'tempat_lahir'     => 'required|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'jenis_kelamin'    => 'required|in:Laki-laki,Perempuan',
            'alamat'           => 'required|string',
            'rt'               => 'nullable|string|max:5',
            'rw'               => 'nullable|string|max:5',
            'dusun'            => 'nullable|string|max:100',
            'agama'            => 'required|string',
            'status_perkawinan'=> 'required|string',
            'pekerjaan'        => 'nullable|string|max:100',
            'pendidikan'       => 'nullable|string|max:100',
            'no_kk'            => 'nullable|string|max:16',
            'status_hidup'     => 'required|in:Hidup,Meninggal',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('penduduk', 'public');
        }

        $penduduk->update($validated);

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil dihapus.');
    }
}
