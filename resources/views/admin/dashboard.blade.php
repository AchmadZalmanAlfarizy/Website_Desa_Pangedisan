@extends('layouts.app')
@section('title', 'Dashboard Admin')

@push('styles')
<style>
    .chart-container { position: relative; height: 280px; }
</style>
@endpush

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="bi bi-speedometer2 me-2 text-primary"></i>Dashboard</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Beranda / Dashboard</li>
            </ol>
        </nav>
    </div>
    <div class="text-muted" style="font-size:.85rem;">
        <i class="bi bi-calendar3 me-1"></i>
        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
    </div>
</div>

{{-- Stat Cards Row 1 --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card bg-primary-gradient">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ number_format($stats['total_penduduk']) }}</div>
                    <div class="stat-label">Total Penduduk</div>
                </div>
                <i class="bi bi-people-fill stat-icon"></i>
            </div>
            <div class="mt-2" style="font-size:.75rem;opacity:.8;">
                <i class="bi bi-gender-male me-1"></i>{{ $stats['laki_laki'] }} L &nbsp;|&nbsp;
                <i class="bi bi-gender-female me-1"></i>{{ $stats['perempuan'] }} P
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card bg-warning-gradient">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $stats['pending'] }}</div>
                    <div class="stat-label">Pengajuan Pending</div>
                </div>
                <i class="bi bi-hourglass-split stat-icon"></i>
            </div>
            <div class="mt-2" style="font-size:.75rem;opacity:.8;">Membutuhkan tindakan segera</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card bg-info-gradient">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $stats['diproses'] }}</div>
                    <div class="stat-label">Sedang Diproses</div>
                </div>
                <i class="bi bi-gear-fill stat-icon"></i>
            </div>
            <div class="mt-2" style="font-size:.75rem;opacity:.8;">Total: {{ $stats['total_pengajuan'] }} pengajuan</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card bg-success-gradient">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-number">{{ $stats['selesai'] }}</div>
                    <div class="stat-label">Surat Selesai</div>
                </div>
                <i class="bi bi-check-circle-fill stat-icon"></i>
            </div>
            <div class="mt-2" style="font-size:.75rem;opacity:.8;">{{ $stats['total_surat'] }} total surat dibuat</div>
        </div>
    </div>
</div>

{{-- Charts & Recent --}}
<div class="row g-3 mb-4">
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-bar-chart-line-fill me-2 text-primary"></i>Statistik Pengajuan 12 Bulan Terakhir</span>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="chartPengajuan"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-pie-chart-fill me-2 text-success"></i>Status Pengajuan
            </div>
            <div class="card-body">
                <canvas id="chartStatus" style="max-height:200px;"></canvas>
                <div class="mt-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span><span style="color:#f59e0b;">●</span> Pending</span>
                        <strong>{{ $stats['pending'] }}</strong>
                    </div>
                    <div class="d-flex justify-content-between small mb-1">
                        <span><span style="color:#0ea5e9;">●</span> Diproses</span>
                        <strong>{{ $stats['diproses'] }}</strong>
                    </div>
                    <div class="d-flex justify-content-between small mb-1">
                        <span><span style="color:#22c55e;">●</span> Selesai</span>
                        <strong>{{ $stats['selesai'] }}</strong>
                    </div>
                    <div class="d-flex justify-content-between small">
                        <span><span style="color:#ef4444;">●</span> Ditolak</span>
                        <strong>{{ $stats['ditolak'] }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Pengajuan --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-inbox-fill me-2 text-warning"></i>Pengajuan Terbaru</span>
        <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-sm btn-outline-primary">
            Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No. Pengajuan</th>
                        <th>Pemohon</th>
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
                        <td>
                            <div style="font-weight:500;">{{ $p->user->name }}</div>
                            <small class="text-muted">{{ $p->user->email }}</small>
                        </td>
                        <td>{{ $p->jenisSurat->nama ?? '-' }}</td>
                        <td><small>{{ $p->created_at->format('d M Y') }}</small></td>
                        <td>{!! $p->status_badge !!}</td>
                        <td>
                            <a href="{{ route('admin.pengajuan.show', $p) }}" class="btn btn-xs btn-outline-primary" style="font-size:.75rem;padding:.2rem .6rem;">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>Belum ada pengajuan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const labels = @json(collect($chartData)->pluck('month'));
const counts  = @json(collect($chartData)->pluck('count'));

// Bar Chart
new Chart(document.getElementById('chartPengajuan'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label: 'Jumlah Pengajuan',
            data: counts,
            backgroundColor: 'rgba(59,130,246,.75)',
            borderColor: '#1e40af',
            borderWidth: 1.5,
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,.04)' } },
            x: { grid: { display: false } }
        }
    }
});

// Donut Chart
new Chart(document.getElementById('chartStatus'), {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Diproses', 'Selesai', 'Ditolak'],
        datasets: [{
            data: [
                {{ $stats['pending'] }},
                {{ $stats['diproses'] }},
                {{ $stats['selesai'] }},
                {{ $stats['ditolak'] }}
            ],
            backgroundColor: ['#f59e0b','#0ea5e9','#22c55e','#ef4444'],
            borderWidth: 0,
            hoverOffset: 6,
        }]
    },
    options: {
        responsive: true,
        cutout: '68%',
        plugins: {
            legend: { display: false }
        }
    }
});
</script>
@endpush
