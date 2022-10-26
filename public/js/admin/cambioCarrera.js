function loadingDT(data){
    document.querySelector('#containerTable').innerHTML = data;
    applyToolTips();
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
        $('#TcambioCarreras').DataTable({
            'order': [
               [0, "desc"]
             ],
            'language':{
                'lengthMenu': 'Mostrar _MENU_ solicitudes',
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

function allowChangeCareer(solicitudID)
{
    Swal.fire({
      title: '¿Estas seguro?',
      text: "Se cambiara la carrera actual por la nueva solicitada!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
          document.querySelector('#solicitudCambio_id').value = solicitudID;
          const form = document.querySelector('#AccionCambioCarrera');
          form.setAttribute('action', './permitir_cambioCarrera');
          form.submit();


      }
    })
}

function denyChangeCareer(solicitudID)
{
    Swal.fire({
      title: '¿Estas seguro?',
      text: "Se rechazará el cambio de carrera y se le notificará al estudiante!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
            document.querySelector('#solicitudCambio_id').value = solicitudID;
            const form = document.querySelector('#AccionCambioCarrera');
            form.setAttribute('action', './rechazar_cambioCarrera');
            form.submit();

      }
    })
}
