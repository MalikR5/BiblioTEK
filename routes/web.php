<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-db', function () {
    return [
        'connection' => config('database.default'),
        'host' => config('database.connections.mysql.host'),
        'port' => config('database.connections.mysql.port'),
        'database' => config('database.connections.mysql.database'),
    ];
});

