@extends('layouts.app')

@section('my_scripts')
    <script>
      $(document).ready( function () {
          $('#TramitesPendientesTable').DataTable();
      });
    </script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        })
    </script>

@endsection

@section('content')

<div class="container">
    <!-- Sale & Revenue Start -->
    <div class="container-fluid p-2">

        @if (session('estatus'))
            <div class="alert alert-success">
                {{ session('estatus') }}
            </div>
        @endif

        @can('admin')
        <div class="row g-4">

            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Estudiantes registrados</p>
                        <h6 class="mb-0">2</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Trámites realizados</p>
                        <h6 class="mb-0">2</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Administrativos registrados</p>
                        <h6 class="mb-0">1</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Carreras registradas</p>
                        <h6 class="mb-0">84</h6>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
    <!-- Sale & Revenue End -->
    <div class="col-md-8 col-xl-8 my-4 mx-auto">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Ingrese código QR</h6>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 150px;"></textarea>
                <label for="floatingTextarea">QR</label>
            </div>
        <button type="button" class="btn btn-primary m-2">Buscar
            <i class="far fa-file-alt ms-2"></i>
        </button>
        </div>
    </div>

    @endcan

    <!-- Recent Sales Start -->
    @can('student')
        <div class="bg-light container-fluid p-4">
        <div class="text-center rounded ">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0">Tramites solicitados</h5>
                <a href="#">Mostrar todos</a>
            </div>
        </div>

            <div class="table-responsive">
                <table id="TramitesPendientesTable" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">Nombre de tramite</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Fecha de creación</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php($index = 1) --}}
                            @foreach($tramites as $tr)
                                <tr>
                                    {{-- <th scope="row">{{$index}}</th> --}}
                                    <td> {{$tr->tramite->nombre_tramite}} </td>
                                    <td> {{$tr->tramite->monto}} </td>
                                    <td> {{  date("d M Y", strtotime($tr->created_at)) }} </td>
                                    <td> {{$tr->estatus}} </td>
                                    <td>
                                        <div class="d-flex justify-content-evenly align-items-center">
                                            <div class="col-md-4">
                                                <a class="text-primary" style="cursor: pointer;">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Detalles">
                                                        <i class="fas fa-eye mx-2"></i>
                                                     </span>
                                                </a>
                                            </div>

                                            <div class="col-md-4">
                                                <a class="text-secondary" style="cursor: pointer;" >
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Formato">
                                                        {{-- <i class="fas fa-file mx-2"></i> --}}
                                                        <i class="far fa-file-alt me-2"></i>
                                                     </span>
                                                </a>
                                            </div>
                                        </div>



                                    </td>
                                </tr>
                            @endforeach

                    </tbody>
                </table>

                {{-- <div class="d-flex justify-content-center align-items-center my-4">
                    {{ $tramites->links() }}
                </div> --}}

            </div>
        </div>
    </div>
    @endcan
    <!-- Recent Sales End -->

    <!-- Widgets Start -->
    @can('student')
        {{-- <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Messages</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="{{asset('custom/dashboard/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="{{asset('custom/dashboard/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="{{asset('custom/dashboard/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center pt-3">
                        <img class="rounded-circle flex-shrink-0" src="{{asset('custom/dashboard/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--  Calendar -->
                <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Calender</h6>
                        <a href="">Show All</a>
                    </div>
                    <div id="calender"></div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="h-100 bg-light rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">To Do List</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="d-flex mb-2">
                        <input class="form-control bg-transparent" type="text" placeholder="Enter task">
                        <button type="button" class="btn btn-primary ms-2">Add</button>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox" checked>
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span><del>Short task goes here...</del></span>
                                <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <input class="form-check-input m-0" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center pt-2">
                        <input class="form-check-input m-0" type="checkbox">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 align-items-center justify-content-between">
                                <span>Short task goes here...</span>
                                <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @endcan
    <!-- Widgets End -->

    <!-- Footer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    @can('none')
                        Usted no tiene acceso, por favor comuníquese con control escolar.
                    @endcan

                    @canany(['student', 'admin'])
                        User verified and with role
                    @endcan
                </div>
                {{-- <div class="col-12 col-sm-6 text-center text-sm-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                </br>
                Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Footer End -->



    <!-- Spinner Start -->
    {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>


        <!-- Sales Chart Start -->
            {{-- <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Worldwide Sales</h6>
                            <a href="">Show All</a>
                        </div>
                        <canvas id="worldwide-sales"></canvas>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Salse & Revenue</h6>
                            <a href="">Show All</a>
                        </div>
                        <canvas id="salse-revenue"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Sales Chart End -->
    <!-- Spinner End -->



</div>

@endsection
