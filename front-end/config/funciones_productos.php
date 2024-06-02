<?php   

function obtenerProductos() {

    $url = "http://127.0.0.1:8000/admin/productos";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $productos = json_decode($response, true);
        return $productos;
    }
}

function registrarProductos($id_producto, $nombre, $fecha_vencimiento, $cantidad, $precio_compra, $id_lote){
    $data = array(
        'id_producto' => $id_producto,
        'nombre' => $nombre,
        'fecha_vencimiento' => $fecha_vencimiento,
        'cantidad' => $cantidad,
        'precio_compra' => $precio_compra,
        'id_lote' => $id_lote
    );

    $ch = curl_init('http://127.0.0.1:8000/register/producto');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 201) {
        $result = json_decode($response, true);
        echo '<script>
            window.location.href = "productos.php";
            alert("Registrado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en el registro");</script>';
    }
    
}

function actualizarProductos($id_producto, $nombre, $fecha_vencimiento, $cantidad, $precio_compra, $id_lote){
    $data = array(
        'nombre' => $nombre,
        'fecha_vencimiento' => $fecha_vencimiento,
        'cantidad' => $cantidad,
        'precio_compra' => $precio_compra,
        'id_lote' => $id_lote
    );

    $ch = curl_init("http://127.0.0.1:8000/update/producto/$id_producto");

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
            window.location.href = "productos.php";
            alert("Actualizado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en la actualización");</script>';
    }
}

function eliminarProducto($id_producto){

    $ch = curl_init("http://127.0.0.1:8000/delete/producto/$id_producto)");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) { // Verificar el código de estado HTTP correcto
        $result = json_decode($response, true);
        echo '<script>
            window.location.href = "productos.php";
            alert("Eliminado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en la eliminación");</script>';
    }
    
}

?>