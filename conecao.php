<?php
session_start();

$localhost = "localhost";
$user = "root";
$pass = "";
$banco = "Correios";

$conecta = mysqli_connect($localhost, $user, $pass, $banco);
mysqli_set_charset($conecta, "utf8");

if (!$conecta) {
    echo "Error de conexión: " . mysqli_connect_error();
} else {
    echo "Conexión exitosa a la base de datos";

    
    $rutaJson = "correio.json";

    
    $contenidoJson = file_get_contents($rutaJson);

    
    $datosJson = json_decode($contenidoJson, true);

    
    if ($datosJson === null) {
        echo "Error al decodificar el JSON";
    } else {
        
            foreach ($methods as $method => $details) {
                $summary = $details['summary'];
                $operationId = $details['operationId'];

                foreach ($details['responses'] as $responseCode => $response) {
                    $responseDescription = $response['description'];
                    $responseContentType = key($response['content']);
                    $responseSchemaRef = $response['content'][$responseContentType]['schema']['$ref'];

                    
                    $sql = "INSERT INTO correios_data (path, method, summary, operationId, response_description, response_content_type, response_schema_ref)
                            VALUES ('$path', '$method', '$summary', '$operationId', '$responseDescription', '$responseContentType', '$responseSchemaRef')";

                    mysqli_query($conecta, $sql);
                }
            }
        }

        echo "Datos insertados correctamente en la base de datos";
    }

?>
