@extends('layouts.admin')

@section('title', 'Data Pembayaran')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Pembayaran</li>
@endsection

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title">
            <i class="bi bi-credit-card text-success"></i> Daftar Pembayaran
            <span class="badge bg-success ms-1" style="font-size:0.75rem;">{{ $pembayaran->total() }}</span>
        </div>
        <a href="{{ route('pembayaran.create') }}" class="btn btn-sm btn-success">
            <i class="bi bi-plus-lg me-1"></i>Tambah Pembayaran
        </a>
    </div>

    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Penyewa</th>
                    <th>Kos</th>
                    <th>Total Tagihan</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayaran as $item)
                <tr>
                    <td class="text-muted">{{ $loop->iteration + ($pembayaran->currentPage() - 1) * $pembayaran->perPage() }}</td>
                    <td>
                        <div style="font-weight:600;font-size:0.87rem;">{{ $item->booking->user->name }}</div>
                        <div style="font-size:0.77rem;color:#64748B;">{{ $item->booking->user->email }}</div>
                    </td>
                    <td style="font-size:0.87rem;">{{ $item->booking->kos->nama_kos }}</td>
                    <td>
                        <span style="font-weight:700;color:#1A56DB;font-size:0.9rem;">
                            Rp {{ number_format($item->total_tagihan, 0, ',', '.') }}
                        </span>
                    </td>
                    <td>
                        <span class="badge"
                              style="background:{{ $item->metode_bayar === 'Mandiri' ? '#005FCC' : ($item->metode_bayar === 'BCA' ? '#003D87' : '#0082C8') }}22;
                                     color:{{ $item->metode_bayar === 'Mandiri' ? '#005FCC' : ($item->metode_bayar === 'BCA' ? '#003D87' : '#0082C8') }};
                                     font-size:0.75rem;">
                            {{ $item->metode_bayar }}
                        </span>
                    </td>
                    <td>
                        <span class="badge-status {{ $item->status_bayar === 'lunas' ? 'badge-lunas' : 'badge-pending' }}">
                            {{ ucfirst($item->status_bayar) }}
                        </span>
                    </td>
                    <td>
                        @if($item->booking->buktiBayar)
                            <a href="{{ Storage::url($item->booking->buktiBayar->file_bukti) }}" target="_blank"
                               class="btn btn-xs btn-outline-primary"
                               style="padding:3px 8px;font-size:0.75rem;">
                                <i class="bi bi-image me-1"></i>Lihat
                            </a>
                        @else
                            <span style="font-size:0.78rem;color:#94A3B8;">—</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('pembayaran.show', $item) }}"
                               class="btn btn-sm btn-outline-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('pembayaran.edit', $item) }}"
                               class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('pembayaran.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('Hapus data pembayaran ini?')">
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
                    <td colspan="8" class="text-center py-5 text-muted">
                        <i class="bi bi-credit-card fs-1 d-block mb-3"></i>
                        <div style="font-weight:600;margin-bottom:8px;">Belum ada data pembayaran</div>
                        <a href="{{ route('pembayaran.create') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-plus-lg me-1"></i>Tambah Pembayaran
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pembayaran->hasPages())
    <div class="admin-card-body pt-0">
        {{ $pembayaran->links() }}
    </div>
    @endif
</div>

@endsection
