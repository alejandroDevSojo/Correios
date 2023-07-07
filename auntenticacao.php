<?php
echo "Hola mundo";
echo "<hr>";


$api_endpoint = 'https://api.correios.com.br/token/v3/api-docs';


$user = '86997020518';
$pass = 'T26792934o';


$result = api_request($api_endpoint, $user, $pass);

if ($result !== false) {
    echo "Conexión exitosa con la API";
} else {
    echo "Error al conectar con la API";
}

function api_request($endpoint, $user, $pass)
{
    $curl = curl_init($endpoint);
    $headers = array (
        "Content-Type: application/json",
        "Authorization: Basic " . base64_encode($user . ':' . $pass)
    );

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($curl);

    if(curl_errno($curl)){
        throw new Exception(curl_error($curl));
    }

    curl_close($curl);

    return $response !== false ? $response : false;
}

?>
