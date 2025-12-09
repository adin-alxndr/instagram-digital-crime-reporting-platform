<!-- resources/views/user-web/report.blade.php -->

@extends('user-web.app')

@section('title', 'Laporkan Kejahatan Digital - Digital Forensik System')
@section('body-class', 'topics-listing-page')

@section('content')

<!-- HEADER SECTION -->
<header class="site-header d-flex flex-column justify-content-center align-items-center" style="background: linear-gradient(135deg, #5DADE2 0%, #48C9B0 100%); min-height: 40vh; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: transparent;">
                        <li class="breadcrumb-item"><a href="{{ route('user-web.home') }}" style="color: white;">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: rgba(255,255,255,0.9);">Laporan Kejahatan</li>
                    </ol>
                </nav>
                <h1 class="text-white fw-bold mb-3" style="font-size: 2.5rem;">Laporkan Kejahatan Digital</h1>
                <p class="lead" style="color: rgba(255,255,255,0.95);">Formulir pelaporan aman dan terenkripsi untuk kejahatan di media sosial Instagram dan platform lainnya</p>
            </div>
        </div>
    </div>
</header>

<!-- FORM SECTION -->
<section class="section-padding">
    <div class="container">
        <div class="row">
            <!-- FORM COLUMN -->
            <div class="col-lg-8 col-12 mx-auto">
                <div class="card" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                    <div class="card-body p-5">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-exclamation-circle me-2"></i> Kesalahan Input!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <h3 class="mb-4 fw-bold">Detail Laporan</h3>

                        <form action="{{ route('user-web.report.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- JENIS KEJAHATAN -->
                            <div class="mb-4">
                                <label for="crime_type" class="form-label fw-bold">
                                    <i class="fas fa-exclamation-triangle me-2 text-danger"></i>Jenis Kejahatan <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('crime_type') is-invalid @enderror" id="crime_type" name="crime_type" required>
                                    <option value="">-- Pilih Jenis Kejahatan --</option>
                                    <option value="cyberbullying" {{ old('crime_type') == 'cyberbullying' ? 'selected' : '' }}>Pelecehan & Cyberbullying</option>
                                    <option value="fraud" {{ old('crime_type') == 'fraud' ? 'selected' : '' }}>Penipuan & Scam</option>
                                    <option value="harmful_content" {{ old('crime_type') == 'harmful_content' ? 'selected' : '' }}>Konten Berbahaya</option>
                                    <option value="identity_theft" {{ old('crime_type') == 'identity_theft' ? 'selected' : '' }}>Pencurian Identitas</option>
                                    <option value="other" {{ old('crime_type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('crime_type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- PLATFORM -->
                            <div class="mb-4">
                                <label for="platform" class="form-label fw-bold">
                                    <i class="fab fa-instagram me-2" style="color: #E4405F;"></i>Platform Media Sosial <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('platform') is-invalid @enderror" id="platform" name="platform" required>
                                    <option value="">-- Pilih Platform --</option>
                                    <option value="instagram" {{ old('platform') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                    <option value="facebook" {{ old('platform') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                    <option value="twitter" {{ old('platform') == 'twitter' ? 'selected' : '' }}>Twitter/X</option>
                                    <option value="tiktok" {{ old('platform') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                                    <option value="youtube" {{ old('platform') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                    <option value="telegram" {{ old('platform') == 'telegram' ? 'selected' : '' }}>Telegram</option>
                                    <option value="other" {{ old('platform') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('platform')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- USERNAME PELAKU -->
                            <div class="mb-4">
                                <label for="suspect_username" class="form-label fw-bold">
                                    <i class="fas fa-user-slash me-2 text-warning"></i>Username/Akun Pelaku <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('suspect_username') is-invalid @enderror" id="suspect_username" name="suspect_username" placeholder="@username atau nama akun pelaku" value="{{ old('suspect_username') }}" required>
                                @error('suspect_username')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- PROFIL URL (OPSIONAL) -->
                            <div class="mb-4">
                                <label for="suspect_profile_url" class="form-label fw-bold">
                                    <i class="fas fa-link me-2"></i>Link Profil Pelaku (Opsional)
                                </label>
                                <input type="url" class="form-control @error('suspect_profile_url') is-invalid @enderror" id="suspect_profile_url" name="suspect_profile_url" placeholder="https://instagram.com/username" value="{{ old('suspect_profile_url') }}">
                                @error('suspect_profile_url')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- DESKRIPSI KEJADIAN -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-file-alt me-2"></i>Deskripsi Detail Kejadian <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" placeholder="Jelaskan kejadian secara detail. Kapan terjadi? Apa yang dilakukan pelaku? Bagaimana Anda terdampak?" value="{{ old('description') }}" required></textarea>
                                <small class="text-muted">Minimal 20 karakter</small>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- BUKTI SCREENSHOT -->
                            <div class="mb-4">
                                <label for="screenshot" class="form-label fw-bold">
                                    <i class="fas fa-camera me-2"></i>Unggah Screenshot/Bukti <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="file" class="form-control @error('screenshot') is-invalid @enderror" id="screenshot" name="screenshot" accept="image/*,.pdf" required>
                                    <span class="input-group-text">
                                        <i class="fas fa-image"></i>
                                    </span>
                                </div>
                                <small class="text-muted">Format: JPG, PNG, PDF (Max. 5MB)</small>
                                @error('screenshot')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- DIVIDER -->
                            <hr class="my-4">

                            <!-- INFORMASI PELAPOR -->
                            <h4 class="mb-4 fw-bold">Informasi Pelapor</h4>

                            <!-- NAMA -->
                            <div class="mb-4">
                                <label for="reporter_name" class="form-label fw-bold">
                                    <i class="fas fa-user me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('reporter_name') is-invalid @enderror" id="reporter_name" name="reporter_name" placeholder="Nama Anda" value="{{ old('reporter_name') }}" required>
                                @error('reporter_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- EMAIL -->
                            <div class="mb-4">
                                <label for="reporter_email" class="form-label fw-bold">
                                    <i class="fas fa-envelope me-2"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control @error('reporter_email') is-invalid @enderror" id="reporter_email" name="reporter_email" placeholder="email@example.com" value="{{ old('reporter_email') }}" required>
                                <small class="text-muted">Untuk update status laporan (opsional untuk laporan anonim)</small>
                                @error('reporter_email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NO TELEPON -->
                            <div class="mb-4">
                                <label for="reporter_phone" class="form-label fw-bold">
                                    <i class="fas fa-phone me-2"></i>No. Telepon (Opsional)
                                </label>
                                <input type="tel" class="form-control @error('reporter_phone') is-invalid @enderror" id="reporter_phone" name="reporter_phone" placeholder="+62 812-3456-7890" value="{{ old('reporter_phone') }}">
                                @error('reporter_phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ANONYMOUS CHECKBOX -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_anonymous" name="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_anonymous">
                                        <i class="fas fa-user-secret me-2"></i>Laporkan Secara Anonim (Identitas disembunyikan)
                                    </label>
                                </div>
                            </div>

                            <!-- AGREEMENT -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input @error('agree') is-invalid @enderror" type="checkbox" id="agree" name="agree" value="1" {{ old('agree') ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="agree">
                                        Saya setuju bahwa informasi yang saya berikan adalah benar dan akurat <span class="text-danger">*</span>
                                    </label>
                                    @error('agree')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- SUBMIT BUTTON -->
                            <div class="d-grid gap-2 d-md-flex">
                                <button type="submit" class="btn btn-lg" style="background-color: #5DADE2; color: white; border-radius: 10px; flex: 1;">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Laporan
                                </button>
                                <a href="{{ route('user-web.home') }}" class="btn btn-lg btn-outline-secondary" style="border-radius: 10px; flex: 1;">
                                    <i class="fas fa-times me-2"></i> Batal
                                </a>
                            </div>

                            <!-- SECURITY NOTE -->
                            <div class="alert alert-info mt-4" style="background-color: #E8F4F8; border-color: #5DADE2; color: #2C3E50;">
                                <i class="fas fa-shield-alt me-2" style="color: #5DADE2;"></i>
                                <strong>Keamanan Data Terjamin:</strong> Semua informasi Anda dienkripsi dan dilindungi dengan standar keamanan internasional tertinggi.
                            </div>

                        </form>
                    </div>
                </div>

                <!-- CONTACT SUPPORT -->
                <div class="card mt-4" style="border-radius: 15px; background-color: #F5F7FA; border: 1px solid #E8EEF5;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-headset me-2" style="color: #5DADE2;"></i>Butuh Bantuan?
                        </h5>
                        <p class="text-muted mb-2">Jika Anda mengalami kesulitan dalam membuat laporan, hubungi tim support kami.</p>
                        <a href="{{ route('user-web.contact') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i> Hubungi Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('css')
<style>
    .form-control:focus,
    .form-select:focus {
        border-color: #5DADE2;
        box-shadow: 0 0 0 0.2rem rgba(93, 173, 226, 0.25);
    }

    .form-check-input:checked {
        background-color: #5DADE2;
        border-color: #5DADE2;
    }

    .form-check-input:focus {
        border-color: #5DADE2;
        box-shadow: 0 0 0 0.2rem rgba(93, 173, 226, 0.25);
    }

    .invalid-feedback {
        color: #E74C3C;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }
</style>
@endsection