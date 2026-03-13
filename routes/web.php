<?php

use App\Http\Controllers\AuteurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UsagerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/connexion', [AuthController::class, 'create'])->name('login');
Route::post('/connexion', [AuthController::class, 'store'])->name('login.store');
Route::post('/deconnexion', [AuthController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');

    Route::resource('livres', LivreController::class);
    Route::resource('auteurs', AuteurController::class);
    Route::resource('usagers', UsagerController::class);

    Route::get('/emprunts/create', [EmpruntController::class, 'create'])
        ->name('emprunts.create');

    Route::post('/emprunts', [EmpruntController::class, 'store'])
        ->name('emprunts.store');
});
