@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/admin/carreras.js')}}"></script>
    <script>
        $(document).ready( loadingDT(@json($data)) );
        $(document).ready( applyDataTable() );
    </script>
@endsection

@section('content')

    <div class="bg-light container-fluid my-3 p-4">
        <div class="text-center rounded pb-3">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0 text-secondary fw-bold">Carreras disponibles</h4>
                <a id="btnCreateCarrera" onclick="newCareer()" class="text-primary" style="cursor:pointer;" >Nueva carrera</a>
            </div>
        </div>

        <div id="containerTable">

        </div>

        <form action="#" method="POST" id="FormBorrarCarrera">
            @csrf
            @method('DELETE')
            <input type="hidden" name="wrapperID_delete" id="wrapperID_delete">
        </form>

    </div>

        {{-- MODAL create/edit carrera --}}
        <div class="modal fade" id="ModalCarreraForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-light">
              <div class="modal-header">
                <h5 class="modal-title" id="ModalCarreraLabel">Nueva Carrera</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body bg-light">

                    <div class="bg-light rounded h-100 p-4">
                        <form method="POST" id="FormCarrera">  <!-- Dynamic modal (create/edit) JS -->
                            @csrf

                            <div class="row">

                            <div class="col-md-6">

                                <label for="nombre_carrera" class="form-label">Nombre de carrera</label>
                                <input type="text" class="form-control" id="nombre_carrera" name="nombre_carrera" >


                                <label for="claveCarrera" class="form-label"> Clave de carrera </label>
                                <input type="text" class="form-control" name="claveCarrera" id="claveCarrera" aria-describedby="claveCarreraHelp">
                                <div id="claveCarreraHelp" class="form-text">En caso de tener multiples claves agregar cada una<span class="fw-bold"> de manera individual</span> y luego presione añadir</div>


                                <div class="my-2">
                                    <a href="#" onclick="addKey()" class="btn btn-primary">+</a>
                                </div>


                            </div>

                            <div class="col-md-6">

                                <div class="rounded h-100 p-4">
                                    <h6 class="mb-1">Claves</h6>
                                    <table class="table table-bordered" id="reqsTable">
                                        <thead>
                                            <tr>
                                                <th scope="col"> Nombre </th>
                                                <th scope="col"> Acciones </th>
                                            </tr>
                                        </thead>
                                        <tbody id="clavesTBody">

                                            {{-- <tr class="clave_index">
                                                <th scope="row">Indice</th>
                                                <td>Clave </td>
                                                <td>Borrar</td>
                                            </tr> --}}

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            </div>
                        </form>
                    </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <a id="BtnSubmitCarrera" onclick="submitCareer()" class="btn btn-primary" >Accion Carrera</a>
              </div>
            </div>
          </div>
        </div>

    </div>

@endsection
