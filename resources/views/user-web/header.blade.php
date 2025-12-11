<!-- resources/views/frontend/layouts/header.blade.php -->

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user-web.home') }}">
            <i class="bi-back"></i>
            <span>Digital Forensik</span>
        </a>

        <div class="d-lg-none ms-auto me-4">
            <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            
            @php
                $isHome = request()->routeIs('user-web.home');
            @endphp

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ $isHome ? '#section_1' : route('user-web.home').'#section_1' }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ $isHome ? '#section_3' : route('user-web.home').'#section_3' }}">
                        Cara Kerja
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ $isHome ? '#section_4' : route('user-web.home').'#section_4' }}">
                        FAQs
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('user-web.contact') }}">
                        Kontak
                    </a>
                </li>

            </ul>

            <div class="d-none d-lg-block">
                <a href="{{ route('admin.login') }}" class="navbar-icon bi-person" title="Login Admin"></a>
            </div>
        </div>
    </div>
</nav>
