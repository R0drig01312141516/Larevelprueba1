<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(): View
    {
        $productoReciente = $this->getProductoReciente();
        $categorias = $this->getCategoriasConProductosDisponibles();

        return view('productos.index', compact(
            'productoReciente',
            'categorias'
        ));
    }

    public function show(Categoria $categoria, Producto $producto): View
    {
        $recomendaciones = $this->getProductosRecomendados($categoria, $producto);

        return view('productos.mostrar', compact('producto', 'recomendaciones'));
    }

    private function getProductoReciente(): ?Producto
    {
        return Producto::with(['marca', 'categoria'])
            ->where('disponible', true)
            ->orderBy('registrado_en', 'desc')
            ->first();
    }

    private function getCategoriasConProductosDisponibles()
    {
        return Categoria::whereHas('productos', function ($query) {
            $query->where('disponible', true);
        })->get();
    }

    private function getProductosRecomendados(Categoria $categoria, Producto $producto)
    {
        return Producto::where('disponible', true)
            ->where('categoria_id', $categoria->id)
            ->where('id', '!=', $producto->id)
            ->take(4)
            ->get();
    }
}
