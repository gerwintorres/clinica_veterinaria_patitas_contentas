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
?>