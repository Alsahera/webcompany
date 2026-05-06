{{--
    View: client/kos.blade.php
    Halaman katalog kos untuk user/client
--}}

@extends('layouts.app')

@section('title', 'Cari Kos')

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
    }

    /* ── Page Header ── */
    .kos-hero {
        background: var(--c-ink);
        padding: 64px 0 80px;
        position: relative;
        overflow: hidden;
    }
    .kos-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .kos-hero-title {
        font-family: 'DM Serif Display', serif;
        font-size: clamp(2rem, 5vw, 3.5rem);
        color: #fff;
        line-height: 1.1;
    }
    .kos-hero-title span { color: var(--c-gold); }
    .result-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 50px;
        padding: 6px 16px;
        font-size: 0.82rem;
        color: rgba(255,255,255,0.7);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 500;
    }
    .result-count b { color: var(--c-gold); }

    /* ── Search Bar (Hero) ── */
    .hero-search-wrap {
        background: white;
        border-radius: 16px;
        padding: 6px 6px 6px 20px;
        display: flex;
        gap: 10px;
        align-items: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        max-width: 680px;
    }
    .hero-search-wrap input {
        flex: 1;
        border: none;
        outline: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        color: var(--c-ink);
        background: transparent;
        padding: 8px 0;
    }
    .hero-search-wrap input::placeholder { color: #9CA3AF; }
    .btn-search {
        background: var(--c-accent);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-search:hover { background: #C1121F; transform: translateY(-1px); }

    /* ── Filter Sidebar ── */
    .filter-card {
        background: var(--c-card);
        border-radius: 16px;
        border: 1px solid var(--c-border);
        overflow: hidden;
        position: sticky;
        top: 80px;
    }
    .filter-header {
        background: var(--c-ink);
        color: white;
        padding: 16px 20px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.88rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .filter-section {
        padding: 18px 20px;
        border-bottom: 1px solid var(--c-border);
    }
    .filter-section:last-child { border-bottom: none; }
    .filter-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--c-muted);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 12px;
    }
    .range-inputs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }
    .range-input {
        border: 1.5px solid var(--c-border);
        border-radius: 8px;
        padding: 8px 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.82rem;
        outline: none;
        width: 100%;
        transition: border-color 0.2s;
    }
    .range-input:focus { border-color: var(--c-accent); }

    .sort-select {
        width: 100%;
        border: 1.5px solid var(--c-border);
        border-radius: 8px;
        padding: 10px 12px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.87rem;
        color: var(--c-ink);
        outline: none;
        cursor: pointer;
        appearance: none;
        background: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='%236B7280' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 12px center;
    }
    .sort-select:focus { border-color: var(--c-accent); }
    .btn-apply {
        width: 100%;
        background: var(--c-accent);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .btn-apply:hover { background: #C1121F; }
    .btn-reset {
        width: 100%;
        background: transparent;
        color: var(--c-muted);
        border: 1.5px solid var(--c-border);
        border-radius: 10px;
        padding: 10px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        font-size: 0.83rem;
        cursor: pointer;
        margin-top: 8px;
        transition: all 0.2s;
    }
    .btn-reset:hover { border-color: var(--c-accent); color: var(--c-accent); }

    /* ── Kos Cards ── */
    .kos-card {
        background: var(--c-card);
        border-radius: 16px;
        border: 1px solid var(--c-border);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .kos-card:hover {
        box-shadow: 0 12px 40px rgba(26,26,46,0.15);
        transform: translateY(-4px);
        border-color: transparent;
    }
    .kos-img-wrap {
        position: relative;
        height: 210px;
        overflow: hidden;
        background: linear-gradient(135deg, #E5E1D8, #D1CCC0);
    }
    .kos-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .kos-card:hover .kos-img-wrap img { transform: scale(1.06); }
    .kos-img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #B5AFA5;
    }
    .kos-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--c-ink);
        color: white;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 50px;
        letter-spacing: 0.04em;
    }
    .kos-photo-count {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(0,0,0,0.6);
        color: white;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 50px;
        backdrop-filter: blur(4px);
    }
    .kos-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .kos-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: var(--c-ink);
        margin-bottom: 6px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .kos-location {
        display: flex;
        align-items: flex-start;
        gap: 5px;
        font-size: 0.82rem;
        color: var(--c-muted);
        margin-bottom: 12px;
        line-height: 1.4;
    }
    .kos-location i { color: var(--c-accent); flex-shrink: 0; margin-top: 1px; }
    .kos-desc {
        font-size: 0.82rem;
        color: var(--c-muted);
        line-height: 1.55;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }
    .kos-price-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 14px;
        border-top: 1px solid var(--c-border);
        gap: 10px;
    }
    .kos-price {
        font-family: 'DM Serif Display', serif;
        font-size: 1.35rem;
        color: var(--c-accent);
        line-height: 1;
    }
    .kos-price-sub {
        font-size: 0.72rem;
        color: var(--c-muted);
        font-family: 'Plus Jakarta Sans', sans-serif;
        margin-top: 2px;
    }
    .btn-detail {
        background: var(--c-ink);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 9px 18px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.82rem;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }
    .btn-detail:hover {
        background: var(--c-accent);
        color: white;
    }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: var(--c-muted);
    }

    /* ── Active Filter Pills ── */
    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 16px;
    }
    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(230,57,70,0.08);
        border: 1px solid rgba(230,57,70,0.2);
        color: var(--c-accent);
        border-radius: 50px;
        padding: 5px 12px;
        font-size: 0.78rem;
        font-weight: 600;
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-decoration: none;
    }
    .filter-pill:hover { background: rgba(230,57,70,0.15); color: var(--c-accent); }

    /* ── Pagination Override ── */
    .pagination { gap: 4px; flex-wrap: wrap; }
    .page-link {
        border-radius: 8px !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--c-ink);
        border-color: var(--c-border);
        padding: 8px 14px;
    }
    .page-item.active .page-link {
        background: var(--c-accent);
        border-color: var(--c-accent);
    }
    .page-link:hover { border-color: var(--c-accent); color: var(--c-accent); }
