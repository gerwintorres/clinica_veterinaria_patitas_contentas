<?php   

function enviarCorreo($email){
    $data = array(
        'email' => $email
    );

    $ch = curl_init("http://127.0.0.1:8000/ruta_para_enviar_el_correo/$email");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 201) {
        echo '<script>
            window.location.href = ../restablecer_clave2.php";
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Correo invalido");</script>';
    }
}

function enviarCodigo($email, $codigo){
    $data = array(
        'email' => $email,
        'codigo' => $codigo
    );

    $ch = curl_init("http://127.0.0.1:8000/ruta_para_enviar_el_codigo/$email");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 201) {
        echo '<script>
            window.location.href = ../restablecer_clave3.php";
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Correo invalido");</script>';
    }
}

function cambiarClave($email, $clave){
    $data = array(
        'clave' => $clave
    );

    $ch = curl_init("http://127.0.0.1:8000/ruta_para_enviar_la_nueva_clave/$email");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 201) {
        unset($_SESSION['correo']);
        echo '<script>
            window.location.href = ../iniciar_sesion.php";
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Correo invalido");</script>';
    }  
}
?>