<?php

use App\Http\Controllers\PagoController;

Route::middleware('cliente.auth')
    ->controller(PagoController::class)
    ->prefix('comprar')
    ->name('comprar.')
    ->group(function () {
        Route::post('/', 'paypal')->name('paypal');
        Route::get('/exitoso', 'success')->name('success');
        Route::get('/cancelar', 'cancel')->name('cancel');
    });
