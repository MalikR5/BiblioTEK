<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Livre;
use App\Models\Usager;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmpruntController extends Controller
{
    public function index(): View
    {
        $emprunts = Emprunt::with('usager', 'exemplaire.livre')
            ->whereNull('date_retour')
            ->orderBy('date_emprunt', 'desc')
            ->paginate(15);

        return view('retours.index', [
            'emprunts' => $emprunts,
        ]);
    }

    public function create(): View
    {
        $usagers = Usager::orderBy('email')->get();

        $livres = Livre::with('auteur')
            ->whereHas('exemplaires', function ($query) {
                $query->where('statut_id', 1);
            })
            ->orderBy('titre')
            ->get();

        return view('emprunts.create', [
            'usagers' => $usagers,
            'livres' => $livres,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'usager_id' => ['required', 'exists:usagers,id'],
            'livre_id' => ['required', 'exists:livres,id'],
        ]);

        $usagerADejaUnEmpruntEnCours = Emprunt::where('usager_id', $validated['usager_id'])
            ->whereNull('date_retour')
            ->exists();

        if ($usagerADejaUnEmpruntEnCours) {
            return back()
                ->withInput()
                ->withErrors([
                    'usager_id' => 'Cet usager a déjà un emprunt en cours.',
                ]);
        }

        $livre = Livre::findOrFail($validated['livre_id']);

        $exemplaireDisponible = $livre->exemplaires()
            ->where('statut_id', 1)
            ->first();

        if (!$exemplaireDisponible) {
            return back()
                ->withInput()
                ->withErrors([
                    'livre_id' => 'Aucun exemplaire disponible pour ce livre.',
                ]);
        }

        $date = Carbon::now();

        Emprunt::create([
            'date_emprunt' => $date,
            'date_retour_prevue' => $date->copy()->addDays(30),
            'date_retour' => null,
            'usager_id' => $validated['usager_id'],
            'exemplaire_id' => $exemplaireDisponible->id,
        ]);

        $exemplaireDisponible->update([
            'statut_id' => 2,
        ]);

        return redirect()
            ->route('livres.index')
            ->with('success', 'Emprunt enregistré avec succès.');
    }

    public function retour(Emprunt $emprunt): RedirectResponse
    {
        if ($emprunt->date_retour) {
            return redirect()
                ->route('retours.index')
                ->withErrors([
                    'retour' => 'Cet emprunt a déjà été retourné.',
                ]);
        }

        $emprunt->update([
            'date_retour' => Carbon::now(),
        ]);

        $emprunt->exemplaire->update([
            'statut_id' => 1,
        ]);

        return redirect()
            ->route('retours.index')
            ->with('success', 'Retour enregistré avec succès.');
    }
}
