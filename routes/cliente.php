<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Auth\ClienteAuthController;
use App\Http\Controllers\Auth\ClientePasswordController;

Route::middleware('cliente.guest')
    ->name('cliente.')
    ->group(function () {
        Route::controller(ClienteAuthController::class)
            ->group(function () {
                Route::get('/iniciar-sesion', 'showLoginForm')->name('login');
                Route::post('/iniciar-sesion', 'login')->name('login.submit');
                Route::get('/registrarse', 'showRegisterForm')->name('register');
                Route::post('/registrarse', 'register')->name('register.submit');
            });

        Route::controller(ClientePasswordController::class)
            ->group(function () {
                Route::get('/solicitar-contraseña', 'showForgotPasswordForm')->name('password.request');
                Route::post('/enviar-contraseña', 'sendResetLinkEmail')->name('password.email');
                Route::get('/restablecer-contraseña/{token}', 'showResetPasswordForm')->name('password.reset');
                Route::post('/restablecer-contraseña', 'resetPassword')->name('password.update');
            });
    });

Route::middleware('cliente.auth')
    ->name('cliente.')
    ->group(function () {
        Route::get('/pedidos', [ClienteController::class, 'pedidos'])->name('pedidos');
        Route::get('/pedidos/{venta}', [ClienteController::class, 'show'])->name('pedidos.show');
        Route::post('/cerrar-sesion', [ClienteAuthController::class, 'logout'])->name('logout');
    });
