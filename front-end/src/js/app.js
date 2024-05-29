function cambiarIconoClave(){
    const passwordField = document.getElementById('clave');
    const showEye = document.getElementById('show-eye');
    const hideEye = document.getElementById('hide-eye');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Cambiar el icono dependiendo del estado
    if (type === 'password') {
        showEye.style.display = 'block';
        hideEye.style.display = 'none';
    } else {
        showEye.style.display = 'none';
        hideEye.style.display = 'block';
    }
}

document.getElementById('formulario-iniciar-sesion-cliente').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada

    // Obtener los valores del formulario
    var email = document.getElementById('email').value;
    var clave = document.getElementById('clave').value;

    // Crear un objeto con los datos del formulario
    var formData = {
        email: email,
        clave: clave
    };

    // Realizar la solicitud POST a la API FastAPI
    fetch('http://127.0.0.1:8000/login/client', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => {
        // Manejar la respuesta de la API
        if (response.ok) {
            // Si la respuesta es exitosa, redirigir al usuario a la página de inicio 
            window.location.href = '../../cliente/menu_cliente.php';
           
            
        } else {
            alert('NO FUNCIONO EL MIERDERO');
            // Si la respuesta es un error, manejarlo (mostrar mensaje de error, etc.)
        }
    })
    .catch(error => {
        console.log(error);
    });
});

// document.getElementById('formulario-iniciar-sesion-medico').addEventListener('submit', function(event) {
//     event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada

//     // Obtener los valores del formulario
//     var email = document.getElementById('email').value;
//     var clave = document.getElementById('clave').value;

//     // Crear un objeto con los datos del formulario
//     var formData = {
//         email: email,
//         clave: clave
//     };

//     // Realizar la solicitud POST a la API FastAPI
//     fetch('http://127.0.0.1:8000/login/medico', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify(formData)
//     })
//     .then(response => {
//         // Manejar la respuesta de la API
//         if (response.ok) {
//             // Si la respuesta es exitosa, redirigir al usuario a la página de inicio 
//             window.location.href = '../../medico/menu_medico.php';
           
            
//         } else {
//             alert('NO FUNCIONO EL MIERDERO');
//             // Si la respuesta es un error, manejarlo (mostrar mensaje de error, etc.)
//         }
//     })
//     .catch(error => {
//         console.log(error);
//     });
// });


