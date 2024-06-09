<?php
    $pagina_actual = '';
    $titulo = 'Citas médicas';
    $ruta_boton_atras = '../menu_cliente.php';
    $texto_card = 'agendar nuevo <br> procedimiento';
    $texto_tabla = 'Citas agendadas';
    $ruta_card = 'agendar_cita.php';
    require '../../config/funciones_citas.php';
    include '../../includes/templates/pagina_card.php';

    if (isset($_SESSION['id_cliente'])) {
        $citas = obtenerCitas($_SESSION['id_cliente']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_cita'])) {
        eliminarCita($_GET['id_cita']);
    }

    if(isset($_SESSION['registro'])){
        alertaRegistro('Cita para procedimiento registrada exitosamente');
        unset($_SESSION['registro']);
    }elseif(isset($_SESSION['actualizado'])){
        alertaActualizado('Cita para procedimiento actualizada exitosamente');
        unset($_SESSION['actualizado']);
    }elseif(isset($_SESSION['eliminado'])){
        alertaEliminado('Cita para procedimiento eliminada exitosamente', 'citas_medicas.php');
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
                    <th>Nombre</th>
                    <th>Tipo de mascota</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Médico/Colab.</th>
                    <th>Procedimiento</th>
                    <?php if($_SESSION['administrador']): ?>
                        <th>Editar</th>
                    <?php endif; ?>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($citas) && is_array($citas)):?>
                    <?php foreach ($citas as $cita):?>
                        <tr>
                            <td><?php echo htmlspecialchars($cita['nombre_mascota']); ?></td>
                            <td><?php echo htmlspecialchars($cita['tipo_mascota']); ?></td>
                            <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($cita['hora']); ?></td>
                            <?php if($cita['nombre_medico'] == null): ?>
                                <td><?php echo htmlspecialchars($cita['nombre_colaborador']); ?></td>
                            <?php else: ?>
                                <td><?php echo htmlspecialchars($cita['nombre_medico']); ?></td>
                            <?php endif; ?>
                            <td><?php echo htmlspecialchars($cita['procedimiento']); ?></td>
                            <?php if($_SESSION['administrador']): ?>
                                <td><a href="modificar_cita.php?id_cita=<?php echo $cita['id_cita']?>"><button class="edit">EDITAR</button></a></td>
                            <?php endif; ?>
                            <td><a href="citas_medicas.php?id_cita=<?php echo $cita['id_cita']?>"><button class="delete">ELIMINAR</button></a></td>
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
