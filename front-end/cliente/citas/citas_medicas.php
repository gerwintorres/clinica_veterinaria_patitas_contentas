<?php
    $pagina_actual = '';
    $titulo = 'Citas médicas';
    $ruta_boton_atras = '../menu_cliente.php';
    $texto_card = 'agendar nuevo <br> procedimiento';
    $texto_tabla = 'Citas agendadas';
    include '../../includes/templates/pagina_card.php';
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
                    <th>Médico/Colab.</th>
                    <th>Procedimiento</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nombre mascota</td>
                    <td>Tipo de mascota</td>
                    <td>Fecha</td>
                    <td>Hora</td>
                    <td>Médico/Colab.</td>
                    <td>Procedimiento</td>
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
