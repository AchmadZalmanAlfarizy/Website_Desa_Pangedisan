<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Administrasi Desa Pagendisan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary:        #15803d;
            --primary-light:  #22c55e;
            --primary-dark:   #14532d;
            --secondary:      #0891b2;
            --accent:         #f59e0b;
            --sidebar-width:  260px;
            --sidebar-bg:     #0d1f0f;
            --topbar-height:  64px;
            --bg-body:        #f0fdf4;
        }
        * { box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-body); color: #1e293b; }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* ════════════════════════════════════════════
           SIDEBAR
        ════════════════════════════════════════════ */
        .sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-width); height: 100vh;
            background: var(--sidebar-bg);
            z-index: 1000; overflow-y: auto;
            transition: transform .3s ease;
            display: flex; flex-direction: column;
        }
        .sidebar::-webkit-scrollbar { width: 3px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); }

        /* Brand */
        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.07);
            flex-shrink: 0;
        }
        .sidebar-brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.05rem; color: #fff; flex-shrink: 0;
        }
        .sidebar-brand h5 { color: #fff; font-weight: 800; font-size: .92rem; margin: 0; line-height: 1.3; }
        .sidebar-brand span { color: #6b7280; font-size: .68rem; }

        /* Nav */
        .sidebar-nav { padding: .75rem 0; flex: 1; }
        .nav-section-title {
            color: #4b5563; font-size: .62rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .09em;
            padding: 1rem 1.5rem .35rem;
        }
        .sidebar .nav-link {
            display: flex; align-items: center; gap: .75rem;
            padding: .58rem 1.5rem; color: #9ca3af;
            font-size: .855rem; font-weight: 500;
            border-radius: 0; text-decoration: none;
            transition: all .2s; position: relative;
        }
        .sidebar .nav-link i { font-size: 1rem; width: 20px; flex-shrink: 0; }
        .sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,.05); }
        .sidebar .nav-link.active { color: #fff; background: rgba(34,197,94,.12); }
        .sidebar .nav-link.active::before {
            content: ''; position: absolute; left: 0; top: 6px; bottom: 6px;
            width: 3px; background: var(--primary-light); border-radius: 0 4px 4px 0;
        }
        .sidebar .nav-link .badge { font-size: .65rem; padding: .2em .55em; }

        /* Sidebar footer / logout */
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,.07);
            flex-shrink: 0;
        }
        .btn-logout {
            display: flex; align-items: center; gap: .6rem; width: 100%;
            padding: .6rem 1rem; border-radius: 10px;
            background: rgba(239,68,68,.08); border: 1px solid rgba(239,68,68,.15);
            color: #f87171; font-size: .84rem; font-weight: 600;
            cursor: pointer; transition: all .2s;
        }
        .btn-logout:hover { background: rgba(239,68,68,.15); color: #ef4444; }

        /* ════════════════════════════════════════════
           TOPBAR
        ════════════════════════════════════════════ */
        .topbar {
            position: fixed; top: 0;
            left: var(--sidebar-width); right: 0;
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid #e7f3ec;
            z-index: 999;
            display: flex; align-items: center;
            padding: 0 1.75rem; gap: 1rem;
            box-shadow: 0 1px 0 rgba(0,0,0,.04);
        }
        .topbar-search {
            position: relative; flex: 1; max-width: 320px;
        }
        .topbar-search i {
            position: absolute; left: .85rem; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: .9rem;
        }
        .topbar-search input {
            width: 100%; padding: .5rem .9rem .5rem 2.4rem;
            border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: .83rem; background: #f8fafc; outline: none;
            font-family: inherit; transition: all .2s;
        }
        .topbar-search input:focus { border-color: var(--primary); background: #fff; box-shadow: 0 0 0 3px rgba(21,128,61,.1); }
        .topbar-search input::placeholder { color: #94a3b8; }

        .topbar-date {
            display: flex; align-items: center; gap: .45rem;
            color: #94a3b8; font-size: .78rem; font-weight: 500;
        }
        .topbar-date i { color: var(--primary-light); }

        .user-pill {
            display: flex; align-items: center; gap: .6rem;
            padding: .4rem .9rem .4rem .4rem;
            background: #f8fafc; border: 1.5px solid #e2e8f0;
            border-radius: 100px; cursor: pointer; transition: all .2s;
            text-decoration: none;
        }
        .user-pill:hover { border-color: var(--primary-light); background: #f0fdf4; }
        .user-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: .75rem; font-weight: 700; flex-shrink: 0;
        }
        .user-pill-name { font-size: .83rem; font-weight: 600; color: #1e293b; }
        .user-pill-role { font-size: .7rem; color: #94a3b8; }

        /* ════════════════════════════════════════════
           MAIN CONTENT
        ════════════════════════════════════════════ */
        .main-content { margin-left: var(--sidebar-width); padding-top: var(--topbar-height); min-height: 100vh; }
        .content-area { padding: 1.75rem 2rem; }

        /* ════════════════════════════════════════════
           PAGE HEADER
        ════════════════════════════════════════════ */
        .page-header { margin-bottom: 1.5rem; }
        .page-header h4 { font-weight: 800; color: #0f172a; margin: 0; font-size: 1.25rem; }
        .page-header .breadcrumb { margin: .25rem 0 0; font-size: .78rem; }
        .breadcrumb-item + .breadcrumb-item::before { color: #94a3b8; }
        .breadcrumb-item a { color: var(--primary); text-decoration: none; }

        /* ════════════════════════════════════════════
           CARDS
        ════════════════════════════════════════════ */
        .card {
            border: none; border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,.05), 0 1px 2px rgba(0,0,0,.04);
            background: #fff;
        }
        .card-header {
            background: transparent; border-bottom: 1px solid #f1f5f9;
            padding: 1.1rem 1.5rem; font-weight: 700; font-size: .9rem;
            display: flex; align-items: center;
        }
        .card-header i { color: var(--primary); }

        /* ── Stat Cards ── */
        .stat-card {
            border-radius: 14px; padding: 1.4rem; color: #fff;
            position: relative; overflow: hidden;
        }
        .stat-card::before {
            content: ''; position: absolute; right: -24px; top: -24px;
            width: 100px; height: 100px;
            background: rgba(255,255,255,.12); border-radius: 50%;
        }
        .stat-card::after {
            content: ''; position: absolute; right: 10px; bottom: -30px;
            width: 80px; height: 80px;
            background: rgba(255,255,255,.07); border-radius: 50%;
        }
        .stat-number { font-size: 2rem; font-weight: 800; line-height: 1; position: relative; z-index: 1; }
        .stat-label  { font-size: .78rem; font-weight: 500; opacity: .85; margin-top: .3rem; position: relative; z-index: 1; }
        .stat-icon   { font-size: 1.85rem; opacity: .8; position: relative; z-index: 1; }
        .stat-sub    { font-size: .72rem; opacity: .75; margin-top: .5rem; position: relative; z-index: 1; }

        .bg-primary-gradient { background: linear-gradient(135deg, #15803d, #22c55e); }
        .bg-success-gradient  { background: linear-gradient(135deg, #059669, #34d399); }
        .bg-warning-gradient  { background: linear-gradient(135deg, #d97706, #fbbf24); }
        .bg-danger-gradient   { background: linear-gradient(135deg, #dc2626, #f87171); }
        .bg-info-gradient     { background: linear-gradient(135deg, #0284c7, #38bdf8); }
        .bg-purple-gradient   { background: linear-gradient(135deg, #7c3aed, #a78bfa); }
        .bg-teal-gradient     { background: linear-gradient(135deg, #0d9488, #2dd4bf); }

        /* ════════════════════════════════════════════
           TABLE
        ════════════════════════════════════════════ */
        .table { font-size: .875rem; }
        .table thead th {
            background: #f8fafc; border-bottom: 2px solid #e2e8f0;
            font-weight: 700; color: #475569;
            text-transform: uppercase; font-size: .7rem; letter-spacing: .05em;
            padding: .85rem 1rem; white-space: nowrap;
        }
        .table tbody td { padding: .85rem 1rem; vertical-align: middle; border-color: #f1f5f9; }
        .table-hover tbody tr { transition: background .15s; }
        .table-hover tbody tr:hover { background: #f0fdf4; }

        /* ════════════════════════════════════════════
           FORMS
        ════════════════════════════════════════════ */
        .form-control, .form-select {
            border-radius: 10px; border: 1.5px solid #e2e8f0;
            font-size: .875rem; padding: .58rem .875rem; font-family: inherit;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(21,128,61,.12);
        }
        .form-label { font-size: .875rem; font-weight: 600; color: #374151; margin-bottom: .4rem; }
        .input-group-text { background: #f8fafc; border-color: #e2e8f0; color: #94a3b8; }

        /* ════════════════════════════════════════════
           BUTTONS
        ════════════════════════════════════════════ */
        .btn { border-radius: 9px; font-weight: 600; font-size: .875rem; }
        .btn-primary   { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-success   { background: #059669; border-color: #059669; }
        .btn-success:hover { background: #047857; border-color: #047857; }
        .btn-sm { font-size: .8rem; padding: .3rem .7rem; border-radius: 7px; }

        /* ════════════════════════════════════════════
           BADGE
        ════════════════════════════════════════════ */
        .badge { font-weight: 600; padding: .35em .72em; border-radius: 7px; font-size: .72rem; }

        /* ════════════════════════════════════════════
           ALERT / FLASH
        ════════════════════════════════════════════ */
        .alert { border-radius: 12px; border: none; font-size: .875rem; }
        .alert-success {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            color: #14532d; border-left: 4px solid var(--primary-light) !important;
        }
        .alert-danger  {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            color: #7f1d1d; border-left: 4px solid #f87171 !important;
        }

        /* ════════════════════════════════════════════
           RESPONSIVE
        ════════════════════════════════════════════ */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .topbar { left: 0; padding: 0 1rem; }
            .main-content { margin-left: 0; }
            .content-area { padding: 1rem; }
            .topbar-search, .topbar-date { display: none !important; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- ══════ SIDEBAR ══════ --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="d-flex align-items-center gap-2">
            <div class="sidebar-brand-icon"><i class="bi bi-tree-fill"></i></div>
            <div>
                <h5>Desa Pagendisan</h5>
                <span>Kec. Winong, Kab. Pati</span>
            </div>
        </div>
    </div>

    <nav class="sidebar-nav">
        @if(auth()->user()->isAdmin())
            <div class="nav-section-title">Main</div>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="nav-section-title">Data Master</div>
            <a href="{{ route('admin.penduduk.index') }}"
               class="nav-link {{ request()->routeIs('admin.penduduk*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Data Penduduk
            </a>
            <a href="{{ route('admin.jenis-surat.index') }}"
               class="nav-link {{ request()->routeIs('admin.jenis-surat*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Jenis Surat
            </a>

            <div class="nav-section-title">Pelayanan</div>
            <a href="{{ route('admin.pengajuan.index') }}"
               class="nav-link {{ request()->routeIs('admin.pengajuan*') ? 'active' : '' }}">
                <i class="bi bi-inbox"></i> Pengajuan
                @php $pending = \App\Models\Pengajuan::where('status','pending')->count(); @endphp
                @if($pending > 0)
                    <span class="badge bg-danger ms-auto">{{ $pending }}</span>
                @endif
            </a>
            <a href="{{ route('admin.arsip.index') }}"
               class="nav-link {{ request()->routeIs('admin.arsip*') ? 'active' : '' }}">
                <i class="bi bi-archive"></i> Arsip Dokumen
            </a>

            <div class="nav-section-title">Pengaturan</div>
            <a href="{{ route('admin.users.index') }}"
               class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i> Manajemen User
            </a>
        @else
            <div class="nav-section-title">Menu</div>
            <a href="{{ route('user.dashboard') }}"
               class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-fill"></i> Dashboard
            </a>
            <a href="{{ route('user.pengajuan.create') }}"
               class="nav-link {{ request()->routeIs('user.pengajuan.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i> Ajukan Surat
            </a>
            <a href="{{ route('user.pengajuan.index') }}"
               class="nav-link {{ request()->routeIs('user.pengajuan.index') || (request()->routeIs('user.pengajuan*') && !request()->routeIs('user.pengajuan.create')) ? 'active' : '' }}">
                <i class="bi bi-list-ul"></i> Pengajuan Saya
            </a>
            <a href="{{ route('user.profile') }}"
               class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Profil Saya
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- ══════ TOPBAR ══════ --}}
<div class="topbar">
    <button class="btn btn-sm btn-light d-md-none border-0 me-1 p-1" id="sidebarToggle" style="background:transparent;">
        <i class="bi bi-list" style="font-size:1.35rem;color:#374151;"></i>
    </button>

    <div class="topbar-search d-none d-lg-block">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Cari...">
    </div>

    <div class="ms-auto d-flex align-items-center gap-3">
        <div class="topbar-date d-none d-md-flex">
            <i class="bi bi-calendar3"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>

        <div class="dropdown">
            <a class="user-pill dropdown-toggle" href="#" data-bs-toggle="dropdown" style="text-decoration:none;">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="d-none d-md-block">
                    <div class="user-pill-name">{{ auth()->user()->name }}</div>
                    <div class="user-pill-role">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
                <i class="bi bi-chevron-down d-none d-md-block" style="font-size:.65rem;color:#94a3b8;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" style="border:none;border-radius:12px;min-width:200px;padding:.5rem;">
                <li>
                    <div class="px-3 py-2">
                        <div style="font-weight:700;font-size:.875rem;color:#0f172a;">{{ auth()->user()->name }}</div>
                        <div style="font-size:.75rem;color:#94a3b8;">{{ auth()->user()->email }}</div>
                        <span class="badge mt-1" style="background:#dcfce7;color:#15803d;">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                </li>
                <li><hr class="dropdown-divider my-1" style="border-color:#f1f5f9;"></li>
                @if(!auth()->user()->isAdmin())
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('user.profile') }}"
                       style="border-radius:8px;font-size:.875rem;">
                        <i class="bi bi-person-circle text-muted"></i>Profil Saya
                    </a>
                </li>
                <li><hr class="dropdown-divider my-1" style="border-color:#f1f5f9;"></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-danger"
                                style="border-radius:8px;font-size:.875rem;">
                            <i class="bi bi-box-arrow-right"></i>Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- ══════ MAIN CONTENT ══════ --}}
<main class="main-content">
    <div class="content-area">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-check-circle-fill flex-shrink-0" style="color:#15803d;"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0" style="color:#ef4444;"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
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
    // Close sidebar on overlay click (mobile)
    document.addEventListener('click', (e) => {
        const sb = document.getElementById('sidebar');
        const btn = document.getElementById('sidebarToggle');
        if (window.innerWidth < 768 && sb.classList.contains('show') &&
            !sb.contains(e.target) && e.target !== btn && !btn?.contains(e.target)) {
            sb.classList.remove('show');
        }
    });
    // Auto-dismiss alerts
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            bootstrap.Alert.getOrCreateInstance(el)?.close();
        });
    }, 4500);
</script>
@stack('scripts')
</body>
</html>

