@extends('layouts.admin')

@section('title', 'Upload Foto Kos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('galeri.index') }}">Galeri Foto</a></li>
    <li class="breadcrumb-item active">Upload Foto</li>
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="admin-card-title" style="color:#8B5CF6;">
                    <i class="bi bi-upload"></i> Upload Foto Kos
                </div>
                <a href="{{ route('galeri.index') }}" class="btn btn-sm btn-outline-secondary">
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

                <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Pilih Kos <span class="text-danger">*</span></label>
                        <select name="kos_id" class="form-select @error('kos_id') is-invalid @enderror" required>
                            <option value="">— Pilih Kos —</option>
                            @foreach($kosList as $kos)
                                <option value="{{ $kos->id }}" {{ old('kos_id') == $kos->id ? 'selected' : '' }}>
                                    {{ $kos->nama_kos }} — {{ $kos->lokasi }}
                                </option>
                            @endforeach
                        </select>
                        @error('kos_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">File Foto <span class="text-danger">*</span></label>
                        {{-- Drop zone --}}
                        <div id="dropZone"
                             style="border:2px dashed #CBD5E1;border-radius:12px;padding:32px;text-align:center;cursor:pointer;transition:all 0.2s;background:#F8FAFC;"
                             onclick="document.getElementById('fotoInput').click()"
                             ondragover="event.preventDefault();this.style.borderColor='#1A56DB'"
                             ondragleave="this.style.borderColor='#CBD5E1'"
                             ondrop="handleDrop(event)">
                            <div id="dropContent">
                                <i class="bi bi-cloud-upload" style="font-size:2.5rem;color:#94A3B8;display:block;margin-bottom:8px;"></i>
                                <div style="font-weight:600;color:#374151;margin-bottom:4px;">Klik atau drag & drop foto di sini</div>
                                <div style="font-size:0.82rem;color:#94A3B8;">JPG, JPEG, PNG, WEBP — Maks. 2MB</div>
                            </div>
                            <img id="previewImg" src="#" alt="Preview"
                                 style="display:none;max-height:200px;border-radius:8px;margin:0 auto;">
                        </div>
                        <input type="file" id="fotoInput" name="foto"
                               accept="image/jpg,image/jpeg,image/png,image/webp"
                               class="@error('foto') is-invalid @enderror"
                               style="display:none;"
                               onchange="previewFoto(this)">
                        @error('foto')<div class="text-danger mt-1" style="font-size:0.82rem;">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-cloud-upload me-2"></i>Upload Foto
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
            const file = input.files[0];
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB!');
                input.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('dropContent').style.display = 'none';
                const img = document.getElementById('previewImg');
                img.src = e.target.result;
                img.style.display = 'block';
                document.getElementById('dropZone').style.borderColor = '#1A56DB';
                document.getElementById('dropZone').style.background = '#EFF6FF';
            };
            reader.readAsDataURL(file);
        }
    }

    function handleDrop(e) {
        e.preventDefault();
        document.getElementById('dropZone').style.borderColor = '#CBD5E1';
        const files = e.dataTransfer.files;
        if (files.length) {
            const input = document.getElementById('fotoInput');
            input.files = files;
            previewFoto(input);
        }
    }
</script>
@endpush
