@extends('layouts.app')

@section('content')

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-7">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Trámites generados por mes</h6>
                    <canvas id="line-chart" width="902" height="450" style="display: block; box-sizing: border-box; height: 225px; width: 451px;"></canvas>
                </div>
            </div>


           <div class="col-sm-12 col-xl-5">
               <div class="bg-light rounded h-100 p-4">
                   <h6 class="mb-4">Total de Trámites Solicitados</h6>
                   <canvas id="bar-chart" width="902" height="450" style="display: block; box-sizing: border-box; height: 225px; width: 451px;"></canvas>
               </div>
           </div>

        </div>
    </div>



    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Worldwide Sales</h6>
                        <a href="">Show All</a>
                    </div>
                    <canvas id="worldwide-sales" width="902" height="450" style="display: block; box-sizing: border-box; height: 225px; width: 451px;"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Salse &amp; Revenue</h6>
                        <a href="">Show All</a>
                    </div>
                    <canvas id="salse-revenue" width="902" height="450" style="display: block; box-sizing: border-box; height: 225px; width: 451px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}

@endsection

@section('my_scripts')

    <script src="{{asset('js/admin/charts.js')}}"></script>

    <script>

        const tramites_mes = @json($tramites_mes);
        const tramitesTotals = tramites_mes.map( tramite => tramite['Total'] );
        const arrayMonthsLabel = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

        // Single line
        var ctx3 = $("#line-chart").get(0).getContext("2d");
        var myChart3 = new Chart(ctx3, {
            type: "line",
            data: {
                labels: arrayMonthsLabel,
                datasets: [{
                    label: "Total de tramites",
                    fill: false,
                    backgroundColor: "rgba(0, 156, 255, .3)",
                    data: tramitesTotals
                }]
            },
            options: {
                responsive: true,
                plugins:{
                    tooltip:{
                        callbacks:{
                            // title: function(context){
                            //     return `Total: ${tramites_Totals[context[0].dataIndex]}`;
                            // },
                            afterBody: function(context){
                                return ` - Certificado Parcial de Estudio:  ${tramites_mes[context[0].dataIndex]['Certificado parcial de estudio']} \n - Certificado Total de Estudio:  ${tramites_mes[context[0].dataIndex]['Certificado total de estudio']} \n - Certificado de Graduado:  ${tramites_mes[context[0].dataIndex]['Certificado de graduado']} \n - Acta de titulacion:  ${tramites_mes[context[0].dataIndex]['Acta de titulacion']}`;
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


        const general_total_tramites = @json($general_total_tramites);
        const generalTotals = general_total_tramites.map( gt => gt['Total'] )
        console.log(general_total_tramites);

        // Single Bar Chart
        var ctx4 = $("#bar-chart").get(0).getContext("2d");
        var myChart4 = new Chart(ctx4, {
            type: "bar",
            data: {
                labels: ["#1", "#2", "#3", "#4"],
                datasets: [{
                    label: "Total de tramites",
                    backgroundColor: [
                        "rgba(0, 156, 255, .8)",
                        "rgba(0, 156, 255, .7)",
                        "rgba(0, 156, 255, .6)",
                        "rgba(0, 156, 255, .5)",

                        // "rgba(0, 156, 255, .4)",
                        // "rgba(0, 156, 255, .3)",
                        // "rgba(0, 156, 255, .3)",
                        // "rgba(0, 156, 255, .3)",
                        // "rgba(0, 156, 255, .3)",
                        // "rgba(0, 156, 255, .3)",
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
                                return ` - ${general_total_tramites[context[0].dataIndex]['tramite']['nombre_tramite']}: ${general_total_tramites[context[0].dataIndex]['Total']} `;
                            }
                        }
                    }
                }
            }
        });

    </script>

@endsection
