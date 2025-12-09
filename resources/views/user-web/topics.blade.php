<!-- resources/views/user-web/topics.blade.php -->

@extends('user-web.app')

@section('title', 'Topics Listing - Digital Forensik System')
@section('body-class', 'topics-listing-page')

@section('content')
<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user-web.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Topics</li>
                    </ol>
                </nav>
                <h2 class="text-white">Topics Listing</h2>
            </div>
        </div>
    </div>
</header>

<section class="section-padding section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h3 class="mb-4 pb-2">Topik-topik Penting</h3>
            </div>

            <div class="col-lg-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pengenalan Digital Forensik</h5>
                        <p class="card-text">Pelajari dasar-dasar digital forensik dan pentingnya dalam investigasi keamanan siber.</p>
                        <a href="#" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manajemen Insiden</h5>
                        <p class="card-text">Panduan lengkap mengelola insiden keamanan dari deteksi hingga resolusi.</p>
                        <a href="#" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Preservasi Bukti Digital</h5>
                        <p class="card-text">Teknik terbaik untuk menjaga integritas dan rantai bukti digital.</p>
                        <a href="#" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Analisis Log Sistem</h5>
                        <p class="card-text">Cara menganalisis log sistem untuk menemukan indikator kompromi.</p>
                        <a href="#" class="btn btn-primary">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

