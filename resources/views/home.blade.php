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
                @auth
                    <a href="{{ route('livres.index') }}" class="btn btn-primary">Voir les livres</a>
                    <a href="{{ route('emprunts.create') }}" class="btn btn-secondary">Créer un emprunt</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Se connecter</a>
                @endauth
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
            <h3>Catalogue des livres</h3>
            <p>
                Parcours les ouvrages, filtre les titres et consulte les détails de chaque livre.
            </p>
            <a href="{{ route('livres.index') }}" class="btn btn-primary">Voir les livres</a>
        </div>

        <div class="card">
            <h3>Gestion des auteurs</h3>
            <p>
                Ajoute de nouveaux auteurs et complète la base de données de la bibliothèque.
            </p>
            <a href="{{ route('auteurs.index') }}" class="btn btn-secondary">Voir les auteurs</a>
        </div>

        <div class="card">
            <h3>Gestion des usagers</h3>
            <p>
                Consulte les usagers, leur historique d’emprunts et ajoute de nouveaux profils.
            </p>
            <a href="{{ route('usagers.index') }}" class="btn btn-warning">Voir les usagers</a>
        </div>
    </section>
@endsection
