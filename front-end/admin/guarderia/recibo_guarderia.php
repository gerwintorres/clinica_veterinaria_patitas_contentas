<?php
    $pagina_actual = '';
    include '../../includes/templates/header.php';
    require '../../config/funciones_guarderia.php';

    if(isset($_SESSION['loggedin']) && $_SESSION['usuario'] = 'admin'){
        $factura = obtenerFactura($_SESSION['id_cobro']);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['irc'])){
        $id_registro = $_GET['irc'];
        $hora = date("H:i:s");
        $fecha = date("Y-m-d");
        realizarCheckOut($id_registro, $hora, $fecha);
    }
?>

<div class="contenedor contenedor-boton-atras">
    <a href="programacion_guarderia.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Recibo de pago guardería</h1>

<div class="imagen-formularios-cerrados contenedor">
        <img src="../../build/img/logo.webp" alt="Logotipo Patitas Contentas">
        <div class="titulo">
            <span>Clínica Veterinaria</span>
            <span class="segunda_parte">Patitas Contentas</span>
        </div>
</div>

<main class="formulario-cerrado contenedor margen-superior recibo-guarderia">
    <div class="form-grupo-cerrado-2">
        <div>
            <label for="nombreMascota">Nombre de la mascota</label>
            <input type="text" class="input-cerrado" id="nombreMascota" name="nombreMascota" value="<?php echo $factura['nombre_mascota']?>" disabled>
        </div>
        <div>
            <label for="nombreDueno">Nombre del dueño</label>
            <input type="text" class="input-cerrado" id="nombreDueno" name="nombreDueno" value="<?php echo $factura['nombre_duenio']?>" disabled>
        </div>
        <div>
            <label for="direccion">Dirección</label>
            <input type="text" class="input-cerrado input-width" id="direccion" name="direccion" value="<?php echo $factura['direccion']?>"  disabled>
        </div>
    </div>
    <div class="form-grupo-cerrado">
        <div>
            <label for="telefono">Teléfono</label>
            <input type="number" class="input-cerrado" id="telefono" name="telefono" value="<?php echo $factura['telefono']?>" disabled>
        </div>
        <div>
            <label for="raza">Raza</label>
            <input type="text" class="input-cerrado" id="raza" name="raza" value="<?php echo $factura['raza']?>" disabled>
        </div>
        <div>
            <label for="peso">Peso (Kg)</label>
            <input type="number" class="input-cerrado" id="peso" name="peso" value="<?php echo $factura['peso']?>" disabled>
        </div>
        <div>
            <label for="edad">Edad</label>
            <input type="number" class="input-cerrado" id="edad" name="edad" value="<?php echo $factura['edad']?>" disabled>
        </div>
    </div>
    <div class="form-grupo-cerrado">
        <div>
            <label for="telefono">Fecha de ingreso</label>
            <input type="date" class="input-cerrado" id="telefono" value="<?php echo $factura['fecha_entrada']?>" name="telefono" disabled>
        </div>
        <div>
            <label for="raza">Hora de ingreso</label>
            <input type="time" class="input-cerrado" id="raza" name="raza" value="<?php echo $factura['hora_entrada']?>" disabled>
        </div>
        <div>
            <label for="peso">Fecha de salida</label>
            <input type="date" class="input-cerrado" id="peso" name="peso" value="<?php echo $factura['fecha_salida']?>" disabled>
        </div>
        <div>
            <label for="edad">Hora de salida</label>
            <input type="time" class="input-cerrado" id="edad" name="edad" value="<?php echo $factura['hora_salida']?>" disabled>
        </div>
    </div>
    <div class="contenido-centrado total-pago">
        <div>
            <label class="contenido-centrado" for="total"><strong>TOTAL A PAGAR</strong></label>
            <input type="text" class="input-cerrado" id="total" name="total" value="<?php echo $factura['total_a_pagar'] . ' COP'?>" disabled>
        </div>
    </div>
</main>
<?php
    include '../../includes/templates/footer.php';
?>