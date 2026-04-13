{{-- 
    Partial: partials/navbar.blade.php
    Navbar utama LaKost - responsif dengan active state otomatis
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

                @if(Route::has('home'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">
                        <i class="bi bi-house me-1"></i>Beranda
                    </a>
                </li>
                @endif

                @if(Route::has('about'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                       href="{{ route('about') }}">
                        <i class="bi bi-info-circle me-1"></i>Tentang
                    </a>
                </li>
                @endif

                @if(Route::has('team'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('team') ? 'active' : '' }}"
                       href="{{ route('team') }}">
                        <i class="bi bi-people me-1"></i>Tim Kami
                    </a>
                </li>
                @endif

                @if(Route::has('contact'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                       href="{{ route('contact') }}">
                        <i class="bi bi-envelope me-1"></i>Kontak
                    </a>
                </li>
                @endif

            </ul>

            {{-- CTA Buttons --}}
            <div class="d-flex align-items-center gap-2">
                @auth
                    {{-- Sudah login --}}
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
                    {{-- Belum login --}}
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-login px-4">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>

                    <a href="#" class="btn btn-primary btn-install px-4">
                        <i class="bi bi-download me-2"></i>Install Sekarang
                    </a>
                @endauth
            </div>
        </div>

    </div>
</nav>

<style>
    #mainNavbar {
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--kf-border);
        padding: 14px 0;
        transition: all 0.3s ease;
    }

    .brand-icon {
        width: 38px;
        height: 38px;
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
    }

    .brand-accent {
        color: var(--kf-primary);
    }

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
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 20px;
    }

    .btn-install {
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 24px;
    }

    #mainNavbar.scrolled {
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        padding: 10px 0;
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