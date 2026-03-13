<?php

namespace App\Http\Controllers;

use App\Models\Usager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsagerController extends Controller
{
    public function index(Request $request)
    {
        $query = Usager::query();

        if ($request->filled('q')) {
            $query->where('email', 'like', '%' . $request->q . '%');
        }

        $usagers = $query->orderBy('email')->paginate(15)->withQueryString();

        return view('usagers.index', [
            'usagers' => $usagers,
            'q' => $request->q,
        ]);
    }

    public function create()
    {
        return view('usagers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:usagers,email'],
            'mdp' => ['required', 'string', 'min:6'],
        ]);

        Usager::create([
            'email' => $validated['email'],
            'mdp' => Hash::make($validated['mdp']),
        ]);

        return redirect()
            ->route('usagers.index')
            ->with('success', 'Usager ajouté avec succès.');
    }

    public function show(Usager $usager)
    {
        $usager->load('emprunts.exemplaire.livre');

        return view('usagers.show', [
            'usager' => $usager,
        ]);
    }

    public function edit(Usager $usager)
    {
        return view('usagers.edit', [
            'usager' => $usager,
        ]);
    }

    public function update(Request $request, Usager $usager)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:usagers,email,' . $usager->id],
            'mdp' => ['nullable', 'string', 'min:6'],
        ]);

        $data = [
            'email' => $validated['email'],
        ];

        if (!empty($validated['mdp'])) {
            $data['mdp'] = Hash::make($validated['mdp']);
        }

        $usager->update($data);

        return redirect()
            ->route('usagers.index')
            ->with('success', 'Usager modifié avec succès.');
    }

    public function destroy(Usager $usager)
    {
        if ($usager->emprunts()->whereNull('date_retour')->exists()) {
            return redirect()
                ->route('usagers.index')
                ->withErrors([
                    'email' => 'Impossible de supprimer cet usager car il a un emprunt en cours.',
                ]);
        }

        $usager->delete();

        return redirect()
            ->route('usagers.index')
            ->with('success', 'Usager supprimé avec succès.');
    }
}
