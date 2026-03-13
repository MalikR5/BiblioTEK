@extends('layouts.app')

@section('title', 'Détail auteur')

@section('content')
    <div class="panel">
        <h1>Détail de l'auteur</h1>

        <p><strong>ID :</strong> {{ $auteur->id }}</p>
        <p><strong>Nom :</strong> {{ $auteur->nom }}</p>
        <p><strong>Nombre de livres :</strong> {{ $auteur->livres->count() }}</p>

        <h3>Livres liés</h3>
        <ul>
            @forelse($auteur->livres as $livre)
                <li>{{ $livre->titre }}</li>
            @empty
                <li>Aucun livre</li>
            @endforelse
        </ul>

        <a href="{{ route('auteurs.edit', $auteur) }}" class="btn btn-warning">Modifier</a>
        <a href="{{ route('auteurs.index') }}" class="btn btn-secondary">Retour</a>
    </div>
@endsection
