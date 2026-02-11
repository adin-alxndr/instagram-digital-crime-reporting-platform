@extends('layouts.app')

@section('title', 'Daftar Barang Bukti')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Barang Bukti</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="evidencesTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Evidence</th>
                        <th>Case ID</th>
                        <th>Jenis Bukti</th>
                        <th>Lokasi Penyimpanan</th>
                        <th>Waktu Penyimpanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($evidences as $evidence)
                        <tr>
                            <td>{{ $evidence->id }}</td>
                            <td>{{ $evidence->case_id }}</td>
                            <td>{{ $evidence->evidence_type }}</td>
                            <td>
                                @if ($evidence->evidence_path)
                                    <a href="{{ Storage::url($evidence->evidence_path) }}" target="_blank">
                                        Lihat Bukti
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $evidence->evidence_date ? $evidence->evidence_date->format('d M Y, H:i') : '-' }}</td>
                            <td>
                                <a href="{{ route('incidents.show', $evidence->id) }}" class="btn btn-sm btn-primary btn-action">
                                    Cek Kasus
                                </a>
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

@section('js')
<script>
    $(document).ready(function() {
        $('#evidencesTable').DataTable({
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
                paginate: { previous: "Sebelumnya", next: "Berikutnya" }
            }
        });
    });
</script>
@endsection
