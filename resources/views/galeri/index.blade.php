@extends('layouts.admin')

@section('title', 'Galeri Foto')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Galeri Foto</li>
@endsection

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <div class="admin-card-title">
            <i class="bi bi-images" style="color:#8B5CF6;"></i> Galeri Foto Kos
            <span class="badge ms-1" style="background:#8B5CF6;font-size:0.75rem;">{{ $galeri->total() }}</span>
        </div>
        <a href="{{ route('galeri.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-upload me-1"></i>Upload Foto
        </a>
    </div>

    <div class="admin-card-body">
        @if($galeri->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="bi bi-image-alt fs-1 d-block mb-3"></i>
                <div style="font-weight:600;margin-bottom:8px;">Belum ada foto</div>
                <a href="{{ route('galeri.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-upload me-1"></i>Upload Foto Pertama
                </a>
            </div>
        @else
        <div class="row g-3">
            @foreach($galeri as $item)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="position-relative" style="border-radius:12px;overflow:hidden;border:1px solid #E2E8F0;">
                    {{-- Foto --}}
                    <div style="aspect-ratio:1;background:#F1F5F9;">
                        <img src="{{ Storage::url($item->foto) }}"
                             alt="Foto Kos"
                             style="width:100%;height:100%;object-fit:cover;display:block;"
                             loading="lazy">
                    </div>
                    {{-- Info + Aksi --}}
                    <div style="padding:10px 12px;background:white;">
                        <div style="font-size:0.78rem;font-weight:600;margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ $item->kos->nama_kos }}
                        </div>
                        <div style="font-size:0.7rem;color:#64748B;">
                            {{ $item->created_at->format('d/m/Y') }}
                        </div>
                        <div class="d-flex gap-1 mt-2">
                            <a href="{{ route('galeri.edit', $item) }}"
                               class="btn btn-xs btn-outline-warning flex-fill"
                               style="padding:3px 6px;font-size:0.75rem;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('galeri.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('Hapus foto ini?')" style="flex:1;">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="btn btn-xs btn-outline-danger w-100"
                                        style="padding:3px 6px;font-size:0.75rem;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4">{{ $galeri->links() }}</div>
        @endif
    </div>
</div>

@endsection
