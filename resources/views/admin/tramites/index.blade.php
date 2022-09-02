@extends('layouts.app')


@section('my_scripts')
    <script src="{{asset('js/admin/tramites.js')}}"></script>

    <script>
        $(document).ready( loadingDT(@json($data)) );
        $(document).ready( function () {$('#tramiteTable').DataTable(); });
    </script>
@endsection

@section('content')

    <div class="bg-light container-fluid my-3 p-4">
        <div class="text-center rounded pb-3">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">Tramites disponibles</h4>
                <a id="btnCreateTramite" onclick="createTramite()" data-bs-toggle="modal" href="#ModalTramiteForm" >Crear nuevo tipo de trámite</a>
            </div>
        </div>

                <table id="tramiteTable" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Nombre de Trámite</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Requerimientos</th>
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
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar tipo de trámite</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body bg-light">

                    <div class="bg-light rounded h-100 p-4">
                        <form method="POST" id="FormTramite">  <!-- Dynamic modal (create/edit) JS -->
                            @csrf
                            <div class="mb-3">
                                <label for="nombre_tramite" class="form-label">Nombre de trámite</label>
                                <input type="text" class="form-control" id="nombre_tramite" name="nombre_tramite" aria-describedby="nombre_tramiteHelp">
                                <div id="nombre_tramiteHelp" class="form-text">Ingrese nombre del nuevo tipo de trámite</div>
                            </div>
                            <div class="mb-3">
                                <label for="monto" class="form-label"> Precio de trámite </label>
                                <input type="text" class="form-control" name="monto" id="monto">
                                <div id="nombre_tramiteHelp" class="form-text">Ingrese valor numérico, en caso de ser un trámite gratuito ingrese 0</div>
                            </div>

                            <div class="mb-3">

                                <div class="row">


                                <div class="col-md-10">
                                    <label for="requerimientos" class="form-label"> Requerimientos </label>
                                    <input type="text" class="form-control" name="requerimientos" id="requerimientos" aria-describedby="requerimientosHelp">
                                    <div id="requerimientosHelp" class="form-text">Escriba los requerimientos de <span class="fw-bold">manera individual</span> y luego presione añadir</div>
                                </div>

                                <div class="col-md-2 d-flex align-items-center justify-content-center">
                                    <a href="#" class="btn btn-primary">+</a>
                                </div>

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
