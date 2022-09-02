@extends('layouts.app')

@section('my_scripts')
    {{-- <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        })
    </script> --}}
    <script src="{{asset('js/admin/accesos.js')}}"></script>
    <script>
        $(document).ready( loadingDT(@json($data)) );
        $(document).ready( function () {$('#UserTable').DataTable(); });
    </script>
@endsection

@section('content')

    <div class="bg-light container-fluid my-3 p-4">
        <div class="text-center rounded py-2">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0">Administrativos registrados recientemente</h5>

                <div class="row">
                    <div class="col-sm-2 d-flex align-items-center justify-content-center">
                        <a data-bs-toggle="collapse" href="#filterUserHelp" role="button" aria-expanded="false" aria-controls="filterUserHelp">
                            <i class="fas fa-question pb-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            </div>

            {{-- help --}}
            <div class="row">
                <div class="col-6 mx-auto">
                    <div class="collapse bg-light" id="filterUserHelp" class="form-text" >
                        <span class="fw-bold">Puede filtrar por cada uno de los campos que se encuentran en la tabla.</span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="UserTable" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Fecha de registro</th>
                            <th scope="col">Nombres y Apellidos</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Tipo de usuario</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="userAccess_Tbody">

                    </tbody>
                </table>

                {{-- form Grant/Revoke --}}
                <form id="form_userAccess">
                    @csrf
                </form>

            </div>
        </div>
    </div>

@endsection
