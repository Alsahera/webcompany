@extends('layouts.admin')

@section('title', 'Edit Kos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('kos.index') }}">Kelola Kos</a></li>
    <li class="breadcrumb-item active">Edit Kos</li>
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title">
                    <i class="bi bi-pencil-square text-warning"></i>
                    Edit Kos — <span style="color:#64748B;font-weight:400;">{{ $kos->nama_kos }}</span>
                </div>
                <a href="{{ route('kos.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="admin-card-body">

                @if($errors->any())
                <div class="alert alert-danger rounded-3 mb-4">
                    <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle me-2"></i>Terdapat kesalahan:</div>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $e)
                            <li style="font-size:0.88rem;">{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('kos.update', $kos) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Kos <span class="text-danger">*</span></label>
                            <input type="text" name="nama_kos"
                                   class="form-control @error('nama_kos') is-invalid @enderror"
                                   value="{{ old('nama_kos', $kos->nama_kos) }}"
                                   required>
                            @error('nama_kos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Harga per Bulan (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius:8px 0 0 8px;border:1.5px solid #E2E8F0;background:#F8FAFC;">Rp</span>
                                <input type="number" name="harga"
                                       class="form-control @error('harga') is-invalid @enderror"
                                       value="{{ old('harga', $kos->harga) }}"
                                       min="0" required style="border-radius:0 8px 8px 0;">
                            </div>
                            @error('harga')<div class="text-danger mt-1" style="font-size:0.82rem;">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius:8px 0 0 8px;border:1.5px solid #E2E8F0;background:#F8FAFC;">
                                    <i class="bi bi-geo-alt text-danger"></i>
                                </span>
                                <input type="text" name="lokasi"
                                       class="form-control @error('lokasi') is-invalid @enderror"
                                       value="{{ old('lokasi', $kos->lokasi) }}"
                                       required style="border-radius:0 8px 8px 0;">
                            </div>
                            @error('lokasi')<div class="text-danger mt-1" style="font-size:0.82rem;">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      rows="4">{{ old('deskripsi', $kos->deskripsi) }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3" style="border-top:1px solid #E2E8F0;">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-floppy me-2"></i>Update Kos
                        </button>
                        <a href="{{ route('kos.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
