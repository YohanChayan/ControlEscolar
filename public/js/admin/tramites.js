var tramite_id = -1;
var DT = '';

function loadingDT(data){
    document.querySelector('#tramiteTbody').innerHTML = data;
    applyToolTips()
    removeTramite();

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
    $(document).ready( function () {
        DT = $('#tramiteTable').DataTable({
            'language':{
                'lengthMenu': 'Mostrar _MENU_ tramites',
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
            },

        });

    });
}

function __rowsRequirementsHTML(reqs)
{
    if(reqs != ''){
        // console.log(reqs);
        let requerimientos = reqs.split('|');

        for (req of requerimientos) {
            const tr = document.createElement('tr');
            const reqTBody = document.querySelector('#reqsTbody');
            // const mod_key = req.charAt(0);

//             const td2 = document.createElement('td');
//
//             const container = document.createElement('div');
//             container.classList.add('form-check', 'form-switch');
//             const checkBox = document.createElement('input');
//             checkBox.classList.add('form-check-input');
//             checkBox.setAttribute('type', 'checkbox')
//             checkBox.setAttribute('role', 'switch')
//             checkBox.setAttribute('name', 'IsVirtual')
//             checkBox.setAttribute('id', 'IsVirtual')
//             checkBox.setAttribute('value', 'Si')
//             const labelCheckBox = document.createElement('label');
//             labelCheckBox.classList.add('form-check-label');
//             labelCheckBox.setAttribute('for', 'IsVirtual');
//             labelCheckBox.innerText = 'Virtual';
//
//             if(mod_key == '_'){
//                 checkBox.checked = true;
//                 req = req.substring(1);
//             }
//
//             container.append(checkBox,labelCheckBox);
//             td2.append(container)

            let index = 1;
            if(reqTBody.children.length > 0)
                index = reqTBody.children.length + 1;
            tr.id = `req_${index}`;


            const td1 = document.createElement('td');
            td1.innerText = req;

            const td3 = document.createElement('td');
            td3.classList.add('text-center')

            const a = document.createElement('a');
            a.classList.add('text-danger')
            a.addEventListener('click', function(){
                deleteRequeriment(index);
            })

            a.style = 'cursor: pointer;';

            const i = document.createElement('i');
            i.classList.add('fas', 'fa-trash');

            a.append(i);
            td3.append(a);
            // tr.append(td1,td2,td3);
            tr.append(td1,td3);
            reqTBody.append(tr);
        }
    }

}



function validateForm()
{
    let indicatorError = 0;

    let errors = {
        nombre_tramite: document.querySelector('#nombre_tramite'),
        monto: document.querySelector('#monto'),
        requerimientos: document.querySelector('#requerimientos')
    }

    if(errors.nombre_tramite.value == ''){
        errors.nombre_tramite.classList.add('is-invalid');
        indicatorError++;
    }else
        errors.nombre_tramite.classList.remove('is-invalid')

    if(errors.monto.value == '' || errors.monto.value < 0){
        errors.monto.classList.add('is-invalid');
        indicatorError++;
    }else
        errors.monto.classList.remove('is-invalid')

    if(document.querySelector('#reqsTbody').children.length == 0){
        errors.requerimientos.classList.add('is-invalid');
        indicatorError++;
    }else
        errors.requerimientos.classList.remove('is-invalid')

    return (indicatorError === 0);
}

function submitTramite(){
    const answer = validateForm();
    if(!answer)
        return;

    const nombre_tramite = $('#nombre_tramite');
    const monto = $('#monto');
    let requerimientos = '';
    let reqs = document.querySelector('#reqsTbody');

    for (item of reqs.children)
        requerimientos += `${item.firstChild.innerText}|`; //  delimitador: |


    const aviso = document.querySelector('#HasAviso');
    let disponible = true;
    if(!document.querySelector('#isAvailable').checked)
        disponible = false;

    let avisoContent = 'Sin aviso';
    if(aviso.checked)
        avisoContent = document.querySelector('#avisoContent').value;

    const methodForm = $('#FormTramite').attr('method');
    let formToken = $("meta[name='csrf-token']").attr("content");

    const form =  document.querySelector('#FormTramite');

    $.ajax({
       url: form.getAttribute('action'),
       type: form.getAttribute('method'),
       data: {
           '_token': formToken,
           'id': tramite_id,
           nombre_tramite: nombre_tramite.val(),
           monto: monto.val(),
           requerimientos: requerimientos,
           aviso: avisoContent,
           disponible: disponible
       },
       success: function(answer){
            console.log(answer)
            if(answer.say == 'yes'){
                Swal.fire({ title: answer.message, icon: 'success'});
                loadingDT(answer.data);
            }


            // loadingDT(answer.data)
            document.querySelector('#FormTramite').reset();
            $("#ModalTramiteForm").modal("hide");
        }
    });
}

function change_available(tag)
{
    const isAvailableLabel = document.querySelector('#label_IsAvailable');
    if(tag.checked){
        isAvailableLabel.classList.remove('text-danger')
        isAvailableLabel.classList.add('text-success')
    }else {
        isAvailableLabel.classList.add('text-danger')
        isAvailableLabel.classList.remove('text-success')
    }
}

