{{-- 
    Partial: partials/footer.blade.php
    Footer utama LaKost
--}}

<footer class="kf-footer">

    {{-- Footer Main --}}
    <div class="footer-main">
        <div class="container">
            <div class="row g-5">

                {{-- Brand Column --}}
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="brand-icon-footer">
                            <i class="bi bi-house-heart-fill"></i>
                        </div>
                        <span class="brand-text-footer">La<span>Kost</span></span>
                    </div>
                    <p class="footer-desc">
                        Platform pencarian kos terpercaya yang membantu jutaan orang menemukan hunian
                        yang nyaman, aman, dan sesuai budget di seluruh Indonesia.
                    </p>

                    {{-- Social Icons --}}
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                {{-- Navigasi (FIXED) --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-heading">Navigasi</h6>
                    <ul class="footer-links">

                        @if(Route::has('home'))
                        <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i>Beranda</a></li>
                        @endif

                        @if(Route::has('about'))
                        <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right"></i>Tentang</a></li>
                        @endif

                        @if(Route::has('team'))
                        <li><a href="{{ route('team') }}"><i class="bi bi-chevron-right"></i>Tim Kami</a></li>
                        @endif

                        @if(Route::has('contact'))
                        <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right"></i>Kontak</a></li>
                        @endif

                    </ul>
                </div>

                {{-- Layanan --}}
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="footer-heading">Layanan</h6>
                    <ul class="footer-links">
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Cari Kos</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Pasang Iklan</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Kos Premium</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right"></i>Blog & Tips</a></li>
                    </ul>
                </div>

                {{-- Kontak Cepat --}}
                <div class="col-lg-4 col-md-6">
                    <h6 class="footer-heading">Hubungi Kami</h6>
                    <ul class="footer-contact-list">
                        <li>
                            <i class="bi bi-geo-alt-fill text-primary"></i>
                            <span>Jl. Mendalan No.62, Banjarmendalan, Lamongan, Jawa Timur 62212</span>
                        </li>
                        <li>
                            <i class="bi bi-telephone-fill text-primary"></i>
                            <span>+62 21 5555 8888</span>
                        </li>
                        <li>
                            <i class="bi bi-envelope-fill text-primary"></i>
                            <span>hello@lakost.id</span>
                        </li>
                        <li>
                            <i class="bi bi-clock-fill text-primary"></i>
                            <span>Senin – Jumat, 09.00 – 15.00 WIB</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{-- Footer Bottom --}}
    <div class="footer-bottom">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <p class="mb-0 footer-copy">
                    &copy; {{ date('Y') }} <strong>LaKost</strong>. Hak cipta dilindungi undang-undang.
                </p>
                <div class="d-flex gap-3">
                    <a href="#" class="footer-bottom-link">Kebijakan Privasi</a>
                    <span class="dot-divider"></span>
                    <a href="#" class="footer-bottom-link">Syarat & Ketentuan</a>
                    <span class="dot-divider"></span>
                    <a href="#" class="footer-bottom-link">Cookie</a>
                </div>
            </div>
        </div>
    </div>

</footer>

<style>
    .kf-footer {
        background: var(--kf-dark);
        color: rgba(255,255,255,0.7);
        margin-top: 0;
    }

    .footer-main { padding: 64px 0 48px; }

    .brand-icon-footer {
        width: 38px;
        height: 38px;
        background: var(--kf-primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
    }

    .brand-text-footer {
        font-family: 'DM Serif Display', serif;
        font-size: 1.4rem;
        color: white;
    }

    .brand-text-footer span { color: #60A5FA; }

    .footer-desc {
        font-size: 0.88rem;
        line-height: 1.7;
        color: rgba(255,255,255,0.55);
    }

    .footer-heading {
        color: white;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        margin-bottom: 1.2rem;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .footer-links a {
        color: rgba(255,255,255,0.55);
        text-decoration: none;
        font-size: 0.88rem;
        display: flex;
        gap: 6px;
    }

    .footer-links a:hover {
        color: #60A5FA;
    }
</style>