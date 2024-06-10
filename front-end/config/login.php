<?php 
require_once 'funciones_alertas.php';

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
        $response_data = json_decode($response, true);
        
        $_SESSION['loggedin'] = true;

        if (isset($response_data['id_cliente']) && isset($response_data['nombres'])) {
            $_SESSION['id_cliente'] = $response_data['id_cliente'];
            $_SESSION['nombres'] = $response_data['nombres'];
            $_SESSION['usuario'] = 'cliente';
        }
        elseif(isset($response_data['id_medico']) && isset($response_data['nombres'])) {
            $_SESSION['id_medico'] = $response_data['id_medico'];
            $_SESSION['nombres'] = $response_data['nombres'];
            $_SESSION['usuario'] = 'medico';
        }
        else{
            $_SESSION['nombres'] = 'Administrador';
            $_SESSION['usuario'] = 'admin';
        }
        $_SESSION['exito'] = true;
        header("Location: ../../../$usuario/menu_$usuario.php");
    } else {
        alertaError();
    }
}
?>