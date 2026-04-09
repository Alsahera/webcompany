@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pembayaran.index') }}">Data Pembayaran</a></li>
    <li class="breadcrumb-item active">Detail #{{ $pembayaran->id }}</li>
@endsection

@section('content')

<div class="row g-4 justify-content-center">
    <div class="col-lg-8">

        {{-- Detail Pembayaran --}}
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <div class="admin-card-title text-success">
                    <i class="bi bi-receipt"></i> Detail Pembayaran #{{ $pembayaran->id }}
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('pembayaran.edit', $pembayaran) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <form action="{{ route('pembayaran.destroy', $pembayaran) }}" method="POST"
                          onsubmit="return confirm('Hapus data pembayaran ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
            <div class="admin-card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div style="font-size:0.75rem;color:#64748B;font-weight:700;text-transform:uppercase;margin-bottom:12px;">
                            INFO BOOKING
                        </div>
                        <table class="table table-borderless table-sm" style="font-size:0.88rem;">
                            <tr>
                                <td class="text-muted" style="width:110px;">Penyewa</td>
                                <td><strong>{{ $pembayaran->booking->user->name }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Email</td>
                                <td>{{ $pembayaran->booking->user->email }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Kos</td>
                                <td><strong>{{ $pembayaran->booking->kos->nama_kos }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Lokasi</td>
                                <td>{{ $pembayaran->booking->kos->lokasi }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tgl Masuk</td>
                                <td>{{ $pembayaran->booking->tanggal_masuk->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Durasi</td>
                                <td>{{ $pembayaran->booking->durasi_sewa }} Bulan</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div style="font-size:0.75rem;color:#64748B;font-weight:700;text-transform:uppercase;margin-bottom:12px;">
                            INFO PEMBAYARAN
                        </div>

                        <div class="mb-3 p-3 rounded-3" style="background:#F0FDF4;border:1px solid #BBF7D0;">
                            <div style="font-size:0.78rem;color:#166534;">Total Tagihan</div>
                            <div style="font-size:1.8rem;font-weight:900;color:#16A34A;">
                                Rp {{ number_format($pembayaran->total_tagihan, 0, ',', '.') }}
                            </div>
                        </div>

                        <table class="table table-borderless table-sm" style="font-size:0.88rem;">
                            <tr>
                                <td class="text-muted" style="width:110px;">Metode</td>
                                <td>
                                    <span class="badge" style="background:#E0F2FE;color:#0369A1;font-size:0.82rem;">
                                        {{ $pembayaran->metode_bayar }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Status</td>
                                <td>
                                    <span class="badge-status {{ $pembayaran->status_bayar === 'lunas' ? 'badge-lunas' : 'badge-pending' }}">
                                        {{ ucfirst($pembayaran->status_bayar) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Tgl Input</td>
                                <td>{{ $pembayaran->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bukti Bayar --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title" style="color:#8B5CF6;">
                    <i class="bi bi-image"></i> Bukti Pembayaran
                </div>
            </div>
            <div class="admin-card-body">
                @if($pembayaran->booking->buktiBayar)
                    <img src="{{ Storage::url($pembayaran->booking->buktiBayar->file_bukti) }}"
                         alt="Bukti Pembayaran"
                         style="max-height:300px;border-radius:12px;border:1px solid #E2E8F0;cursor:zoom-in;"
                         onclick="window.open(this.src,'_blank')">
                    <div style="font-size:0.78rem;color:#94A3B8;margin-top:8px;">
                        <i class="bi bi-zoom-in me-1"></i>Klik gambar untuk memperbesar
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-image fs-2 d-block mb-2"></i>
                        <div style="font-size:0.88rem;">Belum ada bukti pembayaran diunggah.</div>
                        <a href="{{ route('pembayaran.edit', $pembayaran) }}" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="bi bi-upload me-1"></i>Upload Bukti
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
