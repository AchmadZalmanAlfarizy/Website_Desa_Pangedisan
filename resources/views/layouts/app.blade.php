<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Administrasi Desa Pagendisan')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --primary-dark: #1e3a8a;
            --secondary: #059669;
            --accent: #f59e0b;
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --topbar-height: 64px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        /* ── Sidebar ─────────────────────────────────────────────── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            z-index: 1000;
            overflow-y: auto;
            transition: transform .3s ease;
        }

        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-brand h5 {
            color: #fff;
            font-weight: 700;
            font-size: .95rem;
            margin: 0;
            line-height: 1.4;
        }
        .sidebar-brand span {
            color: #94a3b8;
            font-size: .72rem;
        }

        .sidebar-nav { padding: .75rem 0; }
        .nav-section-title {
            color: #475569;
            font-size: .65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            padding: 1rem 1.5rem .4rem;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .6rem 1.5rem;
            color: #94a3b8;
            font-size: .875rem;
            font-weight: 500;
            border-radius: 0;
            transition: all .2s;
            position: relative;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,.06);
        }
        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 4px; bottom: 4px;
            width: 3px;
            background: var(--primary-light);
            border-radius: 0 3px 3px 0;
        }
        .sidebar .nav-link i { font-size: 1.1rem; width: 22px; }

        /* ── Topbar ───────────────────────────────────────────────── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            z-index: 999;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            gap: 1rem;
        }

        /* ── Main Content ─────────────────────────────────────────── */
        .main-content {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            min-height: 100vh;
        }
        .content-area {
            padding: 1.75rem 2rem;
        }

        /* ── Cards ────────────────────────────────────────────────── */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
        }
        .card-header {
            background: transparent;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.1rem 1.5rem;
            font-weight: 600;
        }

        /* ── Stat Cards ───────────────────────────────────────────── */
        .stat-card {
            border-radius: 12px;
            padding: 1.4rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            right: -20px; top: -20px;
            width: 100px; height: 100px;
            background: rgba(255,255,255,.1);
            border-radius: 50%;
        }
        .stat-card .stat-icon {
            font-size: 2rem;
            opacity: .85;
        }
        .stat-card .stat-number {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
        }
        .stat-card .stat-label {
            font-size: .8rem;
            opacity: .85;
            font-weight: 500;
        }

        .bg-primary-gradient { background: linear-gradient(135deg, #1e40af, #3b82f6); }
        .bg-success-gradient  { background: linear-gradient(135deg, #059669, #34d399); }
        .bg-warning-gradient  { background: linear-gradient(135deg, #d97706, #fbbf24); }
        .bg-danger-gradient   { background: linear-gradient(135deg, #dc2626, #f87171); }
        .bg-info-gradient     { background: linear-gradient(135deg, #0284c7, #38bdf8); }
        .bg-purple-gradient   { background: linear-gradient(135deg, #7c3aed, #a78bfa); }

        /* ── Badge ────────────────────────────────────────────────── */
        .badge { font-weight: 500; padding: .35em .7em; border-radius: 6px; }

        /* ── Buttons ──────────────────────────────────────────────── */
        .btn { border-radius: 8px; font-weight: 500; font-size: .875rem; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }

        /* ── Table ────────────────────────────────────────────────── */
        .table { font-size: .875rem; }
        .table thead th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            font-size: .72rem;
            letter-spacing: .04em;
        }
        .table-hover tbody tr:hover { background: #f8fafc; }

        /* ── Form ─────────────────────────────────────────────────── */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1.5px solid #e2e8f0;
            font-size: .875rem;
            padding: .55rem .875rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(59,130,246,.15);
        }
        .form-label { font-size: .875rem; font-weight: 500; color: #374151; margin-bottom: .4rem; }

        /* ── Alert / Flash ────────────────────────────────────────── */
        .alert { border-radius: 10px; border: none; font-size: .875rem; }

        /* ── Page Header ──────────────────────────────────────────── */
        .page-header {
            margin-bottom: 1.5rem;
        }
        .page-header h4 {
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }
        .page-header .breadcrumb { margin: 0; font-size: .8rem; }
        .page-header .breadcrumb-item + .breadcrumb-item::before { color: #94a3b8; }

        /* ── Responsive ───────────────────────────────────────────── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .topbar { left: 0; }
            .main-content { margin-left: 0; }
            .content-area { padding: 1rem; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="d-flex align-items-center gap-2 mb-1">
            <div style="width:36px;height:36px;background:var(--primary-light);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-building text-white" style="font-size:1.1rem;"></i>
            </div>
            <div>
                <h5>Desa Pagendisan</h5>
                <span>Kec. Winong, Kab. Pati</span>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        @if(auth()->user()->isAdmin())
            <div class="nav-section-title">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="nav-section-title">Data Master</div>
            <a href="{{ route('admin.penduduk.index') }}" class="nav-link {{ request()->routeIs('admin.penduduk*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Data Penduduk
            </a>
            <a href="{{ route('admin.jenis-surat.index') }}" class="nav-link {{ request()->routeIs('admin.jenis-surat*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Jenis Surat
            </a>

            <div class="nav-section-title">Pelayanan</div>
            <a href="{{ route('admin.pengajuan.index') }}" class="nav-link {{ request()->routeIs('admin.pengajuan*') ? 'active' : '' }}">
                <i class="bi bi-inbox"></i> Pengajuan
                @php $pending = \App\Models\Pengajuan::where('status','pending')->count(); @endphp
                @if($pending > 0)
                    <span class="badge bg-danger ms-auto">{{ $pending }}</span>
                @endif
            </a>
            <a href="{{ route('admin.arsip.index') }}" class="nav-link {{ request()->routeIs('admin.arsip*') ? 'active' : '' }}">
                <i class="bi bi-archive"></i> Arsip Dokumen
            </a>

            <div class="nav-section-title">Pengaturan</div>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i> Manajemen User
            </a>
        @else
            <div class="nav-section-title">Menu</div>
            <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('user.pengajuan.create') }}" class="nav-link {{ request()->routeIs('user.pengajuan.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i> Ajukan Surat
            </a>
            <a href="{{ route('user.pengajuan.index') }}" class="nav-link {{ request()->routeIs('user.pengajuan*') ? 'active' : '' }}">
                <i class="bi bi-list-ul"></i> Pengajuan Saya
            </a>
            <a href="{{ route('user.profile') }}" class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Profil Saya
            </a>
        @endif

        <div class="mt-3 px-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>
</aside>

{{-- Topbar --}}
<div class="topbar">
    <button class="btn btn-sm btn-light d-md-none" id="sidebarToggle">
        <i class="bi bi-list fs-5"></i>
    </button>
    <div class="ms-auto d-flex align-items-center gap-3">
        <div class="d-none d-md-flex align-items-center gap-2 text-muted" style="font-size:.8rem;">
            <i class="bi bi-calendar3"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
        <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                <div style="width:28px;height:28px;background:var(--primary);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                    <i class="bi bi-person-fill text-white" style="font-size:.75rem;"></i>
                </div>
                <span class="d-none d-md-inline" style="font-size:.875rem;font-weight:500;">{{ auth()->user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><h6 class="dropdown-header">{{ auth()->user()->email }}</h6></li>
                <li><span class="dropdown-item-text"><span class="badge bg-primary">{{ ucfirst(auth()->user()->role) }}</span></span></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- Main Content --}}
<main class="main-content">
    <div class="content-area">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill flex-shrink-0"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });

    // Auto-dismiss alerts after 4s
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            bootstrap.Alert.getOrCreateInstance(el)?.close();
        });
    }, 4000);
</script>
@stack('scripts')
</body>
</html>
