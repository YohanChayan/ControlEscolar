function togglePasswordView()
{
    const newPassword = document.querySelector('#newPassword');
    const confirmPassword = document.querySelector('#confirmPassword');
    const iconEye = document.querySelector('#iconEye');

    if(newPassword.getAttribute('type') == 'text'){ // close eye
        iconEye.classList.remove('fa-eye');
        iconEye.classList.add('fa-eye-slash');
        newPassword.setAttribute('type', 'password')
        confirmPassword.setAttribute('type', 'password')
    }
    else{ // open eye
        iconEye.classList.remove('fa-eye-slash');
        iconEye.classList.add('fa-eye');
        newPassword.setAttribute('type', 'text')
        confirmPassword.setAttribute('type', 'text')
    }
}

function enableEdit()
{
    document.querySelector('#name').readOnly = false;
    document.querySelector('#apellidos').readOnly = false;
    document.querySelector('#email').readOnly = false;
    document.querySelector('#codigo').readOnly = false;
    document.querySelector('#telefono').readOnly = false;


    const carrera_input = document.querySelector('#carrera');

    if(carrera_input){ // is student
        carrera_input.readOnly = false;
        document.querySelector('#clave_carrera').readOnly = false;
        document.querySelector('#ciclo').readOnly = false;
        document.querySelector('#telefono').readOnly = false;
    }

}
