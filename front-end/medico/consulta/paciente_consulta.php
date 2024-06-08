<?php
    $pagina_actual = '';
    include '../../includes/templates/header.php';
    require '../../config/funciones_medico.php';
    date_default_timezone_set('America/Bogota');

    if (isset($_SESSION['id_medico']) && $_SESSION['loggedin'] == true) {
        $programacion = obtenerProgramacion($_SESSION['id_medico']);
    }
?>

<div class="contenedor contenedor-boton-atras">
    <a href="../menu_medico.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

    
<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Pacientes</h1>
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
                    <th>Documento cliente</th>
                    <th>Nombre cliente</th>
                    <th>Mascota</th>
                    <th>Tipo de mascota</th>
                    <!-- <th>Raza</th> -->
                    <th>Historia clínica</th>
                    <th>Nueva consulta</th>
                    <th>Generar orden</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($programacion) && is_array($programacion)):?>
                    <?php foreach ($programacion as $cita):?>
                        <tr>    
                            <td><?php echo htmlspecialchars($cita['id_cliente']); ?></td>
                            <td><?php echo htmlspecialchars($cita['nombre_cliente']); ?></td>
                            <td><?php echo htmlspecialchars($cita['nombre_mascota']); ?></td>
                            <td><?php echo htmlspecialchars($cita['tipo_mascota']); ?></td>
                            <td><a href="../../admin/historias/visualizar_historia_clinica.php?id_mascota=<?php echo $cita['id_mascota']?>"><button class="edit">VER</button></a></td>
                            <td><a href="ficha_consulta.php?ic=<?php echo $cita['id_cliente']?>&im=<?php echo $cita['id_mascota']?>"><button class="edit">NUEVA</button></a></td>
                            <td><button class="edit">GENERAR</button></td>  
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </article>
<?php
    include '../../includes/templates/footer.php';
?>