<!-- resources/views/evidence/create.blade.php -->

@extends('layouts.app')

@section('title', 'Tambah Barang Bukti')

@section('content')
<div class="mb-4">
    <h2>Tambah Barang Bukti</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('evidence.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">ID Bukti *</label>
                    <input type="text" class="form-control @error('evidence_id') is-invalid @enderror" 
                           name="evidence_id" value="{{ old('evidence_id') }}" required>
                    @error('evidence_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Bukti *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipe *</label>
                    <select class="form-select @error('type') is-invalid @enderror" name="type" required>
                        <option value="">Pilih Tipe</option>
                        <option value="Disk Image" {{ old('type') == 'Disk Image' ? 'selected' : '' }}>Disk Image</option>
                        <option value="Log File" {{ old('type') == 'Log File' ? 'selected' : '' }}>Log File</option>
                        <option value="Screenshot" {{ old('type') == 'Screenshot' ? 'selected' : '' }}>Screenshot</option>
                        <option value="Perangkat Fisik" {{ old('type') == 'Perangkat Fisik' ? 'selected' : '' }}>Perangkat Fisik</option>
                        <option value="Memory Dump" {{ old('type') == 'Memory Dump' ? 'selected' : '' }}>Memory Dump</option>
                    </select>
                    @error('type') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Insiden Terkait *</label>
                    <select class="form-select @error('incident_id') is-invalid @enderror" name="incident_id" required>
                        <option value="">Pilih Insiden</option>
                        @foreach ($incidents as $incident)
                            <option value="{{ $incident->id }}" {{ old('incident_id') == $incident->id ? 'selected' : '' }}>
                                {{ $incident->incident_id }} - {{ $incident->victim_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('incident_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Hash (SHA256)</label>
                    <input type="text" class="form-control" name="hash" value="{{ old('hash') }}" 
                           placeholder="Auto-generated jika upload file">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Lokasi Fisik</label>
                    <input type="text" class="form-control" name="physical_location" value="{{ old('physical_location') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Diambil Oleh *</label>
                    <input type="text" class="form-control @error('acquired_by') is-invalid @enderror" 
                           name="acquired_by" value="{{ old('acquired_by') }}" required>
                    @error('acquired_by') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Diambil *</label>
                    <input type="datetime-local" class="form-control @error('acquired_at') is-invalid @enderror" 
                           name="acquired_at" value="{{ old('acquired_at', now()->format('Y-m-d\TH:i')) }}" required>
                    @error('acquired_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('evidence.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection