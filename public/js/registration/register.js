let showDataAnimation = false;

container_clave_carr.addEventListener('animationend', (event) => {
    if(!showDataAnimation){
        container_clave_carr.classList.remove('d-none');
    }else{
        container_clave_carr.classList.add('d-none');
    }
});

container_ciclo.addEventListener('animationend', (event) => {
    if(!showDataAnimation){
        container_ciclo.classList.remove('d-none');
    }else{
        container_ciclo.classList.add('d-none');
    }
});


function detectingCode(value) {
    // Enable fields to student or admin
    const container_ciclo = document.getElementById('container_ciclo');
    const container_clave_carr = document.getElementById('container_clave_carr');

    if(value.length === 9){ //student
        document.getElementById('ciclo_admision').required = true;
        document.getElementById('carrera').required = true;
        container_ciclo.classList.remove("d-none");
        container_clave_carr.classList.remove("d-none");

        if(showDataAnimation){
            container_clave_carr.classList.remove('my_element', 'hide-element');
            container_clave_carr.classList.add('my-element', 'show-element')
            container_ciclo.classList.remove('my_element', 'hide-element');
            container_ciclo.classList.add('my-element', 'show-element')
            showDataAnimation = false;
        }
    }
    else if(value.length === 7){ //admin
        document.getElementById('ciclo_admision').required = false;
        document.getElementById('carrera').required = false;
        container_clave_carr.classList.remove('my_element', 'show-element');
        container_clave_carr.classList.add('my-element', 'hide-element')
        container_ciclo.classList.remove('my_element', 'show-element');
        container_ciclo.classList.add('my-element', 'hide-element')
        showDataAnimation = true;
    }
}

document.querySelector('#btn-submitRegister').addEventListener('click', function(event){
    event.preventDefault();
    console.log('event fired')
    const car = document.querySelector('#carrera').value;
    if(car){
        const opt_value_car = document.querySelector(`option[value=${car}]`);
        console.log(opt_value_car)
        const identity_career = document.querySelector('#identity_career');
        identity_career.value = `${opt_value_car.value} - ${opt_value_car.innerText}`
    }
    document.querySelector('#registerForm').submit();
});
