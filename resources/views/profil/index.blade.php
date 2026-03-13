@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
    <div class="panel">
        <div class="page-header">
            <h1>Mon profil</h1>
            <p>Informations du compte connecté.</p>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <strong>ID</strong>
                {{ $user->id }}
            </div>

            <div class="info-box">
                <strong>Nom</strong>
                {{ $user->name }}
            </div>

            <div class="info-box">
                <strong>Email</strong>
                {{ $user->email }}
            </div>
        </div>
    </div>
@endsection
