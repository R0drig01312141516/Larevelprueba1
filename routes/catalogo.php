<?php

use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;


Route::prefix('catalogo')->group(function () {
    Route::get('/', [ProductoController::class, 'index'])->name('productos');
    Route::get('/{categoria:slug}', [CategoriaController::class, 'show'])->name('categoria.show');
    Route::get('/{categoria:slug}/{producto:slug}', [ProductoController::class, 'show'])->name('producto.show');
});

Route::get('/productos/buscar', [BusquedaController::class, 'buscar'])->name('productos.buscar');
