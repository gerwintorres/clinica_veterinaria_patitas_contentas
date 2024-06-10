<?php
    $pagina_actual = '';
    include '../../includes/templates/header.php';
    require '../../config/funciones_ordenes.php';

    if (isset($_SESSION['id_cliente'])) {
        $id_cliente = $_SESSION['id_cliente'];

        $orden = obtenerOrden($_GET['id_orden']);

        $hora = $orden['hora_cita'];

        $timeParts = explode(':', $hora);
        $hours = sprintf('%02d', $timeParts[0]); // Añade el 0 a la izquierda si es necesario
        $minutes = sprintf('%02d', $timeParts[1]);
        $seconds = sprintf('%02d', $timeParts[2]);

        $hora_formateada = "$hours:$minutes:$seconds";
        $timestamp = strtotime($hora_formateada);
        $timestamp += 1800;
        $hora_mas_media_hora = date('H:i:s', $timestamp);
    }
?>

<div class="contenedor contenedor-boton-atras">
    <a href="ordenes_medicas.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Orden médica, Código <?php echo $_GET['id_orden'] ?></h1>

<div class="imagen-formularios-cerrados contenedor">
        <img src="../../build/img/logo.webp" alt="Logotipo Patitas Contentas">
        <div class="titulo">
            <span>Clínica Veterinaria</span>
            <span class="segunda_parte">Patitas Contentas</span>
        </div>
</div>

<main class="formulario-cerrado contenedor">
    <form action="" method="POST">
        <div class="form-grupo-cerrado">
            <div>
                <label for="fecha">Fecha</label>
                <input type="date" class="input-cerrado" id="fecha" value="<?php echo $orden['fecha_cita']?>" name="fecha" disabled>
            </div>
            <div>
                <label for="hora">Hora</label>
                <input type="time" class="input-cerrado" id="hora" value="<?php echo $hora_mas_media_hora?>" name="hora" disabled>
            </div>
            <div>
                <label for="nombreMascota">Nombre de la mascota</label>
                <input type="text" class="input-cerrado" id="nombreMascota" value="<?php echo $orden['nombre_mascota']?>" name="nombreMascota" disabled>
            </div> 
            <div>
                <label for="nombreDueno">Nombre del cliente</label>
                <input type="text" class="input-cerrado" id="nombreDueno" value="<?php echo $_SESSION['nombres']?>" name="nombreDueno" disabled>
            </div>
        </div>
        <hr class="margen-superior">
        <div class="form-grupo-cerrado-3">
            <div>
                <label for="medico">Médico solicitante</label>
                <input type="text" class="input-cerrado" id="medico" name="medico" value="<?php echo $orden['nombre_medico']?>" disabled>
            </div>
            <div>
                <label for="tipoProcedimiento">Tipo de procedimiento</label>
                <select name="tipoProcedimiento" id="tipoProcedimiento" disabled class="procedimiento-orden">
                    <option value="" selected><?php echo $orden['nombre_servicio']?></option>
                </select>
            </div>
            <div>
                <label for="justificacion">Justificación</label>
                <input type="text" class="input-cerrado" id="justificacion" value="<?php echo $orden['descripcion']?>" name="justificacion" disabled>
            </div>
        </div>
    </form>
</main>
<?php
    include '../../includes/templates/footer.php';
?>