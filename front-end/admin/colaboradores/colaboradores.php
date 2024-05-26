<?php
    $pagina_actual = '';
    $titulo = 'Colaboradores';
    $ruta_boton_atras = '../menu_admin.php';
    $texto_card = 'añadir nuevo <br> colaborador';
    $texto_tabla = 'Lista de colaboradores';
    include '../../includes/templates/pagina_card.php';
?>
    <article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre completo</th>
                    <th>Télefono</th>
                    <th>Email</th>
                    <th>Labor</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>Nombre completo</td>
                    <td>Télefono</td>
                    <td>Email</td>
                    <td>Labor</td>
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