<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Nama Jenis Surat <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama', $jenisSurat->nama ?? '') }}" placeholder="Contoh: Surat Keterangan Domisili">
        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Kode Surat <span class="text-danger">*</span></label>
        <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror"
               value="{{ old('kode', $jenisSurat->kode ?? '') }}" placeholder="SKD" style="text-transform:uppercase;">
        @error('kode')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $jenisSurat->deskripsi ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Persyaratan</label>
        <textarea name="persyaratan" class="form-control @error('persyaratan') is-invalid @enderror" rows="4"
                  placeholder="Tulis persyaratan yang dibutuhkan, satu per baris...">{{ old('persyaratan', $jenisSurat->persyaratan ?? '') }}</textarea>
        <small class="text-muted">Persyaratan ini akan ditampilkan kepada warga saat mengajukan surat.</small>
        @error('persyaratan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $jenisSurat->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Aktifkan jenis surat ini</label>
        </div>
    </div>
</div>
