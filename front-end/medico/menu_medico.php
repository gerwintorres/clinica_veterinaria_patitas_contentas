<?php
    $pagina_actual = '';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['id_medico']) && isset($_SESSION['nombres'])) {
        $id_medico = $_SESSION['id_medico'];
        $nombres = $_SESSION['nombres'];
    }
    include '../includes/templates/header.php';
    require '../config/funciones_alertas.php';
    if(isset($_SESSION['exito'])){
        alertaExitoso('INICIO DE SESIÓN EXITOSO');
        unset($_SESSION['exito']);
    }
?>

<h1 class="contenedor titulo-h1-pagina alineacion-izquierda">Bienvenido(a), Dr(a) <?php echo $nombres?></h1>

<main class="contenedor main-inicio-sesion">
    <a class="card" href="programacion/programacion_dia.php">Programación del día
        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="90" height="90" fill="url(#pattern0_26_439)"/>
            <defs>
            <pattern id="pattern0_26_439" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_26_439" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_26_439" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAACcElEQVR4nO2cP25bMQyHNbU9QlIxeYNovCAn6QUMCfCQCzTNFueEaTulOUpgL5kcyMhQ5F8rPJGU/H4foMUgZOozzWdzkHMAAAAAAAAAAAAAwA3DxRf28Sr4+DtQ3DKl3SGuQHEbKP5a+PSD+dtn1Y+e/YqY4r21BFaXnv7ks+tV8gwl89+yNSo7twvrw7K97Etx0bknWx+U7UX/lBdNaWN9ULYXvREX/d6buwOFrc4L0QmiJUBFKwHRSkC0EhCtBEQrAdFKQLQSEK0ERM9V9NyWg+gE0dxAJaKiyV4eWgfZi0WPJog2rzpGRSdzUWgdZC/xoHp08OmRKV2PJ+lrXuzj+vm1f8aX5ly6///EO2mqVYWP61d7+7guiS/OvXD/j+Kn5qIm+ux0dfxy72FYHpXEl1K6/0fxrhfR4xstYEFLL32w1vKxah03VqKt8ilPtHCF/KDxca398Gktn+JEpZcrzEc6fzHBtRNliIZoRkW/Bq0DrWMa6NHJ9mE4ZXYxtvLzrotZR4XZBSvMFlrLpzjRGrOLQWG20Fo+4rOCsUJ8KTXzcdLUmhVwhfji3CvmMzUXtVlBmBBfmrNEPk6adytiZstBdIJobqASUdFkLw+tg+zFokfTzERLzzqCcHw3oqVnHSwd34to6VnHmXB8N6ItZh2LivHdiLaYdXDN+F5Ea846RoH4bkTPbTmIThDNDVRiNxWN69jSLvj4IC8aFwzuVC4Y3N8628BXlw1XoPhdXHS+AHV/Eep8Jd+dny8/iYvey/YrmqPsQPEu/7tUkfyisi9zvzrkB2TYny3e5nahVskAAAAAAAAAAAAArm2eAHE334x6IGdMAAAAAElFTkSuQmCC"/>
            </defs>
        </svg>
    </a>
    <a class="card" href="consulta/paciente_consulta.php">Consulta
        <svg width="91" height="90" viewBox="0 0 91 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect x="0.5" width="90" height="90" fill="url(#pattern0_37_54)"/>
            <defs>
            <pattern id="pattern0_37_54" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_37_54" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_37_54" width="90" height="90" xlink:href="data:image/png;base64,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"/>
            </defs>
        </svg>
    </a>
</main>
<?php
    include '../includes/templates/footer.php';
?>