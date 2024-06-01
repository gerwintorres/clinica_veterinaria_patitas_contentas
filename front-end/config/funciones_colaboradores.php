<?php   

function registrarColaborador($nombres, $apellidos, $tipo_documento, $id_colaborador, $labor, $telefono){
    $data = array(
        'id_colaborador' => $id_colaborador,
        'nombres' => $nombres,
        'apellidos' => $apellidos,
        'tipo_documento' => $tipo_documento,
        'labor' => $labor,
        'telefono' => $telefono
    );
    $ch = curl_init('http://127.0.0.1:8000/register/colaborador');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 201) {
        $result = json_decode($response, true);
        echo '<script>
            window.location.href = "../mascotas/mis_mascotas.php";
            alert("Registrado con éxito");
        </script>';
    } else {
        // Maneja el error
        echo '<script>alert("Error en el registro");</script>';
    }
    
}

?>