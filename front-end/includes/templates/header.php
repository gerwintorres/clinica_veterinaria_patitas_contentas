<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['nombres']) && isset($_SESSION['usuario'])) {
        $nombres = $_SESSION['nombres'];
        $usuario = $_SESSION['usuario'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Veterinaria Patitas Contentas</title>
    <link rel="stylesheet" href="../../build/css/app.css">
    <link rel="icon" href="../../build/img/logo.webp" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../../node_modules/sweetalert2/dist/sweetalert2.min.css">
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
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <a href="../../<?php echo $usuario?>/menu_<?php echo $usuario?>.php" class="boton-blanco boton-perfil"> 
                            <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect width="30" height="30" fill="url(#pattern0_150_2070)"/>
                                <defs>
                                <pattern id="pattern0_150_2070" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_150_2070" transform="scale(0.0111111)"/>
                                </pattern>
                                <image id="image0_150_2070" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEJElEQVR4nO2cy4sdVRCHS0fFuFCImjtdp8ebubeqI7MQISKKSkQ0KOiyb1VPIgpRA8nCP8EsRcEoPghBV2r+AcGNK/ERiY+IGhNiBHcBE01EiO+JnO5xMBqHzPV2n54+9cFvMzNwqY8zh9N16jaAYRiGYRiGYRiGsXKGaU4Z6k5yso+dfEKo3xHKr2WcnCx/5mQfYbGDZmQ4xkfEyybYdAmloy3s5H12enaFeY9SmQfIp0LX0WqGqd7LKEfHEHxOyOkRSmRz6HpaR5LcfwU7ffn/Cv6XcJS9aZqvCV1fKxj0tq5jpx9PWvLfZH9I0/m1ELtkcnqkLsnnbCWxyk6q7aK2lXy+ld3vP3Q5xAbXsCdfgOw9EBOUyOamJf+VzMl9EMs5mSdwhBt/v5bDUZyzyenWUJKXgiOFrsOo+0OLJqfvQtd7Fxx6NVdZyHr5LHSVDHVnCyQvptgOXYXKLlxowYtBfQ26Cjk5GFzwUuQj6CpU9pBDC17Kt9BVCPWXFm0dP0NX4dBy/xHoKtwCuSbameiJQbZHNwPZqaMx0QdD78tRnKMZ9fXwgheD8ip0FcJiR3DBUfQ6ZmToO2fhJevChp6shy7D400gTTTk5B3oOpTKfGjRQ9QRdJ98qolZjmVyKIo7Qw8lek8o0ZnTuyAmCGVvANEvQWykab7GTw81JZlQPohyUsnj5+Gamb2Tw1lSXAMxQ1426oE6V3K0A47/sY3sqWNPjna7WA7G0d3+33wCgg9Fd7pYOfkUJ1r4aaIVPq4v+Ce+DEUAnrg4dBWriqyXz/rmj5/B8LPUvp/tLw/KODnhW53V74rtne9dGIZhGIZhGIZhRMNgkF81xOJWdvoooz5LqG+WHTjfTkU9zig/VdHjZV8Edb//G0bZnaXFI+RGt9DaLVeGrqN19Pv5dHVhK68QytcT69yhHiu/nZtoMbtOexAjjPM3ktOnGOWLupv+Sw0nlM8Y9cnM6Q3QZQZJfh05edy/nqchucu2UdnJroErGLpClhS3s9M3WjKhdJ7Wqr5FWDwAABfBamNuLr+MEtnGqJ+3QObZCwmhfsooD2/c+NilsBrwq4NRvwotjscNylFykrd2hXNa3Lx4KxJelpvICn97w4zeBK16LYSTXez099ByeOKRPwjlueDbib8+8u+aCy9E617dB/wLA4JIHjq5k1FPh5bATQXlFCdyR6OS/QeWj8Ghi3dNy9YzWTK6rRHJ1+ODV1c30C0o3DUfX/tcmq+tXTSjPBO6WA4uW59uQnSwF09xS0JOv2xAtJ4JXSiHF/1j7aLJyTehC+XQQT3WgGh9PnihLrRo2V27aE5zxyjfR7yaTw9RZqC5L/vIDxGu5FONjwNXk57yYtXt0t+CS3D1pKyt6ui9sH56vt+oZMMwDMMwDMMwDMMwDGgnfwLR/QQKwny7BQAAAABJRU5ErkJggg=="/>
                                </defs>
                            </svg>
                            <?php echo $nombres?></a>
                        <a href="../../config/logout.php" class="boton-rojo">Cerrar Sesión</a>
                    <?php else: ?>
                        <a href="../../iniciar_sesion.php" class="boton-blanco">Iniciar Sesión</a>
                        <a href="../../registrarse.php" class="boton-azul">Registrarse</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>