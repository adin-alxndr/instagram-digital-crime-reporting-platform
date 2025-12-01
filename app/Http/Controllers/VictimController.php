<?php
// app/Http/Controllers/VictimController.php

namespace App\Http\Controllers;

use App\Models\Victim;
use Illuminate\Http\Request;

class VictimController extends Controller
{
    public function index()
    {
        $victims = Victim::withCount('incidents')->latest()->get();
        return view('victims.index', compact('victims'));
    }

    public function create()
    {
        return view('victims.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'contact' => 'required|string|max:255',
            'role' => 'required|in:User,Employee,Customer',
        ]);

        try {
            Victim::create($validated);
            return redirect()->route('victims.index')
                ->with('success', 'Korban berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function edit(Victim $victim)
    {
        return view('victims.edit', compact('victim'));
    }

    public function update(Request $request, Victim $victim)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'contact' => 'required|string|max:255',
            'role' => 'required|in:User,Employee,Customer',
        ]);

        try {
            $victim->update($validated);
            return redirect()->route('victims.index')
                ->with('success', 'Korban berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function destroy(Victim $victim)
    {
        try {
            $victim->delete();
            return redirect()->route('victims.index')
                ->with('success', 'Korban berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}