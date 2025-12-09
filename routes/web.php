<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\VictimController;
use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\UserwebController;

use App\Http\Controllers\ReportController;

// ============================================
// FRONTEND ROUTES (Public / User Web)
// ============================================

// Redirect root to home
Route::get('/', [UserwebController::class, 'home'])->name('user-web.home');

// Frontend pages with grouped routes
Route::group(['prefix' => '', 'as' => 'user-web.'], function () {
    Route::get('/home', [UserwebController::class, 'home'])->name('home');
    Route::get('/topics', [UserwebController::class, 'topics'])->name('topics');
    Route::get('/contact', [UserwebController::class, 'contact'])->name('contact');
    Route::post('/contact/submit', [UserwebController::class, 'submitContact'])->name('contact.submit');
    
    // Report routes
    Route::get('/report', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report/submit', [ReportController::class, 'store'])->name('report.submit');
    Route::get('/report/success/{reportId}', [ReportController::class, 'success'])->name('report.success');
});

// ============================================
// ADMIN DASHBOARD ROUTES (Protected)
// ============================================

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Resource routes untuk CRUD
Route::resource('incidents', IncidentController::class);
Route::resource('victims', VictimController::class);
Route::resource('evidence', EvidenceController::class);