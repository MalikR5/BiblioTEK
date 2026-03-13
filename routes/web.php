<?php

use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LivreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('livres', LivreController::class);

Route::get('/emprunts/create', [EmpruntController::class, 'create'])
    ->name('emprunts.create');

Route::post('/emprunts', [EmpruntController::class, 'store'])
    ->name('emprunts.store');
