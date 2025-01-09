<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function buscar(Request $request)
    {
        $request->validate([
            'buscar' => 'required|string|max:50',
        ]);

        $busqueda = trim($request->buscar);

        $productos = Producto::query()
            ->where('disponible', true)
            ->where(function ($query) use ($busqueda) {
                $query->where('modelo', 'like', "%{$busqueda}%")
                    ->orWhere('codigo', 'like', "%{$busqueda}%")
                    ->orWhereHas('categoria', function ($query) use ($busqueda) {
                        $query->where('categoria', 'like', "%{$busqueda}%");
                    })
                    ->orWhereHas('marca', function ($query) use ($busqueda) {
                        $query->where('marca', 'like', "%{$busqueda}%");
                    });
            })
            ->paginate(8);

        return view('productos.busqueda', compact('productos', 'busqueda'));
    }
}
