@extends('layouts.app')

@section('title', 'Auteurs')

@section('content')
    <div class="panel">
        <div class="top-bar">
            <div>
                <h1>Liste des auteurs</h1>
                <p>Recherche, ajout, modification et suppression</p>
            </div>

            <a href="{{ route('auteurs.create') }}" class="btn btn-primary">+ Nouvel auteur</a>
        </div>

        <form method="GET" action="{{ route('auteurs.index') }}">
            <label for="q">Rechercher un auteur</label>
            <input type="text" name="q" id="q" value="{{ $q }}" placeholder="Nom de l'auteur">
            <button type="submit" class="btn btn-primary">Rechercher</button>
            <a href="{{ route('auteurs.index') }}" class="btn btn-secondary">Réinitialiser</a>
        </form>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Nb livres</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($auteurs as $auteur)
                <tr>
                    <td>{{ $auteur->id }}</td>
                    <td>{{ $auteur->nom }}</td>
                    <td>{{ $auteur->livres()->count() }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('auteurs.show', $auteur) }}" class="btn btn-secondary">Voir</a>
                            <a href="{{ route('auteurs.edit', $auteur) }}" class="btn btn-warning">Modifier</a>

                            <form action="{{ route('auteurs.destroy', $auteur) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet auteur ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun auteur trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $auteurs->links() }}
        </div>
    </div>
@endsection
