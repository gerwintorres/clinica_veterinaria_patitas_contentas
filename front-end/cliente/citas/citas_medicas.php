<?php
    $pagina_actual = '';
    $titulo = 'Citas médicas';
    $ruta_boton_atras = '../menu_cliente.php';
    $texto_card = 'agendar nuevo <br> procedimiento';
    $texto_tabla = 'Citas agendadas';
    $ruta_card = 'agendar_cita.php';
    include '../../includes/templates/pagina_card.php';
?>
    <article class="contenedor contenedor-table">
        <div class="search-container">
            <input type="text" id="search" placeholder="Buscar">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.5 17.5L13.875 13.875M15.8333 9.16667C15.8333 12.8486 12.8486 15.8333 9.16667 15.8333C5.48477 15.8333 2.5 12.8486 2.5 9.16667C2.5 5.48477 5.48477 2.5 9.16667 2.5C12.8486 2.5 15.8333 5.48477 15.8333 9.16667Z" stroke="black" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
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
