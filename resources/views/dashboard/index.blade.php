<!-- resources/views/dashboard/index.blade.php -->

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h2 class="mb-4">Dashboard</h2>

<div class="row">
    <div class="col-md-3">
        <div class="card stat-card bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total Insiden</h6>
                    <h2>{{ $totalIncidents }}</h2>
                </div>
                <i class="fas fa-exclamation-circle stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-warning text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Dalam Investigasi</h6>
                    <h2>{{ $inProgressIncidents }}</h2>
                </div>
                <i class="fas fa-search stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-success text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Selesai</h6>
                    <h2>{{ $resolvedIncidents }}</h2>
                </div>
                <i class="fas fa-check-circle stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card bg-info text-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total Korban</h6>
                    <h2>{{ $totalVictims }}</h2>
                </div>
                <i class="fas fa-user-injured stat-icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">Aktivitas Terbaru</h5>
    </div>
    <div class="card-body">
        @if ($recentIncidents->count() > 0)
            <div class="list-group">
                @foreach ($recentIncidents as $incident)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">{{  $incident->victim_name ?? 'N/A' }}</h6>
                            <small>{{ $incident->created_at->format('d M Y, H:i') }}</small>
                        </div>
                        <p class="mb-1">
                            {{ $incident->case_type }} - 
                            {{ Str::limit($incident->summary, 50) }}
                        </p>
                        <span class="badge bg-{{ getStatusColor($incident->status) }}">
                            {{ $incident->status }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="list-group-item">Belum ada aktivitas</div>
        @endif
    </div>
</div>
@endsection