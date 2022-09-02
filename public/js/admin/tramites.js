
var alreadySended = false;
var tramite_id = -1;

function loadingDT(data){
    document.querySelector('#tramiteTbody').innerHTML = data;
}

// change modal specification to edit
function edit(tramite){
    const btnSubmit = document.querySelector('#BtnSubmitTramite');
    btnSubmit.innerHTML = 'Actualizar Trámite';

    $('#nombre_tramite').val( tramite['nombre_tramite'] );
    $('#monto').val( tramite['monto'] );
    $('#requerimientos').val( tramite['requerimientos'] );

    $('#FormTramite').attr('action', '/administrativo/tramites/'+tramite['id'] );
    $('#FormTramite').attr('method', 'PUT');

    $('#ModalTramiteForm').modal('show');
    tramite_id = tramite['id'];

}

function submitForm(){
    document.querySelector('#FormTramite').submit();
}

function submitTramite(){
    let indicatorError = 0;
    const nombre_tramite = $('#nombre_tramite');
    const monto = $('#monto');
    const requerimientos = $('#requerimientos');
    const methodForm = $('#FormTramite').attr('method');
    let formToken = $("meta[name='csrf-token']").attr("content");
        if(methodForm == 'POST'){
            $.ajax({
               url: './tramites',
               type: 'POST',
               data: {
                   '_token': formToken,
                   nombre_tramite: nombre_tramite.val(),
                   monto: monto.val(),
                   requerimientos: requerimientos.val()
               },
               success: function(data){
                    Swal.fire({
                        title: 'el tramite ha sido agredado exitosamente!',
                        icon: 'success'
                    });
                    loadingDT(data);

                    document.querySelector('#FormTramite').reset();
                    $("#ModalTramiteForm").modal("hide");

                }
            });


        }else if(methodForm == 'PUT'){
            $.ajax({
               url: './tramites/'+tramite_id,
               type: 'PUT',
               data: {
                   '_token': formToken,
                   'id': tramite_id,
                   nombre_tramite: nombre_tramite.val(),
                   monto: monto.val(),
                   requerimientos: requerimientos.val()
               },
               success: function(data){
                    Swal.fire({
                        title: 'el tramite ha sido actualizado exitosamente!',
                        icon: 'success'
                    })
                    loadingDT(data);
                    document.querySelector('#FormTramite').reset();
                    $("#ModalTramiteForm").modal("hide");
                }
            });
        }

    // }
}

// change modal specification
function createTramite(){
    document.querySelector('#FormTramite').reset();
    document.querySelector('#BtnSubmitTramite').innerHTML =  'Crear Trámite';
    document.querySelector('#staticBackdropLabel').innerHTML =  'Nuevo trámite';

    $('#FormTramite').attr('action', './tramites');
    $('#FormTramite').attr('method', 'POST');
}

function removeTramite(tr_id){

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
            url: './tramites/'+tr_id,
            type: 'DELETE',
            data: {
                "_token": deleteToken,
                id: tr_id
            },
            success: function(data){
                    Swal.fire({
                      title: 'El tramite ha sido eliminado correctamente',
                      icon: 'success'
                    })

                    loadingDT(data);
            }

          });

      }
    })

}


