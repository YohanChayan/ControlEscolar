function validateForm()
{
    const newCareer = document.querySelector('#new_career');
    let errorIndicator = 0;
    if(newCareer.value === ''){
        errorIndicator++;
        newCareer.classList.add('is-invalid');
    }
    else
        newCareer.classList.remove('is-invalid');


    return (errorIndicator == 0);
}

function submitNewCareer()
{
    if(!validateForm())
        return;

    Swal.fire({
      title: '¿Estas seguro?',
      text: "Antes de enviar valide su información, tanto la clave de carrera como el nombre de carrera!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
            document.querySelector('#newCareerForm').submit();
      }
    })
}
