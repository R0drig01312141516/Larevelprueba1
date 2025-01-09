<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Producto;
use Illuminate\View\View;

class InicioController extends Controller
{
    public function index(): View
    {
        $ofertas = $this->getOfertasDisponibles();
        $nuevosProductos = $this->getNuevosProductos();
       

        return view('home.index', compact(
            'ofertas',
            'nuevosProductos'
        ));
    }

    public function about(): View
    {
        return view('pages.nosotros');
    }

    public function envios(): View
    {
        return view('pages.envios');
    }

    private function getOfertasDisponibles()
    {
        return Oferta::with('producto')
            ->whereHas('producto', function ($query) {
                $query->where('disponible', true);
            })
            ->get();
    }

    private function getNuevosProductos()
    {
        return Producto::with(['marca', 'oferta'])
            ->where('disponible', true)
            ->orderBy('registrado_en', 'desc')
            ->take(6)
            ->get();
    }

    

}
