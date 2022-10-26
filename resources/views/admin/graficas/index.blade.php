@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/admin/myCharts.js')}}"></script>

    {{-- <script>
        load_chart_TramitesMonths(@json($tramites_mes));
        load_chart_TramitesGeneral(@json($general_total_tramites));
    </script> --}}
@endsection

@section('content')

<div class="container-fluid pt-4 px-4">

    <form method="POST">
        @csrf
    </form>

    <ul class="nav nav-tabs p-3" id="myTab" role="tablist">

      <li class="nav-item me-4" role="presentation">
        <button class="nav-link active" id="seleccione-tab" data-bs-toggle="tab" data-bs-target="#seleccione" type="button" role="tab" aria-controls="seleccione" aria-selected="true"> - </button>
      </li>

      <li class="nav-item ms-4" role="presentation">
        <button onclick="switchChart(this.id)" class="nav-link" id="tramites_mes-tab" data-bs-toggle="tab" data-bs-target="#tramites_mes" type="button" role="tab" aria-controls="tramites_mes" aria-selected="true">Tramites generados por meses</button>
      </li>
      <li class="nav-item" role="presentation">
        <button onclick="switchChart(this.id)" class="nav-link" id="top_tramites-tab" data-bs-toggle="tab" data-bs-target="#top_tramites" type="button" role="tab" aria-controls="top_tramites" aria-selected="false">TOP Tramites mas solicitados</button>
      </li>
      <li class="nav-item" role="presentation">
        <button onclick="switchChart(this.id)" class="nav-link" id="summary_tramites-tab" data-bs-toggle="tab" data-bs-target="#summary_tramites" type="button" role="tab" aria-controls="summary_tramites" aria-selected="false">Resumen de trámites</button>
      </li>

      <li class="nav-item" role="presentation">
        <button onclick="switchChart(this.id)" class="nav-link" id="tramites_perCareer-tab" data-bs-toggle="tab" data-bs-target="#tramites_perCareer" type="button" role="tab" aria-controls="tramites_perCareer" aria-selected="false">Trámites por carrera</button>
      </li>

    </ul>


    <div class="tab-content bg-light p-3" id="myTabContent">

      <div class="tab-pane fade show active" id="seleccione" role="tabpanel" aria-labelledby="seleccione-tab">
        <p class="fs-3 text-secondary text-center mt-2">Seleccione una gráfica de preferencia</p>
      </div>

      <div class="tab-pane fade" id="tramites_mes" role="tabpanel" aria-labelledby="tramites_mes-tab">
      {{--  --}}
        <div class="container-fluid pt-4 px-4">
            <div class="col-sm-12 col-xl-10 mx-auto">
                <div class="bg-light rounded h-100 p-4 text-center" id="tramites_mesContainer">

                    <h6 class="display-5 text-secondary fw-bold text-center">Trámites generados por mes</h6>
                    <canvas id="tramites_mes_chart"></canvas>
                </div>
            </div>
        </div>


      </div>
      <div class="tab-pane fade" id="top_tramites" role="tabpanel" aria-labelledby="top_tramites-tab">
      {{--  --}}
        <div class="container-fluid pt-4 px-4">
            <div class="col-sm-12 col-xl-10 mx-auto">
                   <div class="bg-light rounded h-100 p-4" id="top_tramitesContainer">
                       <h6 class="display-5 text-secondary fw-bold text-center">TOP Trámites Solicitados</h6>
                       <canvas id="top_tramites_chart"></canvas>
                   </div>
               </div>
        </div>
      </div>

      <div class="tab-pane fade" id="summary_tramites" role="tabpanel" aria-labelledby="summary_tramites-tab">
        <div class="container-fluid pt-4 px-4">
            <div class="col-sm-12 col-xl-10 mx-auto">
                   <div class="bg-light rounded h-100 p-4" id="">
                       <h6 class="display-5 text-secondary fw-bold text-center"> Resumen de trámites en {{Carbon\Carbon::now()->format('Y')}} </h6>
                       <canvas id="summary_tramites_chart"></canvas>
                   </div>
               </div>
        </div>
      </div>

      <div class="tab-pane fade" id="tramites_perCareer" role="tabpanel" aria-labelledby="tramites_perCareer-tab">
        <div class="container-fluid pt-4">
            <div class="col-sm-12 col-xl-12 mx-auto bg-light" style="height:2000px; ">
                   <div class="bg-light rounded h-100">
                       <h6 class="display-5 text-secondary fw-bold text-center"> Trámites Solicitados por Carrera </h6>

                            <canvas id="tramites_perCareer_chart"></canvas>
                   </div>
               </div>
        </div>
      </div>
    </div>
</div>

@endsection
