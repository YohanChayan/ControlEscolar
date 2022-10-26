@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/admin/tramitesArchivados.js')}}"></script>
    <script>
        $(document).ready( loadingDT(@json($data)) );
        $(document).ready( function () { applyDataTable() });
    </script>
@endsection

@section('content')

    <div class="bg-light container-fluid my-3 p-4">
        <div class="text-center rounded pb-3">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">Tramites archivados</h4>
                <a id="btnCreateTramite" data-bs-toggle="modal" href="#ModalTramiteForm" >Alguna accion</a>
            </div>
        </div>

        <div id="containerTable">
                <table id="Tarchivados" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Folio único</th>
                            <th scope="col">Folio por trámite</th>
                            <th scope="col">Fecha de solicitud</th>
                            <th scope="col">Nombre de Trámite</th>
                            <th scope="col">Correo del alumno</th>
                            <th scope="col">Estatus del trámite</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="TarchivadosTbody">

                    </tbody>
                </table>
        </div>

                <form id="desarchivar_form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="desarchivar_tramite_id" id="desarchivar_tramite_id">
                </form>

            </div>

            {{-- seguimiento --}}
            {{-- <form action="{{ route('tramites.seguimiento') }}" method="POST" id="seguimientoForm">
                @csrf
                <input type="hidden" id="tramite_id" name="tramite_id">
            </form> --}}


            {{-- <form id="archivarTramiteForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="archivar_tramite_id" name="archivar_tramite_id">
            </form> --}}

    </div>

@endsection
