<!-- resources/views/incidents/index.blade.php -->

@extends('layouts.app')

@section('title', 'Manajemen Insiden')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Insiden</h2>
    <a href="{{ route('incidents.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Insiden
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Korban</th>
                        <th>Jenis Kasus</th>
                        <th>Tanggal Kejadian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incidents as $incident)
                        <tr>
                            <td>{{ $incident->incident_id }}</td>
                            <td>{{ $incident->victim_name }}</td>
                            <td>{{ $incident->case_type }}</td>
                            <td>{{ $incident->incident_date->format('d M Y, H:i') }}</td>
                            <td><span class="badge bg-{{ getStatusColor($incident->status) }}">{{ $incident->status }}</span></td>
                            <td>
                                <a href="{{ route('incidents.show', $incident) }}" class="btn btn-sm btn-info btn-action">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('incidents.edit', $incident) }}" class="btn btn-sm btn-warning btn-action">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('incidents.destroy', $incident) }}" method="POST" style="display:inline;">
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
                            <td colspan="6" class="text-center">Belum ada data insiden</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection