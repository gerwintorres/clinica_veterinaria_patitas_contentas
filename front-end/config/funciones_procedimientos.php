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
?>