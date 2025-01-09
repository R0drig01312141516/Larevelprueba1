<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PagoController;

Route::controller(InicioController::class)->group(function () {
    Route::get('/', 'index')->name('inicio');
    Route::get('/nosotros', 'about')->name('nosotros');
    Route::get('/envios', 'envios')->name('envios');
});

Route::post('/nosotros/contacto', [ContactoController::class, 'store'])
    ->name('contacto')
    ->middleware('throttle:2,1');
    
Route::post('/mercadopago/create-preference', [PagoController::class, 'mercadoPago'])->name('mercadopago.createPreference');
Route::get('/mercadopago/success', [PagoController::class, 'mercadoPagoSuccess'])->name('mercadopago.success');
Route::get('/mercadopago/cancel', [PagoController::class, 'mercadoPagoCancel'])->name('mercadopago.cancel');
Route::get('/mercadopago/pending', [PagoController::class, 'pending'])->name('mercadopago.pending');