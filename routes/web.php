<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ContactoController;

Route::controller(InicioController::class)
    ->group(function () {
        Route::get('/', 'index')->name('inicio');
        Route::get('/nosotros', 'about')->name('nosotros');
        Route::get('/envios', 'envios')->name('envios');
});

Route::post('/nosotros/contacto', [ContactoController::class, 'store'])
    ->name('contacto')
    ->middleware('throttle:2,1');

