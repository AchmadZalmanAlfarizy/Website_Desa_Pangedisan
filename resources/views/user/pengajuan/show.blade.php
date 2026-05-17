@extends('layouts.app')
@section('title', 'Detail Pengajuan')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="bi bi-file-earmark-check-fill me-2 text-primary"></i>Detail Pengajuan</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.pengajuan.index') }}">Pengajuan Saya</a></li>
            <li class="breadcrumb-item active">{{ $pengajuan->no_pengajuan }}</li>
        </ol>
    </div>
    <a href="{{ route('user.pengajuan.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
    @if($pengajuan->status === 'pending')
    <a href="{{ route('user.pengajuan.edit', $pengajuan) }}" class="btn btn-warning btn-sm">
        <i class="bi bi-pencil me-1"></i>Edit
    </a>
    <form method="POST" action="{{ route('user.pengajuan.cancel', $pengajuan) }}" class="d-inline"
          onsubmit="return confirm('Yakin ingin membatalkan pengajuan ini?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">
            <i class="bi bi-x-circle me-1"></i>Batalkan
        </button>
    </form>
    @endif
</div>

<div class="row g-3 justify-content-center">
    <div class="col-md-8">
        {{-- Status Timeline --}}
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center">
                    @php
                    $steps = ['pending' => 0, 'diproses' => 1, 'selesai' => 2];
                    $current = array_key_exists($pengajuan->status, $steps) ? $steps[$pengajuan->status] : -1;
                    @endphp
                    @foreach(['Dikirim','Diproses','Selesai'] as $si => $step)
                    <div class="text-center flex-fill">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-1"
                             style="width:36px;height:36px;font-size:.8rem;font-weight:700;
                                    background:{{ ($current >= $si && $pengajuan->status !== 'ditolak') ? '#15803d' : '#e2e8f0' }};
                                    color:{{ ($current >= $si && $pengajuan->status !== 'ditolak') ? '#fff' : '#94a3b8' }};">
                            {{ $si + 1 }}
                        </div>
                        <div style="font-size:.75rem;color:{{ ($current >= $si && $pengajuan->status !== 'ditolak') ? '#15803d' : '#94a3b8' }};">{{ $step }}</div>
                    </div>
                    @if($si < 2)
                    <div style="flex:1;height:2px;background:{{ ($current > $si && $pengajuan->status !== 'ditolak') ? '#15803d' : '#e2e8f0' }};margin-bottom:1.5rem;"></div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Informasi Pengajuan</span>
                {!! $pengajuan->status_badge !!}
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <td class="text-muted" style="width:40%;">No. Pengajuan</td>
                        <td><code>{{ $pengajuan->no_pengajuan }}</code></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jenis Surat</td>
                        <td>{{ $pengajuan->jenisSurat->nama }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Keperluan</td>
                        <td>{{ $pengajuan->keperluan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Keterangan</td>
                        <td>{{ $pengajuan->keterangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Pengajuan</td>
                        <td>{{ $pengajuan->created_at->format('d F Y, H:i') }}</td>
                    </tr>
                    @if($pengajuan->catatan_admin)
                    <tr>
                        <td class="text-muted">Catatan Petugas</td>
                        <td class="{{ $pengajuan->status === 'ditolak' ? 'text-danger' : '' }}">
                            {{ $pengajuan->catatan_admin }}
                        </td>
                    </tr>
                    @endif
                    @if($pengajuan->tanggal_selesai)
                    <tr>
                        <td class="text-muted">Tanggal Selesai</td>
                        <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal_selesai)->format('d F Y') }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        @if($pengajuan->surat)
        <div class="card mt-3 border-success">
            <div class="card-body text-center py-4">
                <i class="bi bi-file-earmark-pdf-fill text-success" style="font-size:3rem;"></i>
                <h5 class="mt-3">Surat Anda Siap!</h5>
                <p class="text-muted mb-0" style="font-size:.875rem;">No. Surat: <code>{{ $pengajuan->surat->no_surat }}</code></p>
                <p class="text-muted mb-3" style="font-size:.875rem;">Tanggal: {{ $pengajuan->surat->tanggal_surat->format('d F Y') }}</p>
                <a href="{{ route('surat.download', $pengajuan->surat) }}" class="btn btn-success" target="_blank">
                    <i class="bi bi-download me-1"></i>Download Surat (PDF)
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
