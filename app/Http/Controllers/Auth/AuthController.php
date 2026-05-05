<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->isAdmin() ? 'admin.dashboard' : 'user.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        $user = Auth::user();

        if (!$user->is_active) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Akun Anda tidak aktif. Hubungi admin.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(
            $user->isAdmin() ? route('admin.dashboard') : route('user.dashboard')
        )->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->isAdmin() ? 'admin.dashboard' : 'user.dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'nik'                   => 'required|string|size:16|unique:users,nik',
            'no_hp'                 => 'required|string|max:15',
            'password'              => 'required|min:6|confirmed',
        ], [
            'name.required'         => 'Nama wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.unique'          => 'Email sudah terdaftar.',
            'nik.required'          => 'NIK wajib diisi.',
            'nik.size'              => 'NIK harus 16 digit.',
            'nik.unique'            => 'NIK sudah terdaftar.',
            'no_hp.required'        => 'Nomor HP wajib diisi.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'nik'      => $request->nik,
            'no_hp'    => $request->no_hp,
            'password' => Hash::make($request->password),
            'role'     => 'masyarakat',
            'is_active'=> true,
        ]);

        // Buat record Penduduk otomatis berdasarkan data registrasi
        Penduduk::create([
            'nik'            => $request->nik,
            'nama_lengkap'   => $request->name,
            'user_id'        => $user->id,
            'kewarganegaraan'=> 'WNI',
            'status_hidup'   => 'Hidup',
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard')
            ->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
