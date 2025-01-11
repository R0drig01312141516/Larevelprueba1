<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MercadoPagoController extends Controller
{
    public function verifyAccessToken()
    {
        // Crear un cliente HTTP
        $client = new Client();

        // Obtener el token de acceso desde la configuración
        $accessToken = config('services.mercadopago.access_token');

        // Configurar el encabezado de autorización
        $headers = [
            'Authorization' => 'Bearer ' . $accessToken,
        ];

        // Intentar obtener la cuenta para verificar el token
        try {
            $response = $client->get('https://api.mercadopago.com/users/me', [
                'headers' => $headers,
            ]);

            $user = json_decode($response->getBody(), true);
            return response()->json(['status' => 'success', 'user' => $user]);

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Manejar errores de cliente (4xx)
            $response = $e->getResponse();
            $responseBody = json_decode($response->getBody()->getContents(), true);
            return response()->json(['status' => 'error', 'message' => $responseBody['message']]);
        } catch (\Exception $e) {
            // Manejar cualquier otro error
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}