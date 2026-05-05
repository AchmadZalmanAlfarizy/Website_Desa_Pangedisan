@extends('layouts.app')
@section('title', 'Kelola Pengajuan')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-inbox-fill me-2 text-primary"></i>Kelola Pengajuan Surat</h4>
    <ol class="breadcrumb"><li class="breadcrumb-item active">Pengajuan</li></ol>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" class="d-flex flex-wrap gap-2">
            <input type="text" name="search" class="form-control" style="max-width:250px;"
                   placeholder="Cari no. pengajuan / nama..." value="{{ request('search') }}">
            <select name="status" class="form-select" style="max-width:150px;">
                <option value="">Semua Status</option>
                @foreach(['pending','diproses','selesai','ditolak'] as $st)
                    <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search me-1"></i>Filter</button>
            @if(request()->anyFilled(['search','status']))
                <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No. Pengajuan</th>
                        <th>Pemohon</th>
                        <th>Jenis Surat</th>
                        <th>Tgl Pengajuan</th>
                        <th>Status</th>
                        <th style="width:80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuan as $p)
                    <tr>
                        <td><code style="font-size:.78rem;">{{ $p->no_pengajuan }}</code></td>
                        <td>
                            <div style="font-weight:500;">{{ $p->user->name }}</div>
                            <small class="text-muted">{{ $p->user->nik ?? '-' }}</small>
                        </td>
                        <td>{{ $p->jenisSurat->nama ?? '-' }}</td>
                        <td><small>{{ $p->created_at->format('d M Y, H:i') }}</small></td>
                        <td>{!! $p->status_badge !!}</td>
                        <td>
                            <a href="{{ route('admin.pengajuan.show', $p) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>Tidak ada pengajuan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pengajuan->hasPages())
    <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">{{ $pengajuan->firstItem() }}–{{ $pengajuan->lastItem() }} dari {{ $pengajuan->total() }}</small>
        {{ $pengajuan->links() }}
    </div>
    @endif
</div>
@endsection
