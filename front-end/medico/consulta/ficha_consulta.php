<?php
    $pagina_actual = '';
    include '../../includes/templates/header.php';
?>

<div class="contenedor contenedor-boton-atras">
    <a href="paciente_consulta.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Consulta</h1>

<div class="imagen-formularios-cerrados contenedor">
        <img src="../../build/img/logo.webp" alt="Logotipo Patitas Contentas">
        <div class="titulo">
            <span>Clínica Veterinaria</span>
            <span class="segunda_parte">Patitas Contentas</span>
        </div>
</div>

<main class="formulario-cerrado contenedor">
    <form action="">
        <h4 class="titulos-formularios-cerrado">Información básica</h4>
        <div class="form-grupo-cerrado-2">
            <div>
                <label for="nombreMascota">Nombre de la mascota</label>
                <input type="text" class="input-cerrado" id="nombreMascota" name="nombreMascota" required>
            </div>
            <div>
                <label for="nombreDueno">Nombre del dueño</label>
                <input type="text" class="input-cerrado" id="nombreDueno" name="nombreDueno" required>
            </div>
            <div>
                <label for="direccion">Dirección</label>
                <input type="text" class="input-cerrado input-width" id="direccion" name="direccion" required>
            </div>  
        </div>
        <div class="form-grupo-cerrado-2">
            <div>
                <label for="telefono">Teléfono</label>
                <input type="number" class="input-cerrado" id="telefono" name="telefono" required>
            </div>
            <div>
                <label for="raza">Raza</label>
                <input type="text" class="input-cerrado" id="raza" name="raza" required>
            </div>
            <div>
                <label for="peso">Peso (Kg)</label>
                <input type="number" class="input-cerrado" id="peso" name="peso" required>
            </div>
            <div>
                <label for="edad">Edad</label>
                <input type="number" class="input-cerrado" id="edad" name="edad" required>
            </div>
        </div>
        <h4 class="titulos-formularios-cerrado">Constantes vitales</h4>
        <div class="form-grupo-cerrado-2">
            <div>
                <label for="fr">FR</label>
                <input type="number" class="input-cerrado" id="fr" name="fr" required>
            </div>
            <div>
                <label for="fc">FC</label>
                <input type="number" class="input-cerrado" id="fc" name="fc" required>
            </div>
            <div>
                <label for="tpc">TPC</label>
                <input type="number" class="input-cerrado" id="tpc" name="tpc" required>
            </div>
            <div>
                <label for="trc">TRC</label>
                <input type="number" class="input-cerrado" id="trc" name="trc" required>
            </div>
        </div>
        <div class="form-grupo-cerrado">
            <div>
                <label for="t">T°</label>
                <input type="number" class="input-cerrado" id="t" name="t" required>
            </div>
        </div>
        <h4 class="titulos-formularios-cerrado">Detalles de la consulta</h4>
        <div class="form-grupo-cerrado">
            <div>
                <label for="fecha">Fecha</label>
                <input type="date" class="input-cerrado" id="fecha" name="fecha" disabled>
            </div>
            <div>
                <label for="hora">Hora</label>
                <input type="time" class="input-cerrado" id="hora" name="hora" disabled>
            </div>
            <div>
                <label for="medico">Médico</label>
                <input type="text" class="input-cerrado" id="medico" name="medico" disabled>
            </div>
            <div>
                <label for="codigoHistoria">Código historia</label>
                <input type="number" class="input-cerrado" id="codigoHistoria" name="codigoHistoria" disabled>
            </div>
        </div>
        <label class="margen-superior-2" for="motivo">Motivo de consulta</label>
        <textarea class="input-cerrado" id="motivo" name="motivo" required></textarea>
        <label class="margen-superior-2" for="anotaciones">Anotaciones médicas</label>
        <textarea class="input-cerrado" id="anotaciones" name="anotaciones" required></textarea>
        <input class="boton-formulario-azul margen-superior margen-inferior" type="submit" value="INGRESAR INFORMACIÓN"> 
    </form>
</main>
<?php
    include '../../includes/templates/footer.php';
?>