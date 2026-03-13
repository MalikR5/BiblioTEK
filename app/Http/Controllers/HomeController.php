<?php

namespace App\Http\Controllers;

use App\Models\Auteur;
use App\Models\Emprunt;
use App\Models\Exemplaire;
use App\Models\Livre;
use App\Models\Usager;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'nbLivres' => Livre::count(),
            'nbAuteurs' => Auteur::count(),
            'nbUsagers' => Usager::count(),
            'nbExemplaires' => Exemplaire::count(),
            'nbEmpruntsEnCours' => Emprunt::whereNull('date_retour')->count(),
        ]);
    }
}
