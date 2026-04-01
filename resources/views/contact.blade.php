{{--
    View: contact.blade.php
    Halaman Kontak KosFinder
--}}

@extends('layouts.app')

@section('title', 'Kontak')

@push('styles')
<style>
    /* =============================================
       CONTACT PAGE STYLES
       ============================================= */

    /* Contact Info Card */
    .contact-info-card {
        border-radius: 16px;
        padding: 28px;
        display: flex;
        align-items: flex-start;
        gap: 18px;
        background: white;
        border: 1px solid var(--kf-border);
        transition: var(--kf-transition);
    }
    .contact-info-card:hover {
        box-shadow: var(--kf-shadow);
        transform: translateY(-2px);
    }

    .contact-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 48px 40px;
        border: 1px solid var(--kf-border);
        box-shadow: 0 8px 32px rgba(26,86,219,0.08);
    }

    /* Map Container */
    .map-container {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--kf-border);
        height: 300px;
    }
    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    /* Success/Error States */
    .form-submitted {
        display: none;
        text-align: center;
        padding: 40px 20px;
    }
    .form-submitted .success-icon {
        font-size: 4rem;
        margin-bottom: 16px;
    }

    /* FAQ */
    .faq-item {
        border: 1px solid var(--kf-border);
        border-radius: 12px;
        overflow: hidden;
        transition: box-shadow 0.2s;
    }
    .faq-item:hover { box-shadow: var(--kf-shadow); }
    .faq-btn {
        background: white;
        border: none;
        width: 100%;
        text-align: left;
        padding: 18px 24px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        font-size: 0.92rem;
        color: var(--kf-dark);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        transition: background 0.2s;
        cursor: pointer;
    }
    .faq-btn:hover { background: var(--kf-light); }
    .faq-btn[aria-expanded="true"] { color: var(--kf-primary); }
    .faq-body {
        padding: 0 24px;
        font-size: 0.87rem;
        color: var(--kf-gray);
        line-height: 1.7;
    }
    .faq-body.show { padding-bottom: 18px; }

    @media (max-width: 767px) {
        .form-card { padding: 32px 24px; }
    }
</style>
@endpush

@section('content')

{{-- ============================================
     PAGE HEADER
     ============================================ --}}
<section style="background:linear-gradient(135deg,#EFF6FF,#DBEAFE);padding:80px 0 64px;">
    <div class="container text-center fade-in-up">
        <div class="kf-badge">Hubungi Kami</div>
        <h1 class="section-title mb-3">
            Ada Pertanyaan? <span class="text-primary">Kami Siap<br>Membantu!</span>
        </h1>
        <p class="text-muted mx-auto" style="max-width:480px;font-size:1.02rem;line-height:1.7;">
            Tim dukungan kami siap menjawab pertanyaan dan membantu kamu dalam
            proses pencarian kos maupun pendaftaran properti.
        </p>
    </div>
</section>

{{-- ============================================
     CONTACT INFO CARDS
     ============================================ --}}
