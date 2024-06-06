<?php

function agendarEstancia($id_mascota, $fecha, $hora, $comentarios){
    $data = array(
        'hora' => $hora,
        'fecha' => $fecha,
        'comentarios' => $comentarios,
        'id_mascota' => $id_mascota
    );

    $ch = curl_init('http://127.0.0.1:8000/mascota/guarderia');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 201) {
        $result = json_decode($response, true);
        echo '<script>
            window.location.href = "guarderia.php";
            alert("Registrado con éxito");
        </script>';
    } else {
        echo '<script>alert("Error en el registro");</script>';
    }
}

function obtenerEstadias($id_cliente){

    $url ="http://127.0.0.1:8000/mascota/guarderia/lista/$id_cliente";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $estadias = json_decode($response, true);
        return $estadias;
    }
}

?>