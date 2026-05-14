@extends('layouts.app')
@section('title', 'Data Penduduk')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="bi bi-people-fill me-2 text-primary"></i>Data Penduduk</h4>
        <ol class="breadcrumb"><li class="breadcrumb-item active">Penduduk</li></ol>
    </div>
    <a href="{{ route('admin.penduduk.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Penduduk
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" class="d-flex flex-wrap gap-2">
            <input type="text" name="search" class="form-control" style="max-width:280px;"
                   placeholder="Cari nama, NIK, alamat..." value="{{ request('search') }}">
            <select name="jenis_kelamin" class="form-select" style="max-width:160px;">
                <option value="">Semua Jenis Kelamin</option>
                <option value="Laki-laki" {{ request('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ request('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <select name="status_hidup" class="form-select" style="max-width:140px;">
                <option value="">Semua Status</option>
                <option value="Hidup" {{ request('status_hidup')=='Hidup' ? 'selected' : '' }}>Hidup</option>
                <option value="Meninggal" {{ request('status_hidup')=='Meninggal' ? 'selected' : '' }}>Meninggal</option>
            </select>
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search me-1"></i>Cari</button>
            @if(request()->anyFilled(['search','jenis_kelamin','status_hidup']))
                <a href="{{ route('admin.penduduk.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg me-1"></i>Reset</a>
            @endif
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>L/P</th>
                        <th>Tgl Lahir / Umur</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penduduk as $idx => $p)
                    <tr>
                        <td class="text-muted">{{ $penduduk->firstItem() + $idx }}</td>
                        <td><code style="font-size:.78rem;">{{ $p->nik }}</code></td>
                        <td>
                            <div class="fw-500" style="font-weight:500;">{{ $p->nama_lengkap }}</div>
                            <small class="text-muted">{{ $p->pekerjaan ?? '-' }}</small>
                        </td>
                        <td>
                            @if($p->jenis_kelamin === 'Laki-laki')
                                <span class="badge" style="background:#f0fdf4;color:#15803d;">L</span>
                            @else
                                <span class="badge" style="background:#fdf2f8;color:#9333ea;">P</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-size:.8rem;">{{ $p->tanggal_lahir->format('d/m/Y') }}</div>
                            <small class="text-muted">{{ $p->umur }} tahun</small>
                        </td>
                        <td style="max-width:200px;">
                            <div style="font-size:.82rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $p->alamat }}</div>
                            <small class="text-muted">RT {{ $p->rt }}/RW {{ $p->rw }}</small>
                        </td>
                        <td>
                            @if($p->status_hidup === 'Hidup')
                                <span class="badge bg-success">Hidup</span>
                            @else
                                <span class="badge bg-secondary">Meninggal</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.penduduk.show', $p) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.penduduk.edit', $p) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.penduduk.destroy', $p) }}" class="d-inline"
                                  onsubmit="return confirm('Hapus data penduduk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-people fs-2 d-block mb-2"></i>
                            Belum ada data penduduk
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($penduduk->hasPages())
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Menampilkan {{ $penduduk->firstItem() }}–{{ $penduduk->lastItem() }} dari {{ $penduduk->total() }} data
            </small>
            {{ $penduduk->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
