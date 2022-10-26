// function loadingSpinner()
// {
//     const spinner = document.createElement('div');
//     spinner.classList.add('spinner-border', 'text-primary');
//     spinner.setAttribute('role' , 'estatus');
//     spinner.id = 'waiting_chart_spinner';
//     const spinner_span = document.createElement('span');
//     spinner_span.classList.add('visually-hidden')
//     spinner_span.innerText = 'Cargando...';
//     spinner.append(spinner_span);
//
//     document.querySelector('#tramites_mesContainer').prepend(spinner);
// }

var alreadyLoaded = {
    'tramites_mes': false,
    'top_tramites': false,
    'summary_tramites': false,
    'tramites_perCareer': false
};

function switchChart(tagID)
{
    const contentTarget = $(`#${tagID}`).attr('data-bs-target');
    if(alreadyLoaded[contentTarget.slice(1)] ){
        return; //already loaded chart
    }else
        alreadyLoaded[contentTarget.slice(1)] = true;

    $.ajax({
       url: './getChart',
       type: 'POST',
       data: {
           _token: $("meta[name='csrf-token']").attr("content"),
           'chart_indetifier': tagID
           },
       success: function(answer){
            $(document).ready(function(){
                if(answer.type == 'tramites_mes')
                    load_chart_TramitesMonths(answer.dataChart);
                else if(answer.type == 'top_tramites')
                    load_chart_topTramites(answer.dataChart);
                else if(answer.type == 'summary_tramites')
                    load_chart_summaryTramites(answer.dataChart);
                else if(answer.type == 'tramites_perCareer'){
                    load_chart_tramitesPerCareer(answer.dataChart);
                }
            });
       }
    });
}

function load_chart_TramitesMonths(data)
{
    const tramitesTotals = data.map( tramite => tramite['Total'] );
    const arrayMonthsLabel = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

    const indexes = Object.getOwnPropertyNames(data[0]); //only indexes
    console.log(indexes);

    // for (item of indexes) {
    //     console.log(item)
    // }

    // Single line
    var ctx1 = $("#tramites_mes_chart").get(0).getContext("2d");
    var myChart1 = new Chart(ctx1, {
        type: "line",
        data: {
            labels: arrayMonthsLabel,
            datasets: [{
                label: "Total de tramites",
                fill: true,
                backgroundColor: "rgba(0, 156, 255, .2)",
                data: tramitesTotals
            }]
        },
        options: {
            responsive: true,
            plugins:{
                tooltip:{
                    callbacks:{
                        afterBody: function(context){
                            let str = '';
                            for (item of indexes) {
                                if(item != 'Total'){
                                    str += ` \n - ${item}: ${data[context[0].dataIndex][item]}`
                                }
                            }
                            return str;
                        }
                    }
                }
            }
        },
        scales: {
            y:{
                beginAtZero: true
            }
        }
    });
}

function load_chart_topTramites(data)
{
    const generalTotals = data.map( gt => gt['Total'] )
    let index = 1;
    const labels = data.map( gt => `#${index++}`);

    var ctx2 = $("#top_tramites_chart").get(0).getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Total de tramites",
                backgroundColor: [
                    "rgba(0, 156, 255, .8)",
                ],
                data: generalTotals
            }]
        },
        options: {
            responsive: true,
            plugins:{
                tooltip:{
                    callbacks:{
                        footer: function(context){
                            return ` - ${data[context[0].dataIndex]['tramite']['nombre_tramite']}: ${data[context[0].dataIndex]['Total']} `;
                        }
                    }
                }
            }
        }
    });

}

function load_chart_summaryTramites(data)
{
    // Single Bar Chart
     console.log(data)
    var ctx3 = $("#summary_tramites_chart").get(0).getContext("2d");
    var myChart3 = new Chart(ctx3, {
        type: "bar",
        data: {
            labels: ['Pendientes', 'Finalizados', 'Archivados' , 'Rechazados'],
            datasets: [{
                label: "Resumen de trámites",
                backgroundColor: [
                    "rgba(0, 156, 255, .8)",
                    "rgba(0, 156, 255, .7)",
                    "rgba(0, 156, 255, .6)",
                    "rgba(0, 156, 255, .5)",
                ],
                data: [
                    (data[0] ? data[0]['Total']: 0),
                    (data[1] ? data[1]['Total']: 0),
                    (data[2] ? data[2]['Total']: 0),
                    (data[3] ? data[3]['Total']: 0)
                ]
            }]
        },
        options: {
            responsive: true
        }
    });
}

function load_chart_tramitesPerCareer(data)
{
    const careersNames = data.map( item => item[0] );
    let index = 1;
    const labels = data.map( item => `#${index++}` );
    const totals = data.map( item => item[1] );

    var ctx4 = $("#tramites_perCareer_chart").get(0).getContext("2d");
    var myChart4 = new Chart(ctx4, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Trámites Solicitados por Carrera",
                backgroundColor: ['rgba(0, 156, 255, .8)'],
                data: totals
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                yAxes: {
                  position: 'top',
                  ticks: {
                      stepSize: 1
                  }
                }
              },
            plugins:{
                tooltip:{
                    callbacks:{
                        title: function(context){
                            return `${careersNames[context[0].dataIndex]}: ${totals[context[0].dataIndex]}`;
                        }
                    }
                }
            }
        }

    });

}
