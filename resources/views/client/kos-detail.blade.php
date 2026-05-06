{{--
    View: client/kos-detail.blade.php
    Halaman detail kos untuk user/client
--}}

@extends('layouts.app')

@section('title', $ko->nama_kos)

@push('styles')
<style>
    :root {
        --c-bg: #F7F5F0;
        --c-card: #FFFFFF;
        --c-ink: #1A1A2E;
        --c-muted: #6B7280;
        --c-accent: #E63946;
        --c-gold: #F4A261;
        --c-border: #E5E1D8;
        --c-green: #2D9D78;
    }

    /* ── Gallery ── */
    .gallery-main {
        border-radius: 20px;
        overflow: hidden;
        aspect-ratio: 16/10;
        background: var(--c-border);
        cursor: zoom-in;
        position: relative;
    }
    .gallery-main img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .gallery-main:hover img { transform: scale(1.03); }
    .gallery-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
        color: #B5AFA5;
        background: linear-gradient(135deg, #E5E1D8, #D1CCC0);
    }
    .gallery-thumbs {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-top: 10px;
    }
    .gallery-thumb {
        border-radius: 10px;
        overflow: hidden;
        aspect-ratio: 1;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.2s;
        background: var(--c-border);
    }
    .gallery-thumb.active { border-color: var(--c-accent); }
    .gallery-thumb img {
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
        transition: opacity 0.2s;
    }
    .gallery-thumb:hover img { opacity: 0.85; }
    .gallery-count-badge {
        position: absolute;
        bottom: 16px;
        right: 16px;
        background: rgba(26,26,46,0.75);
        color: white;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 50px;
        backdrop-filter: blur(6px);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ── Info Card ── */
    .info-card {
        background: var(--c-card);
        border-radius: 20px;
        border: 1px solid var(--c-border);
        overflow: hidden;
        position: sticky;
        top: 80px;
    }
    .info-card-header {
        padding: 24px 24px 0;
    }
    .kos-title {
        font-family: 'DM Serif Display', serif;
        font-size: 1.6rem;
        color: var(--c-ink);
        line-height: 1.2;
        margin-bottom: 8px;
    }
    .kos-location-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
        color: var(--c-muted);
        margin-bottom: 20px;
    }
    .kos-location-badge i { color: var(--c-accent); }

    .price-block {
        background: linear-gradient(135deg, var(--c-ink), #2D2D4A);
        margin: 0 24px;
        border-radius: 14px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .price-big {
        font-family: 'DM Serif Display', serif;
        font-size: 2rem;
        color: var(--c-gold);
        line-height: 1;
    }
    .price-sub {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.5);
        font-family: 'Plus Jakarta Sans', sans-serif;
        margin-top: 4px;
    }
    .price-tax {
        font-size: 0.72rem;
        color: rgba(255,255,255,0.4);
    }

    .info-card-body { padding: 20px 24px 24px; }

    .durasi-selector {
        margin-bottom: 20px;
    }
    .durasi-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--c-muted);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 10px;
    }
    .durasi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
    }
    .durasi-btn {
        border: 1.5px solid var(--c-border);
        border-radius: 10px;
        padding: 8px 4px;
        text-align: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--c-muted);
        cursor: pointer;
        transition: all 0.2s;
        background: transparent;
    }
    .durasi-btn:hover, .durasi-btn.active {
        border-color: var(--c-accent);
        color: var(--c-accent);
        background: rgba(230,57,70,0.05);
    }
    .durasi-btn .bulan { font-size: 0.65rem; display: block; color: #9CA3AF; }

    .total-estimasi {
        background: rgba(230,57,70,0.05);
        border: 1px solid rgba(230,57,70,0.15);
        border-radius: 12px;
        padding: 12px 16px;
        margin-bottom: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .total-label { font-size: 0.82rem; color: var(--c-muted); }
    .total-value { font-size: 1rem; font-weight: 800; color: var(--c-accent); }

    .btn-book {
        display: block;
        width: 100%;
        background: var(--c-accent);
        color: white;
        border: none;
        border-radius: 14px;
        padding: 16px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        font-size: 1rem;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
        letter-spacing: 0.02em;
    }
    .btn-book:hover { background: #C1121F; color: white; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(230,57,70,0.4); }

    .btn-login-prompt {
        display: block;
        width: 100%;
        background: var(--c-ink);
        color: white;
        border: none;
        border-radius: 14px;
        padding: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.92rem;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-login-prompt:hover { opacity: 0.85; color: white; }

    /* ── Description Section ── */
    .detail-section {
        background: var(--c-card);
        border-radius: 16px;
        border: 1px solid var(--c-border);
        padding: 28px;
        margin-bottom: 20px;
    }
    .detail-section-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--c-ink);
        letter-spacing: 0.04em;
        text-transform: uppercase;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--c-border);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .detail-section-title i { color: var(--c-accent); }
    .desc-text {
        font-size: 0.92rem;
        line-height: 1.75;
        color: #374151;
    }

    /* ── Related Kos ── */
    .related-card {
        display: flex;
        gap: 14px;
        padding: 14px;
        border: 1px solid var(--c-border);
        border-radius: 14px;
        text-decoration: none;
        transition: all 0.25s;
        background: var(--c-card);
        margin-bottom: 12px;
    }
    .related-card:hover {
        border-color: var(--c-accent);
        box-shadow: 0 4px 16px rgba(230,57,70,0.1);
        transform: translateX(4px);
    }
    .related-img {
        width: 70px;
        height: 70px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
        background: var(--c-border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .related-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.87rem;
        font-weight: 700;
        color: var(--c-ink);
        margin-bottom: 4px;
        line-height: 1.3;
    }
    .related-price {
        font-size: 0.9rem;
        font-weight: 800;
        color: var(--c-accent);
        font-family: 'DM Serif Display', serif;
    }
</style>
@endpush

@section('content')

{{-- Breadcrumb --}}
<div style="background:var(--c-bg,#F7F5F0);border-bottom:1px solid var(--c-border,#E5E1D8);padding:12px 0;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:0.82rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('client.kos') }}" class="text-decoration-none">Cari Kos</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width:200px;">{{ $ko->nama_kos }}</li>
            </ol>
        </nav>
    </div>
</div>

{{-- Main --}}
<div style="background:var(--c-bg,#F7F5F0);padding:40px 0 80px;">
    <div class="container">
        <div class="row g-4">

            {{-- ── LEFT: Gallery + Details ── --}}
            <div class="col-lg-8">

                {{-- Gallery --}}
                <div class="gallery-main mb-1" id="mainImg">
                    @if($ko->galeri->isNotEmpty())
                        <img src="{{ Storage::url($ko->galeri->first()->foto) }}"
                             alt="{{ $ko->nama_kos }}"
                             id="mainPhoto"
                             loading="lazy">
                        @if($ko->galeri->count() > 1)
                        <div class="gallery-count-badge">
                            <i class="bi bi-images me-1"></i>{{ $ko->galeri->count() }} foto
                        </div>
                        @endif
                    @else
                        <div class="gallery-placeholder">🏠</div>
                    @endif
                </div>

                @if($ko->galeri->count() > 1)
                <div class="gallery-thumbs">
                    @foreach($ko->galeri->take(8) as $i => $foto)
                    <div class="gallery-thumb {{ $i === 0 ? 'active' : '' }}"
                         onclick="switchPhoto('{{ Storage::url($foto->foto) }}', this)">
                        <img src="{{ Storage::url($foto->foto) }}" alt="Foto {{ $i+1 }}" loading="lazy">
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Description --}}
                <div class="detail-section mt-4">
                    <div class="detail-section-title">
                        <i class="bi bi-file-text"></i>Tentang Kos Ini
                    </div>
                    <p class="desc-text mb-0">
                        {{ $ko->deskripsi ?? 'Kos ini belum memiliki deskripsi detail. Hubungi pemilik untuk informasi lebih lanjut.' }}
                    </p>
                </div>

                {{-- Info Grid --}}
                <div class="detail-section">
                    <div class="detail-section-title">
                        <i class="bi bi-info-circle"></i>Informasi Kos
                    </div>
                    <div class="row g-3">
                        @foreach([
                            ['icon'=>'bi-house','label'=>'Nama Kos','value'=>$ko->nama_kos],
                            ['icon'=>'bi-geo-alt','label'=>'Lokasi','value'=>$ko->lokasi],
                            ['icon'=>'bi-currency-dollar','label'=>'Harga','value'=>'Rp '.number_format($ko->harga,0,',','.').' / bulan'],
                            ['icon'=>'bi-camera','label'=>'Foto Tersedia','value'=>$ko->galeri->count().' foto'],
                        ] as $info)
                        <div class="col-md-6">
                            <div style="display:flex;align-items:flex-start;gap:12px;padding:14px;background:#F9F8F6;border-radius:12px;">
                                <div style="width:36px;height:36px;border-radius:10px;background:rgba(230,57,70,0.08);display:flex;align-items:center;justify-content:center;color:var(--c-accent);font-size:1rem;flex-shrink:0;">
                                    <i class="bi {{ $info['icon'] }}"></i>
                                </div>
                                <div>
                                    <div style="font-size:0.72rem;color:var(--c-muted);font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">{{ $info['label'] }}</div>
                                    <div style="font-size:0.9rem;font-weight:600;color:var(--c-ink);margin-top:2px;">{{ $info['value'] }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Related Kos --}}
                @if($kosLain->isNotEmpty())
                <div class="detail-section">
                    <div class="detail-section-title">
                        <i class="bi bi-building"></i>Kos Lainnya
                    </div>
                    @foreach($kosLain as $k)
                    <a href="{{ route('client.kos.show', $k) }}" class="related-card">
                        <div class="related-img">
                            @if($k->galeri->isNotEmpty())
                                <img src="{{ Storage::url($k->galeri->first()->foto) }}" alt="{{ $k->nama_kos }}" style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                            @else
                                🏠
                            @endif
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div class="related-name">{{ $k->nama_kos }}</div>
                            <div style="font-size:0.78rem;color:var(--c-muted);margin-bottom:6px;">
                                <i class="bi bi-geo-alt text-danger" style="font-size:0.7rem;"></i>
                                {{ Str::limit($k->lokasi, 40) }}
                            </div>
                            <div class="related-price">Rp {{ number_format($k->harga,0,',','.') }}</div>
                        </div>
                        <i class="bi bi-chevron-right text-muted align-self-center"></i>
                    </a>
                    @endforeach
                </div>
                @endif

            </div>

            {{-- ── RIGHT: Booking Card ── --}}
            <div class="col-lg-4">
                <div class="info-card">
                    <div class="info-card-header">
                        <h1 class="kos-title">{{ $ko->nama_kos }}</h1>
                        <div class="kos-location-badge">
                            <i class="bi bi-geo-alt-fill"></i>
                            {{ $ko->lokasi }}
                        </div>

                        {{-- Price block --}}
                        <div class="price-block">
                            <div>
                                <div class="price-big">
                                    Rp {{ number_format($ko->harga, 0, ',', '.') }}
                                </div>
                                <div class="price-sub">per bulan</div>
                            </div>
                            <div class="text-end">
                                <div style="font-size:0.72rem;color:rgba(255,255,255,0.4);">Estimasi</div>
                                <div style="font-size:0.95rem;font-weight:700;color:white;" id="estimasiCard">
                                    Rp {{ number_format($ko->harga, 0, ',', '.') }}
                                </div>
                                <div class="price-tax" id="estimasiKet">untuk 1 bulan</div>
                            </div>
                        </div>
                    </div>

                    <div class="info-card-body">

                        {{-- Durasi selector --}}
                        <div class="durasi-selector">
                            <div class="durasi-label">Pilih Durasi Sewa</div>
                            <div class="durasi-grid">
                                @foreach([1,3,6,12] as $dur)
                                <button type="button"
                                        class="durasi-btn {{ $dur === 1 ? 'active' : '' }}"
                                        onclick="pilihDurasi({{ $dur }}, this)"
                                        data-durasi="{{ $dur }}">
                                    {{ $dur }}
                                    <span class="bulan">bulan</span>
                                </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Total Estimasi --}}
                        <div class="total-estimasi">
                            <div>
                                <div class="total-label">Total Estimasi</div>
                                <div style="font-size:0.72rem;color:#9CA3AF;" id="infoHargaDurasi">1 bln × Rp {{ number_format($ko->harga,0,',','.') }}</div>
                            </div>
                            <div class="total-value" id="totalDisplay">
                                Rp {{ number_format($ko->harga, 0, ',', '.') }}
                            </div>
                        </div>

                        @auth
                            {{-- Tombol booking → form --}}
                            <a href="{{ route('client.booking.form', $ko) }}"
                               id="btnBookNow"
                               class="btn-book"
                               data-base-url="{{ route('client.booking.form', $ko) }}">
                                <i class="bi bi-calendar-check me-2"></i>Pesan Sekarang
                            </a>
                            <p style="text-align:center;font-size:0.75rem;color:#9CA3AF;margin-top:10px;">
                                <i class="bi bi-shield-check text-success me-1"></i>
                                Transaksi aman & terpercaya
                            </p>
                        @else
                            <a href="{{ route('login') }}" class="btn-login-prompt">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login untuk Memesan
                            </a>
                            <p style="text-align:center;font-size:0.75rem;color:#9CA3AF;margin-top:10px;">
                                Daftar gratis dan mulai cari kos impianmu
                            </p>
                        @endauth

                        {{-- Info boxes --}}
                        <div style="margin-top:16px;display:flex;flex-direction:column;gap:8px;">
                            <div style="display:flex;align-items:center;gap:10px;font-size:0.8rem;color:var(--c-muted);">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                Konfirmasi instan
                            </div>
                            <div style="display:flex;align-items:center;gap:10px;font-size:0.8rem;color:var(--c-muted);">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                Tidak ada biaya tambahan
                            </div>
                            <div style="display:flex;align-items:center;gap:10px;font-size:0.8rem;color:var(--c-muted);">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                Pembayaran fleksibel
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const hargaPerBulan = {{ $ko->harga }};

    function fmt(n) {
        return 'Rp ' + parseInt(n).toLocaleString('id-ID');
    }

    function pilihDurasi(durasi, btn) {
        document.querySelectorAll('.durasi-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const total = hargaPerBulan * durasi;
        document.getElementById('totalDisplay').textContent    = fmt(total);
        document.getElementById('infoHargaDurasi').textContent = `${durasi} bln × ${fmt(hargaPerBulan)}`;
        document.getElementById('estimasiCard').textContent    = fmt(total);
        document.getElementById('estimasiKet').textContent     = `untuk ${durasi} bulan`;
    }

    function switchPhoto(src, thumb) {
        document.getElementById('mainPhoto').src = src;
        document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    }
</script>
@endpush
