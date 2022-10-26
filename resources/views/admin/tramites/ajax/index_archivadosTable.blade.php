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

@foreach($archivados as $a)
    <tr id="t_ar_{{$a->id}}">
        <td style="width: 5%"> {{  $a->id }} </td>
        <td style="width: 10%"> {{  $a->folio }} </td>
        <td > {{  $a->created_at->format('d-m-Y') }} </td>
        <td > {{  $a->tramite->nombre_tramite }} </td>
        <td > {{  $a->student->email }} </td>
        <td > {{  $a->estatus }} </td>
        <td>
            <div class="d-flex justify-content-center align-items-center">
                <div class="col-md-4">
                    {{-- onclick="desarchivar_tramite({{$a->id}})" --}}
                    <a onclick="desarchivar_tramite({{$a->id}})" class="text-primary td_desarchvarT" id="desar_{{$a->id}}"  style="cursor: pointer;">
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Desarchivar">
                            <i class="fas fa-duotone fa-folder-open"></i>
                         </span>
                    </a>
                </div>

                {{-- <div class="col-md-4">
                    <a class="text-danger" style="cursor: pointer;" >
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar tramite">
                            <i class="fas fa-trash"></i>
                         </span>
                    </a>
                </div> --}}
            </div>
        </td>
    </tr>
@endforeach
    </tbody>
</table>
