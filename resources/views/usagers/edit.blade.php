@extends('layouts.app')

@section('title', 'Modifier un usager')

@section('content')
    <div class="panel">
        <h1>Modifier un usager</h1>

        <form action="{{ route('usagers.update', $usager) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ old('email', $usager->email) }}" required>

            <label for="mdp">Nouveau mot de passe (optionnel)</label>
            <input type="text" name="mdp" id="mdp">

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('usagers.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
