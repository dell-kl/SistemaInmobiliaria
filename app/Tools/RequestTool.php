<?php

namespace App\Tools;

use Exception;

class RequestTool {

    public function __construct() {}

    static function consumeApi($url, $method = 'GET', $data = [], $headers = [])
    {
        // Inicializar cURL
        $ch = curl_init();

        // Configurar la URL
        curl_setopt($ch, CURLOPT_URL, $url);

        // Configurar método HTTP
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        // Configurar datos para POST o PUT
        if ($method === 'POST' || $method === 'PUT') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        // Configurar cabeceras
        // $defaultHeaders = [
        //     'Content-Type: application/json',
        // ];
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($defaultHeaders, $headers));

        // Retornar la respuesta como cadena
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Opcional: Configurar tiempo de espera
        // curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        // Capturar errores
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }

        // Capturar código de estado HTTP
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Cerrar cURL
        curl_close($ch);

        // Devolver la respuesta y código de estado
        return [
            'status_code' => $httpCode,
            'response' => json_decode($response, true),
        ];
    }
}
?>
