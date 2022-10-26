@extends('layouts.app')
@section('my_scripts')
    <script src="{{asset('js/admin/userFind.js')}}"></script>
@endsection

@section('content')

<div class="bg-light container-fluid my-3 p-4">
    <div class="row g-3 justify-content-center">
        <div class="col-md-6">
            <div class="mb-3 text-center">
                <label for="exampleInputEmail1" class="form-label text-center">
                    <span class="fs-1 fw-bold">Buscar <i class="fas fa-search text-primary"></i></span>
                </label>
                <input type="text" class="form-control" id="user_find" aria-describedby="user_findHelp" placeholder="Buscar usuario" onKeyUp="findUser()">
                <div id="user_findHelp" class="form-text">
                Puede buscar por:
                    <span class="fw-bold">Nombres</span>,
                    <span class="fw-bold">Código</span> ó
                    <span class="fw-bold">Correo</span>.
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive mt-4" id="TfinalizadosContainer">
        <table id="TusersFound" class="table text-start -middle table-bordered  mb-0">
            <thead>
                <tr class="text-dark">
                    <th scope="col">Tipo de Usuario</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Código</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="TusersFoundTbody">
            </tbody>
        </table>
    </div>

    {{-- <form id="form_userAccess" method="POST">
        @csrf
    </form> --}}

</div>


@endsection
