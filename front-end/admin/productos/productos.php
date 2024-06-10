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
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];
        eliminarProducto($id_producto);
    }

    if(isset($_SESSION['registro'])){
        alertaRegistro('Producto registrado exitosamente');
        unset($_SESSION['registro']);
    }elseif(isset($_SESSION['actualizado'])){
        alertaActualizado('Producto actualizado exitosamente');
        unset($_SESSION['actualizado']);
    }elseif(isset($_SESSION['eliminado'])){
        alertaEliminado('Producto eliminado exitosamente', 'productos.php');
        unset($_SESSION['eliminado']);
    }
?>

<article class="contenedor contenedor-table">
        <div class="search-container">
            <input type="text" id="search" placeholder="Buscar">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.5 17.5L13.875 13.875M15.8333 9.16667C15.8333 12.8486 12.8486 15.8333 9.16667 15.8333C5.48477 15.8333 2.5 12.8486 2.5 9.16667C2.5 5.48477 5.48477 2.5 9.16667 2.5C12.8486 2.5 15.8333 5.48477 15.8333 9.16667Z" stroke="black" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
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
                            <td><?php echo htmlspecialchars($producto['nombre_proveedor']); ?></td>
                            <td><a href="modificar_producto.php?id_producto=<?php echo $producto['id_producto']?>"><button class="edit">EDITAR</button></a></td>
                            <td><a href="productos.php?id_producto=<?php echo $producto['id_producto']?>"><button class="delete">ELIMINAR</button></a></td>
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