<section class="section-py">
    <div class="container">
        <div class="row g-5">

            {{-- FORM CONTACT --}}
            <div class="col-lg-7 fade-in-up fade-in-up-1">
                <div class="form-card">
                    <div class="mb-4">
                        <h3 class="mb-1" style="font-size:1.6rem;">Kirim Pesan</h3>
                        <p class="text-muted mb-0" style="font-size:0.9rem;">
                            Isi formulir di bawah dan kami akan merespons dalam 1x24 jam kerja.
                        </p>
                    </div>

                    {{-- Alert Success (muncul setelah submit via JS) --}}
                    <div id="formSuccess" style="display:none;" class="alert alert-success rounded-3 d-flex align-items-center gap-2 mb-4">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <span>Pesan kamu berhasil terkirim! Kami akan segera menghubungi kamu.</span>
                    </div>

                    {{-- Form --}}
                    <form id="contactForm" novalidate>
                        @csrf

                        <div class="row g-3">
                            {{-- Nama --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                    Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="form-control"
                                       id="nama"
                                       name="nama"
                                       placeholder="contoh: Budi Santoso"
                                       required>
                                <div class="invalid-feedback">Nama tidak boleh kosong.</div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                    Alamat Email <span class="text-danger">*</span>
                                </label>
                                <input type="email"
                                       class="form-control"
                                       id="email"
                                       name="email"
                                       placeholder="kamu@email.com"
                                       required>
                                <div class="invalid-feedback">Masukkan alamat email yang valid.</div>
                            </div>

                            {{-- Nomor HP --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                    Nomor HP <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:var(--kf-light);border-color:var(--kf-border);font-size:0.9rem;">+62</span>
                                    <input type="tel"
                                           class="form-control"
                                           id="phone"
                                           name="phone"
                                           placeholder="812 3456 7890">
                                </div>
                            </div>

                            {{-- Topik --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                    Topik Pesan <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="topik" name="topik" required>
                                    <option value="" disabled selected>Pilih topik...</option>
                                    <option value="pencarian">Bantuan Pencarian Kos</option>
                                    <option value="daftar">Daftarkan Properti Kos</option>
                                    <option value="teknis">Masalah Teknis</option>
                                    <option value="kerjasama">Kerja Sama / Partnership</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                                <div class="invalid-feedback">Pilih topik pesan.</div>
                            </div>

                            {{-- Pesan --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" style="font-size:0.875rem;">
                                    Pesan <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control"
                                          id="pesan"
                                          name="pesan"
                                          rows="5"
                                          placeholder="Tuliskan pesan atau pertanyaanmu di sini..."
                                          required
                                          style="resize:none;"></textarea>
                                <div class="invalid-feedback">Pesan tidak boleh kosong.</div>
                                <div class="text-end mt-1">
                                    <small class="text-muted" id="charCount">0 / 500 karakter</small>
                                </div>
                            </div>

                            {{-- Consent Checkbox --}}
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="consent" required>
                                    <label class="form-check-label" for="consent" style="font-size:0.85rem;color:var(--kf-gray);">
                                        Saya menyetujui <a href="#" class="text-primary">Kebijakan Privasi</a> dan
                                        bersedia dihubungi oleh tim LaKost.
                                    </label>
                                    <div class="invalid-feedback">Kamu harus menyetujui kebijakan privasi.</div>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3" id="submitBtn">
                                    <i class="bi bi-send me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- SIDEBAR: Map + FAQ --}}
            <div class="col-lg-5 fade-in-up fade-in-up-2">

                {{-- Google Maps Embed --}}
                <div class="mb-4">
                    <h5 class="mb-3" style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;">
                        <i class="bi bi-geo-alt-fill text-primary me-2"></i>Lokasi Kantor
                    </h5>
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.0640470813964!2d112.4237469731887!3d-7.118576692885092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77f0aa4af09387%3A0x2fe19128fa287ca2!2sJl.%20Mendalan%20No.62%2C%20Mendalan%2C%20Banjarmendalan%2C%20Kec.%20Lamongan%2C%20Kabupaten%20Lamongan%2C%20Jawa%20Timur%2062212!5e0!3m2!1sid!2sid!4v1774812754172!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="bi bi-info-circle me-1"></i>
                        Jl. Mendalan No.62, Banjarmendalan, Lamongan, Jawa Timur 62212
                    </small>
                </div>

                {{-- FAQ Accordion --}}
                <div>
                    <h5 class="mb-3" style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;">
                        <i class="bi bi-question-circle-fill text-primary me-2"></i>Pertanyaan Umum
                    </h5>
                    <div class="d-flex flex-column gap-2" id="faqAccordion">
                        @foreach([
                            [
                                'q' => 'Apakah mendaftar di KosFinder gratis?',
                                'a' => 'Ya! Pencari kos bisa mendaftar dan menggunakan semua fitur pencarian secara gratis. Untuk pemilik kos, tersedia paket premium dengan fitur tambahan.'
                            ],
                            [
                                'q' => 'Bagaimana cara mendaftarkan kos saya?',
                                'a' => 'Kamu bisa mendaftarkan properti melalui menu "Daftar Kos" di halaman utama. Tim kami akan menghubungi dan membantu proses verifikasi.'
                            ],
                            [
                                'q' => 'Berapa lama waktu respons tim KosFinder?',
                                'a' => 'Tim kami merespons pesan dalam 1x24 jam pada hari kerja (Senin–Jumat). Untuk isu mendesak, hubungi WhatsApp kami.'
                            ],
                            [
                                'q' => 'Apakah foto kos sudah diverifikasi?',
                                'a' => 'Semua foto telah diverifikasi oleh tim kami. Kami memiliki program "Verified Photos" yang memastikan foto sesuai dengan kondisi nyata kos.'
                            ],
                        ] as $idx => $faq)
                        <div class="faq-item">
                            <button class="faq-btn"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq{{ $idx }}"
                                    aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}"
                                    aria-controls="faq{{ $idx }}">
                                <span>{{ $faq['q'] }}</span>
                                <i class="bi bi-chevron-down flex-shrink-0" style="transition:transform 0.2s;"></i>
                            </button>
                            <div id="faq{{ $idx }}" class="collapse faq-body {{ $idx === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

{{-- ============================================
     CHANNEL ALTERNATIF
     ============================================ --}}
<section class="section-py section-bg">
    <div class="container">
        <div class="text-center mb-5 fade-in-up">
            <div class="kf-badge">Channel Lainnya</div>
            <h2 class="section-title">Cara Lain <span class="text-primary">Menghubungi</span> Kami</h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach([
                ['icon' => 'bi-whatsapp',    'color' => '#25D366', 'bg' => 'rgba(37,211,102,0.08)', 'title' => 'WhatsApp',    'value' => '+62 812-3456-7890', 'action' => 'Chat Sekarang', 'link' => '#'],
                ['icon' => 'bi-instagram',   'color' => '#E1306C', 'bg' => 'rgba(225,48,108,0.08)', 'title' => 'Instagram',   'value' => '@kosfinder.id',     'action' => 'Ikuti Kami',    'link' => '#'],
                ['icon' => 'bi-envelope-fill','color' => 'var(--kf-primary)', 'bg' => 'rgba(26,86,219,0.08)', 'title' => 'Email',       'value' => 'hello@kosfinder.id','action' => 'Kirim Email',  'link' => 'mailto:hello@kosfinder.id'],
            ] as $i => $ch)
            <div class="col-lg-4 col-md-6 fade-in-up fade-in-up-{{ $i + 1 }}">
                <div class="kf-card p-4 text-center">
                    <div style="width:64px;height:64px;border-radius:16px;background:{{ $ch['bg'] }};display:flex;align-items:center;justify-content:center;font-size:1.8rem;color:{{ $ch['color'] }};margin:0 auto 16px;">
                        <i class="bi {{ $ch['icon'] }}"></i>
                    </div>
                    <h6 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;">{{ $ch['title'] }}</h6>
                    <p class="text-muted mb-3" style="font-size:0.88rem;">{{ $ch['value'] }}</p>
                    <a href="{{ $ch['link'] }}" class="btn btn-outline-primary btn-sm px-4">
                        {{ $ch['action'] }} <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // =============================================
    // Contact Form Validation & UX
    // =============================================

    const form = document.getElementById('contactForm');
    const successMsg = document.getElementById('formSuccess');
    const submitBtn = document.getElementById('submitBtn');
    const textarea = document.getElementById('pesan');
    const charCount = document.getElementById('charCount');

    // Character counter untuk textarea
    textarea.addEventListener('input', function () {
        const len = this.value.length;
        charCount.textContent = `${len} / 500 karakter`;
        if (len > 500) {
            charCount.style.color = '#EF4444';
        } else {
            charCount.style.color = '';
        }
    });

    // Putar chevron icon saat accordion buka/tutup
    document.querySelectorAll('.faq-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const icon = this.querySelector('.bi-chevron-down');
            const expanded = this.getAttribute('aria-expanded') === 'true';
            // Reset semua
            document.querySelectorAll('.faq-btn .bi-chevron-down').forEach(i => {
                i.style.transform = 'rotate(0deg)';
            });
            if (!expanded) {
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });

    // Form submit dengan validasi Bootstrap
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Validasi karakter maksimal
        if (textarea.value.length > 500) {
            textarea.focus();
            return;
        }

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        // Simulasi loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim...';

        // Simulasi pengiriman (1.5 detik)
        setTimeout(() => {
            form.style.display = 'none';
            successMsg.style.display = 'flex';
            successMsg.innerHTML = `
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span>Pesan kamu berhasil terkirim! Kami akan merespons dalam 1x24 jam kerja.</span>
            `;
        }, 1500);
    });
</script>
@endpush
