{{--
    View: about.blade.php
    Halaman Tentang KosFinder
--}}

@extends('layouts.app')

@section('title', 'Tentang Kami')

@push('styles')
<style>
    /* =============================================
       ABOUT PAGE STYLES
       ============================================= */

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
        padding: 80px 0 64px;
        position: relative;
        overflow: hidden;
    }
    .page-header::after {
        content: '';
        position: absolute;
        top: -80px; right: -80px;
        width: 400px; height: 400px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(26,86,219,0.10) 0%, transparent 70%);
    }

    /* Stats Section */
    .stat-item {
        text-align: center;
        padding: 32px 20px;
        border-right: 1px solid var(--kf-border);
    }
    .stat-item:last-child { border-right: none; }
    .stat-num-big {
        font-size: 2.8rem;
        font-weight: 900;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--kf-primary);
        line-height: 1;
        display: block;
    }
    .stat-label-big {
        font-size: 0.85rem;
        color: var(--kf-gray);
        margin-top: 6px;
    }

    /* Vision Mission */
    .visi-misi-card {
        border-radius: 16px;
        padding: 40px;
        height: 100%;
    }
    .visi-card {
        background: linear-gradient(135deg, var(--kf-primary), #2563EB);
        color: white;
    }
    .misi-card {
        background: var(--kf-light);
        border: 1px solid var(--kf-border);
    }

    .misi-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid var(--kf-border);
        font-size: 0.9rem;
        line-height: 1.6;
        color: var(--kf-dark);
    }
    .misi-item:last-child { border-bottom: none; }
    .misi-num {
        width: 28px; height: 28px;
        border-radius: 8px;
        background: var(--kf-primary);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Timeline */
    .timeline-item {
        display: flex;
        gap: 20px;
        padding-bottom: 32px;
        position: relative;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 19px;
        top: 40px;
        bottom: 0;
        width: 2px;
        background: var(--kf-border);
    }
    .timeline-item:last-child::before { display: none; }
    .timeline-dot {
        width: 40px; height: 40px;
        border-radius: 50%;
        background: var(--kf-primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 0.9rem;
    }
    .timeline-year {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--kf-primary);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 4px;
    }
</style>
@endpush

@section('content')

{{-- ============================================
     PAGE HEADER
     ============================================ --}}
<section class="page-header">
    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-7 fade-in-up">
                <div class="kf-badge">Tentang Kami</div>
                <h1 class="section-title mb-3">
                    Memudahkan Jutaan Orang<br>Menemukan <span class="text-primary">Hunian Terbaik</span>
                </h1>
                <p class="text-muted" style="font-size:1.05rem;line-height:1.7;">
                    KosFinder lahir dari keresahan nyata para pencari kos yang kesulitan menemukan
                    hunian yang transparan, aman, dan sesuai kebutuhan.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
     STATISTICS
     ============================================ --}}
