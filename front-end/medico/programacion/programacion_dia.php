<?php
    $pagina_actual = '';
    include '../../includes/templates/header.php';
    date_default_timezone_set('America/Bogota');
?>

<div class="contenedor contenedor-boton-atras">
    <a href="../menu_medico.php" class="boton-atras"> <svg width="11" height="20" viewBox="0 0 11 26" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.254358 13.9952C-0.0847876 13.5657 -0.0847876 12.8695 0.254358 12.44L9.10815 1.22798C9.4473 0.798517 9.99707 0.798517 10.3362 1.22798L10.7456 1.74641C11.0848 2.17588 11.0848 2.87218 10.7456 3.30166L2.9153 13.2176L10.7456 23.1337C11.0848 23.5631 11.0848 24.2593 10.7456 24.6888L10.3362 25.2073C9.99707 25.6368 9.4473 25.6368 9.10815 25.2073L0.254358 13.9952Z" fill="#231F57"/>
    </svg>Ir atrás</a>
</div>

    
<h1 class="contenedor titulo-h1-pagina alineacion-izquierda margen-inferior">Programación del día: <?php echo date('d-m-Y'); ?></h1>
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
                    <th class="contenido-centrado icono-checkbox"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.5" y="0.5" width="19" height="19" rx="5.5" fill="#F7FAFF"/>
                        <rect x="0.5" y="0.5" width="19" height="19" rx="5.5" stroke="#231F57"/>
                        <path d="M5.91602 10H14.0827" stroke="#231F57" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </th>
                    <th>Hora inicio</th>
                    <th>Hora fin</th>
                    <th>Mascota</th>
                    <th>Cliente</th>
                    <th>Motivo de consulta</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="container-checkbox">
                        <input type="checkbox" id="check">
                    </td>
                    <td>Hora inicio</td>
                    <td>Hora fin</td>
                    <td>Mascota</td>
                    <td>Cliente</td>
                    <td>Motivo de consulta</td>
                </tr>
                <!-- Repite las filas según sea necesario -->
            </tbody>
        </table>
    </article>
<?php
    include '../../includes/templates/footer.php';
?>