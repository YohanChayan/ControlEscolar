@extends('layouts.app')


@section('my_scripts')

    {{-- <script src="{{asset('js/admin/tramites.js')}}"></script> --}}

@endsection

@section('content')

    <div class="container-fluid pt-4 px-4">

        <div class="bg-light text-center rounded p-4 mb-2">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Administrativos registrados recientemente</h6>

                <form action="#" method="POST">

                </form>

                <div class="row">
                    <label for="filterUser" class="col-sm-2 col-form-label">Filtro:</label>
                    <div class="col-sm-8">
                        <input type="text" id="filterUser" name="filterUser" class="form-control">

                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-center">
                        <a data-bs-toggle="collapse" href="#filterUserHelp" role="button" aria-expanded="false" aria-controls="filterUserHelp">
                            <i class="fas fa-question pb-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="collapse bg-light" id="filterUserHelp">
                <span class="fw-bold">Puede filtrar por cada uno de los campos que se encuentran en la tabla.</span>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Nombre de Trámite</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-center align-items-center my-4">
                    {{-- {{$tramites->links()}} --}}
                </div>
            </div>

        </div>

        <div class="bg-light text-center rounded p-4 mb-2">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Administrativos registrados recientemente</h6>

                <form action="#" method="POST">

                </form>

                <div class="row">
                    <label for="filterUser" class="col-sm-2 col-form-label">Filtro:</label>
                    <div class="col-sm-8">
                        <input type="text" id="filterUser" name="filterUser" class="form-control">

                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-center">
                        <a data-bs-toggle="collapse" href="#filterUserHelp" role="button" aria-expanded="false" aria-controls="filterUserHelp">
                            <i class="fas fa-question pb-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="collapse bg-light" id="filterUserHelp">
                <span class="fw-bold">Puede filtrar por cada uno de los campos que se encuentran en la tabla.</span>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Nombre de Trámite</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-center align-items-center my-4">
                    {{-- {{$tramites->links()}} --}}
                </div>
            </div>

        </div>

        <div class="bg-light text-center rounded p-4 mb-2">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="mb-0">Administrativos registrados recientemente</h6>

                <form action="#" method="POST">

                </form>

                <div class="row">
                    <label for="filterUser" class="col-sm-2 col-form-label">Filtro:</label>
                    <div class="col-sm-8">
                        <input type="text" id="filterUser" name="filterUser" class="form-control">

                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-center">
                        <a data-bs-toggle="collapse" href="#filterUserHelp" role="button" aria-expanded="false" aria-controls="filterUserHelp">
                            <i class="fas fa-question pb-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="collapse bg-light" id="filterUserHelp">
                <span class="fw-bold">Puede filtrar por cada uno de los campos que se encuentran en la tabla.</span>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Nombre de Trámite</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-center align-items-center my-4">
                    {{-- {{$tramites->links()}} --}}
                </div>
            </div>

        </div>

        <div class="bg-light text-center rounded p-4 mb-2">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Administrativos registrados recientemente</h6>

                <form action="#" method="POST">

                </form>

                <div class="row">
                    <label for="filterUser" class="col-sm-2 col-form-label">Filtro:</label>
                    <div class="col-sm-8">
                        <input type="text" id="filterUser" name="filterUser" class="form-control">

                    </div>
                    <div class="col-sm-2 d-flex align-items-center justify-content-center">
                        <a data-bs-toggle="collapse" href="#filterUserHelp" role="button" aria-expanded="false" aria-controls="filterUserHelp">
                            <i class="fas fa-question pb-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="collapse bg-light" id="filterUserHelp">
                <span class="fw-bold">Puede filtrar por cada uno de los campos que se encuentran en la tabla.</span>
            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Nombre de Trámite</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td> Tramite </td>
                            <td> Monto </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    {{-- <a href="#" class="btn btn-sm btn-primary" title="Detalles">Detalles </a> --}}
                                    <div class="col-md-4">
                                        <a class="text-primary" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                                                <i class="fas fa-edit"></i>
                                             </span>
                                        </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a class="text-danger" style="cursor: pointer;">
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                                                <i class="fas fa-trash"></i>
                                             </span>
                                        </a>
                                    </div>


                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-center align-items-center my-4">
                    {{-- {{$tramites->links()}} --}}
                </div>
            </div>

        </div>





    </div>

@endsection
