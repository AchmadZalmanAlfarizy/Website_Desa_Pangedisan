@extends('layouts.app')
@section('title', 'Jenis Surat')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="bi bi-file-earmark-text-fill me-2 text-primary"></i>Jenis Surat</h4>
        <ol class="breadcrumb"><li class="breadcrumb-item active">Jenis Surat</li></ol>
    </div>
    <a href="{{ route('admin.jenis-surat.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Jenis Surat
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" style="max-width:300px;"
                   placeholder="Cari nama atau kode surat..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search me-1"></i>Cari</button>
            @if(request('search'))
                <a href="{{ route('admin.jenis-surat.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Jenis Surat</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th style="width:130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisSurat as $idx => $js)
                    <tr>
                        <td>{{ $jenisSurat->firstItem() + $idx }}</td>
                        <td><span class="badge bg-primary">{{ $js->kode }}</span></td>
                        <td>
                            <div style="font-weight:500;">{{ $js->nama }}</div>
                            @if($js->persyaratan)
                                <small class="text-muted">Ada persyaratan</small>
                            @endif
                        </td>
                        <td><small class="text-muted">{{ Str::limit($js->deskripsi, 60) ?? '-' }}</small></td>
                        <td>
                            @if($js->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.jenis-surat.edit', $js) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.jenis-surat.destroy', $js) }}" class="d-inline"
                                  onsubmit="return confirm('Hapus jenis surat ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-file-earmark-x fs-2 d-block mb-2"></i>Belum ada jenis surat
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($jenisSurat->hasPages())
    <div class="card-footer">{{ $jenisSurat->links() }}</div>
    @endif
</div>
@endsection
