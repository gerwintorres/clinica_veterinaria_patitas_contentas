<?php 

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
        echo '<script>
            window.location.href = "paciente_consulta.php";
            alert("Actualizado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en la actualización");</script>';
    }
}
?>