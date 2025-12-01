<!-- resources/views/evidence/index.blade.php -->

@extends('layouts.app')

@section('title', 'Manajemen Barang Bukti')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Barang Bukti</h2>
    <a href="{{ route('evidence.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Barang Bukti
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID Bukti</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Insiden Terkait</th>
                        <th>Hash (SHA256)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($evidence as $ev)
                        <tr>
                            <td>{{ $ev->evidence_id }}</td>
                            <td>{{ $ev->name }}</td>
                            <td>{{ $ev->type }}</td>
                            <td>{{ $ev->incident->incident_id }}</td>
                            <td>
                                <small class="font-monospace">
                                    {{ $ev->hash ? Str::limit($ev->hash, 16, '...') : '-' }}
                                </small>
                            </td>
                            <td>
                                <a href="{{ route('evidence.edit', $ev) }}" class="btn btn-sm btn-warning btn-action">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('evidence.destroy', $ev) }}" method="POST" style="display:inline;">
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
                            <td colspan="6" class="text-center">Belum ada data barang bukti</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection