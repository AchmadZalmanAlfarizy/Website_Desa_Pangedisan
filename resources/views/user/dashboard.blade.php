@extends('layouts.app')
@section('title', 'Dashboard Saya')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-house-fill me-2 text-primary"></i>Dashboard</h4>
    <ol class="breadcrumb"><li class="breadcrumb-item active">Beranda</li></ol>
</div>

<div class="alert alert-primary border-0 rounded-3 mb-4" style="background:linear-gradient(135deg,#eff6ff,#dbeafe);">
    <div class="d-flex align-items-center">
        <i class="bi bi-hand-wave-fill fs-2 me-3 text-primary"></i>
        <div>
            <h6 class="mb-0">Halo, <strong>{{ auth()->user()->name }}</strong>! 👋</h6>
            <small class="text-muted">Selamat datang di portal layanan Desa Pagendisan.</small>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card bg-primary-gradient">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $stats['total'] }}</div>
                    <div class="stat-label">Total Pengajuan</div>
                </div>
                <i class="bi bi-file-earmark-text-fill stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card bg-warning-gradient">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $stats['pending'] }}</div>
                    <div class="stat-label">Pending</div>
                </div>
                <i class="bi bi-hourglass-split stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card bg-info-gradient">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $stats['diproses'] }}</div>
                    <div class="stat-label">Diproses</div>
                </div>
                <i class="bi bi-gear-fill stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card bg-success-gradient">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $stats['selesai'] }}</div>
                    <div class="stat-label">Selesai</div>
                </div>
                <i class="bi bi-check-circle-fill stat-icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clock-history me-2 text-primary"></i>Pengajuan Terbaru Saya</span>
        <a href="{{ route('user.pengajuan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No. Pengajuan</th>
                        <th>Jenis Surat</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuanTerbaru as $p)
                    <tr>
                        <td><code style="font-size:.78rem;">{{ $p->no_pengajuan }}</code></td>
                        <td>{{ $p->jenisSurat->nama ?? '-' }}</td>
                        <td><small>{{ $p->created_at->format('d M Y') }}</small></td>
                        <td>{!! $p->status_badge !!}</td>
                        <td>
                            <a href="{{ route('user.pengajuan.show', $p) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>Belum ada pengajuan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row g-3 mt-2">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body text-center py-4">
                <i class="bi bi-file-earmark-plus-fill text-primary" style="font-size:3rem;"></i>
                <h5 class="mt-3 mb-2">Ajukan Surat Baru</h5>
                <p class="text-muted mb-3" style="font-size:.875rem;">Buat pengajuan surat keterangan, domisili, dan lainnya secara online.</p>
                <a href="{{ route('user.pengajuan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>Ajukan Sekarang
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body text-center py-4">
                <i class="bi bi-person-circle text-success" style="font-size:3rem;"></i>
                <h5 class="mt-3 mb-2">Lengkapi Profil Saya</h5>
                <p class="text-muted mb-3" style="font-size:.875rem;">Pastikan data profil Anda lengkap untuk memudahkan proses pengajuan.</p>
                <a href="{{ route('user.profile') }}" class="btn btn-outline-success">
                    <i class="bi bi-pencil me-1"></i>Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
