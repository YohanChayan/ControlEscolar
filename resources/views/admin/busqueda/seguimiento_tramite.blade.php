@extends('layouts.app')


@section('my_scripts')
    <script src="{{asset('js/admin/seguimientoTramite.js')}}"></script>
    <script>
        changeStatus();
        motivo(@json($tramite->motivo))

        check_reqs_selected(@json($tramite->requerimientos_asignados));
        var assets = @json($assetsDocuments);

        isThereFiles()
    </script>
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">

        <div class="bg-light text-center rounded p-4 mb-2">
            <div class="d-flex align-items-center justify-content-between mb-0">
                <h5 class="mb-2">
                    Seguimiento a tramite: {{$tramite->tramite->nombre_tramite}}
                    @if($tramite->categoria == 'solicitado')
                        <span class="text-primary mx-4">
                            <i class="fa fa-file-alt me-2"></i>
                        </span>
                    @else
                        <span class="text-secondary mx-4">
                            <i class="fa fa-file-alt me-2"></i>
                        </span>
                    @endif
                </h5>
                <a href="{{route('tramites.pendientes')}}" class="mb-2">Mostrar todos los tramites solicitados</a>
            </div>

            <form action="{{route('tramites.seguimientoEstatus')}}" method="POST" id="formSeguimiento">
                @csrf
                <div class="row mb-4 py-4 border border-1">
                    <div class="col-md-9 d-flex">

                        <div class="col-md-3 mx-2">
                             <label for="fechaSolicitud" class="form-label">Fecha de solicitud</label>
                             <input type="email" name="email" class="form-control" id="fechaSolicitud" aria-describedby="emailHelp" value="{{$tramite->created_at->format('d-m-Y')}}" readonly>
                         </div>

                        <div class="col-md-3 mx-2">
                            <label for="folioUnico" class="form-label">
                                <span class="fw-bold">Número de fólio único</span>
                            </label>
                            <input type="text" class="form-control" name="folioUnico" id="folioUnico" value="{{$tramite->id}}" readonly>
                        </div>

                        <div class="col-md-3 mx-2">
                            <label for="folioTramite" class="form-label">Número de fólio por trámite</label>
                            <input type="text" class="form-control" name="folioTramite" id="folioTramite" value="{{$tramite->folio}}" readonly>
                         </div>


                    </div>

                    <div class="col-md-3">
                        <label for="modalidad" class="form-label">Modalidad</label>
                        <input type="text" class="form-control" name="modalidad" id="modalidad" value="{{$tramite->tramite->modalidad}}" readonly>

                    </div>

                </div>

                <div class="row g-3 p-2">
                        <div class="mb-3 col-md-4">
                            <label for="name" class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$tramite->student->name}}" readonly>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{$tramite->student->apellidos}}" readonly>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="exampleInputEmail1" class="form-label">Correo Institucional</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$tramite->student->email}}" readonly="">
                        </div>
                </div>

                <div class="row g-3 p-2">
                    <div class="mb-3 col-md-2">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" class="form-control" name="codigo" id="codigo" value="{{$tramite->student->codigo}}" readonly>
                    </div>

                    <div class="mb-3 col-md-2">
                        <label for="clave_carrera" class="form-label">Clave de carrera</label>
                        <input type="text" class="form-control" id="clave_carrera" aria-describedby="clave_carreraHelp" readonly value="{{$tramite->student->clave_carrera}}">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="carrera" class="form-label">Carrera</label>
                        <textarea class="form-control" id="carrera" name="carrera" readonly> {{$tramite->student->nombre_carrera}} </textarea>
                    </div>
                    <div class="mb-3 col-md-2">
                        <label for="carrera" class="form-label">Ciclo de admisión</label>
                        <input type="text" class="form-control" id="ciclo"  readonly value="{{$tramite->student->ciclo_admision}}">
                    </div>


                    @if($tramite->tramite->modalidad != 'Presencial')
                        <div class="col-md-2">
                            <div class="mt-2 col-sm-12">
                                <a onclick="previewDocuments(assets)" id="btnModalFiles" class="btn btn-primary">Archivos</a>
                            </div>
                            <div class="my-1 col-sm-12">
                                <span class="text-center" id="docsNews">
                                </span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row px-2 justify-content-center d-flex align-items-center">
                    <div class="col-md-3 mx-auto text-center">
                        <div class="col md-12">
                            <a class="btn btn-primary mt-4" data-bs-toggle="collapse" href="#news_reqs_selected">Asignar Requisitos </a>
                            <p class="text-secondary mt-2 text-center mb-0">Debe asignar los requerimientos, esta acción solo se debe hacer una vez.</p>

                            @if(isset($tramite->requerimientos_asignados))
                            <p class="text-success mt-0 mb-3 text-center small">Algunos requerimientos han sido asignados</p>
                            @else
                            <p class="text-danger mt-0 mb-3 text-center small">Ningún requerimientos sido seleccionado.</p>
                            @endif

                        </div>
                    </div>

                    <input type="hidden" name="selected_reqs" id="selected_reqs" value="{{isset($tramite->requerimientos_asignados) ? $tramite->requerimientos_asignados : ''}}">

                    <div class="col-md-9 mx-auto text-center">
                        <div class="alert alert-secondary" role="alert">
                          <p class="fw-bold">Requerimientos seleccionados: </p>

                            <ul class="collapse list-group" id="news_reqs_selected">
                            {{-- checked from JS --}}
                              <li class="list-group-item bg-light">
                                <input class="form-check-input me-1" id="check_noReqs" type="checkbox" value="No necesita requerimientos" onchange="No_reqs()">
                                    <span class="fw-bold">No necesita requerimientos</span>
                              </li>
                              @foreach($reqsList as $req)
                                  <li class="list-group-item bg-light">
                                    <input class="form-check-input me-1" type="checkbox" value="{{trim($req)}}">
                                    {{$req}}
                                  </li>
                              @endforeach
                            </ul>

                        </div>
                    </div>
                </div>

                @if($tramite->tramite->formato == 'formato_constanciaNoAdeudo')
                    <div class="row px-2">
                        <div class="col-md-3">
                            <div class="mt-2 col-sm-12">
                                <a onclick="launch_matriculasModal({{$tramite->tramite->monto}})" class="btn btn-primary">Encontrar matriculas</a>
                            </div>
                            <div class="my-2 mb-4 col-sm-12">
                                <span class="text-center text-secondary"> Calcular matriculas pendientes</span>
                            </div>
                        </div>

                        <div class="col-md-4 ">
                            <div class="mt-2 col-sm-12">
                                <a onclick="noAdeudo()" class="btn btn-success"> No posee adeudo </a>
                            </div>
                            <div class="my-2 mb-4 col-sm-12">
                                <span class="text-center text-secondary">Seleccionar en caso de que la <span class="fw-bold">orden de pago ha sido pagada</span> ó si <span class="fw-bold">no tiene matriculas pendientes</span>.</span>
                                <p class="text-center text-secondary mt-2">
                                    <a class="fw-bold" style="cursor:pointer;" onclick="getDocument_noAdeudo()">Click aquí</a> para descargar constancia
                                </p>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="alert alert-secondary" role="alert">
                              Al seleccionar la opción de <span class="fw-bold">No posee Adeudo</span>, el tramite automáticamente se finaliza, enviándole al estudiante su constancia de no adeudo en formato PDF.
                            </div>
                        </div>

                    </div>
                @endif


                <div class="row g-3 p-2">
                    <div class="mb-3 col-md-4">
                        <label for="estatus_tramite" class="form-label"> <span class="fw-bold">Estatus Actual</span></label>
                        <div class="form-floating">
                            <select class="form-select" name="estatus_tramite" id="estatus_tramite"  onchange="changeStatus()">

                                @if($tramite->tramite->formato !== 'formato_constanciaNoAdeudo')
                                    <option {{ $tramite->estatus == 'Iniciado' ? 'selected': '' }}> - </option>
                                    <option {{ $tramite->estatus == 'Recepción de trámite recibido en CE' ? 'selected': '' }} value="Recepción de trámite recibido en CE"> Recepción de trámite recibido en CE </option>
                                    <option {{ $tramite->estatus == 'Recepción de trámite rechazado en CE' ? 'selected': '' }} value="Recepción de trámite rechazado en CE"> *Recepción de trámite rechazado en CE </option>
                                    <option {{ $tramite->estatus == 'Revisión' ? 'selected': '' }} value="Revisión"> Revisión </option>
                                    <option {{ $tramite->estatus == 'Retención' ? 'selected': '' }} value="Retención"> *Retención </option>
                                    <option {{ $tramite->estatus == 'Elaboración/Impresión' ? 'selected': '' }} value="Elaboración/Impresión"> Elaboración/Impresión </option>
                                    <option {{ $tramite->estatus == 'Firmas CU/Adm. Gral.' ? 'selected': '' }} value="Firmas CU/Adm. Gral."> Firmas CU/Adm. Gral. </option>
                                    <option {{ $tramite->estatus == 'Listo para entrega' ? 'selected': '' }} value="Listo para entrega"> Listo para entrega </option>
                                    <option {{ $tramite->estatus == 'Recibido' ? 'selected': '' }} value="Recibido"> *Recibido </option>
                                @else
                                    <option {{ $tramite->estatus == 'Iniciado' ? 'selected': '' }}> - </option>

                                    <option {{ $tramite->estatus == 'Recepción de trámite recibido en CE' ? 'selected': '' }} value="Recepción de trámite recibido en CE"> Recepción de trámite recibido en CE </option>

                                    <option {{ $tramite->estatus == 'Recepción de trámite rechazado en CE' ? 'selected': '' }} value="Recepción de trámite rechazado en CE"> *Recepción de trámite rechazado en CE </option>

                                    <option {{ $tramite->estatus == 'Revisión' ? 'selected': '' }} value="Revisión"> Revisión </option>
                                    <option {{ $tramite->estatus == 'Retención' ? 'selected': '' }} value="Retención"> *Retención </option>
                                     <option {{ $tramite->estatus == 'Listo para entrega' ? 'selected': '' }} value="Listo para entrega"> Listo para entrega </option>

                                     <option {{ $tramite->estatus == 'Recibido' ? 'selected': '' }} value="Recibido"> *Recibido </option>

                                @endif

                            </select>
                            <label class="px-3" for="nombre_tramite">Seleccione nuevo estatus</label>
                        </div>
                    </div>

                    <div class="col-md-3 d-none" id="errorTypeContainer">
                        <label for="errorType" class="form-label"> Error </label>
                        <div class="form-floating">
                            <select class="form-select" name="errorType" id="errorType">
                                @if($tramite->tramite->formato !== 'formato_constanciaNoAdeudo')
                                    <option value="-"> - </option>
                                    <option value="Error en el nombre">Error en el nombre</option>
                                    <option value="Error en la modalidad de titulación">Error en la modalidad de titulación</option>
                                    <option value="Error en la fecha">Error en la fecha</option>
                                    <option value="Error en el código de alumno">Error en el código de alumno</option>
                                    <option value="Error en calificación de materia(s)">Error en calificación de materia(s)</option>
                                    <option value="Error fecha de CENEVAL">Error fecha de CENEVAL</option>
                                    <option value="Error en nombre de carrera o programa">Error en nombre de carrera o programa</option>
                                    <option value="No corresponde la orientación">No corresponde la orientación</option>

                                    <option value="Error en el nombre de materia(s)">Error en el nombre de materia(s)</option>
                                    <option value="Error en nomenclaturas de kardex ACR, AI, CO, EQU, etc."> Error en nomenclaturas de kardex ACR, AI, CO, EQU, etc.</option>
                                    <option value="Error en calificación">Error en calificación</option>
                                    <option value="No se reconoce materia(s) en su área">No se reconoce materia(s) en su área</option>
                                    <option value="No reconoce acreditaciones">No reconoce acreditaciones</option>
                                    <option value="Otro">Otro</option>

                                @else
                                    <option value="-">-</option>

                                    <option value="La orden de pago se ha generado y debe ser pagada">La orden de pago se ha generado y debe ser pagada</option>

                                    <option value="Créditos faltantes">Créditos faltantes</option>
                                    <option value="Falta validación de certificado de bachillerato">Falta validación de certificado de bachillerato</option>
                                    <option value="Falta validación de certificado de Licenciatura/Maestría">Falta validación de certificado de Licenciatura/Maestría</option>
                                    <option value="Falta copia del título Licenciatura/Maestría">Falta copia del título Licenciatura/Maestría</option>
                                    <option value="Falta apostille de documento(s)">Falta apostille de documento(s)</option>
                                    <option value="Falta copia cédula federal">Falta copia cédula federal</option>


                                    <option value="Otro">Otro</option>

                                @endif
                            </select>
                            <label class="px-3" for="errorType">Selecione error</label>
                        </div>
                    </div>

                    <div class="col-md-5 d-none" id="especificacionContainer">
                        <span class="fw-bold py-1 text-center">Especificación (opcional)</span>
                            <div class="form-floating">
                                <textarea class="form-control" name="errorDetail" id="errordetail" style="height: 75px;"></textarea>
                                <label for="errordetail">Motivo</label>
                            </div>
                    </div>
                </div>

                <input type="hidden" id="motivo" name="motivo">

                <div class="row p-4 justify-content-center align-items-center">
                    <div class="col-md-3 mx-auto">
                        <a onclick="submitSeguimiento()" class="btn btn-lg btn-primary">Actualizar</a>
                    </div>
                </div>

                <div class="modal fade" id="FilesModal" tabindex="-1" aria-labelledby="FilesModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">Documentos subidos por el estudiante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body ">

                            <div class="accordion" id="accordionExample">
                                {{-- Accordions with file -from JS --}}
                            </div>

                      </div>
                      <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>


                @if(isset($ciclos))
                {{-- Modal calculo de  matriculas --No adeudo --}}
                <div class="modal fade" id="NoAdeudoModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="NoAdeudoModalModalLabel" aria-hidden="true">

                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">Calculo de matriculas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body bg-light">
                        {{-- <form id="matriculas_form"> --}}
                            {{-- @csrf --}}

                            <div class="d-flex g-4 justify-content-center">
                                <div class="col-md-6">
                                    <label for="ultimo_pago" class="form-label"> <span class="fw-bold">Ultimo pago:</span> </label>

                                    <input name="ultimo_pago" class="form-control" list="ciclos_list_options" id="ultimo_pago" name="ultimo_pago" placeholder="Ingrese el ciclo escolar">
                                       <datalist id="ciclos_list_options">
                                       @foreach($ciclos as $ci)
                                           <option value="{{$ci->semestre}}">
                                       @endforeach
                                       </datalist>

                                    <div id="ultimo_pagoHelp" class="form-text">Ingrese último ciclo escolar en el se realizó el pago de matrícula</div>
                                </div>

                                <div class="col-md-4 mt-3 pt-3">
                                    <a href="#" class="btn btn-primary" onclick="calcular_matriculas()">Calcular</a>
                                </div>

                            </div>

                            <div class="row my-3">
                                <div class="col-md-4">
                                    <label for="matriculas_pendientes" class="form-label"> <span class="fw-bold" >Matriculas: </span> </label>

                                    <input name="matriculas_pendientes" class="form-control" id="matriculas_pendientes" readonly placeholder="Esperando..">
                                </div>

                                <div class="col-md-4">
                                    <label for="matriculas_total" class="form-label"> <span class="fw-bold">Monto total: </span> </label>

                                    <input name="matriculas_total" class="form-control" id="matriculas_total" readonly placeholder="Esperando..">
                                </div>

                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <a class="btn-btn-success pt-4" data-bs-toggle="collapse" href="#matriculasTable_container" role="button" aria-expanded="false" aria-controls="matriculasTable_container">
                                        <span class="fw-bold">Detalles</span>
                                    </a>
                                </div>
                            </div>
                            <div class="collapse" id="matriculasTable_container">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ciclo Escolar</th>
                                            <th scope="col">Matricula</th>
                                        </tr>
                                    </thead>
                                    <tbody id="matriculas_TBody">
                                        {{-- js --}}
                                    </tbody>
                                </table>
                            </div>
                        {{-- </form> --}}


                      </div>
                      <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button onclick="asignar_adeudo()" type="button" class="btn btn-primary">Asignar orden de pago</button>
                      </div>
                    </div>
                  </div>
                </div>

                @endif

            </form>

            <form action="{{route('tramites.DocNoAdeudo')}}" method="POST" id="doc_noAdeudoForm">
                @csrf
                <input type="hidden" name="docNoAdeudo_id" id="docNoAdeudo_id" value="{{$tramite->id}}">
            </form>

        </div>

    </div>
@endsection
