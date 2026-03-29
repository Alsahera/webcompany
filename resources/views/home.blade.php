{{--
    View: home.blade.php
    Halaman beranda KosFinder
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
    .hero-title .highlight {
        color: var(--kf-primary);
        position: relative;
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
    .hero-stat-item { text-align: left; }
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

    /* Hero Visual */
    .hero-visual {
        position: relative;
    }
    .hero-card-main {
        background: white;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 16px 48px rgba(26,86,219,0.18);
        border: 1px solid var(--kf-border);
    }
    .hero-card-img {
        width: 100%;
        height: 220px;
        border-radius: 14px;
        background: linear-gradient(135deg, #DBEAFE, #EFF6FF);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        margin-bottom: 16px;
    }
    .hero-card-badge {
        position: absolute;
        top: -16px; right: -16px;
        background: var(--kf-accent);
        color: white;
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 0.8rem;
        font-weight: 700;
        box-shadow: 0 4px 16px rgba(245,158,11,0.35);
    }
    .hero-card-floating {
        position: absolute;
        bottom: -20px;
        left: -24px;
        background: white;
        border-radius: 14px;
        padding: 14px 18px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        border: 1px solid var(--kf-border);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* ---- FEATURES ---- */
    .features-section { padding: 80px 0; }

    /* ---- HOW IT WORKS ---- */
    .hiw-section { padding: 80px 0; background: var(--kf-light); }

    .step-card {
        text-align: center;
        padding: 40px 24px;
        background: white;
        border-radius: var(--kf-radius);
        border: 1px solid var(--kf-border);
        transition: var(--kf-transition);
        position: relative;
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
    .step-connector {
        position: absolute;
        top: 72px;
        right: -30%;
        width: 60%;
        height: 2px;
        background: linear-gradient(to right, var(--kf-primary), transparent);
        z-index: 0;
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
                    Temukan Kos <span class="highlight">Impianmu</span> dengan Mudah & Cepat
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

            {{-- Hero Visual --}}
            <div class="col-lg-6 d-none d-lg-block fade-in-up fade-in-up-2">
                <div class="hero-visual px-4">
                    <div class="hero-card-main position-relative">
                        <div class="hero-card-badge">
                            <i class="bi bi-star-fill me-1"></i>4.9 Rating
                        </div>
                        <div class="hero-card-img">
                            🏠
                        </div>
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1 fw-bold" style="font-family:'Plus Jakarta Sans',sans-serif;">Kos Putri Damai</h6>
                                <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>Fatmawati, Jakarta Selatan</small>
                            </div>
                            <div class="text-end">
                                <div class="fw-bold text-primary" style="font-family:'Plus Jakarta Sans',sans-serif;">Rp 1,5 Jt</div>
                                <small class="text-muted">/bulan</small>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            @foreach(['WiFi', 'AC', 'Kamar Mandi Dalam'] as $f)
                            <span class="badge rounded-pill" style="background:rgba(26,86,219,0.08);color:var(--kf-primary);font-weight:500;font-size:0.75rem;">{{ $f }}</span>
                            @endforeach
                        </div>

                        {{-- Floating card --}}
                        <div class="hero-card-floating">
                            <div style="width:40px;height:40px;border-radius:10px;background:rgba(16,185,129,0.12);display:flex;align-items:center;justify-content:center;color:#10B981;font-size:1.2rem;">
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
    </div>
</section>

{{-- ============================================
     FEATURES SECTION
     ============================================ --}}
<section class="features-section">
    <div class="container">
        <div class="text-center mb-5">
            <div class="kf-badge">Kenapa KosFinder?</div>
            <h2 class="section-title">Platform yang Dirancang<br>untuk <span class="text-primary">Kemudahanmu</span></h2>
        </div>

        <div class="row g-4">
            @foreach($features as $i => $feature)
            <div class="col-lg-3 col-md-6 fade-in-up fade-in-up-{{ $i + 1 }}">
                <div class="kf-card p-4 h-100">
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
            <p class="text-muted mt-2">Lebih dari 50.000 pengguna telah menemukan kos impian mereka.</p>
        </div>

        <div class="row g-4">
            @foreach($testimonials as $i => $t)
            <div class="col-lg-4 col-md-6 fade-in-up fade-in-up-{{ $i + 1 }}">
                <div class="testimonial-card">
                    {{-- Stars --}}
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
            Siap Menemukan Kos <br>Impianmu?
        </h2>
        <p class="text-white opacity-75 mb-4" style="max-width:460px;margin:0 auto 1.5rem;">
            Bergabung dengan 50.000+ pengguna yang sudah menemukan hunian nyaman bersama KosFinder.
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
