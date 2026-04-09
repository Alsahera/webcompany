@extends('layouts.admin')

@section('title', 'Kelola Kos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kelola Kos</li>
@endsection

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title">
            <i class="bi bi-house-door text-primary"></i> Daftar Kos
            <span class="badge bg-primary ms-1" style="font-size:0.75rem;">{{ $kos->total() }}</span>
        </div>
        <a href="{{ route('kos.create') }}" class="btn btn-primary btn-sm px-3">
            <i class="bi bi-plus-lg me-1"></i>Tambah Kos
        </a>
    </div>

    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Nama Kos</th>
                    <th>Lokasi</th>
                    <th>Harga/Bulan</th>
                    <th>Foto</th>
                    <th>Booking</th>
                    <th style="width:150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kos as $item)
                <tr>
                    <td class="text-muted">{{ $loop->iteration + ($kos->currentPage() - 1) * $kos->perPage() }}</td>
                    <td>
                        <div style="font-weight:600;">{{ $item->nama_kos }}</div>
                        <div style="font-size:0.78rem;color:#64748B;margin-top:2px;">
                            {{ Str::limit($item->deskripsi, 50) }}
                        </div>
                    </td>
                    <td>
                        <i class="bi bi-geo-alt text-danger me-1" style="font-size:0.85rem;"></i>
                        {{ $item->lokasi }}
                    </td>
                    <td>
                        <span style="font-weight:700;color:#1A56DB;">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-secondary" style="font-size:0.75rem;">
                            {{ $item->galeri_count }} foto
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-info text-white" style="font-size:0.75rem;">
                            {{ $item->booking_count }} booking
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('kos.show', $item) }}"
                               class="btn btn-sm btn-outline-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('kos.edit', $item) }}"
                               class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('kos.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus kos ini? Semua data terkait (galeri, booking) juga akan terhapus.')">
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
                    <td colspan="7" class="text-center py-5">
                        <div style="color:#94A3B8;">
                            <i class="bi bi-house-x fs-1 d-block mb-3"></i>
                            <div style="font-weight:600;margin-bottom:8px;">Belum ada data kos</div>
                            <a href="{{ route('kos.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg me-1"></i>Tambah Kos Pertama
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($kos->hasPages())
    <div class="admin-card-body pt-0">
        {{ $kos->links() }}
    </div>
    @endif
</div>

@endsection
