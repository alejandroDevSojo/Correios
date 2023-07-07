<?php

require_once "Auenticao_correios.php";

// URL de la API de los Correios
$apiUrl = 'https://api.correios.com.br/token/v3/api-docs';

// Realizar la solicitud
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

// Verificar si la solicitud fue exitosa
if ($response === false) {
    echo "Error al realizar la solicitud";
} else {
    // Decodificar la respuesta como JSON
    $jsonData = json_decode($response, true);

    // Verificar si la decodificación fue exitosa
    if ($jsonData === null) {
        echo "Error al decodificar los datos JSON";
    } else {
        // Acceder a los datos JSON
        // Aquí puedes trabajar con los datos obtenidos desde la API de los Correios
        var_dump($jsonData);
    }
}

// Cerrar la conexión cURL
curl_close($ch);

?>

