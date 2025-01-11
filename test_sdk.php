<?php

require 'vendor/autoload.php';

echo "Autoload included\n";

// Importar las clases necesarias de Mercado Pago
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Resources\Preference; // Asegurarse de importar la clase Preference

echo "Classes imported\n";

// Configurar el SDK con el token de acceso
MercadoPagoConfig::setAccessToken('APP_USR-6525696399761429-010601-367456e3826154058a60eea920802de2-1295922582');
echo "SDK configured\n";

function createPreferenceRequest($items, $payer): array
{
    $paymentMethods = [
        "excluded_payment_methods" => [],
        "installments" => 12,
        "default_installments" => 1
    ];

    $backUrls = [
        'success' => 'https://www.your-site/success',
        'failure' => 'https://www.your-site/failure',
        'pending' => 'https://www.your-site/pending'
    ];

    $request = [
        "items" => $items,
        "payer" => $payer,
        "payment_methods" => $paymentMethods,
        "back_urls" => $backUrls,
        "statement_descriptor" => "YOUR_COMPANY_NAME",
        "external_reference" => "1234567890",
        "expires" => false,
        "auto_return" => 'approved'
    ];

    return $request;
}

// Crear la preferencia de pago
function createPaymentPreference(): ?Preference
{
    // Crear el ítem de prueba
    $item = [
        "id" => "1234567890",
        "title" => "Test Item",
        "description" => "Test Item Description",
        "currency_id" => "USD",
        "quantity" => 1,
        "unit_price" => 10.0
    ];

    // Información del pagador de prueba
    $payer = [
        "name" => "Test",
        "surname" => "User",
        "email" => "user@test.com"
    ];

    // Crear la solicitud de preferencia
    $request = createPreferenceRequest([$item], $payer);

    // Instanciar el cliente de preferencias
    $client = new PreferenceClient();

    try {
        // Enviar la solicitud para crear la preferencia
        $preference = $client->create($request);
        echo "Preference created successfully. Init Point: " . $preference->init_point . "\n";
        return $preference;
    } catch (MPApiException $error) {
        echo "Error creating preference: " . $error->getMessage() . "\n";
        return null;
    }
}

// Llamar a la función para crear la preferencia de pago
createPaymentPreference();