<?php

namespace App\Services;

use Exception;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartService
{
    public function sincronizar()
    {
        if (Auth::guard('cliente')->check()) {
            Cart::destroy();
            Cart::restore(Auth::guard('cliente')->id());
        }
    }

    public function obtenerContenido()
    {
        return Cart::content();
    }

    public function obtenerResumen()
    {
        $igv = floatval(Cart::tax());
        $total = floatval(Cart::subtotal());
        $subtotal = $total - $igv;

        return compact( 'igv', 'subtotal', 'total');
    }

    public function obtenerProducto($productoId)
    {
        return Producto::findOrFail($productoId);
    }

    public function agregarProducto(array $datos) : bool
    {
        $productoId = $datos['producto_id'];
        $producto = $this->obtenerProducto($productoId);
        $talla = $datos['talla'];

        $stockDisponible = $this->obtenerStockDisponible($producto, $talla);
        $cantidadTotal = $this->calcularCantidadTotal($productoId, $talla, $datos['qty']);

        if ($cantidadTotal > $stockDisponible) {
            return false;
        }

        Cart::add([
            'id' => $productoId,
            'name' => $producto->modelo,
            'qty' => $datos['qty'],
            'price' => $producto->precio,
            'options' => [
                'talla' => $talla,
                'url_imagen' => $producto->imagen_principal,
            ],
        ])->associate('Producto');

        return true;
    }

    public function actualizarCantidad($rowId, $cantidad)
    {
        $item = Cart::get($rowId);
        $producto = $this->obtenerProducto($item->id);

        $stockDisponible = $this->obtenerStockDisponible($producto, $item->options->talla);

        if ($cantidad > $stockDisponible) {
            return false;
        }

        return Cart::update($rowId, $cantidad);
    }

    private function obtenerStockDisponible($producto, $talla)
    {
        return $producto->tallas()
            ->where('tallas.talla', $talla)
            ->first()->pivot->cantidad;

           }

    private function calcularCantidadTotal($productoId, $talla, $cantidadNueva)
    {
        $cartItem = $this->obtenerContenido()->first(function ($item) use ($productoId, $talla) {
            return $item->id == $productoId && $item->options->talla == $talla;
        });

        return $cantidadNueva + ($cartItem ? $cartItem->qty : 0);
    }
}
