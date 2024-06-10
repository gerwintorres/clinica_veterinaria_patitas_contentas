<?php
    $pagina_actual = '';
    include '../../includes/templates/header.php';
    require '../../config/funciones_mascotas.php';
    require '../../config/funciones_guarderia.php';

    if (isset($_SESSION['id_cliente'])) {
        $id_cliente = $_SESSION['id_cliente'];
        $mascotas = obtenerMascotas($id_cliente);
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $comentarios = $_POST['comentarios'];
        $id_mascota = $_POST['mascota'];
        agendarEstancia($id_mascota, $fecha, $hora, $comentarios);
    }

    // Obtener la fecha actual
    $today = date("Y-m-d");
?>

<div class="contenedor contenedor-boton-atras">
    <a href="guarderia.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>
    
<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Agendar mascota</h1>

<main class="contenedor formulario-general">
    <div class="form-imagen-guarderia"></div>
    <div class="form-contenido">
        <form action="" method="POST">
            <h3 class="titulo-formulario">Clínica Veterinaria Patitas Contentas requiere la siguiente información</h3>
            <div class="formulario-datos">
                <div>
                    <label for="mascota">Mascota</label>
                    <select name="mascota" id="mascota" required class="inputs">
                        <option value="" disabled selected>Seleccione una opción</option>
                        <?php foreach ($mascotas as $mascota): ?>
                            <option value="<?php echo htmlspecialchars($mascota['id_mascota']); ?>">
                                <?php echo htmlspecialchars($mascota['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" required class="inputs" min="<?php echo $today;?>">
                </div>
                <div>
                    <label for="hora">Hora</label>
                    <input type="time" id="hora" name="hora" required class="inputs" step="1800">
                </div>
            </div>
            <div class="formulario-datos-comentarios">
                <label for="comentarios">Comentarios adicionales</label>
                <input type="text" id="comentarios" name="comentarios" class="inputs">
            </div>
            <div class="contenido-centrado">
                <input class="boton-formulario-azul margen-superior" type="submit" value="AGENDAR ESTANCIA">
            </div>
        </form>
    </div>
</main>

<?php
    include '../../includes/templates/footer.php';
?>