<?php
    $pagina_actual = '';
    include '../../includes/templates/header.php';
?>

<div class="contenedor contenedor-boton-atras">
    <a href="citas_medicas.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Agendar cita</h1>

<main class="contenedor formulario-general">
    <div class="form-imagen-cita"></div>
    <div class="form-contenido">
        <form action="">
            <h3 class="titulo-formulario">Clínica Veterinaria Patitas Contentas requiere la siguiente información</h3>
            <div class="formulario-datos">
                <div>
                    <label for="mascota">Mascota</label>
                    <select name="mascota" id="mascota" required class="inputs">
                        <option value="" disabled selected>Seleccione una mascota</option>
                        <option value="mascota1">Mascota 1</option>
                        <option value="mascota2">Mascota 2</option>
                    </select>
                </div>
                <div>
                    <label for="tipoProcedimiento">Tipo de procedimiento</label>
                    <select name="tipoProcedimiento" id="tipoProcedimiento" required class="inputs">
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="procedimiento1">Procedimiento 1</option>
                        <option value="procedimiento2">Procedimiento 2</option>
                    </select>
                </div>
                <div>
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" required class="inputs">
                </div>
            </div>
            <div class="formulario-datos">
                <div>
                    <label for="hora">Hora</label>
                    <select name="hora" id="hora" required class="inputs">
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="hora1">Hora 1</option>
                        <option value="hora2">Hora 2</option>
                    </select>
                </div>
                <div>
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" name="edad" required class="inputs">
                </div>
                <div>
                    <label for="peso">Peso (kg)</label>
                    <input type="number" id="peso" name="peso" required class="inputs">
                </div>
            </div>
            <div class="formulario-datos">
                <div>
                    <label for="raza">Raza</label>
                    <input type="text" id="raza" name="raza" required class="inputs">
                </div>
            </div>
            <div class="contenido-centrado">
                <input class="boton-formulario-azul margen-superior" type="submit" value="AGENDAR PROCEDIMIENTO">
            </div>
        </form>
    </div>
</main>

<?php
    include '../../includes/templates/footer.php';
?>