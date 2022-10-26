@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/admin/accesosStudent.js')}}"></script>
    <script>
        $(document).ready( loadingDT(@json($data)) );
    </script>
@endsection

@section('content')

    <div class="bg-light container-fluid my-3 p-4">
        <div class="text-center rounded py-2">
            <div class="d-flex align-items-center justify-content-center mb-4">
                <h3 class="mb-0 text-secondary fw-bold">Estudiantes registrados recientemente</h3>
            </div>

            </div>

            <div class="table-responsive" id="StudentTableContainer">

            </div>

            {{-- form Grant --}}
            <form action="{{route('userAccess.grantStudent')}}" id="form_userAccess" method="POST">
                @csrf
                <input type="hidden" id="user_id" name="user_id">
            </form>
        </div>

        <div class="modal fade" data-bs-backdrop="static" id="StudentPreviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg ">
            <div class="modal-content ">
              <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Vista Previa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-3">

                <div class="border p-4 bg-light">
                    <form action="{{route('userAccess.notifyStudent')}}" method="POST" id="formPreviewStudent">
                        @csrf
                        <input type="hidden" name="st_identifier" id="st_identifier">
                        <div class="row g-3">
                            <div class="mb-3 col-md-6 text-center">
                                <div class="form-check form-switch text-center d-flex justify-content-center my-1">
                                    <input class="form-check-input" name="student_name_isWrong" value="name" type="checkbox" role="switch" id="student_name_isWrong">
                                </div>
                                <label for="student_name" class="form-label">Nombres</label>
                                <input type="text" name="student_name" class="form-control" id="student_name" aria-describedby="student_nameHelp" readonly>
                            </div>
                            <div class="mb-3 col-md-6 text-center">

                                <div class="form-check form-switch text-center d-flex justify-content-center my-1">
                                    <input class="form-check-input" name="student_apellidos_isWrong" value="apellidos" type="checkbox" role="switch" id="student_apellidos_isWrong">
                                </div>

                                <label for="student_apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="student_apellidos" id="student_apellidos" readonly>
                            </div>
                        </div>

                        <div class="row gx-3">

                            <div class="form-check form-switch text-center d-flex justify-content-center my-1">
                                <input class="form-check-input" name="student_email_isWrong" value="email" type="checkbox" role="switch" id="student_email_isWrong">
                            </div>

                            <div class="mb-3 col-md-8  mx-auto text-center">
                                <label for="student_email" class="form-label">Correo electrónico</label>
                                <input type="email" name="student_email" class="form-control" id="student_email" readonly>
                            </div>
                        </div>
                        <div class="row g-3">

                            <div class="mb-3 col-md-3 mx-auto text-center">

                                <div class="form-check form-switch text-center d-flex justify-content-center my-1">
                                    <input class="form-check-input" name="student_cicloAdmision_isWrong" value="ciclo_admision" type="checkbox" role="switch" id="student_cicloAdmision_isWrong">
                                </div>

                                <label for="student_cicloAdmision" class="form-label">Ciclo de admisión</label>
                                <input type="text" class="form-control" name="student_cicloAdmision" id="student_cicloAdmision" readonly>
                            </div>

                            <div class="mb-3 col-md-3 mx-auto text-center">

                                <div class="form-check form-switch text-center d-flex justify-content-center my-1">
                                    <input class="form-check-input" name="student_codigo_isWrong" value="codigo" type="checkbox" role="switch" id="student_codigo_isWrong">
                                </div>

                                <label for="student_codigo" class="form-label">Código</label>
                                <input type="text" class="form-control" name="student_codigo" id="student_codigo" readonly="">
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="mb-4 col-md-10 mx-auto text-center">

                                <div class="form-check form-switch text-center d-flex justify-content-center my-1">
                                    <input class="form-check-input" name="student_carrera_isWrong" value="nombre_carrera" type="checkbox" role="switch" id="student_carrera_isWrong">
                                </div>

                                <label for="student_carrera" class="form-label">Carrera</label>
                                <input type="text" class="form-control" name="student_carrera" id="student_carrera" readonly>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 mx-auto text-center">
                                <button type="button" onclick="edit_revokeStudent()" id="BtnNotifyError" class="btn btn-warning">Seleccionar errores <i class="fas fa-ban mx-2"></i> </button>


                                <a onclick="cancel_edit_revokeStudent()" id="cancelEditError" class="d-none ms-4 btn btn-primary">Cancelar</a>
                            </div>
                        </div>

                        <div class="d-none row mt-2" id="selecccione_Wrongs_container">
                            <div class="col-md-8 mx-auto">
                                <div class="alert alert-warning border" role="alert">
                                  Seleccione los campos que están incorrectos.
                                </div>
                            </div>
                         </div>
                    </form>
                </div>
              </div>
              <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="BtnActionStudent" class="btn btn-success" >Otorgar acceso <i class="fas fa-key mx-2"></i> </button>
              </div>
            </div>
          </div>
        </div>

    </div>

@endsection
