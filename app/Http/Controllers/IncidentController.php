<?php
// app/Http/Controllers/IncidentController.php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function index()
    {
        $incidents = Incident::latest()->get();
        return view('incidents.index', compact('incidents'));
    }

    public function create()
    {
        return view('incidents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'victim_name' => 'required|string|max:255',
            'victim_contact' => 'required|string|max:255',
            'case_type' => 'required|string|max:255',
            'incident_date' => 'required|date_format:Y-m-d\TH:i',
            'location' => 'nullable|string|max:255',
            'summary' => 'required|string',
            'reporter' => 'required|string|max:255',
            'status' => 'required|in:Reported,Triage,In Investigation,Resolved,Closed',
        ]);

        $validated['incident_id'] = 'INC-' . time();
        
        try {
            Incident::create($validated);
            return redirect()->route('incidents.index')
                ->with('success', 'Insiden berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function show(Incident $incident)
    {
        return view('incidents.show', compact('incident'));
    }

    public function edit(Incident $incident)  // ← singular
    {
        return view('incidents.edit', compact('incident'));
    }

    public function update(Request $request, Incident $incident)
    {
        $validated = $request->validate([
            'victim_name' => 'required|string|max:255',
            'victim_contact' => 'required|string|max:255',
            'case_type' => 'required|string|max:255',
            'incident_date' => 'required|date_format:Y-m-d\TH:i',
            'location' => 'nullable|string|max:255',
            'summary' => 'required|string',
            'reporter' => 'required|string|max:255',
            'status' => 'required|in:Reported,Triage,In Investigation,Resolved,Closed',
        ]);

        try {
            $incident->update($validated);
            return redirect()->route('incidents.index')
                ->with('success', 'Insiden berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function destroy(Incident $incident)
    {
        try {
            $incident->delete();
            return redirect()->route('incidents.index')
                ->with('success', 'Insiden berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}