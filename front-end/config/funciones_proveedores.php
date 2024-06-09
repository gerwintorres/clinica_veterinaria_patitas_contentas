<?php   
require 'funciones_alertas.php';
function obtenerProveedores() {

    $url = "http://127.0.0.1:8000/admin/proveedores";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $proveedores = json_decode($response, true);
        return $proveedores;
    }
}

function registrarProveedor($nombre, $ubicacion, $email, $telefono){
    $data = array(
        'nombre' => $nombre,
        'ubicacion' => $ubicacion,
        'email' => $email,
        'telefono' => $telefono
    );

    $ch = curl_init('http://127.0.0.1:8000/register/proveedor');

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
        echo '<script> window.location.href = "proveedores.php";</script>';
    } else {
        alertaErrorGeneral('Error al registrar el proveedor');
    }
    
}

function actualizarProveedor($id_proveedor, $nombre, $ubicacion, $email, $telefono) {
    $data = array(
        'nombre' => $nombre,
        'ubicacion' => $ubicacion,
        'email' => $email,
        'telefono' => $telefono
    );
    

    $ch = curl_init("http://127.0.0.1:8000/update/proveedor/$id_proveedor");

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
        echo '<script> window.location.href = "proveedores.php";</script>';
    } else {
        alertaErrorGeneral('Error al actualizar el proveedor');
    }
}

function eliminarProveedor($id_proveedor){

    $ch = curl_init("http://127.0.0.1:8000/delete/proveedor/$id_proveedor");

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
        alertaErrorGeneral('Error al eliminar el proveedor');
    }
    
}

?>