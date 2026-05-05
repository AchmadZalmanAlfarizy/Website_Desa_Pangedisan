@extends('layouts.app')
@section('title', 'Upload Arsip Dokumen')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-cloud-upload-fill me-2 text-primary"></i>Upload Arsip Dokumen</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.arsip.index') }}">Arsip</a></li>
        <li class="breadcrumb-item active">Upload</li>
    </ol>
</div>

<div class="card" style="max-width:700px;">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.arsip.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Judul Dokumen <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul') }}" placeholder="Judul dokumen arsip">
                    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kode Arsip <span class="text-danger">*</span></label>
                    <input type="text" name="kode_arsip" class="form-control @error('kode_arsip') is-invalid @enderror"
                           value="{{ old('kode_arsip') }}" placeholder="Contoh: ARS/2024/001">
                    @error('kode_arsip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        @foreach(['Surat Masuk','Surat Keluar','Peraturan','Laporan','Lainnya'] as $kat)
                            <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                    @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tahun <span class="text-danger">*</span></label>
                    <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                           value="{{ old('tahun', date('Y')) }}" min="2000" max="{{ date('Y') + 1 }}">
                    @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">File Dokumen <span class="text-danger">*</span></label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                           accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                    <small class="text-muted">Format: PDF, Word, Excel, atau gambar. Maks. 10MB.</small>
                    @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-cloud-upload me-1"></i>Upload Dokumen
                </button>
                <a href="{{ route('admin.arsip.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
