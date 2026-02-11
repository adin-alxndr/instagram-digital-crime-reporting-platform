<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class EvidenceController extends Controller
{
    public function index()
    {
        // proteksi admin
        if (!session('admin_login')) {
            return redirect()->route('admin.login');
        }

        // ambil data dari reports
        $evidences = Report::whereNotIn('status', ['ditolak', 'selesai'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($report) {

            $status = $report->status ?? 'Baru';

            return (object) [
                'case_id'        => $report->report_id,
                'evidence_name'  => $report->is_anonymous ? 'Anonim' : ($report->reporter_name ?? '-'),
                'case_type'      => $report->crime_type ? ucfirst(str_replace('_', ' ', $report->crime_type)) : '-',
                'evidence_type'  => $report->evidence_type ?? '-',
                'evidence_date'  => $report->created_at ?? '-',
                'evidence_path'  => $report->evidence_file,
                'status'         => $status,
                'status_color'   => getStatusColor($status),
                'id'             => $report->id,
                'reporter_email' => $report->reporter_email ?? '-',
                'reporter_phone' => $report->reporter_phone ?? '-'
            ];
        });

        return view('evidences.index', compact('evidences'));
    }
    public function show($id)
    {
        $evidence = Report::findOrFail($id); // ambil langsung Eloquent model
        return view('evidences.show', compact('evidence'));
    }

    public function destroy($id)
    {
        $evidence = Report::find($id);

        if (!$evidence) {
            return redirect()->route('evidences.index')
                             ->with('error', 'Korban tidak ditemukan.');
        }

        $evidence->delete();

        return redirect()->route('evidences.index')
                         ->with('success', 'Data berhasil dihapus.');
    }
}
