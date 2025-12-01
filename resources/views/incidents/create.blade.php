<!-- resources/views/incidents/create.blade.php -->

@extends('layouts.app')

@section('title', 'Tambah Insiden')

@section('content')
<div class="mb-4">
    <h2>Tambah Insiden Baru</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('incidents.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Korban *</label>
                    <input type="text" class="form-control @error('victim_name') is-invalid @enderror" 
                           name="victim_name" value="{{ old('victim_name') }}" required>
                    @error('victim_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kontak Korban *</label>
                    <input type="text" class="form-control @error('victim_contact') is-invalid @enderror" 
                           name="victim_contact" value="{{ old('victim_contact') }}" required>
                    @error('victim_contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Kasus *</label>
                    <select class="form-select @error('case_type') is-invalid @enderror" name="case_type" required>
                        <option value="">Pilih Jenis Kasus</option>
                        <option value="Hacking" {{ old('case_type') == 'Hacking' ? 'selected' : '' }}>Hacking</option>
                        <option value="Malware" {{ old('case_type') == 'Malware' ? 'selected' : '' }}>Malware</option>
                        <option value="Phishing" {{ old('case_type') == 'Phishing' ? 'selected' : '' }}>Phishing</option>
                        <option value="Data Breach" {{ old('case_type') == 'Data Breach' ? 'selected' : '' }}>Data Breach</option>
                        <option value="Ransomware" {{ old('case_type') == 'Ransomware' ? 'selected' : '' }}>Ransomware</option>
                        <option value="Fraud" {{ old('case_type') == 'Fraud' ? 'selected' : '' }}>Fraud</option>
                    </select>
                    @error('case_type') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Kejadian *</label>
                    <input type="datetime-local" class="form-control @error('incident_date') is-invalid @enderror" 
                           name="incident_date" value="{{ old('incident_date') }}" required>
                    @error('incident_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Lokasi (Opsional)</label>
                <input type="text" class="form-control" name="location" value="{{ old('location') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Ringkasan Kejadian *</label>
                <textarea class="form-control @error('summary') is-invalid @enderror" 
                          name="summary" rows="4" required>{{ old('summary') }}</textarea>
                @error('summary') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pelapor *</label>
                    <input type="text" class="form-control @error('reporter') is-invalid @enderror" 
                           name="reporter" value="{{ old('reporter') }}" required>
                    @error('reporter') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="Reported" {{ old('status') == 'Reported' ? 'selected' : '' }}>Reported</option>
                        <option value="Triage" {{ old('status') == 'Triage' ? 'selected' : '' }}>Triage</option>
                        <option value="In Investigation" {{ old('status') == 'In Investigation' ? 'selected' : '' }}>In Investigation</option>
                        <option value="Resolved" {{ old('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="Closed" {{ old('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('incidents.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection