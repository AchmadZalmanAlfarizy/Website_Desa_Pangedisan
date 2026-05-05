@extends('layouts.app')
@section('title', 'Ajukan Surat')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-file-earmark-plus-fill me-2 text-primary"></i>Ajukan Surat</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.pengajuan.index') }}">Pengajuan Saya</a></li>
        <li class="breadcrumb-item active">Ajukan Baru</li>
    </ol>
</div>

<div class="row g-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Form Pengajuan Surat</div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.pengajuan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                        <select name="jenis_surat_id" id="jenisSuratSelect"
                                class="form-select @error('jenis_surat_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Surat --</option>
                            @foreach($jenisSurat as $js)
                                <option value="{{ $js->id }}"
                                        data-persyaratan="{{ $js->persyaratan }}"
                                        {{ old('jenis_surat_id') == $js->id ? 'selected' : '' }}>
                                    {{ $js->nama }} ({{ $js->kode }})
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_surat_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div id="persyaratanBox" class="alert alert-info mb-3" style="display:none;">
                        <strong><i class="bi bi-info-circle me-1"></i>Persyaratan:</strong>
                        <div id="persyaratanText" class="mt-1" style="white-space:pre-line;"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keperluan <span class="text-danger">*</span></label>
                        <input type="text" name="keperluan" class="form-control @error('keperluan') is-invalid @enderror"
                               value="{{ old('keperluan') }}" placeholder="Contoh: Pembuatan Rekening Bank, Daftar Beasiswa, dll.">
                        @error('keperluan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan Tambahan</label>
                        <textarea name="keterangan" class="form-control" rows="4"
                                  placeholder="Tulis informasi tambahan jika ada...">{{ old('keterangan') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Dokumen Pendukung</label>
                        <input type="file" name="dokumen_pendukung" class="form-control @error('dokumen_pendukung') is-invalid @enderror"
                               accept=".pdf,.jpg,.jpeg,.png">
                        <small class="text-muted">Opsional. Format PDF / gambar, maks. 5MB.</small>
                        @error('dokumen_pendukung')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-1"></i>Kirim Pengajuan
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><i class="bi bi-question-circle me-2"></i>Cara Pengajuan</div>
            <div class="card-body">
                <ol style="padding-left:1.2rem;font-size:.875rem;" class="text-muted">
                    <li class="mb-2">Pilih jenis surat yang ingin diajukan</li>
                    <li class="mb-2">Baca dan siapkan persyaratan yang tertera</li>
                    <li class="mb-2">Isi form keperluan dan keterangan</li>
                    <li class="mb-2">Upload dokumen pendukung jika ada</li>
                    <li class="mb-2">Kirim dan tunggu proses dari perangkat desa</li>
                    <li>Download surat setelah status "Selesai"</li>
                </ol>
                <hr>
                <small class="text-muted">
                    <i class="bi bi-clock me-1"></i>Proses pengajuan 1–3 hari kerja.
                </small>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('jenisSuratSelect').addEventListener('change', function () {
    const sel = this.options[this.selectedIndex];
    const req = sel.dataset.persyaratan;
    const box = document.getElementById('persyaratanBox');
    if (req) {
        document.getElementById('persyaratanText').textContent = req;
        box.style.display = 'block';
    } else {
        box.style.display = 'none';
    }
});
</script>
@endpush
