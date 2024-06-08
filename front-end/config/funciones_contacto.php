<?php 

function enviarDatos($nombres, $apellidos, $email, $telefono, $mensaje){
    $data = array(
        'nombres' => $nombres,
        'apellidos' => $apellidos,
        'email' => $email,
        'numero_contacto' => $telefono,
        'mensaje' => $mensaje
    );

    $ch = curl_init('http://127.0.0.1:8000/contacto');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $result = json_decode($response, true);
        echo '<script>
            window.location.href = "contactanos.php";
            alert("Mensaje enviado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error al enviar el mensaje");</script>';
    }
}
?>