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
            <ul class="navbar-nav ms-lg-5 me-lg-auto">
                <li class="nav-item">
                    <a class="nav-link click-scroll" href="{{ route('user-web.home') }}#section_1">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="{{ route('user-web.home') }}#section_2">Tentang Kami</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="{{ route('user-web.home') }}#section_3">Cara Kerja</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="{{ route('user-web.home') }}#section_4">FAQs</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link click-scroll" href="{{ route('user-web.contact') }}">Kontak</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>

                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('user-web.topics') }}">Topics Listing</a></li>
                        <li><a class="dropdown-item" href="{{ route('user-web.contact') }}">Contact Form</a></li>
                    </ul>
                </li>
            </ul>

            <div class="d-none d-lg-block">
                <a href="{{ route('dashboard') }}" class="navbar-icon bi-person smoothscroll" title="Dashboard"></a>
            </div>
        </div>
    </div>
</nav>
