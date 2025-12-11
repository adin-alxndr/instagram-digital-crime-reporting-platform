<!-- resources/views/pecs/index.blade.php -->

@extends('layouts.app')

@section('title', 'Daftar Korban')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Pelapor</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="pecsTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pelapor</th>
                        <th>Email Pelapor</th>
                        <th>Nomor Pelapor</th>
                        <th>Tanggal Pelaporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pecs as $pec)
                        <tr>
                            <td>{{ $pec->id }}</td>
                            <td>{{ $pec->victim_name }}</td>
                            <td>{{ $pec->reporter_email }}</td>
                            <td>{{ $pec->reporter_phone }}</td>
                            <td>{{ $pec->pec_date->format('d M Y, H:i') }}</td>
                            <td>
                                <a href="{{ route('pec.forensic', $pec->id) }}" class="btn btn-sm btn-primary btn-action">
                                    Proses
                                </a>

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

@section('js')
<script>
    $(document).ready(function() {
        $('#pecsTable').DataTable({
            paging: true,           // Pagination: Previous, next, page numbers
            searching: true,        // Instant search/filter
            ordering: true,         // Enable multi-column ordering
            orderMulti: true,       // Allow multi-column sort with shift+click
            pageLength: 10,         // Default rows per page
            columnDefs: [
                { orderable: false, targets: 5 } // Kolom aksi tidak bisa di-sort
            ],
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
            }
        });
    });
</script>
@endsection
