<?php

function obtenerMascotas($id_cliente) {

    $url = "http://127.0.0.1:8000/mascotas/$id_cliente";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $mascotas = json_decode($response, true);
        return $mascotas;
    }
}

function registrarMascota($nombre, $tipoMascota, $raza, $edad, $peso){
    $data = array(
        'nombre' => $nombre,
        'tipo_mascota' => $tipoMascota,
        'raza' => $raza,
        'edad' => $edad,
        'peso' => $peso,
        'id_cliente' => $_SESSION['id_cliente']
    );

    $ch = curl_init('http://127.0.0.1:8000/register/mascota');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 201) {
        $result = json_decode($response, true);
        echo '<script>alert("Añadido con exito");</script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en el registro");</script>';
    }
}