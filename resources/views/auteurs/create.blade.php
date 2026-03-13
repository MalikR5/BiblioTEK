@extends('layouts.app')

@section('title', 'Ajouter un auteur')

@section('content')
    <div class="panel">
        <h1>Ajouter un auteur</h1>

        <form action="{{ route('auteurs.store') }}" method="POST">
            @csrf

            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('auteurs.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
