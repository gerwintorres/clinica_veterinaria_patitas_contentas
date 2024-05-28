<?php
    $pagina_actual = '';
    $titulo = 'Mis mascotas';
    $ruta_boton_atras = '../menu_cliente.php';
    $texto_card = 'añadir nueva <br> mascota';
    $texto_tabla = 'Mascotas';
    $ruta_card = 'anadir_mascota.php';
    include '../../includes/templates/pagina_card.php';
?>
    <article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo de mascota</th>
                    <th>Raza</th>
                    <th>Edad</th>
                    <th>Peso (kg)</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nombre mascota</td>
                    <td>Tipo de mascota</td>
                    <td>Raza mascota</td>
                    <td>Edad mascota</td>
                    <td>Peso mascota</td>
                    <td><button class="edit">EDITAR</button></td>
                    <td><button class="delete">ELIMINAR</button></td>
                </tr>
                <!-- Repite las filas según sea necesario -->
            </tbody>
        </table>
    </article>
<?php
    $pagina_actual = '';
    include '../../includes/templates/footer.php';
?>
