@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h2 class="mb-4 fw-bold">Dashboard</h2>

<!-- STATISTICS -->
<div class="row g-3">

    <div class="col-md-3">
        <div class="card shadow-sm text-white bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Insiden</small>
                    <h3 class="fw-bold">{{ $totalIncidents }}</h3>
                </div>
                <i class="bi bi-exclamation-circle fs-1 opacity-75"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm text-white bg-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Dalam Proses</small>
                    <h3 class="fw-bold">{{ $inProgressIncidents }}</h3>
                </div>
                <i class="bi bi-hourglass-split fs-1 opacity-75"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm text-white bg-success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Selesai</small>
                    <h3 class="fw-bold">{{ $resolvedIncidents }}</h3>
                </div>
                <i class="bi bi-check2-circle fs-1 opacity-75"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm text-white bg-info">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Pelapor</small>
                    <h3 class="fw-bold">{{ $totalVictims }}</h3>
                </div>
                <i class="bi bi-people-fill fs-1 opacity-75"></i>
            </div>
        </div>
    </div>

</div>

<!-- GRAFIK -->
<div class="row mt-4">

    <div class="col-md-6">
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-white">
                <h5 class="fw-bold mb-0">Statistik Insiden Berdasarkan Status</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-white">
                <h5 class="fw-bold mb-0">Insiden per Bulan ({{ date('Y') }})</h5>
            </div>
            <div class="card-body">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

</div>

<!-- RECENT ACTIVITY -->
<div class="card mt-4 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold">Aktivitas Terbaru</h5>
    </div>
    <div class="card-body">

        @if ($recentIncidents->count() > 0)
            <div class="list-group">

                @foreach ($recentIncidents as $incident)
                <div class="list-group-item">

                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold mb-1">
                            {{ $incident->is_anonymous ? 'Pelapor Anonim' : ($incident->reporter_name ?? 'Tidak diketahui') }}
                        </h6>

                        <small class="text-muted">
                            {{ $incident->created_at->format('d M Y, H:i') }}
                        </small>
                    </div>

                    <p class="mb-1">
                        <strong>{{ ucfirst(str_replace('_',' ', $incident->crime_type)) }}</strong> — 
                        {{ Str::limit($incident->description, 60) }}
                    </p>

                    <span class="badge bg-{{ getStatusColor($incident->status) }}">
                        {{ $incident->status }}
                    </span>

                </div>
                @endforeach

            </div>
        @else

            <p class="text-muted text-center m-0">Belum ada aktivitas insiden terbaru.</p>

        @endif

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// ------ STATUS CHART ------
const statusCtx = document.getElementById('statusChart');
new Chart(statusCtx, {
    type: 'bar',
    data: {
        labels: @json($statusChart['labels']),
        datasets: [{
            label: 'Jumlah Insiden',
            data: @json($statusChart['data']),
            borderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});

// ------ MONTHLY CHART ------
const monthlyCtx = document.getElementById('monthlyChart');
new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'],
        datasets: [{
            label: 'Insiden',
            data: @json($monthlyData),
            tension: 0.3,
            borderWidth: 2
        }]
    },
    options: {
        responsive: true
    }
});
</script>


@endsection
