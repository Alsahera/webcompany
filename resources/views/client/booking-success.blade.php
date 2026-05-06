{{--
    View: client/booking-success.blade.php
    Halaman sukses setelah booking berhasil dibuat
--}}

@extends('layouts.app')

@section('title', 'Booking Berhasil!')

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

    .success-hero {
        background: linear-gradient(135deg, #064E3B 0%, #065F46 100%);
        padding: 64px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .success-hero::before {
        content: '';
        position: absolute;
        top: -80px; left: -80px;
        width: 300px; height: 300px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }
    .success-hero::after {
        content: '';
        position: absolute;
        bottom: -60px; right: -60px;
        width: 250px; height: 250px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }
    .success-icon-wrap {
        width: 80px; height: 80px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        margin: 0 auto 20px;
        border: 2px solid rgba(255,255,255,0.2);
        animation: pop-in 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
    }
    @keyframes pop-in {
        from { transform: scale(0); opacity: 0; }
        to   { transform: scale(1); opacity: 1; }
    }
    .success-title {
        font-family: 'DM Serif Display', serif;
        font-size: 2.2rem;
        color: white;
        margin-bottom: 8px;
        animation: fadeInUp 0.5s 0.2s ease both;
    }
    .success-sub {
        color: rgba(255,255,255,0.65);
        font-size: 0.95rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        animation: fadeInUp 0.5s 0.3s ease both;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Booking ID Badge */
    .booking-id-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 50px;
        padding: 8px 20px;
        color: rgba(255,255,255,0.85);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        margin-top: 16px;
        letter-spacing: 0.04em;
        animation: fadeInUp 0.5s 0.4s ease both;
    }

    /* Detail Card */
    .detail-card {
        background: var(--c-card);
        border-radius: 20px;
        border: 1px solid var(--c-border);
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(26,26,46,0.06);
    }
    .detail-card-head {
        background: linear-gradient(to right, #F9F8F6, var(--c-card));
        padding: 20px 24px;
        border-bottom: 1px solid var(--c-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
    .detail-card-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--c-ink);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .detail-card-title i { color: var(--c-accent); }
    .detail-card-body { padding: 20px 24px; }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #F3F0EB;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.88rem;
    }
    .info-row:last-child { border-bottom: none; }
    .info-row .key { color: var(--c-muted); }
    .info-row .val { font-weight: 600; color: var(--c-ink); text-align: right; }

    /* Status badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .status-pending {
        background: rgba(245,158,11,0.1);
        color: #D97706;
        border: 1px solid rgba(245,158,11,0.2);
    }
    .status-lunas {
        background: rgba(5,150,105,0.1);
        color: var(--c-green);
        border: 1px solid rgba(5,150,105,0.2);
    }

    /* Upload Bukti Card */
    .upload-zone {
        border: 2px dashed var(--c-border);
        border-radius: 14px;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #FAFAF8;
    }
    .upload-zone:hover {
        border-color: var(--c-accent);
        background: rgba(230,57,70,0.02);
    }
    .upload-zone.has-file {
        border-color: var(--c-green);
        background: rgba(5,150,105,0.03);
    }
    #previewBukti {
        max-height: 180px;
        border-radius: 10px;
        border: 1px solid var(--c-border);
        margin-top: 12px;
        display: none;
    }

    /* Action Buttons */
    .btn-primary-custom {
        background: var(--c-accent);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-primary-custom:hover { background: #C1121F; color: white; transform: translateY(-1px); }

    .btn-secondary-custom {
        background: white;
        color: var(--c-ink);
        border: 1.5px solid var(--c-border);
        border-radius: 12px;
        padding: 12px 24px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-secondary-custom:hover { border-color: var(--c-accent); color: var(--c-accent); }

    /* Step guide */
    .step-guide {
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    .guide-step {
        display: flex;
        gap: 16px;
        position: relative;
        padding-bottom: 24px;
    }
    .guide-step::before {
        content: '';
        position: absolute;
        left: 18px;
        top: 36px;
        bottom: 0;
        width: 2px;
        background: var(--c-border);
    }
    .guide-step:last-child::before { display: none; }
    .guide-step:last-child { padding-bottom: 0; }
    .guide-dot {
        width: 36px; height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        font-weight: 700;
        flex-shrink: 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
        z-index: 1;
    }
    .guide-dot.done  { background: var(--c-green); color: white; }
    .guide-dot.active { background: var(--c-accent); color: white; }
    .guide-dot.todo  { background: var(--c-border); color: var(--c-muted); }
    .guide-content { flex: 1; padding-top: 6px; }
    .guide-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--c-ink);
        margin-bottom: 3px;
    }
    .guide-desc {
        font-size: 0.8rem;
        color: var(--c-muted);
        line-height: 1.5;
    }
</style>
@endpush

@section('content')

{{-- Success Hero --}}
<div class="success-hero">
    <div class="container position-relative">
        <div class="success-icon-wrap">
            <i class="bi bi-check-lg" style="color:#34D399;"></i>
        </div>
        <h1 class="success-title">Booking Berhasil! 🎉</h1>
        <p class="success-sub">
            Pemesananmu untuk <strong style="color:white;">{{ $booking->kos->nama_kos }}</strong> telah diterima.
        </p>
        <div class="d-flex justify-content-center">
            <div class="booking-id-badge">
                <i class="bi bi-hash"></i>
                ID Booking: {{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
            </div>
        </div>
    </div>
</div>

{{-- Content --}}
<div style="background:var(--c-bg,#F7F5F0);padding:40px 0 80px;">
    <div class="container">
        <div class="row g-4">

            {{-- ── LEFT: Booking Details + Upload ── --}}
            <div class="col-lg-8">

                {{-- Booking Detail --}}
                <div class="detail-card mb-4">
                    <div class="detail-card-head">
                        <div class="detail-card-title">
                            <i class="bi bi-calendar-check"></i>Detail Pemesanan
                        </div>
                        <div class="status-badge status-pending">
                            <i class="bi bi-clock"></i>
                            Menunggu Konfirmasi Admin
                        </div>
                    </div>
                    <div class="detail-card-body">
                        @php
                            $tglKeluar = \Carbon\Carbon::parse($booking->tanggal_masuk)->addMonths($booking->durasi_sewa);
                        @endphp
                        <div class="info-row">
                            <span class="key"><i class="bi bi-house me-2 text-muted"></i>Nama Kos</span>
                            <span class="val">{{ $booking->kos->nama_kos }}</span>
                        </div>
                        <div class="info-row">
                            <span class="key"><i class="bi bi-geo-alt me-2 text-muted"></i>Lokasi</span>
                            <span class="val">{{ $booking->kos->lokasi }}</span>
                        </div>
                        <div class="info-row">
                            <span class="key"><i class="bi bi-calendar me-2 text-muted"></i>Tanggal Masuk</span>
                            <span class="val">{{ $booking->tanggal_masuk->format('d F Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="key"><i class="bi bi-calendar-x me-2 text-muted"></i>Tanggal Keluar</span>
                            <span class="val">{{ $tglKeluar->format('d F Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="key"><i class="bi bi-clock me-2 text-muted"></i>Durasi Sewa</span>
                            <span class="val">{{ $booking->durasi_sewa }} Bulan</span>
                        </div>
                        <div class="info-row">
                            <span class="key"><i class="bi bi-person me-2 text-muted"></i>Pemesan</span>
                            <span class="val">{{ $booking->user->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="key"><i class="bi bi-envelope me-2 text-muted"></i>Email</span>
                            <span class="val">{{ $booking->user->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="key"><i class="bi bi-tag me-2 text-muted"></i>Harga / Bulan</span>
                            <span class="val" style="color:var(--c-accent);font-family:'DM Serif Display',serif;font-size:1.1rem;">
                                Rp {{ number_format($booking->kos->harga, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="key"><i class="bi bi-calculator me-2 text-muted"></i>Total Estimasi</span>
                            <span class="val" style="color:var(--c-accent);font-family:'DM Serif Display',serif;font-size:1.2rem;">
                                Rp {{ number_format($booking->kos->harga * $booking->durasi_sewa, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Upload Bukti Bayar --}}
                <div class="detail-card mb-4">
                    <div class="detail-card-head">
                        <div class="detail-card-title">
                            <i class="bi bi-upload"></i>Upload Bukti Pembayaran
                        </div>
                        @if($booking->buktiBayar)
                            <span class="status-badge status-lunas">
                                <i class="bi bi-check-circle"></i>Sudah Diupload
                            </span>
                        @else
                            <span class="status-badge status-pending">
                                <i class="bi bi-clock"></i>Belum Ada
                            </span>
                        @endif
                    </div>
                    <div class="detail-card-body">
                        @if(session('success'))
                        <div class="alert rounded-3 mb-3" style="background:rgba(5,150,105,0.08);border:1px solid rgba(5,150,105,0.2);color:#065F46;font-size:0.88rem;">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        </div>
                        @endif

                        @if($booking->pembayaran)
                        <div class="mb-3 p-3 rounded-3" style="background:#F0FDF4;border:1px solid #BBF7D0;">
                            <div style="font-size:0.82rem;color:#065F46;font-weight:600;margin-bottom:4px;">
                                <i class="bi bi-credit-card me-1"></i>Data Pembayaran
                            </div>
                            <div style="font-size:0.88rem;color:#374151;">
                                Metode: <strong>{{ $booking->pembayaran->metode_bayar }}</strong> &nbsp;|&nbsp;
                                Total: <strong>Rp {{ number_format($booking->pembayaran->total_tagihan,0,',','.') }}</strong> &nbsp;|&nbsp;
                                Status:
                                <span class="status-badge {{ $booking->pembayaran->status_bayar === 'lunas' ? 'status-lunas' : 'status-pending' }}">
                                    {{ ucfirst($booking->pembayaran->status_bayar) }}
                                </span>
                            </div>
                        </div>
                        @endif

                        @if($booking->buktiBayar)
                            <div class="mb-3">
                                <div style="font-size:0.8rem;color:var(--c-muted);margin-bottom:8px;font-weight:600;">Bukti yang sudah diupload:</div>
                                <img src="{{ Storage::url($booking->buktiBayar->file_bukti) }}"
                                     alt="Bukti Bayar"
                                     style="max-height:200px;border-radius:12px;border:1px solid var(--c-border);cursor:zoom-in;"
                                     onclick="window.open(this.src,'_blank')">
                            </div>
                        @endif

                        <form action="{{ route('client.booking.upload-bukti', $booking) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="upload-zone" id="uploadZone"
                                 onclick="document.getElementById('buktiInput').click()">
                                <i class="bi bi-cloud-upload" style="font-size:2rem;color:#9CA3AF;display:block;margin-bottom:8px;"></i>
                                <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:0.88rem;font-weight:600;color:var(--c-ink);margin-bottom:4px;">
                                    {{ $booking->buktiBayar ? 'Ganti Bukti Pembayaran' : 'Upload Bukti Pembayaran' }}
                                </div>
                                <div style="font-size:0.78rem;color:#9CA3AF;">
                                    Klik atau drag & drop • JPG, JPEG, PNG • Maks. 2MB
                                </div>
                                <img id="previewBukti" src="#" alt="Preview">
                            </div>
                            <input type="file" id="buktiInput" name="file_bukti"
                                   accept="image/jpg,image/jpeg,image/png"
                                   style="display:none;" required
                                   onchange="previewUpload(this)">
                            @error('file_bukti')
                                <div style="color:var(--c-accent);font-size:0.8rem;margin-top:4px;">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn-primary-custom mt-3 w-100 justify-content-center">
                                <i class="bi bi-upload"></i>
                                {{ $booking->buktiBayar ? 'Perbarui Bukti Bayar' : 'Upload Bukti Bayar' }}
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('client.my-bookings') }}" class="btn-primary-custom">
                        <i class="bi bi-list-ul"></i>Riwayat Booking Saya
                    </a>
                    <a href="{{ route('client.kos') }}" class="btn-secondary-custom">
                        <i class="bi bi-search"></i>Cari Kos Lagi
                    </a>
                </div>
            </div>

            {{-- ── RIGHT: Next Steps ── --}}
            <div class="col-lg-4">
                <div class="detail-card">
                    <div class="detail-card-head">
                        <div class="detail-card-title">
                            <i class="bi bi-list-check"></i>Langkah Selanjutnya
                        </div>
                    </div>
                    <div class="detail-card-body">
                        <div class="step-guide">
                            <div class="guide-step">
                                <div class="guide-dot done">✓</div>
                                <div class="guide-content">
                                    <div class="guide-title">Booking Dibuat</div>
                                    <div class="guide-desc">Pemesananmu berhasil masuk ke sistem kami.</div>
                                </div>
                            </div>
                            <div class="guide-step">
                                <div class="guide-dot {{ $booking->buktiBayar ? 'done' : 'active' }}">
                                    {{ $booking->buktiBayar ? '✓' : '2' }}
                                </div>
                                <div class="guide-content">
                                    <div class="guide-title">Upload Bukti Bayar</div>
                                    <div class="guide-desc">Upload bukti transfer/pembayaran ke formulir di sebelah kiri.</div>
                                </div>
                            </div>
                            <div class="guide-step">
                                <div class="guide-dot {{ $booking->pembayaran && $booking->pembayaran->status_bayar === 'lunas' ? 'done' : 'todo' }}">
                                    {{ $booking->pembayaran && $booking->pembayaran->status_bayar === 'lunas' ? '✓' : '3' }}
                                </div>
                                <div class="guide-content">
                                    <div class="guide-title">Verifikasi Admin</div>
                                    <div class="guide-desc">Admin akan memverifikasi pembayaranmu dalam 1×24 jam.</div>
                                </div>
                            </div>
                            <div class="guide-step">
                                <div class="guide-dot todo">4</div>
                                <div class="guide-content">
                                    <div class="guide-title">Pindah Masuk</div>
                                    <div class="guide-desc">Setelah konfirmasi, kamu bisa pindah pada tanggal yang disepakati.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="detail-card mt-4">
                    <div class="detail-card-body" style="padding:20px;">
                        <div style="font-size:0.85rem;font-weight:700;color:var(--c-ink);margin-bottom:12px;font-family:'Plus Jakarta Sans',sans-serif;">
                            <i class="bi bi-question-circle text-primary me-2"></i>Butuh Bantuan?
                        </div>
                        <p style="font-size:0.82rem;color:var(--c-muted);line-height:1.6;margin-bottom:12px;">
                            Jika ada pertanyaan seputar booking atau pembayaran, hubungi kami melalui:
                        </p>
                        <a href="{{ route('contact') }}" style="font-size:0.85rem;color:var(--c-accent);font-weight:600;text-decoration:none;display:flex;align-items:center;gap:6px;">
                            <i class="bi bi-envelope"></i>Halaman Kontak
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function previewUpload(input) {
        if (input.files && input.files[0]) {
            const zone = document.getElementById('uploadZone');
            const img  = document.getElementById('previewBukti');
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                img.style.display = 'block';
                zone.classList.add('has-file');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
