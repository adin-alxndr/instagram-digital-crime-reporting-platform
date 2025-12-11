<!-- resources/views/user-web/home.blade.php -->

@extends('user-web.app')

@section('title', 'Laporkan Kejahatan Digital - Digital Forensik System')
@section('body-class', 'topics-listing-page')

@section('content')

<!-- HERO SECTION -->
<section id="section_1" class="hero-section d-flex flex-column justify-content-center align-items-center" style="background: linear-gradient(135deg, #5DADE2 0%, #48C9B0 100%); min-height: 80vh; color: white; position: relative;">
    <div class="container h-100">
        <div class="row align-items-center h-100">
            <div class="col-lg-8 col-12 mx-auto text-center">
                <!-- ICON -->
                <div class="mb-4">
                    <i class="fab fa-instagram" style="font-size: 60px; color: white; opacity: 0.9;"></i>
                </div>

                <!-- MAIN HEADING -->
                <div class="mb-5">
                    <h1 class="display-2 fw-bold" style="font-size: 3.5rem; margin-bottom: 20px;">
                        Laporkan Kejahatan Digital
                    </h1>
                    <p class="lead" style="font-size: 1.3rem; opacity: 0.95;">
                        Platform Pelaporan Aman untuk Kejahatan di Media Sosial Instagram
                    </p>
                </div>

                <!-- QUICK REPORT BUTTON -->
                <div class="mb-4">
                    <a href="{{ route('user-web.report.create') }}" class="btn btn-lg" style="background-color: white; color: #5DADE2; border-radius: 30px; padding: 15px 50px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                        <i class="fas fa-exclamation-triangle me-2"></i> Laporkan Sekarang
                    </a>
                </div>

                <!-- SUBTITLE -->
                <p style="font-size: 0.95rem; opacity: 0.85;">
                    Laporkan dengan aman dan anonim. Kami membantu mengidentifikasi dan menindaklanjuti kejahatan digital.
                </p>
            </div>
        </div>
    </div>

    <!-- DECORATIVE ELEMENTS -->
    <div style="position: absolute; bottom: -50px; width: 100%; height: 100px; background: white; clip-path: polygon(0 0, 100% 0, 100% 100%, 0 30%);"></div>
</section>

