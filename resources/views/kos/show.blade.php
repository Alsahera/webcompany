@extends('layouts.admin')

@section('title', 'Detail Kos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('kos.index') }}">Kelola Kos</a></li>
    <li class="breadcrumb-item active">{{ $kos->nama_kos }}</li>
@endsection

@section('content')

<div class="row g-4">
    {{-- Info Kos --}}
    <div class="col-lg-5">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title"><i class="bi bi-house-door text-primary"></i> Info Kos</div>
                <a href="{{ route('kos.edit', $kos) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
            </div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <div style="font-size:0.78rem;color:#64748B;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Nama Kos</div>
                    <div style="font-size:1.1rem;font-weight:700;margin-top:4px;">{{ $kos->nama_kos }}</div>
                </div>
                <div class="mb-3">
                    <div style="font-size:0.78rem;color:#64748B;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Harga / Bulan</div>
                    <div style="font-size:1.3rem;font-weight:800;color:#1A56DB;margin-top:4px;">
                        Rp {{ number_format($kos->harga, 0, ',', '.') }}
                    </div>
                </div>
                <div class="mb-3">
                    <div style="font-size:0.78rem;color:#64748B;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Lokasi</div>
                    <div style="margin-top:4px;font-size:0.9rem;">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $kos->lokasi }}
                    </div>
                </div>
                @if($kos->deskripsi)
                <div class="mb-3">
                    <div style="font-size:0.78rem;color:#64748B;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;">Deskripsi</div>
                    <div style="margin-top:4px;font-size:0.88rem;line-height:1.6;color:#374151;">{{ $kos->deskripsi }}</div>
                </div>
                @endif
                <div class="d-flex gap-3 pt-3" style="border-top:1px solid #E2E8F0;">
                    <div class="text-center">
                        <div style="font-size:1.4rem;font-weight:800;color:#8B5CF6;">{{ $kos->galeri->count() }}</div>
                        <div style="font-size:0.78rem;color:#64748B;">Foto</div>
                    </div>
                    <div class="text-center">
                        <div style="font-size:1.4rem;font-weight:800;color:#06B6D4;">{{ $kos->booking->count() }}</div>
                        <div style="font-size:0.78rem;color:#64748B;">Booking</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Galeri --}}
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title"><i class="bi bi-images text-purple" style="color:#8B5CF6;"></i> Galeri Foto</div>
                <a href="{{ route('galeri.create') }}" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Foto
                </a>
            </div>
            <div class="admin-card-body">
                @if($kos->galeri->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-image fs-1 d-block mb-2"></i>Belum ada foto
                    </div>
                @else
                    <div class="row g-2">
                        @foreach($kos->galeri as $foto)
                        <div class="col-4">
                            <div style="position:relative;border-radius:10px;overflow:hidden;aspect-ratio:1;">
                                <img src="{{ Storage::url($foto->foto) }}"
                                     alt="Foto Kos"
                                     style="width:100%;height:100%;object-fit:cover;">
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Riwayat Booking --}}
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title"><i class="bi bi-calendar-check text-info"></i> Riwayat Booking</div>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Penyewa</th>
                            <th>Tgl Masuk</th>
                            <th>Durasi</th>
                            <th>Status Bayar</th>
                            <th>Total Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kos->booking as $b)
                        <tr>
                            <td>{{ $b->user->name }}</td>
                            <td>{{ $b->tanggal_masuk->format('d/m/Y') }}</td>
                            <td>{{ $b->durasi_sewa }} bulan</td>
                            <td>
                                @if($b->pembayaran)
                                    <span class="badge-status {{ $b->pembayaran->status_bayar === 'lunas' ? 'badge-lunas' : 'badge-pending' }}">
                                        {{ ucfirst($b->pembayaran->status_bayar) }}
                                    </span>
                                @else
                                    <span class="badge-status badge-pending">Belum Ada</span>
                                @endif
                            </td>
                            <td>
                                @if($b->pembayaran)
                                    Rp {{ number_format($b->pembayaran->total_tagihan, 0, ',', '.') }}
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada booking untuk kos ini</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
