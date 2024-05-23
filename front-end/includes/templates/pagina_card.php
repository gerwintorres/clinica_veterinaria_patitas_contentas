<?php
    $pagina_actual = '';
    include 'header.php';
?>

<a href="<?php echo $ruta_boton_atras?>" class="boton-atras contenedor"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
</svg>Ir atrás</a>
    
<h1 class="contenedor titulo-h1-pagina alineacion-izquierda"><?php echo $titulo?></h1>

<main class="contenedor main-inicio-sesion">
    <a class="card" href=""> <?php echo $texto_card?>
    <svg width="90" height="62" viewBox="0 0 90 62" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <rect y="0.523987" width="90" height="61.107" fill="url(#pattern0_41_4619)"/>
        <defs>
        <pattern id="pattern0_41_4619" patternContentUnits="objectBoundingBox" width="1" height="1">
        <use xlink:href="#image0_41_4619" transform="matrix(0.00754408 0 0 0.0111111 0.160517 0)"/>
        </pattern>
        <image id="image0_41_4619" width="90" height="90" xlink:href="data:image/png;base64,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"/>
        </defs>
    </svg>

    </a>
</main>

<h3 class="contenedor titulo-h3-pagina alineacion-izquierda"><?php echo $texto_tabla?></h3>
<?php
    include 'footer.php';
?>