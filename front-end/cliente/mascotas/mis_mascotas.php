<?php
    $pagina_actual = '';
    $titulo = 'Mis mascotas';
    $ruta_boton_atras = '../menu_cliente.php';
    $texto_card = 'añadir nueva <br> mascota';
    $texto_tabla = 'Mascotas';
    $ruta_card = 'anadir_mascota.php';
    require '../../config/funciones_mascotas.php';
    include '../../includes/templates/pagina_card.php';

    if (isset($_SESSION['id_cliente'])) {
        $id_cliente = $_SESSION['id_cliente'];
        $mascotas = obtenerMascotas($id_cliente);
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_mascota'])) {
        $id_mascota = $_GET['id_mascota'];
        eliminarMascota($id_mascota);
    }
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
                            <td><a href="modificar_mascota.php?id_mascota=<?php echo $mascota['id_mascota']?>"><button class="edit">EDITAR</button></a></td>
                            <td><a href="mis_mascotas.php?id_mascota=<?php echo $mascota['id_mascota']?>"><button class="delete">ELIMINAR</button></a></td>
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