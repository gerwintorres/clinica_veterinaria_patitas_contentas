<?php
    $pagina_actual = '';
    $titulo = 'Clientes';
    $ruta_boton_atras = '../menu_admin.php';
    $texto_card = 'añadir nuevo <br> cliente';
    $texto_tabla = 'Lista de clientes';
    $ruta_card = 'anadir_cliente.php';
    include '../../includes/templates/pagina_card.php';
?>
<article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>Número de documento</th>
                    <th>Tipo de documento</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Ver perfil</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Número de documento</td>
                    <td>Tipo de documento</td>
                    <td>Nombre</td>
                    <td>Apellidos</td>
                    <td><button class="edit">VER PERFIL</button></td>
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