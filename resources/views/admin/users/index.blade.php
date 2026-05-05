@extends('layouts.app')
@section('title', 'Manajemen Pengguna')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="bi bi-shield-lock-fill me-2 text-primary"></i>Manajemen Pengguna</h4>
        <ol class="breadcrumb"><li class="breadcrumb-item active">Pengguna</li></ol>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-1"></i>Tambah Pengguna
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" class="d-flex flex-wrap gap-2">
            <input type="text" name="search" class="form-control" style="max-width:280px;"
                   placeholder="Cari nama, email, NIK..." value="{{ request('search') }}">
            <select name="role" class="form-select" style="max-width:150px;">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>Admin</option>
                <option value="masyarakat" {{ request('role')=='masyarakat' ? 'selected' : '' }}>Masyarakat</option>
            </select>
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search me-1"></i>Cari</button>
            @if(request()->anyFilled(['search','role']))
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama / Email</th>
                        <th>NIK</th>
                        <th>No. HP</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $idx => $u)
                    <tr>
                        <td>{{ $users->firstItem() + $idx }}</td>
                        <td>
                            <div style="font-weight:500;">{{ $u->name }}</div>
                            <small class="text-muted">{{ $u->email }}</small>
                        </td>
                        <td><code style="font-size:.78rem;">{{ $u->nik ?? '-' }}</code></td>
                        <td>{{ $u->no_hp ?? '-' }}</td>
                        <td>
                            @if($u->role === 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @else
                                <span class="badge bg-secondary">Masyarakat</span>
                            @endif
                        </td>
                        <td>
                            @if($u->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.users.toggle-active', $u) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $u->is_active ? 'btn-outline-secondary' : 'btn-outline-success' }}" title="{{ $u->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <i class="bi bi-{{ $u->is_active ? 'toggle-on' : 'toggle-off' }}"></i>
                                </button>
                            </form>
                            @if($u->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="d-inline"
                                  onsubmit="return confirm('Hapus pengguna {{ $u->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-people fs-2 d-block mb-2"></i>Tidak ada pengguna
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
    <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">{{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }}</small>
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
