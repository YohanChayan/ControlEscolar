@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/admin/tramites.js')}}"></script>
    <script>
        $(document).ready( loadingDT(@json($data)) );
        $(document).ready( function () { applyDataTable() });
    </script>

@endsection

@section('content')
    <div class="bg-light container-fluid my-3 p-4">
        <div class="text-center rounded pb-3">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0 text-secondary fw-bold">Trámites disponibles</h4>
                <a id="btnCreateTramite" onclick="createTramite()" data-bs-toggle="modal" href="#ModalTramiteForm" >Crear nuevo tipo de trámite</a>
            </div>
        </div>

                <table id="tramiteTable" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col">ID</th> --}}
                            <th scope="col">Nombre</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Requerimientos</th>
                            <th scope="col">Disponibilidad</th>
                            <th scope="col">Aviso</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tramiteTbody">

                    </tbody>
                </table>

                <form method="post" id="FormBorrarTramite">
                    @csrf
                    @method('DELETE')
                </form>

            </div>

        {{-- MODAL create/edit tramite --}}
        <div class="modal fade" id="ModalTramiteForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-light">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar tipo de trámite</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body bg-light">

                    <div class="bg-light rounded h-100 p-4">
                        <form method="POST" id="FormTramite">  <!-- Dynamic modal (create/edit) JS -->
                            @csrf

                            <div class="row mt-2 mb-4">
                                <div class="col-md-8 mx-auto">
                                    <p class="small text-secondary text-center">Permite <span class="fw-bold">activar o desactivar</span> el trámite para los estudiantes. </p>

                                    <div class="form-check form-switch d-flex justify-content-center me-5">
                                        <input class="form-check-input mx-1 mt-1" name="isAvailable" value="Si" type="checkbox" role="switch" id="isAvailable" onchange="change_available(this)">
                                        <label class="form-check-label" for="isAvailable">
                                            <p class="fs-5 text-success fw-bold" id="label_IsAvailable">Disponible</p>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <label for="nombre_tramite" class="form-label">Nombre de trámite</label>
                                        <textarea class="form-control" id="nombre_tramite" name="nombre_tramite" aria-describedby="nombre_tramiteHelp"></textarea>
                                        <div id="nombre_tramiteHelp" class="form-text">Ingrese nombre del nuevo tipo de trámite</div>
                                    </div>
                                </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="monto" class="form-label"> Precio de trámite </label>
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">$</span>
                                      <input type="number" class="form-control" name="monto" id="monto" min="0" value="0">
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="col-md-5">
                                    <div class="row mb-3">

                                        <div class="col-md-12">
                                            <label for="requerimientos" class="form-label"> Requerimientos </label>
                                            <textarea class="form-control" name="requerimientos" placeholder="Ingrese requerimiento" id="requerimientos" style="height: 90px;"></textarea>

                                            <div id="requerimientosHelp" class="form-text">Escriba los requerimientos de <span class="fw-bold">manera individual</span> y luego presione añadir

                                            <span class="d-block">Nota: <span class="fw-bold">No usar guión bajo "_"</span> .</span>

                                            </div>
                                        </div>

                                        <div class="col-md-2 my-2">
                                            <a href="#" id="addRequeriment" onclick="addRequeriment()" class="btn btn-primary">+</a>
                                        </div>
                                    </div>

                                        {{-- Aviso --}}
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="HasAviso" value="Si" type="checkbox" role="switch" id="HasAviso" onchange="aviso(this)">
                                                <label class="form-check-label" for="HasAviso">Añadir aviso a trámite</label>
                                            </div>
                                            <div id="avisoTextContainer" class="input-group d-none">
                                              <span class="input-group-text">Aviso</span>
                                              <textarea id="avisoContent" name="avisoContent" class="form-control" aria-label="Aviso"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-7 mx-auto">
                                    <div class="bg-light rounded h-100 p-4">
                                        <h6 class="mb-1">Requerimientos</h6>
                                        <table class="table table-bordered" id="reqsTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="reqsTbody">
                                                {{-- <tr class="tr_index">
                                                        <th scope="row">Indice</th>
                                                        <td>Descripcion del requerimiento </td>
                                                        <td>Accion</td>
                                                    </tr> --}}
                                            </tbody>
                                        </table>
                                </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-8 mx-auto">
                                    <p class="text-secondary"><span class="fw-bold">Atención: </span> Si desea crear un nuevo trámite, este tendrá la misma movilidad que los primeros trámites: certificados de estudio, de graduado, actas, etc. Generando una orden de pago inmediatamente!</p>
                                </div>
                            </div>

                        </form>
                    </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <a id="BtnSubmitTramite" onclick="submitTramite()" class="btn btn-primary" >Accion Trámite</a>
              </div>
            </div>
          </div>
        </div>

    </div>


@endsection
