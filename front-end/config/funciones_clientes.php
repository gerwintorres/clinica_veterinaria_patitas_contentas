<?php 

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
        echo '<script>
            window.location.href = "configuracion.php";
            alert("Actualizado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en la actualización");</script>';
    }        
}

?>