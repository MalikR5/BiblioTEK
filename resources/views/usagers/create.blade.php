@extends('layouts.app')

@section('title', 'Ajouter un usager')

@section('content')
    <div class="panel">
        <h1>Ajouter un usager</h1>

        <form action="{{ route('usagers.store') }}" method="POST">
            @csrf

            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}" required>

            <label for="mdp">Mot de passe</label>
            <input type="text" name="mdp" id="mdp" required>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('usagers.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