<section class="py-0">
    <div class="container">
        <div class="row g-0 border rounded-3 shadow-sm overflow-hidden" style="border-color:var(--kf-border)!important;">
            @foreach($stats as $i => $stat)
            <div class="col-6 col-md-3 fade-in-up fade-in-up-{{ $i + 1 }}">
                <div class="stat-item">
                    <span class="stat-num-big">{{ $stat['number'] }}</span>
                    <div class="stat-label-big">{{ $stat['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================
     ABOUT STORY
     ============================================ --}}
<section class="section-py">
    <div class="container">
        <div class="row align-items-center g-5">
            {{-- Visual --}}
            <div class="col-lg-5 fade-in-up">
                <div class="position-relative">
                    <div class="rounded-3 overflow-hidden" style="background:linear-gradient(135deg,#DBEAFE,#EFF6FF);height:380px;display:flex;align-items:center;justify-content:center;font-size:6rem;">
                        🏘️
                    </div>
                    {{-- Floating badge --}}
                    <div class="position-absolute bottom-0 end-0 m-4 bg-white rounded-3 shadow p-3 d-flex align-items-center gap-2">
                        <div style="width:40px;height:40px;background:rgba(26,86,219,0.10);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--kf-primary);font-size:1.2rem;">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <div>
                            <div style="font-size:0.8rem;font-weight:700;">Platform Terpercaya</div>
                            <div style="font-size:0.72rem;color:var(--kf-gray);">Sejak 2019</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Text --}}
            <div class="col-lg-7 fade-in-up fade-in-up-2">
                <div class="kf-badge">Latar Belakang</div>
                <h2 class="section-title mb-4">
                    Berawal dari <span class="text-primary">Masalah Nyata</span>
                </h2>
                <p class="text-muted mb-3" style="line-height:1.8;">
                    Pada tahun 2019, founder kami, seorang mahasiswa perantauan di Jakarta, mengalami
                    sendiri betapa sulitnya mencari kos yang sesuai. Foto yang menipu, harga yang tidak
                    transparan, dan minimnya informasi membuat proses pencarian sangat melelahkan.
                </p>
                <p class="text-muted mb-4" style="line-height:1.8;">
                    Dari pengalaman itulah KosFinder lahir — sebuah platform yang menempatkan
                    <strong>kepercayaan, transparansi, dan kemudahan</strong> sebagai fondasi utama.
                    Kami percaya bahwa setiap orang berhak mendapatkan hunian yang layak tanpa
                    proses yang menyulitkan.
                </p>

                {{-- Timeline --}}
                <div>
                    @foreach([
                        ['year' => '2019', 'icon' => 'bi-lightbulb', 'title' => 'Ide & Riset', 'desc' => 'Memulai riset mendalam tentang masalah pencarian kos di Indonesia.'],
                        ['year' => '2020', 'icon' => 'bi-rocket', 'title' => 'Peluncuran Beta', 'desc' => 'Meluncurkan versi beta dengan 500 listing di Jakarta dan Bandung.'],
                        ['year' => '2022', 'icon' => 'bi-graph-up-arrow', 'title' => 'Ekspansi Nasional', 'desc' => 'Berkembang ke 45 kota dengan lebih dari 10.000 listing terverifikasi.'],
                    ] as $tl)
                    <div class="timeline-item">
                        <div class="timeline-dot">
                            <i class="bi {{ $tl['icon'] }}"></i>
                        </div>
                        <div>
                            <div class="timeline-year">{{ $tl['year'] }}</div>
                            <div class="fw-bold mb-1" style="font-size:0.95rem;">{{ $tl['title'] }}</div>
                            <div class="text-muted" style="font-size:0.85rem;">{{ $tl['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
     VISI & MISI
     ============================================ --}}
<section class="section-py section-bg">
    <div class="container">
        <div class="text-center mb-5 fade-in-up">
            <div class="kf-badge">Nilai Kami</div>
            <h2 class="section-title">Visi & Misi <span class="text-primary">KosFinder</span></h2>
        </div>

        <div class="row g-4">
            {{-- Visi --}}
            <div class="col-lg-5 fade-in-up fade-in-up-1">
                <div class="visi-card visi-misi-card">
                    <div class="mb-3" style="font-size:2rem;">🎯</div>
                    <h3 class="mb-3" style="font-size:1.4rem;color:white;">Visi Kami</h3>
                    <p style="font-size:0.95rem;line-height:1.8;opacity:0.9;margin:0;">
                        Menjadi platform pencarian hunian sementara yang paling terpercaya, transparan,
                        dan inklusif di Asia Tenggara — di mana setiap orang dapat menemukan tempat
                        tinggal yang aman dan nyaman dengan mudah.
                    </p>
                    <div class="mt-4 pt-4" style="border-top:1px solid rgba(255,255,255,0.2);">
                        <div class="d-flex gap-4">
                            <div>
                                <div style="font-size:1.5rem;font-weight:900;font-family:'Plus Jakarta Sans',sans-serif;">2030</div>
                                <div style="font-size:0.75rem;opacity:0.75;">Target Tahun</div>
                            </div>
                            <div>
                                <div style="font-size:1.5rem;font-weight:900;font-family:'Plus Jakarta Sans',sans-serif;">10 Negara</div>
                                <div style="font-size:0.75rem;opacity:0.75;">Ekspansi ASEAN</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Misi --}}
            <div class="col-lg-7 fade-in-up fade-in-up-2">
                <div class="misi-card visi-misi-card">
                    <div class="mb-3" style="font-size:2rem;">🚀</div>
                    <h3 class="mb-3" style="font-size:1.4rem;color:var(--kf-dark);">Misi Kami</h3>
                    @foreach($missions as $i => $mission)
                    <div class="misi-item">
                        <div class="misi-num">{{ $i + 1 }}</div>
                        <span>{{ $mission }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
     VALUES / KULTUR
     ============================================ --}}
<section class="section-py">
    <div class="container">
        <div class="text-center mb-5 fade-in-up">
            <div class="kf-badge">Budaya Kami</div>
            <h2 class="section-title">Nilai yang Kami <span class="text-primary">Pegang Teguh</span></h2>
        </div>

        <div class="row g-4">
            @foreach([
                ['icon' => 'bi-heart-fill',         'color' => 'danger',  'title' => 'Berpusat pada Pengguna', 'desc' => 'Setiap keputusan kami didasarkan pada kebutuhan dan pengalaman nyata pengguna.'],
                ['icon' => 'bi-transparency',        'color' => 'primary', 'title' => 'Transparansi Total',     'desc' => 'Informasi harga, kondisi, dan pemilik kos selalu jujur dan dapat diverifikasi.'],
                ['icon' => 'bi-lightbulb-fill',      'color' => 'warning', 'title' => 'Inovasi Berkelanjutan', 'desc' => 'Kami terus berinovasi untuk menghadirkan fitur yang benar-benar membantu.'],
                ['icon' => 'bi-people-fill',         'color' => 'success', 'title' => 'Komunitas yang Kuat',   'desc' => 'Membangun ekosistem saling menguntungkan antara pencari dan pemilik kos.'],
            ] as $i => $val)
            <div class="col-lg-3 col-md-6 fade-in-up fade-in-up-{{ $i + 1 }}">
                <div class="kf-card p-4 text-center h-100">
                    <div class="icon-box {{ $val['color'] }} mx-auto mb-3">
                        <i class="bi {{ $val['icon'] }}"></i>
                    </div>
                    <h5 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.95rem;">{{ $val['title'] }}</h5>
                    <p class="text-muted mb-0" style="font-size:0.85rem;line-height:1.65;">{{ $val['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
