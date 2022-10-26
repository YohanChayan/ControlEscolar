@extends('layouts.app')

@section('my_scripts')
    @if(isset($dataTable_admins))
        <script>
            document.querySelector('#containerTable').innerHTML = @json($dataTable_admins)
        </script>
    @else
        <script>
            document.querySelector('#containerTable').innerHTML = @json($dataTable_students)
        </script>
    @endif

@endsection

@section('content')
    <div class="bg-light container-fluid my-3 p-4">
    <div class="text-center rounded pb-3">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="mb-0">Registro de actividades @if(isset($dataTable_admins)) administrativas @else Estudiantes @endif </h4>
        </div>
    </div>

        <div id="containerTable">
        </div>
    </div>
@endsection
