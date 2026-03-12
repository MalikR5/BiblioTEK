@extends('layouts.app')

@section('title', 'Détail du livre')

@section('content')
    <h1>Détail du livre</h1>

    <p><strong>ID :</strong> {{ $livre->id }}</p>
    <p><strong>Titre :</strong> {{ $livre->titre }}</p>
    <p><strong>Auteur :</strong> {{ $livre->auteur?->nom }}</p>

    <p><strong>Catégories :</strong></p>
    <ul>
        @forelse($livre->categories as $categorie)
            <li>{{ $categorie->categorie }}</li>
        @empty
            <li>Aucune catégorie</li>
        @endforelse
    </ul>

    <p><strong>Nombre d'exemplaires :</strong> {{ $livre->exemplaires->count() }}</p>

    <a href="{{ route('livres.edit', $livre) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('livres.index') }}" class="btn btn-secondary">Retour</a>
@endsection
