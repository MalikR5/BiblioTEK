@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
    <div class="panel" style="max-width: 520px; margin: 40px auto;">
        <div class="page-header">
            <h1>Connexion bibliothécaire</h1>
            <p>Accède au back-office BiblioTEK.</p>
        </div>

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <label for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                required
            >

            <label for="password">Mot de passe</label>
            <input
                type="password"
                name="password"
                id="password"
                required
            >

            <div class="actions">
                <button type="submit" class="btn btn-primary">Se connecter</button>
                <a href="{{ route('home') }}" class="btn btn-secondary">Retour accueil</a>
            </div>
        </form>
    </div>
@endsection
