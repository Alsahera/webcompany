@extends('layouts.admin')

@section('title', 'Buat Booking')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('booking.index') }}">Data Booking</a></li>
    <li class="breadcrumb-item active">Buat Booking</li>
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title text-info">
                    <i class="bi bi-calendar-plus"></i> Form Buat Booking
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

                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Penyewa <span class="text-danger">*</span></label>
                            <select name="user_id"
                                    class="form-select @error('user_id') is-invalid @enderror" required>
                                <option value="">— Pilih Penyewa —</option>
                                @foreach($userList as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Pilih Kos <span class="text-danger">*</span></label>
                            <select name="kos_id" id="kosSelect"
                                    class="form-select @error('kos_id') is-invalid @enderror"
                                    required onchange="updateHargaInfo(this)">
                                <option value="">— Pilih Kos —</option>
                                @foreach($kosList as $kos)
                                    <option value="{{ $kos->id }}"
                                            data-harga="{{ $kos->harga }}"
                                            {{ old('kos_id') == $kos->id ? 'selected' : '' }}>
                                        {{ $kos->nama_kos }} — Rp {{ number_format($kos->harga, 0, ',', '.') }}/bln
                                    </option>
                                @endforeach
                            </select>
                            @error('kos_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Info Harga --}}
                        <div class="col-12" id="hargaInfo" style="display:none;">
                            <div class="p-3 rounded-3" style="background:#EFF6FF;border:1px solid #BFDBFE;">
                                <div style="font-size:0.82rem;color:#1E40AF;font-weight:600;">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Harga: <span id="hargaPerBulan">—</span>/bulan
                                    &nbsp;|&nbsp;
                                    Total Estimasi: <span id="totalEstimasi" style="font-size:1rem;font-weight:800;">—</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_masuk"
                                   class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                   value="{{ old('tanggal_masuk', date('Y-m-d')) }}"
                                   min="{{ date('Y-m-d') }}"
                                   required onchange="updateEstimasi()">
                            @error('tanggal_masuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Durasi Sewa (bulan) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="durasi_sewa" id="durasiInput"
                                       class="form-control @error('durasi_sewa') is-invalid @enderror"
                                       value="{{ old('durasi_sewa', 1) }}"
                                       min="1" max="24" required
                                       oninput="updateEstimasi()">
                                <span class="input-group-text" style="background:#F8FAFC;border:1.5px solid #E2E8F0;border-left:none;">bulan</span>
                            </div>
                            @error('durasi_sewa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3" style="border-top:1px solid #E2E8F0;">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-floppy me-2"></i>Simpan Booking
                        </button>
                        <a href="{{ route('booking.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function formatRupiah(n) {
        return 'Rp ' + parseInt(n).toLocaleString('id-ID');
    }

    function updateHargaInfo(sel) {
        const opt     = sel.options[sel.selectedIndex];
        const harga   = opt.dataset.harga;
        const infoBox = document.getElementById('hargaInfo');

        if (harga) {
            document.getElementById('hargaPerBulan').textContent = formatRupiah(harga);
            infoBox.style.display = 'block';
            updateEstimasi();
        } else {
            infoBox.style.display = 'none';
        }
    }

    function updateEstimasi() {
        const sel    = document.getElementById('kosSelect');
        const opt    = sel.options[sel.selectedIndex];
        const harga  = parseFloat(opt.dataset.harga) || 0;
        const durasi = parseInt(document.getElementById('durasiInput').value) || 1;

        if (harga) {
            document.getElementById('totalEstimasi').textContent = formatRupiah(harga * durasi);
        }
    }
</script>
@endpush
