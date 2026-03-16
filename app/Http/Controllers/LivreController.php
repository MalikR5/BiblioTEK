<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use App\Models\Categorie;
use App\Models\Livre;
use Illuminate\Http\Request;

class LivreController extends Controller
{
    public function index(Request $request)
    {
        $query = Livre::with('auteur', 'categories');

        if ($request->filled('q')) {
            $query->where('titre', 'like', '%' . $request->q . '%');
        }

        $livres = $query->latest()->paginate(15)->withQueryString();

        return view('livres.index', [
            'livres' => $livres,
            'q' => $request->q,
        ]);
    }

    public function create()
    {
        return view('livres.create', [
            'auteurs' => Auteur::orderBy('nom')->get(),
            'categories' => Categorie::orderBy('categorie')->get(),
        ]);
    }

        public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required','string','max:255'],
            'auteur_id' => ['required','exists:auteurs,id'],
            'categories' => ['nullable','array'],
            'categories.*' => ['exists:categories,id'],
            'nb_exemplaires' => ['required','integer','min:1','max:100'],
        ]);

        $livre = Livre::create([
            'titre' => $validated['titre'],
            'auteur_id' => $validated['auteur_id'],
        ]);

        $livre->categories()->sync($validated['categories'] ?? []);

        // création des exemplaires
        for ($i = 0; $i < $validated['nb_exemplaires']; $i++) {

            $livre->exemplaires()->create([
                'mise_en_service' => now()->toDateString(),
                'statut_id' => 1
            ]);

        }

        return redirect()
            ->route('livres.index')
            ->with('success','Livre créé avec succès');
    }

    public function show(Livre $livre)
    {
        $livre->load('auteur', 'categories', 'exemplaires');

        return view('livres.show', [
            'livre' => $livre,
        ]);
    }

    public function edit(Livre $livre)
    {
        $livre->load('categories');

        return view('livres.edit', [
            'livre' => $livre,
            'auteurs' => Auteur::orderBy('nom')->get(),
            'categories' => Categorie::orderBy('categorie')->get(),
        ]);
    }

    public function update(Request $request, Livre $livre)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'auteur_id' => ['required', 'exists:auteurs,id'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
            'nb_exemplaires' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $livre->update([
            'titre' => $validated['titre'],
            'auteur_id' => $validated['auteur_id'],
        ]);

        $livre->categories()->sync($validated['categories'] ?? []);

        $nbActuel = $livre->exemplaires()->count();
        $nbVoulu = $validated['nb_exemplaires'];

        if ($nbVoulu > $nbActuel) {
            $aAjouter = $nbVoulu - $nbActuel;

            for ($i = 0; $i < $aAjouter; $i++) {
                $livre->exemplaires()->create([
                    'mise_en_service' => now()->toDateString(),
                    'statut_id' => 1,
                ]);
            }
        }

        if ($nbVoulu < $nbActuel) {
            $aSupprimer = $nbActuel - $nbVoulu;

            $exemplairesDisponibles = $livre->exemplaires()
                ->where('statut_id', 1)
                ->take($aSupprimer)
                ->get();

            foreach ($exemplairesDisponibles as $exemplaire) {
                $exemplaire->delete();
            }
        }

        return redirect()
            ->route('livres.index')
            ->with('success', 'Livre modifié avec succès.');
    }

    public function destroy(Livre $livre)
    {
        $livre->delete();

        return redirect()
            ->route('livres.index')
            ->with('success', 'Livre supprimé avec succès.');
    }
}
