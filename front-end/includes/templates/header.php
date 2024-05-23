<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Veterinaria Patitas Contentas</title>
    <link rel="stylesheet" href="../../build/css/app.css">
    <link rel="icon" href="../../build/img/logo.webp" type="image/png">
</head>
<body>
    <header class="header">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="../../index.php" class="lado-izq">
                    <img src="../../build/img/logo.webp" alt="Logotipo Patitas Contentas">
                    <div class="titulo">
                        <span>Clínica Veterinaria</span>
                        <span class="segunda_parte">Patitas Contentas</span>
                    </div>
                </a>
                <nav class="navegacion">
                    <a href="../../index.php" <?php if ($pagina_actual == 'inicio') echo 'class="activo"'; ?>>Inicio</a>
                    <a href="../../servicios.php" <?php if ($pagina_actual == 'servicios') echo 'class="activo"'; ?>>Servicios</a>
                    <a href="../../nosotros.php" <?php if ($pagina_actual == 'nosotros') echo 'class="activo"'; ?>>Nosotros</a>
                    <a href="../../blog.php" <?php if ($pagina_actual == 'blog') echo 'class="activo"'; ?>>Blog</a>
                    <a href="../../contactanos.php" <?php if ($pagina_actual == 'contactanos') echo 'class="activo"'; ?>>Contáctanos</a>
                    <a href="../../iniciar_sesion.php" class="boton-blanco">Iniciar Sesión</a>
                    <a href="../../registrarse.php" class="boton-azul">Registrarse</a>
                </nav>
            </div>
        </div>
    </header>