@extends('layouts.app')

@section('title', 'Usagers')

@section('content')
    <div class="panel">
        <div class="top-bar">
            <div>
                <h1>Liste des usagers</h1>
                <p>Recherche, ajout, modification et suppression</p>
            </div>

            <a href="{{ route('usagers.create') }}" class="btn btn-primary">+ Nouvel usager</a>
        </div>

        <form method="GET" action="{{ route('usagers.index') }}">
            <label for="q">Rechercher un usager</label>
            <input type="text" name="q" id="q" value="{{ $q }}" placeholder="Adresse email">
            <button type="submit" class="btn btn-primary">Rechercher</button>
            <a href="{{ route('usagers.index') }}" class="btn btn-secondary">Réinitialiser</a>
        </form>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Nb emprunts</th>
                <th>Emprunt en cours</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($usagers as $usager)
                <tr>
                    <td>{{ $usager->id }}</td>
                    <td>{{ $usager->email }}</td>
                    <td>{{ $usager->emprunts()->count() }}</td>
                    <td>{{ $usager->emprunts()->whereNull('date_retour')->exists() ? 'Oui' : 'Non' }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('usagers.show', $usager) }}" class="btn btn-secondary">Voir</a>
                            <a href="{{ route('usagers.edit', $usager) }}" class="btn btn-warning">Modifier</a>

                            <form action="{{ route('usagers.destroy', $usager) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet usager ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucun usager trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $usagers->links() }}
        </div>
    </div>
@endsection
