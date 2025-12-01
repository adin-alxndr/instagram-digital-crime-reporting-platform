<!-- resources/views/victims/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Edit Korban')

@section('content')
<div class="mb-4">
    <h2>Edit Korban</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('victims.update', $victim) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       name="name" value="{{ old('name', $victim->name) }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Organisasi</label>
                <input type="text" class="form-control" name="organization" value="{{ old('organization', $victim->organization) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Kontak *</label>
                <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                       name="contact" value="{{ old('contact', $victim->contact) }}" required>
                @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Peran</label>
                <select class="form-select" name="role">
                    <option value="User" {{ old('role', $victim->role) == 'User' ? 'selected' : '' }}>User</option>
                    <option value="Employee" {{ old('role', $victim->role) == 'Employee' ? 'selected' : '' }}>Employee</option>
                    <option value="Customer" {{ old('role', $victim->role) == 'Customer' ? 'selected' : '' }}>Customer</option>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('victims.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection