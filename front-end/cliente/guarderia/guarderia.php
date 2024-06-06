<?php
    $pagina_actual = '';
    $titulo = 'Guardería';
    $ruta_boton_atras = '../menu_cliente.php';
    $texto_card = 'agendar mascota';
    $texto_tabla = 'Estancias agendadas';
    $ruta_card = 'agendar_mascota.php';
    include '../../includes/templates/pagina_card.php';
    require '../../config/funciones_guarderia.php';

    if (isset($_SESSION['id_cliente'])){
        $estadias = obtenerEstadias($_SESSION['id_cliente']);
    }

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
                <?php if (isset($estadias) && is_array($estadias)):?>
                    <?php foreach ($estadias as $estadia): ?>   
                        <tr>
                            <td><?php echo htmlspecialchars($estadia['nombre_mascota']); ?></td>
                            <td><?php echo htmlspecialchars($estadia['tipo_mascota']); ?></td>
                            <td><?php echo htmlspecialchars($estadia['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($estadia['hora']); ?></td>
                            <td><?php echo htmlspecialchars($estadia['peso']); ?></td>
                            <td><a href="modificar_mascota.php?id_mascota=<?php echo $estadia['id_mascota']?>"><button class="edit">EDITAR</button></a></td>
                            <td><a href="mis_mascotas.php?id_mascota=<?php echo $estadia['id_mascota']?>"><button class="delete">ELIMINAR</button></a></td>
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
