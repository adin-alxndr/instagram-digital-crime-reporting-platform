<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\VictimController;
use App\Http\Controllers\EvidenceController;

// Redirect root ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Resource routes untuk CRUD
Route::resource('incidents', IncidentController::class);
Route::resource('victims', VictimController::class);
Route::resource('evidence', EvidenceController::class);