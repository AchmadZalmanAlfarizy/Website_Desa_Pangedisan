@extends('layouts.app')
@section('title', 'Arsip Dokumen')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="bi bi-archive-fill me-2 text-primary"></i>Arsip Dokumen</h4>
        <ol class="breadcrumb"><li class="breadcrumb-item active">Arsip</li></ol>
    </div>
    <a href="{{ route('admin.arsip.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Upload Dokumen
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" class="d-flex flex-wrap gap-2">
            <input type="text" name="search" class="form-control" style="max-width:260px;"
                   placeholder="Cari judul atau kode arsip..." value="{{ request('search') }}">
            <select name="kategori" class="form-select" style="max-width:180px;">
                <option value="">Semua Kategori</option>
                @foreach(['Surat Masuk','Surat Keluar','Peraturan','Laporan','Lainnya'] as $kat)
                    <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search me-1"></i>Filter</button>
            @if(request()->anyFilled(['search','kategori']))
                <a href="{{ route('admin.arsip.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Arsip</th>
                        <th>Judul Dokumen</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                        <th>Ukuran</th>
                        <th>Diupload Oleh</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($arsip as $idx => $a)
                    <tr>
                        <td>{{ $arsip->firstItem() + $idx }}</td>
                        <td><code style="font-size:.78rem;">{{ $a->kode_arsip }}</code></td>
                        <td>
                            <div style="font-weight:500;">{{ $a->judul }}</div>
                            @if($a->deskripsi)<small class="text-muted">{{ Str::limit($a->deskripsi, 50) }}</small>@endif
                        </td>
                        <td><span class="badge bg-info text-dark">{{ $a->kategori }}</span></td>
                        <td>{{ $a->tahun }}</td>
                        <td><small>{{ $a->file_size_formatted }}</small></td>
                        <td><small>{{ $a->user->name ?? '-' }}</small></td>
                        <td>
                            <a href="{{ route('admin.arsip.download', $a) }}" class="btn btn-sm btn-outline-success" title="Download">
                                <i class="bi bi-download"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.arsip.destroy', $a) }}" class="d-inline"
                                  onsubmit="return confirm('Hapus dokumen arsip ini?')">
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
                            <i class="bi bi-archive fs-2 d-block mb-2"></i>Belum ada arsip dokumen
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($arsip->hasPages())
    <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">{{ $arsip->firstItem() }}–{{ $arsip->lastItem() }} dari {{ $arsip->total() }}</small>
        {{ $arsip->links() }}
    </div>
    @endif
</div>
@endsection
