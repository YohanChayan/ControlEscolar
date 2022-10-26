@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/userinfo.js')}}"></script>
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">

        <div class="bg-light text-center rounded p-4 mb-2">

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <form action="{{route('users.update')}}" method="POST">
                        @csrf
                        <div class="row g-3 p-2">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nombres </label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" id="apellidos" value="{{$user->apellidos}}" readonly>
                            </div>
                        </div>

                        <div class="row g-3 p-2">
                            <div class="mb-3 col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Correo</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{$user->email}}" readonly="">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="codigo" class="form-label">Código: </label>
                                <input type="text" name="codigo" class="form-control" id="codigo" aria-describedby="emailHelp" value="{{$user->codigo}}" readonly>
                            </div>
                        </div>
                        @if( !(is_null($user->clave_carrera) && is_null($user->carrera)) )
                            <div class="row g-3 p-2">
                                <div class="mb-3 col-md-6">
                                    <label for="carrera" class="form-label">Carrera</label>
                                    <textarea readonly name="carrera" id="carrera" rows="3" class="form-control">{{$user->nombre_carrera}}</textarea>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="codigo" class="form-label">Clave de Carrera</label>
                                    <input type="text" class="form-control" name="clave_carrera" id="clave_carrera" value="{{$user->clave_carrera}}" readonly>
                                </div>

                                <div class="mb-3 col-md-3">
                                    <label for="ciclo_admision" class="form-label">Ciclo de admisión</label>
                                    <input type="text" class="form-control" id="ciclo" aria-describedby="ciclo_admisionHelp" readonly value="{{$user->ciclo_admision}}">
                                </div>
                            </div>
                        @endif

                        <div class="row g-3 p-2">

                            <div class="mb-3 col-md-5">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" aria-describedby="telefonoHelp" readonly value="{{$user->telefono}}">
                            </div>



                            <div class="col-md-5 d-flex justify-content-center align-items-center p-4 my-4">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#passwordModal">Cambiar contraseña</a>
                            </div>
                        </div>

                        <div class="row gx-4 p-4">
                            <div class="col md-6 mx-auto">
                                <a onclick="enableEdit()" class="mx-2 btn btn-secondary">Editar</a>
                                <button type="submit" class="mx-2 btn btn-primary btn-lg">Actualizar</button>
                            </div>
                        </div>

                    </form>
                </div>

                {{-- Modal --}}
                <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header bg-light">
                            <h5 class="modal-title" id="passwordModalLabel">Cambiar contraseña</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body bg-light">

                            <div class="row">
                                <div class="col-md-9">
                                    <label for="newPassword" class="form-label">Nueva contraseña</label>
                                    <input type="password" class="form-control" id="newPassword" aria-describedby="archivosHelp" >

                                </div>
                                <div class="col-md-2 d-flex justify-content-center align-items-center mt-4">
                                    <a id="eyeButton" onclick="togglePasswordView()" class="btn btn-primary">
                                        <i id="iconEye" class="fas fa-eye-slash"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
                                    <input type="password" class="form-control" id="confirmPassword" aria-describedby="archivosHelp" >
                                </div>
                            </div>

                          </div>
                          <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Guardar Cambios</button>
                          </div>
                    </div>
                    </div>
                    </div>
            </div>
                </div>
            </div>
        </div>
    </div>
@endsection
