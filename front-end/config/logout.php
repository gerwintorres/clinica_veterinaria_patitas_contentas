<?php
    session_start(); // Iniciar la sesión
    session_unset(); // Destruir todas las variables de sesión
    session_destroy(); // Destruir la sesión
    header("Location: ../../index.php"); 
    exit();
?>