@extends('layouts.app')

@section('title','Nouvel emprunt')

@section('content')

    <h1>Créer un emprunt</h1>

    <form method="POST" action="{{ route('emprunts.store') }}">
        @csrf

        <label>Usager</label>

        <select name="usager_id" required>

            <option value="">Choisir un usager</option>

            @foreach($usagers as $usager)

                <option value="{{ $usager->id }}">
                    {{ $usager->email }}
                </option>

            @endforeach

        </select>


        <label>Exemplaire disponible</label>

        <select name="exemplaire_id" required>

            <option value="">Choisir un exemplaire</option>

            @foreach($exemplaires as $exemplaire)

                <option value="{{ $exemplaire->id }}">
                    Livre #{{ $exemplaire->livre_id }} | exemplaire {{ $exemplaire->id }}
                </option>

            @endforeach

        </select>

        <br><br>

        <button class="btn btn-primary">
            Valider l'emprunt
        </button>

    </form>

@endsection