<!-- JENIS LAPORAN SECTION -->
<section class="section-padding" style="padding-top: 80px;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Jenis Kejahatan yang Kami Tangani</h2>
            <p class="lead text-muted">Laporkan berbagai jenis kejahatan digital di Instagram dan media sosial lainnya</p>
        </div>

        <div class="row">
            <!-- PELECEHAN / CYBERBULLYING -->
            <div class="col-lg-6 col-12 mb-4">
                <div class="card h-100" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; border-left: 5px solid #E74C3C;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <i class="fas fa-comments" style="font-size: 40px; color: #E74C3C; margin-bottom: 15px;"></i>
                                <h5 class="card-title fw-bold" style="font-size: 1.3rem;">Pelecehan & Cyberbullying</h5>
                            </div>
                            <span class="badge" style="background-color: #E74C3C; padding: 8px 12px; border-radius: 8px; font-size: 12px;">Prioritas Tinggi</span>
                        </div>

                        <p class="card-text text-muted mb-4">
                            Komentar menyakitkan, penghinaan, ancaman, atau pelecehan yang dilakukan melalui Instagram dan platform lainnya.
                        </p>

                        <ul class="list-unstyled small text-muted">
                            <li><i class="fas fa-check text-danger me-2"></i> Komentar berniat jahat</li>
                            <li><i class="fas fa-check text-danger me-2"></i> Penghinaan pribadi</li>
                            <li><i class="fas fa-check text-danger me-2"></i> Ancaman kekerasan</li>
                            <li><i class="fas fa-check text-danger me-2"></i> Intimidasi berkelanjutan</li>
                        </ul>

                        <a href="{{ route('user-web.report.create') }}" class="btn btn-sm btn-outline-danger mt-3">
                            <i class="fas fa-arrow-right me-2"></i> Laporkan Pelecehan
                        </a>
                    </div>
                </div>
            </div>

            <!-- PENIPUAN / FRAUD -->
            <div class="col-lg-6 col-12 mb-4">
                <div class="card h-100" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; border-left: 5px solid #F39C12;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <i class="fas fa-user-slash" style="font-size: 40px; color: #F39C12; margin-bottom: 15px;"></i>
                                <h5 class="card-title fw-bold" style="font-size: 1.3rem;">Penipuan & Scam</h5>
                            </div>
                            <span class="badge" style="background-color: #F39C12; padding: 8px 12px; border-radius: 8px; font-size: 12px; color: white;">Prioritas Tinggi</span>
                        </div>

                        <p class="card-text text-muted mb-4">
                            Akun palsu yang menipu, penawaran palsu, atau mencuri uang melalui Instagram scam dan investasi bodong.
                        </p>

                        <ul class="list-unstyled small text-muted">
                            <li><i class="fas fa-check text-warning me-2"></i> Akun peniru/impostor</li>
                            <li><i class="fas fa-check text-warning me-2"></i> Penawaran palsu</li>
                            <li><i class="fas fa-check text-warning me-2"></i> Minta uang/transfer</li>
                            <li><i class="fas fa-check text-warning me-2"></i> Investasi bodong</li>
                        </ul>

                        <a href="{{ route('user-web.report.create') }}" class="btn btn-sm btn-outline-warning mt-3">
                            <i class="fas fa-arrow-right me-2"></i> Laporkan Penipuan
                        </a>
                    </div>
                </div>
            </div>

            <!-- KONTEN BERBAHAYA -->
            <div class="col-lg-6 col-12 mb-4">
                <div class="card h-100" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; border-left: 5px solid #E91E63;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <i class="fas fa-exclamation-circle" style="font-size: 40px; color: #E91E63; margin-bottom: 15px;"></i>
                                <h5 class="card-title fw-bold" style="font-size: 1.3rem;">Konten Berbahaya</h5>
                            </div>
                            <span class="badge" style="background-color: #E91E63; padding: 8px 12px; border-radius: 8px; font-size: 12px; color: white;">Prioritas Tinggi</span>
                        </div>

                        <p class="card-text text-muted mb-4">
                            Konten tidak pantas, SARA, kekerasan, konten dewasa, atau yang melanggar kebijakan komunitas Instagram.
                        </p>

                        <ul class="list-unstyled small text-muted">
                            <li><i class="fas fa-check text-pink me-2" style="color: #E91E63;"></i> Konten SARA</li>
                            <li><i class="fas fa-check text-pink me-2" style="color: #E91E63;"></i> Konten kekerasan</li>
                            <li><i class="fas fa-check text-pink me-2" style="color: #E91E63;"></i> Konten dewasa</li>
                            <li><i class="fas fa-check text-pink me-2" style="color: #E91E63;"></i> Ujaran kebencian</li>
                        </ul>

                        <a href="{{ route('user-web.report.create') }}" class="btn btn-sm btn-outline-danger mt-3">
                            <i class="fas fa-arrow-right me-2"></i> Laporkan Konten
                        </a>
                    </div>
                </div>
            </div>

            <!-- PENCURIAN IDENTITAS / HACKING -->
            <div class="col-lg-6 col-12 mb-4">
                <div class="card h-100" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; border-left: 5px solid #9B59B6;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <i class="fas fa-lock-open" style="font-size: 40px; color: #9B59B6; margin-bottom: 15px;"></i>
                                <h5 class="card-title fw-bold" style="font-size: 1.3rem;">Pencurian Identitas</h5>
                            </div>
                            <span class="badge" style="background-color: #9B59B6; padding: 8px 12px; border-radius: 8px; font-size: 12px; color: white;">Prioritas Sangat Tinggi</span>
                        </div>

                        <p class="card-text text-muted mb-4">
                            Akun diretas, data pribadi dicuri, atau akun Anda digunakan oleh orang lain tanpa izin.
                        </p>

                        <ul class="list-unstyled small text-muted">
                            <li><i class="fas fa-check me-2" style="color: #9B59B6;"></i> Akun diretas/diambil</li>
                            <li><i class="fas fa-check me-2" style="color: #9B59B6;"></i> Data pribadi dicuri</li>
                            <li><i class="fas fa-check me-2" style="color: #9B59B6;"></i> Password di-reset</li>
                            <li><i class="fas fa-check me-2" style="color: #9B59B6;"></i> Email tidak terbuka</li>
                        </ul>

                        <a href="{{ route('user-web.report.create') }}" class="btn btn-sm btn-outline-primary mt-3">
                            <i class="fas fa-arrow-right me-2"></i> Laporkan Pencurian
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROSES PELAPORAN SECTION -->
<section id="section_3" class="section-padding section-bg">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Bagaimana Cara Melaporkan?</h2>
            <p class="lead text-muted">Proses pelaporan yang mudah dan aman untuk semua pengguna</p>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; background-color: #5DADE2; color: white; font-size: 32px;">
                        <i class="fas fa-forms"></i>
                    </div>
                    <h5 class="fw-bold mb-2">1. Isi Formulir</h5>
                    <p class="text-muted small">
                        Isi formulir laporan dengan detail lengkap tentang kejahatan yang terjadi.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; background-color: #48C9B0; color: white; font-size: 32px;">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h5 class="fw-bold mb-2">2. Unggah Bukti</h5>
                    <p class="text-muted small">
                        Lampirkan screenshot atau bukti digital dari kejahatan yang dilaporkan.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; background-color: #F39C12; color: white; font-size: 32px;">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h5 class="fw-bold mb-2">3. Kirim Laporan</h5>
                    <p class="text-muted small">
                        Kirim laporan Anda. Anda dapat melaporkan dengan anonim jika diinginkan.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="text-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; background-color: #27AE60; color: white; font-size: 32px;">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <h5 class="fw-bold mb-2">4. Tindak Lanjut</h5>
                    <p class="text-muted small">
                        Tim kami akan menyelidiki dan menindaklanjuti laporan Anda dalam waktu singkat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FITUR SECTION -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Keamanan & Privasi Terjamin</h2>
            <p class="lead text-muted">Semua laporan Anda dilindungi dengan enkripsi tingkat tinggi</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="card h-100 text-center" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                    <div class="card-body p-4">
                        <i class="fas fa-lock" style="font-size: 50px; color: #5DADE2; margin-bottom: 15px;"></i>
                        <h5 class="card-title fw-bold">Enkripsi Tinggi</h5>
                        <p class="card-text text-muted small">
                            Semua data Anda dienkripsi end-to-end untuk keamanan maksimal.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="card h-100 text-center" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                    <div class="card-body p-4">
                        <i class="fas fa-user-secret" style="font-size: 50px; color: #48C9B0; margin-bottom: 15px;"></i>
                        <h5 class="card-title fw-bold">Laporan Anonim</h5>
                        <p class="card-text text-muted small">
                            Anda dapat melaporkan secara anonim tanpa mengungkap identitas pribadi.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="card h-100 text-center" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                    <div class="card-body p-4">
                        <i class="fas fa-shield-alt" style="font-size: 50px; color: #F39C12; margin-bottom: 15px;"></i>
                        <h5 class="card-title fw-bold">Perlindungan Data</h5>
                        <p class="card-text text-muted small">
                            Data Anda dilindungi sesuai dengan standar keamanan internasional tertinggi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="section-padding" style="background: linear-gradient(135deg, #5DADE2 0%, #48C9B0 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-12">
                <h2 class="fw-bold mb-3">Jangan Diam, Laporkan Sekarang!</h2>
                <p class="lead">Setiap laporan membantu kami menciptakan media sosial yang lebih aman untuk semua. Keberanian Anda untuk melaporkan adalah langkah pertama menuju perubahan.</p>
            </div>
            <div class="col-lg-4 col-12 text-lg-end text-start mt-3 mt-lg-0">
                <a href="{{ route('user-web.report.create') }}" class="btn btn-lg" style="background-color: white; color: #5DADE2; border-radius: 30px; padding: 15px 40px; font-weight: bold;">
                    <i class="fas fa-exclamation-triangle me-2"></i> Buat Laporan
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ SECTION -->
<section id="section_4" class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Pertanyaan yang Sering Diajukan</h2>
        </div>

        <div class="row">
            <div class="col-lg-8 col-12 mx-auto">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Apakah laporan saya akan dirahasiakan?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, Anda dapat melaporkan secara anonim. Identitas Anda akan dilindungi kecuali Anda ingin memberikan kontak untuk follow-up.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Berapa lama waktu untuk ditindaklanjuti?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Tim kami akan menyelidiki laporan dalam 24-48 jam. Laporan prioritas tinggi akan ditangani lebih cepat.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Apa yang harus saya lampirkan dalam laporan?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Lampirkan screenshot kejadian, username pelaku, link profil, dan deskripsi detail tentang apa yang terjadi.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Apakah saya akan mendapat update tentang laporan saya?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, jika memberikan kontak email, Anda akan menerima update tentang status investigasi laporan Anda.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('css')
<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }

    .hero-section h1 {
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .badge {
        font-weight: 600;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #5DADE2;
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(93, 173, 226, 0.25);
    }

    .btn-outline-danger:hover {
        transform: translateY(-2px);
    }
</style>
@endsection