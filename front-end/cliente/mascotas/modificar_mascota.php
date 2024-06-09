<?php
    $pagina_actual = '';
    include '../../includes/templates/header.php';
    require '../../config/funciones_mascotas.php';

    if (isset($_SESSION['id_cliente'])) {
        $id_cliente = $_SESSION['id_cliente'];
        $mascotas = obtenerMascotas($id_cliente);
    }

    $id_mascota = intval($_GET['id_mascota']);

    foreach ($mascotas as $mascota) {
        if ($mascota['id_mascota'] === $id_mascota) {
            $nombre = $mascota['nombre'];
            $tipoMascota = $mascota['tipo_mascota'];
            $raza = $mascota['raza'];
            $edad = $mascota['edad'];
            $peso = $mascota['peso'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $tipoMascota = $_POST['tipoMascota'];
        $raza = $_POST['raza'];
        $edad = $_POST['edad'];
        $peso = $_POST['peso'];
        actualizarMascota($id_mascota,$nombre, $tipoMascota, $raza, $edad, $peso);
    }
?>

<div class="contenedor contenedor-boton-atras">
    <a href="mis_mascotas.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Modificar mascota</h1>

<main class="contenedor formulario-general">
    <div class="form-imagen-mascota"></div>
    <div class="form-contenido">
        <form action="" method="POST">
            <h3 class="titulo-formulario">Clínica Veterinaria Patitas Contentas requiere la siguiente información</h3>
            <div class="formulario-datos">
                <div>
                    <label for="nombre">Nombre de la mascota</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre?>" required class="inputs">
                </div>
                <div>
                    <label for="tipoMascota">Tipo de mascota</label>
                    <select name="tipoMascota" id="tipoMascota"  required class="inputs">
                        <option value="<?php echo $tipoMascota?>" selected><?php echo $tipoMascota?></option>
                        <option value="Canino">Canino</option>
                        <option value="Felino">Felino</option>
                        <option value="Ave">Ave</option>
                        <option value="Roedor">Roedor (hamster, cobaya, conejillo de indias)</option>
                        <option value="Conejo">Conejo</option>
                    </select>
                </div>
                <div>
                    <label for="raza">Raza</label>
                    <input type="text" id="raza" name="raza" value="<?php echo $raza?>" required class="inputs">
                </div>
            </div>
            <div class="formulario-datos">
                <div>
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" name="edad" value="<?php echo $edad?>" required class="inputs">
                </div>
                <div>
                    <label for="peso">Peso (kg)</label>
                    <input type="number" id="peso" name="peso" value="<?php echo $peso?>" required class="inputs">
                </div>
            </div>
            <div class="form-botones">
                <input class="boton-formulario-azul margen-superior" type="submit" value="MODIFICAR MASCOTA">
                <a href="mis_mascotas.php" class="boton-formulario-blanco margen-superior">CANCELAR</a>
            </div>
        </form>
    </div>
</main>

<?php
    include '../../includes/templates/footer.php';
?>