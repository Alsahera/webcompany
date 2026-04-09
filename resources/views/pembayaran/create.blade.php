@extends('layouts.admin')

@section('title', 'Tambah Pembayaran')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pembayaran.index') }}">Data Pembayaran</a></li>
    <li class="breadcrumb-item active">Tambah Pembayaran</li>
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title text-success">
                    <i class="bi bi-credit-card-fill"></i> Form Tambah Pembayaran
                </div>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-outline-secondary">
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

                <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        {{-- Pilih Booking --}}
                        <div class="col-12">
                            <label class="form-label">Pilih Booking <span class="text-danger">*</span></label>
                            <select name="booking_id" id="bookingSelect"
                                    class="form-select @error('booking_id') is-invalid @enderror"
                                    required onchange="fillTotalOtomatis(this)">
                                <option value="">— Pilih Booking —</option>
                                @foreach($bookingList as $b)
                                    <option value="{{ $b->id }}"
                                            data-harga="{{ $b->kos->harga }}"
                                            data-durasi="{{ $b->durasi_sewa }}"
                                            {{ old('booking_id') == $b->id ? 'selected' : '' }}>
                                        #{{ $b->id }} — {{ $b->user->name }} → {{ $b->kos->nama_kos }}
                                        ({{ $b->durasi_sewa }} bln)
                                    </option>
                                @endforeach
                            </select>
                            @error('booking_id')<div class="invalid-feedback">{{ $message }}</div>@enderror

                            @if($bookingList->isEmpty())
                            <div class="alert alert-warning mt-2 rounded-3" style="font-size:0.85rem;">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                Semua booking sudah memiliki pembayaran.
                                <a href="{{ route('booking.create') }}" class="fw-bold">Buat booking baru</a>
                            </div>
                            @endif
                        </div>

                        {{-- Info Otomatis --}}
                        <div class="col-12" id="bookingInfo" style="display:none;">
                            <div class="p-3 rounded-3" style="background:#F0FDF4;border:1px solid #BBF7D0;">
                                <div style="font-size:0.82rem;color:#166534;font-weight:600;">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Harga: <span id="infoHarga">—</span>/bln &nbsp;×&nbsp;
                                    <span id="infoDurasi">—</span> bln =
                                    <span id="infoTotal" style="font-size:1rem;font-weight:800;">—</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Total Tagihan (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius:8px 0 0 8px;border:1.5px solid #E2E8F0;background:#F8FAFC;">Rp</span>
                                <input type="number" name="total_tagihan" id="totalInput"
                                       class="form-control @error('total_tagihan') is-invalid @enderror"
                                       value="{{ old('total_tagihan') }}"
                                       min="0" required style="border-radius:0 8px 8px 0;">
                            </div>
                            @error('total_tagihan')<div class="text-danger mt-1" style="font-size:0.82rem;">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                            <select name="metode_bayar"
                                    class="form-select @error('metode_bayar') is-invalid @enderror" required>
                                <option value="">— Pilih Metode —</option>
                                @foreach(['Mandiri', 'BCA', 'Dana'] as $m)
                                    <option value="{{ $m }}" {{ old('metode_bayar') === $m ? 'selected' : '' }}>
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
                                <option value="">— Pilih Status —</option>
                                <option value="pending" {{ old('status_bayar') === 'pending' ? 'selected' : '' }}>
                                    ⏳ Pending
                                </option>
                                <option value="lunas" {{ old('status_bayar') === 'lunas' ? 'selected' : '' }}>
                                    ✅ Lunas
                                </option>
                            </select>
                            @error('status_bayar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Upload Bukti --}}
                        <div class="col-12">
                            <label class="form-label">
                                Upload Bukti Bayar
                                <span class="text-muted fw-normal">(opsional)</span>
                            </label>
                            <input type="file" name="file_bukti" id="buktiFoto"
                                   class="form-control @error('file_bukti') is-invalid @enderror"
                                   accept="image/jpg,image/jpeg,image/png"
                                   onchange="previewBukti(this)">
                            <div style="font-size:0.78rem;color:#94A3B8;margin-top:4px;">
                                JPG, JPEG, PNG — Maks. 2MB
                            </div>
                            @error('file_bukti')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <img id="buktiPreview" src="#" alt="Preview Bukti"
                                 style="display:none;max-height:160px;border-radius:8px;margin-top:10px;border:1px solid #E2E8F0;">
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3" style="border-top:1px solid #E2E8F0;">
                        <button type="submit" class="btn btn-success px-4"
                                {{ $bookingList->isEmpty() ? 'disabled' : '' }}>
                            <i class="bi bi-floppy me-2"></i>Simpan Pembayaran
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
    function fillTotalOtomatis(sel) {
        const opt    = sel.options[sel.selectedIndex];
        const harga  = parseFloat(opt.dataset.harga) || 0;
        const durasi = parseInt(opt.dataset.durasi)  || 0;

        if (harga && durasi) {
            const total = harga * durasi;
            document.getElementById('totalInput').value = total;

            const fmt = n => 'Rp ' + parseInt(n).toLocaleString('id-ID');
            document.getElementById('infoHarga').textContent  = fmt(harga);
            document.getElementById('infoDurasi').textContent = durasi;
            document.getElementById('infoTotal').textContent  = fmt(total);
            document.getElementById('bookingInfo').style.display = 'block';
        } else {
            document.getElementById('bookingInfo').style.display = 'none';
        }
    }

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

    // Auto-fill jika ada old value
    window.addEventListener('load', () => {
        const sel = document.getElementById('bookingSelect');
        if (sel.value) fillTotalOtomatis(sel);
    });
</script>
@endpush
