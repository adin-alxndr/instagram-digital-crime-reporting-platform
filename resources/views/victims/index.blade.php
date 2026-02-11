<!-- resources/views/victims/index.blade.php -->

@extends('layouts.app')

@section('title', 'Daftar Korban')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Data Pelapor</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="victimsTable" class="table table-bordered table-striped table-hover">
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
                    @forelse ($victims as $victim)
                        <tr>
                            <td>{{ $victim->id }}</td>
                            <td>{{ $victim->victim_name }}</td>
                            <td>{{ $victim->reporter_email }}</td>
                            <td>{{ $victim->reporter_phone }}</td>
                            <td>{{ $victim->victim_date->format('d M Y, H:i') }}</td>
                            <td>
                                <a href="{{ route('incidents.show', $victim->id) }}" class="btn btn-sm btn-primary btn-action">
                                    Cek Kasus
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
        $('#victimsTable').DataTable({
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
