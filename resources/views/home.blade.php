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

    /* ---- APP PREVIEW SECTION ---- */
    .preview-section { padding: 80px 0; }
    .preview-img-card {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(26,86,219,0.14);
        border: 1px solid var(--kf-border);
        transition: var(--kf-transition);
    }
    .preview-img-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 60px rgba(26,86,219,0.20);
    }
    .preview-img-card img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        display: block;
    }
    .preview-img-caption {
        padding: 16px 20px;
        background: white;
        border-top: 1px solid var(--kf-border);
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
     APP PREVIEW SECTION (NEW)
     ============================================ --}}
<section class="preview-section section-bg">
    <div class="container">
        <div class="text-center mb-5 fade-in-up">
            <div class="kf-badge">Tampilan Aplikasi</div>
            <h2 class="section-title">Pengalaman Mencari Kos yang <span class="text-primary">Lebih Mudah</span></h2>
            <p class="text-muted mt-2 mx-auto" style="max-width:500px;">
                Antarmuka LaKost dirancang agar intuitif dan nyaman — baik di mobile maupun desktop.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-5 col-md-6 fade-in-up fade-in-up-1">
                <div class="preview-img-card">
                    <img
                        src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=700&q=80"
                        alt="Tampilan pencarian kos LaKost"
                        loading="lazy"
                        style="height:300px;"
                    >
                    <div class="preview-img-caption">
                        <div class="d-flex align-items-center gap-2">
                            <div class="icon-box primary" style="width:36px;height:36px;border-radius:9px;font-size:1rem;">
                                <i class="bi bi-search"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size:0.9rem;">Cari & Filter Mudah</div>
                                <div class="text-muted" style="font-size:0.8rem;">Filter lokasi, harga, dan fasilitas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 fade-in-up fade-in-up-2">
                <div class="preview-img-card">
                    <img
                        src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=500&q=80"
                        alt="Detail kamar kos LaKost"
                        loading="lazy"
                        style="height:300px;"
                    >
                    <div class="preview-img-caption">
                        <div class="d-flex align-items-center gap-2">
                            <div class="icon-box success" style="width:36px;height:36px;border-radius:9px;font-size:1rem;">
                                <i class="bi bi-camera"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size:0.9rem;">Foto Real & Akurat</div>
                                <div class="text-muted" style="font-size:0.8rem;">Semua foto diverifikasi tim LaKost</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 fade-in-up fade-in-up-3">
                <div class="preview-img-card h-100">
                    <img
                        src="https://images.unsplash.com/photo-1484154218962-a197022b5858?w=400&q=80"
                        alt="Fasilitas kos LaKost"
                        loading="lazy"
                        style="height:300px;"
                    >
                    <div class="preview-img-caption">
                        <div class="d-flex align-items-center gap-2">
                            <div class="icon-box warning" style="width:36px;height:36px;border-radius:9px;font-size:1rem;">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size:0.9rem;">Kos Terverifikasi</div>
                                <div class="text-muted" style="font-size:0.8rem;">Aman & terpercaya</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Download App CTA --}}
        <div class="text-center mt-5 fade-in-up">
            <p class="text-muted mb-3" style="font-size:0.9rem;">Tersedia di semua platform</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="#" class="btn btn-dark btn-lg px-4 d-flex align-items-center gap-2" style="border-radius:12px;">
                    <i class="bi bi-apple fs-4"></i>
                    <div class="text-start">
                        <div style="font-size:0.7rem;opacity:0.7;">Download di</div>
                        <div style="font-size:0.95rem;font-weight:700;">App Store</div>
                    </div>
                </a>
                <a href="#" class="btn btn-dark btn-lg px-4 d-flex align-items-center gap-2" style="border-radius:12px;">
                    <i class="bi bi-google-play fs-4"></i>
                    <div class="text-start">
                        <div style="font-size:0.7rem;opacity:0.7;">Download di</div>
                        <div style="font-size:0.95rem;font-weight:700;">Google Play</div>
                    </div>
                </a>
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

{{-- ============================================
     CTA SECTION
     ============================================ --}}
<section class="cta-section">
    <div class="container text-center position-relative">
        <div class="kf-badge" style="background:rgba(255,255,255,0.15);color:white;">Mulai Sekarang</div>
        <h2 class="section-title text-white mb-3">
            Siap Menemukan Kos <br>Impianmu di LaKost?
        </h2>
        <p class="text-white opacity-75 mb-4" style="max-width:460px;margin:0 auto 1.5rem;">
            Bergabung dengan 50.000+ pengguna yang sudah menemukan hunian nyaman bersama LaKost.
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5 fw-bold" style="color:var(--kf-primary);">
                <i class="bi bi-search me-2"></i>Cari Kos Sekarang
            </a>
            <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg px-5">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>

@endsection
