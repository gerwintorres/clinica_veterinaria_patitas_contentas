<?php
    $pagina_actual = '';
    $titulo = 'Productos';
    $ruta_boton_atras = '../menu_admin.php';
    $texto_card = 'añadir nuevo <br> producto';
    $texto_tabla = 'Lista de productos';
    $ruta_card = 'anadir_producto.php';
    require '../../config/funciones_productos.php';
    include '../../includes/templates/pagina_card.php';

    if(isset($_SESSION['loggedin']) && $_SESSION['usuario'] = 'admin'){
        $productos = obtenerProductos();
        $proveedores = obtenerProveedores();
        foreach ($productos as $producto) {
            foreach ($proveedores as $proveedor) {
                if ($producto['id_proveedor'] === $proveedor['id_proveedor']) {
                    $producto['proveedor'] = $proveedor['nombre'];
                }
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];
        eliminarProducto($id_producto);
    }
?>

<article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha de vencimiento</th>
                    <th>Lote</th>
                    <th>Unidades disponibles</th>
                    <th>Proveedor</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($productos) && is_array($productos)):?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($producto['fecha_vencimiento']); ?></td>
                            <td><?php echo htmlspecialchars($producto['lote']); ?></td>
                            <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($producto['proveedor']); ?></td>
                            <td><a href="modificar_producto.php?id_producto=<?php echo $producto['id_producto']?>"><button class="edit">EDITAR</button></a></td>
                            <td><a href="producto.php?id_producto=<?php echo $producto['id_producto']?>"><button class="delete">ELIMINAR</button></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </article>
<?php
    $pagina_actual = '';
    include '../../includes/templates/footer.php';
?>