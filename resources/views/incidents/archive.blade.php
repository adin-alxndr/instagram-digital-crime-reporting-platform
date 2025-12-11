@extends('layouts.app')

@section('title', 'Arsip Kasus')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Arsip Kasus</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="archiveTable" class="table table-bordered table-hover table-striped">
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
                    @forelse ($archived as $incident)
                        <tr>
                            <td>{{ $incident->incident_id }}</td>
                            <td>{{ $incident->case_type }}</td>
                            <td>{{ $incident->victim_name }}</td>
                            <td>{{ $incident->incident_date->format('d M Y, H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ getStatusColor($incident->status) }}">
                                    {{ $incident->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('incidents.show', $incident->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada arsip kasus</td>
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
        $('#archiveTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            orderMulti: true,
            pageLength: 10,
            language: {
                search: "Cari:",
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
                { orderable: false, targets: 5 }
            ]
        });
    });
</script>
@endsection
