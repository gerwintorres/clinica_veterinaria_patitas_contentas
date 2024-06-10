<?php
    $pagina_actual = '';
    $titulo = 'Procedimientos';
    $ruta_boton_atras = '../menu_admin.php';
    $texto_card = 'añadir nuevo <br> procedimiento';
    $texto_tabla = 'Lista de procedimientos';
    $ruta_card = 'anadir_procedimiento.php';
    require '../../config/funciones_procedimientos.php';
    include '../../includes/templates/pagina_card.php';

    if(isset($_SESSION['loggedin']) && $_SESSION['usuario'] == 'admin'){
        $procedimientos = obtenerProcedimientos();
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_servicio'])){
        $id_servicio = $_GET['id_servicio'];
        eliminarProcedimiento($id_servicio);
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
                <th>Nombre de procedimiento</th>
                <th>Precio (COP)</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($procedimientos) && is_array($procedimientos)): ?>
                <?php foreach($procedimientos as $procedimiento): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($procedimiento['id_servicio']); ?></td>
                        <td><?php echo htmlspecialchars($procedimiento['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($procedimiento['precio']); ?></td>
                        <td><a href="modificar_procedimiento.php?id_servicio=<?php echo $procedimiento['id_servicio']?>"><button class="edit">EDITAR</button></a></td>
                        <td><a href="procedimientos.php?id_servicio=<?php echo $procedimiento['id_servicio']?>"><button class="delete">ELIMINAR</button></a></td>
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