<?php

function obtenerProcedimientos(){
    $url = "http://127.0.0.1:8000/admin/precios";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $procedimientos = json_decode($response, true);
        return $procedimientos;
    }
}

function registrarProcedimiento($nombre, $precio){
    $data = array(
        'nombre' => $nombre,
        'precio' => $precio
    );
    
    $ch = curl_init('http://127.0.0.1:8000/register/precios');

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
            window.location.href = "procedimientos.php";
            alert("Registrado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en el registro");</script>';
    }
}

function actualizarProcedimiento($id_servicio, $nombre, $precio){
    $data = array(
        'nombre' => $nombre,
        'precio' => $precio
    );
    
    $ch = curl_init("http://127.0.0.1:8000//update/precios/$id_servicio");

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
            window.location.href = "procedimientos.php";
            alert("Actualizado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en la actualización");</script>';
    }
}

function eliminarProcedimiento($id_servicio){
    $ch = curl_init("http://127.0.0.1:8000//delete/precios/$id_servicio");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) { // Verificar el código de estado HTTP correcto
        $result = json_decode($response, true);
        echo '<script>
            window.location.href = "procedimientos.php";
            alert("Eliminado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en la eliminación");</script>';
    }
}
?>