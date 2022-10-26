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
    $(document).ready( function () {
        $('#Tarchivados').DataTable({
            'language':{
                'lengthMenu': 'Mostrar _MENU_ tramites pendientes',
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
    });
}


function desarchivar_tramite(id)
{
    document.querySelector('#desarchivar_tramite_id').value = id;
    Swal.fire({
      title: '¿Estas seguro?',
      text: "Al aceptar éste trámite pasará a tramites pendientes!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Desarchivar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            url: './dearchivarTramite',
            type: 'POST',
            data: new FormData( document.querySelector('#desarchivar_form') ),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(answer){

                loadingDT(answer.data);
                applyDataTable()

                Swal.fire({
                    title: 'Trámite dearchivado exitosamente!',
                    icon: 'success'
                });
            }
        });
      }
    })
}
