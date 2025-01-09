<?php

namespace App\Providers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (Schema::hasTable('categorias')) {
                $categorias = Categoria::all();
                $productos = Producto::where('disponible', true)->get();
                View::composer(['partials.header', 'partials.sidebar'], function ($view) use ($categorias, $productos) {
                    $view->with('categorias', $categorias);
                    $view->with('productos', $productos);
                });
            }
        } catch (\Exception $e) {
            Log::error('Error al cargar las categorías: ' . $e->getMessage());
        }
    }
}
