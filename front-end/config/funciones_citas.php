<?php 
require_once 'funciones_alertas.php';
    
function agendarCita($id_mascota, $tipoProcedimiento, $fecha , $hora){
    $data = array(
        'hora' => $hora,
        'fecha' => $fecha,
        'procedimiento' => ' ',
        'id_medico' => 0,
        'id_colaborador' => 0,
        'id_servicio' => $tipoProcedimiento,
        'id_mascota' => $id_mascota,
    );

    $ch = curl_init('http://127.0.0.1:8000/cliente/agendar_cita');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $result = json_decode($response, true);
        $_SESSION['registro'] = true;
        echo '<script> window.location.href = "citas_medicas.php";</script>';
    } else {
        // Maneja el error
        alertaErrorGeneral('Error al registrar la cita para el procedimiento');
    }
}

function obtenerCitas($id_cliente){
    
    $url = "http://127.0.0.1:8000/admin/citas/$id_cliente";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $citas = json_decode($response, true);
        return $citas;
    }
}

function eliminarCita($id_cita){

    $ch = curl_init("http://127.0.0.1:8000/delete/citas/$id_cita");

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
        // Maneja el error
        alertaErrorGeneral('Error al eliminar la cita para el procedimiento');
    }
}

function modificarCita($id_cita, $hora, $fecha){
    $data = array(
        'hora' => $hora,
        'fecha' => $fecha,
    );

    $ch = curl_init("http://127.0.0.1:8000/update/citas/$id_cita");

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
        echo '<script> window.location.href = "citas_medicas.php";</script>';
    } else {
        // Maneja el error
        alertaErrorGeneral('Error al actualizar la cita para el procedimiento');
    }
}
?>