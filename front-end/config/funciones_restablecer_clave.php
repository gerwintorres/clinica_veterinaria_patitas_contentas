<?php   
require_once 'funciones_alertas.php';

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
        $_SESSION['correo'] = true;
        echo '<script> window.location.href = "restablecer_clave2.php";</script>';
    } else {
        // Maneja el error
        alertaErrorGeneral('Error al enviar el código, correo inválido');
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
        $_SESSION['codigo'] = true;
        echo '<script> window.location.href = "iniciar_sesion.php";</script>';
    } else {
        alertaErrorGeneral('Código inválido');
    }
}
?>