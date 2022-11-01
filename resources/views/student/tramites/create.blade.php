@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/student/solicitudTramite.js')}}"></script>
@endsection

@section('content')

<div class="container">
    <div class="row h-100 align-items-center justify-content-center mt-4" style="min-height: 80vh;">
        <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
            <div class="bg-light rounded h-100 p-4">
                <h2 class="mb-4 text-secondary fw-bold text-center">Solicitud para trámite</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tramites.generar') }}" method="POST" id="formSolicitud">
                    @csrf

                    <div class="row g-3">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label fw-bold">Nombres</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" value="{{auth()->user()->name}}" readonly>
                            {{-- <div id="" class="form-text">Es importante destacar que por este medio se le notificará sobre el estado de su trámite.
                            </div> --}}
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="apellidos" class="form-label fw-bold">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" aria-describedby="emailHelp" value="{{auth()->user()->apellidos}}" readonly>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="mb-3 col-md-6">
                            <label for="exampleInputEmail1" class="form-label fw-bold">Correo Institucional</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{auth()->user()->email}}" readonly>
                            <div id="emailHelp" class="form-text">Es importante destacar que por este medio se le notificará sobre el estado de su trámite.
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="codigo" class="form-label fw-bold">Código</label>
                            <input type="text" class="form-control" name="codigo" id="codigo" aria-describedby="" value="{{ auth()->user()->codigo }}" readonly>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="mb-3 col-md-6">
                            <label for="clave_carrera" class="form-label fw-bold">Clave de carrera</label>
                            <input type="text" name="clave_carrera" class="form-control" id="clave_carrera" value="{{auth()->user()->clave_carrera}}" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="carrera" class="form-label fw-bold">Carrera</label>
                            <input type="text" class="form-control" name="carrera" id="carrera"  value="{{ auth()->user()->nombre_carrera }}" readonly>
                            <div id="carreraHelp" class="form-text">En caso de que haya cambiado de carrera es necesario hacer una solicitud de cambio de carrera para actualizar sus datos en sistema.
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="mb-3 col-md-6">
                            <label for="ciclo_admision" class="form-label fw-bold"> Ciclo de admisión </label>
                            <input type="text" class="form-control" name="ciclo_admision" id="ciclo_admision" value="{{auth()->user()->ciclo_admision}}" readonly>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="telefono" class="form-label fw-bold"> Telefono </label>
                            <input type="text" class="form-control" name="telefono" id="telefono" value="{{auth()->user()->telefono}}" readonly>
                        </div>
                    </div>


                    <div class="row my-3">
                        <div class="form-floating mb-3 col-sm-12 ">
                            <select class="form-select" name="tramite" id="nombre_tramite" aria-label="Floating label select example">
                                <option selected=""> - </option>
                                @foreach($disponibles as $tr)
                                    <option value="{{$tr->nombre_tramite}}"> {{$tr->nombre_tramite}} </option>
                                @endforeach
                            </select>
                            <label class="px-3" for="nombre_tramite">Seleccione el trámite que desea realizar</label>
                        </div>
                        <div class="col-sm-12  mb-3 text-center">
                            <a href="#" class="btn btn-primary rounded-pill m-2" onclick="showRequirements({{$tramites_infoReqs}})">Ver requisitos</a>
                        </div>
                    </div>

                    @if(isset($noDisponibles) && count($noDisponibles) != 0)
                        <div class="row mt-4">
                            <p class="text-secondary">Los siguientes tramites no están disponibles por los momentos: </p>
                            <div class="col-md-6">
                                <ul>
                                    @foreach($noDisponibles as $t)
                                        <li class="text-danger">{{$t->nombre_tramite}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a onclick="check_trNumbers()" id="BtnRequest" class="btn btn-lg btn-success"> Solicitar </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal  fade" id="reqsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h5 class="modal-title" id="exampleModalLabel">Trámites</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body bg-light">

                <div class="bg-light rounded h-100 p-4">
                    <p class="fw-bold fs-3 text-center mb-1">Importante </p>
                    <p class="mb-4 text-center text-secondary fs-5">
                        Algunos requerimientos no son necesarios para ciertos estudiantes, esto lo podrá ver en el apartado de<span class="fw-bold"> detalles </span> una vez solicitado su trámite.
                    </p>

                    <h3 class="mt-3 text-center text-secondary fw-bold">Listado de trámites</h3>

                    <div class="accordion" id="accordionExample">
                        {{-- from JS --}}

                        {{-- <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">
                                    content Item #1
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>



          </div>
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

</div>


@endsection
