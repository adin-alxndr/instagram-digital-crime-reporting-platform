<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class VictimController extends Controller
{
    public function index()
    {
        // proteksi admin
        if (!session('admin_login')) {
            return redirect()->route('admin.login');
        }

        // ambil data dari reports
        $victims = Report::orderBy('created_at', 'desc')->get()->map(function ($report) {
            $status = $report->status ?? 'Baru';

            return (object) [
                'victim_id'     => $report->report_id,
                'victim_name'   => $report->is_anonymous ? 'Anonim' : ($report->reporter_name ?? '-'),
                'case_type'     => $report->crime_type ? ucfirst(str_replace('_', ' ', $report->crime_type)) : '-',
                'victim_date'   => $report->created_at ?? '-',
                'status'        => $status,
                'status_color'  => getStatusColor($status),
                'id'            => $report->id,
                'reporter_email'=> $report->reporter_email ?? '-',
                'reporter_phone'=> $report->reporter_phone ?? '-'
            ];
        });

        return view('victims.index', compact('victims'));
    }
    public function show($id)
    {
        $victim = Report::findOrFail($id); // ambil langsung Eloquent model
        return view('victims.show', compact('victim'));
    }

    public function destroy($id)
    {
        $victim = Report::find($id);

        if (!$victim) {
            return redirect()->route('victims.index')
                             ->with('error', 'Korban tidak ditemukan.');
        }

        $victim->delete();

        return redirect()->route('victims.index')
                         ->with('success', 'Data berhasil dihapus.');
    }
}
