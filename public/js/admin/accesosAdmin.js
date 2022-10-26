var DT = '';
function loadingDT(data){
    document.querySelector('#containerTable').innerHTML = data;
    // document.querySelector('#adminAccess_Tbody').innerHTML = data;
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
        DT = $('#AdminTable').DataTable({
            'language':{
                'lengthMenu': 'Mostrar _MENU_ usuarios',
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


function removeAdmin(userID)
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
              $.ajax({
                url: './userAccess/'+userID,
                type: 'DELETE',
                data: {
                    '_token': $("meta[name='csrf-token']").attr("content"),
                    'userID': userID
                },
                success: function(answer){
                    if(answer.say == 'yes'){
                        loadingDT(answer.data)
                        applyDataTable()
                        Swal.fire({ title: 'Usuario eliminado correctamente', icon: 'success' });
                    }else {
                        Swal.fire({ title: 'No se pudo eliminar usuario!', icon: 'warning'});
                    }
                }
              });
          }
        })
}

function grantAdmin(userID)
{
        Swal.fire({
          title: '¿Estas seguro?',
          text: "Al aceptar el usuario podrá acceder a las funcionalidades de los administrativos!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Otorgar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {

            $('#form_userAccess').attr('method', 'POST');

            $.ajax({
                url: './grantAdmin',
                type: 'POST',
                data: {
                    '_token': $("meta[name='csrf-token']").attr("content"),
                    'user_id': userID
                    },
                success: function(answer){
                    console.log(answer);
                    if(answer.say == 'yes'){
                        loadingDT(answer.data)
                        applyDataTable()
                        Swal.fire({ title: 'Permiso otorgado correctamente!', icon: 'success' });
                    }else {
                        Swal.fire({ title: 'No se pudo otorgar acceso!', icon: 'warning' });
                    }
                }
            })
          }
        })
}
