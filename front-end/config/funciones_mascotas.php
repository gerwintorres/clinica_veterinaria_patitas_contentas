<?php
require 'funciones_alertas.php';

function obtenerMascotas($id_cliente) {

    $url = "http://127.0.0.1:8000/mascota/lista/$id_cliente";

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
        'historia_clinica' => '',
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
        $_SESSION['registro'] = true;
        echo '<script> window.location.href = "mis_mascotas.php";</script>';
    } else {
        alertaErrorGeneral('Error al registrar la mascota');
    }
}

function actualizarMascota($id_mascota, $nombre, $tipoMascota, $raza, $edad, $peso) {
    $data = array(
        'nombre' => $nombre,
        'tipo_mascota' => $tipoMascota,
        'raza' => $raza,
        'edad' => $edad,
        'peso' => $peso,
    );

    $ch = curl_init("http://127.0.0.1:8000/update/mascota/$id_mascota");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Cambiar el método HTTP a PUT
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) { // Verificar el código de estado HTTP correcto
        $result = json_decode($response, true);
        $_SESSION['actualizado'] = true;
        echo '<script> window.location.href = "mis_mascotas.php";</script>';
    } else {
        // Maneja el error
        alertaErrorGeneral('Error al actualizar la mascota');
    }
}

function eliminarMascota($id_mascota){

    $ch = curl_init("http://127.0.0.1:8000/delete/mascota/$id_mascota");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) { // Verificar el código de estado HTTP correcto
        $result = json_decode($response, true);
        $_SESSION['eliminado'] = true;
    } else {
        alertaErrorGeneral('Error al eliminar la mascota');
    }
    
}