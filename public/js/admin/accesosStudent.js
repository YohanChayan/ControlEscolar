var DT = '';

function loadingDT(data){
    document.querySelector('#StudentTableContainer').innerHTML = data;
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
        DT = $('#StudentTable').DataTable({
            'language':{
                'lengthMenu': 'Mostrar _MENU_ estudiantes',
                'zeroRecords': 'No exiten estudiantes',
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

function grantAccessStudent()
{
    Swal.fire({
      title: '¿Estas seguro?',
      text: "Al aceptar el usuario podrá acceder a las funcionalidades de estudiante!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Otorgar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
         document.querySelector('#form_userAccess').submit();
      }
    })
}

function previewStudent(student) {

    document.querySelector('#st_identifier').value = student.id;
    document.querySelector('#user_id').value = student.id;

    document.querySelector('#student_name_isWrong').classList.add('d-none');
    document.querySelector('#student_apellidos_isWrong').classList.add('d-none');
    document.querySelector('#student_email_isWrong').classList.add('d-none');
    document.querySelector('#student_cicloAdmision_isWrong').classList.add('d-none');
    document.querySelector('#student_codigo_isWrong').classList.add('d-none');
    document.querySelector('#student_carrera_isWrong').classList.add('d-none');

    document.querySelector('#student_name').value = student.name;
    document.querySelector('#student_apellidos').value = student.apellidos;
    document.querySelector('#student_email').value = student.email;
    document.querySelector('#student_cicloAdmision').value = student.ciclo_admision;
    document.querySelector('#student_codigo').value = student.codigo;
    document.querySelector('#student_carrera').value = student.clave_carrera + ' - ' + student.nombre_carrera;
    document.querySelector('#BtnActionStudent').onclick = function() {grantAccessStudent()};
    document.querySelector('#BtnActionStudent').classList.remove('btn-danger');
    document.querySelector('#BtnActionStudent').classList.add('btn-success');
    document.querySelector('#BtnActionStudent').innerHTML = 'Otorgar acceso <i class="fas fa-key mx-2"></i>'

    document.querySelector('#selecccione_Wrongs_container').classList.add('d-none');


    document.querySelector('#cancelEditError').classList.add('d-none');

    $('#StudentPreviewModal').modal('show');
}

function edit_revokeStudent()
{
    // const st_id = document.querySelector('#st_identifier').value;
    document.querySelector('#selecccione_Wrongs_container').classList.remove('d-none');

    document.querySelector('#student_name_isWrong').classList.remove('d-none');
    document.querySelector('#student_apellidos_isWrong').classList.remove('d-none');
    document.querySelector('#student_email_isWrong').classList.remove('d-none');
    document.querySelector('#student_cicloAdmision_isWrong').classList.remove('d-none');
    document.querySelector('#student_codigo_isWrong').classList.remove('d-none');
    document.querySelector('#student_carrera_isWrong').classList.remove('d-none');
    document.querySelector('#cancelEditError').classList.remove('d-none');

    document.querySelector('#BtnActionStudent').classList.remove('btn-success');
    document.querySelector('#BtnActionStudent').classList.add('btn-danger');
    document.querySelector('#BtnActionStudent').innerText = 'Notificar';

    document.querySelector('#BtnActionStudent').onclick = function() {notifyErrorStudent()};

}

function cancel_edit_revokeStudent()
{
    document.querySelector('#selecccione_Wrongs_container').classList.add('d-none');
    document.querySelector('#student_name_isWrong').classList.add('d-none');
    document.querySelector('#student_apellidos_isWrong').classList.add('d-none');
    document.querySelector('#student_email_isWrong').classList.add('d-none');
    document.querySelector('#student_cicloAdmision_isWrong').classList.add('d-none');
    document.querySelector('#student_codigo_isWrong').classList.add('d-none');
    document.querySelector('#student_carrera_isWrong').classList.add('d-none');
    document.querySelector('#cancelEditError').classList.add('d-none');

    document.querySelector('#BtnActionStudent').classList.add('btn-success');
    document.querySelector('#BtnActionStudent').classList.remove('btn-danger');
    document.querySelector('#BtnActionStudent').innerHTML = 'Otorgar acceso <i class="fas fa-key mx-2"></i>';

    document.querySelector('#BtnActionStudent').onclick = function() {grantAccessStudent(document.querySelector('#st_identifier').value)};
}

function notifyErrorStudent(studentID)
{
    Swal.fire({
      title: '¿Estas seguro que desea notificar?',
      text: "Al aceptar el usuario deberá cambiar los campos que fueron seleccionados!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Notificar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
          document.querySelector('#user_id').value = studentID;
          document.querySelector('#formPreviewStudent').submit();
    }
  })
}
