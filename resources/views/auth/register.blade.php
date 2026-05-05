<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Sistem Administrasi Desa Pagendisan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .auth-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,.3);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
        }
        .auth-header {
            background: linear-gradient(135deg, #059669, #34d399);
            padding: 1.5rem 2rem;
            text-align: center;
        }
        .auth-body { padding: 2rem; }
        .form-control, .form-select {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: .6rem 1rem;
            font-size: .875rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,.15);
        }
        .form-label { font-weight: 600; font-size: .83rem; color: #374151; }
        .btn-success {
            background: linear-gradient(135deg, #059669, #34d399);
            border: none;
            border-radius: 10px;
            padding: .7rem;
            font-weight: 600;
        }
        .invalid-feedback { font-size: .78rem; }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="auth-card">
        <div class="auth-header">
            <div class="d-flex align-items-center justify-content-center gap-2">
                <div style="width:40px;height:40px;background:rgba(255,255,255,.2);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-building text-white fs-5"></i>
                </div>
                <div class="text-start">
                    <h6 class="text-white fw-700 mb-0" style="font-weight:700;">Desa Pagendisan</h6>
                    <small style="color:rgba(255,255,255,.8);font-size:.75rem;">Kec. Winong, Kab. Pati</small>
                </div>
            </div>
        </div>

        <div class="auth-body">
            <h5 class="fw-700 mb-1" style="font-weight:700;color:#0f172a;">Buat Akun Baru</h5>
            <p class="text-muted mb-4" style="font-size:.875rem;">Daftarkan diri Anda untuk mengakses layanan administrasi desa.</p>

            @if($errors->any())
                <div class="alert alert-danger" style="border-radius:10px;font-size:.875rem;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" autofocus>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                               placeholder="16 digit NIK" value="{{ old('nik') }}" maxlength="16" pattern="[0-9]{16}">
                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="email@contoh.com" value="{{ old('email') }}">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor HP <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                               placeholder="0812xxxxxxxx" value="{{ old('no_hp') }}">
                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Min. 6 karakter">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Ulangi password">
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agree" required>
                            <label class="form-check-label text-muted" for="agree" style="font-size:.8rem;">
                                Saya menyetujui syarat dan ketentuan penggunaan sistem ini.
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-person-plus-fill me-2"></i>Buat Akun
                        </button>
                    </div>
                </div>
            </form>

            <hr class="my-3">
            <p class="text-center text-muted mb-0" style="font-size:.875rem;">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-primary fw-600" style="font-weight:600;">Masuk di sini</a>
            </p>
            <p class="text-center mt-2">
                <a href="{{ route('landing') }}" class="text-muted" style="font-size:.8rem;">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                </a>
            </p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
