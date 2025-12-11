<?php
// app/Http/Controllers/IncidentController.php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class IncidentController extends Controller
{
    public function index()
    {
        // proteksi admin
        if (!session('admin_login')) {
            return redirect()->route('admin.login');
        }

        // ambil data dari reports
        $incidents = Report::whereNotIn('status', ['Selesai', 'Ditolak'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($report) {
                return (object) [
                    'incident_id'   => $report->report_id,
                    'victim_name'   => $report->is_anonymous ? 'Anonim' : $report->reporter_name,
                    'case_type'     => ucfirst(str_replace('_', ' ', $report->crime_type)),
                    'incident_date' => $report->created_at,
                    'status'        => $report->status ?? 'Baru', // set default jika null
                    'id'            => $report->id,
                    'reporter_email'=> $report->reporter_email ?? '-',
                    'reporter_phone'=> $report->reporter_phone ?? '-'
                ];
            });

        return view('incidents.index', compact('incidents'));
    }
    public function show($id)
    {
        $incident = Report::findOrFail($id); // ambil langsung Eloquent model
        return view('incidents.show', compact('incident'));
    }
    // Halaman arsip: kasus Selesai atau Ditolak
    public function archive()
    {
        $archived = Report::whereIn('status', ['Selesai', 'Ditolak'])
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->map(function ($report) {
                            return (object) [
                                'incident_id'   => $report->report_id,
                                'case_type'     => ucfirst(str_replace('_', ' ', $report->crime_type)),
                                'victim_name'   => $report->reporter_name ?? 'Anonim',
                                'incident_date' => $report->created_at,
                                'status'        => $report->status,
                                'id'            => $report->id,
                            ];
                        });

        return view('incidents.archive', compact('archived'));
    }
    // Tampilkan form khusus edit status
    public function editStatus($id)
    {
        $incident = Report::findOrFail($id);
        return view('incidents.edit-status', compact('incident'));
    }

    // Update status insiden
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Baru,Proses,Selesai,Ditolak'
        ]);

        $incident = Report::findOrFail($id);
        $incident->status = $request->status;
        $incident->save();

        return redirect()->route('incidents.index')->with('success', 'Status insiden berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $incident = Report::find($id);

        if (!$incident) {
            return redirect()->route('incidents.index')
                             ->with('error', 'Insiden tidak ditemukan.');
        }

        $incident->delete();

        return redirect()->route('incidents.index')
                         ->with('success', 'Insiden berhasil dihapus.');
    }

}