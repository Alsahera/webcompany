{{--
    View: client/booking-form.blade.php
    Form pemesanan kos oleh user
--}}

@extends('layouts.app')

@section('title', 'Pesan Kos — ' . $ko->nama_kos)

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
    .booking-hero {
        background: linear-gradient(135deg, var(--c-ink) 0%, #2D2D4A 100%);
        padding: 40px 0;
        position: relative;
        overflow: hidden;
    }
    .booking-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23fff' fill-opacity='0.03'%3E%3Cpath d='M20 20.5V18H0v5h5v5H0v5h20v-9.5zm-2 4.5h-1v-1h1v1zm-1-3h1v1h-1v-1zm-1 0h-1v-1h1v1z'/%3E%3C/g%3E%3C/svg%3E");
    }
    .step-indicator {
        display: flex;
        align-items: center;
        gap: 0;
        margin-bottom: 8px;
    }
    .step {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.78rem;
        font-weight: 600;
    }
    .step-dot {
        width: 28px; height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.72rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .step.active .step-dot { background: var(--c-accent); color: white; }
    .step.done .step-dot { background: #10B981; color: white; }
    .step:not(.active):not(.done) .step-dot { background: rgba(255,255,255,0.15); color: rgba(255,255,255,0.4); }
    .step.active span { color: white; }
    .step:not(.active) span { color: rgba(255,255,255,0.4); }
    .step-line {
        flex: 1;
        height: 2px;
        background: rgba(255,255,255,0.15);
        margin: 0 8px;
        max-width: 40px;
    }
    .step-line.done { background: #10B981; }

    /* Form Card */
    .form-section {
        background: var(--c-card);
        border-radius: 20px;
        border: 1px solid var(--c-border);
        overflow: hidden;
        margin-bottom: 20px;
    }
    .form-section-header {
        padding: 18px 24px;
        border-bottom: 1px solid var(--c-border);
        display: flex;
        align-items: center;
        gap: 12px;
        background: #FAFAF8;
    }
    .form-section-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        background: rgba(230,57,70,0.1);
        color: var(--c-accent);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .form-section-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--c-ink);
    }
    .form-section-body { padding: 24px; }

    /* Date input styling */
    .booking-input {
        border: 1.5px solid var(--c-border);
        border-radius: 12px;
        padding: 14px 16px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.92rem;
        color: var(--c-ink);
        width: 100%;
        transition: all 0.2s;
        outline: none;
    }
    .booking-input:focus {
        border-color: var(--c-accent);
        box-shadow: 0 0 0 3px rgba(230,57,70,0.08);
    }

    /* Durasi Buttons */
    .durasi-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 12px;
    }
    .durasi-chip {
        border: 1.5px solid var(--c-border);
        border-radius: 50px;
        padding: 8px 18px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--c-muted);
        cursor: pointer;
        transition: all 0.2s;
        background: transparent;
    }
    .durasi-chip.active {
        border-color: var(--c-accent);
        background: rgba(230,57,70,0.08);
        color: var(--c-accent);
    }
    .durasi-chip:hover { border-color: var(--c-accent); color: var(--c-accent); }

    /* Summary Sidebar */
    .summary-card {
        background: var(--c-card);
        border-radius: 20px;
        border: 1px solid var(--c-border);
        overflow: hidden;
        position: sticky;
        top: 80px;
    }
    .summary-header {
        background: linear-gradient(135deg, var(--c-ink), #2D2D4A);
        padding: 20px 22px;
        color: white;
    }
    .summary-kos-name {
        font-family: 'DM Serif Display', serif;
        font-size: 1.2rem;
        color: var(--c-gold);
        line-height: 1.2;
        margin-bottom: 4px;
    }
    .summary-body { padding: 20px 22px; }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px dashed var(--c-border);
        font-size: 0.87rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .summary-row:last-child { border-bottom: none; }
    .summary-row .key { color: var(--c-muted); }
    .summary-row .val { font-weight: 600; color: var(--c-ink); text-align: right; }
    .total-row {
        background: rgba(230,57,70,0.04);
        border: 1px solid rgba(230,57,70,0.12);
        border-radius: 12px;
        padding: 14px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
    }
    .total-key { font-size: 0.82rem; color: var(--c-muted); font-family: 'Plus Jakarta Sans', sans-serif; }
    .total-val {
        font-family: 'DM Serif Display', serif;
        font-size: 1.4rem;
        color: var(--c-accent);
    }

    .btn-pesan {
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
        cursor: pointer;
        margin-top: 16px;
        transition: all 0.2s;
    }
    .btn-pesan:hover {
        background: #C1121F;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(230,57,70,0.35);
    }
    .btn-back {
        display: block;
        width: 100%;
        background: transparent;
        color: var(--c-muted);
        border: 1.5px solid var(--c-border);
        border-radius: 14px;
        padding: 12px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        font-size: 0.88rem;
        text-align: center;
        text-decoration: none;
        margin-top: 8px;
        transition: all 0.2s;
    }
    .btn-back:hover { border-color: var(--c-accent); color: var(--c-accent); }

    /* Form label */
    .field-label {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--c-ink);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .field-label .req { color: var(--c-accent); }
</style>
@endpush

@section('content')

{{-- Hero --}}
<div class="booking-hero">
    <div class="container position-relative">
        <div class="step-indicator mb-4">
            <div class="step active">
                <span class="step-dot">1</span>
                <span>Detail Booking</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <span class="step-dot">2</span>
                <span>Konfirmasi</span>
            </div>
            <div class="step-line"></div>
            <div class="step">
                <span class="step-dot">3</span>
                <span>Selesai</span>
            </div>
        </div>
        <h2 style="font-family:'DM Serif Display',serif;font-size:1.8rem;color:white;margin:0;">
            Isi Detail <span style="color:var(--c-gold);">Pemesanan</span>
        </h2>
        <p style="color:rgba(255,255,255,0.55);font-size:0.88rem;margin-top:6px;font-family:'Plus Jakarta Sans',sans-serif;">
            Kamu sedang memesan: <strong style="color:rgba(255,255,255,0.85);">{{ $ko->nama_kos }}</strong>
        </p>
    </div>
</div>

{{-- Content --}}
<div style="background:var(--c-bg,#F7F5F0);padding:40px 0 80px;">
    <div class="container">

        @if($errors->any())
        <div class="alert alert-danger rounded-3 mb-4">
            <i class="bi bi-exclamation-triangle me-2"></i>
            @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
        </div>
        @endif

        <div class="row g-4">

            {{-- ── Form ── --}}
            <div class="col-lg-8">
                <form action="{{ route('client.booking.store', $ko) }}" method="POST" id="bookingForm">
                    @csrf

                    {{-- Pemesan Info --}}
                    <div class="form-section">
                        <div class="form-section-header">
                            <div class="form-section-icon"><i class="bi bi-person"></i></div>
                            <div>
                                <div class="form-section-title">Data Pemesan</div>
                                <div style="font-size:0.78rem;color:var(--c-muted);">Informasi akun kamu</div>
                            </div>
                        </div>
                        <div class="form-section-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="field-label">Nama Lengkap</div>
                                    <input type="text" class="booking-input" value="{{ Auth::user()->name }}" readonly
                                           style="background:#F9F8F6;color:var(--c-muted);">
                                </div>
                                <div class="col-md-6">
                                    <div class="field-label">Email</div>
                                    <input type="email" class="booking-input" value="{{ Auth::user()->email }}" readonly
                                           style="background:#F9F8F6;color:var(--c-muted);">
                                </div>
                            </div>
                            <div style="margin-top:12px;padding:10px 14px;background:rgba(16,185,129,0.05);border:1px solid rgba(16,185,129,0.15);border-radius:10px;font-size:0.8rem;color:#059669;font-family:'Plus Jakarta Sans',sans-serif;">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                Data diambil dari akun kamu yang sudah login.
                            </div>
                        </div>
                    </div>

                    {{-- Tanggal Masuk --}}
                    <div class="form-section">
                        <div class="form-section-header">
                            <div class="form-section-icon"><i class="bi bi-calendar3"></i></div>
                            <div>
                                <div class="form-section-title">Jadwal Sewa</div>
                                <div style="font-size:0.78rem;color:var(--c-muted);">Kapan kamu akan pindah masuk?</div>
                            </div>
                        </div>
                        <div class="form-section-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="field-label">
                                        Tanggal Masuk <span class="req">*</span>
                                    </div>
                                    <input type="date"
                                           name="tanggal_masuk"
                                           class="booking-input @error('tanggal_masuk') is-invalid @enderror"
                                           value="{{ old('tanggal_masuk', date('Y-m-d')) }}"
                                           min="{{ date('Y-m-d') }}"
                                           required
                                           onchange="updateSummary()">
                                    @error('tanggal_masuk')
                                        <div style="color:var(--c-accent);font-size:0.8rem;margin-top:4px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="field-label">Tanggal Keluar (estimasi)</div>
                                    <input type="text" class="booking-input" id="tglKeluar"
                                           value="—" readonly style="background:#F9F8F6;color:var(--c-muted);">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Durasi --}}
                    <div class="form-section">
                        <div class="form-section-header">
                            <div class="form-section-icon"><i class="bi bi-clock"></i></div>
                            <div>
                                <div class="form-section-title">Durasi Sewa</div>
                                <div style="font-size:0.78rem;color:var(--c-muted);">Berapa lama kamu akan tinggal?</div>
                            </div>
                        </div>
                        <div class="form-section-body">
                            <div class="field-label">Pilih Durasi <span class="req">*</span></div>

                            {{-- Quick chips --}}
                            <div class="durasi-chips">
                                @foreach([1,2,3,6,12] as $d)
                                <button type="button" class="durasi-chip {{ old('durasi_sewa', 1) == $d ? 'active' : '' }}"
                                        onclick="setDurasi({{ $d }}, this)">
                                    {{ $d }} Bulan
                                </button>
                                @endforeach
                            </div>

                            {{-- Custom input --}}
                            <div class="row g-3 align-items-center mt-1">
                                <div class="col-sm-6">
                                    <div style="display:flex;align-items:center;gap:0;">
                                        <input type="number"
                                               name="durasi_sewa"
                                               id="durasiInput"
                                               class="booking-input @error('durasi_sewa') is-invalid @enderror"
                                               value="{{ old('durasi_sewa', 1) }}"
                                               min="1" max="24" required
                                               oninput="updateSummary()"
                                               style="border-radius:12px 0 0 12px;flex:1;">
                                        <span style="background:#F1EFE9;border:1.5px solid var(--c-border);border-left:none;border-radius:0 12px 12px 0;padding:14px 14px;font-family:'Plus Jakarta Sans',sans-serif;font-size:0.88rem;color:var(--c-muted);white-space:nowrap;">
                                            bulan
                                        </span>
                                    </div>
                                    @error('durasi_sewa')
                                        <div style="color:var(--c-accent);font-size:0.8rem;margin-top:4px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <div style="background:#F9F8F6;border-radius:12px;padding:12px 16px;font-size:0.82rem;color:var(--c-muted);">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Maks. sewa 24 bulan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-pesan">
                        <i class="bi bi-check-circle me-2"></i>Konfirmasi Pemesanan
                    </button>
                    <a href="{{ route('client.kos.show', $ko) }}" class="btn-back">
                        <i class="bi bi-arrow-left me-1"></i>Kembali ke Detail Kos
                    </a>
                </form>
            </div>

            {{-- ── Summary Sidebar ── --}}
            <div class="col-lg-4">
                <div class="summary-card">
                    <div class="summary-header">
                        <div style="font-size:0.72rem;color:rgba(255,255,255,0.45);text-transform:uppercase;letter-spacing:0.07em;margin-bottom:4px;font-family:'Plus Jakarta Sans',sans-serif;">
                            Ringkasan Pemesanan
                        </div>
                        <div class="summary-kos-name">{{ $ko->nama_kos }}</div>
                        <div style="font-size:0.82rem;color:rgba(255,255,255,0.5);font-family:'Plus Jakarta Sans',sans-serif;">
                            <i class="bi bi-geo-alt me-1"></i>{{ Str::limit($ko->lokasi, 40) }}
                        </div>

                        {{-- Kos thumbnail --}}
                        @if($ko->galeri->isNotEmpty())
                        <div style="margin-top:12px;border-radius:10px;overflow:hidden;height:90px;">
                            <img src="{{ Storage::url($ko->galeri->first()->foto) }}"
                                 alt="{{ $ko->nama_kos }}"
                                 style="width:100%;height:100%;object-fit:cover;">
                        </div>
                        @endif
                    </div>

                    <div class="summary-body">
                        <div class="summary-row">
                            <span class="key">Harga / Bulan</span>
                            <span class="val">Rp {{ number_format($ko->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span class="key">Durasi Sewa</span>
                            <span class="val" id="summDurasi">1 Bulan</span>
                        </div>
                        <div class="summary-row">
                            <span class="key">Tgl Masuk</span>
                            <span class="val" id="summTglMasuk">{{ date('d/m/Y') }}</span>
                        </div>
                        <div class="summary-row">
                            <span class="key">Tgl Keluar</span>
                            <span class="val" id="summTglKeluar">—</span>
                        </div>
                        <div class="summary-row">
                            <span class="key">Pemesan</span>
                            <span class="val">{{ Str::limit(Auth::user()->name, 20) }}</span>
                        </div>

                        <div class="total-row">
                            <div class="total-key">Total Estimasi</div>
                            <div class="total-val" id="summTotal">Rp {{ number_format($ko->harga, 0, ',', '.') }}</div>
                        </div>

                        <div style="margin-top:12px;font-size:0.75rem;color:#9CA3AF;font-family:'Plus Jakarta Sans',sans-serif;line-height:1.6;">
                            <i class="bi bi-info-circle me-1"></i>
                            Nominal di atas adalah estimasi. Pembayaran aktual dikonfirmasi oleh admin setelah booking diproses.
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
    const harga = {{ $ko->harga }};

    function fmt(n) {
        return 'Rp ' + parseInt(n).toLocaleString('id-ID');
    }

    function setDurasi(d, btn) {
        document.querySelectorAll('.durasi-chip').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('durasiInput').value = d;
        updateSummary();
    }

    function updateSummary() {
        const durasi = parseInt(document.getElementById('durasiInput').value) || 1;
        const total  = harga * durasi;
        const tglMasukVal = document.querySelector('input[name="tanggal_masuk"]').value;

        // Update chips active state
        document.querySelectorAll('.durasi-chip').forEach(c => {
            c.classList.toggle('active', parseInt(c.textContent) === durasi);
        });

        // Tanggal keluar
        if (tglMasukVal) {
            const tgl = new Date(tglMasukVal);
            tgl.setMonth(tgl.getMonth() + durasi);
            const keluar = tgl.toLocaleDateString('id-ID', { day:'2-digit', month:'2-digit', year:'numeric' });
            document.getElementById('tglKeluar').value = keluar;
            document.getElementById('summTglKeluar').textContent = keluar;

            const masuk = new Date(tglMasukVal).toLocaleDateString('id-ID', { day:'2-digit', month:'2-digit', year:'numeric' });
            document.getElementById('summTglMasuk').textContent = masuk;
        }

        document.getElementById('summDurasi').textContent = `${durasi} Bulan`;
        document.getElementById('summTotal').textContent  = fmt(total);
    }

    // Init
    document.addEventListener('DOMContentLoaded', () => updateSummary());
</script>
@endpush
