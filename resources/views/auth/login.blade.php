<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Desa Pagendisan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:       #15803d;
            --primary-light: #22c55e;
            --primary-dark:  #14532d;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            min-height: 100vh;
            background: #f0fdf4;
        }

        /* ── Left Panel ── */
        .auth-left {
            width: 42%;
            background: linear-gradient(160deg, var(--primary-dark) 0%, var(--primary) 50%, #16a34a 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem;
            overflow: hidden;
        }
        .auth-left::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }
        .auth-left::after {
            content: '';
            position: absolute;
            bottom: -120px; right: -80px;
            width: 380px; height: 380px;
            background: radial-gradient(circle, rgba(255,255,255,.07) 0%, transparent 65%);
            pointer-events: none;
        }
        .left-brand {
            display: flex; align-items: center; gap: .75rem; position: relative; z-index: 1;
        }
        .left-brand-icon {
            width: 44px; height: 44px;
            background: rgba(255,255,255,.15);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem; color: #fff;
        }
        .left-brand h5 { color: #fff; font-weight: 800; font-size: 1rem; margin: 0; line-height: 1.3; }
        .left-brand span { color: rgba(255,255,255,.65); font-size: .73rem; }

        .left-hero { position: relative; z-index: 1; flex: 1; display: flex; flex-direction: column; justify-content: center; padding: 2rem 0; }
        .left-hero h2 { color: #fff; font-weight: 800; font-size: clamp(1.5rem, 3vw, 2.1rem); line-height: 1.25; margin-bottom: .85rem; }
        .left-hero h2 .hl { color: #86efac; }
        .left-hero p { color: rgba(255,255,255,.72); font-size: .88rem; line-height: 1.75; max-width: 340px; }

        .left-stats {
            display: flex; gap: 1.25rem; margin-top: 2rem; position: relative; z-index: 1;
        }
        .left-stat {
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 12px; padding: .85rem 1.1rem; flex: 1; text-align: center;
        }
        .left-stat .num { color: #fff; font-weight: 800; font-size: 1.4rem; line-height: 1; }
        .left-stat .lbl { color: rgba(255,255,255,.65); font-size: .68rem; margin-top: .3rem; }

        .left-info-items { position: relative; z-index: 1; display: flex; flex-direction: column; gap: .5rem; }
        .left-info-item {
            display: flex; align-items: center; gap: .6rem;
            color: rgba(255,255,255,.7); font-size: .8rem;
        }
        .left-info-item i { color: #4ade80; }

        /* ── Right Panel ── */
        .auth-right {
            flex: 1;
            display: flex; align-items: center; justify-content: center;
            padding: 2rem;
            background: #fff;
        }
        .auth-form-wrap { width: 100%; max-width: 400px; }
        .auth-form-wrap h3 { font-weight: 800; color: #0f172a; font-size: 1.55rem; margin-bottom: .4rem; }
        .auth-form-wrap .sub { color: #64748b; font-size: .875rem; margin-bottom: 2rem; }

        .form-label { font-weight: 600; font-size: .83rem; color: #374151; margin-bottom: .4rem; }
        .input-icon-wrap { position: relative; }
        .input-icon-wrap .icon {
            position: absolute; left: .9rem; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: .95rem; pointer-events: none; z-index: 5;
        }
        .input-icon-wrap .form-control { padding-left: 2.5rem; }
        .input-icon-wrap .eye-btn {
            position: absolute; right: .75rem; top: 50%; transform: translateY(-50%);
            background: none; border: none; color: #94a3b8; cursor: pointer; font-size: .9rem; padding: 0;
        }
        .input-icon-wrap .eye-btn:hover { color: var(--primary); }
        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: .65rem 1rem;
            font-size: .88rem;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(21,128,61,.12);
            outline: none;
        }
        .form-control.is-invalid { border-color: #ef4444; }
        .invalid-feedback { font-size: .77rem; color: #ef4444; }

        .btn-login {
            width: 100%; background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff; border: none; border-radius: 10px; padding: .78rem;
            font-weight: 700; font-size: .92rem; cursor: pointer; transition: all .25s;
            box-shadow: 0 4px 16px rgba(21,128,61,.3);
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(21,128,61,.4); }

        .divider { position: relative; text-align: center; margin: 1.5rem 0; }
        .divider::before {
            content: ''; position: absolute; top: 50%; left: 0; right: 0;
            height: 1px; background: #e2e8f0;
        }
        .divider span {
            position: relative; background: #fff; padding: 0 .75rem;
            color: #94a3b8; font-size: .78rem;
        }

        .alert-custom {
            border-radius: 10px; padding: .75rem 1rem;
            display: flex; align-items: flex-start; gap: .6rem; font-size: .85rem;
            margin-bottom: 1.25rem; border: none;
        }
        .alert-danger-custom  { background: #fef2f2; color: #b91c1c; }
        .alert-success-custom { background: #f0fdf4; color: #15803d; }

        @media (max-width: 768px) {
            .auth-left { display: none; }
            .auth-right { background: #f0fdf4; }
            .auth-form-wrap {
                background: #fff; border-radius: 20px; padding: 2rem;
                box-shadow: 0 16px 40px rgba(0,0,0,.08);
            }
        }
    </style>
</head>
<body>

{{-- Left decorative panel --}}
<div class="auth-left d-none d-md-flex flex-column">
    <div class="left-brand">
        <div class="left-brand-icon"><i class="bi bi-tree-fill"></i></div>
        <div>
            <h5>Desa Pagendisan</h5>
            <span>Kec. Winong, Kab. Pati</span>
        </div>
    </div>

    <div class="left-hero">
        <h2>Selamat Datang<br>di Portal <span class="hl">Layanan Desa</span></h2>
        <p>Akses semua layanan administrasi desa secara online — cepat, mudah, dan transparan dari mana saja.</p>
        <div class="left-stats">
            <div class="left-stat">
                <div class="num">8+</div>
                <div class="lbl">Jenis Layanan</div>
            </div>
            <div class="left-stat">
                <div class="num">24/7</div>
                <div class="lbl">Akses Online</div>
            </div>
            <div class="left-stat">
                <div class="num">100%</div>
                <div class="lbl">Digital</div>
            </div>
        </div>
    </div>

    <div class="left-info-items">
        <div class="left-info-item"><i class="bi bi-shield-fill-check"></i>Data aman & terenkripsi</div>
        <div class="left-info-item"><i class="bi bi-phone-fill"></i>Bisa diakses dari smartphone</div>
        <div class="left-info-item"><i class="bi bi-file-pdf-fill"></i>Unduh surat PDF langsung</div>
    </div>
</div>

{{-- Right form panel --}}
<div class="auth-right">
    <div class="auth-form-wrap">

        {{-- Mobile brand --}}
        <div class="d-flex d-md-none align-items-center gap-2 mb-4">
            <div style="width:38px;height:38px;background:var(--primary);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-tree-fill text-white" style="font-size:.9rem;"></i>
            </div>
            <div>
                <div style="font-weight:800;font-size:.9rem;color:var(--primary);">Desa Pagendisan</div>
                <div style="font-size:.72rem;color:#94a3b8;">Kec. Winong, Kab. Pati</div>
            </div>
        </div>

        <h3>Masuk ke Akun</h3>
        <p class="sub">Gunakan email dan password Anda untuk masuk ke portal layanan.</p>

        @if($errors->any())
        <div class="alert-custom alert-danger-custom">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0 mt-1"></i>
            <div>{{ $errors->first() }}</div>
        </div>
        @endif

        @if(session('success'))
        <div class="alert-custom alert-success-custom">
            <i class="bi bi-check-circle-fill flex-shrink-0 mt-1"></i>
            <div>{{ session('success') }}</div>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="form-label">Alamat Email</label>
                <div class="input-icon-wrap">
                    <i class="bi bi-envelope icon"></i>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="email@contoh.com"
                           value="{{ old('email') }}" autofocus>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-icon-wrap">
                    <i class="bi bi-lock icon"></i>
                    <input type="password" name="password" id="pwdInput"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="••••••••">
                    <button type="button" class="eye-btn" onclick="togglePwd()">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <label class="d-flex align-items-center gap-2 mb-0" style="cursor:pointer;">
                    <input type="checkbox" name="remember" class="form-check-input" style="margin:0;">
                    <span style="font-size:.83rem;color:#64748b;">Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang
            </button>
        </form>

        <div class="divider"><span>atau</span></div>

        <div class="text-center" style="font-size:.875rem;color:#64748b;">
            Belum punya akun?
            <a href="{{ route('register') }}" style="color:var(--primary);font-weight:700;text-decoration:none;">Daftar di sini</a>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('landing') }}" style="color:#94a3b8;font-size:.8rem;text-decoration:none;">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePwd() {
        const i = document.getElementById('pwdInput');
        const e = document.getElementById('eyeIcon');
        if (i.type === 'password') { i.type = 'text'; e.className = 'bi bi-eye-slash'; }
        else                       { i.type = 'password'; e.className = 'bi bi-eye'; }
    }
</script>
</body>
</html>

