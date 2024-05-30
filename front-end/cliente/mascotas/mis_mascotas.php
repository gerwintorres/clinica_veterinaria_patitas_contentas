<?php
    $pagina_actual = '';
    $titulo = 'Mis mascotas';
    $ruta_boton_atras = '../menu_cliente.php';
    $texto_card = 'añadir nueva <br> mascota';
    $texto_tabla = 'Mascotas';
    $ruta_card = 'anadir_mascota.php';
    require '../../config/obtener_mascotas.php';
    include '../../includes/templates/pagina_card.php';

    if (isset($_SESSION['id_cliente'])) {
        $id_cliente = $_SESSION['id_cliente'];
        $mascotas = obtenerMascotas($id_cliente);
    }
    
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
                <?php if (isset($mascotas) && is_array($mascotas)):?>
                    <?php foreach ($mascotas as $mascota): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($mascota['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($mascota['tipo_mascota']); ?></td>
                            <td><?php echo htmlspecialchars($mascota['raza']); ?></td>
                            <td><?php echo htmlspecialchars($mascota['edad']); ?></td>
                            <td><?php echo htmlspecialchars($mascota['peso']); ?></td>
                            <td><button class="edit">EDITAR</button></td>
                            <td><button class="delete">ELIMINAR</button></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </article>
<?php
    $pagina_actual = '';
    include '../../includes/templates/footer.php';
?>