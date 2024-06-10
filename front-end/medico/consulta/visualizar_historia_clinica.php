<?php
    $pagina_actual = '';
    require '../../config/funciones_historia_clinica.php'; 
    
    include '../../includes/templates/header.php';

    if(isset($_SESSION['loggedin']) && $_SESSION['usuario'] = 'medico'){
        $historia = visualizarHistoria($_GET['id_historia_clinica']); 
    }
?>

<div class="contenedor contenedor-boton-atras">
    <a href="paciente_consulta.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Historia clínica, código: <?php echo $_GET['id_historia_clinica']?></h1>

<div class="imagen-formularios-cerrados contenedor">
        <img src="../../build/img/logo.webp" alt="Logotipo Patitas Contentas">
        <div class="titulo">
            <span>Clínica Veterinaria</span>
            <span class="segunda_parte">Patitas Contentas</span>
        </div>
</div>

<main class="formulario-cerrado contenedor margen-superior">
    <div class="form-grupo-cerrado-2">
        <div>
            <label for="nombreMascota">Nombre de la mascota</label>
            <input type="text" class="input-cerrado" id="nombreMascota" name="nombreMascota" disabled value="<?php echo $historia['nombre_mascota']?>">
        </div>
        <div>
            <label for="nombreDueno">Nombre del dueño</label>
            <input type="text" class="input-cerrado" id="nombreDueno" name="nombreDueno" disabled value="<?php echo $historia['nombre_cliente']?>">
        </div>
        <div>
            <label for="direccion">Dirección</label>
            <input type="text" class="input-cerrado input-width" id="direccion" name="direccion" disabled value="<?php echo $historia['direccion']?>">
        </div>
    </div>
    <div class="form-grupo-cerrado">
        <div>
            <label for="telefono">Teléfono</label>
            <input type="number" class="input-cerrado" id="telefono" name="telefono" disabled value="<?php echo $historia['telefono']?>">
        </div>
        <div>
            <label for="raza">Raza</label>
            <input type="text" class="input-cerrado" id="raza" name="raza" disabled value="<?php echo $historia['raza']?>">
        </div>
        <div>
            <label for="peso">Peso (Kg)</label>
            <input type="number" class="input-cerrado" id="peso" name="peso" disabled value="<?php echo $historia['peso']?>">
        </div>
        <div>
            <label for="edad">Edad</label>
            <input type="text" class="input-cerrado" id="edad" name="edad" disabled value="<?php echo $historia['edad']?>">
        </div>
    </div>
    <div>
        <label class="margen-superior-2" for="descripcion">Descripción</label>
        <textarea class="input-cerrado descripcion" id="descripcion" name="descripcion" disabled ><?php echo $historia['descripcion']?></textarea>
    </div>
    
</main>
<?php
    include '../../includes/templates/footer.php';
?>