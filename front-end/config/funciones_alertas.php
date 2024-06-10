<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php 
function alertaError(){ ?>
    <script>
    $(document).ready(function() {
        Swal.fire({
            title: '¡Error al ingresar!',
            text: 'El usuario o la contraseña son incorrectos, por favor verifique los datos ingresados.',
            icon: 'error',
            confirmButtonText: '¡Entendido!',
            confirmButtonColor: "#231F57",
            allowEnterKey: false,
            customClass: {
                title: 'title-class',
                popup: 'popup-class',
            }
        });
    });
    </script>
<?php 
} 

function alertaExitoso($texto){ ?>
    <script>
        $(document).ready(function() {
            Swal.fire({
            position: "center",
            icon: "success",
            title: "<?php echo $texto?>",
            showConfirmButton: false,
            timer: 1400,
            customClass: {
                    title: 'title-class-signed',
                    popup: 'popup-class',
                }
            });
        });
    </script>
<?php 
}

function alertaRegistro($texto){ ?>
    <script>
    $(document).ready(function() {
        Swal.fire({
            text: '<?php echo $texto?>',
            icon: 'success',
            confirmButtonText: 'ACEPTAR',
            confirmButtonColor: "#231F57",
            allowEnterKey: false,
            customClass: {
                title: 'title-class',
                popup: 'popup-class',
            }
        });
    });
    </script>
<?php 
}

function alertaActualizado($texto){ ?>
    <script>
    $(document).ready(function() {
        Swal.fire({
            text: '<?php echo $texto?>',
            icon: 'info',
            confirmButtonText: 'ACEPTAR',
            confirmButtonColor: "#231F57",
            allowEnterKey: false,
            customClass: {
                title: 'title-class',
                popup: 'popup-class',
            }
        });
    });
    </script>
<?php 
}

function alertaEliminado($texto, $url){ ?>
    <script>
    $(document).ready(function() {
        Swal.fire({
            text: '<?php echo $texto?>',
            icon: 'success',
            confirmButtonText: 'ACEPTAR',
            confirmButtonColor: "#231F57",
            allowEnterKey: false,
            customClass: {
                title: 'title-class',
                popup: 'popup-class',
            }
        }).then((result) => {
             if (result.isConfirmed) {
                window.location.href = "<?php echo $url?>";
             }
        });
    });
    </script>
<?php 
}

function alertaErrorGeneral($texto){ ?>
    <script>
    $(document).ready(function(){
        Swal.fire({
            text: '<?php echo $texto; ?>',
            icon: 'error',
            confirmButtonText: 'ACEPTAR',
            confirmButtonColor: "#231F57",
            allowEnterKey: false,
            customClass: {
                title: 'title-class',
                popup: 'popup-class',
            }   
        });
    });
    </script>
<?php 
}




?>








