@extends('layouts.app')
@section('title', 'Pengajuan Saya')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="bi bi-list-check me-2 text-primary"></i>Pengajuan Saya</h4>
        <ol class="breadcrumb"><li class="breadcrumb-item active">Pengajuan</li></ol>
    </div>
    <a href="{{ route('user.pengajuan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Ajukan Baru
    </a>
</div>

<div class="card">
    <div class="card-header">
        <form method="GET" class="d-flex flex-wrap gap-2">
            <select name="status" class="form-select" style="max-width:160px;">
                <option value="">Semua Status</option>
                @foreach(['pending','diproses','selesai','ditolak'] as $st)
                    <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-filter me-1"></i>Filter</button>
            @if(request('status'))
                <a href="{{ route('user.pengajuan.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No. Pengajuan</th>
                        <th>Jenis Surat</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th style="width:180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuan as $p)
                    <tr>
                        <td><code style="font-size:.78rem;">{{ $p->no_pengajuan }}</code></td>
                        <td>{{ $p->jenisSurat->nama ?? '-' }}</td>
                        <td>{{ Str::limit($p->keperluan, 45) }}</td>
                        <td><small>{{ $p->created_at->format('d M Y') }}</small></td>
                        <td>{!! $p->status_badge !!}</td>
                        <td>
                            <a href="{{ route('user.pengajuan.show', $p) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>Detail
                            </a>
                            @if($p->status === 'pending')
                            <a href="{{ route('user.pengajuan.edit', $p) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('user.pengajuan.cancel', $p) }}" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin membatalkan pengajuan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Batalkan">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Belum ada pengajuan surat.
                            <a href="{{ route('user.pengajuan.create') }}" class="d-block mt-2 btn btn-sm btn-primary">Ajukan Sekarang</a>
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
