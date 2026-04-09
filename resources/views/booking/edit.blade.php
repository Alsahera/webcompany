@extends('layouts.admin')

@section('title', 'Edit Booking')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('booking.index') }}">Data Booking</a></li>
    <li class="breadcrumb-item active">Edit Booking</li>
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title" style="color:#F59E0B;">
                    <i class="bi bi-pencil-square"></i> Edit Booking #{{ $booking->id }}
                </div>
                <a href="{{ route('booking.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="admin-card-body">

                @if($errors->any())
                <div class="alert alert-danger rounded-3 mb-4">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $e)
                            <li style="font-size:0.88rem;">{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('booking.update', $booking) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Penyewa <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                <option value="">— Pilih Penyewa —</option>
                                @foreach($userList as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id', $booking->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Pilih Kos <span class="text-danger">*</span></label>
                            <select name="kos_id" class="form-select @error('kos_id') is-invalid @enderror" required>
                                <option value="">— Pilih Kos —</option>
                                @foreach($kosList as $kos)
                                    <option value="{{ $kos->id }}"
                                        {{ old('kos_id', $booking->kos_id) == $kos->id ? 'selected' : '' }}>
                                        {{ $kos->nama_kos }} — Rp {{ number_format($kos->harga, 0, ',', '.') }}/bln
                                    </option>
                                @endforeach
                            </select>
                            @error('kos_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_masuk"
                                   class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                   value="{{ old('tanggal_masuk', $booking->tanggal_masuk->format('Y-m-d')) }}"
                                   required>
                            @error('tanggal_masuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Durasi Sewa (bulan) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="durasi_sewa"
                                       class="form-control @error('durasi_sewa') is-invalid @enderror"
                                       value="{{ old('durasi_sewa', $booking->durasi_sewa) }}"
                                       min="1" max="24" required>
                                <span class="input-group-text" style="background:#F8FAFC;border:1.5px solid #E2E8F0;border-left:none;">bulan</span>
                            </div>
                            @error('durasi_sewa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3" style="border-top:1px solid #E2E8F0;">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-floppy me-2"></i>Update Booking
                        </button>
                        <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
