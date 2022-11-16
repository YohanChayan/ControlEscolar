function rm_myself()
{
    console.log('remove my self')
    Swal.fire({
      title: '¿Estás seguro?',
      text: 'En caso de haber tenido problemas con la verificación su correo puede eliminar su cuenta y volver a registrarse!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {

        Swal.fire({
          title: '¿Estas seguro?',
          text: '',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Eliminar mi cuenta',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {

            document.querySelector('#rm_myself-form').submit();

          }
        })

      }
    })

}
