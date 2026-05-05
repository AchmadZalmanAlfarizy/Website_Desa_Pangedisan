<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistem Administrasi Desa Pagendisan</title>
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
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
        }
        .auth-header {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            padding: 2rem;
            text-align: center;
        }
        .auth-header .logo {
            width: 56px; height: 56px;
            background: rgba(255,255,255,.2);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .auth-body { padding: 2rem; }
        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: .65rem 1rem;
            font-size: .9rem;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,.15);
        }
        .form-label { font-weight: 600; font-size: .85rem; color: #374151; }
        .btn-primary {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            border: none;
            border-radius: 10px;
            padding: .7rem;
            font-weight: 600;
        }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            background: #f8fafc;
            color: #94a3b8;
        }
        .input-group .form-control { border-radius: 0 10px 10px 0; }
        .invalid-feedback { font-size: .78rem; }
        .alert { border-radius: 10px; font-size: .875rem; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo">
                <i class="bi bi-building text-white fs-4"></i>
            </div>
            <h5 class="text-white fw-700 mb-1" style="font-weight:700;">Desa Pagendisan</h5>
            <p class="mb-0" style="color:rgba(255,255,255,.75);font-size:.8rem;">Kec. Winong, Kab. Pati</p>
        </div>

        <div class="auth-body">
            <h5 class="fw-700 mb-1" style="font-weight:700;color:#0f172a;">Selamat Datang</h5>
            <p class="text-muted mb-4" style="font-size:.875rem;">Masuk ke akun Anda untuk mengakses layanan.</p>

            @if($errors->any())
                <div class="alert alert-danger d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill flex-shrink-0"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="email@contoh.com" value="{{ old('email') }}" autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="••••••••">
                        <button type="button" class="btn btn-outline-secondary border-start-0"
                                style="border-radius:0 10px 10px 0;border:1.5px solid #e2e8f0;border-left:none;"
                                onclick="togglePwd()">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label text-muted" for="remember" style="font-size:.85rem;">Ingat saya</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>
            </form>

            <hr class="my-4">

            <p class="text-center text-muted mb-0" style="font-size:.875rem;">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-primary fw-600" style="font-weight:600;">Daftar di sini</a>
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
<script>
    function togglePwd() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }
</script>
</body>
</html>
