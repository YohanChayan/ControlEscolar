@extends('layouts.app')

@section('my_scripts')
    <script src="{{asset('js/admin/cambioCarrera.js')}}"></script>
    <script>
        $(document).ready( loadingDT(@json($data)) );
        $(document).ready( applyDataTable() );
    </script>
@endsection

@section('content')

    <div class="bg-light container-fluid my-3 p-4">
        <div class="text-center rounded pb-3">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0 text-secondary">Solicitudes de cambio de carrera</h3>
            </div>
        </div>

            <div id="containerTable">

            </div>

            {{-- permitir-cambio-carrera o rechazar-cambio-carrera --}}
            <form action="#" method="POST" id="AccionCambioCarrera">
                @csrf
                <input type="hidden" id="solicitudCambio_id" name="solicitudCambio_id">
            </form>
        </div>

@endsection
