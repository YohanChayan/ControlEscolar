var hasToFix = '';

// carga errores de registro al estudiante, al cargar la pagina
function loadErrors()
{
    const list_errors = document.querySelector('#list_errors_user');
    const arrayTofix = hasToFix.slice(0, -1).split('|');

    list_errors.innerHTML = '';
    for (item of arrayTofix) {
        const word = errorsWords(item);
        const li = document.createElement('li');
        li.classList.add('text-danger', 'fs-4');
        li.innerText = word;
        list_errors.append(li);
    }
}

function errorsWords(word)
{
    if(word === 'name') return 'Nombres';
    if(word === 'apellidos') return 'Apellidos';
    if(word === 'email') return 'Correo';
    if(word === 'ciclo_admision') return 'Ciclo de admisión';
    if(word === 'codigo') return 'Código';
    // if(word === 'clave_carrera') return 'Clave de la carrera';
    if(word === 'nombre_carrera') return 'Nombre o clave de la Carrera';
}

function showErrorsModal()
{
    const containerInputs = document.querySelector('#containerInputs');
    const arrayTofix = hasToFix.slice(0, -1).split('|');
    console.log(arrayTofix);

    containerInputs.innerHTML = '';
    for (item of arrayTofix) {
        const labelTag = document.createElement('label');
        labelTag.htmlFor = item;
        labelTag.innerText = errorsWords(item);
        labelTag.classList.add('col-sm-4', 'col-form-label');

        const inputContainer = document.createElement('div');
        inputContainer.classList.add('col-sm-8');

        const input = document.createElement('input');
        input.classList.add('form-control');
        input.name = item;
        input.id = item;


        if(item === 'ciclo_admision'){
            input.setAttribute('list' , 'ciclos_list');
            input.addEventListener('keyup', function(){
                getCiclos();
            })

            const dataList = document.createElement('datalist');
            dataList.id = 'ciclos_list';
            inputContainer.append(dataList);
        }else if(item === 'nombre_carrera'){
            input.setAttribute('list' , 'carreras_list');
            input.addEventListener('keyup', function(){
                getCareers();
            })

            const dataList = document.createElement('datalist');
            dataList.id = 'carreras_list';
            inputContainer.append(dataList);

        }else {
            input.setAttribute('type' , 'text');
        }

        inputContainer.append(input);

        containerInputs.append(labelTag,inputContainer)
    }
    $('#fixErrorsModal').modal('show');
}

// onkeyUp Ajax
function getCareers()
{
    const inputCarreraTag = document.querySelector('#nombre_carrera');

    if(inputCarreraTag.value === '')
        return;

    $.ajax({
       'url': './filter_careers',
       'type': 'POST',
       'data': {
           '_token': $("meta[name='csrf-token']").attr("content"),
           'carreraValue': inputCarreraTag.value
       },
       'success': function(answer){
           const carreras_list = document.querySelector('#carreras_list');
           carreras_list.innerHTML = answer;

       }
    });
}

// onkeyUp Ajax
function getCiclos()
{

    const inputCicloTag = document.querySelector('#ciclo_admision');
    if(inputCicloTag.value === '')
        return;
    $.ajax({
       'url': './filter_ciclos',
       'type': 'POST',
       'data': {
              '_token': $("meta[name='csrf-token']").attr("content"),
              'cicloValue': inputCicloTag.value
          },
       'success': function(answer){
            const ciclos_list = document.querySelector('#ciclos_list');
            ciclos_list.innerHTML = answer;


       }
    });

}

function validateForm()
{
    const inputsList = document.querySelectorAll('#containerInputs input');
    let pass = true;

    for (item of inputsList) {

        if(item.name == 'codigo'){
            if(item.value === '' || item.value.length < 9 || item.value.length > 9){
                pass = false;
                item.classList.add('is-invalid');
            }else
                item.classList.add('is-invalid');

        }else if(item.name == 'ciclo_admision'){
            if(item.value.length != 5){
                pass = false;
                item.classList.add('is-invalid');
            }else {
                item.classList.remove('is-invalid');
            }
        }else{
            if(item.value === ''){
                pass = false;
                item.classList.add('is-invalid');
            }else {
                item.classList.remove('is-invalid');
            }
        }
    }

    return pass;
}

function submitFixErrors()
{
    if(!validateForm())
        return;

    Swal.fire({
      title: '¿Estas seguro?',
      text: "Asegurese de que sus datos estan correctos antes de confirmar!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
            document.querySelector('#FixErrorsForm').submit();
      }
    })
}
