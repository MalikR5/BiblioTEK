@extends('layouts.app')

@section('title', 'Liste des livres')

@section('content')
    <div class="panel">
        <div class="top-bar">
            <div>
                <h1>Liste des livres</h1>
                <p>Consulte, recherche et gère les ouvrages de la bibliothèque.</p>
            </div>

            <a href="{{ route('livres.create') }}" class="btn btn-primary">+ Nouveau livre</a>
        </div>

        <form method="GET" action="{{ route('livres.index') }}">
            <label for="q">Rechercher un livre par son titre</label>
            <input
                type="text"
                name="q"
                id="q"
                value="{{ $q }}"
                placeholder="Exemple : Le Petit Prince"
            >
            <div class="actions">
                <button type="submit" class="btn btn-primary">Rechercher</button>
                <a href="{{ route('livres.index') }}" class="btn btn-secondary">Réinitialiser</a>
            </div>
        </form>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Catégories</th>
                <th>Nb exemplaires</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($livres as $livre)
                <tr>
                    <td>{{ $livre->id }}</td>
                    <td><strong>{{ $livre->titre }}</strong></td>
                    <td>{{ $livre->auteur?->nom }}</td>
                    <td>
                        @forelse($livre->categories as $categorie)
                            <span class="badge">{{ $categorie->categorie }}</span>
                        @empty
                            <span class="muted">Aucune</span>
                        @endforelse
                    </td>
                    <td>{{ $livre->exemplaires()->count() }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('livres.show', $livre) }}" class="btn btn-secondary">Voir</a>
                            <a href="{{ route('livres.edit', $livre) }}" class="btn btn-warning">Modifier</a>

                            <form action="{{ route('livres.destroy', $livre) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce livre ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucun livre trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="custom-pagination">
            @if ($livres->onFirstPage())
                <span class="disabled">← Précédent</span>
            @else
                <a href="{{ $livres->previousPageUrl() }}">← Précédent</a>
            @endif

            <span class="active-page">
        Page {{ $livres->currentPage() }} / {{ $livres->lastPage() }}
    </span>

            @if ($livres->hasMorePages())
                <a href="{{ $livres->nextPageUrl() }}">Suivant →</a>
            @else
                <span class="disabled">Suivant →</span>
            @endif
        </div>

@endsection
