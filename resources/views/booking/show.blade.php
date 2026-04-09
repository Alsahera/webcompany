@extends('layouts.admin')

@section('title', 'Detail Booking')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('booking.index') }}">Data Booking</a></li>
    <li class="breadcrumb-item active">Detail #{{ $booking->id }}</li>
@endsection

@section('content')

<div class="row g-4">
    {{-- Info Booking --}}
    <div class="col-lg-5">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title text-info">
                    <i class="bi bi-calendar-check"></i> Detail Booking #{{ $booking->id }}
                </div>
                <a href="{{ route('booking.edit', $booking) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
            </div>
            <div class="admin-card-body">
                <table class="table table-borderless" style="font-size:0.88rem;">
                    <tr>
                        <td class="text-muted" style="width:120px;">Penyewa</td>
                        <td><strong>{{ $booking->user->name }}</strong><br>
                            <span style="font-size:0.78rem;color:#94A3B8;">{{ $booking->user->email }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kos</td>
                        <td><strong>{{ $booking->kos->nama_kos }}</strong><br>
                            <span style="font-size:0.78rem;color:#94A3B8;">{{ $booking->kos->lokasi }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tgl Masuk</td>
                        <td><strong>{{ $booking->tanggal_masuk->format('d F Y') }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Durasi</td>
                        <td><span class="badge bg-info text-white">{{ $booking->durasi_sewa }} Bulan</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tgl Keluar</td>
                        <td><strong>{{ $booking->tanggal_masuk->addMonths($booking->durasi_sewa)->format('d F Y') }}</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status</td>
                        <td>
                            @if($booking->pembayaran)
                                <span class="badge-status {{ $booking->pembayaran->status_bayar === 'lunas' ? 'badge-lunas' : 'badge-pending' }}">
                                    {{ ucfirst($booking->pembayaran->status_bayar) }}
                                </span>
                            @else
                                <span class="badge-status badge-pending">Belum Ada Pembayaran</span>
                            @endif
                        </td>
                    </tr>
                </table>

                @if(!$booking->pembayaran)
                <a href="{{ route('pembayaran.create') }}" class="btn btn-success btn-sm w-100 mt-2">
                    <i class="bi bi-plus-lg me-1"></i>Buat Pembayaran
                </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Info Pembayaran --}}
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title text-success">
                    <i class="bi bi-credit-card"></i> Data Pembayaran
                </div>
                @if($booking->pembayaran)
                <a href="{{ route('pembayaran.edit', $booking->pembayaran) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
                @endif
            </div>
            <div class="admin-card-body">
                @if($booking->pembayaran)
                    @php $p = $booking->pembayaran; @endphp
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div style="font-size:0.75rem;color:#64748B;font-weight:600;text-transform:uppercase;">Total Tagihan</div>
                            <div style="font-size:1.5rem;font-weight:800;color:#1A56DB;margin-top:4px;">
                                Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="font-size:0.75rem;color:#64748B;font-weight:600;text-transform:uppercase;">Metode Bayar</div>
                            <div style="font-size:1.1rem;font-weight:700;margin-top:4px;">{{ $p->metode_bayar }}</div>
                        </div>
                        <div class="col-6">
                            <div style="font-size:0.75rem;color:#64748B;font-weight:600;text-transform:uppercase;">Status</div>
                            <div style="margin-top:4px;">
                                <span class="badge-status {{ $p->status_bayar === 'lunas' ? 'badge-lunas' : 'badge-pending' }}">
                                    {{ ucfirst($p->status_bayar) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="font-size:0.75rem;color:#64748B;font-weight:600;text-transform:uppercase;">Tgl Bayar</div>
                            <div style="font-size:0.88rem;margin-top:4px;">{{ $p->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>

                    {{-- Bukti Bayar --}}
                    <div style="border-top:1px solid #E2E8F0;padding-top:16px;">
                        <div style="font-size:0.82rem;font-weight:700;color:#374151;margin-bottom:10px;">
                            BUKTI PEMBAYARAN
                        </div>
                        @if($booking->buktiBayar)
                            <img src="{{ Storage::url($booking->buktiBayar->file_bukti) }}"
                                 alt="Bukti Bayar"
                                 style="max-height:200px;border-radius:10px;border:1px solid #E2E8F0;cursor:pointer;"
                                 onclick="window.open(this.src,'_blank')">
                            <div style="font-size:0.75rem;color:#94A3B8;margin-top:6px;">
                                <i class="bi bi-zoom-in me-1"></i>Klik untuk perbesar
                            </div>
                        @else
                            <div class="text-muted" style="font-size:0.87rem;">
                                <i class="bi bi-image me-1"></i>Belum ada bukti bayar
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-credit-card fs-1 d-block mb-3"></i>
                        <div style="font-weight:600;margin-bottom:8px;">Belum ada data pembayaran</div>
                        <a href="{{ route('pembayaran.create') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-plus-lg me-1"></i>Buat Pembayaran
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
