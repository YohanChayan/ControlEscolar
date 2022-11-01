@extends('layouts.app')

@can('none')
{{-- Carga scripts para correccion de registro (student) --}}
    @if(auth()->user()->answer_dataIsWrong === 1)
        @section('my_scripts')
            <script src="{{asset('js/errors_student/errorsStudent.js')}}"></script>
            <script>
                hasToFix = @json(auth()->user()->hasToFix);
                $(document).ready(function(){
                    loadErrors()
                })
            </script>
        @endsection
    @endif

    @section('content')
        <div class="m-4 container-fluid pt-4 px-4 bg-light d-flex align-items-center">
            <div class="row rounded align-items-center justify-content-center mx-auto">
                @if(auth()->user()->answer_dataIsWrong === 0)
                    <div class="col-md-8 mx-auto text-center p-4">
                        <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                        <h1 class="mb-4">Usted no tiene acceso a esta página</h1>
                        <p class="mb-4">En caso de ser primera vez en el sitio, deberá esperar a que control escolar valide su información.</p>
                        <p class="mb-4">En caso de que permanezca así comuníquese con control escolar para dar solución a esta problemática.</p>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="{{route('logout')}}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" >Salir</a>
                    </div>

                @elseif(auth()->user()->answer_dataIsWrong === -1)
                    <div class="col-md-8 mx-auto text-center p-4">
                        <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                        <h2 class="mb-4">Su solicitud ha sido enviada y será evaluada!</h2>
                        <p class="mb-4">No olvide revisar constantemente!.</p>
                        <p class="mb-4">En caso de que permanezca así comuníquese con control escolar para dar solución a esta problemática.</p>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="{{route('logout')}}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" >Salir</a>
                    </div>

                @elseif(auth()->user()->answer_dataIsWrong === 1)
                    <div class="col-md-6 text-center p-4">
                        <i class="bi bi-exclamation-triangle display-1 text-danger"></i>
                        <h1 class="mb-4 text-danger">Atención</h1>
                        <p class="mb-4 fs-3">Usted tiene <span class="fw-bold">errores en su información</span> de registro, favor de corregirlos a continuación.</p>
                    </div>

                    <div class="col-md-4 border border-3 me-4">
                        <p class="mt-2 fs-2 fw-bold text-center">Errores: </p>
                        <ul id="list_errors_user">
                            <li class="text-danger fs-4"> Nombres </li>
                        </ul>
                    </div>

                <div class="col-md-10 mx-auto text-center">
                    <a onclick="showErrorsModal()" class="btn btn-lg btn-success">Corregir</a>
                </div>
            </div>
        </div>

            <!-- Modal -->
            <div class="modal fade " id="fixErrorsModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="fixErrorsModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold text-secondary" id="fixErrorsModalLabel">Información</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body bg-light">

                    <form action="{{route('users.fixStudentData')}}" method="POST" id="FixErrorsForm">
                        @csrf
                        <div class="row g-2" id="containerInputs">
                            {{-- dynamic inputs --}}
                        </div>

                    </form>

                  </div>
                  <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button onclick="submitFixErrors()" type="button"  class="btn btn-primary">Enviar</button>
                  </div>
                </div>
              </div>
            </div>

            @endif
    @endsection
@endcan

@section('content')

