@extends('layouts.app')

@section('title', 'Liste des livres')

@section('content')
    <div class="top-bar">
        <div>
            <h1>Liste des livres</h1>
            <p>CRUD Laravel + recherche par titre</p>
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
            placeholder="Exemple : Harry Potter"
        >
        <button type="submit" class="btn btn-primary">Rechercher</button>
        <a href="{{ route('livres.index') }}" class="btn btn-secondary">Réinitialiser</a>
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
                <td>{{ $livre->titre }}</td>
                <td>{{ $livre->auteur?->nom }}</td>
                <td>
                    @forelse($livre->categories as $categorie)
                        <span>{{ $categorie->categorie }}</span><br>
                    @empty
                        <em>Aucune</em>
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

    <div class="pagination">
        {{ $livres->links() }}
    </div>
@endsection
