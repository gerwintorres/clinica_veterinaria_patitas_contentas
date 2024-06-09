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

function actualizarEstancia($id_registro, $fecha, $hora, $comentarios){
    $data = array(
        'hora' => $hora,
        'fecha' => $fecha,
        'comentarios' => $comentarios
    );

    $ch = curl_init("http://127.0.0.1:8000/update/guarderia/$id_registro");

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
            window.location.href = "guarderia.php";
            alert("Actualizado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en la actualización");</script>';
    }
}

function eliminarEstancia($id_registro){

    $ch = curl_init("http://127.0.0.1:8000/delete/guarderia/$id_registro");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) { // Verificar el código de estado HTTP correcto
        $result = json_decode($response, true);
        echo '<script>
            window.location.href = "guarderia.php";
            alert("Eliminado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en la eliminación");</script>';
    }
}

function obtenerProgramacion(){

    $url ="http://127.0.0.1:8000/admin/programacion_guarderia";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $programacion = json_decode($response, true);
        return $programacion;
    }
}

function realizarCheckIn($id_registro, $hora, $fecha){
    $data = array(
        'id_registro' => $id_registro,
        'fecha_entrada' => $fecha,
        'hora_entrada' => $hora
    );

    $ch = curl_init('http://127.0.0.1:8000/admin/checkin_guarderia');

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
            alert("CheckIn con éxito");
        </script>';
    } else {
        echo '<script>alert("Error en el registro");</script>';
    }
}

function realizarCheckOut($id_registro, $hora, $fecha){

    $data = array(
        'id_cobro' => 0,
        'id_registro' => $id_registro,
        'total' => 0, // Se debe calcular el total
        'fecha_salida' => $fecha,
        'hora_salida' => $hora
    );

    $ch = curl_init('http://127.0.0.1:8000/admin/checkout_guarderia');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $result = json_decode($response, true);
        echo '<script>
            window.location.href = "recibo_guarderia.php";
            alert("CheckOut con éxito");
        </script>';
        
    } else {
        echo '<script>alert("Error en el registro");</script>';
    }
}

function obtenerFactura($id_cobro){
    
    $url ="http://127.0.0.1:8000/admin/facturacion/$id_cobro";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $factura = json_decode($response, true);
        return $factura;
    }
}
?>