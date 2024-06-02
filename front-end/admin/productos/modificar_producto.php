<?php
    $pagina_actual = '';
    require '../../config/funciones_productos.php';
    include '../../includes/templates/header.php';

    if(isset($_SESSION['loggedin']) && $_SESSION['usuario'] = 'admin'){
        $productos = obtenerProductos();
        $proveedores = obtenerProveedores();
    }

    $id_producto = intval($_GET['id_producto']);

    foreach ($productos as $producto) {
        if ($producto['id_producto'] === $id_producto) {
            $nombre = $producto['nombre'];
            $fecha_vencimiento = $producto['fecha_vencimiento'];
            $lote = $producto['lote'];
            $unidades = $producto['cantidad'];
            $proveedor = $producto['id_proveedor'];
            $valorCompra = $producto['precio_compra'];
            $valorVenta = $producto['precio_venta'];
            $id_proveedor = $producto['id_proveedor'];
            $nombre_proveedor = $producto['nombre_proveedor'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $fecha_vencimiento = $_POST['fechaVencimiento'];
        $lote = $_POST['lote'];
        $unidades = $_POST['unidades'];
        $proveedor = $_POST['proveedor'];
        $valorCompra = $_POST['valorCompra'];
        $valorVenta = $_POST['valorVenta'];
        actualizarProductos($id_producto, $nombre, $fecha_vencimiento, $unidades, $proveedor, $valorCompra, $valorVenta, $lote);
    }
?>

<div class="contenedor contenedor-boton-atras">
    <a href="productos.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div> 
 
<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Modificar producto</h1>

<main class="contenedor formulario-general">
    <div class="form-imagen-productos"></div>
    <div class="form-contenido">
        <form action="" method="POST">
            <h3 class="titulo-formulario">Clínica Veterinaria Patitas Contentas requiere la siguiente información</h3>
            <div class="formulario-datos">
                <div>
                    <label for="nombre">Nombre del producto</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" required class="inputs">
                </div>
                <div>
                    <label for="fechaVencimiento">Fecha de vencimiento</label>
                    <input type="date" id="fechaVencimiento" name="fechaVencimiento" value="<?php echo $fecha_vencimiento?>" required class="inputs">
                </div>
                <div>
                    <label for="lote">Lote</label>
                    <input type="text" id="lote" name="lote"  value="<?php echo $lote?>" required class="inputs">
                </div>
            </div>
            <div class="formulario-datos">
                <div>
                    <label for="unidades">Unidades disponibles</label>
                    <input type="number" id="unidades" name="unidades" value="<?php echo $unidades?>" required class="inputs">
                </div>
                <div>
                    <label for="proveedor">Proveedor</label>
                    <select name="proveedor" id="proveedor" class="inputs">
                        
                        <?php foreach ($proveedores as $proveedor): ?>
                            <option value="<?php echo htmlspecialchars($proveedor['id_proveedor']); ?>" <?php if($proveedor['id_proveedor'] == $id_proveedor): echo "selected"; endif;?> >
                                <?php echo htmlspecialchars($proveedor['nombre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="valorCompra">Valor de la compra (COP)</label>
                    <input type="number" id="valorCompra" name="valorCompra" value="<?php echo $valorCompra?>" required class="inputs">
                </div>
            </div>
            <div class="formulario-datos">
                <div>
                    <label for="valorVenta">Valor de venta (COP)</label>
                    <input type="number" id="valorVenta" name="valorVenta" value="<?php echo $valorVenta?>" required class="inputs">
                </div>
            </div>
            <div class="form-botones">
                <input class="boton-formulario-azul margen-superior" type="submit" value="MODIFICAR PRODUCTO">
                <a class="boton-formulario-blanco margen-superior">CANCELAR</a>
            </div>
        </form>
    </div>
</main>

<?php
    include '../../includes/templates/footer.php';
?>