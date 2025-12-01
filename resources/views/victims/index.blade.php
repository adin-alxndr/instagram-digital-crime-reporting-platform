<!-- resources/views/victims/index.blade.php -->

@extends('layouts.app')

@section('title', 'Manajemen Korban')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Korban</h2>
    <a href="{{ route('victims.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Korban
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Organisasi</th>
                        <th>Kontak</th>
                        <th>Total Insiden</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($victims as $victim)
                        <tr>
                            <td>{{ $victim->id }}</td>
                            <td>{{ $victim->name }}</td>
                            <td>{{ $victim->organization ?? '-' }}</td>
                            <td>{{ $victim->contact }}</td>
                            <td><span class="badge bg-info">{{ $victim->incidents_count ?? 0 }}</span></td>
                            <td>
                                <a href="{{ route('victims.edit', $victim) }}" class="btn btn-sm btn-warning btn-action">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('victims.destroy', $victim) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data korban</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection