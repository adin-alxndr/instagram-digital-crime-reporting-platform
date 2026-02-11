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
                                <strong><i class="bi bi-exclamation-circle me-2"></i> Kesalahan Input!</strong>
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
                                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <button type="button" class="btn btn-warning mb-4" onclick="fillSample()">
                            <i class="bi bi-magic me-2"></i> Isi Contoh Otomatis
                        </button>

                        <form action="{{ route('user-web.report.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- INFORMASI PELAPOR -->
                            <h4 class="mb-4 fw-bold">Informasi Pelapor</h4>

                            <!-- NAMA -->
                            <div class="mb-4">
                                <label for="reporter_name" class="form-label fw-bold">
                                    <i class="bi bi-person me-2"></i>Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('reporter_name') is-invalid @enderror" id="reporter_name" name="reporter_name" placeholder="Nama Anda" value="{{ old('reporter_name') }}" required>
                                @error('reporter_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- EMAIL -->
                            <div class="mb-4">
                                <label for="reporter_email" class="form-label fw-bold">
                                    <i class="bi bi-envelope me-2"></i>Email 
                                </label>
                                
                                <input type="text" class="form-control @error('reporter_email') is-invalid @enderror" id="reporter_email" name="reporter_email" placeholder="email@example.com" value="{{ old('reporter_email') }}">
                                <small class="text-muted">Untuk update status laporan (opsional untuk laporan anonim)</small>
                                @error('reporter_email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NO TELEPON -->
                            <div class="mb-4">
                                <label for="reporter_phone" class="form-label fw-bold">
                                    <i class="bi bi-phone me-2"></i>No. Telepon (Opsional)
                                </label>
                                <input type="tel" class="form-control @error('reporter_phone') is-invalid @enderror" id="reporter_phone" name="reporter_phone" placeholder="+62 812-3456-7890" value="{{ old('reporter_phone') }}">
                                @error('reporter_phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            
                            <!-- DIVIDER -->
                            <hr class="my-4">

                            <!-- Lampiran Bukti -->
                            <h4 class="mb-4 fw-bold">Detail Laporan</h4>

                            <!-- Jenis Bukti -->
                            <div class="mb-4">
                                <label for="crime_type" class="form-label fw-bold">
                                    <i class="bi bi-exclamation-triangle me-2 text-danger"></i>Jenis Kejahatan <span class="text-danger">*</span>
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

                            <!-- USERNAME PELAKU -->
                            <div class="mb-4">
                                <label for="suspect_username" class="form-label fw-bold">
                                    <i class="bi bi-person-slash me-2 text-danger"></i>Username/Akun Pelaku <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('suspect_username') is-invalid @enderror" id="suspect_username" name="suspect_username" placeholder="@username atau nama akun pelaku" value="{{ old('suspect_username') }}" required>
                                @error('suspect_username')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- PROFIL URL (OPSIONAL) -->
                            <div class="mb-4">
                                <label for="suspect_profile_url" class="form-label fw-bold">
                                    <i class="bi bi-link-45deg me-2 text-danger"></i>Link Profil Pelaku (Opsional)
                                </label>
                                <input type="url" class="form-control @error('suspect_profile_url') is-invalid @enderror" id="suspect_profile_url" name="suspect_profile_url" placeholder="https://instagram.com/username" value="{{ old('suspect_profile_url') }}">
                                @error('suspect_profile_url')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- DESKRIPSI KEJADIAN -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">
                                    <i class="bi bi-files me-2 text-danger"></i>Deskripsi Detail Kejadian <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" placeholder="Jelaskan kejadian secara detail. Kapan terjadi? Apa yang dilakukan pelaku? Bagaimana Anda terdampak?" value="{{ old('description') }}" required></textarea>
                                <small class="text-muted">Minimal 20 karakter</small>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- DIVIDER -->
                            <hr class="my-4">

                            <!-- Lampiran Bukti -->
                            <h4 class="mb-4 fw-bold">Lampiran Bukti</h4>

                            <!-- Jenis Bukti -->
                            <div class="mb-4">
                                <label for="evidence_type" class="form-label fw-bold">
                                    <i class="bi bi-archive me-2 text-warning"></i>Jenis Bukti <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('evidence_type') is-invalid @enderror" id="evidence_type" name="evidence_type" required>
                                    <option value="">-- Pilih Jenis Bukti --</option>
                                    <option value="screenshot" {{ old('evidence_type') == 'screenshot' ? 'selected' : '' }}>Screenshot</option>
                                    <option value="dokumen" {{ old('evidence_type') == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                                </select>
                                @error('evidence_type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Upload Bukti -->
                            <div class="mb-4">
                                <label for="evidence_file" class="form-label fw-bold">
                                    <i class="bi bi-upload me-2 text-warning"></i>Unggah Bukti (IMG/FILE) <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control @error('evidence_file') is-invalid @enderror"
                                    id="evidence_file" name="evidence_file"
                                    accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" required>

                                <small class="text-muted">Format: JPG, PNG, PDF, DOC, DOCX — maksimal 5MB</small>
                                @error('evidence_file')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- ANONYMOUS CHECKBOX -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input type="hidden" name="is_anonymous" value="0">
                                    <input class="form-check-input" type="checkbox" id="is_anonymous" name="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_anonymous">
                                        <i class="bi bi-person-fill-lock me-2"></i>Laporkan Secara Anonim (Identitas disembunyikan)
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
                                    <i class="bi bi-send me-2"></i> Kirim Laporan
                                </button>
                                <a href="{{ route('user-web.home') }}" class="btn btn-lg btn-outline-secondary" style="border-radius: 10px; flex: 1;">
                                    <i class="bi bi-x-lg me-2"></i> Batal
                                </a>
                            </div>

                            <!-- SECURITY NOTE -->
                            <div class="alert alert-info mt-4" style="background-color: #E8F4F8; border-color: #5DADE2; color: #2C3E50;">
                                <i class="bi bi-shield-fill-check me-2" style="color: #5DADE2;"></i>
                                <strong>Keamanan Data Terjamin:</strong> Semua informasi Anda dienkripsi dan dilindungi dengan standar keamanan internasional tertinggi.
                            </div>

                        </form>
                    </div>
                </div>

                <!-- CONTACT SUPPORT -->
                <div class="card mt-4" style="border-radius: 15px; background-color: #F5F7FA; border: 1px solid #E8EEF5;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-headset me-2" style="color: #5DADE2;"></i>Butuh Bantuan?
                        </h5>
                        <p class="text-muted mb-2">Jika Anda mengalami kesulitan dalam membuat laporan, hubungi tim support kami.</p>
                        <a href="{{ route('user-web.contact') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-envelope me-2"></i> Hubungi Support
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

@section('js')
<script>
function fillSample() {
    document.getElementById('reporter_name').value = 'Reinanda Putri';
    document.getElementById('reporter_email').value = 'reinanda@example.com';
    document.getElementById('reporter_phone').value = '+6281234567890';

    document.getElementById('crime_type').value = 'fraud';
    document.getElementById('suspect_username').value = '@scammer_indonesia';
    document.getElementById('suspect_profile_url').value = 'https://instagram.com/scammer_indonesia';

    document.getElementById('description').value =
        'Pelaku menghubungi saya melalui DM Instagram dan meminta transfer uang dengan alasan hadiah giveaway. ' +
        'Setelah ditransfer, pelaku memblokir saya. Kejadian terjadi pada 10 Juni 2024 pukul 14.30.';

    document.getElementById('evidence_type').value = 'screenshot';

    document.getElementById('is_anonymous').checked = false;
    document.getElementById('agree').checked = true;

    alert('Form berhasil diisi otomatis!\nSilakan unggah file bukti secara manual.');
}
</script>
@endsection