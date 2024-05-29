<?php
    $pagina_actual = '';
    include 'header.php';

    if($usuario == 'cliente'):
        $clase = 'fondo-inicio-sesion-cliente';
        $id = 'formulario-iniciar-sesion-cliente';
    elseif($usuario == 'administrador'):
        $clase = 'fondo-inicio-sesion-admin';
        $id = 'formulario-iniciar-sesion-admin';
    elseif($usuario == 'medico'):
        $clase = 'fondo-inicio-sesion-medico';
        $id = 'formulario-iniciar-sesion-medico';
    endif;
?>

<div class="contenedor contenedor-boton-atras">
    <a href="./iniciar_sesion.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

    
<h1 class="titulo-h1-pagina">Inicio de Sesión</h1>

<main class="formulario-iniciar-sesion contenedor-interior">
    <div class="formulario-iniciar-sesion-izq <?php echo $clase?>">
        <h4>Clínica Veterinaria Patitas Contentas</h4>
        <p><?php echo $texto?></p>
        <img src="./build/img/patitas.webp" alt="">
    </div>
    <form action="" method="" class="formulario-iniciar-sesion-der" id="<?php echo $id?>">
        <img src="./build/img/logo.webp" alt="">
        <div>
            <label for="email">Email</label>
            <input class="inputs" type="text" id="email" name="email" required>
        </div>
        <div class="ultimo-elemento">
            <label for="clave">Contraseña</label>
            <input class="inputs" type="password" id="clave" name="clave" required>
        </div>
        <div class="contenedor-olvido-contrasena">
            <a href="" class="olvidar-clave">Olvidé mi contraseña</a>
        </div>
        <input class="boton-formulario-azul" type="submit" value="Iniciar Sesión">
        <?php if($usuario == 'cliente'): ?>
            <p>ó</p>
            <a class="boton-formulario-blanco" href="">Registrarse</a>
        <?php endif; ?>
    </form>
    <div>
        
    </div>
</main>

<?php
    include 'footer.php';
?>