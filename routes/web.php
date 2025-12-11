<?php
// routes/web.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\VictimController;
use App\Http\Controllers\PecController;
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
    Route::post('/report/submit', [ReportController::class, 'submit'])->name('report.submit');
    Route::get('/report/success/{reportId}', [ReportController::class, 'success'])->name('report.success');
});

// ============================================
// ADMIN DASHBOARD ROUTES (Protected)
// ============================================

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Resource routes untuk INCIDENTS
Route::prefix('incidents')->group(function () {
    Route::get('/', [IncidentController::class, 'index'])->name('incidents.index');
    Route::get('/archive', [IncidentController::class, 'archive'])->name('incidents.archive');
    Route::get('/{id}', [IncidentController::class, 'show'])->name('incidents.show');
    Route::get('/incidents/{id}/edit-status', [IncidentController::class, 'editStatus'])->name('incidents.editStatus');
    Route::patch('/incidents/{id}/update-status', [IncidentController::class, 'updateStatus'])->name('incidents.updateStatus');
    Route::delete('/{id}', [IncidentController::class, 'destroy'])->name('incidents.destroy');
});

// Halaman daftar korban berdasarkan status
Route::prefix('victims')->group(function () {
    Route::get('/', [VictimController::class, 'index'])->name('victims.index');
    Route::get('/{id}', [VictimController::class, 'show'])->name('victims.show');
    Route::delete('/{id}', [VictimController::class, 'destroy'])->name('victims.destroy');
});

Route::resource('evidence', EvidenceController::class);

// Resource routes untuk INCIDENTS
Route::prefix('pec')->group(function () {
    Route::get('/', [PecController::class, 'index'])->name('pec.index');
    Route::get('/{id}', [PecController::class, 'show'])->name('pec.show');
    Route::delete('/{id}', [PecController::class, 'destroy'])->name('pec.destroy');

    // Tambahkan route baru untuk proses insiden
    Route::get('/{id}/process', [PecController::class, 'process'])->name('pec.process');
    Route::post('/{id}/process', [PecController::class, 'updateProcess'])->name('pec.updateProcess');

    // Tindakan forensik PEC
    Route::get('{id}/forensic', [PecController::class, 'forensic'])->name('pec.forensic');
    Route::post('{id}/forensic/mark', [PecController::class, 'markPecSubStep'])->name('pec.markPecSubStep');
    Route::get('{id}/forensic/pdf', [PecController::class, 'generatePdf'])->name('pec.generatePdf');
    Route::post('pec/{id}/save-analysis', [PecController::class, 'saveAnalysis'])
     ->name('pec.saveAnalysis');
    Route::post('/pec/{id}/upload-attachments', [PecController::class, 'uploadAttachments'])
    ->name('pec.uploadAttachments');
    Route::delete('/pec/{pec}/attachments/{filename}', [App\Http\Controllers\PecController::class, 'deleteAttachment'])
    ->name('pec.deleteAttachment');

});

// ============================================
// ADMIN SESSION ROUTES (Simple)
// ============================================

// Login
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

// Session
Route::post('/admin/login', function (Request $request) {
    // username & password TUNGGAL
    $username = 'admin';
    $password = '123';
    if (
        $request->username === $username &&
        $request->password === $password
    ) {
        session(['admin_login' => true]);
        return redirect()->route('dashboard');
    }
    return back()->with('error', 'Username atau password salah');
})->name('admin.login.submit');

// Logout
Route::get('/admin/logout', function () {
    session()->forget('admin_login');
    return redirect()->route('user-web.home');
})->name('admin.logout');
