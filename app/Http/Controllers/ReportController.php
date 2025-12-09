<?php
// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display report form
     */
    public function create()
    {
        return view('user-web.report');
    }

    /**
     * Handle report form submission
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'crime_type' => 'required|in:cyberbullying,fraud,harmful_content,identity_theft,other',
            'platform' => 'required|in:instagram,facebook,twitter,tiktok,youtube,telegram,other',
            'suspect_username' => 'required|string|max:255',
            'suspect_profile_url' => 'nullable|url|max:500',
            'description' => 'required|string|min:20|max:5000',
            'screenshot' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'reporter_name' => 'required|string|max:255',
            'reporter_email' => 'required|email|max:255',
            'reporter_phone' => 'nullable|string|max:20',
            'is_anonymous' => 'nullable|boolean',
            'agree' => 'required|accepted',
        ], [
            'crime_type.required' => 'Jenis kejahatan harus dipilih',
            'crime_type.in' => 'Jenis kejahatan tidak valid',
            'platform.required' => 'Platform media sosial harus dipilih',
            'platform.in' => 'Platform tidak valid',
            'suspect_username.required' => 'Username pelaku harus diisi',
            'suspect_username.max' => 'Username terlalu panjang',
            'suspect_profile_url.url' => 'Format URL tidak valid',
            'description.required' => 'Deskripsi kejadian harus diisi',
            'description.min' => 'Deskripsi minimal 20 karakter',
            'description.max' => 'Deskripsi maksimal 5000 karakter',
            'screenshot.required' => 'Screenshot/bukti harus diunggah',
            'screenshot.file' => 'Screenshot harus berupa file',
            'screenshot.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'screenshot.max' => 'Ukuran file maksimal 5MB',
            'reporter_name.required' => 'Nama pelapor harus diisi',
            'reporter_name.max' => 'Nama terlalu panjang',
            'reporter_email.required' => 'Email harus diisi',
            'reporter_email.email' => 'Format email tidak valid',
            'reporter_phone.max' => 'No. telepon terlalu panjang',
            'agree.required' => 'Anda harus menyetujui pernyataan keakuratan informasi',
            'agree.accepted' => 'Anda harus menyetujui pernyataan keakuratan informasi',
        ]);

        try {
            // Generate unique report ID
            $reportId = 'RPT-' . strtoupper(uniqid());
            
            // Handle file upload
            $screenshotPath = null;
            if ($request->hasFile('screenshot')) {
                $file = $request->file('screenshot');
                $filename = $reportId . '-' . time() . '.' . $file->getClientOriginalExtension();
                $screenshotPath = $file->storeAs('reports', $filename, 'public');
            }

            // If anonymous, clear reporter details (optional)
            if ($validated['is_anonymous']) {
                $validated['reporter_email'] = 'anonymous@system.local';
                $validated['reporter_phone'] = null;
            }

            // Save to session/database (if you have Report model)
            // Report::create([
            //     'report_id' => $reportId,
            //     'crime_type' => $validated['crime_type'],
            //     'platform' => $validated['platform'],
            //     'suspect_username' => $validated['suspect_username'],
            //     'suspect_profile_url' => $validated['suspect_profile_url'],
            //     'description' => $validated['description'],
            //     'screenshot_path' => $screenshotPath,
            //     'reporter_name' => $validated['reporter_name'],
            //     'reporter_email' => $validated['reporter_email'],
            //     'reporter_phone' => $validated['reporter_phone'],
            //     'is_anonymous' => $validated['is_anonymous'],
            //     'status' => 'pending',
            // ]);

            // Optional: Send email notification
            // Mail::send('emails.report-confirmation', [...], function($message) {
            //     $message->to($validated['reporter_email'])
            //             ->subject('Laporan Diterima - ' . $reportId);
            // });

            // Log report
            \Log::info('Crime Report Submitted', [
                'report_id' => $reportId,
                'crime_type' => $validated['crime_type'],
                'platform' => $validated['platform'],
                'is_anonymous' => $validated['is_anonymous'],
            ]);

            return redirect()->route('user-web.report.success', ['reportId' => $reportId])
                ->with('success', 'Laporan Anda telah dikirim dengan ID: ' . $reportId);

        } catch (\Exception $e) {
            \Log::error('Report Submission Error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat mengirim laporan. Silakan coba lagi.'])
                ->withInput();
        }
    }

    /**
     * Show success page
     */
    public function success($reportId)
    {
        return view('user-web.report-success', compact('reportId'));
    }
}