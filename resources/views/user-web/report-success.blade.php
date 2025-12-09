<!-- resources/views/user-web/report-success.blade.php -->

@extends('user-web.layouts.app')

@section('title', 'Laporan Berhasil Dikirim')
@section('body-class', 'topics-listing-page')

@section('content')

<!-- SUCCESS SECTION -->
<section class="section-padding d-flex align-items-center" style="min-height: 70vh; background: linear-gradient(135deg, #F0F8FF 0%, #F5F7FA 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-12 text-center">
                <!-- SUCCESS ICON -->
                <div class="mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 120px; height: 120px; background-color: #27AE60; color: white; font-size: 60px;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>

                <!-- SUCCESS MESSAGE -->
                <h1 class="fw-bold mb-3" style="font-size: 2.5rem; color: #2C3E50;">
                    Laporan Berhasil Dikirim!
                </h1>

                <p class="lead text-muted mb-4">
                    Terima kasih telah melaporkan kejahatan digital. Laporan Anda sangat membantu dalam menciptakan media sosial yang lebih aman untuk semua.
                </p>

                <!-- REPORT ID CARD -->
                <div class="card mb-4" style="border-radius: 15px; border: 2px solid #5DADE2; background-color: white;">
                    <div class="card-body p-4">
                        <h6 class="text-muted mb-2">NOMOR REFERENSI LAPORAN</h6>
                        <h3 class="fw-bold" style="color: #5DADE2; font-size: 1.8rem; font-family: monospace;">
                            {{ $reportId }}
                        </h3>
                        <small class="text-muted">Simpan nomor ini untuk referensi Anda</small>

                        <button class="btn btn-sm btn-outline-primary mt-3" onclick="copyToClipboard('{{ $reportId }}')">
                            <i class="fas fa-copy me-2"></i> Salin Nomor
                        </button>
                    </div>
                </div>

                <!-- NEXT STEPS -->
                <div class="card mb-4" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-left: 5px solid #F39C12;">
                    <div class="card-body p-4 text-start">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-tasks me-2" style="color: #F39C12;"></i> Langkah Selanjutnya
                        </h5>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div style="width: 40px; height: 40px; background-color: #E8EEF5; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #5DADE2; font-weight: bold; margin-right: 15px; flex-shrink: 0;">
                                    1
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Tim Kami Akan Menyelidiki</h6>
                                    <p class="text-muted small mb-0">Laporan Anda akan ditinjau oleh tim forensik digital kami dalam 24-48 jam.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div style="width: 40px; height: 40px; background-color: #E8EEF5; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #5DADE2; font-weight: bold; margin-right: 15px; flex-shrink: 0;">
                                    2
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Penerimaan Email Konfirmasi</h6>
                                    <p class="text-muted small mb-0">Anda akan menerima email konfirmasi dengan detail laporan Anda.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div style="width: 40px; height: 40px; background-color: #E8EEF5; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #5DADE2; font-weight: bold; margin-right: 15px; flex-shrink: 0;">
                                    3
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Update Status Investigasi</h6>
                                    <p class="text-muted small mb-0">Kami akan memberikan update berkala tentang kemajuan investigasi laporan Anda.</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex">
                                <div style="width: 40px; height: 40px; background-color: #E8EEF5; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #5DADE2; font-weight: bold; margin-right: 15px; flex-shrink: 0;">
                                    4
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Tindakan Lanjutan</h6>
                                    <p class="text-muted small mb-0">Bergantung pada temuan, kami akan melaporkan ke pihak berwenang jika diperlukan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INFO BOX -->
                <div class="alert alert-info mb-4" style="background-color: #E8F4F8; border-color: #5DADE2; border-left: 5px solid #5DADE2;">
                    <i class="fas fa-info-circle me-2" style="color: #5DADE2;"></i>
                    <strong>Privasi Terjamin:</strong> Jika Anda melaporkan secara anonim, identitas Anda tidak akan dibagikan kepada siapapun.
                </div>

                <!-- BUTTONS -->
                <div class="d-grid gap-2 d-md-flex justify-content-center">
                    <a href="{{ route('user-web.home') }}" class="btn btn-lg btn-primary" style="background-color: #5DADE2; border-radius: 10px; padding: 12px 30px;">
                        <i class="fas fa-home me-2"></i> Kembali ke Beranda
                    </a>
                    <a href="{{ route('user-web.report.create') }}" class="btn btn-lg btn-outline-primary" style="border-radius: 10px; padding: 12px 30px;">
                        <i class="fas fa-plus me-2"></i> Buat Laporan Lain
                    </a>
                </div>

                <!-- FAQ -->
                <div class="mt-5">
                    <h5 class="fw-bold mb-3">Pertanyaan Umum</h5>
                    
                    <div class="accordion" id="successFaqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sfaq1">
                                    Bagaimana saya bisa melacak status laporan?
                                </button>
                            </h2>
                            <div id="sfaq1" class="accordion-collapse collapse" data-bs-parent="#successFaqAccordion">
                                <div class="accordion-body text-start">
                                    Gunakan nomor referensi laporan Anda untuk melacak status di dashboard. Anda juga akan menerima email update berkala.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sfaq2">
                                    Apakah akun pelaku akan langsung ditangguhkan?
                                </button>
                            </h2>
                            <div id="sfaq2" class="accordion-collapse collapse" data-bs-parent="#successFaqAccordion">
                                <div class="accordion-body text-start">
                                    Tindakan tergantung pada investigasi kami. Beberapa kasus memerlukan eskalasi ke platform atau pihak berwenang.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sfaq3">
                                    Berapa lama investigasi biasanya berlangsung?
                                </button>
                            </h2>
                            <div id="sfaq3" class="accordion-collapse collapse" data-bs-parent="#successFaqAccordion">
                                <div class="accordion-body text-start">
                                    Biasanya 5-14 hari tergantung kompleksitas kasus. Kasus prioritas tinggi dapat diselesaikan lebih cepat.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Nomor referensi disalin ke clipboard!');
        }).catch(() => {
            alert('Gagal menyalin. Silakan coba lagi.');
        });
    }
</script>
@endsection