<!-- resources/views/incidents/show.blade.php -->

@extends('layouts.app')

@section('title', 'Detail Insiden')

@section('content')
<div class="mb-4">
    <h2>Detail Insiden {{ $incident->incident_id }}</h2>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Informasi Insiden</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-bold">ID Insiden:</label>
                        <p>{{ $incident->incident_id }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Jenis Kasus:</label>
                        <p>{{ $incident->case_type }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Korban:</label>
                        <p>{{ $incident->victim_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Kontak Korban:</label>
                        <p>{{ $incident->victim_contact }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Tanggal Kejadian:</label>
                        <p>{{ $incident->incident_date->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Lokasi:</label>
                        <p>{{ $incident->location ?? '-' }}</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Pelapor:</label>
                        <p>{{ $incident->reporter }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Status:</label>
                        <p><span class="badge bg-{{ getStatusColor($incident->status) }}">{{ $incident->status }}</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="fw-bold">Ringkasan Kejadian:</label>
                        <p>{{ $incident->summary }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Barang Bukti Terkait</h5>
            </div>
            <div class="card-body">
                @if ($incident->evidence->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>ID Bukti</th>
                                    <th>Nama</th>
                                    <th>Tipe</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($incident->evidence as $ev)
                                    <tr>
                                        <td>{{ $ev->evidence_id }}</td>
                                        <td>{{ $ev->name }}</td>
                                        <td>{{ $ev->type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>Tidak ada barang bukti terkait</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('incidents.edit', $incident) }}" class="btn btn-warning w-100 mb-2">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('incidents.index') }}" class="btn btn-secondary w-100">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection