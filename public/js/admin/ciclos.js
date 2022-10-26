function loadingDT(data)
{
    document.querySelector('#TciclosTbody').innerHTML = data;
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
        $('#Tciclos').DataTable({
            'order': [
               [0, "desc"]
             ],
            'language':{
                'lengthMenu': 'Mostrar _MENU_ ciclos escolares',
                'zeroRecords': 'No exiten registros',
                'infoEmpty': 'Registros no disponibles',
                "sSearch": "Buscar: ",
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


function validateForm()
{
    let indicatorError = 0;
    const anio = document.querySelector('#anio');
    const ciclo = document.querySelector('#ciclo');
    const matricula = document.querySelector('#matricula');

    if(anio.value == '-'){
        anio.classList.add('is-invalid');
        indicatorError++;
    }else
        anio.classList.remove('is-invalid');

    if(ciclo.value == '-'){
        ciclo.classList.add('is-invalid');
        indicatorError++;
    }else
        ciclo.classList.remove('is-invalid');

    if(matricula.value == ''){
        matricula.classList.add('is-invalid');
        indicatorError++;
    }else
        matricula.classList.remove('is-invalid');

    return (indicatorError == 0);
}

function submitCiclo()
{
    if(!validateForm())
        return;

    Swal.fire({
      title: '¿Estas seguro?',
      text: "Recuerde que una vez creado éste será activado!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Establecer',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed){

            const anio = document.querySelector('#anio').value;
            const ciclo = document.querySelector('#ciclo').value;
            const matricula = document.querySelector('#matricula').value;

          $.ajax({
              url: './ciclos',
              type: 'POST',
              data:{
                  _token: $("meta[name='csrf-token']").attr("content"),
                  anio: anio,
                  ciclo: ciclo,
                  matricula: matricula
              },
              success: function(answer) {
                  if(answer.say == 'Yes'){
                        Swal.fire(answer.message, '' , 'success');
                        loadingDT(answer.data);
                        document.querySelector('#current_ciclo_value').innerText = answer.newCiclo.semestre;
                  }

                  if(answer.say == 'No'){
                        Swal.fire(answer.message, '', 'warning');
                  }
              }

          });

      }
    })
}

function edit(cicloID, matricula )
{
    document.querySelector('#edit_matricula').value = matricula;
    document.querySelector('#cicloID').value = cicloID;

    $('#ModalCiclo').modal('show');
}

function remove_fromCiclo(id)
{
    Swal.fire({
      title: '¿Estas seguro?',
      text: "Al eliminar el ciclo, automaticamente se reactiva el ciclo anterior!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed){
          $.ajax({
              url: './ciclos/' + id,
              type: 'DELETE',
              data:{
                  _token: $("meta[name='csrf-token']").attr("content"),
                  id: id
              },
              success: function(answer) {
                    if(answer.say == 'Yes'){
                        let tr_remove = document.querySelector(`#tr_ciclo_${id}`);
                        tr_remove.remove();

                        // navbar2 live update
                        document.querySelector('#current_ciclo_value').innerText = answer.oldCiclo.semestre;
                        document.querySelector(`#tr_ciclo_${answer.oldCiclo.id}`).classList.add('table-primary');
                        Swal.fire('Exito', 'Ciclo eliminado correctamente!' , 'success');
                    }
                    else {
                        Swal.fire('Error', 'Ciclo no encontrado!' , 'warning');
                    }
              }
          });
      }
    })
}


function updateMatricula()
{
    const matricula = document.querySelector('#edit_matricula').value;
    const cicloID = document.querySelector('#cicloID').value;
    $.ajax({
          url: './ciclos/' + cicloID,
          type: 'PUT',
          data:{
              _token: $("meta[name='csrf-token']").attr("content"),
              id: cicloID,
              matricula: matricula
          },
          success: function(answer) {
                if(answer.say == 'Yes'){
                    let tr_update = document.querySelector(`#tr_ciclo_${cicloID}`);
                    tr_update.children[1].innerText = `$${answer.updatedCiclo.matricula}`;
                    $('#ModalCiclo').modal('hide');
                    Swal.fire('Exito', 'Matricula actualizada correctamente!' , 'success');
                }
                else {
                    Swal.fire('Error', 'Ciclo no encontrado!' , 'warning');
                }
          }
      });
}

