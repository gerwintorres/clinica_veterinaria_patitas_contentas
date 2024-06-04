<?php	
    $pagina_actual = 'inicio';
    include './includes/templates/header.php';  
?>

    <div class="contenedor seccion contenido-eslogan">
        <div class="eslogan">
            <h1>Tu compañero de confianza en el cuidado veterinario</h1>
            <p>En Clínica Veterinaria Patitas Contentas, estamos listos para atender cualquier emergencia veterinaria que pueda surgir. Tu mascota siempre es nuestra prioridad.</p>
            <a href="contactanos.php" class="boton-azul">Contáctanos Ya!</a>        
        </div>
        <div class="eslogan_img">
            <img src="./build/img/imagenPrincipal.webp" alt="">
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
        <button class="boton-chatbot boton-abrir" onclick="openChat()">Chatea con nosotros</button>
        <div class="chat-container" id="chat-container">
            <div class="chat-header">
                <div class="chat-header-izq">
                    <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M35.1562 19.9336V15.75C35.1562 15.0041 34.8599 14.2887 34.3325 13.7613C33.805 13.2338 33.0897 12.9375 32.3438 12.9375H23.9062V11.0925C24.3352 10.7072 24.6094 10.1531 24.6094 9.53155C24.6094 8.97211 24.3871 8.43559 23.9916 8.04C23.596 7.64442 23.0594 7.42218 22.5 7.42218C21.9406 7.42218 21.404 7.64442 21.0084 8.04C20.6129 8.43559 20.3906 8.97211 20.3906 9.53155C20.3906 10.1531 20.6648 10.7072 21.0938 11.0925V12.9375H12.6563C11.9103 12.9375 11.195 13.2338 10.6675 13.7613C10.1401 14.2887 9.84375 15.0041 9.84375 15.75V19.9659L9.7425 19.973C9.38797 19.9982 9.05619 20.1569 8.81402 20.4171C8.57186 20.6773 8.43731 21.0196 8.4375 21.375V24.1875C8.4375 24.5605 8.58566 24.9181 8.84938 25.1819C9.1131 25.4456 9.47079 25.5937 9.84375 25.5937V32.625C9.84375 33.3709 10.1401 34.0863 10.6675 34.6137C11.195 35.1412 11.9103 35.4375 12.6563 35.4375H32.3438C33.0897 35.4375 33.805 35.1412 34.3325 34.6137C34.8599 34.0863 35.1562 33.3709 35.1562 32.625V25.5937C35.5292 25.5937 35.8869 25.4456 36.1506 25.1819C36.4143 24.9181 36.5625 24.5605 36.5625 24.1875V21.4622C36.5788 21.2439 36.5441 21.0249 36.4612 20.8223C36.1772 20.1361 35.5683 19.9716 35.1562 19.9336ZM15.4688 21.375C15.4688 19.8225 16.4138 18.5625 17.5781 18.5625C18.7425 18.5625 19.6875 19.8225 19.6875 21.375C19.6875 22.9275 18.7425 24.1875 17.5781 24.1875C16.4138 24.1875 15.4688 22.9275 15.4688 21.375ZM28.1222 29.8125C26.7145 29.8083 16.875 29.8125 16.875 29.8125V27C16.875 27 26.7202 26.9972 28.1278 27L28.1222 29.8125ZM27.4219 24.1875C26.2575 24.1875 25.3125 22.9275 25.3125 21.375C25.3125 19.8225 26.2575 18.5625 27.4219 18.5625C28.5863 18.5625 29.5312 19.8225 29.5312 21.375C29.5312 22.9275 28.5863 24.1875 27.4219 24.1875Z" fill="white"/>
                        <circle cx="22.5" cy="22.5" r="22" stroke="white"/>
                    </svg>
                    <div class="chat-title">
                        <span>ChatBot</span>
                        <span class="chat-status">● online</span>
                    </div>
                </div>
                <button class="close-button" onclick="closeChat()">Cerrar</button>
            </div>
            <div class="chat-box" id="chat-box">
                <div class="men">
                    <svg width="45" height="46" viewBox="0 0 45 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="22.5" cy="22.7659" r="22.5" fill="#EDEDED"/>
                        <path d="M34 20.6333V16.6667C34 15.9594 33.719 15.2811 33.2189 14.781C32.7188 14.2809 32.0405 14 31.3333 14H23.3333V12.2507C23.74 11.8853 24 11.36 24 10.7707C24 10.2402 23.7892 9.73152 23.4142 9.35645C23.0391 8.98137 22.5304 8.77066 22 8.77066C21.4695 8.77066 20.9608 8.98137 20.5857 9.35645C20.2107 9.73152 20 10.2402 20 10.7707C20 11.36 20.26 11.8853 20.6666 12.2507V14H12.6666C11.9594 14 11.2811 14.2809 10.781 14.781C10.2809 15.2811 9.99996 15.9594 9.99996 16.6667V20.664L9.90396 20.6707C9.56781 20.6946 9.25323 20.8451 9.02363 21.0918C8.79402 21.3384 8.66645 21.663 8.66663 22V24.6667C8.66663 25.0203 8.8071 25.3594 9.05715 25.6095C9.3072 25.8595 9.64634 26 9.99996 26V32.6667C9.99996 33.3739 10.2809 34.0522 10.781 34.5523C11.2811 35.0524 11.9594 35.3333 12.6666 35.3333H31.3333C32.0405 35.3333 32.7188 35.0524 33.2189 34.5523C33.719 34.0522 34 33.3739 34 32.6667V26C34.3536 26 34.6927 25.8595 34.9428 25.6095C35.1928 25.3594 35.3333 25.0203 35.3333 24.6667V22.0827C35.3487 21.8757 35.3159 21.668 35.2373 21.476C34.968 20.8253 34.3906 20.6693 34 20.6333ZM15.3333 22C15.3333 20.528 16.2293 19.3333 17.3333 19.3333C18.4373 19.3333 19.3333 20.528 19.3333 22C19.3333 23.472 18.4373 24.6667 17.3333 24.6667C16.2293 24.6667 15.3333 23.472 15.3333 22ZM27.3306 30C25.996 29.996 16.6666 30 16.6666 30V27.3333C16.6666 27.3333 26.0013 27.3307 27.336 27.3333L27.3306 30ZM26.6666 24.6667C25.5626 24.6667 24.6666 23.472 24.6666 22C24.6666 20.528 25.5626 19.3333 26.6666 19.3333C27.7706 19.3333 28.6666 20.528 28.6666 22C28.6666 23.472 27.7706 24.6667 26.6666 24.6667Z" fill="#DF662B"/>
                    </svg>               
                    <div class="message bot-message">
                        <span>Hola, ¿Cómo puedo ayudarte hoy?</span>
                    </div>
                </div>
                
            </div>
            <div class="question-buttons" id="question-buttons">
                <button onclick="selectQuestion('¿Qué servicios ofrece la Clínica Veterinaria Patitas Contentas?')">¿Qué servicios ofrece la Clínica Veterinaria Patitas Contentas?</button>
                <button onclick="selectQuestion('¿Cuál es el horario de atención?')">¿Cuál es el horario de atención?</button>
                <button onclick="selectQuestion('¿Dónde están ubicados?')">¿Dónde están ubicados?</button>
                <button onclick="selectQuestion('¿Puedo comprar alimentos y suplementos en la Clínica Veterinaria Patitas Contentas?')">¿Puedo comprar alimentos y suplementos en la Clínica Veterinaria Patitas Contentas?</button>
                <button onclick="selectQuestion('¿Cómo puedo agendar una cita para mi mascota?')">¿Cómo puedo agendar una cita para mi mascota?</button>
                <button onclick="selectQuestion('¿Qué hago en caso de una emergencia veterinaria?')">¿Qué hago en caso de una emergencia veterinaria?</button>
            </div>
        </div>
    </div>

    <main class="contenedor seccion seccion-principal">
        <h2>¿Por qué elegir Patitas Contentas para el cuidado de tu mascota?</h2>
        <div class="seccion">
            <div class="seccion_img">
                <img src="./build/img/imagen_eligenos.jpeg" alt="">
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
        <h2 class="testimoniales-titulo">¿Qué piensan nuestros clientes?</h2>
        <div class="testimoniales-contenedor-cards">
            <div class="testimoniales-card">
                <img src="./build/img/Avatar Testimonial 1.png" alt="">
                <p>"¡Increíble atención en Patitas Contentas! El equipo fue tan cariñoso y profesional con mi mascota. ¡Realmente se preocupan por el bienestar de los animales! Recomiendo encarecidamente esta clínica a todos los amantes de los animales"</p>
                <strong>Andrés Giraldo</strong>
            </div>
            <div class="testimoniales-card">
                <img src="./build/img/Avatar Testimonial 2.png" alt="">
                <p>"La experiencia en Patitas Contentas fue excepcional. Desde el primer momento, sentí que mi mascota estaba en buenas manos. El trato cálido y la atención experta hicieron que mi visita fuera reconfortante. Definitivamente volveré y recomendaré esta clínica a mis amigos y familiares".</p>
                <strong>Camilo Martínez</strong>
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
            <img src="./build/img/imagenPrincipalEstadisticas.webp" alt="">
        </section>
    </article>

<?php
    include './includes/templates/footer.php';
?>
</body>
</html>