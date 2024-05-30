<?php
    $pagina_actual = '';
    include '../../includes/templates/header.php';
?>

<div class="contenedor contenedor-boton-atras">
    <a href="proveedores.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>
 
<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Añadir proveedor</h1>

<main class="contenedor formulario-general">
    <div class="form-imagen-proveedor"></div>
    <div class="form-contenido">
        <form action="">
            <h3 class="titulo-formulario">Clínica Veterinaria Patitas Contentas requiere la siguiente información</h3>
            <div class="formulario-datos">
                <div>
                    <label for="nombre">Nombre del proveedor</label>
                    <input type="text" id="nombre" name="nombre" required class="inputs">
                </div>
                <div>
                    <label for="ubicacion">Ubicación</label>
                    <input type="text" id="ubicacion" name="ubicacion" required class="inputs">
                </div>
                <div>
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" required class="inputs">
                </div>
            </div>
            <div class="formulario-datos">
                <div>
                    <label for="telefono">Teléfono</label>
                    <input type="number" id="telefono" name="telefono" required class="inputs">
                </div>
            </div>
            <div class="contenido-centrado">
                <input class="boton-formulario-azul margen-superior" type="submit" value="AÑADIR PROVEEDOR">
            </div>
        </form>
    </div>
</main>

<?php
    include '../../includes/templates/footer.php';
?>