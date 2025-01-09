<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Symfony\Component\HttpFoundation\Response;

class SyncCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cliente = Auth::guard('cliente')->user();
        
        if ($cliente) {
            Cart::restore($cliente->id);
        }

        $response = $next($request);

        if ($cliente) {
            Cart::store($cliente->id);
        }

        return $response;
    }
}
