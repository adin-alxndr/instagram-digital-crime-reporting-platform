@extends('layouts.app')

@section('title', 'Detail Insiden')

@section('content')
<div class="mb-4">
    <h2>Detail Kasus {{ $incident->report_id }}</h2>
</div>

<div class="row g-3">

    <!-- INFORMASI INSIDEN -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Informasi Kasus</h5>
            </div>
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>ID Kasus</strong>
                        <p class="mb-0">{{ $incident->report_id ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Jenis Kasus</strong>
                        <p class="mb-0">{{ $incident->crime_type ? ucfirst(str_replace('_', ' ', $incident->crime_type)) : '-' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Korban Terkait</strong>
                        <p class="mb-0">{{ $incident->is_anonymous ? 'Anonim' : ($incident->reporter_name ?? '-') }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Username Terduga</strong>
                        <p class="mb-0">{{ $incident->suspect_username ?? '-' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Tanggal Pelaporan</strong>
                        <p class="mb-0">
                            {{ $incident->created_at
                                ? \Carbon\Carbon::parse($incident->created_at)->format('d M Y H:i')
                                : '-' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <strong>URL Lokasi</strong>
                        <p class="mb-0">{{ $incident->suspect_profile_url ?? '-' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Status Kasus</strong>
                        <p class="mb-0">
                            <span class="badge bg-{{ getStatusColor($incident->status ?? 'Baru') }}">
                                {{ $incident->status ?? 'Baru' }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Ringkasan Kejadian</strong>
                    <p class="mb-0">{{ $incident->description ?? '-' }}</p>
                </div>

            </div>
        </div>
    </div>

    <!-- AKSI -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Aksi</h5>
            </div>
            <div class="card-body d-grid gap-2">

                <a href="{{ route('pec.index') }}" class="btn btn-primary w-100">
                    Proses Insiden
                </a>

                <form action="{{ route('incidents.destroy', ['id' => $incident->id]) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus insiden ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        Hapus
                    </button>
                </form>

                <a href="{{ route('incidents.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>

            </div>
        </div>
    </div>

</div>
@endsection
