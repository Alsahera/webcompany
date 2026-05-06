{{--
    View: client/my-bookings.blade.php
    Halaman riwayat booking milik user
--}}

@extends('layouts.app')

@section('title', 'Booking Saya')

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
        --c-green: #059669;
    }

    /* Page Header */
    .page-banner {
        background: linear-gradient(135deg, var(--c-ink) 0%, #2D2D4A 100%);
        padding: 48px 0;
        position: relative;
        overflow: hidden;
    }
    .page-banner::before {
        content: '';
        position: absolute;
        right: -100px; top: -100px;
        width: 400px; height: 400px;
        border-radius: 50%;
        background: rgba(255,255,255,0.03);
    }

    /* Booking Card */
    .booking-item {
        background: var(--c-card);
        border-radius: 18px;
        border: 1px solid var(--c-border);
        overflow: hidden;
        transition: all 0.25s ease;
        margin-bottom: 20px;
    }
    .booking-item:hover {
        box-shadow: 0 8px 32px rgba(26,26,46,0.1);
        border-color: rgba(230,57,70,0.2);
    }
    .booking-item-header {
        background: #FAFAF8;
        padding: 14px 20px;
        border-bottom: 1px solid var(--c-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .booking-id {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--c-muted);
        letter-spacing: 0.06em;
    }
    .booking-id b { color: var(--c-ink); }
    .booking-date {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.78rem;
        color: #9CA3AF;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .sp-pending { background: rgba(245,158,11,0.1); color: #D97706; border: 1px solid rgba(245,158,11,0.2); }
    .sp-lunas   { background: rgba(5,150,105,0.1);  color: var(--c-green); border: 1px solid rgba(5,150,105,0.2); }
    .sp-belum   { background: rgba(107,114,128,0.1);color: var(--c-muted); border: 1px solid rgba(107,114,128,0.2); }

    .booking-item-body {
        padding: 20px;
        display: flex;
        gap: 18px;
        align-items: flex-start;
    }
    .booking-kos-img {
        width: 90px;
        height: 90px;
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
        background: var(--c-border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }
    .booking-kos-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }
    .booking-info { flex: 1; min-width: 0; }
    .booking-kos-name {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        color: var(--c-ink);
        margin-bottom: 4px;
    }
    .booking-kos-location {
        font-size: 0.82rem;
        color: var(--c-muted);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .booking-kos-location i { color: var(--c-accent); font-size: 0.75rem; }

    .booking-meta-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }
    .meta-item {
        background: #F9F8F6;
        border-radius: 10px;
        padding: 10px 12px;
    }
    .meta-key {
        font-size: 0.68rem;
        font-weight: 700;
        color: #9CA3AF;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-family: 'Plus Jakarta Sans', sans-serif;
        margin-bottom: 3px;
    }
    .meta-val {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--c-ink);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .meta-val.accent { color: var(--c-accent); }

    .booking-item-footer {
        padding: 14px 20px;
        border-top: 1px solid var(--c-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        background: #FDFCFA;
    }

    .btn-sm-custom {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        font-size: 0.82rem;
        text-decoration: none;
        transition: all 0.2s;
        border: 1.5px solid transparent;
        cursor: pointer;
    }
    .btn-sm-detail {
        background: var(--c-ink);
        color: white;
    }
    .btn-sm-detail:hover { background: var(--c-accent); color: white; }
    .btn-sm-upload {
        background: transparent;
        color: var(--c-accent);
        border-color: rgba(230,57,70,0.3);
    }
    .btn-sm-upload:hover { background: rgba(230,57,70,0.05); color: var(--c-accent); }

    /* Empty State */
    .empty-wrap {
        text-align: center;
        padding: 80px 20px;
        background: var(--c-card);
        border-radius: 20px;
        border: 1px solid var(--c-border);
    }

    /* Upload mini form inline */
    .inline-upload {
        display: none;
        margin-top: 12px;
        background: #FAFAF8;
        border: 1.5px dashed var(--c-border);
        border-radius: 12px;
        padding: 16px;
    }
    .inline-upload.show { display: block; }
</style>
@endpush

@section('content')

{{-- Banner --}}
<div class="page-banner">
    <div class="container position-relative">
        <div class="d-flex align-items-center gap-4">
            <div style="width:56px;height:56px;border-radius:16px;background:rgba(255,255,255,0.1);display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0;">
                📋
            </div>
            <div>
                <h1 style="font-family:'DM Serif Display',serif;font-size:1.9rem;color:white;margin-bottom:4px;">
                    Booking <span style="color:var(--c-gold);">Saya</span>
                </h1>
                <p style="color:rgba(255,255,255,0.5);font-size:0.88rem;margin:0;font-family:'Plus Jakarta Sans',sans-serif;">
                    Selamat datang, <strong style="color:rgba(255,255,255,0.8);">{{ Auth::user()->name }}</strong> —
                    riwayat semua pemesanan kos kamu ada di sini
                </p>
            </div>
        </div>
    </div>
</div>

{{-- Content --}}
<div style="background:var(--c-bg,#F7F5F0);padding:40px 0 80px;">
    <div class="container">

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="alert rounded-3 mb-4" style="background:rgba(5,150,105,0.08);border:1px solid rgba(5,150,105,0.2);color:#065F46;font-size:0.88rem;">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
        @endif

        @if($bookings->isEmpty())
            <div class="empty-wrap">
                <div style="font-size:4rem;margin-bottom:16px;">📭</div>
                <h4 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--c-ink);margin-bottom:8px;">
                    Belum ada booking
                </h4>
                <p style="font-size:0.9rem;color:var(--c-muted);margin-bottom:20px;">
                    Kamu belum pernah memesan kos. Yuk mulai cari kos impianmu!
                </p>
                <a href="{{ route('client.kos') }}"
                   style="background:var(--c-accent);color:white;border:none;border-radius:12px;padding:12px 28px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.9rem;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                    <i class="bi bi-search"></i>Cari Kos Sekarang
                </a>
            </div>

        @else

            {{-- Stats summary --}}
            <div class="row g-3 mb-5">
                @php
                    $total   = $bookings->total();
                    $lunas   = $bookings->getCollection()->filter(fn($b) => $b->pembayaran && $b->pembayaran->status_bayar === 'lunas')->count();
                    $pending = $bookings->getCollection()->filter(fn($b) => $b->pembayaran && $b->pembayaran->status_bayar === 'pending')->count();
                    $noBayar = $bookings->getCollection()->filter(fn($b) => !$b->pembayaran)->count();
                @endphp
                @foreach([
                    ['icon'=>'bi-calendar-check','label'=>'Total Booking (halaman ini)','val'=>$bookings->count(),'color'=>'#1A1A2E','bg'=>'rgba(26,26,46,0.08)'],
                    ['icon'=>'bi-check-circle','label'=>'Sudah Lunas','val'=>$lunas,'color'=>'#059669','bg'=>'rgba(5,150,105,0.08)'],
                    ['icon'=>'bi-clock','label'=>'Menunggu Verifikasi','val'=>$pending,'color'=>'#D97706','bg'=>'rgba(245,158,11,0.08)'],
                    ['icon'=>'bi-exclamation-circle','label'=>'Belum Ada Pembayaran','val'=>$noBayar,'color'=>'#E63946','bg'=>'rgba(230,57,70,0.08)'],
                ] as $s)
                <div class="col-6 col-md-3">
                    <div style="background:var(--c-card);border-radius:14px;border:1px solid var(--c-border);padding:16px 18px;">
                        <div style="width:36px;height:36px;border-radius:10px;background:{{ $s['bg'] }};display:flex;align-items:center;justify-content:center;color:{{ $s['color'] }};font-size:1rem;margin-bottom:10px;">
                            <i class="bi {{ $s['icon'] }}"></i>
                        </div>
                        <div style="font-family:'DM Serif Display',serif;font-size:1.6rem;color:{{ $s['color'] }};line-height:1;">{{ $s['val'] }}</div>
                        <div style="font-size:0.75rem;color:var(--c-muted);margin-top:4px;font-family:'Plus Jakarta Sans',sans-serif;">{{ $s['label'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Booking List --}}
            @foreach($bookings as $booking)
            <div class="booking-item">

                {{-- Header --}}
                <div class="booking-item-header">
                    <div>
                        <div class="booking-id">
                            Booking <b>#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</b>
                        </div>
                        <div class="booking-date">
                            Dibuat {{ $booking->created_at->diffForHumans() }} · {{ $booking->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        {{-- Payment Status --}}
                        @if($booking->pembayaran)
                            <span class="status-pill {{ $booking->pembayaran->status_bayar === 'lunas' ? 'sp-lunas' : 'sp-pending' }}">
                                <i class="bi {{ $booking->pembayaran->status_bayar === 'lunas' ? 'bi-check-circle-fill' : 'bi-clock' }}"></i>
                                {{ ucfirst($booking->pembayaran->status_bayar) }}
                            </span>
                        @else
                            <span class="status-pill sp-belum">
                                <i class="bi bi-dash-circle"></i>Belum Ada Pembayaran
                            </span>
                        @endif

                        {{-- Bukti Status --}}
                        @if($booking->buktiBayar)
                            <span class="status-pill sp-lunas">
                                <i class="bi bi-image-fill"></i>Bukti Terupload
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Body --}}
                <div class="booking-item-body">
                    {{-- Kos Image --}}
                    <div class="booking-kos-img">
                        @if($booking->kos->galeri->isNotEmpty())
                            <img src="{{ Storage::url($booking->kos->galeri->first()->foto) }}"
                                 alt="{{ $booking->kos->nama_kos }}">
                        @else
                            🏠
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="booking-info">
                        <div class="booking-kos-name">{{ $booking->kos->nama_kos }}</div>
                        <div class="booking-kos-location">
                            <i class="bi bi-geo-alt-fill"></i>
                            {{ $booking->kos->lokasi }}
                        </div>
                        <div class="booking-meta-grid">
                            <div class="meta-item">
                                <div class="meta-key">Tgl Masuk</div>
                                <div class="meta-val">{{ $booking->tanggal_masuk->format('d/m/Y') }}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-key">Durasi</div>
                                <div class="meta-val">{{ $booking->durasi_sewa }} Bulan</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-key">Harga/Bln</div>
                                <div class="meta-val accent">Rp {{ number_format($booking->kos->harga,0,',','.') }}</div>
                            </div>
                        </div>

                        {{-- Pembayaran info jika ada --}}
                        @if($booking->pembayaran)
                        <div style="margin-top:10px;padding:10px 12px;background:#F9F8F6;border-radius:10px;font-size:0.8rem;font-family:'Plus Jakarta Sans',sans-serif;">
                            <span style="color:var(--c-muted);">Total Tagihan:</span>
                            <strong style="color:var(--c-accent);margin-left:4px;">
                                Rp {{ number_format($booking->pembayaran->total_tagihan,0,',','.') }}
                            </strong>
                            <span style="color:var(--c-muted);margin-left:10px;">via {{ $booking->pembayaran->metode_bayar }}</span>
                        </div>
                        @endif

                        {{-- Inline upload form for pending without bukti --}}
                        @if(!$booking->buktiBayar)
                        <div class="inline-upload" id="upload-{{ $booking->id }}">
                            <form action="{{ route('client.booking.upload-bukti', $booking) }}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div style="font-size:0.8rem;font-weight:600;color:var(--c-ink);margin-bottom:8px;font-family:'Plus Jakarta Sans',sans-serif;">
                                    <i class="bi bi-upload me-1 text-danger"></i>Upload Bukti Pembayaran
                                </div>
                                <div style="display:flex;gap:8px;align-items:center;">
                                    <input type="file" name="file_bukti" required
                                           accept="image/jpg,image/jpeg,image/png"
                                           style="flex:1;border:1.5px solid var(--c-border);border-radius:8px;padding:7px 10px;font-family:'Plus Jakarta Sans',sans-serif;font-size:0.82rem;outline:none;">
                                    <button type="submit"
                                            style="background:var(--c-accent);color:white;border:none;border-radius:8px;padding:8px 16px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:0.82rem;white-space:nowrap;cursor:pointer;">
                                        <i class="bi bi-upload me-1"></i>Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Footer --}}
                <div class="booking-item-footer">
                    <div style="font-size:0.8rem;color:var(--c-muted);font-family:'Plus Jakarta Sans',sans-serif;">
                        <i class="bi bi-calendar-x me-1"></i>
                        Keluar: <strong>{{ \Carbon\Carbon::parse($booking->tanggal_masuk)->addMonths($booking->durasi_sewa)->format('d M Y') }}</strong>
                    </div>
                    <div class="d-flex gap-2">
                        @if(!$booking->buktiBayar)
                        <button type="button"
                                class="btn-sm-custom btn-sm-upload"
                                onclick="toggleUpload({{ $booking->id }})">
                            <i class="bi bi-upload"></i>Upload Bukti
                        </button>
                        @endif
                        <a href="{{ route('client.booking.success', $booking) }}"
                           class="btn-sm-custom btn-sm-detail">
                            <i class="bi bi-eye"></i>Detail
                        </a>
                    </div>
                </div>

            </div>
            @endforeach

            {{-- Pagination --}}
            @if($bookings->hasPages())
            <div class="d-flex justify-content-center mt-2">
                {{ $bookings->links() }}
            </div>
            @endif

        @endif

    </div>
</div>

@endsection

@push('scripts')
<script>
    function toggleUpload(id) {
        const el = document.getElementById('upload-' + id);
        el.classList.toggle('show');
    }
</script>
@endpush
