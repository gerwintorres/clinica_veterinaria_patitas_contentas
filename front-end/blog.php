<?php
    $pagina_actual = 'blog';
    include 'includes/templates/header.php';
?>
<h1 class="contenedor titulo-h1-pagina">Nuestro Blog</h1>
<main class="contenedor">
    <p>¡Bienvenido a nuestro blog! Sumérgete en el apasionante mundo de la salud y el bienestar animal con nuestras publicaciones informativas y entretenidas. Descubre consejos útiles, historias conmovedoras, noticias de actualidad y mucho más. En nuestro blog, nos esforzamos por compartir contenido relevante y útil que te ayudará a cuidar mejor a tu mascota y fortalecer vuestro vínculo. ¡Explora nuestro blog y únete a nuestra comunidad de amantes de los animales!</p>
</main>

<article class="contenedor blog-articles">
    <section>
        <div>
            <img src="./build/img/blog1.webp" alt="">
            <h5>Cuidado e Higiene</h5>
            <p><strong>Consejos de cuidado diario:</strong> la higiene, alimentación, ejercicio y cuidados generales para mantener a las mascotas saludables.
            </p>
        </div>
        <div>
            <a href="./blog_item1.php">Leer más</a>
            <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.96028 6.14231C7.17996 6.36198 7.17996 6.71808 6.96028 6.93776L1.22541 12.6726C1.00573 12.8923 0.649631 12.8923 0.429956 12.6726L0.164756 12.4074C-0.0549187 12.1878 -0.0549187 11.8316 0.164756 11.612L5.23671 6.54003L0.164756 1.46808C-0.0549186 1.24841 -0.0549186 0.892306 0.164756 0.672632L0.429956 0.407433C0.649631 0.187757 1.00573 0.187758 1.22541 0.407433L6.96028 6.14231Z" fill="#231F57"/>
            </svg>
        </div>
    </section>
    <section>
        <div>
            <img src="./build/img/blog2.webp" alt="">
            <h5>Enfermedades</h5>
            <p><strong>Cómo detectar signos de enfermedad en perros y gatos:</strong> Una guía detallada sobre los síntomas más comunes de enfermedades en perros y gatos.</p>
        </div>
        <div>
            <a href="./blog_item2.php">Leer más</a>
            <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.96028 6.14231C7.17996 6.36198 7.17996 6.71808 6.96028 6.93776L1.22541 12.6726C1.00573 12.8923 0.649631 12.8923 0.429956 12.6726L0.164756 12.4074C-0.0549187 12.1878 -0.0549187 11.8316 0.164756 11.612L5.23671 6.54003L0.164756 1.46808C-0.0549186 1.24841 -0.0549186 0.892306 0.164756 0.672632L0.429956 0.407433C0.649631 0.187757 1.00573 0.187758 1.22541 0.407433L6.96028 6.14231Z" fill="#231F57"/>
            </svg>
        </div>
    </section>
    <section>
        <div>
            <img src="./build/img/blog3.webp" alt="">
            <h5>Alimentación</h5>
            <p><strong>Dieta y nutrición para mascotas con alergias alimentarias:</strong> Información sobre cómo identificar y manejar las alergias alimentarias en perros y gatos.</p>
        </div>
        <div class="">
            <a href="./blog_item3.php">Leer más</a>
            <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.96028 6.14231C7.17996 6.36198 7.17996 6.71808 6.96028 6.93776L1.22541 12.6726C1.00573 12.8923 0.649631 12.8923 0.429956 12.6726L0.164756 12.4074C-0.0549187 12.1878 -0.0549187 11.8316 0.164756 11.612L5.23671 6.54003L0.164756 1.46808C-0.0549186 1.24841 -0.0549186 0.892306 0.164756 0.672632L0.429956 0.407433C0.649631 0.187757 1.00573 0.187758 1.22541 0.407433L6.96028 6.14231Z" fill="#231F57"/>
            </svg>
        </div>
    </section>
</article>
<?php
    include 'includes/templates/footer.php';
?>