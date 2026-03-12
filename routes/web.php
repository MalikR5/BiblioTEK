<?php

use App\Http\Controllers\LivreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('livres.index');
});

Route::resource('livres', LivreController::class);
