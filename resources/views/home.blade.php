{{--
    View: home.blade.php
    Halaman beranda LaKost
--}}

@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<style>
    /* =============================================
       HOME PAGE STYLES
       ============================================= */

    /* ---- HERO ---- */
    .hero-section {
        background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 50%, #EFF6FF 100%);
        padding: 96px 0 80px;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: -100px; right: -100px;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(26,86,219,0.12) 0%, transparent 70%);
        pointer-events: none;
    }
    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -80px; left: -80px;
        width: 350px; height: 350px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(245,158,11,0.10) 0%, transparent 70%);
        pointer-events: none;
    }

    .hero-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        border: 1px solid var(--kf-border);
        border-radius: 50px;
        padding: 6px 16px;
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--kf-primary);
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 12px rgba(26,86,219,0.10);
    }
    .hero-label .dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: #10B981;
        animation: pulse-dot 2s infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }

    .hero-title {
        font-size: clamp(2.4rem, 5vw, 3.8rem);
        line-height: 1.15;
        color: var(--kf-dark);
        margin-bottom: 1.25rem;
    }

    .hero-desc {
        font-size: 1.05rem;
        color: var(--kf-gray);
        line-height: 1.7;
        max-width: 500px;
        margin-bottom: 2rem;
    }

    /* Search Bar */
    .hero-search {
        background: white;
        border-radius: 14px;
        padding: 8px 8px 8px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 8px 32px rgba(26,86,219,0.15);
        border: 1px solid var(--kf-border);
        max-width: 520px;
    }
    .hero-search input {
        border: none;
        outline: none;
        flex: 1;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        color: var(--kf-dark);
        background: transparent;
    }
    .hero-search input::placeholder { color: #94A3B8; }
    .hero-search .btn {
        flex-shrink: 0;
        border-radius: 10px;
        padding: 10px 24px;
    }

    /* Hero Stats */
    .hero-stats {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
        margin-top: 2rem;
    }
    .hero-stat-item .stat-num {
        display: block;
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--kf-dark);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .hero-stat-item .stat-label {
        font-size: 0.78rem;
        color: var(--kf-gray);
    }

    /* Hero Image Stack */
    .hero-img-stack {
        position: relative;
    }
    .hero-img-main {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(26,86,219,0.20);
        border: 4px solid white;
    }
    .hero-img-main img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .hero-img-main:hover img { transform: scale(1.04); }

    .hero-img-badge {
        position: absolute;
        bottom: -20px; left: -24px;
        background: white;
        border-radius: 16px;
        padding: 14px 20px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.13);
        border: 1px solid var(--kf-border);
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 200px;
    }
    .hero-img-float {
        position: absolute;
        top: -20px; right: -24px;
        background: var(--kf-accent);
        color: white;
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 0.8rem;
        font-weight: 700;
        box-shadow: 0 4px 16px rgba(245,158,11,0.4);
    }

    /* ---- FEATURES ---- */
    .feature-img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 16px;
        transition: transform 0.35s ease;
    }
    .kf-card:hover .feature-img { transform: scale(1.04); }
    .feature-img-wrap {
        overflow: hidden;
        border-radius: 12px;
        margin-bottom: 16px;
    }

    /* ---- HOW IT WORKS ---- */
    .hiw-section { padding: 80px 0; background: var(--kf-light); }

    .step-card {
        text-align: center;
        padding: 40px 24px;
        background: white;
        border-radius: var(--kf-radius);
        border: 1px solid var(--kf-border);
        transition: var(--kf-transition);
    }
    .step-card:hover {
        box-shadow: var(--kf-shadow-lg);
        transform: translateY(-4px);
    }
    .step-number {
        width: 64px; height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--kf-primary), #3B82F6);
        color: white;
        font-size: 1.4rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 4px 16px rgba(26,86,219,0.3);
    }

    /* =============================================
       PHONE MOCKUP SECTION
       ============================================= */
    .phone-mockup-section {
        padding: 100px 0;
        background: linear-gradient(160deg, #0F172A 0%, #1A2B4A 50%, #0F172A 100%);
        position: relative;
        overflow: hidden;
    }

    /* Decorative background circles */
    .phone-mockup-section::before {
        content: '';
        position: absolute;
        top: -120px; left: -120px;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(26,86,219,0.18) 0%, transparent 65%);
        pointer-events: none;
    }
    .phone-mockup-section::after {
        content: '';
        position: absolute;
        bottom: -100px; right: -100px;
        width: 450px; height: 450px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(245,158,11,0.12) 0%, transparent 65%);
        pointer-events: none;
    }

    /* Floating dots decoration */
    .mockup-dots {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image:
            radial-gradient(rgba(255,255,255,0.06) 1px, transparent 1px);
        background-size: 32px 32px;
        pointer-events: none;
    }

    /* Section badge on dark bg */
    .kf-badge-dark {
        display: inline-block;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        background: rgba(96,165,250,0.15);
        color: #60A5FA;
        border: 1px solid rgba(96,165,250,0.25);
        margin-bottom: 1rem;
    }

    /* Phone frame */
    .phone-frame {
        position: relative;
        width: 240px;
        margin: 0 auto;
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        filter: drop-shadow(0 24px 48px rgba(0,0,0,0.5));
    }
    .phone-frame:hover {
        transform: translateY(-14px) scale(1.03);
    }

    /* The phone body */
    .phone-body {
        background: linear-gradient(145deg, #1e293b, #0f172a);
        border-radius: 42px;
        padding: 14px;
        border: 2px solid rgba(255,255,255,0.12);
        position: relative;
        box-shadow:
            0 0 0 1px rgba(0,0,0,0.6),
            inset 0 1px 0 rgba(255,255,255,0.15),
            0 32px 64px rgba(0,0,0,0.6),
            0 8px 16px rgba(0,0,0,0.4);
    }

    /* Side buttons */
    .phone-body::before {
        content: '';
        position: absolute;
        right: -4px;
        top: 80px;
        width: 4px;
        height: 60px;
        background: linear-gradient(to bottom, #334155, #1e293b);
        border-radius: 0 3px 3px 0;
        box-shadow: 0 0 0 1px rgba(0,0,0,0.4);
    }
    .phone-body::after {
        content: '';
        position: absolute;
        left: -4px;
        top: 70px;
        width: 4px;
        height: 35px;
        background: linear-gradient(to bottom, #334155, #1e293b);
        border-radius: 3px 0 0 3px;
        box-shadow: 0 0 0 1px rgba(0,0,0,0.4);
    }

    /* Screen inner container */
    .phone-screen {
        border-radius: 30px;
        overflow: hidden;
        background: #fff;
        position: relative;
        aspect-ratio: 9/19;
    }

    /* Dynamic Island (notch) */
    .phone-notch {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 90px;
        height: 26px;
        background: #0f172a;
        border-radius: 20px;
        z-index: 10;
    }
    .phone-notch::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #1e293b;
        box-shadow: inset 0 0 4px rgba(26,86,219,0.3);
    }

    /* Screenshot inside phone */
    .phone-screenshot {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Phone label below */
    .phone-label {
        text-align: center;
        margin-top: 20px;
    }
    .phone-label-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 4px;
    }
    .phone-label-desc {
        font-size: 0.78rem;
        color: rgba(255,255,255,0.45);
    }

    /* Feature pill badges */
    .feature-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 50px;
        padding: 8px 16px;
        font-size: 0.83rem;
        color: rgba(255,255,255,0.75);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 500;
        transition: all 0.25s ease;
    }
    .feature-pill:hover {
        background: rgba(26,86,219,0.2);
        border-color: rgba(96,165,250,0.4);
        color: #60A5FA;
    }
    .feature-pill i {
        color: #60A5FA;
        font-size: 1rem;
    }

    /* Download buttons */
    .app-store-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        border-radius: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1.5px solid;
    }
    .app-store-btn.apple {
        background: white;
        color: #0F172A;
        border-color: white;
    }
    .app-store-btn.apple:hover {
        background: #f0f4ff;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(255,255,255,0.2);
    }
    .app-store-btn.google {
        background: rgba(255,255,255,0.06);
        color: rgba(255,255,255,0.9);
        border-color: rgba(255,255,255,0.2);
    }
    .app-store-btn.google:hover {
        background: rgba(255,255,255,0.12);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.2);
    }

    /* Rating badge */
    .app-rating {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(245,158,11,0.12);
        border: 1px solid rgba(245,158,11,0.25);
        border-radius: 50px;
        padding: 6px 14px;
        font-size: 0.82rem;
        color: #F59E0B;
        font-weight: 600;
    }

    /* Floating cards around phones */
    .mockup-float-card {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 14px;
        padding: 12px 16px;
        font-size: 0.8rem;
        color: rgba(255,255,255,0.85);
        position: absolute;
        z-index: 5;
        animation: float-card 4s ease-in-out infinite;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    @keyframes float-card {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    /* Responsive phone sizes */
    @media (max-width: 991px) {
        .phone-frame { width: 200px; }
    }
    @media (max-width: 575px) {
        .phone-frame { width: 180px; }
        .phone-mockup-section { padding: 70px 0; }
    }

    /* ---- TESTIMONIALS ---- */
    .testimonials-section { padding: 80px 0; }

    .testimonial-card {
        background: white;
        border-radius: var(--kf-radius);
        padding: 32px;
        border: 1px solid var(--kf-border);
        transition: var(--kf-transition);
        height: 100%;
    }
    .testimonial-card:hover {
        box-shadow: var(--kf-shadow-lg);
        transform: translateY(-4px);
    }
    .testimonial-stars { color: var(--kf-accent); font-size: 0.9rem; }
    .testimonial-avatar {
        width: 48px; height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        background: rgba(26,86,219,0.12);
        color: var(--kf-primary);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ---- CTA SECTION ---- */
    .cta-section {
        background: linear-gradient(135deg, var(--kf-primary) 0%, #1447C0 100%);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }
    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%; right: -10%;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
    }
</style>
@endpush

@section('content')

{{-- ============================================
     HERO SECTION
     ============================================ --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">

            {{-- Hero Text --}}
            <div class="col-lg-6">
                <div class="hero-label fade-in-up">
                    <span class="dot"></span>
                    Platform #1 Pencarian Kos di Indonesia
                </div>

                <h1 class="hero-title fade-in-up fade-in-up-1">
                    Temukan Kos <span class="text-primary">Impianmu</span> dengan <span class="text-primary">LaKost</span>
                </h1>

                <p class="hero-desc fade-in-up fade-in-up-2">
                    Lebih dari 12.000 pilihan kos terverifikasi di 45+ kota. Filter harga,
                    lokasi, dan fasilitas — temukan kos terbaikmu dalam hitungan menit.
                </p>

                {{-- Search Bar --}}
                <div class="hero-search fade-in-up fade-in-up-3">
                    <i class="bi bi-geo-alt text-primary fs-5"></i>
                    <input type="text" placeholder="Cari kos di Jakarta, Bandung, Surabaya...">
                    <a href="#" class="btn btn-primary">
                        <i class="bi bi-search me-1"></i>Cari
                    </a>
                </div>

                {{-- Quick Tags --}}
                <div class="d-flex flex-wrap gap-2 mt-3 fade-in-up fade-in-up-3">
                    <span class="text-muted small">Populer:</span>
                    @foreach(['Jakarta Selatan', 'Bandung', 'Jogja', 'Surabaya'] as $city)
                        <a href="#" class="badge rounded-pill border border-primary text-primary fw-normal px-3 py-2 text-decoration-none" style="font-size:0.8rem;">{{ $city }}</a>
                    @endforeach
                </div>

                {{-- Stats --}}
                <div class="hero-stats fade-in-up fade-in-up-4">
                    <div class="hero-stat-item">
                        <span class="stat-num">50K+</span>
                        <span class="stat-label">Pengguna Aktif</span>
                    </div>
                    <div style="width:1px; background:var(--kf-border);"></div>
                    <div class="hero-stat-item">
                        <span class="stat-num">12K+</span>
                        <span class="stat-label">Listing Kos</span>
                    </div>
                    <div style="width:1px; background:var(--kf-border);"></div>
                    <div class="hero-stat-item">
                        <span class="stat-num">45+</span>
                        <span class="stat-label">Kota</span>
                    </div>
                </div>
            </div>

            {{-- Hero Image --}}
            <div class="col-lg-6 d-none d-lg-block fade-in-up fade-in-up-2">
                <div class="hero-img-stack px-3">
                    <div class="hero-img-main position-relative">
                        <img
                            src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=700&q=80"
                            alt="Kamar kos nyaman LaKost"
                            loading="lazy"
                        >
                        <div class="hero-img-float">
                            <i class="bi bi-star-fill me-1"></i>4.9 Rating
                        </div>
                    </div>
                    <div class="hero-img-badge">
                        <div style="width:40px;height:40px;border-radius:10px;background:rgba(16,185,129,0.12);display:flex;align-items:center;justify-content:center;color:#10B981;font-size:1.2rem;flex-shrink:0;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <div style="font-size:0.82rem;font-weight:700;color:var(--kf-dark);">Terverifikasi</div>
                            <div style="font-size:0.75rem;color:var(--kf-gray);">Pemilik & Lokasi Asli</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================
     FEATURES SECTION
     ============================================ --}}
<section style="padding:80px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="kf-badge">Kenapa LaKost?</div>
            <h2 class="section-title">Platform yang Dirancang<br>untuk <span class="text-primary">Kemudahanmu</span></h2>
        </div>

        <div class="row g-4">
            @foreach($features as $i => $feature)
            <div class="col-lg-3 col-md-6 fade-in-up fade-in-up-{{ $i + 1 }}">
                <div class="kf-card p-4 h-100">
                    @php
                        $featureImages = [
                            'https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=400&q=70',
                            'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&q=70',
                            'https://images.unsplash.com/photo-1615874694520-474822394e73?w=400&q=70',
                            'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&q=70',
                        ];
                    @endphp
                    <div class="feature-img-wrap">
                        <img
                            src="{{ $featureImages[$i] }}"
                            alt="{{ $feature['title'] }}"
                            class="feature-img"
                            loading="lazy"
                        >
                    </div>
                    <div class="icon-box {{ $feature['color'] }} mb-3">
                        <i class="bi {{ $feature['icon'] }}"></i>
                    </div>
                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1rem;">
                        {{ $feature['title'] }}
                    </h5>
                    <p class="text-muted mb-0" style="font-size:0.88rem;line-height:1.65;">
                        {{ $feature['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================
     PHONE MOCKUP SECTION — Preview Aplikasi LaKost
     ============================================ --}}
<section class="phone-mockup-section">
    <div class="mockup-dots"></div>
    <div class="container position-relative">

        <div class="row align-items-center g-5">

            {{-- LEFT: Text & Features --}}
            <div class="col-lg-5 fade-in-up">
                <div class="kf-badge-dark">Preview Aplikasi</div>
                <h2 class="section-title text-white mb-3">
                    Lihat Tampilan<br>Aplikasi <span style="color:#60A5FA;">LaKost</span>
                </h2>
                <p style="color:rgba(255,255,255,0.6);font-size:0.97rem;line-height:1.75;margin-bottom:2rem;">
                    Nikmati kemudahan mencari kos langsung dari genggaman tanganmu.
                    Antarmuka yang bersih, intuitif, dan dirancang untuk pengalaman terbaik.
                </p>

                {{-- Rating badge --}}
                <div class="app-rating mb-4">
                    <i class="bi bi-star-fill"></i>
                    <span>4.9 / 5 di App Store & Play Store</span>
                </div>

                {{-- Feature pills --}}
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="feature-pill"><i class="bi bi-search"></i> Pencarian Cerdas</span>
                    <span class="feature-pill"><i class="bi bi-shield-check"></i> Listing Terverifikasi</span>
                    <span class="feature-pill"><i class="bi bi-chat-dots"></i> Chat Langsung</span>
                    <span class="feature-pill"><i class="bi bi-heart"></i> Simpan Favorit</span>
                    <span class="feature-pill"><i class="bi bi-map"></i> Peta Interaktif</span>
                    <span class="feature-pill"><i class="bi bi-bell"></i> Notifikasi Real-time</span>
                </div>

                {{-- Download buttons --}}
                <p style="font-size:0.8rem;color:rgba(255,255,255,0.4);margin-bottom:12px;text-transform:uppercase;letter-spacing:0.07em;font-weight:600;">
                    Unduh Sekarang
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#" class="app-store-btn apple">
                        <i class="bi bi-apple fs-5"></i>
                        <div>
                            <div style="font-size:0.68rem;font-weight:400;opacity:0.65;line-height:1;">Download di</div>
                            <div style="font-size:0.88rem;font-weight:700;line-height:1.3;">App Store</div>
                        </div>
                    </a>
                    <a href="#" class="app-store-btn google">
                        <i class="bi bi-google-play fs-5" style="color:#60A5FA;"></i>
                        <div>
                            <div style="font-size:0.68rem;font-weight:400;opacity:0.55;line-height:1;">Download di</div>
                            <div style="font-size:0.88rem;font-weight:700;line-height:1.3;">Google Play</div>
                        </div>
                    </a>
                </div>
            </div>

            {{-- RIGHT: 3 Phone Mockups --}}
            <div class="col-lg-7 fade-in-up fade-in-up-2">
                <div class="row g-3 align-items-end justify-content-center">

                    {{-- Phone 1 — Halaman Beranda --}}
                    <div class="col-4">
                        <div class="phone-frame" style="animation-delay: 0s;">
                            <div class="phone-body">
                                <div class="phone-notch"></div>
                                <div class="phone-screen">
                                    <img
                                        src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?w=300&h=640&fit=crop&q=80"
                                        alt="Layar Beranda LaKost"
                                        class="phone-screenshot"
                                        loading="lazy"
                                    >
                                    {{-- UI Overlay: Status bar --}}
                                    <div style="position:absolute;top:0;left:0;right:0;height:48px;background:linear-gradient(to bottom,rgba(255,255,255,0.95),rgba(255,255,255,0));display:flex;align-items:center;padding:8px 14px 0;gap:8px;z-index:5;">
                                        <span style="font-size:0.6rem;font-weight:700;color:#0F172A;font-family:'Plus Jakarta Sans',sans-serif;">LaKost</span>
                                    </div>
                                    {{-- UI Overlay: Bottom Nav --}}
                                    <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(255,255,255,0.96);backdrop-filter:blur(8px);padding:8px 0 12px;display:flex;justify-content:space-around;z-index:5;border-top:1px solid rgba(0,0,0,0.07);">
                                        <div style="text-align:center;">
                                            <i class="bi bi-house-fill" style="font-size:1rem;color:#1A56DB;display:block;"></i>
                                            <span style="font-size:0.45rem;color:#1A56DB;font-weight:600;">Beranda</span>
                                        </div>
                                        <div style="text-align:center;">
                                            <i class="bi bi-search" style="font-size:1rem;color:#94A3B8;display:block;"></i>
                                            <span style="font-size:0.45rem;color:#94A3B8;">Cari</span>
                                        </div>
                                        <div style="text-align:center;">
                                            <i class="bi bi-heart" style="font-size:1rem;color:#94A3B8;display:block;"></i>
                                            <span style="font-size:0.45rem;color:#94A3B8;">Favorit</span>
                                        </div>
                                        <div style="text-align:center;">
                                            <i class="bi bi-person" style="font-size:1rem;color:#94A3B8;display:block;"></i>
                                            <span style="font-size:0.45rem;color:#94A3B8;">Profil</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="phone-label">
                            <div class="phone-label-title">Beranda</div>
                            <div class="phone-label-desc">Temukan kos populer</div>
                        </div>
                    </div>

                    {{-- Phone 2 — Halaman Pencarian (featured, taller) --}}
                    <div class="col-4" style="position:relative;">
                        {{-- Floating notification card --}}
                        <div class="mockup-float-card d-none d-md-flex align-items-center gap-2"
                             style="top:-28px;right:-20px;animation-delay:1s;">
                            <span style="width:28px;height:28px;border-radius:8px;background:rgba(16,185,129,0.2);display:flex;align-items:center;justify-content:center;color:#10B981;font-size:0.85rem;flex-shrink:0;">
                                <i class="bi bi-check2-circle"></i>
                            </span>
                            <div>
                                <div style="font-weight:700;font-size:0.72rem;">Kos Baru!</div>
                                <div style="font-size:0.65rem;opacity:0.6;">Rp 800rb/bln · 200m</div>
                            </div>
                        </div>

                        <div class="phone-frame" style="transform:scale(1.1);transform-origin:center bottom;margin-bottom:20px;">
                            <div class="phone-body">
                                <div class="phone-notch"></div>
                                <div class="phone-screen">
                                    <img
                                        src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=300&h=640&fit=crop&q=80"
                                        alt="Layar Pencarian LaKost"
                                        class="phone-screenshot"
                                        loading="lazy"
                                    >
                                    {{-- Search bar overlay --}}
                                    <div style="position:absolute;top:44px;left:10px;right:10px;background:rgba(255,255,255,0.95);backdrop-filter:blur(8px);border-radius:10px;padding:6px 10px;display:flex;align-items:center;gap:6px;z-index:5;box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                                        <i class="bi bi-search" style="font-size:0.65rem;color:#1A56DB;"></i>
                                        <span style="font-size:0.58rem;color:#94A3B8;font-family:'Plus Jakarta Sans',sans-serif;">Cari kos di sekitar sini…</span>
                                    </div>
                                    {{-- Price badge --}}
                                    <div style="position:absolute;bottom:48px;left:10px;background:#1A56DB;color:white;border-radius:8px;padding:4px 8px;font-size:0.55rem;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;z-index:5;">
                                        Rp 750rb/bln
                                    </div>
                                    {{-- Bottom nav --}}
                                    <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(255,255,255,0.96);backdrop-filter:blur(8px);padding:8px 0 12px;display:flex;justify-content:space-around;z-index:5;border-top:1px solid rgba(0,0,0,0.07);">
                                        <div style="text-align:center;"><i class="bi bi-house" style="font-size:1rem;color:#94A3B8;display:block;"></i><span style="font-size:0.45rem;color:#94A3B8;">Beranda</span></div>
                                        <div style="text-align:center;"><i class="bi bi-search" style="font-size:1rem;color:#1A56DB;display:block;"></i><span style="font-size:0.45rem;color:#1A56DB;font-weight:600;">Cari</span></div>
                                        <div style="text-align:center;"><i class="bi bi-heart" style="font-size:1rem;color:#94A3B8;display:block;"></i><span style="font-size:0.45rem;color:#94A3B8;">Favorit</span></div>
                                        <div style="text-align:center;"><i class="bi bi-person" style="font-size:1rem;color:#94A3B8;display:block;"></i><span style="font-size:0.45rem;color:#94A3B8;">Profil</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="phone-label">
                            <div class="phone-label-title" style="color:#60A5FA;">Pencarian</div>
                            <div class="phone-label-desc">Filter & jelajahi kos</div>
                        </div>
                    </div>

                    {{-- Phone 3 — Detail Kamar --}}
                    <div class="col-4" style="position:relative;">
                        {{-- Floating rating card --}}
                        <div class="mockup-float-card d-none d-md-flex align-items-center gap-2"
                             style="bottom:80px;left:-28px;animation-delay:2s;">
                            <i class="bi bi-star-fill" style="color:#F59E0B;font-size:0.9rem;"></i>
                            <div>
                                <div style="font-weight:700;font-size:0.72rem;">4.9 ★ Rating</div>
                                <div style="font-size:0.65rem;opacity:0.6;">1.2k+ ulasan</div>
                            </div>
                        </div>

                        <div class="phone-frame" style="animation-delay: 0.5s;">
                            <div class="phone-body">
                                <div class="phone-notch"></div>
                                <div class="phone-screen">
                                    <img
                                        src="https://images.unsplash.com/photo-1484154218962-a197022b5858?w=300&h=640&fit=crop&q=80"
                                        alt="Layar Detail Kamar LaKost"
                                        class="phone-screenshot"
                                        loading="lazy"
                                    >
                                    {{-- Back button --}}
                                    <div style="position:absolute;top:44px;left:10px;width:28px;height:28px;background:rgba(255,255,255,0.9);border-radius:8px;display:flex;align-items:center;justify-content:center;z-index:5;box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                                        <i class="bi bi-arrow-left" style="font-size:0.7rem;color:#0F172A;"></i>
                                    </div>
                                    {{-- Heart button --}}
                                    <div style="position:absolute;top:44px;right:10px;width:28px;height:28px;background:rgba(255,255,255,0.9);border-radius:8px;display:flex;align-items:center;justify-content:center;z-index:5;box-shadow:0 2px 6px rgba(0,0,0,0.1);">
                                        <i class="bi bi-heart-fill" style="font-size:0.7rem;color:#EF4444;"></i>
                                    </div>
                                    {{-- Book button --}}
                                    <div style="position:absolute;bottom:10px;left:10px;right:10px;background:#1A56DB;color:white;border-radius:10px;padding:7px;text-align:center;font-size:0.6rem;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;z-index:5;">
                                        Hubungi Pemilik
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="phone-label">
                            <div class="phone-label-title">Detail Kamar</div>
                            <div class="phone-label-desc">Info lengkap & booking</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================
     HOW IT WORKS
     ============================================ --}}
<section class="hiw-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="kf-badge">Cara Kerja</div>
            <h2 class="section-title">Hanya <span class="text-primary">3 Langkah</span><br>Kos Impian Jadi Milikmu</h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach([
                ['icon' => 'bi-search', 'title' => 'Cari & Filter', 'desc' => 'Masukkan lokasi dan preferensimu. Filter berdasarkan harga, fasilitas, dan jenis kos yang kamu inginkan.'],
                ['icon' => 'bi-calendar-check', 'title' => 'Jadwalkan Survey', 'desc' => 'Pilih kos yang menarik dan jadwalkan kunjungan langsung atau virtual tour bersama pemilik.'],
                ['icon' => 'bi-house-check', 'title' => 'Huni dengan Tenang', 'desc' => 'Setujui kontrak secara digital dan langsung pindah. Kami memastikan prosesnya aman dan transparan.'],
            ] as $i => $step)
            <div class="col-lg-4 col-md-6">
                <div class="step-card fade-in-up fade-in-up-{{ $i + 1 }}">
                    <div class="step-number">{{ $i + 1 }}</div>
                    <div class="icon-box primary mx-auto mb-3">
                        <i class="bi {{ $step['icon'] }}"></i>
                    </div>
                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;">{{ $step['title'] }}</h5>
                    <p class="text-muted mb-0" style="font-size:0.88rem;line-height:1.65;">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================
     TESTIMONIALS
     ============================================ --}}
<section class="testimonials-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="kf-badge">Testimoni</div>
            <h2 class="section-title">Apa Kata <span class="text-primary">Pengguna</span> Kami?</h2>
            <p class="text-muted mt-2">Lebih dari 50.000 pengguna telah menemukan kos impian mereka bersama LaKost.</p>
        </div>

        <div class="row g-4">
            @foreach($testimonials as $i => $t)
            <div class="col-lg-4 col-md-6 fade-in-up fade-in-up-{{ $i + 1 }}">
                <div class="testimonial-card">
                    <div class="testimonial-stars mb-3">
                        @for($s = 0; $s < $t['rating']; $s++) ⭐ @endfor
                    </div>
                    <p class="text-muted mb-4" style="font-size:0.9rem;line-height:1.7;font-style:italic;">
                        "{{ $t['text'] }}"
                    </p>
                    <div class="d-flex align-items-center gap-3 border-top pt-3">
                        <div class="testimonial-avatar">{{ $t['avatar'] }}</div>
                        <div>
                            <div class="fw-bold" style="font-size:0.9rem;">{{ $t['name'] }}</div>
                            <div class="text-muted" style="font-size:0.8rem;">{{ $t['role'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
