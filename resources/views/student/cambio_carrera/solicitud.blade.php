@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/student/cambioCarrera.js')}}"></script>
@endsection

@section('content')

    <div class="bg-light container-fluid my-3 p-4">

        <div class="text-center rounded">
            <h4 class="mb-0 text-secondary fw-bold">Solicitud de cambio de carrera</h4>
            <div class="d-flex justify-content-center text-center my-4">
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#newCareerFormContainer" role="button" aria-expanded="false" aria-controls="newCicloForm"><span class="fw-bold">Solicitar</span></a>
            </div>
        </div>

            <div class="row my-3">
                <div class="col-md-6 mx-auto">
                    <div class="alert alert-dark" role="alert">
                      <p class="mb-1"> <span class="fw-bold">Nota:</span> Una vez llenado este formulario de cambio de carrera deberá esperar a que control escolar valide su solicitud.</p>
                    </div>
                </div>
            </div>

            @if(isset($currentSolicitud))
                <div class="row g-3 mt-3">
                    <div class="col-md-8 mx-auto p-2">
                        <div class="alert alert-secondary" role="alert">
                            <h4 class="alert-heading fw-normal text-center">Estatus de tramite actual: <span class="fw-bold">{{ucfirst($currentSolicitud->estatus)}}</span></h4>
                            @if($currentSolicitud->estatus != 'aprobado')
                              <p class="my-1 mt-4">Cambio de la carrera: <span class="text-decoration-underline">{{auth()->user()->clave_carrera}} - {{auth()->user()->nombre_carrera}}</span></p>
                              <p class="my-1">A la carrera: <span class="text-decoration-underline">{{$currentSolicitud->new_clave_carrera}} - {{$currentSolicitud->new_nombre_carrera}}</span></p>
                            @endif
                          <hr>

                          <p class="mb-0">
                          @if($currentSolicitud->estatus == 'aprobado')
                            Su carrera ha cambiado en el sistema a: <span class="text-decoration-underline"> {{$currentSolicitud->new_clave_carrera}} - {{$currentSolicitud->new_nombre_carrera}} </span>
                          @else
                              En caso de que su solicitud sea rechazada, asegurarse de colocar la clave de carrera correctamente.
                          @endif
                          </p>

                        </div>

                    </div>
                </div>
            @endif

            <div class="row mb-3 collapse" id="newCareerFormContainer">
                <div class="col-md-6 mx-auto">
                    <form action="{{route('users.cambioCarrera')}}" class="d-flex flex-column align-items-evenly" id="newCareerForm"  method="POST">
                        @csrf

                        <div class="row my-2 p-2">
                            <label for="current_career" class="form-label text-center"><span class="fw-bold">Carrera actual</span></label>

                                <input name="current_career" class="form-control" id="current_career"  value="{{$currentCareer}}" readonly>
                        </div>

                        <div class="row my-2 p-2">

                                <label for="new_career" class="form-label text-center"><span class="fw-bold">Seleccione nueva carrera</span></label>

                                <input name="new_career" class="form-control" list="carrera_list_options" id="new_career" placeholder="Ingrese nueva carrera" >
                                   <datalist id="carrera_list_options">
                                       @foreach($carreras as $car)
                                           <option value="{{$car->nombre}}">
                                       @endforeach
                                   </datalist>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mx-auto text-center">
                                <a onclick="submitNewCareer()" class="btn btn-primary"> Enviar solicitud </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>

@endsection
