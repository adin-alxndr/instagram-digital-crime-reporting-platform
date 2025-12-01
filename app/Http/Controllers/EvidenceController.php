<?php

// app/Http/Controllers/EvidenceController.php

namespace App\Http\Controllers;

use App\Models\Evidence;
use App\Models\Incident;
use Illuminate\Http\Request;

class EvidenceController extends Controller
{
    public function index()
    {
        $evidence = Evidence::with('incident')->latest()->get();
        return view('evidience.index', compact('evidence'));
    }

    public function create()
    {
        $incidents = Incident::all();
        return view('evidience.create', compact('incidents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'evidence_id' => 'required|string|unique:evidence,evidence_id',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'incident_id' => 'required|exists:incidents,id',
            'description' => 'nullable|string',
            'hash' => 'nullable|string|max:255',
            'physical_location' => 'nullable|string|max:255',
            'acquired_by' => 'required|string|max:255',
            'acquired_at' => 'required|date_format:Y-m-d\TH:i',
        ]);

        try {
            Evidence::create($validated);
            return redirect()->route('evidence.index')
                ->with('success', 'Barang bukti berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function edit(Evidence $evidence)
    {
        $incidents = Incident::all();
        return view('evidience.edit', compact('evidence', 'incidents'));
    }

    public function update(Request $request, Evidence $evidence)
    {
        $validated = $request->validate([
            'evidence_id' => 'required|string|unique:evidence,evidence_id,' . $evidence->id,
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'incident_id' => 'required|exists:incidents,id',
            'description' => 'nullable|string',
            'hash' => 'nullable|string|max:255',
            'physical_location' => 'nullable|string|max:255',
            'acquired_by' => 'required|string|max:255',
            'acquired_at' => 'required|date_format:Y-m-d\TH:i',
        ]);

        try {
            $evidence->update($validated);
            return redirect()->route('evidence.index')
                ->with('success', 'Barang bukti berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function destroy(Evidence $evidence)
    {
        try {
            $evidence->delete();
            return redirect()->route('evidence.index')
                ->with('success', 'Barang bukti berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}