// when page loaded, load estatus and motivo

function changeStatus()
{
    const currentStatus = document.querySelector('#estatus_tramite').value;
    const especificacionContainer = document.querySelector('#especificacionContainer');
    const errorTypeContainer = document.querySelector('#errorTypeContainer');
    if(currentStatus == 'Recepción de trámite rechazado en CE' || currentStatus == 'Retención' || currentStatus == 'Error en la fecha'){
        especificacionContainer.classList.remove('d-none');
        errorTypeContainer.classList.remove('d-none');
    }
    else{
        especificacionContainer.classList.add('d-none');
        errorTypeContainer.classList.add('d-none');
    }
}

function submitSeguimiento()
{
    let remove_total_a_pagar = document.querySelector('#total_a_pagar');
      if(remove_total_a_pagar)
        remove_total_a_pagar.remove();

    const error = document.querySelector('#errorType');
    const especificacion = document.querySelector('#errordetail');
    const estatus = document.querySelector('#estatus_tramite');
    const motivo = document.querySelector('#motivo');

    const selected_reqs = document.querySelector('#selected_reqs');
    selected_reqs.value = '';
    const lists_reqs = document.querySelectorAll('#news_reqs_selected li input');

    for (itemReq of lists_reqs) {
        if(itemReq.checked){
            selected_reqs.value += `${itemReq.value}|` ;
        }
    }
    selected_reqs.value = selected_reqs.value.slice(0, -1);

    if(estatus.value !== 'Recibido')
        if(!validateAssignedReqs())
            return;




    let answer = null;
    if(error.value == '-' || estatus_tramite.value != 'Recepción de trámite rechazado en CE' && estatus_tramite.value != 'Retención')
        answer = null;
    else {
        answer = error.value;
        if(especificacion.value != '')
            answer += ' - '+especificacion.value;
    }

    motivo.value = answer;
    console.log(motivo)
    document.querySelector('#formSeguimiento').submit();
}

function motivo(motivo)
{
    console.log(motivo);
    if(!motivo || motivo === 'Usted no posee Adeudo')
        return;

   let array = motivo.split('-');

   const selectErrorType = document.querySelector('#errorType');
   let errorType = array[0].trim();

   if(array.length > 1){
       let detail = array[1].trim();
       const errorDetail = document.querySelector('#errordetail');

       for (option of selectErrorType.children) {
           if(option.innerText.trim() == errorType || option.value.trim() == errorType){
               option.selected = true;
               break;
           }
       }
       errorDetail.value = detail;
   }else {
       for (option of selectErrorType.children) {
          if(option.innerText.trim() == errorType || option.value.trim() == errorType){
              option.selected = true;
              break;
          }
      }
   }
}

function previewDocuments(docsAssets)
{
    if(!docsAssets)
        return;

    let index = 1;

    const accordionContainer = document.querySelector('#accordionExample');
    accordionContainer.innerHTML = '';
    for (itemAsset of docsAssets) {

        const splitURL = itemAsset.split('/');
        const nameFile = splitURL[splitURL.length - 1];
        let accordion =
        `
        <div class="accordion-item my-2">
            <h2 class="accordion-header" id="heading_${index}">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_${index}" aria-expanded="false" aria-controls="collapse_${index}">
                <span class="fw-bold">${nameFile} </span>
              </button>
            </h2>
            <div id="collapse_${index}" class="accordion-collapse collapse" aria-labelledby="heading_${index}" data-bs-parent="#accordionExample" style="">
              <div class="accordion-body">
                <embed src="${itemAsset}" type="application/pdf" width="100%" height="550px">
              </div>
            </div>
          </div>
        `;

        let converted_accordion = new DOMParser().parseFromString(accordion, 'text/html');

        accordionContainer.append(converted_accordion.body);

        index++;
    }
    $('#FilesModal').modal('show');
}

function isThereFiles()
{
    const spanText = document.querySelector('#docsNews');
    if(!spanText)
        return;

    if(!assets){ // no files
        spanText.classList.remove('text-success');
        spanText.classList.add('text-danger');
        spanText.innerText = 'No existen Archivos';
        document.querySelector('#btnModalFiles').disabled = true;
    }else {
        spanText.classList.remove('text-danger');
        spanText.classList.add('text-success');
        spanText.innerText = 'Existen Archivos';

    }

}

var TR_monto = 0;
function launch_matriculasModal(monto)
{
    if(!validateAssignedReqs())
        return;

    TR_monto = monto;
    document.querySelector('#matriculas_TBody').innerHTML = '';
    document.querySelector('#matriculas_pendientes').value = '';
    document.querySelector('#matriculas_total').value = '';
    document.querySelector('#ultimo_pago').value = '';

    $('#NoAdeudoModal').modal('show');
}

