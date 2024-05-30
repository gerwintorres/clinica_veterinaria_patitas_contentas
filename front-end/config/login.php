<?php 

function login($email, $clave, $usuario) {
    $data = array(
        'email' => $email,
        'clave' => $clave
    );

    if($usuario == 'cliente'):
        $url = 'http://127.0.0.1:8000/login/client';
    elseif($usuario == 'admin'):
        $url = 'http://127.0.0.1:8000/login/admin';
    elseif($usuario == 'medico'):
        $url = 'http://127.0.0.1:8000/login/medico';
    endif;
    
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $result = json_decode($response, true);
        // Maneja la respuesta exitosa, por ejemplo, redirigir al usuario
        header("Location: ../../../$usuario/menu_$usuario.php");
    } else {
        // Maneja el error
        echo '<script>alert("Error en el inicio de sesión");</script>';
    }
}
?>