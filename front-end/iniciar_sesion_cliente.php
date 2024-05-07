<?php
    $pagina_actual = '';
    include 'includes/templates/header.php';
?>

<a href="./iniciar_sesion.php" class="boton-atras contenedor"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
</svg>Ir atrás</a>
    
<h1 class="titulo-h1-pagina">Inicio de Sesión</h1>

<main class="formulario-iniciar-sesion contenedor-interior">
    <div class="formulario-iniciar-sesion-izq fondo-inicio-sesion-cliente">
        <h4>Clínica Veterinaria Patitas Contentas</h4>
        <p>¡Bienvenido de nuevo! Por favor, inicia sesión para acceder a nuestros servicios veterinarios. Gracias por confiar en nosotros para el cuidado de tu mascota.</p>
        <img src="./build/img/patitas.webp" alt="">
    </div>
    <form action="" class="formulario-iniciar-sesion-der" id="formulario-iniciar-sesion-der">
        <img src="./build/img/logo.webp" alt="">
        <div>
            <label for="email">Email</label>
            <input class="inputs" type="text" id="email" name="email" required>
        </div>
        <div class="ultimo-elemento">
            <label for="clave">Contraseña</label>
            <input class="inputs" type="password" id="clave" name="clave" required>
        </div>
        <a href="" class="olvidar-clave">Olvidé mi contraseña</a>
        <input class="boton-formulario-azul" type="submit" value="Iniciar Sesión">
        <p>ó</p>
        <a class="boton-formulario-blanco" href="">Registrarse</a>
    </form>
    <div>
        
    </div>
</main>

<script>
    document.getElementById('formulario-iniciar-sesion-der').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada

        // Obtener los valores del formulario
        var email = document.getElementById('email').value;
        var clave = document.getElementById('clave').value;

        // Crear un objeto con los datos del formulario
        var formData = {
            email: email,
            clave: clave
        };

        // Realizar la solicitud POST a la API FastAPI
        fetch('http://127.0.0.1:8000/login/client', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            // Manejar la respuesta de la API
            if (response.ok) {
                // Si la respuesta es exitosa, redirigir al usuario a la página de inicio
                alert('FUNCIONO EL MIERDERO');
            } else {
                alert('NO FUNCIONO EL MIERDERO');
                // Si la respuesta es un error, manejarlo (mostrar mensaje de error, etc.)
            }
        })
        .catch(error => {
            console.log(error);
        });
    });
</script>


<?php
    include 'includes/templates/footer.php';
?>