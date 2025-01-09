<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Http\Requests\CartRequest;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CarritoController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $this->cartService->sincronizar();
        $items = $this->cartService->obtenerContenido();
        $resumen = $this->cartService->obtenerResumen();

        return view('cart.index', compact('items', 'resumen'));
    }

    public function addToCart(CartRequest $request)
    {
        try {
            $datos = $request->validated();

            if ($this->cartService->agregarProducto($datos)) {
                return redirect()->back()->with('success', $datos['modelo'] . ' añadido al carrito.');
            }

            return redirect()->back()->with('error', 'No se puede agregar más productos de esta talla.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al añadir el producto al carrito.');
        }
    }

    public function removeFromCart($rowId)
    {
        try {
            Cart::remove($rowId);

            return redirect()->back()->with('success', 'Producto eliminado del carrito.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el producto del carrito.');
        }
    }

    public function updateCart(Request $request, $rowId)
    {
        try {
            $cantidad = $request->cantidad;

            if ($this->cartService->actualizarCantidad($rowId, $cantidad)) {
                return redirect()->back()->with('success', 'Cantidad actualizada correctamente');
            }

            return redirect()->back()->with('error', 'La cantidad solicitada supera el stock disponible.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la cantidad del producto.');
        }
    }

    public function emptyCart()
    {
        Cart::destroy();
        return redirect()->back()->with('success', 'Carrito vaciado correctamente');
    }
}
