<?php   
require 'funciones_proveedores.php';
require_once 'funciones_alertas.php';

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
        $proveedores = obtenerProveedores();

        foreach ($productos as &$producto) {
            foreach ($proveedores as $proveedor) {
                if ($producto['id_proveedor'] === $proveedor['id_proveedor']) {
                    $producto['nombre_proveedor']= $proveedor['nombre'];
                }
            }
        }

        // Desvincular el último elemento con referencia para evitar efectos secundarios no deseados
        unset($producto);
        return $productos;
    }
}
function registrarProductos($nombre, $fecha_vencimiento, $cantidad, $id_proveedor, $precio_compra, $precio_venta, $lote){
    $data = array(
        'id_proveedor' => $id_proveedor,
        'nombre' => $nombre,
        'fecha_vencimiento' => $fecha_vencimiento,
        'cantidad' => $cantidad,
        'precio_compra' => $precio_compra,
        'precio_venta' => $precio_venta,
        'lote' => $lote
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
        $_SESSION['registro'] = true;
        echo '<script> window.location.href = "productos.php";</script>';
    } else {
        // Maneja el error
        alertaErrorGeneral('Error al registrar el producto');
    }
    
}

function actualizarProductos($id_producto, $nombre, $fecha_vencimiento, $cantidad, $id_proveedor,$precio_compra, $precio_venta, $lote){
    $data = array(
        'id_proveedor' => $id_proveedor,
        'nombre' => $nombre,
        'fecha_vencimiento' => $fecha_vencimiento,
        'cantidad' => $cantidad,
        'precio_compra' => $precio_compra,
        'precio_venta' => $precio_venta,
        'lote' => $lote
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
        $_SESSION['actualizado'] = true;
        echo '<script> window.location.href = "productos.php";</script>';
    } else {
        // Maneja el error
        alertaErrorGeneral('Error al actualizar el producto');
    }
}

function eliminarProducto($id_producto){

    $ch = curl_init("http://127.0.0.1:8000/delete/producto/$id_producto");

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
        // Maneja el error
        alertaErrorGeneral('Error al eliminar el producto');
    }
    
}

?>