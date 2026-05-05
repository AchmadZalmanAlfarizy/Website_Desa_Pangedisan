<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelayanan Administrasi Desa Pagendisan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --secondary: #059669;
        }
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

        /* ── Navbar ────────────────────────── */
        .navbar {
            background: rgba(255,255,255,.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 20px rgba(0,0,0,.08);
            padding: .75rem 0;
        }
        .navbar-brand { font-weight: 800; color: var(--primary) !important; font-size: 1.1rem; }
        .nav-link { font-weight: 500; color: #374151 !important; font-size: .9rem; }
        .nav-link:hover { color: var(--primary) !important; }

        /* ── Hero ──────────────────────────── */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #1e40af 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%; left: -20%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(59,130,246,.2) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -20%; right: -10%;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(5,150,105,.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-content { position: relative; z-index: 2; }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(59,130,246,.2);
            border: 1px solid rgba(59,130,246,.3);
            color: #93c5fd;
            padding: .4rem 1rem;
            border-radius: 100px;
            font-size: .8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 1.25rem;
        }
        .hero-title span { color: #60a5fa; }

        .hero-subtitle {
            font-size: 1.05rem;
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 520px;
        }

        .hero-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2.5rem;
        }
        .hero-info-item {
            display: flex;
            align-items: center;
            gap: .5rem;
            color: #cbd5e1;
            font-size: .875rem;
        }
        .hero-info-item i { color: #60a5fa; }

        .btn-hero-primary {
            background: var(--primary-light);
            color: #fff;
            border: none;
            padding: .8rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: .95rem;
            text-decoration: none;
            transition: all .2s;
        }
        .btn-hero-primary:hover {
            background: #2563eb;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59,130,246,.4);
        }
        .btn-hero-outline {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255,255,255,.3);
            padding: .8rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: .95rem;
            text-decoration: none;
            transition: all .2s;
        }
        .btn-hero-outline:hover {
            background: rgba(255,255,255,.1);
            color: #fff;
            border-color: rgba(255,255,255,.5);
        }

        /* ── Hero Illustration ─────────────── */
        .hero-illustration {
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(10px);
        }
        .illus-card {
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.12);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            margin-bottom: .75rem;
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .illus-icon {
            width: 42px; height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .illus-card h6 { color: #fff; margin: 0; font-size: .875rem; font-weight: 600; }
        .illus-card p { color: #94a3b8; margin: 0; font-size: .75rem; }

        /* ── Stats Bar ─────────────────────── */
        .stats-bar {
            background: #fff;
            padding: 2rem 0;
            box-shadow: 0 4px 20px rgba(0,0,0,.06);
        }
        .stat-item { text-align: center; }
        .stat-item .number { font-size: 2rem; font-weight: 800; color: var(--primary); line-height: 1; }
        .stat-item .label { font-size: .8rem; color: #64748b; font-weight: 500; margin-top: .3rem; }

        /* ── Features ──────────────────────── */
        .features-section { padding: 5rem 0; background: #f8fafc; }

        .feature-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            height: 100%;
            border: 1px solid #e2e8f0;
            transition: all .3s;
        }
        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,.1);
            border-color: var(--primary-light);
        }
        .feature-icon {
            width: 56px; height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .feature-card h5 { font-weight: 700; font-size: 1rem; color: #0f172a; margin-bottom: .5rem; }
        .feature-card p { color: #64748b; font-size: .875rem; line-height: 1.65; margin: 0; }

        /* ── Layanan ───────────────────────── */
        .layanan-section { padding: 5rem 0; background: #fff; }
        .layanan-card {
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            padding: 1.5rem;
            text-align: center;
            transition: all .3s;
            cursor: pointer;
        }
        .layanan-card:hover {
            border-color: var(--primary-light);
            background: #eff6ff;
        }
        .layanan-card i { font-size: 2rem; color: var(--primary); margin-bottom: .75rem; }
        .layanan-card h6 { font-weight: 700; color: #0f172a; font-size: .9rem; margin: 0; }

        /* ── Footer ────────────────────────── */
        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 3rem 0 1.5rem;
        }
        footer h6 { color: #fff; font-weight: 700; margin-bottom: 1rem; }
        footer a { color: #94a3b8; text-decoration: none; font-size: .875rem; }
        footer a:hover { color: #60a5fa; }
        .footer-divider { border-color: rgba(255,255,255,.1); margin: 1.5rem 0; }

        /* ── Scroll Animation ──────────────── */
        .fade-up { opacity: 0; transform: translateY(30px); transition: all .6s ease; }
        .fade-up.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

{{-- Sticky Navbar --}}
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing') }}">
            <div style="width:34px;height:34px;background:var(--primary);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-building text-white" style="font-size:.95rem;"></i>
            </div>
            Desa Pagendisan
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                <li class="nav-item ms-lg-2">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm px-3">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3">Daftar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Hero Section --}}
<section class="hero-section">
    <div class="container hero-content">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="bi bi-patch-check-fill"></i>
                    Sistem Pelayanan Digital Resmi
                </div>
                <h1 class="hero-title">
                    Sistem Pelayanan<br>
                    <span>Administrasi Desa</span><br>
                    Pagendisan
                </h1>
                <p class="hero-subtitle">
                    Digitalisasi pelayanan administrasi desa untuk meningkatkan efisiensi, transparansi, dan kemudahan akses bagi masyarakat.
                </p>
                <div class="hero-info">
                    <div class="hero-info-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Desa Pagendisan</span>
                    </div>
                    <div class="hero-info-item">
                        <i class="bi bi-map-fill"></i>
                        <span>Kec. Winong</span>
                    </div>
                    <div class="hero-info-item">
                        <i class="bi bi-building-fill"></i>
                        <span>Kab. Pati</span>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="btn-hero-primary">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-hero-outline">
                        <i class="bi bi-pencil-square me-2"></i>Ajukan Layanan
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-illustration">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div style="width:10px;height:10px;border-radius:50%;background:#ef4444;"></div>
                        <div style="width:10px;height:10px;border-radius:50%;background:#f59e0b;"></div>
                        <div style="width:10px;height:10px;border-radius:50%;background:#22c55e;"></div>
                        <span style="color:#94a3b8;font-size:.75rem;margin-left:.5rem;">Dashboard Admin</span>
                    </div>
                    <div class="illus-card">
                        <div class="illus-icon" style="background:rgba(59,130,246,.2);">
                            <i class="bi bi-people-fill text-primary"></i>
                        </div>
                        <div>
                            <h6>Data Penduduk</h6>
                            <p>Kelola data kependudukan desa</p>
                        </div>
                        <div class="ms-auto">
                            <span style="color:#22c55e;font-size:.8rem;font-weight:600;">● Aktif</span>
                        </div>
                    </div>
                    <div class="illus-card">
                        <div class="illus-icon" style="background:rgba(5,150,105,.2);">
                            <i class="bi bi-file-earmark-text-fill" style="color:#059669;"></i>
                        </div>
                        <div>
                            <h6>Pengajuan Surat</h6>
                            <p>3 pengajuan menunggu verifikasi</p>
                        </div>
                        <div class="ms-auto">
                            <span class="badge" style="background:#fef3c7;color:#d97706;font-size:.7rem;">3 Pending</span>
                        </div>
                    </div>
                    <div class="illus-card">
                        <div class="illus-icon" style="background:rgba(124,58,237,.2);">
                            <i class="bi bi-archive-fill" style="color:#7c3aed;"></i>
                        </div>
                        <div>
                            <h6>Arsip Dokumen</h6>
                            <p>Manajemen arsip digital desa</p>
                        </div>
                        <div class="ms-auto">
                            <span style="color:#22c55e;font-size:.8rem;font-weight:600;">● Aktif</span>
                        </div>
                    </div>
                    <div class="illus-card mb-0">
                        <div class="illus-icon" style="background:rgba(245,158,11,.2);">
                            <i class="bi bi-filetype-pdf" style="color:#f59e0b;"></i>
                        </div>
                        <div>
                            <h6>Generate Surat PDF</h6>
                            <p>Cetak surat otomatis bernomor</p>
                        </div>
                        <div class="ms-auto">
                            <span style="color:#22c55e;font-size:.8rem;font-weight:600;">● Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Stats Bar --}}
<section class="stats-bar">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="number">2.400+</div>
                    <div class="label">Jumlah Penduduk</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="number">8</div>
                    <div class="label">Jenis Layanan Surat</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="number">100%</div>
                    <div class="label">Layanan Digital</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="number">24/7</div>
                    <div class="label">Akses Online</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Features --}}
<section class="features-section" id="fitur">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="badge" style="background:#eff6ff;color:var(--primary);padding:.5rem 1rem;border-radius:100px;font-size:.8rem;font-weight:600;">Fitur Unggulan</span>
            <h2 class="mt-3 fw-800" style="font-size:2rem;font-weight:800;color:#0f172a;">
                Semua yang Anda Butuhkan
            </h2>
            <p class="text-muted mx-auto" style="max-width:500px;font-size:.95rem;">
                Sistem terintegrasi untuk mengelola seluruh kebutuhan administrasi desa secara digital dan efisien.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#eff6ff;">
                        <i class="bi bi-people-fill" style="color:var(--primary);"></i>
                    </div>
                    <h5>Pengelolaan Data Penduduk</h5>
                    <p>Kelola data kependudukan desa secara lengkap dengan fitur pencarian, filter, dan laporan statistik.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#f0fdf4;">
                        <i class="bi bi-envelope-paper-fill" style="color:var(--secondary);"></i>
                    </div>
                    <h5>Pelayanan Surat Online</h5>
                    <p>Pengajuan surat administrasi dilakukan secara online, tanpa perlu datang ke kantor desa.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fffbeb;">
                        <i class="bi bi-filetype-pdf" style="color:#d97706;"></i>
                    </div>
                    <h5>Generate Surat Otomatis</h5>
                    <p>Surat administrasi dibuat otomatis dalam format PDF dengan nomor surat yang terstruktur.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#f5f3ff;">
                        <i class="bi bi-clock-history" style="color:#7c3aed;"></i>
                    </div>
                    <h5>Tracking Status Real-time</h5>
                    <p>Pantau status pengajuan surat secara real-time dari pending, diproses, hingga selesai.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#fef2f2;">
                        <i class="bi bi-archive-fill" style="color:#dc2626;"></i>
                    </div>
                    <h5>Arsip Dokumen Digital</h5>
                    <p>Arsip seluruh dokumen desa secara digital dengan kategori dan sistem pencarian yang mudah.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 fade-up">
                <div class="feature-card">
                    <div class="feature-icon" style="background:#ecfdf5;">
                        <i class="bi bi-bar-chart-fill" style="color:var(--secondary);"></i>
                    </div>
                    <h5>Dashboard Statistik</h5>
                    <p>Pantau seluruh aktivitas administrasi desa melalui dashboard dengan grafik yang informatif.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Layanan --}}
<section class="layanan-section" id="layanan">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="badge" style="background:#f0fdf4;color:var(--secondary);padding:.5rem 1rem;border-radius:100px;font-size:.8rem;font-weight:600;">Jenis Layanan</span>
            <h2 class="mt-3 fw-800" style="font-size:2rem;font-weight:800;color:#0f172a;">
                Layanan Surat yang Tersedia
            </h2>
            <p class="text-muted mx-auto" style="max-width:500px;font-size:.95rem;">
                Berbagai jenis surat keterangan dapat diajukan secara online kapan saja dan di mana saja.
            </p>
        </div>
        <div class="row g-3">
            @php
            $layanans = [
                ['icon' => 'bi-person-vcard', 'nama' => 'Surat Keterangan Domisili'],
                ['icon' => 'bi-mortarboard', 'nama' => 'Surat Keterangan Tidak Mampu'],
                ['icon' => 'bi-heart-pulse', 'nama' => 'Surat Keterangan Kelahiran'],
                ['icon' => 'bi-flower1', 'nama' => 'Surat Keterangan Kematian'],
                ['icon' => 'bi-house-heart', 'nama' => 'Surat Keterangan Usaha'],
                ['icon' => 'bi-briefcase', 'nama' => 'Surat Pengantar SKCK'],
                ['icon' => 'bi-file-earmark-check', 'nama' => 'Surat Keterangan Belum Menikah'],
                ['icon' => 'bi-clipboard2-data', 'nama' => 'Surat Keterangan Lainnya'],
            ];
            @endphp
            @foreach($layanans as $layanan)
            <div class="col-6 col-md-4 col-lg-3 fade-up">
                <div class="layanan-card">
                    <i class="bi {{ $layanan['icon'] }}"></i>
                    <h6>{{ $layanan['nama'] }}</h6>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5">
                <i class="bi bi-pencil-square me-2"></i>Daftar & Ajukan Sekarang
            </a>
        </div>
    </div>
</section>

{{-- CTA Banner --}}
<section style="background:linear-gradient(135deg,#1e40af,#3b82f6);padding:4rem 0;">
    <div class="container text-center text-white">
        <h2 style="font-weight:800;font-size:2rem;" class="mb-3">Mulai Gunakan Layanan Digital</h2>
        <p class="mb-4" style="opacity:.85;max-width:500px;margin:0 auto 2rem;">
            Daftarkan diri Anda dan nikmati kemudahan pelayanan administrasi desa tanpa antri.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 fw-600" style="color:var(--primary);font-weight:600;">
                <i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sudah Punya Akun
            </a>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer id="kontak">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:36px;height:36px;background:var(--primary-light);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-building text-white"></i>
                    </div>
                    <h6 class="mb-0">Desa Pagendisan</h6>
                </div>
                <p style="font-size:.875rem;line-height:1.7;color:#94a3b8;">
                    Sistem Pelayanan Administrasi Desa Pagendisan — platform digital untuk kemudahan masyarakat dalam mengakses layanan administrasi.
                </p>
            </div>
            <div class="col-6 col-lg-2">
                <h6>Navigasi</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#fitur">Fitur</a></li>
                    <li class="mb-2"><a href="#layanan">Layanan</a></li>
                    <li class="mb-2"><a href="{{ route('login') }}">Login</a></li>
                    <li class="mb-2"><a href="{{ route('register') }}">Daftar</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h6>Layanan</h6>
                <ul class="list-unstyled" style="font-size:.875rem;">
                    <li class="mb-1"><a href="#">Surat Domisili</a></li>
                    <li class="mb-1"><a href="#">Surat Tidak Mampu</a></li>
                    <li class="mb-1"><a href="#">Surat Usaha</a></li>
                    <li class="mb-1"><a href="#">Surat Pengantar SKCK</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h6>Kontak</h6>
                <div class="d-flex flex-column gap-2" style="font-size:.875rem;">
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill" style="color:#60a5fa;margin-top:2px;"></i>
                        <span>Desa Pagendisan, Kecamatan Winong, Kabupaten Pati, Jawa Tengah</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-clock-fill" style="color:#60a5fa;"></i>
                        <span>Senin - Jumat: 08.00 - 16.00 WIB</span>
                    </div>
                </div>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <p style="font-size:.8rem;margin:0;">
                © {{ date('Y') }} Desa Pagendisan — Sistem Pelayanan Administrasi Digital
            </p>
            <p style="font-size:.8rem;margin:0;">
                Kecamatan Winong, Kabupaten Pati, Jawa Tengah
            </p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Scroll animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

    // Smooth navbar on scroll
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        navbar.style.boxShadow = window.scrollY > 20
            ? '0 4px 20px rgba(0,0,0,.15)'
            : '0 1px 20px rgba(0,0,0,.08)';
    });
</script>
</body>
</html>
