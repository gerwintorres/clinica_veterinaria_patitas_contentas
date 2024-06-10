<?php   
require_once 'funciones_alertas.php';
function obtenerColaboradores() {

    $url = "http://127.0.0.1:8000/admin/colaboradores";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $colaboradores = json_decode($response, true);
        return $colaboradores;
    }
}

function registrarColaborador($nombres, $apellidos, $tipo_documento, $id_colaborador, $labor, $telefono){
    $data = array(
        'id_colaborador' => $id_colaborador,
        'nombres' => $nombres,
        'apellidos' => $apellidos,
        'tipo_documento' => $tipo_documento,
        'labor' => $labor,
        'telefono' => $telefono
    );
    $ch = curl_init('http://127.0.0.1:8000/register/colaborador');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 201) {
        $result = json_decode($response, true);
        $_SESSION['registro'] = true;
        echo '<script> window.location.href = "colaboradores.php";</script>';
    } else {
        alertaErrorGeneral('Error al registrar el colaborador');
    }
}

function actualizarColaborador($id_colaborador, $nombres, $apellidos, $labor, $telefono) {
    $data = array(
        'nombres' => $nombres,
        'apellidos' => $apellidos,
        'labor' => $labor,
        'telefono' => $telefono
    );

    $ch = curl_init("http://127.0.0.1:8000/update/colaborador/$id_colaborador");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Cambiar el método HTTP a PUT
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $result = json_decode($response, true);
        $_SESSION['actualizado'] = true;
        echo '<script> window.location.href = "colaboradores.php";</script>';
    } else {
        alertaErrorGeneral('Error al actualizar el colaborador');
    }
}

function eliminarColaborador($id_colaborador){

    $ch = curl_init("http://127.0.0.1:8000/delete/colaboradores/$id_colaborador");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);    

    if ($http_code == 200) {
        $result = json_decode($response, true);
        $_SESSION['eliminado'] = true;
    } else {
        alertaErrorGeneral('Error al eliminar el colaborador');
    }
    
}

?>