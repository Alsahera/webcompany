@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- ── Stat Cards ────────────────────────────────────────── --}}
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(26,86,219,0.1);color:#1A56DB;">
                <i class="bi bi-house-door-fill"></i>
            </div>
            <div>
                <div class="stat-number">{{ $stats['total_kos'] }}</div>
                <div class="stat-label">Total Kos</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(6,182,212,0.1);color:#06B6D4;">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <div>
                <div class="stat-number">{{ $stats['total_booking'] }}</div>
                <div class="stat-label">Total Booking</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(16,185,129,0.1);color:#10B981;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div>
                <div class="stat-number">{{ $stats['total_bayar'] }}</div>
                <div class="stat-label">Pembayaran Lunas</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(245,158,11,0.1);color:#F59E0B;">
                <i class="bi bi-clock-fill"></i>
            </div>
            <div>
                <div class="stat-number">{{ $stats['pending_bayar'] }}</div>
                <div class="stat-label">Menunggu Bayar</div>
            </div>
        </div>
    </div>
</div>

{{-- ── Quick Access ──────────────────────────────────────── --}}
<div class="row g-4 mb-4">
    @foreach([
        ['route'=>'kos.create',        'icon'=>'bi-plus-circle', 'label'=>'Tambah Kos',       'color'=>'#1A56DB'],
        ['route'=>'galeri.create',     'icon'=>'bi-image-fill',  'label'=>'Upload Foto',       'color'=>'#8B5CF6'],
        ['route'=>'booking.create',    'icon'=>'bi-calendar-plus','label'=>'Buat Booking',     'color'=>'#06B6D4'],
        ['route'=>'pembayaran.create', 'icon'=>'bi-credit-card-fill','label'=>'Catat Pembayaran','color'=>'#10B981'],
    ] as $q)
    <div class="col-xl-3 col-md-6">
        <a href="{{ route($q['route']) }}" class="text-decoration-none">
            <div class="stat-card" style="transition:all 0.2s;cursor:pointer;" onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <div class="stat-icon" style="background:{{ $q['color'] }}1A;color:{{ $q['color'] }};">
                    <i class="bi {{ $q['icon'] }}"></i>
                </div>
                <div>
                    <div style="font-weight:700;font-size:0.95rem;color:#0F172A;">{{ $q['label'] }}</div>
                    <div style="font-size:0.78rem;color:#64748B;">Klik untuk lanjut</div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

{{-- ── Tables ────────────────────────────────────────────── --}}
<div class="row g-4">

    {{-- Booking Terbaru --}}
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title">
                    <i class="bi bi-calendar-check text-primary"></i> Booking Terbaru
                </div>
                <a href="{{ route('booking.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Penyewa</th>
                            <th>Kos</th>
                            <th>Tgl Masuk</th>
                            <th>Durasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookingTerbaru as $b)
                        <tr>
                            <td>
                                <div style="font-weight:600;font-size:0.87rem;">{{ $b->user->name }}</div>
                                <div style="font-size:0.77rem;color:#64748B;">{{ $b->user->email }}</div>
                            </td>
                            <td>{{ $b->kos->nama_kos }}</td>
                            <td>{{ $b->tanggal_masuk->format('d/m/Y') }}</td>
                            <td><span class="badge bg-info text-white">{{ $b->durasi_sewa }} bln</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-4 d-block mb-2"></i>Belum ada booking
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pembayaran Terbaru --}}
    <div class="col-lg-5">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title">
                    <i class="bi bi-credit-card text-success"></i> Pembayaran Terbaru
                </div>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-outline-success">
                    Lihat Semua
                </a>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Kos</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayaranTerbaru as $p)
                        <tr>
                            <td style="font-size:0.87rem;">{{ $p->booking->kos->nama_kos }}</td>
                            <td style="font-size:0.87rem;font-weight:600;">
                                Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge-status {{ $p->status_bayar === 'lunas' ? 'badge-lunas' : 'badge-pending' }}">
                                    {{ ucfirst($p->status_bayar) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-4 d-block mb-2"></i>Belum ada data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection