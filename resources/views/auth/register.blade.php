<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Desa Pagendisan</title>
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
        html, body { min-height: 100%; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex; min-height: 100vh;
            background: #f0fdf4;
        }

        /* ── Left Panel ── */
        .auth-left {
            width: 38%;
            background: linear-gradient(160deg, var(--primary-dark) 0%, var(--primary) 55%, #16a34a 100%);
            position: sticky; top: 0; height: 100vh;
            display: flex; flex-direction: column; justify-content: space-between;
            padding: 2.5rem; overflow: hidden; flex-shrink: 0;
        }
        .auth-left::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }
        .auth-left::after {
            content: ''; position: absolute;
            bottom: -100px; right: -80px;
            width: 360px; height: 360px;
            background: radial-gradient(circle, rgba(255,255,255,.07) 0%, transparent 65%);
            pointer-events: none;
        }

        .left-brand { display: flex; align-items: center; gap: .75rem; position: relative; z-index: 1; }
        .left-brand-icon {
            width: 44px; height: 44px;
            background: rgba(255,255,255,.15); border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem; color: #fff;
        }
        .left-brand h5 { color: #fff; font-weight: 800; font-size: 1rem; margin: 0; line-height: 1.3; }
        .left-brand span { color: rgba(255,255,255,.65); font-size: .73rem; }

        .left-steps { position: relative; z-index: 1; flex: 1; display: flex; flex-direction: column; justify-content: center; padding: 2rem 0; }
        .left-steps h2 { color: #fff; font-weight: 800; font-size: clamp(1.3rem, 2.5vw, 1.9rem); line-height: 1.3; margin-bottom: 1.5rem; }
        .left-steps h2 .hl { color: #86efac; }

        .step-item {
            display: flex; align-items: flex-start; gap: .9rem;
            margin-bottom: .9rem; padding: .75rem; border-radius: 10px;
            background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.1);
        }
        .step-num {
            width: 28px; height: 28px; border-radius: 50%;
            background: var(--primary-light); color: var(--primary-dark);
            font-weight: 800; font-size: .78rem;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .step-text h6 { color: #fff; font-size: .82rem; font-weight: 700; margin: 0 0 .18rem; }
        .step-text p  { color: rgba(255,255,255,.6); font-size: .73rem; margin: 0; line-height: 1.5; }

        .left-info-items { position: relative; z-index: 1; display: flex; flex-direction: column; gap: .5rem; }
        .left-info-item {
            display: flex; align-items: center; gap: .6rem;
            color: rgba(255,255,255,.7); font-size: .8rem;
        }
        .left-info-item i { color: #4ade80; }

        /* ── Right Panel ── */
        .auth-right {
            flex: 1;
            display: flex; align-items: flex-start; justify-content: center;
            padding: 2rem; background: #fff; overflow-y: auto;
        }
        .auth-form-wrap { width: 100%; max-width: 500px; padding: 2rem 0; }
        .auth-form-wrap h3 { font-weight: 800; color: #0f172a; font-size: 1.5rem; margin-bottom: .4rem; }
        .auth-form-wrap .sub { color: #64748b; font-size: .875rem; margin-bottom: 1.75rem; }

        /* ── Field styles ── */
        .form-label { font-weight: 600; font-size: .83rem; color: #374151; margin-bottom: .35rem; }
        .form-label .req { color: #ef4444; margin-left: 2px; }
        .input-icon-wrap { position: relative; }
        .input-icon-wrap .icon {
            position: absolute; left: .9rem; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: .9rem; pointer-events: none; z-index: 5;
        }
        .input-icon-wrap .form-control { padding-left: 2.5rem; }
        .form-control, .form-select {
            border-radius: 10px; border: 1.5px solid #e2e8f0;
            padding: .65rem 1rem; font-size: .875rem; transition: all .2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary); box-shadow: 0 0 0 3px rgba(21,128,61,.12); outline: none;
        }
        .form-control.is-invalid, .form-select.is-invalid { border-color: #ef4444; }
        .invalid-feedback { font-size: .77rem; color: #ef4444; }

        /* ── Section divider ── */
        .field-section {
            background: #f8fafc; border-radius: 12px; padding: 1.25rem;
            margin-bottom: 1.1rem; border: 1px solid #f1f5f9;
        }
        .field-section-title {
            font-size: .72rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .06em; color: var(--primary); margin-bottom: 1rem;
            display: flex; align-items: center; gap: .4rem;
        }

        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff; border: none; border-radius: 10px; padding: .82rem;
            font-weight: 700; font-size: .95rem; cursor: pointer; transition: all .25s;
            box-shadow: 0 4px 16px rgba(21,128,61,.3);
        }
        .btn-register:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(21,128,61,.4); }

        .alert-custom {
            border-radius: 10px; padding: .75rem 1rem;
            display: flex; align-items: flex-start; gap: .6rem; font-size: .84rem;
            margin-bottom: 1.25rem; border: none;
        }
        .alert-danger-custom { background: #fef2f2; color: #b91c1c; }

        .strength-bar { height: 4px; border-radius: 4px; background: #e2e8f0; margin-top: .4rem; overflow: hidden; }
        .strength-fill { height: 100%; border-radius: 4px; width: 0; transition: width .3s, background .3s; }

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

{{-- Left sticky panel --}}
<div class="auth-left d-none d-md-flex flex-column">
    <div class="left-brand">
        <div class="left-brand-icon"><i class="bi bi-tree-fill"></i></div>
        <div>
            <h5>Desa Pagendisan</h5>
            <span>Kec. Winong, Kab. Pati</span>
        </div>
    </div>

    <div class="left-steps">
        <h2>Daftar &amp; Nikmati<br><span class="hl">Layanan Digital</span><br>Desa</h2>
        <div class="step-item">
            <div class="step-num">1</div>
            <div class="step-text">
                <h6>Isi Data Diri</h6>
                <p>Masukkan nama lengkap, NIK, email, dan nomor HP Anda.</p>
            </div>
        </div>
        <div class="step-item">
            <div class="step-num">2</div>
            <div class="step-text">
                <h6>Buat Password</h6>
                <p>Buat password yang aman untuk melindungi akun Anda.</p>
            </div>
        </div>
        <div class="step-item">
            <div class="step-num">3</div>
            <div class="step-text">
                <h6>Ajukan Layanan</h6>
                <p>Langsung gunakan semua fitur layanan administrasi desa.</p>
            </div>
        </div>
    </div>

    <div class="left-info-items">
        <div class="left-info-item"><i class="bi bi-shield-fill-check"></i>Data Anda aman & terlindungi</div>
        <div class="left-info-item"><i class="bi bi-person-check-fill"></i>Gratis, tanpa biaya pendaftaran</div>
        <div class="left-info-item"><i class="bi bi-clock-fill"></i>Proses akun instan</div>
    </div>
</div>

{{-- Right scrollable form --}}
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

        <h3>Buat Akun Baru</h3>
        <p class="sub">Daftarkan diri Anda untuk mengakses layanan administrasi desa secara online.</p>

        @if($errors->any())
        <div class="alert-custom alert-danger-custom">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0 mt-1"></i>
            <div>
                <strong>Harap perbaiki kesalahan berikut:</strong>
                <ul style="margin:.35rem 0 0 1rem;padding:0;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Data Diri --}}
            <div class="field-section">
                <div class="field-section-title"><i class="bi bi-person-fill"></i>Data Diri</div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap <span class="req">*</span></label>
                    <div class="input-icon-wrap">
                        <i class="bi bi-person icon"></i>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Masukkan nama lengkap sesuai KTP"
                               value="{{ old('name') }}" autofocus>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mb-0">
                    <label class="form-label">NIK (16 digit) <span class="req">*</span></label>
                    <div class="input-icon-wrap">
                        <i class="bi bi-card-text icon"></i>
                        <input type="text" name="nik"
                               class="form-control @error('nik') is-invalid @enderror"
                               placeholder="Nomor Induk Kependudukan 16 digit"
                               value="{{ old('nik') }}" maxlength="16" pattern="[0-9]{16}"
                               oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="field-section">
                <div class="field-section-title"><i class="bi bi-telephone-fill"></i>Informasi Kontak</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-envelope icon"></i>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="email@contoh.com"
                                   value="{{ old('email') }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor HP <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-phone icon"></i>
                            <input type="text" name="no_hp"
                                   class="form-control @error('no_hp') is-invalid @enderror"
                                   placeholder="0812xxxxxxxx"
                                   value="{{ old('no_hp') }}">
                            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Password --}}
            <div class="field-section">
                <div class="field-section-title"><i class="bi bi-lock-fill"></i>Keamanan Akun</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Password <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-lock icon"></i>
                            <input type="password" name="password" id="pwdNew"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Min. 6 karakter"
                                   oninput="checkStrength(this.value)">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                        <div id="strengthLabel" style="font-size:.7rem;color:#94a3b8;margin-top:.3rem;"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Konfirmasi Password <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-lock-fill icon"></i>
                            <input type="password" name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password Anda">
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-start gap-2 mb-4">
                <input type="checkbox" id="agree" required
                       style="width:16px;height:16px;flex-shrink:0;margin-top:3px;accent-color:var(--primary);">
                <label for="agree" style="font-size:.82rem;color:#64748b;cursor:pointer;line-height:1.5;">
                    Saya menyetujui <strong style="color:var(--primary);">syarat &amp; ketentuan</strong> penggunaan sistem layanan Desa Pagendisan.
                </label>
            </div>

            <button type="submit" class="btn-register">
                <i class="bi bi-person-plus-fill me-2"></i>Buat Akun Sekarang
            </button>
        </form>

        <div style="text-align:center;margin-top:1.5rem;font-size:.875rem;color:#64748b;">
            Sudah punya akun?
            <a href="{{ route('login') }}" style="color:var(--primary);font-weight:700;text-decoration:none;">Masuk di sini</a>
        </div>
        <div style="text-align:center;margin-top:.75rem;">
            <a href="{{ route('landing') }}" style="color:#94a3b8;font-size:.8rem;text-decoration:none;">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function checkStrength(val) {
        const fill  = document.getElementById('strengthFill');
        const label = document.getElementById('strengthLabel');
        let score = 0;
        if (val.length >= 6)  score++;
        if (val.length >= 10) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^A-Za-z0-9]/.test(val)) score++;
        const map = [
            { pct: '0%',   bg: 'transparent', text: '' },
            { pct: '25%',  bg: '#ef4444',     text: 'Terlalu lemah' },
            { pct: '50%',  bg: '#f59e0b',     text: 'Lemah' },
            { pct: '75%',  bg: '#22c55e',     text: 'Cukup kuat' },
            { pct: '90%',  bg: '#15803d',     text: 'Kuat' },
            { pct: '100%', bg: '#15803d',     text: 'Sangat kuat' },
        ];
        const m = map[Math.min(score, 5)];
        fill.style.width = m.pct;
        fill.style.background = m.bg;
        label.textContent = m.text;
        label.style.color = m.bg;
    }
</script>
</body>
</html>

