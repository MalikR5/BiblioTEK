@extends('layouts.app')

@section('title', 'Nouvel emprunt')

@section('content')
    <h1>Créer un emprunt</h1>

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

        <br><br>

        <button type="submit" class="btn btn-primary">Valider l'emprunt</button>
        <a href="{{ route('livres.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
