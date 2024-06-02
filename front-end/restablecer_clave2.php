<?php
    $pagina_actual = '';
    require 'config/funciones_restablecer_clave.php';
    include 'includes/templates/header.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $codigo = $_POST['codigo'];
        enviarCodigo($_SESSION['correo'], $codigo);
    }
?>

<div class="contenedor contenedor-boton-atras">
    <a href="restablecer_clave.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

<h1 class="titulo-h1-pagina">Restablecimiento de contraseña</h1>

<main class="contenedor formulario-restablecer">
    <div class="form-imagen-restablecer2"></div>
    <div class="form-contenido">
        <form action="" method="POST">
            <h3 class="titulo-formulario margen-superior">Verificar código</h3>
            <p class="texto-restablecer">Se ha enviado un código de autenticación a tu correo electrónico.</p>
            
            <div class="formulario-datos-restablecer">
                <label for="codigo">Introduce el código</label>
                <input class="inputs" type="text" id="codigo" name="codigo" required>
            </div>
            <p class="texto-restablecer">No has recibido tu código? <a href="">Reenviar</a></p>
            <div class="contenido-centrado ">
                <input class="boton-formulario-azul margen-superior margen-inferior" type="submit" value="ENVIAR CÓDIGO">
            </div>
        </form>
    </div>
</main>

<?php
    $pagina_actual = '';
    include 'includes/templates/footer.php';
?>