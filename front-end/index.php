<?php	
    $pagina_actual = 'inicio';
    include './includes/templates/header.php';  
?>

    <div class="contenedor seccion contenido-eslogan">
        <div class="eslogan">
            <h1>Tu compañero de confianza en el cuidado veterinario</h1>
            <p>En Clínica Veterinaria Patitas Contentas, estamos listos para atender cualquier emergencia veterinaria que pueda surgir. Tu mascota siempre es nuestra prioridad.</p>
            <a href="contactanos.html" class="boton-azul">Contáctanos Ya!</a>        
        </div>
        <div class="eslogan_img">
        </div>
    </div> 
    
    <div class="contenedor contenedor-chatbot">
        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="90" height="90" fill="url(#pattern0_159_2710)"/>
            <defs>
            <pattern id="pattern0_159_2710" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_159_2710" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_159_2710" width="90" height="90" xlink:href="data:image/png;base64,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"/>
            </defs>
        </svg>
        <button class="boton-chatbot">Chatea con nosotros</button>   
    </div>

    <main class="contenedor seccion seccion-principal">
        <h2>¿Por qué elegir Patitas Contentas para el cuidado de tu mascota?</h2>
        <div class="seccion">
            <div class="seccion_img">
                <img src="./build/img/imagen_eligenos.webp" alt="">
            </div>
            <p>En Patitas Contentas, entendemos que tu mascota es más que un simple animal; es un miembro querido de tu familia. Es por eso que nos comprometemos a ofrecer un cuidado excepcional que va más allá de lo convencional. Aquí hay algunas razones por las cuales miles de familias confían en nosotros con la salud y el bienestar de sus compañeros peludos: <br><br>
                <span>Equipo experto:</span> Veterinarios y personal altamente calificados. <br>
                <span>Instalaciones modernas:</span> Equipadas con tecnología avanzada. <br>
                <span>Enfoque personalizado:</span> Tratamiento adaptado a las necesidades individuales de tu mascota. <br>
                <span>Compasión:</span> Cuidado cálido y comprensivo. <br>
                <span>Compromiso con la excelencia:</span> Siempre buscamos proporcionar la mejor atención posible. <br><br>
                <span>Confía en nosotros para cuidar de tu mascota como si fuera nuestra propia familia. ¡Bienvenido a Patitas Contentas!</span></p>
        </div>
    </main>

    <article class="testimoniales contenedor">
        <h2 class="testimoniales-titulo">¿Que piensan nuestros clientes?</h2>
        <div class="testimoniales-contenedor-cards">
            <div class="testimoniales-card">
                <img src="./build/img/Avatar Testimonial 1.png" alt="">
                <p>"¡Increíble atención en Patitas Contentas! El equipo fue tan cariñoso y profesional con mi mascota. ¡Realmente se preocupan por el bienestar de los animales! Recomiendo encarecidamente esta clínica a todos los amantes de los animales"</p>
                <strong>Andrés Giraldo</strong>
            </div>
            <div class="testimoniales-card">
                <img src="./build/img/Avatar Testimonial 2.png" alt="">
                <p>"La experiencia en Patitas Contentas fue excepcional. Desde el primer momento, sentí que mi mascota estaba en buenas manos. El trato cálido y la atención experta hicieron que mi visita fuera reconfortante. Definitivamente volveré y recomendaré esta clínica a mis amigos y familiares".</p>
                <strong>Camilo Martinez</strong>
            </div>
        </div>
    </article>

    <article class="estadisticas contenedor">
        <section class="estadisticas-informacion">
            <div>
                <h3 class="estadistica-numero">+1,500</h3>
                <p>Mascotas atendidas</p>
            </div>
            <div>
                <h3 class="estadistica-numero">+4</h3>
                <p>Años de experiencia</p>
            </div>
            <div>
                <h3 class="estadistica-numero">+500</h3>
                <p>Cirugías realizadas</p>
            </div>
            <div>
                <h3 class="estadistica-numero">+1000</h3>
                <p>Clientes satisfechos</p>
            </div>
        </section>
        <section class="estadisticas-img">
            <img src="./build/img/img_estadisticas.webp" alt="">
        </section>
    </article>

<?php
    include './includes/templates/footer.php';
?>
    
    <script src="build/js/bundle.min.js"></script>
</body>
</html>