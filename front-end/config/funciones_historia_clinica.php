<?php 
require 'funciones_clientes.php';
require 'funciones_mascotas.php'; 

function obtenerHistoriasClinicas(){
    
    $url = "http://127.0.0.1:8000/admin/historias";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $historias = json_decode($response, true);
        return $historias;
    }
}

function visualizarHistoria($id_historia_clinica){

    $url = "http://127.0.0.1:8000/admin/historias/detalle/$id_historia_clinica";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $historias = json_decode($response, true);
        return $historias;
    }

}
?>