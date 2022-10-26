@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/admin/ciclos.js')}}"></script>
    <script>
        $(document).ready(function(){ loadingDT(@json($data)) });
        $(document).ready(function(){ applyDataTable(); });
    </script>
@endsection

@section('content')

    <div class="bg-light container-fluid my-3 p-4">

        <div class="text-center rounded">
            <div class="d-flex justify-content-between mb-4">
                <h4 class="mb-0 text-secondary fw-bold">Ciclos Escolares</h4>
                <a data-bs-toggle="collapse" href="#newCicloFormContainer" role="button" aria-expanded="false" aria-controls="newCicloForm">Establecer nuevo ciclo escolar</a>
            </div>
        </div>

            <div class="row mb-3 collapse" id="newCicloFormContainer">
                <div class="col-md-4 mx-auto">
                    <form class="d-flex flex-column align-items-center" id="newCicloForm"  method="POST">
                        @csrf

                        <div class="col-md-8 d-flex my-2">
                            <label for="anio" class="col-md-5 col-form-label">Año: </label>
                            <div class="col-md-7">
                                <select class="form-select" name="anio" id="anio">
                                    <option selected value="-"> - </option>
                                    <option value="{{Carbon\Carbon::now()->format('Y')}}"> {{Carbon\Carbon::now()->format('Y')}} </option>
                                    <option value="{{Carbon\Carbon::now()->addYear()->format('Y')}}">
                                        {{Carbon\Carbon::now()->addYear()->format('Y')}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 d-flex my-2">
                            <label for="ciclo" class="col-md-5 col-form-label">Ciclo: </label>
                            <div class="col-md-7">
                                <select class="form-select" name="ciclo" id="ciclo">
                                  <option selected value="-"> - </option>
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 d-flex my-2">
                            <label for="matricula" class="col-md-5 col-form-label">Matricula: </label>
                            <div class="col-md-7">
                                <input type="number" class="form-control" id="matricula" name="matricula" value="0.00">
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col-md-12">
                                <a id="btnCicloSubmit" onclick="submitCiclo()" class="btn btn-primary">Establecer </a>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-md-8">
                    <div class="alert alert-warning" role="alert">
                      <p>Los nuevos ciclos escolares deben crearse al terminarse el semestre, de esta manera el sistema se mantiene actualizado. <span class="fw-bold">Esta acción es obligatoria</span></p>
                      <p class="mb-1"> <span class="fw-bold">Nota:</span> Una vez creado este será aplicado automáticamente al sistema, o en caso de revertir la acción solo elimine el registro en la siguiente tabla. Al eliminar el ciclo automáticamente <span class="fw-bold">se reativa el ciclo anterior</span> </p>
                    </div>

                    <div class="alert alert-warning" role="alert">
                      La matricula se usa exclusivamente para registrarlo y tomarlo en cuenta para los tramites de Constancia de No Adeudo.
                    </div>
                </div>
            </div>

        <div class="table-responsive mt-4 " id="TfinalizadosContainer">
                <table id="Tciclos" class="table text-start -middle table-bordered  mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Semestre</th>
                            <th scope="col">Matricula</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="TciclosTbody">

                    </tbody>
                </table>
        </div>
    </div>


    {{-- MODAL edit ciclo (solo matricula) --}}
    <div class="modal fade" id="ModalCiclo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-light">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalCicloLabel">Ciclo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body bg-light">

                <div class="bg-light rounded h-100 p-4">
                    <form method="POST" id="FormEditCiclo">  <!-- Dynamic modal (create/edit) JS -->
                        @csrf

                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <label for="edit_matricula" class="form-label">Matricula</label>
                                <input type="number" min="0.00" step=".01" class="form-control" id="edit_matricula" name="edit_matricula" >
                                <div id="claveCarreraHelp" class="form-text">Solo ingrese la cantidad de la matrícula.</div>
                                <input type="hidden" class="form-control" id="cicloID" name="cicloID" >
                            </div>
                    </form>
                </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            <a id="BtnSubmitCarrera" onclick="updateMatricula()" class="btn btn-primary" >Modificar</a>
          </div>
        </div>
      </div>
    </div>


@endsection
