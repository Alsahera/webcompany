@extends('layouts.admin')

@section('title', 'Edit Pembayaran')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pembayaran.index') }}">Data Pembayaran</a></li>
    <li class="breadcrumb-item active">Edit #{{ $pembayaran->id }}</li>
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title" style="color:#F59E0B;">
                    <i class="bi bi-pencil-square"></i> Edit Pembayaran #{{ $pembayaran->id }}
                </div>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="admin-card-body">

                {{-- Info Booking --}}
                <div class="p-3 rounded-3 mb-4" style="background:#F8FAFC;border:1px solid #E2E8F0;">
                    <div style="font-size:0.78rem;font-weight:700;color:#64748B;text-transform:uppercase;margin-bottom:8px;">Info Booking</div>
                    <div class="row g-2" style="font-size:0.88rem;">
                        <div class="col-md-4">
                            <span class="text-muted">Penyewa:</span>
                            <strong>{{ $pembayaran->booking->user->name }}</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted">Kos:</span>
                            <strong>{{ $pembayaran->booking->kos->nama_kos }}</strong>
                        </div>
                        <div class="col-md-4">
                            <span class="text-muted">Durasi:</span>
                            <strong>{{ $pembayaran->booking->durasi_sewa }} Bulan</strong>
                        </div>
                    </div>
                </div>

                @if($errors->any())
                <div class="alert alert-danger rounded-3 mb-4">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $e)
                            <li style="font-size:0.88rem;">{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('pembayaran.update', $pembayaran) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Total Tagihan (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius:8px 0 0 8px;border:1.5px solid #E2E8F0;background:#F8FAFC;">Rp</span>
                                <input type="number" name="total_tagihan"
                                       class="form-control @error('total_tagihan') is-invalid @enderror"
                                       value="{{ old('total_tagihan', $pembayaran->total_tagihan) }}"
                                       min="0" required style="border-radius:0 8px 8px 0;">
                            </div>
                            @error('total_tagihan')<div class="text-danger mt-1" style="font-size:0.82rem;">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                            <select name="metode_bayar"
                                    class="form-select @error('metode_bayar') is-invalid @enderror" required>
                                @foreach(['Mandiri', 'BCA', 'Dana'] as $m)
                                    <option value="{{ $m }}"
                                        {{ old('metode_bayar', $pembayaran->metode_bayar) === $m ? 'selected' : '' }}>
                                        {{ $m }}
                                    </option>
                                @endforeach
                            </select>
                            @error('metode_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status Pembayaran <span class="text-danger">*</span></label>
                            <select name="status_bayar"
                                    class="form-select @error('status_bayar') is-invalid @enderror" required>
                                <option value="pending" {{ old('status_bayar', $pembayaran->status_bayar) === 'pending' ? 'selected' : '' }}>
                                    ⏳ Pending
                                </option>
                                <option value="lunas" {{ old('status_bayar', $pembayaran->status_bayar) === 'lunas' ? 'selected' : '' }}>
                                    ✅ Lunas
                                </option>
                            </select>
                            @error('status_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Bukti Bayar --}}
                        <div class="col-12">
                            <label class="form-label">
                                Ganti Bukti Bayar
                                <span class="text-muted fw-normal">(kosongkan jika tidak ingin mengganti)</span>
                            </label>

                            @if($pembayaran->booking->buktiBayar)
                            <div class="mb-2">
                                <div style="font-size:0.78rem;color:#64748B;margin-bottom:6px;">Bukti saat ini:</div>
                                <img src="{{ Storage::url($pembayaran->booking->buktiBayar->file_bukti) }}"
                                     alt="Bukti Bayar"
                                     style="max-height:120px;border-radius:8px;border:1px solid #E2E8F0;cursor:pointer;"
                                     onclick="window.open(this.src,'_blank')">
                            </div>
                            @endif

                            <input type="file" name="file_bukti"
                                   class="form-control @error('file_bukti') is-invalid @enderror"
                                   accept="image/jpg,image/jpeg,image/png"
                                   onchange="previewBukti(this)">
                            <div style="font-size:0.78rem;color:#94A3B8;margin-top:4px;">JPG, JPEG, PNG — Maks. 2MB</div>
                            @error('file_bukti')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <img id="buktiPreview" src="#" alt="Preview Baru"
                                 style="display:none;max-height:120px;border-radius:8px;margin-top:10px;border:1px solid #E2E8F0;">
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3" style="border-top:1px solid #E2E8F0;">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-floppy me-2"></i>Update Pembayaran
                        </button>
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function previewBukti(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById('buktiPreview');
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
