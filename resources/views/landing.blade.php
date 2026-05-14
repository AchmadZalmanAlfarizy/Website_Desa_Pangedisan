<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelayanan Administrasi Desa Pagendisan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <style>
        /* ─────────────────────── ROOT ─────────────────────── */
        :root {
            --primary:        #15803d;
            --primary-light:  #22c55e;
            --primary-dark:   #14532d;
            --accent:         #f59e0b;
            --accent-dark:    #d97706;
            --text:           #0f172a;
            --muted:          #64748b;
            --bg-soft:        #f0fdf4;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; color: var(--text); }

        /* ── Helpers ── */
        .section-badge {
            display: inline-block;
            padding: .4rem 1.1rem;
            border-radius: 100px;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }
        .section-title { font-size: clamp(1.65rem,3.5vw,2.15rem); font-weight: 800; color: var(--text); line-height: 1.25; }
        .section-sub   { font-size: .95rem; color: var(--muted); max-width: 520px; margin: 0 auto; line-height: 1.75; }

        /* ── Navbar ── */
        .navbar {
            background: rgba(255,255,255,.96) !important;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 1px 0 rgba(0,0,0,.06);
            padding: .5rem 0;
            transition: box-shadow .3s;
        }
        .navbar.scrolled { box-shadow: 0 4px 24px rgba(0,0,0,.10); }
        .navbar-brand   { font-weight: 800; color: var(--primary) !important; font-size: .95rem; }
        .brand-icon {
            width:36px; height:36px;
            background: linear-gradient(135deg,var(--primary),var(--primary-light));
            border-radius:10px;
            display:flex; align-items:center; justify-content:center; flex-shrink:0;
        }
        .nav-link { font-weight:500; color:#374151 !important; font-size:.88rem; position:relative; }
        .nav-link::after {
            content:''; position:absolute; bottom:-2px; left:50%; right:50%;
            height:2px; background:var(--primary); border-radius:2px; transition:all .25s;
        }
        .nav-link:hover::after { left:0; right:0; }
        .nav-link:hover { color:var(--primary) !important; }
        .btn-nav-login {
            border:1.5px solid var(--primary); color:var(--primary); background:transparent;
            padding:.38rem 1.1rem; border-radius:8px; font-weight:600; font-size:.85rem;
            text-decoration:none; transition:all .2s;
        }
        .btn-nav-login:hover { background:var(--primary); color:#fff; }
        .btn-nav-register {
            background:linear-gradient(135deg,var(--primary),var(--primary-light));
            color:#fff !important; padding:.38rem 1.1rem; border-radius:8px;
            font-weight:600; font-size:.85rem; text-decoration:none; transition:all .2s;
            box-shadow:0 2px 8px rgba(21,128,61,.25);
        }
        .btn-nav-register:hover { transform:translateY(-1px); box-shadow:0 4px 16px rgba(21,128,61,.35); }

        /* ── Hero ── */
        .hero-section {
            min-height:100vh;
            background-image:url('/images/kantor-desa.jpg');
            background-position:center; background-size:cover; background-attachment:fixed;
            position:relative; display:flex; align-items:center; padding:6rem 0 4rem;
        }
        .hero-section::before {
            content:''; position:absolute; inset:0;
            background:linear-gradient(120deg,rgba(10,40,20,.78) 0%,rgba(20,83,45,.60) 55%,rgba(10,40,20,.72) 100%);
            z-index:1;
        }
        .hero-section::after {
            content:''; position:absolute; inset:0;
            background:radial-gradient(ellipse 80% 60% at 70% 50%,rgba(34,197,94,.08) 0%,transparent 70%);
            z-index:2; pointer-events:none;
        }
        .hero-content { position:relative; z-index:3; }
        .hero-badge {
            display:inline-flex; align-items:center; gap:.45rem;
            background:rgba(34,197,94,.18); border:1px solid rgba(34,197,94,.35);
            color:#86efac; padding:.35rem 1rem; border-radius:100px;
            font-size:.78rem; font-weight:700; letter-spacing:.04em; text-transform:uppercase; margin-bottom:1.4rem;
        }
        .hero-title {
            font-size:clamp(2rem,5.5vw,3.4rem); font-weight:800; color:#fff;
            line-height:1.18; margin-bottom:1.2rem; text-shadow:0 3px 12px rgba(0,0,0,.25);
        }
        .hero-title .hl { color:#86efac; }
        .hero-subtitle { font-size:1rem; color:#d1fae5; line-height:1.75; margin-bottom:2rem; max-width:500px; }
        .hero-meta { display:flex; flex-wrap:wrap; gap:1.1rem; margin-bottom:2.5rem; }
        .hero-meta-item { display:flex; align-items:center; gap:.45rem; color:#a7f3d0; font-size:.83rem; font-weight:500; }
        .hero-meta-item i { color:#4ade80; }
        .btn-hero-primary {
            display:inline-flex; align-items:center; gap:.5rem;
            background:linear-gradient(135deg,var(--primary),var(--primary-light));
            color:#fff; border:none; padding:.78rem 2rem; border-radius:10px;
            font-weight:700; font-size:.92rem; text-decoration:none; transition:all .25s;
            box-shadow:0 6px 20px rgba(21,128,61,.4);
        }
        .btn-hero-primary:hover { color:#fff; transform:translateY(-3px); box-shadow:0 12px 28px rgba(21,128,61,.5); }
        .btn-hero-outline {
            display:inline-flex; align-items:center; gap:.5rem;
            background:rgba(255,255,255,.1); color:#fff; border:1.5px solid rgba(255,255,255,.35);
            padding:.78rem 2rem; border-radius:10px; font-weight:600; font-size:.92rem;
            text-decoration:none; transition:all .25s; backdrop-filter:blur(4px);
        }
        .btn-hero-outline:hover { background:rgba(255,255,255,.18); color:#fff; border-color:rgba(255,255,255,.6); }

        /* ── Hero Panel ── */
        .hero-panel {
            background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.15);
            border-radius:20px; padding:1.75rem;
            backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px);
        }
        .panel-header {
            display:flex; align-items:center; gap:6px; margin-bottom:1.25rem;
            padding-bottom:.75rem; border-bottom:1px solid rgba(255,255,255,.1);
        }
        .panel-dot { width:10px; height:10px; border-radius:50%; }
        .panel-label { color:#94a3b8; font-size:.72rem; margin-left:.5rem; }
        .illus-card {
            background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.1);
            border-radius:12px; padding:.9rem 1.1rem; margin-bottom:.65rem;
            display:flex; align-items:center; gap:.75rem; transition:all .25s;
        }
        .illus-card:last-child { margin-bottom:0; }
        .illus-card:hover { background:rgba(255,255,255,.12); transform:translateX(4px); }
        .illus-icon {
            width:40px; height:40px; border-radius:10px;
            display:flex; align-items:center; justify-content:center;
            font-size:1.1rem; flex-shrink:0;
        }
        .illus-card h6 { color:#fff; margin:0; font-size:.83rem; font-weight:600; }
        .illus-card p  { color:#94a3b8; margin:0; font-size:.72rem; }

        /* ── Marquee Strip ── */
        .marquee-strip { background:var(--primary-dark); padding:.65rem 0; overflow:hidden; }
        .marquee-track {
            display:flex; gap:0; animation:marqueeScroll 30s linear infinite; width:max-content;
        }
        @keyframes marqueeScroll { from{transform:translateX(0)} to{transform:translateX(-50%)} }
        .marquee-item {
            display:flex; align-items:center; gap:.5rem; color:#d1fae5;
            font-size:.8rem; font-weight:600; white-space:nowrap; padding:0 2rem;
        }
        .marquee-item i { color:#4ade80; }
        .marquee-sep { color:rgba(255,255,255,.25); padding:0 .5rem; }

        /* ── Stats ── */
        .stats-section { background:#fff; padding:3rem 0; border-bottom:1px solid #e2e8f0; }
        .stat-card { text-align:center; padding:1.5rem 1rem; border-radius:16px; transition:all .3s; }
        .stat-card:hover { background:var(--bg-soft); transform:translateY(-4px); }
        .stat-number { font-size:2.4rem; font-weight:800; color:var(--primary); line-height:1; letter-spacing:-.02em; }
        .stat-label  { font-size:.82rem; color:var(--muted); font-weight:500; margin-top:.4rem; }
        .stat-icon {
            width:46px; height:46px; background:var(--bg-soft); border-radius:12px;
            display:flex; align-items:center; justify-content:center; font-size:1.25rem;
            color:var(--primary); margin:0 auto .75rem;
        }

        /* ── Features ── */
        .features-section { padding:5.5rem 0; background:#f8fafc; position:relative; overflow:hidden; }
        .features-section::before {
            content:''; position:absolute; top:-80px; right:-80px; width:400px; height:400px;
            background:radial-gradient(circle,rgba(21,128,61,.07) 0%,transparent 70%); pointer-events:none;
        }
        .feature-card {
            background:#fff; border-radius:18px; padding:2rem 1.75rem; height:100%;
            border:1px solid #e2e8f0; transition:all .3s; position:relative; overflow:hidden;
        }
        .feature-card::after {
            content:''; position:absolute; bottom:0; left:0; right:0; height:3px;
            background:linear-gradient(90deg,var(--primary),var(--primary-light));
            transform:scaleX(0); transform-origin:left; transition:transform .3s;
        }
        .feature-card:hover { transform:translateY(-8px); box-shadow:0 24px 48px rgba(0,0,0,.09); border-color:rgba(21,128,61,.2); }
        .feature-card:hover::after { transform:scaleX(1); }
        .feature-icon {
            width:54px; height:54px; border-radius:14px;
            display:flex; align-items:center; justify-content:center;
            font-size:1.4rem; margin-bottom:1.25rem;
        }
        .feature-card h5 { font-weight:700; font-size:.97rem; color:var(--text); margin-bottom:.5rem; }
        .feature-card p  { color:var(--muted); font-size:.875rem; line-height:1.7; margin:0; }

        /* ── How It Works ── */
        .hiw-section { padding:5.5rem 0; background:#fff; }
        .hiw-step { text-align:center; position:relative; }
        .hiw-step:not(:last-child)::after {
            content:''; position:absolute; top:36px;
            left:calc(50% + 40px); right:calc(-50% + 40px);
            height:2px; background:linear-gradient(90deg,var(--primary-light),#e2e8f0); border-radius:2px;
        }
        @media(max-width:767px){ .hiw-step:not(:last-child)::after { display:none; } }
        .hiw-num {
            width:72px; height:72px; border-radius:50%;
            background:linear-gradient(135deg,var(--primary),var(--primary-light));
            color:#fff; font-size:1.4rem; font-weight:800;
            display:flex; align-items:center; justify-content:center;
            margin:0 auto 1.1rem; box-shadow:0 8px 24px rgba(21,128,61,.3); position:relative; z-index:1;
        }
        .hiw-step h6 { font-weight:700; font-size:.95rem; margin-bottom:.4rem; }
        .hiw-step p  { font-size:.83rem; color:var(--muted); max-width:180px; margin:0 auto; line-height:1.65; }

        /* ── Layanan ── */
        .layanan-section { padding:5.5rem 0; background:var(--bg-soft); position:relative; overflow:hidden; }
        .layanan-section::before {
            content:''; position:absolute; bottom:0; left:-60px; width:300px; height:300px;
            background:radial-gradient(circle,rgba(21,128,61,.08) 0%,transparent 70%); pointer-events:none;
        }
        .layanan-card {
            background:#fff; border:1.5px solid #e2e8f0; border-radius:14px;
            padding:1.5rem 1.25rem; text-align:center; transition:all .3s; cursor:pointer; height:100%;
        }
        .layanan-card:hover {
            border-color:var(--primary); transform:translateY(-5px);
            box-shadow:0 16px 32px rgba(21,128,61,.12);
        }
        .layanan-icon {
            width:52px; height:52px; background:var(--bg-soft); border-radius:14px;
            display:flex; align-items:center; justify-content:center;
            font-size:1.4rem; color:var(--primary); margin:0 auto .9rem; transition:all .3s;
        }
        .layanan-card:hover .layanan-icon { background:var(--primary); color:#fff; }
        .layanan-card h6 { font-weight:700; color:var(--text); font-size:.85rem; margin:0; }

        /* ── CTA Section ── */
        .cta-section {
            padding:5rem 0; position:relative; overflow:hidden;
            background:linear-gradient(135deg,var(--primary-dark) 0%,var(--primary) 50%,#16a34a 100%);
        }
        .cta-section::before {
            content:''; position:absolute; inset:0;
            background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events:none;
        }
        .cta-section::after {
            content:''; position:absolute; top:-100px; right:-100px; width:400px; height:400px;
            background:radial-gradient(circle,rgba(255,255,255,.08) 0%,transparent 65%); pointer-events:none;
        }
        .cta-content { position:relative; z-index:1; }
        .btn-cta-white {
            display:inline-flex; align-items:center; gap:.5rem;
            background:#fff; color:var(--primary); padding:.85rem 2.25rem; border-radius:12px;
            font-weight:700; font-size:.95rem; text-decoration:none; transition:all .25s;
            box-shadow:0 6px 20px rgba(0,0,0,.15);
        }
        .btn-cta-white:hover { transform:translateY(-3px); box-shadow:0 12px 30px rgba(0,0,0,.2); color:var(--primary-dark); }
        .btn-cta-outline {
            display:inline-flex; align-items:center; gap:.5rem;
            background:transparent; color:#fff; border:2px solid rgba(255,255,255,.4);
            padding:.85rem 2.25rem; border-radius:12px; font-weight:600; font-size:.95rem;
            text-decoration:none; transition:all .25s;
        }
        .btn-cta-outline:hover { background:rgba(255,255,255,.12); color:#fff; border-color:rgba(255,255,255,.7); }

        /* ── Footer ── */
        .footer { background:#0d1f0f; color:#94a3b8; padding:4rem 0 0; }
        .footer-brand h6 { color:#fff; font-weight:800; font-size:1rem; }
        .footer-desc { font-size:.85rem; line-height:1.75; color:#64748b; max-width:280px; }
        .footer h6 { color:#e2e8f0; font-weight:700; font-size:.88rem; margin-bottom:1rem; letter-spacing:.02em; text-transform:uppercase; }
        .footer a { color:#64748b; text-decoration:none; font-size:.84rem; transition:color .2s; }
        .footer a:hover { color:#4ade80; }
        .footer ul { list-style:none; padding:0; margin:0; }
        .footer ul li { margin-bottom:.55rem; }
        .footer-divider { border-color:rgba(255,255,255,.06); margin:2.5rem 0 1.5rem; }
        .footer-bottom { padding-bottom:2rem; font-size:.78rem; color:#475569; }
        .footer-contact-item { display:flex; align-items:flex-start; gap:.6rem; font-size:.84rem; margin-bottom:.75rem; }
        .footer-contact-item i { color:#4ade80; margin-top:2px; flex-shrink:0; }
        .social-btn {
            display:inline-flex; align-items:center; justify-content:center;
            width:34px; height:34px; border-radius:8px; background:rgba(255,255,255,.06);
            color:#94a3b8; font-size:.9rem; text-decoration:none; transition:all .2s;
        }
        .social-btn:hover { background:var(--primary); color:#fff; }

        /* ── Animations ── */
        .fade-up { opacity:0; transform:translateY(32px); transition:opacity .6s ease,transform .6s ease; }
        .fade-up.visible { opacity:1; transform:translateY(0); }
        .fade-up.delay-1 { transition-delay:.12s; }
        .fade-up.delay-2 { transition-delay:.22s; }
        .fade-up.delay-3 { transition-delay:.32s; }
        .fade-up.delay-4 { transition-delay:.42s; }

        /* ── Responsive ── */
        @media(max-width:991px){ .hero-section{ background-attachment:scroll; } .hero-panel{ margin-top:2.5rem; } }
        @media(max-width:575px){ .hero-title{ font-size:2rem; } .stat-number{ font-size:1.9rem; } }
    </style>
</head>
<body>

{{-- ═══════════════ NAVBAR ═══════════════ --}}
<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing') }}">
            <div class="brand-icon">
                <i class="bi bi-tree-fill text-white" style="font-size:.9rem;"></i>
            </div>
            Desa Pagendisan
        </a>
        <button class="navbar-toggler border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link px-3" href="#fitur">Fitur</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#cara">Cara Pakai</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#layanan">Layanan</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#kontak">Kontak</a></li>
                <li class="nav-item ms-lg-2">
                    <a href="{{ route('login') }}" class="btn-nav-login">Masuk</a>
                </li>
                <li class="nav-item ms-lg-1">
                    <a href="{{ route('register') }}" class="btn-nav-register">Daftar Sekarang</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- ═══════════════ HERO ═══════════════ --}}
<section class="hero-section">
    <div class="container hero-content">
        <div class="row align-items-center g-5">

            {{-- Left text --}}
            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="bi bi-patch-check-fill"></i>
                    Sistem Resmi Desa Pagendisan
                </div>
                <h1 class="hero-title">
                    Pelayanan Administrasi<br>
                    <span class="hl">Desa Pagendisan</span><br>
                    Kini Serba Digital
                </h1>
                <p class="hero-subtitle">
                    Ajukan surat keterangan, pantau status, dan unduh dokumen langsung dari rumah —
                    cepat, mudah, dan transparan.
                </p>
                <div class="hero-meta">
                    <div class="hero-meta-item"><i class="bi bi-geo-alt-fill"></i><span>Desa Pagendisan</span></div>
                    <div class="hero-meta-item"><i class="bi bi-map-fill"></i><span>Kec. Winong</span></div>
                    <div class="hero-meta-item"><i class="bi bi-building-fill"></i><span>Kab. Pati</span></div>
                </div>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="btn-hero-primary">
                        <i class="bi bi-box-arrow-in-right"></i>Masuk Sekarang
                    </a>
                    <a href="{{ route('register') }}" class="btn-hero-outline">
                        <i class="bi bi-pencil-square"></i>Ajukan Layanan
                    </a>
                </div>
            </div>

            {{-- Right panel --}}
            <div class="col-lg-6">
                <div class="hero-panel">
                    <div class="panel-header">
                        <div class="panel-dot" style="background:#ef4444;"></div>
                        <div class="panel-dot" style="background:#f59e0b;"></div>
                        <div class="panel-dot" style="background:#22c55e;"></div>
                        <span class="panel-label">Portal Admin Desa Pagendisan</span>
                    </div>

                    <div class="illus-card">
                        <div class="illus-icon" style="background:rgba(34,197,94,.18);">
                            <i class="bi bi-people-fill" style="color:#4ade80;"></i>
                        </div>
                        <div>
                            <h6>Data Penduduk</h6>
                            <p>Kelola data kependudukan desa</p>
                        </div>
                        <div class="ms-auto"><span style="color:#22c55e;font-size:.75rem;font-weight:700;">● Aktif</span></div>
                    </div>

                    <div class="illus-card">
                        <div class="illus-icon" style="background:rgba(245,158,11,.18);">
                            <i class="bi bi-file-earmark-text-fill" style="color:#f59e0b;"></i>
                        </div>
                        <div>
                            <h6>Pengajuan Surat</h6>
                            <p>3 pengajuan menunggu verifikasi</p>
                        </div>
                        <div class="ms-auto">
                            <span class="badge rounded-pill" style="background:#fef3c7;color:#d97706;font-size:.68rem;font-weight:700;">3 Pending</span>
                        </div>
                    </div>

                    <div class="illus-card">
                        <div class="illus-icon" style="background:rgba(124,58,237,.18);">
                            <i class="bi bi-archive-fill" style="color:#a78bfa;"></i>
                        </div>
                        <div>
                            <h6>Arsip Dokumen</h6>
                            <p>Manajemen arsip digital desa</p>
                        </div>
                        <div class="ms-auto"><span style="color:#22c55e;font-size:.75rem;font-weight:700;">● Aktif</span></div>
                    </div>

                    <div class="illus-card">
                        <div class="illus-icon" style="background:rgba(239,68,68,.18);">
                            <i class="bi bi-filetype-pdf" style="color:#f87171;"></i>
                        </div>
                        <div>
                            <h6>Generate Surat PDF</h6>
                            <p>Cetak surat otomatis bernomor</p>
                        </div>
                        <div class="ms-auto"><span style="color:#22c55e;font-size:.75rem;font-weight:700;">● Aktif</span></div>
                    </div>

                    <div class="mt-3 pt-3" style="border-top:1px solid rgba(255,255,255,.08);">
                        <div class="d-flex justify-content-between mb-1">
                            <span style="color:#94a3b8;font-size:.72rem;">Tingkat Kepuasan Layanan</span>
                            <span style="color:#4ade80;font-size:.72rem;font-weight:700;">98%</span>
                        </div>
                        <div style="background:rgba(255,255,255,.1);border-radius:100px;height:6px;overflow:hidden;">
                            <div style="width:98%;height:100%;background:linear-gradient(90deg,#15803d,#4ade80);border-radius:100px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════ MARQUEE STRIP ═══════════════ --}}
<div class="marquee-strip" aria-hidden="true">
    <div class="marquee-track">
        @php
        $items = [
            ['icon'=>'bi-check-circle-fill','text'=>'Pelayanan Surat Online'],
            ['icon'=>'bi-shield-fill-check','text'=>'Data Aman & Terenkripsi'],
            ['icon'=>'bi-lightning-fill',   'text'=>'Proses Cepat & Mudah'],
            ['icon'=>'bi-phone-fill',        'text'=>'Bisa dari Smartphone'],
            ['icon'=>'bi-clock-fill',        'text'=>'Akses 24 Jam / 7 Hari'],
            ['icon'=>'bi-file-pdf-fill',     'text'=>'Download PDF Langsung'],
            ['icon'=>'bi-people-fill',       'text'=>'Untuk Seluruh Warga'],
            ['icon'=>'bi-geo-alt-fill',      'text'=>'Desa Pagendisan — Kab. Pati'],
        ];
        $all = array_merge($items,$items);
        @endphp
        @foreach($all as $it)
            <span class="marquee-item"><i class="bi {{ $it['icon'] }}"></i>{{ $it['text'] }}</span>
            <span class="marquee-sep">✦</span>
        @endforeach
    </div>
</div>

{{-- ═══════════════ STATS ═══════════════ --}}
<section class="stats-section">
    <div class="container">
        <div class="row g-3 justify-content-center">
            <div class="col-6 col-md-3 fade-up">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                    <div class="stat-number" data-count="2400">0</div>
                    <div class="stat-label">Jumlah Penduduk</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up delay-1">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <div class="stat-number" data-count="8">0</div>
                    <div class="stat-label">Jenis Layanan Surat</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up delay-2">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-lightning-fill"></i></div>
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Layanan Terdigitalisasi</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-up delay-3">
                <div class="stat-card">
                    <div class="stat-icon"><i class="bi bi-clock-fill"></i></div>
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Akses Online</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════ FEATURES ═══════════════ --}}
<section class="features-section" id="fitur">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge" style="background:#f0fdf4;color:var(--primary);">✦ Fitur Unggulan</span>
            <h2 class="section-title mt-3">Semua yang Anda Butuhkan</h2>
            <p class="section-sub mt-2">
                Sistem terintegrasi untuk mengelola seluruh kebutuhan administrasi desa secara digital, efisien, dan transparan.
            </p>
        </div>
        <div class="row g-4">
            @php
            $features = [
                ['bg'=>'#f0fdf4','icon'=>'bi-people-fill',         'ic'=>'var(--primary)', 'title'=>'Data Penduduk',         'desc'=>'Kelola data kependudukan secara lengkap dengan pencarian, filter, dan laporan statistik yang mudah dipahami.'],
                ['bg'=>'#fefce8','icon'=>'bi-envelope-paper-fill', 'ic'=>'#d97706',        'title'=>'Surat Online',          'desc'=>'Pengajuan surat administrasi tanpa harus datang ke kantor — cukup lewat smartphone atau komputer.'],
                ['bg'=>'#fef2f2','icon'=>'bi-filetype-pdf',        'ic'=>'#ef4444',        'title'=>'Generate PDF Otomatis', 'desc'=>'Surat dicetak otomatis dalam format PDF resmi, lengkap dengan nomor surat yang terstruktur.'],
                ['bg'=>'#f5f3ff','icon'=>'bi-clock-history',       'ic'=>'#7c3aed',        'title'=>'Tracking Real-time',   'desc'=>'Pantau status pengajuan dari pending, diproses, hingga selesai tanpa perlu menelepon kantor.'],
                ['bg'=>'#eff6ff','icon'=>'bi-archive-fill',        'ic'=>'#2563eb',        'title'=>'Arsip Digital',         'desc'=>'Simpan dan cari dokumen desa secara digital — tidak perlu khawatir arsip hilang atau rusak.'],
                ['bg'=>'#fff7ed','icon'=>'bi-bar-chart-fill',      'ic'=>'#ea580c',        'title'=>'Dashboard Statistik',  'desc'=>'Monitor seluruh aktivitas administrasi lewat dashboard dengan grafik yang informatif dan mudah dibaca.'],
            ];
            @endphp
            @foreach($features as $i => $f)
            <div class="col-md-6 col-lg-4 fade-up delay-{{ ($i % 3) + 1 }}">
                <div class="feature-card">
                    <div class="feature-icon" style="background:{{ $f['bg'] }};">
                        <i class="bi {{ $f['icon'] }}" style="color:{{ $f['ic'] }};"></i>
                    </div>
                    <h5>{{ $f['title'] }}</h5>
                    <p>{{ $f['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════ HOW IT WORKS ═══════════════ --}}
<section class="hiw-section" id="cara">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge" style="background:#fefce8;color:#d97706;">✦ Cara Penggunaan</span>
            <h2 class="section-title mt-3">Mudah dalam 4 Langkah</h2>
            <p class="section-sub mt-2">Tidak perlu keahlian teknis — siapa pun bisa menggunakan layanan ini dengan mudah.</p>
        </div>
        <div class="row g-4 justify-content-center">
            @php
            $steps = [
                ['icon'=>'bi-person-plus-fill',       'title'=>'Daftar Akun',      'desc'=>'Buat akun dengan NIK dan data diri yang valid.'],
                ['icon'=>'bi-file-earmark-plus-fill', 'title'=>'Pilih Layanan',    'desc'=>'Pilih jenis surat yang ingin Anda ajukan.'],
                ['icon'=>'bi-send-fill',              'title'=>'Kirim Pengajuan',  'desc'=>'Isi formulir dan kirim pengajuan secara online.'],
                ['icon'=>'bi-download',               'title'=>'Unduh Dokumen',    'desc'=>'Setelah disetujui, unduh dokumen PDF langsung.'],
            ];
            @endphp
            @foreach($steps as $i => $s)
            <div class="col-6 col-md-3 fade-up delay-{{ $i + 1 }}">
                <div class="hiw-step">
                    <div class="hiw-num"><i class="bi {{ $s['icon'] }}" style="font-size:1.25rem;"></i></div>
                    <h6>{{ $s['title'] }}</h6>
                    <p>{{ $s['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════ LAYANAN ═══════════════ --}}
<section class="layanan-section" id="layanan">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <span class="section-badge" style="background:#dcfce7;color:var(--primary);">✦ Jenis Layanan</span>
            <h2 class="section-title mt-3">Layanan Surat yang Tersedia</h2>
            <p class="section-sub mt-2">
                Berbagai jenis surat keterangan dapat diajukan kapan saja dan di mana saja tanpa antre.
            </p>
        </div>
        <div class="row g-3">
            @php
            $layanans = [
                ['icon'=>'bi-house-fill',              'nama'=>'Surat Keterangan Domisili'],
                ['icon'=>'bi-mortarboard-fill',        'nama'=>'Surat Keterangan Tidak Mampu'],
                ['icon'=>'bi-heart-pulse-fill',        'nama'=>'Surat Keterangan Kelahiran'],
                ['icon'=>'bi-flower1',                 'nama'=>'Surat Keterangan Kematian'],
                ['icon'=>'bi-shop-window',             'nama'=>'Surat Keterangan Usaha'],
                ['icon'=>'bi-shield-fill-check',       'nama'=>'Surat Pengantar SKCK'],
                ['icon'=>'bi-file-earmark-check-fill', 'nama'=>'Surat Belum Menikah'],
                ['icon'=>'bi-clipboard2-data-fill',    'nama'=>'Surat Keterangan Lainnya'],
            ];
            @endphp
            @foreach($layanans as $i => $l)
            <div class="col-6 col-md-4 col-lg-3 fade-up delay-{{ ($i % 4) + 1 }}">
                <div class="layanan-card">
                    <div class="layanan-icon"><i class="bi {{ $l['icon'] }}"></i></div>
                    <h6>{{ $l['nama'] }}</h6>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5 fade-up">
            <a href="{{ route('register') }}"
               class="btn btn-lg px-5 py-3 fw-bold rounded-3 text-white"
               style="background:var(--primary);border:none;box-shadow:0 8px 24px rgba(21,128,61,.35);font-size:.95rem;">
                <i class="bi bi-pencil-square me-2"></i>Daftar &amp; Ajukan Sekarang
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════ CTA BANNER ═══════════════ --}}
<section class="cta-section">
    <div class="container cta-content text-center text-white">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <span class="section-badge mb-4 d-inline-block" style="background:rgba(255,255,255,.15);color:#d1fae5;">
                    ✦ Mulai Sekarang
                </span>
                <h2 class="mb-3" style="font-weight:800;font-size:clamp(1.7rem,4vw,2.4rem);line-height:1.25;">
                    Layanan Digital untuk<br>Masyarakat Pagendisan
                </h2>
                <p class="mb-5" style="color:#bbf7d0;font-size:.97rem;line-height:1.75;max-width:460px;margin:0 auto 2.5rem;">
                    Bergabunglah dan rasakan kemudahan pelayanan administrasi desa tanpa perlu antre di kantor.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn-cta-white">
                        <i class="bi bi-person-plus-fill"></i>Daftar Gratis
                    </a>
                    <a href="{{ route('login') }}" class="btn-cta-outline">
                        <i class="bi bi-box-arrow-in-right"></i>Sudah Punya Akun
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════ FOOTER ═══════════════ --}}
<footer class="footer" id="kontak">
    <div class="container">
        <div class="row g-5">

            {{-- Brand --}}
            <div class="col-lg-4">
                <div class="footer-brand d-flex align-items-center gap-2 mb-3">
                    <div style="width:38px;height:38px;background:var(--primary);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-tree-fill text-white"></i>
                    </div>
                    <h6 class="mb-0">Desa Pagendisan</h6>
                </div>
                <p class="footer-desc">
                    Sistem Pelayanan Administrasi Digital Desa Pagendisan — hadir untuk kemudahan dan transparansi layanan bagi seluruh warga.
                </p>
                <div class="d-flex gap-2 mt-3">
                    <a href="#" class="social-btn"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="social-btn"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            {{-- Navigasi --}}
            <div class="col-6 col-lg-2">
                <h6>Navigasi</h6>
                <ul>
                    <li><a href="#fitur"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i>Fitur</a></li>
                    <li><a href="#cara"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i>Cara Pakai</a></li>
                    <li><a href="#layanan"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i>Layanan</a></li>
                    <li><a href="{{ route('login') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i>Masuk</a></li>
                    <li><a href="{{ route('register') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i>Daftar</a></li>
                </ul>
            </div>

            {{-- Layanan --}}
            <div class="col-6 col-lg-2">
                <h6>Layanan</h6>
                <ul>
                    <li><a href="{{ route('register') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i>Surat Domisili</a></li>
                    <li><a href="{{ route('register') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i>Surat Tidak Mampu</a></li>
                    <li><a href="{{ route('register') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i>Surat Usaha</a></li>
                    <li><a href="{{ route('register') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i>Pengantar SKCK</a></li>
                    <li><a href="{{ route('register') }}"><i class="bi bi-chevron-right me-1" style="font-size:.7rem;"></i>Surat Lainnya</a></li>
                </ul>
            </div>

            {{-- Kontak --}}
            <div class="col-lg-4">
                <h6>Kontak &amp; Alamat</h6>
                <div class="footer-contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Desa Pagendisan, Kecamatan Winong, Kabupaten Pati, Jawa Tengah 59183</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-clock-fill"></i>
                    <span>Senin – Jumat: 08.00 – 16.00 WIB</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <span>Hubungi Kantor Desa</span>
                </div>
                <div class="footer-contact-item">
                    <i class="bi bi-envelope-fill"></i>
                    <span>desa.pagendisan@gmail.com</span>
                </div>
            </div>

        </div>
        <hr class="footer-divider">
        <div class="footer-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
            <span>© {{ date('Y') }} Desa Pagendisan — Sistem Pelayanan Administrasi Digital</span>
            <span>Kecamatan Winong, Kabupaten Pati, Jawa Tengah</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* ── Navbar scroll effect ── */
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 30);
    });

    /* ── Scroll-reveal ── */
    const revealObs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.12 });
    document.querySelectorAll('.fade-up').forEach(el => revealObs.observe(el));

    /* ── Animated counter ── */
    const counterEls = document.querySelectorAll('[data-count]');
    const countObs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const target = +el.dataset.count;
            const suffix = target >= 1000 ? '+' : '';
            let current = 0;
            const step = Math.max(1, Math.ceil(target / 60));
            const timer = setInterval(() => {
                current = Math.min(current + step, target);
                el.textContent = current.toLocaleString('id-ID') + suffix;
                if (current >= target) clearInterval(timer);
            }, 20);
            countObs.unobserve(el);
        });
    }, { threshold: 0.5 });
    counterEls.forEach(el => countObs.observe(el));
</script>
</body>
</html>
