@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/admin/tramitesFinalizados.js')}}"></script>
@endsection

@section('content')

    <div class="bg-light container-fluid my-3 p-4">

        <div class="text-center rounded">
            <div class="d-flex -items-center justify-content-between mb-4">
                <h4 class="mb-0">Trámites Finalizados</h4>
                {{-- <div class="row">
                    <div class="col-sm-2 d-flex -items-center justify-content-center">
                        <a data-bs-toggle="collapse" href="#filterUserHelp" role="button" aria-expanded="false" aria-controls="filterUserHelp">
                            <i class="fas fa-question pb-2"></i>
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>

        <form class="mt-4 p-4" id="formDateFilter" method="POST">
            @csrf
            <div class="row g-4 d-flex">
                <div class="col-sm-3 mt-0">
                    <label for="fecha_inicial" class="form-label">Fecha Inicial</label>
                    <input onchange="filterDate(this)" type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-sm-3 mt-0">
                    <label for="fecha_final" class="form-label">Fecha Final</label>
                    <input onchange="filterDate(this)" type="date" class="form-control" id="fecha_final" name="fecha_final" value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-6 mx-auto pt-3">
                    <div class="bg-light text-center" class="form-text">
                        <span class="fw-bold ">Para filtrar debe colocar un rango de fechas.</span>
                    </div>
                </div>

            </div>
        </form>

        {{-- <div class="row">
            <div class="col-6 mx-auto">
                <div class="collapse bg-light text-center" id="filterUserHelp" class="form-text">
                    <span class="fw-bold ">Puede filtrar por cada uno de los campos que se encuentran en la tabla.</span>
                </div>
            </div>
        </div> --}}

        <div class="table-responsive mt-2" id="TfinalizadosContainer">
                <table id="Tfinalizados" class="table text-start -middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Folio único</th>
                            <th scope="col">Folio por trámite</th>
                            <th scope="col">Trámite</th>
                            <th scope="col">Nombres del Alumno</th>
                            <th scope="col">Correo del Alumno</th>
                            <th scope="col">Carrera</th>
                        </tr>
                    </thead>
                    <tbody id="TfinalizadosTbody">

                    </tbody>
                </table>
        </div>

            {{-- seguimiento --}}
            <form action="{{ route('tramites.seguimiento') }}" method="POST" id="seguimientoForm">
                @csrf
                <input type="hidden" id="finalizado_tramite_id" name="tramite_id">
            </form>
    </div>

@endsection
