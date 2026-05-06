{{--
    Partial: partials/navbar.blade.php  [VERSI UPDATE — tambah menu client]
    GANTI file resources/views/partials/navbar.blade.php dengan ini
--}}

<nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
    <div class="container">

        {{-- Brand / Logo --}}
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <div class="brand-icon">
                <i class="bi bi-house-heart-fill"></i>
            </div>
            <span class="brand-text">La<span class="brand-accent">Kost</span></span>
        </a>

        {{-- Toggle Button (Mobile) --}}
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="bi bi-list fs-4"></i>
        </button>

        {{-- Nav Links --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        <i class="bi bi-house me-1"></i>Beranda
                    </a>
                </li>

                {{-- ★ MENU BARU: Cari Kos ★ --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('client.kos*') ? 'active' : '' }}"
                       href="{{ route('client.kos') }}">
                        <i class="bi bi-building me-1"></i>Cari Kos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                       href="{{ route('about') }}">
                        <i class="bi bi-info-circle me-1"></i>Tentang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team') ? 'active' : '' }}"
                       href="{{ route('team') }}">
                        <i class="bi bi-people me-1"></i>Tim Kami
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                       href="{{ route('contact') }}">
                        <i class="bi bi-envelope me-1"></i>Kontak
                    </a>
                </li>
            </ul>

            {{-- CTA Buttons --}}
            <div class="d-flex align-items-center gap-2">
                @auth
                    {{-- ★ MENU BARU: Booking Saya (untuk user login) ★ --}}
                    <a href="{{ route('client.my-bookings') }}"
                       class="btn btn-sm btn-outline-secondary px-3 {{ request()->routeIs('client.my-bookings') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check me-1"></i>Booking Saya
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm px-3">
                        <i class="bi bi-speedometer2 me-1"></i>Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger px-3">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-login px-4">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>
                    <a href="{{ route('client.kos') }}" class="btn btn-primary btn-install px-4">
                        <i class="bi bi-search me-2"></i>Cari Kos
                    </a>
                @endauth
            </div>
        </div>

    </div>
</nav>

<style>
    /* =============================================
       Navbar Styles
       ============================================= */
    #mainNavbar {
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--kf-border);
        padding: 14px 0;
        transition: all 0.3s ease;
    }

    .brand-icon {
        width: 38px; height: 38px;
        background: var(--kf-primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
    }
    .brand-text {
        font-family: 'DM Serif Display', serif;
        font-size: 1.4rem;
        color: var(--kf-dark);
        line-height: 1;
    }
    .brand-accent { color: var(--kf-primary); }

    .navbar-nav .nav-link {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 500;
        font-size: 0.9rem;
        color: var(--kf-gray);
        padding: 8px 14px;
        border-radius: 8px;
        transition: all 0.25s ease;
    }
    .navbar-nav .nav-link:hover {
        color: var(--kf-primary);
        background: rgba(26, 86, 219, 0.06);
    }
    .navbar-nav .nav-link.active {
        color: var(--kf-primary);
        background: rgba(26, 86, 219, 0.10);
        font-weight: 600;
    }

    .btn-login {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        border-radius: 10px;
        padding: 10px 20px;
        border: 1.5px solid var(--kf-primary);
        color: var(--kf-primary);
        transition: all 0.3s ease;
    }
    .btn-login:hover {
        background: rgba(26, 86, 219, 0.06);
        transform: translateY(-1px);
    }

    .btn-install {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        border-radius: 10px;
        padding: 10px 24px;
        background: var(--kf-primary);
        border-color: var(--kf-primary);
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(26, 86, 219, 0.25);
    }
    .btn-install:hover {
        background: var(--kf-primary-dark, #1447C0);
        border-color: var(--kf-primary-dark, #1447C0);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(26, 86, 219, 0.35);
    }

    .navbar-toggler {
        border: 1.5px solid var(--kf-border);
        border-radius: 8px;
        padding: 6px 10px;
        color: var(--kf-dark);
    }
    .navbar-toggler:focus { box-shadow: none; }

    #mainNavbar.scrolled {
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        padding: 10px 0;
    }

    @media (max-width: 991px) {
        .navbar-collapse {
            border-top: 1px solid var(--kf-border);
            margin-top: 12px;
            padding-top: 12px;
        }
        .navbar-nav { gap: 2px !important; }
        .d-flex.align-items-center.gap-2 {
            margin-top: 12px;
            padding-bottom: 8px;
            flex-wrap: wrap;
        }
        .btn-install, .btn-login {
            flex: 1;
            justify-content: center;
            display: flex;
            text-align: center;
        }
    }
</style>

<script>
    window.addEventListener('scroll', function () {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 40) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>