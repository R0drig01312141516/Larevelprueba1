<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoriaController extends Controller
{
    public function show(Categoria $categoria)
    {
        // Obtener todos los productos de la categoría, disponibles, y cargar la relación 'marca'
        $productos = Producto::with('marca')
            ->where('disponible', true)
            ->where('categoria_id', $categoria->id)
            ->get();
    
        // Agrupar los productos por marca
        $productosPorMarca = $productos->groupBy(function ($producto) {
            return $producto->marca ? $producto->marca->marca : 'Sin Marca';
        });
    
        // Preparar una colección paginada para cada marca
        $productosPorMarcaPaginados = $productosPorMarca->map(function ($productos, $marca) {
            $perPage = 8;
            $currentPage = request()->query("page_{$marca}", 1);
            $paginatedItems = $productos->slice(($currentPage - 1) * $perPage, $perPage)->values();
    
            return new \Illuminate\Pagination\LengthAwarePaginator(
                $paginatedItems,
                $productos->count(),
                $perPage,
                $currentPage,
                [
                    'path' => request()->url(),
                    'pageName' => "page_{$marca}",
                ]
            );
        });
    
        return view('productos.categoria', compact('categoria', 'productosPorMarcaPaginados'));
    }
    // public function show(Categoria $categoria)
    // {
    //     $productos = Producto::where('disponible', true)
    //         ->where('categoria_id', $categoria->id)
    //         ->paginate(8);

    //     return view('productos.categoria', compact('categoria', 'productos'));
    // }
}
