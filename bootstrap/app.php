<?php

use App\Http\Middleware\SyncCart;
use Illuminate\Foundation\Application;
use App\Http\Middleware\AlreadyAuthenticated;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
            Route::middleware('web')
                ->group(base_path('routes/catalogo.php'));
            Route::middleware('web')
                ->group(base_path('routes/carrito.php'));
            Route::middleware('web')
                ->group(base_path('routes/cliente.php'));
            Route::middleware('web')
                ->group(base_path('routes/pagos.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'cliente.auth' => RedirectIfNotAuthenticated::class,
            'cliente.guest' => AlreadyAuthenticated::class,
            'sync.cart' => SyncCart::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
