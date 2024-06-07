<?php 
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
        echo '<script>
            window.location.href = "citas_medicas.php";
            alert("Registrado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en el registro");</script>';
    }
    
}
?>