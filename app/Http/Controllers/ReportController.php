<?php
// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    /**
     * Display report form
     */
    public function create()
    {
        return view('user-web.report');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'reporter_name' => 'nullable|string|max:255',
            'reporter_email' => 'nullable|email|max:255',
            'reporter_phone' => [
                'nullable',
                'regex:/^\+62\d{8,15}$/'
            ],
            'crime_type' => 'required|string|in:cyberbullying,fraud,harmful_content,identity_theft,other',
            'suspect_username' => 'required|string|max:255',
            'suspect_profile_url' => 'nullable|url|max:255',
            'description' => 'required|string|min:20|max:2000',
            'evidence_type' => 'required|string|in:screenshot,photo,video,document',
            'evidence_file' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'is_anonymous' => 'nullable|boolean',
            'agree' => 'required|accepted',
        ], [
            'reporter_phone.regex' => 'Nomor telepon harus diawali +62 dan berisi 8-15 digit angka.',
            'crime_type.in' => 'Jenis kejahatan tidak valid.',
            'evidence_type.in' => 'Jenis bukti tidak valid.',
            'description.min' => 'Deskripsi terlalu pendek, minimal 20 karakter.',
            'description.max' => 'Deskripsi terlalu panjang, maksimal 2000 karakter.',
            'evidence_file.mimes' => 'Bukti harus berupa file JPG atau PNG.',
            'evidence_file.max' => 'Ukuran file maksimal 5MB.',
            'agree.required' => 'Anda harus menyetujui bahwa informasi yang diberikan benar.',
        ]);

        // Upload file bukti jika ada
        $filePath = null;
        if ($request->hasFile('evidence_file')) {
            $filePath = $request->file('evidence_file')->store('evidences', 'public');
        }

         // Simpan data ke database
        $report = Report::create([
            'report_id' => 'RPT-' . strtoupper(Str::random(8)),
            'reporter_name' => $request->reporter_name,
            'reporter_email' => $request->reporter_email,
            'reporter_phone' => $request->reporter_phone,
            'crime_type' => $request->crime_type,
            'suspect_username' => $request->suspect_username,
            'suspect_profile_url' => $request->suspect_profile_url,
            'description' => $request->description,
            'evidence_type' => $request->evidence_type,
            'is_anonymous' => $request->is_anonymous,
            'agree' => $request->agree,
            'evidence_file' => $filePath,
        ]);


        return redirect()->route('user-web.report.success', $report->report_id)
                 ->with('success', 'Laporan berhasil dikirim!');

    }

    /**
     * Show success page
     */
    public function success($reportId)
    {
        return view('user-web.report-success', compact('reportId'));
    }
}