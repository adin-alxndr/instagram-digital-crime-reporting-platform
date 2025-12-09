
<!-- resources/views/frontend/layouts/footer.blade.php -->

<footer class="site-footer section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-12 mb-4 pb-2">
                <a class="navbar-brand mb-2" href="{{ route('user-web.home') }}">
                    <i class="bi-back"></i>
                    <span>Digital Forensik</span>
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <h6 class="site-footer-title mb-3">Resources</h6>

                <ul class="site-footer-links">
                    <li class="site-footer-link-item">
                        <a href="{{ route('user-web.home') }}" class="site-footer-link">Home</a>
                    </li>

                    <li class="site-footer-link-item">
                        <a href="{{ route('user-web.home') }}#section_3" class="site-footer-link">Cara Kerja</a>
                    </li>

                    <li class="site-footer-link-item">
                        <a href="{{ route('user-web.home') }}#section_4" class="site-footer-link">FAQs</a>
                    </li>

                    <li class="site-footer-link-item">
                        <a href="{{ route('user-web.contact') }}" class="site-footer-link">Kontak</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                <h6 class="site-footer-title mb-3">Informasi</h6>

                <p class="text-white d-flex mb-1">
                    <a href="tel:+6281234567890" class="site-footer-link">
                        +62 812-345-67890
                    </a>
                </p>

                <p class="text-white d-flex">
                    <a href="mailto:info@digitalforensik.com" class="site-footer-link">
                        info@digitalforensik.com
                    </a>
                </p>
            </div>

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Indonesia
                    </button>

                    <ul class="dropdown-menu">
                        <li><button class="dropdown-item" type="button">English</button></li>
                        <li><button class="dropdown-item" type="button">Indonesian</button></li>
                    </ul>
                </div>

                <p class="copyright-text mt-lg-5 mt-4">Copyright © 2024 Digital Forensik System. All rights reserved.
                <br><br>Developed by: <a rel="nofollow" href="#" target="_blank">Digital Forensik Team</a></p>
            </div>

        </div>
    </div>
</footer>