@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row h-100 align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="col-8 col-sm-8 col-md-10 col-lg-10 col-xl-10">
            <div class="bg-light rounded h-100 p-4">
                <h2 class="mb-4">Solicitud para trámite</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tramites.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="mb-3 col-md-6">
                            <label for="exampleInputEmail1" class="form-label">Correo Institucional</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{auth()->user()->email}}" readonly>
                            <div id="emailHelp" class="form-text">Es importante destacar que por este medio se le notificará sobre el estado de su trámite.
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="codigo" class="form-label">Código</label>
                            <input type="text" class="form-control" name="codigo" id="codigo" aria-describedby="" value="{{ auth()->user()->codigo }}" readonly>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" value="{{auth()->user()->name}}" readonly>
                            {{-- <div id="" class="form-text">Es importante destacar que por este medio se le notificará sobre el estado de su trámite.
                            </div> --}}
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" aria-describedby="emailHelp" value="{{auth()->user()->apellidos}}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-floating mb-3 col-6">
                            <select class="form-select" name="tramite" id="nombre_tramite" aria-label="Floating label select example">
                                <option selected=""> - </option>
                                <option value="Certificado parcial de estudio">Certificado parcial de estudio</option>
                                <option value="Certificado total de estudio">Certificado total de estudio</option>
                                <option value="Certificado de graduado">Certificado de graduado</option>
                                <option value="Acta de titulacion">Acta de titulación</option>
                            </select>
                            <label class="px-3" for="nombre_tramite">Seleccione el trámite que desea realizar</label>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="#" class="btn btn-primary rounded-pill m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Ver requisitos</a>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-success">Solicitar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal  fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Trámites</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

                    <div class="row g-2">
                           <div class="col-md-6 mb-2">

                              <div class="card text-center">
                                  <div class="card-header ">

                                  <p class="fw-bolder mb-0">Certificado parcial de estudio</p>

                                  </div>
                                  <div class="card-body">
                                    {{-- <h5 class="card-title">Special title treatment</h5> --}}
                                    <p class="card-text">
                                        Se tramita cuando no se cubre el total de asignaturas del plan de estudios de tu programa académico.
                                    </p>

                                    <div class="btn-group dropend">
                                       <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                           Ver
                                         </button>

                                         <ul class="dropdown-menu">
                                           <li><a class="dropdown-item" href="#">Action</a></li>
                                           <li><a class="dropdown-item" href="#">Action two</a></li>
                                           <li><a class="dropdown-item" href="#">Action three</a></li>
                                         </ul>

                                    </div>

                                  </div>
                                </div>
                            </div>
                           <div class="col-md-6 mb-2">

                                <div class="card text-center">
                                    <div class="card-header">
                                      <p class="fw-bolder mb-0">Certificado total de estudio</p>
                                    </div>
                                    <div class="card-body">
                                      {{-- <h5 class="card-title">Special title treatment</h5> --}}
                                      <p class="card-text">
                                        Se tramita cuando hayas cubierto el total de asignaturas (100% de créditos) del plan de estudios de tu programa académico y estén aprobadas.
                                      </p>

                                      <div class="btn-group dropend">
                                         <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                             Ver
                                           </button>

                                           <ul class="dropdown-menu">
                                             <li><a class="dropdown-item" href="#">Action</a></li>
                                             <li><a class="dropdown-item" href="#">Action two</a></li>
                                             <li><a class="dropdown-item" href="#">Action three</a></li>
                                           </ul>

                                      </div>

                                    </div>
                                  </div>

                            </div>


                </div>

                    <div class="row g-2">
                               <div class="col-md-6 mb-2">

                                   <div class="card text-center">
                                        <div class="card-header">
                                          <p class="fw-bolder mb-0">Certificado de graduado</p>
                                        </div>
                                        <div class="card-body">
                                          {{-- <h5 class="card-title">Special title treatment</h5> --}}
                                          <p class="card-text">El Certificado Total de Estudios contiene solo las materias cursadas con sus respectivas calificaciones y el Certificado de Graduado es el Certificado Total de Estudios y se añade un transcripción del Acta de Titulación en Original.</p>

                                          <div class="btn-group dropend">
                                             <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                 Ver
                                               </button>

                                               <ul class="dropdown-menu">
                                                 <li><a class="dropdown-item" href="#">Action</a></li>
                                                 <li><a class="dropdown-item" href="#">Action two</a></li>
                                                 <li><a class="dropdown-item" href="#">Action three</a></li>
                                               </ul>

                                          </div>

                                        </div>
                                      </div>
                                </div>
                               <div class="col-md-6 mb-2">

                               <div class="card text-center">
                                   <div class="card-header">
                                     <p class="fw-bolder mb-0">Acta de titulación</p>
                                   </div>
                                   <div class="card-body">
                                     {{-- <h5 class="card-title">Special title treatment</h5> --}}
                                     <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                                     <div class="btn-group dropend">
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                            Ver
                                          </button>

                                          <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Action two</a></li>
                                            <li><a class="dropdown-item" href="#">Action three</a></li>
                                          </ul>

                                     </div>

                                   </div>
                                 </div>

                                   {{-- <div class="card">
                                     <div class="card-body">
                                       <h5 class="card-title">Acta de titulación</h5>
                                       <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                       <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                        <div class="btn-group dropend">
                                           <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                               Ver
                                             </button>

                                             <ul class="dropdown-menu">
                                               <li><a class="dropdown-item" href="#">Action</a></li>
                                               <li><a class="dropdown-item" href="#">Action two</a></li>
                                               <li><a class="dropdown-item" href="#">Action three</a></li>
                                             </ul>

                                        </div>
                                      </div>
                                    </div> --}}
                                </div>
                    </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

</div>


@endsection
