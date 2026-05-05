<div class="row g-3">
    {{-- NIK --}}
    <div class="col-md-6">
        <label class="form-label">NIK <span class="text-danger">*</span></label>
        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
               value="{{ old('nik', $penduduk->nik ?? '') }}" maxlength="16" placeholder="16 digit NIK">
        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- No. KK --}}
    <div class="col-md-6">
        <label class="form-label">No. Kartu Keluarga</label>
        <input type="text" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror"
               value="{{ old('no_kk', $penduduk->no_kk ?? '') }}" maxlength="16">
        @error('no_kk')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- Nama Lengkap --}}
    <div class="col-12">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror"
               value="{{ old('nama_lengkap', $penduduk->nama_lengkap ?? '') }}" placeholder="Nama sesuai KTP">
        @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- Tempat Lahir --}}
    <div class="col-md-6">
        <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
               value="{{ old('tempat_lahir', $penduduk->tempat_lahir ?? '') }}">
        @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- Tanggal Lahir --}}
    <div class="col-md-6">
        <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
               value="{{ old('tanggal_lahir', isset($penduduk) ? $penduduk->tanggal_lahir->format('Y-m-d') : '') }}">
        @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- Jenis Kelamin --}}
    <div class="col-md-4">
        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            <option value="Laki-laki" {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin', $penduduk->jenis_kelamin ?? '') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- Agama --}}
    <div class="col-md-4">
        <label class="form-label">Agama <span class="text-danger">*</span></label>
        <select name="agama" class="form-select @error('agama') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                <option value="{{ $agama }}" {{ old('agama', $penduduk->agama ?? '') === $agama ? 'selected' : '' }}>{{ $agama }}</option>
            @endforeach
        </select>
        @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- Status Perkawinan --}}
    <div class="col-md-4">
        <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
        <select name="status_perkawinan" class="form-select @error('status_perkawinan') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $status)
                <option value="{{ $status }}" {{ old('status_perkawinan', $penduduk->status_perkawinan ?? '') === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
        @error('status_perkawinan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- Alamat --}}
    <div class="col-12">
        <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', $penduduk->alamat ?? '') }}</textarea>
        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- RT / RW / Dusun --}}
    <div class="col-md-3">
        <label class="form-label">RT</label>
        <input type="text" name="rt" class="form-control" value="{{ old('rt', $penduduk->rt ?? '') }}" maxlength="5">
    </div>
    <div class="col-md-3">
        <label class="form-label">RW</label>
        <input type="text" name="rw" class="form-control" value="{{ old('rw', $penduduk->rw ?? '') }}" maxlength="5">
    </div>
    <div class="col-md-6">
        <label class="form-label">Dusun / Lingkungan</label>
        <input type="text" name="dusun" class="form-control" value="{{ old('dusun', $penduduk->dusun ?? '') }}">
    </div>

    {{-- Pekerjaan --}}
    <div class="col-md-6">
        <label class="form-label">Pekerjaan</label>
        <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $penduduk->pekerjaan ?? '') }}">
    </div>

    {{-- Pendidikan --}}
    <div class="col-md-6">
        <label class="form-label">Pendidikan Terakhir</label>
        <select name="pendidikan" class="form-select">
            <option value="">-- Pilih --</option>
            @foreach(['Tidak/Belum Sekolah','SD/Sederajat','SMP/Sederajat','SMA/Sederajat','D3','S1','S2','S3'] as $pend)
                <option value="{{ $pend }}" {{ old('pendidikan', $penduduk->pendidikan ?? '') === $pend ? 'selected' : '' }}>{{ $pend }}</option>
            @endforeach
        </select>
    </div>

    {{-- Status Hidup --}}
    <div class="col-md-6">
        <label class="form-label">Status Hidup <span class="text-danger">*</span></label>
        <select name="status_hidup" class="form-select @error('status_hidup') is-invalid @enderror">
            <option value="Hidup" {{ old('status_hidup', $penduduk->status_hidup ?? 'Hidup') === 'Hidup' ? 'selected' : '' }}>Hidup</option>
            <option value="Meninggal" {{ old('status_hidup', $penduduk->status_hidup ?? '') === 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
        </select>
        @error('status_hidup')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- Foto --}}
    <div class="col-md-6">
        <label class="form-label">Foto (Opsional)</label>
        <input type="file" name="foto" class="form-control" accept="image/*">
        @if(isset($penduduk) && $penduduk->foto)
            <div class="mt-2">
                <img src="{{ Storage::url($penduduk->foto) }}" height="60" class="rounded border">
                <small class="text-muted d-block">Foto saat ini</small>
            </div>
        @endif
    </div>
</div>
