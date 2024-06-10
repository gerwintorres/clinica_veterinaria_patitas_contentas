<?php
    $pagina_actual = '';
    require '../../config/funciones_clientes.php';
    include '../../includes/templates/header.php';

    if (isset($_SESSION['id_cliente'])){
        $cliente = obtenerInformacionCliente($_SESSION['id_cliente']);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $direccion = $_POST['direccion'];
        actualizarCliente($_SESSION['id_cliente'], $nombre, $apellidos, $telefono, $correo, $password, $direccion);
    }
?>

<div class="contenedor contenedor-boton-atras">
    <a href="configuracion.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>
    
<h1 class="contenedor titulo-h1-pagina margen-inferior">Modificar información del perfil</h1>

<main class="contenedor formulario-general">
    <div class="form-imagen-registro"></div>
    <div class="form-contenido">
        <form action="" method="POST">
            <h3 class="titulo-formulario">Clínica Veterinaria Patitas Contentas requiere la siguiente información</h3>
            <div class="formulario-datos">
                <div>
                    <label for="nombre">Nombre(s)</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $cliente['nombres']?>" disabled class="inputs">
                </div>
                <div>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?php echo $cliente['apellidos']?>" disabled  class="inputs">
                </div>
                <div>
                    <label for="tipoDocumento">Tipo de documento</label>
                    <select name="tipoDocumento" id="tipoDocumento" disabled class="inputs">
                        <option value="<?php echo $cliente['tipo_documento']?>" disabled selected><?php echo $cliente['tipo_documento']?></option>
                        
                    </select>
                </div>
            </div>
            <div class="formulario-datos">
                <div>
                    <label for="numeroDocumento">Número de documento</label>
                    <input type="number" id="numeroDocumento" name="numeroDocumento" value="<?php echo $cliente['id_cliente']?>" disabled class="inputs">
                </div>
                <div>
                    <label for="telefono">Teléfono</label>
                    <input type="number" id="telefono" name="telefono" required value="<?php echo $cliente['telefono']?>" class="inputs">
                </div>
                <div>
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" required value="<?php echo $cliente['email']?>" class="inputs">
                </div>
            </div>
            <div class="formulario-datos">
                <div>
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" required value="<?php echo $cliente['direccion']?>" class="inputs">
                </div>
            </div>
            <div class="form-botones">
                <input class="boton-formulario-azul margen-superior" type="submit" value="MODIFICAR INFORMACIÓN">
                <a href="configuracion.php" class="boton-formulario-blanco margen-superior">CANCELAR</a>
            </div>
        </form>
    </div>
</main>

<?php	
    include '../../includes/templates/footer.php';
?>