<?php   

function enviarCorreo($email){
    $data = array(
        'email' => $email
    );

    $url = curl_init("http://127.0.0.1:8000/password-recovery"); 
    
    curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($url, CURLOPT_POST, true);
    curl_setopt($url, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($url);
    $http_code = curl_getinfo($url, CURLINFO_HTTP_CODE);
    curl_close($url);

    if ($http_code == 200) {
        $response = json_decode($response, true);
        echo '<script>
            window.location.href = "restablecer_clave2.php";
            alert("Se ha enviado un código de verificación a tu correo electrónico.");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Correo invalido");</script>';
    }
}

function enviarCodigo($codigo, $clave, $user) {
    $data = array(
        'token' => $codigo,
        'new_password' => $clave
    );

    if ($user === 'cliente') {
        $url = "http://127.0.0.1:8000/cliente/password-reset";
    } elseif ($user === 'medico') {
        $url = "http://127.0.0.1:8000/medico/password-reset";
    } elseif ($user === 'admin') {
        $url = "http://127.0.0.1:8000/admin/password-reset";
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        echo '<script>
            alert("Tu contraseña ha sido restablecida con éxito. Inicia sesión con tu nueva contraseña.");
            window.location.href = "iniciar_sesion.php";
        </script>';
    } else {
        echo '<script>alert("Token inválido");</script>';
    }
}
?>