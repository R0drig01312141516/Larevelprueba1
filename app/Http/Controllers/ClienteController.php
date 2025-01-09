<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function pedidos()
    {
        $ventas = auth()->guard('cliente')
            ->user()?->ventas()
            ->orderBy('fecha', 'desc')
            ->get() ?? [];
        return view('cliente.pedidos', compact('ventas'));
    }

    public function show(Venta $venta)
    {
        // Verificar que el pedido pertenece al usuario autenticado
        if ($venta->user_id !== auth()->id()) {
            abort(403);
        }

        return view('cliente.pedido-detalle', compact('venta'));
    }
}
