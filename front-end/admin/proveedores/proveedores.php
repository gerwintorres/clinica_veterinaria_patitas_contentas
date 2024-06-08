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
            </tbody>
        </table>
    </article>
<?php
    $pagina_actual = '';
    include '../../includes/templates/footer.php';
?>