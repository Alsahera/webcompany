{{--
    View: team.blade.php
    Halaman Tim LaKost — 3 anggota, dengan foto, tanpa "We're Hiring"
--}}

@extends('layouts.app')

@section('title', 'Tim Kami')

@push('styles')
<style>
    /* =============================================
       TEAM PAGE STYLES
       ============================================= */

    .team-card {
        background: white;
        border: 1px solid var(--kf-border);
        border-radius: 20px;
        overflow: hidden;
        text-align: center;
        transition: var(--kf-transition);
        position: relative;
    }
    .team-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(to right, var(--kf-primary), #3B82F6);
        transform: scaleX(0);
        transition: transform 0.3s ease;
        transform-origin: left;
    }
    .team-card:hover::before { transform: scaleX(1); }
    .team-card:hover {
        box-shadow: 0 16px 48px rgba(26,86,219,0.16);
        transform: translateY(-8px);
    }

    /* Photo Area */
    .team-photo-wrap {
        position: relative;
        overflow: hidden;
        height: 280px;
        background: var(--kf-light);
    }
    .team-photo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
        transition: transform 0.4s ease;
    }
    .team-card:hover .team-photo-wrap img {
        transform: scale(1.06);
    }
    .team-photo-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, transparent 50%, rgba(15,23,42,0.55) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .team-card:hover .team-photo-overlay { opacity: 1; }

    /* Social overlay links */
    .team-socials-overlay {
        position: absolute;
        bottom: 16px;
        left: 0; right: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
        opacity: 0;
        transform: translateY(12px);
        transition: all 0.3s ease;
    }
    .team-card:hover .team-socials-overlay {
        opacity: 1;
        transform: translateY(0);
    }
    .team-social-btn {
        width: 38px; height: 38px;
        border-radius: 10px;
        background: rgba(255,255,255,0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--kf-dark);
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        backdrop-filter: blur(6px);
    }
    .team-social-btn:hover {
        background: var(--kf-primary);
        color: white;
        transform: scale(1.12);
    }

    /* Card body */
    .team-card-body { padding: 24px 28px 28px; }

    .role-badge {
        display: inline-block;
        padding: 5px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        background: rgba(26,86,219,0.08);
        color: var(--kf-primary);
        margin-bottom: 10px;
    }

    /* Kultur Section */
    .kultur-icon-box {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
        margin: 0 auto 16px;
    }
</style>
@endpush

@section('content')

{{-- ============================================
     PAGE HEADER
     ============================================ --}}
<section style="background:linear-gradient(135deg,#EFF6FF,#DBEAFE);padding:80px 0 64px;">
    <div class="container text-center">
        <div class="fade-in-up">
            <div class="kf-badge">Tim Kami</div>
            <h1 class="section-title mb-3">
                Orang-orang Hebat di Balik <span class="text-primary">LaKost</span>
            </h1>
            <p class="text-muted mx-auto" style="max-width:520px;font-size:1.02rem;line-height:1.7;">
                Tim kami terdiri dari individu-individu bersemangat yang berdedikasi untuk
                menghadirkan pengalaman terbaik bagi setiap pengguna LaKost.
            </p>
        </div>
    </div>
</section>

{{-- ============================================
     TEAM MEMBERS — 3 Orang
     ============================================ --}}
