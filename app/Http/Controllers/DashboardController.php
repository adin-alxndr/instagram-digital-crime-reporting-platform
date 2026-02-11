<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Victim;
use App\Models\Evidence;

class DashboardController extends Controller
{
    public function index()
    {
        $totalIncidents = Incident::count();
        $inProgressIncidents = Incident::where('status', 'Proses')->count();
        $resolvedIncidents = Incident::whereIn('status', [
            'Selesai', 'Ditolak',
        ])->count();
        $totalVictims = Victim::count();
        $recentIncidents = Incident::latest()->take(5)->get();

        // Grafik jumlah insiden per status
        $statusChart = [
            'labels' => ['Baru', 'Proses', 'Selesai'],
            'data' => [
                Incident::where('status', 'Baru')->count(),
                $inProgressIncidents,
                $resolvedIncidents
            ]
        ];

        // Grafik insiden per bulan (12 bulan terakhir)
        $monthly = Incident::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Pastikan bulan yang tidak ada datanya = 0
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $monthly[$i] ?? 0;
        }

        return view('dashboard.index', compact(
            'totalIncidents',
            'inProgressIncidents',
            'resolvedIncidents',
            'totalVictims',
            'recentIncidents',
            'statusChart',
            'monthlyData'
        ));
    }
}