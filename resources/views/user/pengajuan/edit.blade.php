@extends('layouts.app')
@section('title', 'Edit Pengajuan')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Pengajuan</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.pengajuan.index') }}">Pengajuan Saya</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.pengajuan.show', $pengajuan) }}">{{ $pengajuan->no_pengajuan }}</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
</div>

<div class="row g-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Pengajuan Surat</div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.pengajuan.update', $pengajuan) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                        <select name="jenis_surat_id" id="jenisSuratSelect"
                                class="form-select @error('jenis_surat_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Surat --</option>
                            @foreach($jenisSurat as $js)
                                <option value="{{ $js->id }}"
                                        data-persyaratan="{{ $js->persyaratan }}"
                                        {{ (old('jenis_surat_id', $pengajuan->jenis_surat_id) == $js->id) ? 'selected' : '' }}>
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
                               value="{{ old('keperluan', $pengajuan->keperluan) }}" placeholder="Contoh: Pembuatan Rekening Bank, Daftar Beasiswa, dll.">
                        @error('keperluan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan Tambahan</label>
                        <textarea name="keterangan" class="form-control" rows="4"
                                  placeholder="Tulis informasi tambahan jika ada...">{{ old('keterangan', $pengajuan->keterangan) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Dokumen Pendukung</label>
                        @if($pengajuan->dokumen_pendukung)
                        <div class="mb-2">
                            <span class="text-muted" style="font-size:.875rem;"><i class="bi bi-paperclip me-1"></i>File saat ini:
                                <a href="{{ Storage::url($pengajuan->dokumen_pendukung) }}" target="_blank">Lihat Dokumen</a>
                            </span>
                        </div>
                        @endif
                        <input type="file" name="dokumen_pendukung" class="form-control @error('dokumen_pendukung') is-invalid @enderror"
                               accept=".pdf,.jpg,.jpeg,.png">
                        <small class="text-muted">Upload file baru untuk mengganti. Format PDF / gambar, maks. 5MB.</small>
                        @error('dokumen_pendukung')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('user.pengajuan.show', $pengajuan) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg me-1"></i>Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-warning">
            <div class="card-header bg-warning text-white"><i class="bi bi-info-circle me-2"></i>Informasi</div>
            <div class="card-body">
                <p class="text-muted mb-2" style="font-size:.875rem;">No. Pengajuan: <code>{{ $pengajuan->no_pengajuan }}</code></p>
                <p class="text-muted mb-0" style="font-size:.875rem;">Pengajuan hanya dapat diedit selama berstatus <strong class="text-warning">Pending</strong>. Setelah diproses oleh petugas, pengajuan tidak dapat diubah.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const jenisSuratSelect = document.getElementById('jenisSuratSelect');
const persyaratanBox   = document.getElementById('persyaratanBox');
const persyaratanText  = document.getElementById('persyaratanText');

function updatePersyaratan() {
    const selected = jenisSuratSelect.options[jenisSuratSelect.selectedIndex];
    const p = selected ? selected.dataset.persyaratan : '';
    if (p && p.trim()) {
        persyaratanText.textContent = p;
        persyaratanBox.style.display = 'block';
    } else {
        persyaratanBox.style.display = 'none';
    }
}

jenisSuratSelect.addEventListener('change', updatePersyaratan);
updatePersyaratan();
</script>
@endpush
