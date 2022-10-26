<!-- Sidebar Start -->
<div class="sidebar pe-2 pb-3">
    <nav class="navbar bg-light navbar-light">
        {{-- <a href="#" class="navbar-brand mx-4">
            <h3 class="text-primary">
                Control Escolar
            </h3>
        </a> --}}
        <div class="d-flex align-items-center mb-2">
            <a href="{{route('home')}}" class="nav-item nav-link active">
                <img class="img-fluid" src="{{asset('custom/dashboard/img/logo_cucsh.png')}}" alt="logo cucsh">
            </a>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{route('home')}}" class="nav-item nav-link active">
                <i class="fa fa-home me-2"></i>
                    Inicio
                </a>
            @can('student')
                <a href="{{route('tramites.solicitar')}}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>Trámites
                </a>

                <a href="{{route('users.solicitud_cambioCarrera')}}" class="nav-item nav-link d-flex">
                    <i class="fas fa-exchange-alt w-25"></i>
                    <small class="ms-2">Solicitud de cambio carrera</small>
                </a>

            @endcan
            @canany(['admin', 'coordinador'])

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Trámites</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        @can('coordinador')
                        <a href="{{route('tramites.index')}}" class="dropdown-item mx-4 fw-bold">Disponibles</a>
                        @endcan
                        <a href="{{route('tramites.pendientes')}}" class="dropdown-item mx-4">Pendientes</a>
                        <a href="{{route('tramites.finalizados')}}" class="dropdown-item mx-4">Finalizados</a>
                        <a href="{{route('tramites.archivados')}}" class="dropdown-item mx-4">Archivados</a>
                        <a href="{{route('tramites.rechazados')}}" class="dropdown-item mx-4">Rechazados</a>
                    </div>
                </div>

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-key me-2"></i> <small>Solicitudes de acceso</small> </a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{route('userAccess.indexStudents')}}" class="dropdown-item mx-4">Estudiantes</a>
                        <a href="{{route('userAccess.index')}}" class="dropdown-item mx-4">Administrativos</a>
                    </div>
                </div>

                <div class="nav-item dropdown">

                {{-- @can('coordinador') --}}
                <a href="{{route('users.usersFind')}}" class="nav-item nav-link"><i class="fas fa-users me-2"></i>Usuarios</a>
                {{-- @endcan --}}

                </div>
                @can('coordinador')
                <a href="{{route('carreras.index')}}" class="nav-item nav-link"><i class="fa fa-graduation-cap me-2"></i>Carreras
                </a>
                <a href="{{route('ciclos.index')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Ciclos Escolares
                </a>
                @endcan
                <a href="{{route('users.index_cambioCarreras')}}" class="nav-item nav-link d-flex">
                    <i class="fas fa-exchange-alt w-25"></i>
                    <small class="ms-2">Solicitudes de cambio carrera</small>
                </a>

                <a href="{{route('graficas.index')}}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Gráficas
                </a>


            @endcanany
        </div>
    </nav>
</div>
<!-- Sidebar End -->
