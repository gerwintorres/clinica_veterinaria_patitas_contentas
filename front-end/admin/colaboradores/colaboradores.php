<?php
    $pagina_actual = '';
    $titulo = 'Colaboradores';
    $ruta_boton_atras = '../menu_admin.php';
    $texto_card = 'añadir nuevo <br> colaborador';
    $texto_tabla = 'Lista de colaboradores';
    $ruta_card = 'anadir_colaborador.php';
    require '../../config/funciones_colaboradores.php';
    include '../../includes/templates/pagina_card.php';

    if(isset($_SESSION['loggedin']) && $_SESSION['usuario'] = 'admin'){
        $colaboradores = obtenerColaboradores();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_colaborador'])) {
        $id_colaborador = $_GET['id_colaborador'];
        eliminarColaborador($id_colaborador);
    }
?>
    <article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo de documento</th>
                    <th>Nombre completo</th>
                    <th>Labor</th>
                    <th>Télefono</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($colaboradores) && is_array($colaboradores)):?>
                    <?php foreach ($colaboradores as $colaborador): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($colaborador['id_colaborador']); ?></td>
                            <td><?php echo htmlspecialchars($colaborador['tipo_documento']); ?></td>
                            <td><?php echo htmlspecialchars($colaborador['nombres']); ?> <?php echo htmlspecialchars($colaborador['apellidos']); ?></td>
                            <td><?php echo htmlspecialchars($colaborador['labor']); ?></td>
                            <td><?php echo htmlspecialchars($colaborador['telefono']); ?></td>
                            <td><a href="modificar_colaborador.php?id_colaborador=<?php echo $colaborador['id_colaborador']?>"><button class="edit">EDITAR</button></a></td>
                            <td><a href="colaboradores.php?id_colaborador=<?php echo $colaborador['id_colaborador']?>"><button class="delete">ELIMINAR</button></a></td>
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