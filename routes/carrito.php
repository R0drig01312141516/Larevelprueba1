<?php

use App\Http\Controllers\CarritoController;

Route::middleware('sync.cart')
    ->controller(CarritoController::class)
    ->prefix('carrito')
    ->name('carrito.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/agregar', 'addToCart')->name('agregar');
        Route::delete('/eliminar/{rowId}', 'removeFromCart')->name('eliminar');
        Route::post('/actualizar/{rowId}', 'updateCart')->name('actualizar');
        Route::delete('/vaciar', 'emptyCart')->name('vaciar');
    });
