@extends('layouts.app')

@section('title', 'Nouvel emprunt')

@section('content')
    <div class="panel">
        <div class="page-header">
            <h1>Créer un emprunt</h1>
            <p>Sélectionne un usager puis un livre disponible.</p>
        </div>

        <form method="POST" action="{{ route('emprunts.store') }}">
            @csrf

            <label for="usager_id">Usager</label>
            <select name="usager_id" id="usager_id" required>
                <option value="">Choisir un usager</option>
                @foreach($usagers as $usager)
                    <option value="{{ $usager->id }}" @selected(old('usager_id') == $usager->id)>
                        {{ $usager->email }}
                    </option>
                @endforeach
            </select>

            <label for="livre_id">Livre disponible</label>
            <select name="livre_id" id="livre_id" required>
                <option value="">Choisir un livre</option>
                @foreach($livres as $livre)
                    <option value="{{ $livre->id }}" @selected(old('livre_id') == $livre->id)>
                        {{ $livre->titre }} @if($livre->auteur) — {{ $livre->auteur->nom }} @endif
                    </option>
                @endforeach
            </select>

            <div class="actions">
                <button class="btn btn-primary" type="submit">Valider l'emprunt</button>
                <a href="{{ route('home') }}" class="btn btn-secondary">Retour accueil</a>
            </div>
        </form>
    </div>
@endsection
