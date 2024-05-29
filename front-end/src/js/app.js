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

