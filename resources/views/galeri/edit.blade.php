@extends('layouts.admin')

@section('title', 'Edit Foto Kos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('galeri.index') }}">Galeri Foto</a></li>
    <li class="breadcrumb-item active">Edit Foto</li>
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title" style="color:#F59E0B;">
                    <i class="bi bi-pencil-square"></i> Edit Foto Kos
                </div>
                <a href="{{ route('galeri.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
            </div>
            <div class="admin-card-body">

                {{-- Preview foto saat ini --}}
                <div class="mb-4 p-3 rounded-3" style="background:#F8FAFC;border:1px solid #E2E8F0;">
                    <div style="font-size:0.8rem;font-weight:600;color:#64748B;margin-bottom:8px;">FOTO SAAT INI</div>
                    <img src="{{ Storage::url($galeri->foto) }}"
                         alt="Foto Saat Ini"
                         style="max-height:160px;border-radius:8px;border:1px solid #E2E8F0;">
                    <div style="font-size:0.78rem;color:#94A3B8;margin-top:6px;">
                        Kos: <strong>{{ $galeri->kos->nama_kos }}</strong>
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

                <form action="{{ route('galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Pilih Kos <span class="text-danger">*</span></label>
                        <select name="kos_id" class="form-select @error('kos_id') is-invalid @enderror" required>
                            <option value="">— Pilih Kos —</option>
                            @foreach($kosList as $kos)
                                <option value="{{ $kos->id }}"
                                    {{ old('kos_id', $galeri->kos_id) == $kos->id ? 'selected' : '' }}>
                                    {{ $kos->nama_kos }}
                                </option>
                            @endforeach
                        </select>
                        @error('kos_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Ganti Foto <span class="text-muted">(opsional, biarkan kosong jika tidak ingin mengganti)</span></label>
                        <input type="file" name="foto" id="fotoInput"
                               class="form-control @error('foto') is-invalid @enderror"
                               accept="image/jpg,image/jpeg,image/png,image/webp"
                               onchange="previewFoto(this)">
                        <div style="font-size:0.78rem;color:#94A3B8;margin-top:4px;">JPG, JPEG, PNG, WEBP — Maks. 2MB</div>
                        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <img id="previewImg" src="#" alt="Preview Baru"
                             style="display:none;max-height:140px;border-radius:8px;margin-top:10px;border:1px solid #E2E8F0;">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-floppy me-2"></i>Update Foto
                        </button>
                        <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function previewFoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById('previewImg');
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