<div class="container-fluid vh-auto pt-4">
    <!-- Sale & Revenue Start -->
    {{-- <div class="container-fluid pt-2 px-2"> --}}

        @canany(['admin' , 'coordinador'])

        @if (session('estatus'))
            <div class="alert alert-success">
                {{ session('estatus') }}
            </div>
        @endif

        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-center p-4">
                    <i class="fa fa-chart-line fa-3x m-3 text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Estudiantes activos</p>
                        <h6 class="mb-0">{{$students_count}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-center p-4">
                    <i class="fa fa-chart-bar fa-3x m-3 text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Trámites solicitados hoy</p>
                        <h6 class="mb-0">{{$tramites_today}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-center p-4">
                    <i class="fa fa-chart-area fa-3x m-3 text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Trámites Pendientes</p>
                        <h6 class="mb-0">{{$Tpendientes}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-center p-4">
                    <i class="fa fa-chart-pie fa-3x m-3 text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Trámites Completados</p>
                        <h6 class="mb-0">{{$finished_tramites}}</h6>
                    </div>
                </div>
            </div>
        </div>
    <!-- Sale & Revenue End -->
    <div class="row g-4 my-2">

        <div class="col-sm-12 col-xl-3 d-flex align-content-center justify-content-center">
            <div class="bg-light rounded d-flex align-items-center justify-content-center p-4 w-100">
                <i class="fa fa-chart-pie fa-4x m-3 text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Solicitudes de acceso de estudiantes</p>
                    <h6 class="mb-0">{{$pending_students}}</h6>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-6 mx-auto">
        <div class="bg-light rounded h-100 p-4 border border-1">
            <h4 class="mb-4 text-secondary text-center">Escanee o ingrese código QR</h4>
            <form action="{{ route('tramites.seguimiento') }}" method="POST">
                @csrf
                <input required class="form-control" name="tramite_id" id="tramite_id" style="height: 75px;" ></input>
                <button type="submit" class="btn btn-primary m-2">Buscar
                    <i class="far fa-file-alt ms-2"></i>
                </button>
            </form>
        </div>
    </div>

        <div class="col-sm-126 col-xl-3 d-flex align-content-center justify-content-center">
            <div class="bg-light rounded d-flex align-items-center justify-content-center p-4 w-100">
                <i class="fa fa-chart-pie fa-4x m-3 text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Solicitudes de cambio de carrera</p>
                    <h6 class="mb-0">{{$changeCareers_count}}</h6>
                </div>
            </div>
        </div>

    </div>

        <!-- actividad reciente -->
        <div class="container-fluid pt-4">
            <div class="row g-4">
                <div class="col-sm-12 col-md-8 col-xl-8 px-0 pe-2">
                    <div class="h-100 bg-light rounded p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h5 class="mb-0 text-secondary text-center">Actividades Administrativas</h5>
                            <a href="{{route('logs.index')}}">Mostrar todos</a>
                        </div>


                        {{-- Solo 4 --}}
                        @foreach($logs_admins as $la)
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="{{asset('custom/dashboard/img/user-icon.png')}}" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-2">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">{{$la->user->name}} {{$la->user->apellidos}}</h6>
                                        <small>{{$la->created_at->diffForHumans()}}</small>
                                    </div>
                                    <span>{{$la->action}} <span class="fw-bold">{{$la->target}}</span></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-xl-4 px-0 ps-2">
                    <div class="h-100 bg-light rounded p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h5 class="mb-0 text-secondary text-center">Actividades Estudiantes</h5>
                            <a href="{{route('logs.index_students')}}">Mostrar todos</a>
                        </div>
                        {{-- Solo 4 --}}
                        @foreach($logs_students as $ls)

                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="{{asset('custom/dashboard/img/user-icon.png')}}" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-2">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Estudiante: {{$ls->user->codigo}}</h6>
                                        <small>{{$ls->created_at->diffForHumans()}}</small>
                                    </div>
                                    <span> <small>{{$ls->action}}</small> <span class="fw-bold">{{$ls->target ?? ''}}</span></span>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        @endcanany

    <!-- Recent Sales Start -->
    @can('student')

    {{-- Carga scripts para dashboard student --}}
    @section('my_scripts')
        <script src="{{asset('js/student/tramites.js')}}"></script>
        <script>
            $(document).ready( function () { applyToolTips(); });
            $(document).ready( function () { applyDataTable(); });
        </script>
    @endsection

    <div class="bg-light container-fluid my-3 p-4">
        <div class="text-center rounded ">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0 text-secondary fs-3">Trámites solicitados</h5>
            </div>
        </div>

            <div class="table-responsive">
                <table id="TramitesPendientesTable" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Folio</th>
                            <th scope="col">Nombre de tramite</th>
                            <th scope="col">Fecha de creación</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="TramitesPendientesTBody">
                            @foreach($tramitesSolicitados as $tr)
                                <tr>
                                    <td> {{$tr->id}} </td>
                                    <td> {{$tr->tramite->nombre_tramite}} </td>
                                    <td> {{  date("d M Y", strtotime($tr->created_at)) }} </td>
                                    <td>
                                        @if($tr->estatus == 'Recibido')
                                            <span class="text-success fw-bold">Finalizado</span>
                                        @elseif($tr->estatus == 'Recepción de trámite rechazado en CE' || $tr->estatus == 'Retención')
                                            <span class="text-danger">{{$tr->estatus}}</span>
                                        @elseif($tr->estatus == '-')
                                            <span class="text-primary">Iniciado</span>
                                        @else
                                            <span class="text-primary">{{$tr->estatus}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-evenly align-items-center">

                                            <div class="col-md-4">
                                                <a class="text-primary" onclick="preview({{$tr}})" style="cursor: pointer;">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Detalles">
                                                        <i class="fas fa-eye mx-2"></i>
                                                     </span>
                                                </a>
                                            </div>

                                            @if($tr->tramite->formato !== 'formato_constanciaNoAdeudo')

                                                @if($tr->categoria !== 'finalizado' && $tr->categoria !== 'rechazado')
                                                    <div class="col-md-4">
                                                        <a onclick="OrdenDePago({{$tr->id}})" class="text-secondary" style="cursor: pointer;" >
                                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Orden de pago">
                                                                <i class="far fa-file-alt me-2"></i>
                                                             </span>
                                                        </a>
                                                    </div>
                                                @endif

                                            @else
                                                @if($tr->categoria !== 'finalizado' && $tr->categoria !== 'rechazado')
                                                    @if($tr->estatus === 'Retención' && $tr->total_a_pagar > 0)
                                                        <div class="col-md-4">
                                                            <a onclick="OrdenDePago({{$tr->id}})" class="text-secondary" style="cursor: pointer;" >
                                                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Orden de pago">
                                                                    <i class="far fa-file-alt me-2"></i>
                                                                 </span>
                                                            </a>
                                                        </div>
                                                    @else
                                                        @if($tr->estatus !== 'Listo para entrega')
                                                        <div class="col-md-4">
                                                            <a href="#" class="text-secondary" style="cursor: pointer;" >
                                                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Orden de pago en proceso">
                                                                    <small>En proceso</small>
                                                                 </span>
                                                            </a>
                                                        </div>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>

                <form action="{{route('tramites.formato')}}" method="POST" id="form_ordenPago">
                    @csrf
                    <input type="hidden" name="tr_id" id="tr_id">
                </form>
            </div>
        </div>

        <!-- Modal for tramite Review -->
        <div class="modal fade" data-bs-backdrop="static" id="tramitePreviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg ">
            <div class="modal-content ">
              <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Vista Previa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-3">
                <div class="border p-4 bg-light">
                    <form method="POST" id="formUploadDocuments" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="folioUnico" id="folioUnico">

                        <div class="row mb-3">
                            <div class="col-md-6 mx-auto mx-4 text-center" id="estatusContainer">
                                <label for="estatus" class="col-form-label text-success"><span class="fs-5 fw-bold">Estatus</span></label>
                                <textarea class="form-control" name="estatus" id="estatus" aria-describedby="estatusHelp" readonly style="height: 75px;"></textarea>

                                {{-- <div id="nombre_tramiteHelp" class="form-text">Ingrese nombre del nuevo tipo de trámite</div> --}}
                            </div>


                            <div class="col-md-7 d-none text-center" id="motivoContainer">

                                <label for="motivo" class="col-form-label text-secondary"><span class="fs-5 fw-bold">Motivo</span></label>
                                <textarea class="form-control" name="motivo" id="motivo" aria-describedby="motivoHelp" readonly style="height: 80px;"> </textarea>
                            </div>

                        </div>

                        <div class="row g-3">
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" readonly>
                                <div id="emailHelp" class="form-text">Es importante destacar que por este medio se le notificará sobre el estado de su trámite.
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="codigo" class="form-label">Código</label>
                                <input type="text" class="form-control" name="codigo" id="codigo"   readonly>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nombres</label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp"  readonly="">

                            </div>
                            <div class="mb-4 col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" id="apellidos" aria-describedby="emailHelp" readonly>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <label for="carrera" class="form-label">Carrera</label>
                                <input type="text" class="form-control" name="carrera" id="carrera" aria-describedby="emailHelp" readonly>
                            </div>

                            <div class="col-md-3">
                                <label for="ciclo" class="form-label">Ciclo de admisión</label>
                                <input type="text" class="form-control" name="ciclo" id="ciclo" aria-describedby="emailHelp" readonly>
                            </div>
                        </div>

                        {{-- No se usará, POR LOS MOMENTOS --}}
                        {{-- <div class="row g-3" id="filesContainer">
                            <div class="mb-3 col-md-6">
                                <label for="documents" class="form-label">Archivos</label>
                                <input type="file" class="form-control" name="documents[]" id="documents" multiple accept="application/pdf">
                                <a onclick="uploadDocuments()" class="my-2 btn btn-primary">Subir archivos</a>
                                <small class="d-none text-danger" id="error_cantidad_files"> Debe subir la misma cantidad de archivos que se le haya especificado.</small>
                            </div>

                            <div class="pt-1 col-md-6 border border-2">
                                <p class="text-center fw-bold mb-1 "> Entrega virtual </p>
                                <span class="text-secondary text-center">Los siguientes archivos deben ser subidos en formato <span class="fw-bold">PDF</span> y por <span class="fw-bold">archivos separados</span>: </span>
                                <ul class="mt-2" id="list_requirements_files">

                                    <li class="text-secondary"> constancia de algo3 </li>
                                </ul>
                                <span class="fw-bold"> Estatus de Documentos:
                                    <span class="text-danger" id="docsEstatus"> Por entregar </span>
                                </span>
                            </div>
                        </div> --}}

                        <div class="row mt-2" id="container_list_requirements_presencial">
                            <div class="col-md-7 mx-auto border border-2">
                                <p class="text-center fw-bold mb-1"> Entrega presencial </p>
                                <span class="text-secondary text-center">Los siguientes requerimientos deben ser entregados de <span class="fw-bold">forma presencial</span>: </span>
                                <ul class="mt-2" id="list_requirements_presencial">
                                    <li class="text-secondary"> constancia de algo3 </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row mt-3 gx-3 justify-content-center">
                            <div class="col-md-6 border">
                                <p class="text-secondary"><span class="fw-bold">Recuerde</span> que una vez que se le da seguimiento a su trámite, dichos requerimientos pueden variar dependiendo del estudiante.</p>
                            </div>
                            <div class="col-md-6 border">
                                <p class="text-secondary my-1">En caso de que su trámite se encuentre en estatus: <span class="fw-bold">Listo para entrega</span> debe dirigirse a control escolar con la referencia de su trámite. </p>
                            </div>
                        </div>
                </form>
                </div>

              </div>
              <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

    </div>
    @endcan
</div>


{{-- Footer --}}
<div class="container p-4 bg-light mt-3">
    <div class="row justify-content-evenly align-items-center">

        <div class="col-md-5">
            <div class="d-flex align-items-center">
                <img src="{{asset('custom/dashboard/img/cta_logo.jpg')}}" class="img-fluid border border-2" alt="CTA">
            </div>
        </div>

        <div class="col-md-5">
            <h5 class="text-uppercase my-4 font-weight-bold text-secondary">Contacto</h5>
                <p><i class="fas fa-envelope"></i> cta.cucsh@administrativos.udg.mx</p>
                <p><i class="fas fa-phone "></i> +52 33 3819 3300 ext: 23609</p>
        </div>
    </div>

    <hr class="my-3">
    <div class="p-2">
          <p class="mb-2">Coordinación de Tecnologias para el Aprendizaje - Universidad de Guadalajara</p>
          <small class="fst-italic">Desarrollado por: Yohan Chayan</small>
    </div>

</div>

@endsection
