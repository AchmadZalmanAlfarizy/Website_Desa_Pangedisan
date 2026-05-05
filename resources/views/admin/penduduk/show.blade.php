@extends('layouts.app')
@section('title', 'Detail Penduduk')

@section('content')
<div class="page-header d-flex justify-content-between">
    <div>
        <h4><i class="bi bi-person-lines-fill me-2 text-info"></i>Detail Penduduk</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.penduduk.index') }}">Penduduk</a></li>
            <li class="breadcrumb-item active">{{ $penduduk->nama_lengkap }}</li>
        </ol>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.penduduk.edit', $penduduk) }}" class="btn btn-warning btn-sm">
            <i class="bi bi-pencil me-1"></i>Edit
        </a>
        <a href="{{ route('admin.penduduk.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body py-4">
                @if($penduduk->foto)
                    <img src="{{ Storage::url($penduduk->foto) }}" class="rounded-circle mb-3" style="width:100px;height:100px;object-fit:cover;border:4px solid #e2e8f0;">
                @else
                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mx-auto mb-3" style="width:100px;height:100px;">
                        <i class="bi bi-person-fill text-white" style="font-size:3rem;"></i>
                    </div>
                @endif
                <h5 class="fw-700 mb-1" style="font-weight:700;">{{ $penduduk->nama_lengkap }}</h5>
                <p class="text-muted mb-2" style="font-size:.875rem;">NIK: {{ $penduduk->nik }}</p>
                @if($penduduk->status_hidup === 'Hidup')
                    <span class="badge bg-success">Hidup</span>
                @else
                    <span class="badge bg-secondary">Meninggal</span>
                @endif
                <hr>
                <div class="text-start">
                    <div class="d-flex justify-content-between small py-1 border-bottom">
                        <span class="text-muted">Umur</span>
                        <strong>{{ $penduduk->umur }} tahun</strong>
                    </div>
                    <div class="d-flex justify-content-between small py-1 border-bottom">
                        <span class="text-muted">Jenis Kelamin</span>
                        <strong>{{ $penduduk->jenis_kelamin }}</strong>
                    </div>
                    <div class="d-flex justify-content-between small py-1">
                        <span class="text-muted">Agama</span>
                        <strong>{{ $penduduk->agama }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Informasi Lengkap</div>
            <div class="card-body">
                <div class="row g-3">
                    @php
                    $fields = [
                        'Tempat, Tgl Lahir' => $penduduk->tempat_lahir . ', ' . $penduduk->tanggal_lahir->format('d F Y'),
                        'No. KK' => $penduduk->no_kk ?? '-',
                        'Alamat' => $penduduk->alamat,
                        'RT/RW' => 'RT ' . ($penduduk->rt ?? '-') . ' / RW ' . ($penduduk->rw ?? '-'),
                        'Dusun' => $penduduk->dusun ?? '-',
                        'Status Perkawinan' => $penduduk->status_perkawinan,
                        'Pekerjaan' => $penduduk->pekerjaan ?? '-',
                        'Pendidikan' => $penduduk->pendidikan ?? '-',
                        'Kewarganegaraan' => $penduduk->kewarganegaraan,
                    ];
                    @endphp
                    @foreach($fields as $label => $val)
                    <div class="col-md-6">
                        <small class="text-muted d-block" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;">{{ $label }}</small>
                        <span style="font-size:.9rem;font-weight:500;">{{ $val }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
