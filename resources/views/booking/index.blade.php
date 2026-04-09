@extends('layouts.admin')

@section('title', 'Data Booking')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Booking</li>
@endsection

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title">
            <i class="bi bi-calendar-check text-info"></i> Daftar Booking
            <span class="badge bg-info text-white ms-1" style="font-size:0.75rem;">{{ $booking->total() }}</span>
        </div>
        <a href="{{ route('booking.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Buat Booking
        </a>
    </div>

    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Penyewa</th>
                    <th>Kos</th>
                    <th>Tgl Masuk</th>
                    <th>Durasi</th>
                    <th>Status Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($booking as $item)
                <tr>
                    <td class="text-muted">{{ $loop->iteration + ($booking->currentPage() - 1) * $booking->perPage() }}</td>
                    <td>
                        <div style="font-weight:600;font-size:0.87rem;">{{ $item->user->name }}</div>
                        <div style="font-size:0.77rem;color:#64748B;">{{ $item->user->email }}</div>
                    </td>
                    <td>
                        <div style="font-weight:600;font-size:0.87rem;">{{ $item->kos->nama_kos }}</div>
                        <div style="font-size:0.77rem;color:#64748B;">
                            <i class="bi bi-geo-alt text-danger" style="font-size:0.7rem;"></i>
                            {{ Str::limit($item->kos->lokasi, 30) }}
                        </div>
                    </td>
                    <td style="font-size:0.88rem;">{{ $item->tanggal_masuk->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge bg-secondary" style="font-size:0.75rem;">
                            {{ $item->durasi_sewa }} bulan
                        </span>
                    </td>
                    <td>
                        @if($item->pembayaran)
                            <span class="badge-status {{ $item->pembayaran->status_bayar === 'lunas' ? 'badge-lunas' : 'badge-pending' }}">
                                {{ ucfirst($item->pembayaran->status_bayar) }}
                            </span>
                        @else
                            <span class="badge-status badge-pending">Belum Dibayar</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('booking.show', $item) }}"
                               class="btn btn-sm btn-outline-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('booking.edit', $item) }}"
                               class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('booking.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('Hapus booking ini? Data pembayaran terkait juga akan terhapus.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-calendar-x fs-1 d-block mb-3"></i>
                        <div style="font-weight:600;margin-bottom:8px;">Belum ada data booking</div>
                        <a href="{{ route('booking.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-lg me-1"></i>Buat Booking Pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($booking->hasPages())
    <div class="admin-card-body pt-0">
        {{ $booking->links() }}
    </div>
    @endif
</div>

@endsection
