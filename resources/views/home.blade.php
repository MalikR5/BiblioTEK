@extends('layouts.app')

@section('title', 'Accueil - BiblioTEK')

@section('content')
    <section class="panel hero">
        <div class="hero-left">
            <div class="badge">Projet Laravel • Bibliothèque</div>
            <h1>Bienvenue sur BiblioTEK</h1>
            <p>
                Une application de gestion de bibliothèque pour administrer les livres,
                les auteurs, les usagers et les emprunts avec une interface claire,
                moderne et agréable à utiliser.
            </p>

            <div class="hero-actions">
                <a href="{{ route('livres.index') }}" class="btn btn-primary">Voir les livres</a>
                <a href="{{ route('emprunts.create') }}" class="btn btn-secondary">Créer un emprunt</a>
            </div>
        </div>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-label">Livres</div>
                <div class="stat-value">{{ $nbLivres }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Auteurs</div>
                <div class="stat-value">{{ $nbAuteurs }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Usagers</div>
                <div class="stat-value">{{ $nbUsagers }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Exemplaires</div>
                <div class="stat-value">{{ $nbExemplaires }}</div>
            </div>

            <div class="stat-card" style="grid-column: 1 / -1;">
                <div class="stat-label">Emprunts en cours</div>
                <div class="stat-value">{{ $nbEmpruntsEnCours }}</div>
            </div>
        </div>
    </section>

    <h2 class="section-title">Accès rapides</h2>

    <section class="cards">
        <div class="card">
            <h3>Gérer les livres</h3>
            <p>
                Consulte la liste, recherche un titre, ajoute un livre ou modifie ses informations.
            </p>
            <a href="{{ route('livres.index') }}" class="btn btn-primary">Accéder</a>
        </div>

        <div class="card">
            <h3>Créer un emprunt</h3>
            <p>
                Associe un usager à un livre disponible et enregistre l’emprunt pour 30 jours.
            </p>
            <a href="{{ route('emprunts.create') }}" class="btn btn-secondary">Emprunter</a>
        </div>

        <div class="card">
            <h3>Projet BTS SIO</h3>
            <p>
                Une base propre en MVC avec base relationnelle, seeders, CRUD et logique métier.
            </p>
            <a href="{{ route('livres.create') }}" class="btn btn-warning">Ajouter un livre</a>
        </div>
    </section>
@endsection
