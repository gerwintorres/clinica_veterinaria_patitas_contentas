<?php
    $pagina_actual = '';
    $titulo = 'Guardería';
    $ruta_boton_atras = '../menu_cliente.php';
    $texto_card = 'agendar mascota';
    $texto_tabla = 'Estancias agendadas';
    $ruta_card = 'agendar_mascota.php';
    include '../../includes/templates/pagina_card.php';
    require '../../config/funciones_guarderia.php';

    if (isset($_SESSION['id_cliente'])){
        $estadias = obtenerEstadias($_SESSION['id_cliente']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_registro'])) {
        eliminarEstancia($_GET['id_registro']);
    }

    if(isset($_SESSION['registro'])){
        alertaRegistro('Estancia en guardería registrada exitosamente');
        unset($_SESSION['registro']);
    }elseif(isset($_SESSION['actualizado'])){
        alertaActualizado('Estancia en guardería actualizada exitosamente');
        unset($_SESSION['actualizado']);
    }elseif(isset($_SESSION['eliminado'])){
        alertaEliminado('Estancia en guardería eliminada exitosamente', 'guarderia.php');
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
                    <th>Peso(Kg)</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($estadias) && is_array($estadias)):?>
                    <?php foreach ($estadias as $estadia): ?>   
                        <tr>
                            <td><?php echo htmlspecialchars($estadia['nombre_mascota']); ?></td>
                            <td><?php echo htmlspecialchars($estadia['tipo_mascota']); ?></td>
                            <td><?php echo htmlspecialchars($estadia['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($estadia['hora']); ?></td>
                            <td><?php echo htmlspecialchars($estadia['peso']); ?></td>
                            <td><a href="modificar_agendamiento.php?id_registro=<?php echo $estadia['id_registro']?>"><button class="edit">EDITAR</button></a></td>
                            <td><a href="guarderia.php?id_registro=<?php echo $estadia['id_registro']?>"><button class="delete">ELIMINAR</button></a></td>
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
