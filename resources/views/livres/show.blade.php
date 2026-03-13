@extends('layouts.app')

@section('title', 'Détail du livre')

@section('content')
    <div class="panel">
        <div class="page-header">
            <h1>{{ $livre->titre }}</h1>
            <p>Fiche détaillée du livre sélectionné.</p>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <strong>ID</strong>
                {{ $livre->id }}
            </div>

            <div class="info-box">
                <strong>Auteur</strong>
                {{ $livre->auteur?->nom ?? 'Non renseigné' }}
            </div>

            <div class="info-box">
                <strong>Catégories</strong>
                @forelse($livre->categories as $categorie)
                    <span class="badge">{{ $categorie->categorie }}</span>
                @empty
                    <span class="muted">Aucune catégorie</span>
                @endforelse
            </div>

            <div class="info-box">
                <strong>Nombre d'exemplaires</strong>
                {{ $livre->exemplaires->count() }}
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('livres.edit', $livre) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('livres.index', $livre) }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
@endsection
