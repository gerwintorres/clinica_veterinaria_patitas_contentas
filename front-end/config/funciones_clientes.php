<?php 
require_once 'funciones_alertas.php';

function obtenerClientes(){

    $url = "http://127.0.0.1:8000/admin/clientes";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $clientes = json_decode($response, true);
        return $clientes;
    }
}

function obtenerInformacionCliente($id_cliente){

    $url = "http://127.0.0.1:8000/cliente/$id_cliente";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $cliente = json_decode($response, true);
        return $cliente;
    }

}

function actualizarCliente($id_cliente, $nombre, $apellidos, $telefono, $correo, $clave, $direccion){
    $data = array(
        'nombres' => $nombre,
        'apellidos' => $apellidos,
        'telefono' => $telefono,
        'email' => $correo,
        'clave' => $clave,
        'direccion' => $direccion
    );

    $ch = curl_init("http://127.0.0.1:8000/update/cliente/$id_cliente");

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
        echo $_SESSION['actualizado'];
        echo '<script> window.location.href = "configuracion.php";</script>';
    } else {
        // Maneja el error
        alertaErrorGeneral('Error al actualizar el perfil');
    }        
}

function eliminarCliente($id_cliente){

        $ch = curl_init("http://127.0.0.1:8000/cliente/delete/$id_cliente");
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);    
    
        if ($http_code == 200) { // Verificar el código de estado HTTP correcto
            $result = json_decode($response, true);
            if($_SESSION['usuario'] == 'admin'){
                $_SESSION['eliminado'] = true;
            }else{
                session_unset();
                session_destroy();
                echo '<script> window.location.href = "../../index.php?e=1";</script>';
            }
        } else {
            // Maneja el error
            alertaErrorGeneral('Error al eliminar el usuario');
        }
    }

?>