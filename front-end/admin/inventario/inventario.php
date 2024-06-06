<?php
    $pagina_actual = '';
    require '../../config/funciones_productos.php';
    include '../../includes/templates/header.php';

    if(isset($_SESSION['loggedin']) && $_SESSION['usuario'] = 'admin'){
        $productos = obtenerProductos();
    }
?>
<div class="contenedor contenedor-boton-atras">
    <a href="../menu_admin.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

    
<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Inventario</h1>
    <article class="contenedor contenedor-table">
        <input type="text" id="search" placeholder="Buscar">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del medicamento</th>
                    <th>Unidades disponibles</th>
                    <th>Proveedor</th>
                    <th>Valor de venta(COP)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($productos) && is_array($productos)):?>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                            <td><?php echo htmlspecialchars($producto['nombre_proveedor']); ?></td>
                            <td><?php echo htmlspecialchars($producto['precio_venta']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </article>
<?php
    include '../../includes/templates/footer.php';
?>