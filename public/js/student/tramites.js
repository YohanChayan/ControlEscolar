var target_tramite_reqs = '';

function applyToolTips()
{
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}

function applyDataTable()
{
  $('#TramitesPendientesTable').DataTable({
      'order': [
         [0, "desc"]
       ],
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
      }
  });
}


function preview(tramite)
{
    target_tramite_reqs = tramite.tramite.requerimientos;
    document.querySelector('#folioUnico').value = tramite.id;
    document.querySelector('#email').value = tramite.student.email;
    document.querySelector('#codigo').value = tramite.student.codigo;
    document.querySelector('#name').value = tramite.student.name;
    document.querySelector('#apellidos').value = tramite.student.apellidos;
    document.querySelector('#estatus').value = tramite.estatus;

    if(tramite.files){
        const docsEstatus = document.querySelector('#docsEstatus');
        docsEstatus.classList.remove('text-danger');
        docsEstatus.classList.add('text-success');
        docsEstatus.innerText = 'Entregados';
    }

    const containerEstatus = document.querySelector('#estatusContainer');
    const containerMotivo = document.querySelector('#motivoContainer');

    if(tramite.motivo && tramite.motivo != '')
    {
        document.querySelector('#motivo').value = tramite.motivo;

        containerEstatus.classList.remove('col-md-6', 'mx-auto');
        containerEstatus.classList.add('col-md-4');
        containerMotivo.classList.remove('d-none');
    }else {
        document.querySelector('#motivo').value = null;
        containerEstatus.classList.remove('col-md-4');
        containerEstatus.classList.add('col-md-6', 'mx-auto');
        containerMotivo.classList.add('d-none');
    }

    const filesInputContainer = document.querySelector('#filesContainer');

    if(tramite.tramite.modalidad != 'Presencial'){ //upload files
        filesInputContainer.classList.remove('d-none');
        document.querySelector('#documents').required = true;
    }else {
        filesInputContainer.classList.add('d-none');
        document.querySelector('#documents').required = false;
    }

    loadVirtualRequirements(tramite.tramite.requerimientos)


    if(tramite.requerimientos_asignados){
        const presencialReqs = tramite.requerimientos_asignados.split('|').filter(re => re.charAt(0) !== '_' );
        loadPresencialRequirements(presencialReqs);
    }else
        loadPresencialRequirements(['En espera']);

    $('#tramitePreviewModal').modal('show');
}

function loadPresencialRequirements(requerimientos)
{
    const html_ListsReqsPresencial = document.querySelector('#list_requirements_presencial');
    if(requerimientos.length == 0){
        document.querySelector('#container_list_requirements_presencial').classList.add('d-none');
    }else
        document.querySelector('#container_list_requirements_presencial').classList.remove('d-none');


    html_ListsReqsPresencial.innerHTML = '';

    for (item of requerimientos) {
        const li = document.createElement('li');
        li.classList.add('text-secondary')
        li.innerText = item;
        html_ListsReqsPresencial.append(li);
    }
    // if()
}

function loadVirtualRequirements(requerimientos)
{
    const arrayReqs = requerimientos.split('|');
    const lists = document.querySelector('#list_requirements_files');
    lists.innerHTML = '';

    for (item of arrayReqs) {
        const indicator = item[0];
        if(indicator == '_'){
            const li = document.createElement('li');
            li.classList.add('text-secondary');
            li.innerText = item.substring(1);
            lists.append(li);
        }
    }

}

function validateDocuments()
{
    // cantidad de requirements;
    const docs = document.querySelector('#documents');
    console.log('target_tramite_reqs: ')
    const virtualReqs = target_tramite_reqs.split('|').filter( tr => tr[0] == '_' ).length;

    if(docs.files.length == 0)
    {
        docs.classList.add('is-invalid');
        return false;
    }

    const error_cantidad_files = document.querySelector('#error_cantidad_files');
    if(docs.files.length < virtualReqs){
        error_cantidad_files.innerText = `Se requiere subir ${virtualReqs} archivos.`;
        error_cantidad_files.classList.remove('d-none');
        error_cantidad_files.classList.add('d-block');
        return false;
    }

    error_cantidad_files.classList.remove('d-block');
    error_cantidad_files.classList.add('d-none');
    docs.classList.remove('is-invalid');
    return true;
}

function uploadDocuments()
{
    if(!validateDocuments())
        return;
    const form = document.querySelector('#formUploadDocuments');

    $.ajax({
        url: './estudiante/tramites/upload',
        type: 'POST',
        data: new FormData(form),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function(answer){

            if(answer.say == 'yes'){
                Swal.fire('Éxito', answer.message, 'success');
                const docsEstatus = document.querySelector('#docsEstatus');
                docsEstatus.innerText = 'Entregados';
                docsEstatus.classList.remove('text-danger')
                docsEstatus.classList.add('text-success')
                $('#tramitePreviewModal').modal('hide');

            }


        }
    });
}


// get_docAdeudo(id)
// {
//
// }
