<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use Illuminate\Http\Request;

class AuteurController extends Controller
{
    public function index(Request $request)
    {
        $query = Auteur::query();

        if ($request->filled('q')) {
            $query->where('nom', 'like', '%' . $request->q . '%');
        }

        $auteurs = $query->orderBy('nom')->paginate(15)->withQueryString();

        return view('auteurs.index', [
            'auteurs' => $auteurs,
            'q' => $request->q,
        ]);
    }

    public function create()
    {
        return view('auteurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
        ]);

        Auteur::create($validated);

        return redirect()
            ->route('auteurs.index')
            ->with('success', 'Auteur ajouté avec succès.');
    }

    public function show(Auteur $auteur)
    {
        $auteur->load('livres');

        return view('auteurs.show', [
            'auteur' => $auteur,
        ]);
    }

    public function edit(Auteur $auteur)
    {
        return view('auteurs.edit', [
            'auteur' => $auteur,
        ]);
    }

    public function update(Request $request, Auteur $auteur)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
        ]);

        $auteur->update($validated);

        return redirect()
            ->route('auteurs.index')
            ->with('success', 'Auteur modifié avec succès.');
    }

    public function destroy(Auteur $auteur)
    {
        if ($auteur->livres()->exists()) {
            return redirect()
                ->route('auteurs.index')
                ->withErrors([
                    'nom' => 'Impossible de supprimer cet auteur car il possède des livres.',
                ]);
        }

        $auteur->delete();

        return redirect()
            ->route('auteurs.index')
            ->with('success', 'Auteur supprimé avec succès.');
    }
}
