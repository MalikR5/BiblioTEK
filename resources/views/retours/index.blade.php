@extends('layouts.app')

@section('title', 'Retours')

@section('content')
    <div class="panel">
        <div class="top-bar">
            <div>
                <h1>Retours de livres</h1>
                <p>Liste des emprunts en cours à retourner.</p>
            </div>
        </div>

        <table>
            <thead>
            <tr>
                <th>ID emprunt</th>
                <th>Usager</th>
                <th>Livre</th>
                <th>Exemplaire</th>
                <th>Date emprunt</th>
                <th>Retour prévu</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($emprunts as $emprunt)
                <tr>
                    <td>{{ $emprunt->id }}</td>
                    <td>{{ $emprunt->usager?->email }}</td>
                    <td>{{ $emprunt->exemplaire?->livre?->titre ?? 'N/A' }}</td>
                    <td>#{{ $emprunt->exemplaire_id }}</td>
                    <td>{{ $emprunt->date_emprunt?->format('d/m/Y') }}</td>
                    <td>{{ $emprunt->date_retour_prevue?->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('retours.retour', $emprunt) }}" method="POST" onsubmit="return confirm('Confirmer le retour de ce livre ?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-primary">Retourner</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucun emprunt en cours.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="custom-pagination">
            @if ($emprunts->onFirstPage())
                <span class="disabled">← Précédent</span>
            @else
                <a href="{{ $emprunts->previousPageUrl() }}">← Précédent</a>
            @endif

            <span class="active-page">
                Page {{ $emprunts->currentPage() }} / {{ $emprunts->lastPage() }}
            </span>

            @if ($emprunts->hasMorePages())
                <a href="{{ $emprunts->nextPageUrl() }}">Suivant →</a>
            @else
                <span class="disabled">Suivant →</span>
            @endif
        </div>
    </div>
@endsection