</style>
@endpush

@section('content')

{{-- ══ HERO HEADER ══ --}}
<section class="kos-hero">
    <div class="container position-relative">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <p class="result-count mb-3">
                    <i class="bi bi-building"></i>
                    Tersedia <b>{{ $totalKos }}</b> pilihan kos
                </p>
                <h1 class="kos-hero-title mb-4">
                    Temukan <span>Kos Terbaik</span><br>untuk Kamu
                </h1>

                {{-- Search Form --}}
                <form method="GET" action="{{ route('client.kos') }}" class="d-flex justify-content-center">
                    <div class="hero-search-wrap w-100" style="max-width:640px;">
                        <i class="bi bi-search text-muted"></i>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari nama kos atau lokasi...">
                        @if(request('harga_min'))
                            <input type="hidden" name="harga_min" value="{{ request('harga_min') }}">
                        @endif
                        @if(request('harga_max'))
                            <input type="hidden" name="harga_max" value="{{ request('harga_max') }}">
                        @endif
                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif
                        <button type="submit" class="btn-search">
                            <i class="bi bi-search me-1"></i>Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- ══ MAIN CONTENT ══ --}}
<section style="background:var(--c-bg,#F7F5F0);padding:48px 0 80px;">
    <div class="container">
        <div class="row g-4">

            {{-- ── Filter Sidebar ── --}}
            <div class="col-lg-3">
                <div class="filter-card">
                    <div class="filter-header">
                        <i class="bi bi-funnel-fill"></i> Filter & Urutkan
                    </div>

                    <form method="GET" action="{{ route('client.kos') }}" id="filterForm">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        {{-- Urutkan --}}
                        <div class="filter-section">
                            <div class="filter-label">Urutkan</div>
                            <select name="sort" class="sort-select">
                                <option value="terbaru" {{ request('sort','terbaru') === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                <option value="harga_asc"  {{ request('sort') === 'harga_asc'  ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="harga_desc" {{ request('sort') === 'harga_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="nama"       {{ request('sort') === 'nama'       ? 'selected' : '' }}>Nama A–Z</option>
                            </select>
                        </div>

                        {{-- Range Harga --}}
                        <div class="filter-section">
                            <div class="filter-label">Kisaran Harga / Bulan</div>
                            <div class="range-inputs">
                                <div>
                                    <div style="font-size:0.7rem;color:#9CA3AF;margin-bottom:4px;">Minimal</div>
                                    <input type="number"
                                           name="harga_min"
                                           class="range-input"
                                           value="{{ request('harga_min') }}"
                                           placeholder="0"
                                           min="0">
                                </div>
                                <div>
                                    <div style="font-size:0.7rem;color:#9CA3AF;margin-bottom:4px;">Maksimal</div>
                                    <input type="number"
                                           name="harga_max"
                                           class="range-input"
                                           value="{{ request('harga_max') }}"
                                           placeholder="∞"
                                           min="0">
                                </div>
                            </div>
                            @if($hargaMin && $hargaMax)
                            <div style="font-size:0.72rem;color:#9CA3AF;margin-top:8px;">
                                Rp {{ number_format($hargaMin,0,',','.') }} – Rp {{ number_format($hargaMax,0,',','.') }}
                            </div>
                            @endif
                        </div>

                        {{-- Buttons --}}
                        <div class="filter-section">
                            <button type="submit" class="btn-apply">
                                <i class="bi bi-funnel"></i> Terapkan
                            </button>
                            <a href="{{ route('client.kos') }}" class="btn-reset d-block text-center">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Reset Filter
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── Kos Grid ── --}}
            <div class="col-lg-9">

                {{-- Active filter pills --}}
                @if(request()->hasAny(['search','harga_min','harga_max','sort']))
                <div class="active-filters">
                    @if(request('search'))
                        <a href="{{ request()->fullUrlWithoutPage() }}&{{ http_build_query(request()->except(['search','page'])) }}" class="filter-pill">
                            <i class="bi bi-search"></i> "{{ request('search') }}"
                            <i class="bi bi-x"></i>
                        </a>
                    @endif
                    @if(request('harga_min'))
                        <span class="filter-pill">
                            Min Rp {{ number_format(request('harga_min'),0,',','.') }}
                        </span>
                    @endif
                    @if(request('harga_max'))
                        <span class="filter-pill">
                            Maks Rp {{ number_format(request('harga_max'),0,',','.') }}
                        </span>
                    @endif
                    @if(request('sort') && request('sort') !== 'terbaru')
                        <span class="filter-pill">
                            <i class="bi bi-sort-down"></i>
                            {{ ['harga_asc'=>'Harga ↑','harga_desc'=>'Harga ↓','nama'=>'Nama A–Z'][request('sort')] ?? '' }}
                        </span>
                    @endif
                </div>
                @endif

                {{-- Result info --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div style="font-size:0.88rem;color:var(--c-muted);">
                        Menampilkan <strong style="color:var(--c-ink);">{{ $kosList->firstItem() }}–{{ $kosList->lastItem() }}</strong>
                        dari <strong style="color:var(--c-ink);">{{ $kosList->total() }}</strong> kos
                    </div>
                </div>

                @if($kosList->isEmpty())
                    <div class="empty-state">
                        <div style="font-size:4rem;margin-bottom:16px;">🏠</div>
                        <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--c-ink);">
                            Kos tidak ditemukan
                        </h4>
                        <p style="font-size:0.9rem;">Coba ubah kata kunci atau filter pencarian kamu.</p>
                        <a href="{{ route('client.kos') }}" class="btn-detail mt-3 d-inline-flex">
                            <i class="bi bi-arrow-left"></i> Lihat Semua Kos
                        </a>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($kosList as $kos)
                        <div class="col-md-6 col-xl-4">
                            <div class="kos-card">
                                {{-- Photo --}}
                                <div class="kos-img-wrap">
                                    @if($kos->galeri->isNotEmpty())
                                        <img src="{{ Storage::url($kos->galeri->first()->foto) }}"
                                             alt="{{ $kos->nama_kos }}"
                                             loading="lazy">
                                        @if($kos->galeri_count > 1)
                                            <span class="kos-photo-count">
                                                <i class="bi bi-images me-1"></i>{{ $kos->galeri_count }} foto
                                            </span>
                                        @endif
                                    @else
                                        <div class="kos-img-placeholder">🏠</div>
                                    @endif
                                    <span class="kos-badge">Tersedia</span>
                                </div>

                                {{-- Body --}}
                                <div class="kos-body">
                                    <div class="kos-name">{{ $kos->nama_kos }}</div>
                                    <div class="kos-location">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span>{{ $kos->lokasi }}</span>
                                    </div>
                                    @if($kos->deskripsi)
                                        <div class="kos-desc">{{ $kos->deskripsi }}</div>
                                    @else
                                        <div class="kos-desc text-muted fst-italic">Deskripsi belum tersedia.</div>
                                    @endif

                                    <div class="kos-price-row">
                                        <div>
                                            <div class="kos-price">
                                                Rp {{ number_format($kos->harga, 0, ',', '.') }}
                                            </div>
                                            <div class="kos-price-sub">per bulan</div>
                                        </div>
                                        <a href="{{ route('client.kos.show', $kos) }}" class="btn-detail">
                                            Lihat <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if($kosList->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $kosList->links() }}
                    </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</section>

@endsection
