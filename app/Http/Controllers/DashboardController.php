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
        $inProgressIncidents = Incident::where('status', 'In Investigation')->count();
        $resolvedIncidents = Incident::whereIn('status', ['Resolved', 'Closed'])->count();
        $totalVictims = Victim::count();
        $recentIncidents = Incident::latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalIncidents',
            'inProgressIncidents',
            'resolvedIncidents',
            'totalVictims',
            'recentIncidents'
        ));
    }
}