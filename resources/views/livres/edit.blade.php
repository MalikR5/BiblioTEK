@extends('layouts.app')

@section('title', 'Modifier un livre')

@section('content')
    <div class="panel">
        <div class="page-header">
            <h1>Modifier un livre</h1>
            <p>Mets à jour les informations de l’ouvrage sélectionné.</p>
        </div>

        <form action="{{ route('livres.update', $livre) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre', $livre->titre) }}" required>

            <label for="auteur_id">Auteur</label>
            <select name="auteur_id" id="auteur_id" required>
                <option value="">-- Choisir un auteur --</option>
                @foreach($auteurs as $auteur)
                    <option value="{{ $auteur->id }}" @selected(old('auteur_id', $livre->auteur_id) == $auteur->id)>
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
                            @checked(
                                in_array(
                                    $categorie->id,
                                    old('categories', $livre->categories->pluck('id')->toArray())
                                )
                            )
                        >
                        {{ $categorie->categorie }}
                    </label>
                @endforeach

                    <label for="nb_exemplaires">Nombre d'exemplaires</label>

                    <input
                        type="number"
                        name="nb_exemplaires"
                        id="nb_exemplaires"
                        value="{{ old('nb_exemplaires', $livre->exemplaires->count()) }}"
                        min="1"
                        max="100"
                        required
                    >
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                <a href="{{ route('livres.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
@endsection
