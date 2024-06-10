<?php
    $pagina_actual = '';
    require 'config/funciones_restablecer_clave.php';
    include 'includes/templates/header.php';

    $urlAnterior = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $urlCliente = "iniciar_sesion_cliente.php";
    $urlMedico = "iniciar_sesion_medico.php";
    $urlAdmin = "iniciar_sesion_admin.php"; 

    $parsedUrl = parse_url($urlAnterior, PHP_URL_PATH);
    $filename = basename($parsedUrl);

    if ($filename === $urlCliente){
        $_SESSION['user'] = 'cliente';
    } elseif($filename === $urlMedico){
        $_SESSION['user'] = 'medico';
    } elseif($filename === $urlAdmin){
        $_SESSION['user'] = 'admin';
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $correo = $_POST['email'];
        enviarCorreo($correo);
    }
?>

<div class="contenedor contenedor-boton-atras">
    <a href="./iniciar_sesion_cliente.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

<h1 class="titulo-h1-pagina">Restablecimiento de contraseña</h1>

<main class="contenedor formulario-restablecer">
    <div class="form-imagen-restablecer1"></div>
    <div class="form-contenido">
        <form action="" method="POST">
            <h3 class="titulo-formulario margen-superior">¿Olvidaste tu contraseña?</h3>
            <p class="texto-restablecer">No te preocupes, nos pasa a todos. Ingresa tu correo electrónico a continuación para recuperar tu contraseña.</p>
            
            <div class="formulario-datos-restablecer">
                <label for="email">Correo electrónico</label>
                <input class="inputs" type="text" id="email" name="email" required>
            </div>
            <div class="contenido-centrado ">
                <input class="boton-formulario-azul margen-superior margen-inferior" type="submit" value="ENVIAR CÓDIGO">
            </div>
        </form>
    </div>
</main>

<?php
    include 'includes/templates/footer.php';
?>