<section class="section-py">
    <div class="container">

        <div class="row g-4 justify-content-center">

            {{-- Member 1: Frontend Developer --}}
            <div class="col-lg-4 col-md-6 fade-in-up fade-in-up-1">
                <div class="team-card h-100">
                    <div class="team-photo-wrap">
                        <img
                            src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=500&q=80"
                            alt="Dimas Prasetyo"
                            loading="lazy"
                        >
                        <div class="team-photo-overlay"></div>
                        <div class="team-socials-overlay">
                            <a href="#" class="team-social-btn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="team-social-btn" aria-label="GitHub"><i class="bi bi-github"></i></a>
                            <a href="#" class="team-social-btn" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                        </div>
                    </div>
                    <div class="team-card-body">
                        <div class="role-badge">
                            <i class="bi bi-code-slash me-1"></i>Frontend Developer
                        </div>
                        <h5 class="mb-2" style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.15rem;">
                            Dimas Prasetyo
                        </h5>
                        <p class="text-muted mb-0" style="font-size:0.87rem;line-height:1.65;">
                            Spesialis React & Vue.js dengan passion pada performa dan aksesibilitas web. 
                            Bertanggung jawab atas antarmuka LaKost yang intuitif dan responsif.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Member 2: Backend Developer --}}
            <div class="col-lg-4 col-md-6 fade-in-up fade-in-up-2">
                <div class="team-card h-100">
                    <div class="team-photo-wrap">
                        <img
                            src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=500&q=80"
                            alt="Novi Anggraini"
                            loading="lazy"
                        >
                        <div class="team-photo-overlay"></div>
                        <div class="team-socials-overlay">
                            <a href="#" class="team-social-btn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="team-social-btn" aria-label="GitHub"><i class="bi bi-github"></i></a>
                            <a href="#" class="team-social-btn" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                        </div>
                    </div>
                    <div class="team-card-body">
                        <div class="role-badge" style="background:rgba(16,185,129,0.10);color:#059669;">
                            <i class="bi bi-server me-1"></i>Backend Developer
                        </div>
                        <h5 class="mb-2" style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.15rem;">
                            Novi Anggraini
                        </h5>
                        <p class="text-muted mb-0" style="font-size:0.87rem;line-height:1.65;">
                            Expert Laravel & Node.js yang memastikan sistem LaKost berjalan cepat, 
                            aman, dan skalabel. Berpengalaman dalam arsitektur microservices.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Member 3: UI/UX Designer --}}
            <div class="col-lg-4 col-md-6 fade-in-up fade-in-up-3">
                <div class="team-card h-100">
                    <div class="team-photo-wrap">
                        <img
                            src="https://images.unsplash.com/photo-1580894732444-8ecded7900cd?w=500&q=80"
                            alt="Sari Puspita"
                            loading="lazy"
                        >
                        <div class="team-photo-overlay"></div>
                        <div class="team-socials-overlay">
                            <a href="#" class="team-social-btn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="team-social-btn" aria-label="Dribbble"><i class="bi bi-dribbble"></i></a>
                            <a href="#" class="team-social-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                    <div class="team-card-body">
                        <div class="role-badge" style="background:rgba(236,72,153,0.10);color:#DB2777;">
                            <i class="bi bi-palette me-1"></i>UI/UX Designer
                        </div>
                        <h5 class="mb-2" style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.15rem;">
                            Sari Puspita
                        </h5>
                        <p class="text-muted mb-0" style="font-size:0.87rem;line-height:1.65;">
                            Desainer berpengalaman yang berfokus pada pengalaman pengguna yang intuitif 
                            dan estetis. Mendesain setiap alur LaKost agar mudah digunakan siapa saja.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================
     KULTUR KERJA
     ============================================ --}}
<section class="section-py section-bg">
    <div class="container">
        <div class="text-center mb-5 fade-in-up">
            <div class="kf-badge">Kultur Kerja</div>
            <h2 class="section-title">Bagaimana Kami <span class="text-primary">Bekerja</span></h2>
        </div>

        <div class="row g-4">
            @foreach([
                ['icon' => 'bi-lightning-charge-fill', 'color' => 'warning', 'bg' => 'rgba(245,158,11,0.10)', 'title' => 'Agile & Fast',       'desc' => 'Sprint 2 minggu, delivery cepat, dan iterasi terus-menerus berdasarkan feedback pengguna.'],
                ['icon' => 'bi-chat-square-dots-fill', 'color' => 'info',    'bg' => 'rgba(6,182,212,0.10)',  'title' => 'Open Communication', 'desc' => 'Transparansi dalam semua level. Setiap suara dihargai, setiap ide dipertimbangkan.'],
                ['icon' => 'bi-book-fill',             'color' => 'success', 'bg' => 'rgba(16,185,129,0.10)','title' => 'Belajar Terus',      'desc' => 'Budget belajar tahunan, mentorship, dan kultur berbagi pengetahuan yang kuat.'],
                ['icon' => 'bi-emoji-smile-fill',      'color' => 'danger',  'bg' => 'rgba(239,68,68,0.10)', 'title' => 'Work-Life Balance',  'desc' => 'Flexible hours, remote-friendly, dan lingkungan kerja yang mendukung kesehatan mental.'],
            ] as $i => $k)
            <div class="col-lg-3 col-md-6 fade-in-up fade-in-up-{{ $i + 1 }}">
                <div class="kf-card p-4 text-center h-100">
                    <div class="kultur-icon-box" style="background:{{ $k['bg'] }};color:var(--kf-{{ $k['color'] === 'info' ? 'primary' : ($k['color'] === 'success' ? 'primary' : ($k['color'] === 'warning' ? 'accent' : 'primary')) }});">
                        <i class="bi {{ $k['icon'] }}" style="color:{{ $k['color'] === 'warning' ? 'var(--kf-accent)' : ($k['color'] === 'success' ? '#10B981' : ($k['color'] === 'info' ? '#06B6D4' : '#EF4444')) }};"></i>
                    </div>
                    <h6 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;">{{ $k['title'] }}</h6>
                    <p class="text-muted mb-0" style="font-size:0.85rem;line-height:1.65;">{{ $k['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
