<?php

use App\Http\Controllers\LivreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpruntController;

Route::get('/emprunts/create', [EmpruntController::class, 'create'])
    ->name('emprunts.create');

Route::post('/emprunts', [EmpruntController::class, 'store'])
    ->name('emprunts.store');

Route::get('/', function () {
    return redirect()->route('livres.index');
});

Route::resource('livres', LivreController::class);
