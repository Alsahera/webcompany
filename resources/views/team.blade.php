{{--
    View: team.blade.php
    Halaman Tim KosFinder
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
        border-radius: 16px;
        padding: 36px 28px;
        text-align: center;
        transition: var(--kf-transition);
        position: relative;
        overflow: hidden;
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
        box-shadow: 0 12px 40px rgba(26,86,219,0.15);
        transform: translateY(-6px);
    }

    .role-badge {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        background: rgba(26,86,219,0.08);
        color: var(--kf-primary);
        margin-bottom: 1rem;
    }

    .team-social-links {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 1rem;
    }
    .team-social-btn {
        width: 34px; height: 34px;
        border-radius: 8px;
        background: var(--kf-light);
        border: 1px solid var(--kf-border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--kf-gray);
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.25s ease;
    }
    .team-social-btn:hover {
        background: var(--kf-primary);
        border-color: var(--kf-primary);
        color: white;
        transform: translateY(-2px);
    }

    /* Join CTA */
    .join-card {
        background: linear-gradient(135deg, var(--kf-primary) 0%, #1447C0 100%);
        border-radius: 20px;
        padding: 60px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .join-card::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 300px; height: 300px;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
    }
    .join-card::after {
        content: '';
        position: absolute;
        bottom: -60px; left: -60px;
        width: 250px; height: 250px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }
</style>
@endpush

@section('content')

{{-- ============================================
     PAGE HEADER
     ============================================ --}}
<section class="page-header" style="background:linear-gradient(135deg,#EFF6FF,#DBEAFE);padding:80px 0 64px;">
    <div class="container text-center">
        <div class="fade-in-up">
            <div class="kf-badge">Tim Kami</div>
            <h1 class="section-title mb-3">
                Orang-orang Hebat di Balik <span class="text-primary">KosFinder</span>
            </h1>
            <p class="text-muted mx-auto" style="max-width:520px;font-size:1.02rem;line-height:1.7;">
                Tim kami terdiri dari individu-individu bersemangat yang berdedikasi untuk
                menghadirkan pengalaman terbaik bagi setiap pengguna KosFinder.
            </p>
        </div>
    </div>
</section>

{{-- ============================================
     TEAM MEMBERS
     ============================================ --}}
<section class="section-py">
    <div class="container">

        <div class="row g-4">
            @foreach($teams as $i => $member)
            <div class="col-lg-4 col-md-6 fade-in-up fade-in-up-{{ ($i % 4) + 1 }}">
                <div class="team-card h-100">

                    {{-- Avatar --}}
                    <div class="avatar-initials {{ $member['color'] }}">
                        {{ $member['initial'] }}
                    </div>

                    {{-- Name --}}
                    <h5 class="mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:1.05rem;">
                        {{ $member['name'] }}
                    </h5>

                    {{-- Role Badge --}}
                    <div class="role-badge">
                        <i class="bi {{ $member['icon'] }} me-1"></i>{{ $member['role'] }}
                    </div>

                    {{-- Description --}}
                    <p class="text-muted mb-0" style="font-size:0.85rem;line-height:1.65;">
                        {{ $member['desc'] }}
                    </p>

                    {{-- Social Links --}}
                    <div class="team-social-links">
                        @if(isset($member['socials']['linkedin']))
                        <a href="{{ $member['socials']['linkedin'] }}" class="team-social-btn" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        @endif
                        @if(isset($member['socials']['github']))
                        <a href="{{ $member['socials']['github'] }}" class="team-social-btn" aria-label="GitHub">
                            <i class="bi bi-github"></i>
                        </a>
                        @endif
                        @if(isset($member['socials']['dribbble']))
                        <a href="{{ $member['socials']['dribbble'] }}" class="team-social-btn" aria-label="Dribbble">
                            <i class="bi bi-dribbble"></i>
                        </a>
                        @endif
                    </div>

                </div>
            </div>
            @endforeach
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
                ['icon' => 'bi-lightning-charge-fill', 'color' => 'warning', 'title' => 'Agile & Fast',        'desc' => 'Sprint 2 minggu, delivery cepat, dan iterasi terus-menerus berdasarkan feedback pengguna.'],
                ['icon' => 'bi-chat-square-dots-fill', 'color' => 'info',    'title' => 'Open Communication',  'desc' => 'Transparansi dalam semua level. Setiap suara dihargai, setiap ide dipertimbangkan.'],
                ['icon' => 'bi-book-fill',             'color' => 'success', 'title' => 'Belajar Terus',       'desc' => 'Budget belajar tahunan, mentorship, dan kultur berbagi pengetahuan yang kuat.'],
                ['icon' => 'bi-emoji-smile-fill',      'color' => 'danger',  'title' => 'Work-Life Balance',   'desc' => 'Flexible hours, remote-friendly, dan lingkungan kerja yang mendukung kesehatan mental.'],
            ] as $i => $k)
            <div class="col-lg-3 col-md-6 fade-in-up fade-in-up-{{ $i + 1 }}">
                <div class="kf-card p-4 text-center h-100">
                    <div class="icon-box {{ $k['color'] }} mx-auto mb-3">
                        <i class="bi {{ $k['icon'] }}"></i>
                    </div>
                    <h6 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;">{{ $k['title'] }}</h6>
                    <p class="text-muted mb-0" style="font-size:0.85rem;line-height:1.65;">{{ $k['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================
     JOIN THE TEAM CTA
     ============================================ --}}
<section class="section-py">
    <div class="container">
        <div class="join-card fade-in-up position-relative">
            <div class="position-relative" style="z-index:1;">
                <div class="kf-badge" style="background:rgba(255,255,255,0.15);color:white;">
                    We're Hiring!
                </div>
                <h2 class="section-title text-white mb-3">
                    Bergabunglah dengan Tim Kami!
                </h2>
                <p class="text-white mb-4" style="opacity:0.8;max-width:480px;margin:0 auto 1.5rem;font-size:0.95rem;line-height:1.7;">
                    Kami selalu mencari talenta-talenta terbaik yang passionate di bidangnya.
                    Yuk wujudkan dampak nyata bersama KosFinder!
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5 fw-bold" style="color:var(--kf-primary);">
                        <i class="bi bi-send me-2"></i>Kirim Lamaran
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg px-5">
                        Pelajari Budaya Kami
                    </a>
                </div>

                {{-- Open positions --}}
                <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                    @foreach(['React Developer', 'Data Analyst', 'Product Designer', 'Growth Hacker'] as $pos)
                    <span class="badge rounded-pill px-3 py-2" style="background:rgba(255,255,255,0.15);color:white;font-weight:500;font-size:0.8rem;">
                        <i class="bi bi-briefcase me-1"></i>{{ $pos }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
