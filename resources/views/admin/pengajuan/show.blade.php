@extends('layouts.app')
@section('title', 'Detail Pengajuan')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4><i class="bi bi-file-earmark-check-fill me-2 text-primary"></i>Detail Pengajuan</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan.index') }}">Pengajuan</a></li>
            <li class="breadcrumb-item active">{{ $pengajuan->no_pengajuan }}</li>
        </ol>
    </div>
    <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-3">
    {{-- Detail Pengajuan --}}
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">Informasi Pengajuan</div>
            <div class="card-body">
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <td class="text-muted" style="width:40%;">No. Pengajuan</td>
                        <td><code>{{ $pengajuan->no_pengajuan }}</code></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Pemohon</td>
                        <td>{{ $pengajuan->user->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">NIK Pemohon</td>
                        <td>{{ $pengajuan->user->nik ?? '-' }}</td>
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
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>{!! $pengajuan->status_badge !!}</td>
                    </tr>
                    @if($pengajuan->catatan_admin)
                    <tr>
                        <td class="text-muted">Catatan Admin</td>
                        <td>{{ $pengajuan->catatan_admin }}</td>
                    </tr>
                    @endif
                    @if($pengajuan->dokumen_pendukung)
                    <tr>
                        <td class="text-muted">Dokumen Pendukung</td>
                        <td>
                            <a href="{{ Storage::url($pengajuan->dokumen_pendukung) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-paperclip me-1"></i>Lihat Dokumen
                            </a>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        {{-- Surat yang sudah dibuat --}}
        @if($pengajuan->surat)
        <div class="card mt-3">
            <div class="card-header text-success"><i class="bi bi-check-circle-fill me-2"></i>Surat Telah Dibuat</div>
            <div class="card-body">
                <table class="table table-borderless table-sm mb-0">
                    <tr><td class="text-muted" style="width:40%;">No. Surat</td><td><code>{{ $pengajuan->surat->no_surat }}</code></td></tr>
                    <tr><td class="text-muted">Tanggal Surat</td><td>{{ $pengajuan->surat->tanggal_surat->format('d F Y') }}</td></tr>
                </table>
                <a href="{{ route('surat.download', $pengajuan->surat) }}" class="btn btn-success btn-sm mt-2" target="_blank">
                    <i class="bi bi-download me-1"></i>Download Surat (PDF)
                </a>
            </div>
        </div>
        @endif
    </div>

    {{-- Action Panel --}}
    <div class="col-md-5">
        {{-- Data Penduduk dari User --}}
        @if($userPenduduk)
        <div class="card border-info mb-3">
            <div class="card-header bg-info text-white"><i class="bi bi-person-badge me-2"></i>Data Penduduk (Dari Profil Pemohon)</div>
            <div class="card-body">
                <table class="table table-borderless table-sm mb-0">
                    <tr><td class="text-muted" style="width:40%;">Nama Lengkap</td><td><strong>{{ $userPenduduk->nama_lengkap }}</strong></td></tr>
                    <tr><td class="text-muted">NIK</td><td>{{ $userPenduduk->nik }}</td></tr>
                    @if($userPenduduk->tempat_lahir)
                    <tr><td class="text-muted">Tempat, Tgl Lahir</td><td>{{ $userPenduduk->tempat_lahir }}, {{ $userPenduduk->tanggal_lahir?->format('d F Y') ?? '-' }}</td></tr>
                    @endif
                    @if($userPenduduk->jenis_kelamin)
                    <tr><td class="text-muted">Jenis Kelamin</td><td>{{ $userPenduduk->jenis_kelamin }}</td></tr>
                    @endif
                    @if($userPenduduk->alamat)
                    <tr><td class="text-muted">Alamat</td><td>{{ $userPenduduk->alamat }}, RT {{ $userPenduduk->rt ?? '-' }}/RW {{ $userPenduduk->rw ?? '-' }}</td></tr>
                    @endif
                </table>
                <small class="text-muted d-block mt-2">Data ini diambil dari profil penduduk pemohon. Jika ada kesalahan, minta pemohon untuk memperbarui profilnya.</small>
            </div>
        </div>
        @else
        <div class="card border-danger mb-3">
            <div class="card-header bg-danger text-white"><i class="bi bi-exclamation-triangle me-2"></i>Peringatan</div>
            <div class="card-body text-danger">
                <p class="mb-0"><strong>Data penduduk pemohon belum lengkap!</strong> Minta pemohon untuk melengkapi data kependudukan mereka di profil sebelum pengajuan dapat disetujui.</p>
            </div>
        </div>
        @endif

        @if($pengajuan->status === 'pending')
        <div class="card border-warning">
            <div class="card-header bg-warning text-white"><i class="bi bi-hourglass-split me-2"></i>Proses Pengajuan</div>
            <div class="card-body">
                @if($userPenduduk)
                <form method="POST" action="{{ route('admin.pengajuan.approve', $pengajuan) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Catatan untuk pemohon...">{{ old('catatan_admin') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-lg me-1"></i>Setujui & Buat Surat
                    </button>
                </form>
                <hr>
                @else
                <div class="alert alert-danger alert-sm mb-3">
                    Tidak bisa menyetujui karena data penduduk pemohon belum lengkap.
                </div>
                @endif
                <form method="POST" action="{{ route('admin.pengajuan.reject', $pengajuan) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-danger">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="catatan_admin" class="form-control" rows="3" required placeholder="Tulis alasan penolakan...">{{ old('catatan_admin') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-danger w-100"
                            onclick="return confirm('Tolak pengajuan ini?')">
                        <i class="bi bi-x-lg me-1"></i>Tolak Pengajuan
                    </button>
                </form>
            </div>
        </div>
        @elseif($pengajuan->status === 'diproses')
        <div class="card border-info">
            <div class="card-header bg-info text-white"><i class="bi bi-gear-fill me-2"></i>Tandai Selesai</div>
            <div class="card-body">
                <p class="text-muted mb-3">Pengajuan ini sedang dalam proses. Tandai sebagai selesai setelah surat diserahkan kepada pemohon.</p>
                <form method="POST" action="{{ route('admin.pengajuan.selesai', $pengajuan) }}">
                    @csrf
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-check-circle me-1"></i>Tandai Selesai
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body text-center py-4">
                @if($pengajuan->status === 'selesai')
                    <i class="bi bi-check-circle-fill text-success fs-1 d-block mb-2"></i>
                    <p class="text-success fw-600">Pengajuan telah selesai diproses.</p>
                @else
                    <i class="bi bi-x-circle-fill text-danger fs-1 d-block mb-2"></i>
                    <p class="text-danger fw-600">Pengajuan ini ditolak.</p>
                @endif
                <div class="alert alert-light mt-2" style="font-size:.85rem;">
                    <strong>Catatan:</strong> {{ $pengajuan->catatan_admin ?? '-' }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
