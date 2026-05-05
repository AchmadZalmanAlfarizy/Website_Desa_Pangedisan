@extends('layouts.app')
@section('title', 'Profil Saya')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-person-circle me-2 text-primary"></i>Profil & Data Kependudukan</h4>
    <ol class="breadcrumb"><li class="breadcrumb-item active">Profil</li></ol>
</div>

<div class="row g-3 justify-content-center">
    <div class="col-lg-8">
        <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card mb-3">
                <div class="card-header">Identitas Pribadi</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                            <input type="text" name="nik" class="form-control" value="{{ auth()->user()->nik }}" maxlength="16" disabled>
                            <small class="text-muted">NIK tidak dapat diubah (terkunci)</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. HP <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                   value="{{ old('no_hp', auth()->user()->no_hp) }}" required>
                            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                            <small class="text-muted">Email tidak dapat diubah</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Data Kependudukan</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                   value="{{ old('tempat_lahir', auth()->user()->penduduk?->tempat_lahir) }}">
                            @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                   value="{{ old('tanggal_lahir', auth()->user()->penduduk?->tanggal_lahir?->format('Y-m-d')) }}">
                            @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', auth()->user()->penduduk?->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', auth()->user()->penduduk?->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Agama</label>
                            <select name="agama" class="form-select @error('agama') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                    <option value="{{ $agama }}" {{ old('agama', auth()->user()->penduduk?->agama) === $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                @endforeach
                            </select>
                            @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status Perkawinan</label>
                            <select name="status_perkawinan" class="form-select @error('status_perkawinan') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                @foreach(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                                    <option value="{{ $status }}" {{ old('status_perkawinan', auth()->user()->penduduk?->status_perkawinan) === $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('status_perkawinan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror"
                                   value="{{ old('pekerjaan', auth()->user()->penduduk?->pekerjaan) }}">
                            @error('pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <select name="pendidikan" class="form-select @error('pendidikan') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                @foreach(['Tidak Tamat SD', 'SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'] as $pend)
                                    <option value="{{ $pend }}" {{ old('pendidikan', auth()->user()->penduduk?->pendidikan) === $pend ? 'selected' : '' }}>{{ $pend }}</option>
                                @endforeach
                            </select>
                            @error('pendidikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', auth()->user()->penduduk?->alamat) }}</textarea>
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">RT</label>
                            <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror"
                                   value="{{ old('rt', auth()->user()->penduduk?->rt) }}" maxlength="5">
                            @error('rt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">RW</label>
                            <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror"
                                   value="{{ old('rw', auth()->user()->penduduk?->rw) }}" maxlength="5">
                            @error('rw')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Dusun</label>
                            <input type="text" name="dusun" class="form-control @error('dusun') is-invalid @enderror"
                                   value="{{ old('dusun', auth()->user()->penduduk?->dusun) }}">
                            @error('dusun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Keamanan Akun</div>
                <div class="card-body">
                    <p class="text-muted small mb-3">Biarkan kosong jika tidak ingin mengubah password</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Simpan Semua Perubahan
                </button>
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
