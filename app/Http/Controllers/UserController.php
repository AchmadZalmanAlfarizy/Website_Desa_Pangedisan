<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $user  = Auth::user();
        $stats = [
            'total'    => Pengajuan::where('user_id', $user->id)->count(),
            'pending'  => Pengajuan::where('user_id', $user->id)->where('status', 'pending')->count(),
            'diproses' => Pengajuan::where('user_id', $user->id)->where('status', 'diproses')->count(),
            'selesai'  => Pengajuan::where('user_id', $user->id)->where('status', 'selesai')->count(),
            'ditolak'  => Pengajuan::where('user_id', $user->id)->where('status', 'ditolak')->count(),
        ];

        $pengajuanTerbaru = Pengajuan::with('jenisSurat')
            ->where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('user.dashboard', compact('stats', 'pengajuanTerbaru'));
    }

    public function profile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'              => 'required|string|max:255',
            'no_hp'             => 'nullable|string|max:15',
            'password'          => 'nullable|min:6|confirmed',
            'tempat_lahir'      => 'nullable|string|max:255',
            'tanggal_lahir'     => 'nullable|date',
            'jenis_kelamin'     => 'nullable|in:Laki-laki,Perempuan',
            'agama'             => 'nullable|string|max:50',
            'status_perkawinan' => 'nullable|string|max:50',
            'alamat'            => 'nullable|string|max:255',
            'rt'                => 'nullable|string|max:5',
            'rw'                => 'nullable|string|max:5',
            'dusun'             => 'nullable|string|max:100',
            'pekerjaan'         => 'nullable|string|max:100',
            'pendidikan'        => 'nullable|string|max:50',
        ]);

        // Update User
        $userData = [
            'name'  => $request->name,
            'no_hp' => $request->no_hp,
        ];

        if ($request->filled('password')) {
            $userData['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $user->update($userData);

        // Update atau Create Penduduk
        $penduduk = Penduduk::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nik'            => $user->nik,
                'nama_lengkap'   => $user->name,
                'kewarganegaraan'=> 'WNI',
                'status_hidup'   => 'Hidup',
            ]
        );

        $pendudukData = [
            'nama_lengkap'      => $request->name,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'agama'             => $request->agama,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat'            => $request->alamat,
            'rt'                => $request->rt,
            'rw'                => $request->rw,
            'dusun'             => $request->dusun,
            'pekerjaan'         => $request->pekerjaan,
            'pendidikan'        => $request->pendidikan,
        ];

        $penduduk->update($pendudukData);

        return back()->with('success', 'Profil dan data kependudukan berhasil diperbarui.');
    }
}
