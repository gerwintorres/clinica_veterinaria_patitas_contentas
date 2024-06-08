<?php
    $pagina_actual = '';
    include '../../includes/templates/header.php';
    require '../../config/funciones_medico.php';
    require '../../config/funciones_procedimientos.php';

    if (isset($_SESSION['id_medico']) && $_SESSION['loggedin'] == true) {
        $id_cita = intval($_GET['ici']);
        $programacion = obtenerProgramacion($_SESSION['id_medico']);
        $procedimientos = obtenerProcedimientos();
    }

    foreach ($programacion as $cita) {
        if ($cita['id_cita'] == $id_cita) {
            $nombre_mascota = $cita['nombre_mascota'];
            $nombre_cliente = $cita['nombre_cliente'];
            $hora = $cita['hora_fin'];
            break;
        }
    }
?>

<div class="contenedor contenedor-boton-atras">
    <a href="paciente_consulta.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Orden médica</h1>

<div class="imagen-formularios-cerrados contenedor">
        <img src="../../build/img/logo.webp" alt="Logotipo Patitas Contentas">
        <div class="titulo">
            <span>Clínica Veterinaria</span>
            <span class="segunda_parte">Patitas Contentas</span>
        </div>
</div>

<main class="formulario-cerrado contenedor">
    <form action="">
        <div class="form-grupo-cerrado">
            <div>
                <label for="fecha">Fecha</label>
                <input type="date" class="input-cerrado" id="fecha" value="<?php echo date('Y-m-d')?>" name="fecha" disabled>
            </div>
            <div>
                <label for="hora">Hora</label>
                <input type="time" class="input-cerrado" id="hora" value="<?php echo $hora?>" name="hora" disabled>
            </div>
            <div>
                <label for="nombreMascota">Nombre de la mascota</label>
                <input type="text" class="input-cerrado" id="nombreMascota" value="<?php echo $nombre_mascota?>" name="nombreMascota" disabled>
            </div> 
            <div>
                <label for="nombreDueno">Nombre del cliente</label>
                <input type="text" class="input-cerrado" id="nombreDueno" value="<?php echo $nombre_cliente?>" name="nombreDueno" disabled>
            </div>
        </div>
        <hr class="margen-superior">
        <div class="form-grupo-cerrado-3">
            <div>
                <label for="medico">Médico solicitante</label>
                <input type="text" class="input-cerrado" id="medico" name="medico" value="<?php echo $_SESSION['nombres']?>" disabled>
            </div>
            <div>
                <label for="tipoProcedimiento">Tipo de procedimiento</label>
                <select name="tipoProcedimiento" id="tipoProcedimiento" required class="procedimiento-orden">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <?php foreach ($procedimientos as $procedimiento): ?>
                        <option value="<?php echo htmlspecialchars($procedimiento['id_servicio']); ?>">
                            <?php echo htmlspecialchars($procedimiento['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="justificacion">Justificación</label>
                <input type="text" class="input-cerrado" id="justificacion" name="justificacion" required>
            </div>
        </div>
        <input class="boton-formulario-azul margen-superior margen-inferior" type="submit" value="GENERAR ORDEN"> 
    </form>
</main>
<?php
    include '../../includes/templates/footer.php';
?>