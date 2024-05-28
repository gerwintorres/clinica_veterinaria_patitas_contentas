<?php
    $pagina_actual = '';
    $titulo = 'Procedimientos';
    $ruta_boton_atras = '../menu_admin.php';
    $texto_card = 'añadir nuevo <br> procedimiento';
    $texto_tabla = 'Lista de procedimientos';
    include '../../includes/templates/pagina_card.php';;
?>
<article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de procedimiento</th>
                    <th>Precio (COP)</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>Nombre de procedimiento</td>
                    <td>Precio (COP)</td>
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