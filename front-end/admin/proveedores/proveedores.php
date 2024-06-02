<?php
    $pagina_actual = '';
    $titulo = 'Proveedores';
    $ruta_boton_atras = '../menu_admin.php';
    $texto_card = 'añadir nuevo <br> proveedor';
    $texto_tabla = 'Lista de proveedores';
    $ruta_card = 'anadir_proveedor.php';
    require '../../config/funciones_proveedores.php';
    include '../../includes/templates/pagina_card.php'; 

    if(isset($_SESSION['loggedin']) && $_SESSION['usuario'] = 'admin'){
        $proveedores = obtenerProveedores();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_proveedor'])) {
        $id_proveedor = $_GET['id_proveedor'];
        eliminarProveedor($id_proveedor);
    }
?>
    <article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Email</th>
                    <th>Télefono</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($proveedores) && is_array($proveedores)):?>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($proveedor['id_proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['ubicacion']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['email']); ?></td>
                            <td><?php echo htmlspecialchars($proveedor['telefono']); ?></td>
                            <td><a href="modificar_proveedor.php?id_proveedor=<?php echo $proveedor['id_proveedor']?>"><button class="edit">EDITAR</button></a></td>
                            <td><a href="proveedores.php?id_proveedor=<?php echo $proveedor['id_proveedor']?>"><button class="delete">ELIMINAR</button></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Ubicación</td>
                    <td>Email</td>
                    <td>Télefono</td>
                    <td><button class="edit">EDITAR</button></td>
                    <td><button class="delete">ELIMINAR</button></td>
                </tr>
                <!-- Repite las filas según sea necesario -->
            </tbody>
        </table>
    </article>
<?php
    $pagina_actual = '';
    include '../../includes/templates/footer.php';
?>