var clave_id = 0;
var wrapperID = -1;
var DT = '';
function loadingDT(data){
    document.querySelector('#containerTable').innerHTML = data;
    applyToolTips()
}

function applyToolTips()
{
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}

function applyDataTable()
{
    DT = $('#carreraTable').DataTable({
        'language':{
            'lengthMenu': 'Mostrar _MENU_ carreras',
            'zeroRecords': 'No exiten registros',
            'infoEmpty': 'Registros no disponibles',
            "sSearch": "Buscar:",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoFiltered": "(filtrados de _MAX_ total de registros)",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    });
}

function newCareer()
{
    document.querySelector('#clavesTBody').innerHTML = '';
    const form = document.querySelector('#FormCarrera');
    form.setAttribute('method', 'POST');
    form.setAttribute('action', `./carreras`);

    document.querySelector('#BtnSubmitCarrera').innerText = 'Crear Carrera';
    document.querySelector('#FormCarrera').reset();
    $('#ModalCarreraForm').modal('show');
    document.querySelector('#ModalCarreraLabel').innerText = 'Nueva Carrera';

}

function editCareer(c_id){
    wrapperID = c_id;
    document.querySelector('#BtnSubmitCarrera').innerText = 'Actualizar Carrera';
    const form = document.querySelector('#FormCarrera');
    form.setAttribute('method', 'PUT');
    form.setAttribute('action', './carreras/'+c_id);
    console.log(form.getAttribute('action'));

    let tbody = document.querySelector('#clavesTBody');
    tbody.innerHTML = '';
    console.log('career edit c_id: ' + c_id);

    const info = {
        td_nombre: document.querySelector(`#ca_${c_id}`).children[0].innerText,
        td_claves: document.querySelector(`#ca_${c_id}`).children[1].innerText
    }

    document.querySelector('#nombre_carrera').value = info.td_nombre;
    document.querySelector('#ModalCarreraLabel').innerText = 'Editar Carrera';

    const claves_items = info.td_claves.split(',');

    for (item of claves_items) {

        let index = 1;
        if(tbody.children.length > 0)
            index = tbody.children.length + 1;

        const tr = document.createElement('tr');
        tr.classList.add(`clave_${index}`);

        const td1 = document.createElement('td');
        td1.innerText = item;

        const td2 = document.createElement('td');
        const a = document.createElement('a');
        a.classList.add('text-danger')
        a.style = 'cursor: pointer;';
        const i = document.createElement('i');
        i.classList.add('fas', 'fa-trash');
        a.append(i);
        a.addEventListener('click', function(){
            clave_id = index;
            deleteKey();
        });

        td2.append(a);
        tr.append(td1,td2);
        tbody.append(tr);
    }
    $('#ModalCarreraForm').modal('show');
}

function submitCareer()
{
    if(!validateForm())
        return;

    const clavesTBody = document.querySelector('#clavesTBody');
    const nombre_carrera = document.querySelector('#nombre_carrera');

    let claves = '';

    // claves separados por ','
    for (item of clavesTBody.children) {
        let cl = item.children[0].innerText
        claves += cl + ',';
    }

    const form = document.querySelector('#FormCarrera');
    const formToken = $("meta[name='csrf-token']").attr("content");
    $.ajax({
       url: form.getAttribute('action'),
       type: form.getAttribute('method'),
       data: {
           '_token': formToken,
           'id': wrapperID,
           'nombre_carrera': nombre_carrera.value,
           claves: claves
       },
       success: function(answer){
           console.log(answer)
            if(answer.say == 'yes'){
                Swal.fire('Éxito', answer.message, 'success');
                loadingDT(answer.data)
                applyDataTable()
            }
            document.querySelector('#FormCarrera').reset();
            $("#ModalCarreraForm").modal("hide");
        }
    });

}

function validateForm()
{
    let errorIndicator = 0;

    let nombre = document.querySelector('#nombre_carrera');
    let clave = document.querySelector('#claveCarrera');

    if(nombre.value == ''){
        nombre.classList.add('is-invalid');
        errorIndicator++;
    }else
        nombre.classList.remove('is-invalid');

    if(document.querySelector('#clavesTBody').children.length == 0){
        clave.classList.add('is-invalid');
        errorIndicator++;
    }else
        clave.classList.remove('is-invalid');

    return (errorIndicator === 0);
}

function addKey()
{
        let newClave = document.querySelector('#claveCarrera');
        if(newClave.value != ''){
            let tbody = document.querySelector('#clavesTBody');
            let index = 1;
            if(tbody.children.length > 0)
                index = tbody.children.length + 1;

            const tr = document.createElement('tr');
            tr.classList.add(`clave_${index}`);

            const td1 = document.createElement('td');
            td1.innerText = newClave.value;

            const td2 = document.createElement('td');
            const a = document.createElement('a');
            a.classList.add('text-danger')
            a.style = 'cursor: pointer;';
            const i = document.createElement('i');
            i.classList.add('fas', 'fa-trash');
            a.append(i);
            a.addEventListener('click', function(){
                clave_id = index;
                deleteKey();
            });

            td2.append(a);
            tr.append(td1,td2);
            tbody.append(tr);
            newClave.value = '';
        }

}

function deleteKey()
{
    let target = document.querySelector(`.clave_${clave_id}`);
    console.log(target)
    target.remove();
}


function removeCareer(c_id)
{
    Swal.fire({
      title: '¿Estas seguro?',
      text: "Esta accion no se podrá revertir!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
            document.querySelector('#FormBorrarCarrera').setAttribute('action', `./carreras/${c_id}`)
            document.querySelector('#wrapperID_delete').value = c_id;
            document.querySelector('#FormBorrarCarrera').submit();
      }
    })
}
