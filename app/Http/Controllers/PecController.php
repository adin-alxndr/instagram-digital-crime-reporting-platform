<?php
// app/Http/Controllers/pecController.php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PecController extends Controller
{
    public function index()
    {
        // proteksi admin
        if (!session('admin_login')) {
            return redirect()->route('admin.login');
        }

        // ambil data dari reports
        $pecs = Report::whereIn('status', ['Proses'])
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->map(function ($report) {
            return (object) [
                'pec_id'   => $report->report_id,
                'victim_name'   => $report->is_anonymous ? 'Anonim' : $report->reporter_name,
                'case_type'     => ucfirst(str_replace('_', ' ', $report->crime_type)),
                'pec_date' => $report->created_at,
                'status'        => $report->status, // ambil dari DB
                'id'            => $report->id, // untuk route
                'reporter_email'=> $report->reporter_email ?? '-',
                'reporter_phone'=> $report->reporter_phone ?? '-'
            ];
        });

        return view('pec.index', compact('pecs'));
    }
    public function show($id)
    {
        $pec = Report::findOrFail($id); // ambil langsung Eloquent model
        return view('pec.show', compact('pec'));
    }
    public function process($id) {
        $pec = Report::findOrFail($id);
        return view('pec.process', compact('pec'));
    }
    public function updateProcess(Request $request, $id) {
        $pec = Report::findOrFail($id);
        $pec->status = $request->status;
        $pec->admin_notes = $request->admin_notes;
        // Optional: handle file uploads
        $pec->save();
        return redirect()->route('pec.show', $id)
                        ->with('success', 'Insiden berhasil diperbarui');
    }
// Tampilkan form khusus edit status
    public function editStatus($id)
    {
        $pec = Report::findOrFail($id);
        return view('pec.edit-status', compact('pec'));
    }

    // Update status insiden
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Baru,Proses,Selesai,Ditolak'
        ]);

        $pec = Report::findOrFail($id);
        $pec->status = $request->status;
        $pec->save();

        return redirect()->route('pec.index')->with('success', 'Status insiden berhasil diperbarui.');
    }

    public function forensic($id)
    {
        $pec = Report::findOrFail($id);
        return view('pec.forensic', compact('pec'));
    }
    public function markPecSubStep(Request $request, $id)
    {
        $pec = Report::findOrFail($id);
        $step = $request->step;         // preservation / collection / examination
        $subStep = $request->sub_step;  // 1 / 2 / 3
        $notes = $request->notes ?? '';

        $field = "{$step}_step{$subStep}";
        $notesField = "{$step}_notes";

        // Cek apakah step sebelumnya sudah selesai
        if ($subStep > 1) {
            $prevField = "{$step}_step" . ($subStep - 1);
            if (!$pec->$prevField) {
                return redirect()->back()->with('error', 'Selesaikan sub-step sebelumnya dulu.');
            }
        } elseif ($step != 'preservation') {
            // cek step sebelumnya (Preservation/Collection) sudah selesai
            $prevStep = $step == 'collection' ? 'preservation' : 'collection';
            $prevStepDone = "{$prevStep}_step3";
            if (!$pec->$prevStepDone) {
                return redirect()->back()->with('error', "Selesaikan {$prevStep} dulu.");
            }
        }

        // Tandai sub-step selesai
        $pec->$field = true;

        // Tambah catatan jika ada
        if ($notes) {
            $pec->$notesField = ($pec->$notesField ? $pec->$notesField."\n" : '') . "Sub-step {$subStep}: $notes";
        }

        $pec->save();

        return redirect()->route('pec.forensic', $id)
                        ->with('success', "Sub-step {$subStep} di {$step} berhasil diverifikasi.");
    }

    public function saveAnalysis(Request $request, $id)
    {
        $pec = Report::findOrFail($id);

        $pec->analysis_motif    = $request->motif;
        $pec->analysis_impact   = $request->impact;
        $pec->analysis_summary  = $request->summary;

        $pec->save();

        return redirect()->route('pec.forensic', $id)
                        ->with('success', 'Analisis & rekomendasi berhasil disimpan.');
    }
    public function generatePdf($id)
    {
        $pec = Report::findOrFail($id);

        $attachments = json_decode($pec->attachments, true) ?? [];

        $validImages = [];
        $otherFiles  = [];

        foreach ($attachments as $file) {
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if (in_array($ext, ['jpg','jpeg','png','gif','bmp','webp'])) {
                $validImages[] = $file;
            } else {
                $otherFiles[] = $file;
            }
        }

        $pdf = Pdf::loadView('pec.forensic_pdf', [
                'pec' => $pec,
                'validImages' => $validImages,
                'otherFiles' => $otherFiles
            ])
            ->setOptions(['isRemoteEnabled' => true]);

        return $pdf->stream('forensic_report.pdf');
    }

    // Method untuk upload lampiran bukti
    public function uploadAttachments(Request $request, $id)
    {
        $pec = Report::findOrFail($id);

        // Validasi: harus ada file
        $request->validate([
            'attachments' => 'required',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240'
        ], [
            'attachments.required' => 'Harap pilih minimal satu file sebelum upload.'
        ]);

        // Ambil file
        $files = $request->file('attachments');

        // Extra protection: jika null, hentikan
        if (!$files) {
            return redirect()->back()->withErrors(['attachments' => 'Tidak ada file yang dipilih.']);
        }

        $uploadedFiles = [];

        foreach ($files as $file) {
            // simpan file ke storage/app/public/attachments
            $stored = $file->store('attachments', 'public');

            // ambil nama file saja
            $uploadedFiles[] = basename($stored);
        }

        // gabungkan file lama
        $existing = $pec->attachments ? json_decode($pec->attachments, true) : [];
        $pec->attachments = json_encode(array_merge($existing, $uploadedFiles));

        $pec->save();

        return redirect()->route('pec.forensic', $id)
                        ->with('success', 'Lampiran berhasil diupload.');
    }

    public function deleteAttachment($id, $filename)
    {
        $pec = Report::findOrFail($id);

        // Ambil semua lampiran
        $attachments = json_decode($pec->attachments, true) ?? [];

        // Hapus file dari array
        if (($key = array_search($filename, $attachments)) !== false) {
            unset($attachments[$key]);

            // Update di database
            $pec->attachments = json_encode(array_values($attachments));
            $pec->save();

            // Hapus file fisik
            $filePath = public_path('uploads/' . $filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return redirect()->back()->with('success', 'Lampiran berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Lampiran tidak ditemukan.');
    }

}