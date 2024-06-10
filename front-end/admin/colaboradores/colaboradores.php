<?php
    $pagina_actual = '';
    $titulo = 'Colaboradores';
    $ruta_boton_atras = '../menu_admin.php';
    $texto_card = 'añadir nuevo <br> colaborador';
    $texto_tabla = 'Lista de colaboradores';
    $ruta_card = 'anadir_colaborador.php';
    include '../../includes/templates/pagina_card.php';
    require '../../config/funciones_colaboradores.php';


    if(isset($_SESSION['loggedin']) && $_SESSION['usuario'] = 'admin'){
        $colaboradores = obtenerColaboradores();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_colaborador'])) {
        $id_colaborador = $_GET['id_colaborador'];
        eliminarColaborador($id_colaborador);
    }
    if(isset($_SESSION['registro'])){
        alertaRegistro('Colaborador registrado exitosamente');
        unset($_SESSION['registro']);
    }elseif(isset($_SESSION['actualizado'])){
        alertaActualizado('Colaborador actualizado exitosamente');
        unset($_SESSION['actualizado']);
    }elseif(isset($_SESSION['eliminado'])){
        alertaEliminado('Colaborador eliminado exitosamente', 'colaboradores.php');
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