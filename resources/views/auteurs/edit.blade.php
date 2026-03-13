@extends('layouts.app')

@section('title', 'Modifier un auteur')

@section('content')
    <div class="panel">
        <h1>Modifier un auteur</h1>

        <form action="{{ route('auteurs.update', $auteur) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $auteur->nom) }}" required>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('auteurs.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
