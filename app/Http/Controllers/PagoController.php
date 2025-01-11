<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Talla;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use App\Traits\CurrencyConverter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use MercadoPago\Resources\Preference;
use MercadoPago\Resources\Item;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class PagoController extends Controller
{
    use CurrencyConverter;

    public function getProducto($id)
    {
        return Producto::findOrFail($id);
    }

    public function getCartContent()
    {
        return Cart::content();
    }

    public function paypal(Request $request)
    {
        try {
            $items = $this->getCartContent();

            $disponibilidad = $this->checkAvailability($items);
            if (!$disponibilidad['success']) {
                return redirect()->route('carrito.index')->with('error', $disponibilidad['mensaje']);
            }

            $stock = $this->checkStock($items);
            if (!$stock['success']) {
                return redirect()->route('carrito.index')->with('error', $stock['mensaje']);
            }

            $totalUSD = $this->solesToUSD($request->total);
            $tipoCambio = $this->getTipoCambio();

            session()->put('tipo_cambio', $tipoCambio);
            session()->put('total_soles', $request->total);

            $provider = $this->initializePayPalProvider();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('comprar.success'),
                    "cancel_url" => route('comprar.cancel'),
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $totalUSD
                        ]
                    ]
                ]
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] == 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                throw new Exception('PayPal order creation failed');
            }
        } catch (Exception $e) {
            return redirect()->route('comprar.cancel')->with('error', 'No se pudo iniciar el proceso de pago.');
        }
    }

    public function mercadoPago(Request $request)
    {
        Log::info('Datos recibidos:', $request->all());
    
        try {
            $items = $this->getCartContent();
    
            $disponibilidad = $this->checkAvailability($items);
            if (!$disponibilidad['success']) {
                return response()->json(['error' => $disponibilidad['mensaje']], 400);
            }
    
            $stock = $this->checkStock($items);
            if (!$stock['success']) {
                return response()->json(['error' => $stock['mensaje']], 400);
            }
    
            // Inicializar el SDK de Mercado Pago
            MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
    
            // Crear la lista de productos
            $productItems = [];
            foreach ($items as $item) {
                $productItems[] = [
                    "id" => $item->id,
                    "title" => $item->name,
                    "quantity" => $item->qty,
                    "unit_price" => $this->solesToUSD($item->price),
                    "currency_id" => "PEN" // Cambiar a USD si trabajas con dólares
                ];
            }
    
            // Configurar el payer (opcional, basado en sesión del cliente)
            $payer = [
                "email" => Auth::guard('cliente')->user()->email ?? "default@test.com"
            ];
    
            // Configurar las URLs de retorno
            $backUrls = [
                "success" => route('mercadopago.success'),
                "failure" => route('mercadopago.cancel'),
                "pending" => route('mercadopago.pending'),
            ];
    
            // Crear la preferencia usando PreferenceClient
            $client = new PreferenceClient();
            $preferenceRequest = [
                "items" => $productItems,
                "payer" => $payer,
                "back_urls" => $backUrls,
                "auto_return" => "approved",
                "external_reference" => uniqid(), // Único para rastrear la transacción
            ];
    
            $preference = $client->create($preferenceRequest);
    
            // Retornar la respuesta con el ID y el link para iniciar el pago
            return response()->json([
                'id' => $preference->id,
                'init_point' => $preference->init_point,
            ]);
    
        } catch (MPApiException $e) {
            Log::error('Error de API de Mercado Pago: ' . $e->getMessage());
            return response()->json([
                'error' => 'No se pudo iniciar el proceso de pago.',
                'details' => $e->getApiResponse()->getContent(),
            ], 500);
        } catch (\Exception $e) {
            Log::error('Error general: ' . $e->getMessage());
            return response()->json(['error' => 'Ocurrió un error.'], 500);
        }
    }
    public function mercadoPagoSuccess(Request $request)
    {
        try {
            DB::beginTransaction();

            $items = $this->getCartContent();

            $this->createSaleMP($request->all(), $items);
            $this->updateStock($items);

            DB::commit();
            Cart::destroy();
            if (Auth::guard('cliente')->check()) {
                Cart::store(Auth::guard('cliente')->id());
            }

            session()->forget('tipo_cambio');
            session()->forget('total_soles');

            return view('payout.success', ['transaccion_id' => $request->preference_id]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al procesar la venta: ' . $e->getMessage());
            return redirect()->route('mercadopago.cancel')
                ->with('error', 'Ocurrió un error al procesar la venta. Por favor, contacte a soporte.');
        }
    }

    public function mercadoPagoCancel()
    {
        return view('payout.error');
    }
    public function success(Request $request)
    {
        $provider = $this->initializePayPalProvider();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            try {
                DB::beginTransaction();

                $items = $this->getCartContent();

                $this->createSale($response, $items);
                $this->updateStock($items);

                DB::commit();
                Cart::destroy();
                if (Auth::guard('cliente')->check()) {
                    Cart::store(Auth::guard('cliente')->id());
                }

                session()->forget('tipo_cambio');
                session()->forget('total_soles');

                return view('payout.success', ['transaccion_id' => $response['id']]);
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Error al procesar la venta: ' . $e->getMessage());
                return redirect()->route('mercadopago.cancel')
                    ->with('error', 'Ocurrió un error al procesar la venta. Por favor, contacte a soporte.');
            }
        }

        return redirect()->route('mercadopago.cancel')->with('error', 'El pago no pudo ser procesado.');
    }

    protected function checkAvailability($cartItems)
    {
        foreach ($cartItems as $item) {
            $producto = Producto::findOrFail($item->id);
            if (!$producto->disponible) {
                return [
                    'success' => false,
                    'mensaje' => "El producto {$producto->modelo} no está disponible para la venta en este momento."
                ];
            }
        }
        return ['success' => true];
    }

    protected function checkStock($cartItems)
    {
        foreach ($cartItems as $item) {
            $producto = Producto::findOrFail($item->id);
            $talla = $item->options->talla;

            $cantidadDisponible = $producto->tallas()
                ->where('tallas.talla', $talla)
                ->first()
                ->pivot
                ->cantidad;

            if ($cantidadDisponible < $item->qty) {
                return [
                    'success' => false,
                    'mensaje' => "Producto {$producto->modelo} en talla {$talla} no tiene suficiente stock. Disponible: {$cantidadDisponible}"
                ];
            }
        }
        return ['success' => true];
    }

    private function initializePayPalProvider()
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        return $provider;
    }

    private function createSale($response, $items)
    {
        $cliente = Auth::guard('cliente')->user();

        $venta = Venta::create([
            'cliente_id' => $cliente->id,
            'total' => session()->get('total_soles'),
            'fecha' => now(),
            'metodo_pago' => 'PayPal',
            'tipo_cambio' => session()->get('tipo_cambio'),
            'total_dolares' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
            'estado' => 'Por recoger',
            'transaccion_id' => $response['id'],
            'payer_email' => $response['payer']['email_address']
        ]);

        $this->createSaleDetails($venta, $items);
    }

    private function createSaleMP($response, $items)
    {
        $cliente = Auth::guard('cliente')->user();

        $venta = Venta::create([
            'cliente_id' => $cliente->id,
            'total' => session()->get('total_soles'),
            'fecha' => now(),
            'metodo_pago' => 'Mercado Pago',
            'tipo_cambio' => session()->get('tipo_cambio'),
            'total_dolares' => $this->solesToUSD(session()->get('total_soles')),
            'estado' => 'Por recoger',
            'transaccion_id' => $response['preference_id'],
            'payer_email' => $response['payer']['email'] ?? null
        ]);

        $this->createSaleDetails($venta, $items);
    }

    private function createSaleDetails(Venta $venta, $items)
    {
        foreach ($items as $item) {
            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $item->id,
                'talla' => $item->options->talla,
                'cantidad' => $item->qty,
                'precio_unitario' => $item->price,
                'subtotal' => $item->price * $item->qty,
            ]);
        }
    }

    private function updateStock($items)
    {
        try {
            DB::beginTransaction();

            foreach ($items as $item) {
                $producto = Producto::findOrFail($item->id);
                $talla = $item->options->talla;

                $tallaProducto = $producto->tallas()
                    ->where('tallas.talla', $talla)
                    ->first();

                if (!$tallaProducto) {
                    Log::error("Talla no encontrada para el producto {$producto->modelo}");
                }

                $cantidadActual = $tallaProducto->pivot->cantidad;
                $nuevaCantidad = max(0, $cantidadActual - $item->qty);

                $tallaId = Talla::where('talla', $talla)->first()->id;
                $producto->tallas()->updateExistingPivot($tallaId, [
                    'cantidad' => $nuevaCantidad,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar el stock: ' . $e->getMessage());
        }
    }
}