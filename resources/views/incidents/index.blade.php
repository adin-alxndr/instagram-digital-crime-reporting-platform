<!-- resources/views/incidents/index.blade.php -->

@extends('layouts.app')

@section('title', 'Manajemen Kasus')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manajemen Kasus</h2>
    <a href="{{ route('incidents.archive') }}" class="btn btn-secondary">
        <i class="fas fa-archive me-1"></i> Lihat Arsip
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="incidentsTable" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID Kasus</th>
                        <th>Jenis Kasus</th>
                        <th>Korban Terkait</th>
                        <th>Tanggal Pelaporan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incidents as $incident)
                        <tr>
                            <td>{{ $incident->incident_id }}</td>
                            <td>{{ $incident->case_type }}</td>
                            <td>{{ $incident->victim_name }}</td>
                            <td>{{ $incident->incident_date->format('d M Y, H:i') }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-{{ getStatusColor($incident->status ?? 'Baru') }}">
                                        {{ $incident->status ?? 'Baru' }}
                                    </span>
                                    <a href="{{ route('incidents.editStatus', $incident->id) }}" class="ms-2 text-decoration-none" title="Ubah Status">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('incidents.show', $incident->id) }}"
                                    class="btn btn-sm btn-info btn-action">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('incidents.destroy', $incident->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-action" onclick="return confirm('Yakin ingin menghapus laporan ini?')">
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

@section('js')
<script>
    $(document).ready(function() {
        $('#incidentsTable').DataTable({
            paging: true,            // pagination
            searching: true,         // instant search
            ordering: true,          // multi-column ordering
            orderMulti: true,        // enable multi-column ordering
            pageLength: 10,          // default rows per page
            language: {
                search: "Cari:",      // ganti label search
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Berikutnya"
                }
            },
            columnDefs: [
                { orderable: false, targets: 5 } // kolom Aksi tidak bisa di-sort
            ]
        });
    });
</script>
@endsection