// Constancia No adeudo
function calcular_matriculas(){

    // validate
    const input_ultimoPago = document.querySelector('#ultimo_pago');

    if(input_ultimoPago.value == '' ||  input_ultimoPago.value.length > 5){
        input_ultimoPago.classList.add('is-invalid');
        return;
    }else
        input_ultimoPago.classList.remove('is-invalid');

    $.ajax({
          url: './matriculasPendientes',
          type: 'POST',
          data:{
              _token: $("meta[name='csrf-token']").attr("content"),
              semester_initial: input_ultimoPago.value,
              monto: TR_monto,
          },
          success: function(answer) {
                if(answer.say == 'Yes'){

                    const matriculas_TBody = document.querySelector('#matriculas_TBody');
                    matriculas_TBody.innerHTML = '';
                    document.querySelector('#matriculas_pendientes').value = answer.count;
                    document.querySelector('#matriculas_total').value = `$${answer.total}`;

                    for (item of answer.matriculas) {
                        const tr = document.createElement('tr');
                        const td1 = document.createElement('td');
                        td1.innerText = item[0];
                        const td2 = document.createElement('td');
                        td2.innerText = item[1];
                        tr.append(td1,td2);
                        matriculas_TBody.append(tr);
                    }
                    const tr_arancel = document.createElement('tr');
                    tr_arancel.classList.add('mt-4', 'table-primary', 'border-top');
                    const td1_arancel = document.createElement('td');
                    const span_td1_arancel = document.createElement('span');
                    span_td1_arancel.classList.add('fw-bold', 'text-secondary');
                    span_td1_arancel.innerText = 'Arancel';
                    td1_arancel.append(span_td1_arancel);

                    const td2_arancel = document.createElement('td');
                    const span_td2_arancel = document.createElement('span');
                    span_td2_arancel.classList.add('fw-bold', 'text-secondary');
                    span_td2_arancel.innerText = `+ $${TR_monto}`;
                    td2_arancel.append(span_td2_arancel);

                    tr_arancel.append(td1_arancel,td2_arancel);
                    matriculas_TBody.append(tr_arancel);


                    const tr_total = document.createElement('tr');
                    tr_total.classList.add('border-top', 'table-success');
                    const td_total = document.createElement('td');
                    td_total.setAttribute('colspan', '2');
                    const td_total_span = document.createElement('span');
                    td_total_span.classList.add('fw-bold');
                    td_total_span.innerText = 'Total = $';

                    const td_total_span_span = document.createElement('span');
                    td_total_span_span.id = 'td_total';
                    td_total_span_span.innerText = answer.total;

                    td_total_span.append(td_total_span_span);

                    td_total.append(td_total_span);
                    tr_total.append(td_total);
                    matriculas_TBody.append(tr_total);

                }

          }
      });
}

function noAdeudo()
{
    Swal.fire({
      title: '¿Estas seguro?',
      text: "Al aceptar el tramite se marcará como listo para entrega!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
          document.querySelector('#estatus_tramite').value = 'Listo para entrega';
          document.querySelector('#motivo').value = '';
          let remove_total_a_pagar = document.querySelector('#total_a_pagar');
          if(remove_total_a_pagar)
            remove_total_a_pagar.remove();
          // document.querySelector('#formSeguimiento').submit();
          submitSeguimiento();
      }
    })
}

function asignar_adeudo(){
    const matriculas_TBody = document.querySelector('#matriculas_TBody');

    if(matriculas_TBody.children.length == 0){
        document.querySelector('#ultimo_pago').classList.add('is-invalid');
        return;
    }
    else
        document.querySelector('#ultimo_pago').classList.remove('is-invalid');

    document.querySelector('#estatus_tramite').value = 'Retención';
    document.querySelector('#motivo').value = 'La orden de pago se ha generado y debe ser pagada';

    const total_input = document.createElement('input');
    total_input.setAttribute('type', 'hidden');
    total_input.setAttribute('name', 'total_a_pagar');
    total_input.value = document.querySelector('#td_total').innerText;
    total_input.id = 'total_a_pagar';
    document.querySelector('#formSeguimiento').append(total_input);


    const selected_reqs = document.querySelector('#selected_reqs');
    selected_reqs.value = '';
    const lists_reqs = document.querySelectorAll('#news_reqs_selected li input');

    for (itemReq of lists_reqs) {
        if(itemReq.checked){
            selected_reqs.value += `${itemReq.value}|` ;
        }
    }

    selected_reqs.value = selected_reqs.value.slice(0, -1);

    document.querySelector('#formSeguimiento').submit();

    // submitSeguimiento();
}

function check_reqs_selected(assignedReqs)
{
    if(!assignedReqs)
        return;

    let array_assignedReqs = assignedReqs.split('|');
    array_assignedReqs  = array_assignedReqs.map( item => item.trim());

    const lists_reqs_news = document.querySelectorAll('#news_reqs_selected li input');
    console.log(lists_reqs_news)

    for (itemList of lists_reqs_news) {
        if(array_assignedReqs.includes(itemList.value.trim()))
            itemList.checked = true;

    }

}

function validateAssignedReqs()
{
    const lists_reqs_news = document.querySelectorAll('#news_reqs_selected li input');

    for (itemList of lists_reqs_news) {
        if(itemList.checked)
            return true; //at least one was checked
    }
    Swal.fire({title: 'Por lo menos debe asignar un requerimiento al estudiante!', icon: 'error'});
    return false;
}

function No_reqs()
{
    const check_noReqs = document.querySelector('#check_noReqs');

    if(check_noReqs.checked){
        const lists_reqs_news = document.querySelectorAll('#news_reqs_selected li input');
        for (itemList of lists_reqs_news) {
            if(itemList.value != 'No necesita requerimientos')
                itemList.checked = false
        }
    }
}

function getDocument_noAdeudo()
{
    document.querySelector('#doc_noAdeudoForm').submit();
}
