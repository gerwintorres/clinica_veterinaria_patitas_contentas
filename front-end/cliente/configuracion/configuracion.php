<?php
    $pagina_actual = '';
    require '../../config/funciones_clientes.php';
    include '../../includes/templates/header.php';
    if (isset($_SESSION['id_cliente'])){
        $cliente = obtenerInformacionCliente($_SESSION['id_cliente']);
    }

    if(isset($_SESSION['actualizado'])){
        alertaActualizado('Usuario actualizado exitosamente');
        unset($_SESSION['actualizado']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_cliente'])) {
        eliminarCliente($_GET['id_cliente']);
    }
    
?>
<div class="contenedor contenedor-boton-atras">
    <a href="../menu_cliente.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Configuración de perfil</h1>

<main class="formulario-cerrado contenedor margen-inferior-config">
    <div class="form-grupo-cerrado-4 margen-superior">
        <div>
            <label for="nombres">Nombre(s)</label>
            <input type="text" class="input-cerrado" id="nombres" value="<?php echo $cliente['nombres']?>" name="nombres" disabled>
        </div>
        <div>
            <label for="direccion">Dirección</label>
            <input type="text" class="input-cerrado" id="direccion" value="<?php echo $cliente['direccion']?>" name="direccion" disabled>
        </div> 
    </div>
    <div class="form-grupo-cerrado-2 margen-superior-config">
        <div>
            <label for="apellidos">Apellidos</label>
            <input type="text" class="input-cerrado input-width" id="apellidos" value="<?php echo $cliente['apellidos']?>" name="apellidos" disabled>
        </div>
        <div></div>
        <div>
            <label for="tipoDocumento">Tipo de documento</label>
            <input type="text" class="input-cerrado" id="tipoDocumento" name="tipoDocumento" value="<?php echo $cliente['tipo_documento']?>" disabled>
        </div>
        <div>
            <label for="numeroDocumento">Numero de documento</label>
            <input type="int" class="input-cerrado" id="numeroDocumento" name="numeroDocumento" value="<?php echo $cliente['id_cliente']?>" disabled>
        </div>
    </div>
    <div class="form-grupo-cerrado margen-superior-config">
        <div>
            <label for="telefono">Teléfono</label>
            <input type="number" class="input-cerrado" id="telefono" name="telefono" value="<?php echo $cliente['telefono']?>" disabled>
        </div>
        <div>
            <label for="email">Correo electrónico</label>
            <input type="email" class="input-cerrado" id="email" name="email" value="<?php echo $cliente['email']?>" disabled>
        </div>
        <?php if($_SESSION['administrador']): ?>
            <div></div>
            <div class="botones-formulario-config">
                <a class="boton-azul-config" href="modificar_perfil.php">MODIFICAR INFORMACIÓN</a>
            </div>
        <?php else: ?>
            <div class="botones-formulario-config">
                <a class="boton-azul-config" href="modificar_perfil.php">MODIFICAR INFORMACIÓN</a>
            </div>
            <div class="botones-formulario-config-2">
                <a class="boton-rojo-config" href="configuracion.php?id_cliente=<?php echo $cliente['id_cliente']?>">ELIMINAR PERFIL</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
    include '../../includes/templates/footer.php';
?>