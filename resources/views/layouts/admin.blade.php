<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | LaKost Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --kf-primary:      #1A56DB;
            --kf-primary-dark: #1447C0;
            --kf-dark:         #0F172A;
            --kf-gray:         #64748B;
            --kf-light:        #F8FAFC;
            --kf-border:       #E2E8F0;
            --sidebar-w:       260px;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #F1F5F9;
            color: var(--kf-dark);
            margin: 0;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--kf-dark);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        .sidebar-brand {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .sidebar-brand-icon {
            width: 38px; height: 38px;
            background: var(--kf-primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 1.1rem; flex-shrink: 0;
        }
        .sidebar-brand-text {
            font-size: 1.3rem;
            font-weight: 800;
            color: white;
        }
        .sidebar-brand-text span { color: #60A5FA; }

        .sidebar-nav { flex: 1; padding: 16px 0; overflow-y: auto; }
        .nav-section-title {
            padding: 8px 24px 4px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.3);
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 24px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            margin: 1px 0;
        }
        .sidebar-link i { font-size: 1rem; width: 20px; text-align: center; }
        .sidebar-link:hover {
            background: rgba(255,255,255,0.06);
            color: white;
        }
        .sidebar-link.active {
            background: rgba(26,86,219,0.2);
            color: #60A5FA;
            border-left-color: #60A5FA;
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 16px 24px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }
        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 10px;
            background: var(--kf-primary);
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 0.85rem; font-weight: 700;
            flex-shrink: 0;
        }
        .user-name  { font-size: 0.85rem; font-weight: 600; color: white; }
        .user-email { font-size: 0.72rem; color: rgba(255,255,255,0.4); }

        /* ── Main Content ── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            background: white;
            border-bottom: 1px solid var(--kf-border);
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }
        .topbar-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--kf-dark);
        }
        .content-area { padding: 28px; flex: 1; }

        /* ── Cards & Tables ── */
        .admin-card {
            background: white;
            border-radius: 14px;
            border: 1px solid var(--kf-border);
            overflow: hidden;
        }
        .admin-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--kf-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .admin-card-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--kf-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .admin-card-body { padding: 24px; }

        .table th {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--kf-gray);
            background: #F8FAFC;
            border-bottom: 2px solid var(--kf-border);
            padding: 12px 16px;
            white-space: nowrap;
        }
        .table td {
            padding: 12px 16px;
            font-size: 0.88rem;
            vertical-align: middle;
            border-bottom: 1px solid #F1F5F9;
        }
        .table tbody tr:last-child td { border-bottom: none; }
        .table tbody tr:hover { background: #F8FAFC; }

        .badge-status {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-lunas   { background: rgba(16,185,129,0.1); color: #059669; }
        .badge-pending { background: rgba(245,158,11,0.1);  color: #D97706; }

        /* ── Form ── */
        .form-label { font-weight: 600; font-size: 0.875rem; }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1.5px solid var(--kf-border);
            padding: 10px 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--kf-primary);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
        }
        .btn {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            border-radius: 8px;
        }
        .btn-primary { background: var(--kf-primary); border-color: var(--kf-primary); }
        .btn-primary:hover { background: var(--kf-primary-dark); }

        /* Stat card */
        .stat-card {
            background: white;
            border-radius: 14px;
            border: 1px solid var(--kf-border);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; flex-shrink: 0;
        }
        .stat-number { font-size: 1.8rem; font-weight: 800; line-height: 1; }
        .stat-label  { font-size: 0.82rem; color: var(--kf-gray); margin-top: 2px; }

        /* Mobile */
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
        }

        /* Alert */
        .alert { border-radius: 10px; font-size: 0.9rem; }

        /* Breadcrumb */
        .breadcrumb { font-size: 0.82rem; }
        .breadcrumb-item.active { color: var(--kf-gray); }
    </style>
    @stack('styles')
</head>
<body>

{{-- ═══════════════════════ SIDEBAR ═══════════════════════ --}}
<aside class="sidebar" id="sidebar">

    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand-icon"><i class="bi bi-house-heart-fill"></i></div>
        <span class="sidebar-brand-text">La<span>Kost</span></span>
    </a>

    {{-- Navigation --}}
    <nav class="sidebar-nav">
        <div class="nav-section-title">Menu Utama</div>

        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section-title mt-2">Master Data</div>

        <a href="{{ route('kos.index') }}"
           class="sidebar-link {{ request()->routeIs('kos.*') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Kelola Kos
        </a>

        <a href="{{ route('galeri.index') }}"
           class="sidebar-link {{ request()->routeIs('galeri.*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Galeri Foto
        </a>

        <div class="nav-section-title mt-2">Transaksi</div>

        <a href="{{ route('booking.index') }}"
           class="sidebar-link {{ request()->routeIs('booking.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-check"></i> Booking
        </a>

        <a href="{{ route('pembayaran.index') }}"
           class="sidebar-link {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
            <i class="bi bi-credit-card"></i> Pembayaran
        </a>

        <div class="nav-section-title mt-2">Lainnya</div>

        <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <i class="bi bi-globe"></i> Lihat Website
        </a>
    </nav>

    {{-- User Info + Logout --}}
    <div class="sidebar-footer">
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-email">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm w-100"
                    style="background:rgba(239,68,68,0.1);color:#EF4444;border:1px solid rgba(239,68,68,0.2);">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>
        </form>
    </div>

</aside>

{{-- ═══════════════════════ MAIN CONTENT ═══════════════════════ --}}
<div class="main-wrapper">

    {{-- Topbar --}}
    <header class="topbar">
        <div class="d-flex align-items-center gap-3">
            {{-- Mobile toggle --}}
            <button class="btn btn-sm d-lg-none" id="sidebarToggle" style="border:1px solid var(--kf-border);">
                <i class="bi bi-list fs-5"></i>
            </button>
            <div>
                <div class="topbar-title">@yield('title', 'Dashboard')</div>
                @hasSection('breadcrumb')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        @yield('breadcrumb')
                    </ol>
                </nav>
                @endif
            </div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="badge rounded-pill"
                  style="background:rgba(26,86,219,0.1);color:var(--kf-primary);font-size:0.78rem;padding:6px 12px;">
                <i class="bi bi-person-check me-1"></i>{{ Auth::user()->name }}
            </span>
        </div>
    </header>

    {{-- Content --}}
    <main class="content-area">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-info-circle-fill me-2"></i>{{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

</div>

{{-- Sidebar overlay (mobile) --}}
<div class="d-lg-none" id="sidebarOverlay"
     style="display:none!important;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:999;"
     onclick="closeSidebar()"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebar  = document.getElementById('sidebar');
    const overlay  = document.getElementById('sidebarOverlay');

    document.getElementById('sidebarToggle').addEventListener('click', () => {
        sidebar.classList.add('open');
        overlay.style.setProperty('display', 'block', 'important');
    });

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.style.setProperty('display', 'none', 'important');
    }
</script>
@stack('scripts')
</body>
</html>