<?php
    $pagina_actual = '';
    $titulo = 'Guardería';
    $ruta_boton_atras = '../menu_cliente.php';
    $texto_card = 'agendar mascota';
    $texto_tabla = 'Estancias agendadas';
    $ruta_card = 'agendar_mascota.php';
    include '../../includes/templates/pagina_card.php';;
?>
    <article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo de mascota</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Peso(Kg)</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nombre mascota</td>
                    <td>Tipo de mascota</td>
                    <td>Fecha</td>
                    <td>Hora</td>
                    <td>Peso(Kg)</td>
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
