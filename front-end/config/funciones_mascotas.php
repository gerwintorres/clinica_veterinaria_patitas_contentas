<?php

function obtenerMascotas($id_cliente) {

    $url = "http://127.0.0.1:8000/mascota/$id_cliente";

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
        echo '<script>
            window.location.href = "../mascotas/mis_mascotas.php";
            alert("Registrado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en el registro");</script>';
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
        echo '<script>
            window.location.href = "../mascotas/mis_mascotas.php";
            alert("Actualizado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en la actualización");</script>';
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
        echo '<script>
            window.location.href = "../mascotas/mis_mascotas.php";
            alert("Eliminado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en la eliminación");</script>';
    }
    
}