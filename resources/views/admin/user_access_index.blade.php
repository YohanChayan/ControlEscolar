@extends('layouts.app')

@section('content')

    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Administrativos registrados recientemente</h6>
                {{-- <a href="#">Mostrar todos</a> --}}
                <form action="#" method="POST">
                    {{-- <div class="form-floating ">
                        <select class="form-select" name="filterby" id="filterby" aria-label="Floating label select example">
                            <option selected value="admin"> Administrativos </option>
                            <option value="student"> Estudiantes </option>
                        </select>
                        <label class="px-3" for="filterby">Filtrar por:</label>
                    </div> --}}
                </form>
                <a href="#">Mostrar todos</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
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
                    <tbody>
                        {{-- @php($index = 1) --}}
                            @foreach($users as $u)
                                <tr>
                                    <td> {{  date("d M Y", strtotime($u->created_at)) }} </td>
                                    <td> {{$u->name}} {{$u->apellidos}} </td>
                                    <td> {{$u->email}} </td>
                                    <td>
                                        {{-- @if($u->code_length > 7)
                                            Estudiante
                                        @else
                                            Administrativo
                                        @endif --}}
                                        Administrativo
                                    </td>
                                    <td> {{$u->estatus}} </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary" href="">Detalles</a>
                                    </td>
                                </tr>
                                {{-- @php($index++) --}}
                            @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
