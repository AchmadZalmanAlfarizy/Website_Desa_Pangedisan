<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('name', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('nik', 'like', "%$s%");
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'nik'       => 'nullable|string|size:16|unique:users',
            'no_hp'     => 'nullable|string|max:15',
            'role'      => 'required|in:admin,masyarakat',
            'password'  => 'required|min:6|confirmed',
            'is_active' => 'boolean',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'nik'       => $request->nik,
            'no_hp'     => $request->no_hp,
            'role'      => $request->role,
            'password'  => Hash::make($request->password),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'nik'       => 'nullable|string|size:16|unique:users,nik,' . $user->id,
            'no_hp'     => 'nullable|string|max:15',
            'role'      => 'required|in:admin,masyarakat',
            'password'  => 'nullable|min:6|confirmed',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'nik'       => $request->nik,
            'no_hp'     => $request->no_hp,
            'role'      => $request->role,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function toggleActive(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "User berhasil $status.");
    }
}
