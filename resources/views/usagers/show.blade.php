@extends('layouts.app')

@section('title', 'Détail usager')

@section('content')
    <div class="panel">
        <h1>Détail de l'usager</h1>

        <p><strong>ID :</strong> {{ $usager->id }}</p>
        <p><strong>Email :</strong> {{ $usager->email }}</p>
        <p><strong>Nombre d'emprunts :</strong> {{ $usager->emprunts->count() }}</p>

        <h3>Historique des emprunts</h3>
        <table>
            <thead>
            <tr>
                <th>ID emprunt</th>
                <th>Livre</th>
                <th>Date emprunt</th>
                <th>Retour prévu</th>
                <th>Retour effectif</th>
            </tr>
            </thead>
            <tbody>
            @forelse($usager->emprunts as $emprunt)
                <tr>
                    <td>{{ $emprunt->id }}</td>
                    <td>{{ $emprunt->exemplaire?->livre?->titre ?? 'N/A' }}</td>
                    <td>{{ optional($emprunt->date_emprunt)->format('d/m/Y') }}</td>
                    <td>{{ optional($emprunt->date_retour_prevue)->format('d/m/Y') }}</td>
                    <td>{{ $emprunt->date_retour ? $emprunt->date_retour->format('d/m/Y') : 'Non rendu' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucun emprunt trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <a href="{{ route('usagers.edit', $usager) }}" class="btn btn-warning">Modifier</a>
        <a href="{{ route('usagers.index') }}" class="btn btn-secondary">Retour</a>
    </div>
@endsection
