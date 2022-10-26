
function showRequirements(tramites)
{
    const containerAccordion = document.querySelector('#accordionExample');
    containerAccordion.innerHTML = '';

    for (item of tramites) {

        const reqsArray = item.requerimientos.split('|');
        let accordion =
        `<div class="accordion-item">
            <h2 class="accordion-header" id="heading_${item.id}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${item.id}" aria-expanded="false" aria-controls="collapse${item.id}">
                    ${item.nombre_tramite}
                </button>
            </h2>
            <div id="collapse${item.id}" class="accordion-collapse collapse" aria-labelledby="heading_${item.id}" data-bs-parent="#accordionExample" style="">
                <div class="accordion-body">
                    <ul class="mt-4 list-group list-group-flush bg-light">`;

        let arrayFetchHTML = '';
        for (req of reqsArray) {
            let indicator = '';
            if(req[0] == '_')
                indicator = '(Entrega virtual)';

            arrayFetchHTML += `<li class="list-group-item bg-light">
                ${indicator} ${indicator == '' ? req: req.substring(1) }
            </li>`
        }
      arrayFetchHTML += `
                    </ul>
                </div>
            </div>
        </div>`;

        accordion += arrayFetchHTML;

        let converted_accordion = new DOMParser().parseFromString(accordion, 'text/html');
        containerAccordion.append(converted_accordion.body);
    }
    $('#reqsModal').modal('show');
}


function check_trNumbers()
{
    const t_name = document.querySelector('#nombre_tramite');

    if(t_name.value == '-' || t_name.value == ''){
        t_name.classList.add('is-invalid')
        return;
    }else
        t_name.classList.remove('is-invalid')

    if(t_name.value !== 'Constancia de no adeudo'){
        $.ajax({
            url: './check_tramites_numbers',
            type: 'POST',
            data: {
                _token:  $("meta[name='csrf-token']").attr("content"),
                tr_name: t_name.value
            },
            success: function(answer){

                if(answer >= 2){
                    Swal.fire({
                      title: '¿Estas seguro?',
                      text: `Usted ya posee ${answer} trámites solicitados, ¿esta seguro que desea continuar?`,
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Confirmar',
                      cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed){
                            document.querySelector('#formSolicitud').submit();
                        }
                    })
                }else{
                    document.querySelector('#formSolicitud').submit();
                }
            }
        })
    }else {
        document.querySelector('#formSolicitud').submit();
    }
}