// change modal specification
function createTramite(){
    let reqsTBody = document.querySelector('#reqsTbody');
    reqsTBody.innerHTML = ''
    document.querySelector('#FormTramite').reset();
    document.querySelector('#BtnSubmitTramite').innerHTML =  'Crear Trámite';
    document.querySelector('#staticBackdropLabel').innerHTML = 'Nuevo trámite';
    document.querySelector('#isAvailable').checked = true;
    const isAvailableLabel = document.querySelector('#label_IsAvailable');
    isAvailableLabel.classList.remove('text-danger')
    isAvailableLabel.classList.add('text-success')
    document.querySelector('#HasAviso').checked = false;
    document.querySelector('#avisoTextContainer').classList.add('d-none');
    $('#FormTramite').attr('action', './tramites');
    $('#FormTramite').attr('method', 'POST');
}

function removeTramite(){
    $('#tramiteTbody').on('click', ' .td_tramite_delete', function(){
        var tr = $(this).closest('tr');

        const del_id = this.id.split('_')[1];

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
              let deleteToken = $("meta[name='csrf-token']").attr("content");
              $.ajax({
                  // administrativo/tramites/
                url: './tramites/'+del_id,
                type: 'DELETE',
                data: {
                    "_token": deleteToken,
                    id: del_id
                },
                success: function(answer){
                    console.log('ajax answered')
                    if(answer == 1){
                        Swal.fire({title: 'El tramite ha sido eliminado correctamente', icon: 'success'});
                        tr.remove();
                    }else
                        Swal.fire({title: 'el tramite no se pudo eliminar', icon: 'warning'});
                }
              });
          }
        })
    });
}

// change modal specification to edit
function edit(tramite){
       // reset table
        let reqsTBody = document.querySelector('#reqsTbody');
        reqsTBody.innerHTML = '';

        // reqs rows
        __rowsRequirementsHTML(tramite['requerimientos'] )

        const btnSubmit = document.querySelector('#BtnSubmitTramite');
        btnSubmit.innerHTML = 'Actualizar Trámite';

        $('#nombre_tramite').val( tramite['nombre_tramite'] );
        $('#monto').val( tramite['monto'] );

        const isAvailable = document.querySelector('#isAvailable');
        const isAvailableLabel = document.querySelector('#label_IsAvailable');

        if(tramite['disponible']){
            isAvailable.checked = true;
            isAvailableLabel.classList.remove('text-danger');
            isAvailableLabel.classList.add('text-success');
        }else {
            isAvailable.checked = false;
            isAvailableLabel.classList.remove('text-success');
            isAvailableLabel.classList.add('text-danger');
        }

        let triggerAviso = tramite['aviso'];
        if(triggerAviso !=  'Sin aviso'){
            document.querySelector('#avisoTextContainer').classList.remove('d-none');
            document.querySelector('#avisoTextContainer').classList.add('d-flex');
            document.querySelector('#HasAviso').checked = true;
            $('#avisoContent').val( tramite['aviso'] );

        }else{
            document.querySelector('#HasAviso').checked = false;
            document.querySelector('#avisoTextContainer').classList.remove('d-flex');
            document.querySelector('#avisoTextContainer').classList.add('d-none');
        }

        tramite_id = tramite['id'];
        $('#FormTramite').attr('action', './tramites/'+tramite['id'] );
        $('#FormTramite').attr('method', 'PUT');
        $('#ModalTramiteForm').modal('show');
    // });

}

function aviso(tag)
{
    if(tag.checked){
        document.querySelector('#avisoTextContainer').classList.remove('d-none');
        document.querySelector('#avisoTextContainer').classList.add('d-flex');
    }else{
        document.querySelector('#avisoTextContainer').classList.remove('d-flex');
        document.querySelector('#avisoTextContainer').classList.add('d-none');
    }
}

function addRequeriment()
{
    const req = document.querySelector('#requerimientos');
    const reqsTbody = document.querySelector('#reqsTbody');

    if(req.value == ''){
        req.classList.add('is-invalid')
        return;
    }else req.classList.remove('is-invalid')

    const tr = document.createElement('tr');
    let index = 1;
    if(reqsTbody.children.length > 0)
        index = reqsTbody.children.length + 1;

    tr.id = `req_${index}`;

    const td1 = document.createElement('td');
    td1.innerText = req.value;

    // const td2 = document.createElement('td');
    // td2.innerHTML = `
    // <div class="form-check form-switch">
    //     <input class="form-check-input" name="IsVirtual" value="Si" type="checkbox" role="switch" id="IsVirtual">
    //     <label class="form-check-label" for="IsVirtual"> Virtual</label>
    // </div>`;

    const td3 = document.createElement('td');
    td3.classList.add('d-flex', 'justify-content-center', 'align-items-center');
    td3.classList.add('text-center')

    const a = document.createElement('a');
    a.classList.add('text-danger')
    a.addEventListener('click', function(){
        deleteRequeriment(index);
    })
    a.style = 'cursor: pointer;';

    const i = document.createElement('i');
    i.classList.add('fas', 'fa-trash');

    a.append(i);
    td3.append(a);

    // tr.append(td1,td2,td3);
    tr.append(td1,td3);
    reqsTbody.append(tr);
    req.value = '';

}

function deleteRequeriment(index)
{
    const target = document.querySelector(`#req_${index}`); //tr
    target.remove();
}

// $.ajax({
//     url: './addPayment2',
//     type: 'POST',
//     data: new FormData(this),
//     dataType: 'JSON',
//     contentType: false,
//     cache: false,
//     processData: false,
//     success: function(data){
//         if(data.answer == 1) {
//             cleanPayment();
//             modalPayment(invoice_id);
//             Swal.fire('Éxito', 'Pago registrado correctamente.', 'success');
//         }
//         else {
//             Swal.fire('Error', 'No es posible agregar una cantidad mayor a la del saldo pendiente.', 'error');
//         }
//     }
// })
