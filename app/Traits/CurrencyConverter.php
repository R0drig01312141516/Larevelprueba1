<?php

namespace App\Traits;

use App\Models\TipoCambio;

trait CurrencyConverter
{
    public static function solesToUSD($amount)
    {
        return round($amount / self::getTipoCambio(), 2);
    }

    public static function getTipoCambio()
    {
        $token = env('API_SUNAT_TOKEN');
        $url = 'https://api.apis.net.pe/v2/sunat/tipo-cambio';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Referer: ' . $url,
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $tipoCambioSunat = json_decode($response);

        if (isset($tipoCambioSunat->precioVenta)) {
            return $tipoCambioSunat->precioVenta;
        }

        return TipoCambio::latest()->first()->tipo_cambio ?? 3.7;
    }
}
