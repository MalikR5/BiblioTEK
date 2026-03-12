<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Exemplaire;
use App\Models\Usager;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmpruntController extends Controller
{

    public function create()
    {
        $usagers = Usager::all();

        $exemplaires = Exemplaire::where('statut_id', 1)->get();

        return view('emprunts.create', [
            'usagers' => $usagers,
            'exemplaires' => $exemplaires
        ]);
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'usager_id' => ['required', 'exists:usagers,id'],
            'exemplaire_id' => ['required', 'exists:exemplaires,id'],
        ]);

        $exemplaire = Exemplaire::find($validated['exemplaire_id']);

        if ($exemplaire->statut_id != 1) {
            return back()->withErrors([
                'exemplaire_id' => 'Cet exemplaire n\'est pas disponible.'
            ]);
        }

        $date = Carbon::now();

        Emprunt::create([
            'date_emprunt' => $date,
            'date_retour_prevue' => $date->copy()->addDays(30),
            'date_retour' => null,
            'usager_id' => $validated['usager_id'],
            'exemplaire_id' => $validated['exemplaire_id'],
        ]);

        $exemplaire->update([
            'statut_id' => 2
        ]);

        return redirect()->route('livres.index')
            ->with('success', 'Emprunt enregistré.');
    }
}
