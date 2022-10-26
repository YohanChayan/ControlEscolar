function applyToolTips()
{
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}

// AJAX
function findUser()
{
    const inputValue = document.querySelector('#user_find');
    if (inputValue.value.length >= 3 ){ // limit to find
        const form = document.querySelector('#form_userFind');

        $.ajax({
           url: './usersFound',
           type: 'POST',
           data: {
               _token: $("meta[name='csrf-token']").attr("content"),
                user_value: inputValue.value
           },
           success: function(answer){
                document.querySelector('#TusersFoundTbody').innerHTML = answer.data;
                applyToolTips()
           }
        });

    }
}

// change to users view
function revokeAdmin(userID)
{
    Swal.fire({
      title: '¿Estas seguro?',
      text: "Al aceptar se le removerán los permisos de administrativo a este usuario!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Revocar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            url: './revokeAdmin',
            type: 'POST',
            data:{
                _token: $("meta[name='csrf-token']").attr("content"),
                user_id: userID
            },
            success: function(answer){
                console.log('ajax success')
                if(answer.say == 'Yes'){
                    console.log('answer is Yes')
                    let tr_delete = document.querySelector(`#tr_usr_${userID}`);
                    tr_delete.remove();
                    Swal.fire('Éxito', 'Permiso revocado exitosamente!', 'success');
                }else {
                    Swal.fire('Error', 'Usuario no encontrado!', 'warning');
                }

            }
        })
      }
    })

}
