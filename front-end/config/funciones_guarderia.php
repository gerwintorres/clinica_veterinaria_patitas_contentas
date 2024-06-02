<?php

function agendarEstancia($id_mascota, $fecha, $hora, $comentarios){

    $date_format_input = 'Y-m-d';
    $date = DateTime::createFromFormat($date_format_input, $fecha);
    if ($date) {
        $date_format_output = 'd/m/Y';
        $nueva_fecha = $date->format($date_format_output);
    }

    $data = array(
        'fecha' => $nueva_fecha,
        'hora' => $hora,
        'comentarios' => $comentarios,
        'id_mascota' => $id_mascota
    );
    echo "<pre>";
    echo json_encode($data);
    echo "</pre>";    
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
        // Maneja el error
        echo $http_code;
        // echo '<script>alert("Error en el registro");</script>';
    }
}

?>