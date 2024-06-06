<?php
    $pagina_actual = '';
    $titulo = 'Clientes';
    $ruta_boton_atras = '../menu_admin.php';
    $texto_card = 'añadir nuevo <br> cliente';
    $texto_tabla = 'Lista de clientes';
    $ruta_card = 'anadir_cliente.php';
    require '../../config/funciones_clientes.php';
    include '../../includes/templates/pagina_card.php';

    if(isset($_SESSION['loggedin']) && $_SESSION['usuario'] = 'admin'){
        $clientes = obtenerClientes();
    }
?>
<article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>Número de documento</th>
                    <th>Tipo de documento</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Ver perfil</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($clientes) && is_array($clientes)):?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cliente['id_cliente']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['tipo_documento']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['nombres']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['apellidos']); ?></td>
                            <td><a href="../../cliente/menu_cliente.php?id_cliente=<?php echo $cliente['id_cliente']?>&nombre_cliente=<?php echo urlencode($cliente['nombres']); ?>"><button class="edit">VER PERFIL</button></a></td>
                            <td><a href=""><button class="delete">ELIMINAR</button></a></td>      
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