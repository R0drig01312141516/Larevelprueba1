<?php

use App\Http\Controllers\Auth\AdminPasswordController;

Route::prefix(config('moonshine.route.prefix', 'admin'))
    ->controller(AdminPasswordController::class)
    ->name('admin.password.')
    ->group(function () {
        Route::get('/solicitar-contraseña', 'showForgotPasswordForm')->name('request');
        Route::post('/enviar-contraseña', 'sendResetLinkEmail')->name('email');
        Route::get('/restablecer-contraseña/{token}', 'showResetPasswordForm')->name('reset');
        Route::post('/restablecer-contraseña', 'resetPassword')->name('update');
    });
