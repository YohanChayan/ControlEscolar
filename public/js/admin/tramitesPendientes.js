function loadingDT(data){
    document.querySelector('#containerTable').innerHTML = data;
    // document.querySelector('#TpendientesTbody').innerHTML = data;
    applyToolTips();

    // archivarTramite();
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
    // $(document).ready( function () {
    //     $('#Tpendientes').DataTable({
    //         'order': [
    //            [0, "desc"]
    //          ],
    //         'language':{
    //             'lengthMenu': 'Mostrar _MENU_ tramites pendientes',
    //             'zeroRecords': 'No exiten registros',
    //             'infoEmpty': 'Registros no disponibles',
    //             "sSearch": "Buscar:",
    //             "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    //             "infoFiltered": "(filtrados de _MAX_ total de registros)",
    //             "oPaginate": {
    //                 "sFirst": "Primero",
    //                 "sLast": "Último",
    //                 "sNext": "Siguiente",
    //                 "sPrevious": "Anterior"
    //             }
    //         }
    //     });
    // });
}

function seguimientoTramite(id)
{
    console.log(id);
    document.querySelector('#tramiteSeguimiento_id').value = id;
    document.querySelector('#seguimientoForm').submit();
}

function archivarTramite(ID)
{
        Swal.fire({
          title: '¿Estas seguro?',
          text: "Al aceptar éste trámite pasará a tramites archivados!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Archivar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
                window.location.href = `./archivarTramite/${ID}`
          }
        })
}



