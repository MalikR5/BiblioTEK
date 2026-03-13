@extends('layouts.app')

@section('title', 'Ajouter un livre')

@section('content')
    <div class="panel">
        <div class="page-header">
            <h1>Ajouter un livre</h1>
            <p>Crée un nouvel ouvrage dans la bibliothèque.</p>
        </div>

        <form action="{{ route('livres.store') }}" method="POST">
            @csrf

            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required>

            <label for="auteur_id">Auteur</label>
            <select name="auteur_id" id="auteur_id" required>
                <option value="">-- Choisir un auteur --</option>
                @foreach($auteurs as $auteur)
                    <option value="{{ $auteur->id }}" @selected(old('auteur_id') == $auteur->id)>
                        {{ $auteur->nom }}
                    </option>
                @endforeach
            </select>

            <label>Catégories</label>
            <div class="checkbox-list">
                @foreach($categories as $categorie)
                    <label>
                        <input
                            type="checkbox"
                            name="categories[]"
                            value="{{ $categorie->id }}"
                            @checked(is_array(old('categories')) && in_array($categorie->id, old('categories')))
                        >
                        {{ $categorie->categorie }}
                    </label>
                @endforeach
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('livres.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
@endsection
