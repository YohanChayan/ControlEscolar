function loadingDT(data)
{
    document.querySelector('#TRechazadosTbody').innerHTML = data;
}

function filterDate(inputTarget){

    initial = document.querySelector('#fecha_inicial').value;
    final = document.querySelector('#fecha_final').value;

    if(initial && final){

        $.ajax({
            url: './filterRechazados',
            type: 'POST',
            data: new FormData(document.querySelector('#formDateFilter') ),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(answer){
                if(answer.say == 'yes') {
                    loadingDT(answer.data);
                }
                else {
                    Swal.fire('Error', 'Asegurese de colocar las fechas correspondientes', 'error');
                }
            }
        })


    }
}
