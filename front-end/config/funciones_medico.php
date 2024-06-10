<?php 
require_once 'funciones_alertas.php';

function obtenerProgramacion($id_medico){
    date_default_timezone_set('America/Bogota');
    $fecha = date('Y-m-d');

    $url = "http://127.0.0.1:8000/medico/programacion_del_dia/$id_medico/$fecha";

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

function insertarConsulta($id_historia_clinica, $descripcion){
    $data = array(
        'id_historia_clinica' => $id_historia_clinica,
        'descripcion' => $descripcion,
    );

    $ch = curl_init("http://127.0.0.1:8000/admin/historia_clinica/update/$id_historia_clinica");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Cambiar el método HTTP a PUT
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) { // Verificar el código de estado HTTP correcto
        $result = json_decode($response, true);
        $_SESSION['consulta'] = true;
        echo '<script> window.location.href = "paciente_consulta.php";</script>';
    } else {
        // Maneja el error
        alertaErrorGeneral('Error al registrar la nueva consulta');
    }
}

function crearOrdenMedica($id_cita, $descripcion, $id_servicio){
    $data = array(
        'id_cita' => $id_cita,
        'descripcion' => $descripcion,
        'id_servicio' => $id_servicio,
    );

    $ch = curl_init('http://127.0.0.1:8000/medico/orden_medica');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 201) {
        $result = json_decode($response, true);
        $_SESSION['orden'] = true;
        echo '<script> window.location.href = "paciente_consulta.php";</script>';
    } else {
        // Maneja el error
        alertaErrorGeneral('Error al generar la orden médica');
    }
}
?>