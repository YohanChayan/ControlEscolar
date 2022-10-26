<table id="Tpendientes" class="table text-start align-middle table-bordered table-hover mb-0">
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
    <tbody id="TpendientesTbody">

@foreach($pendientes as $p)
    <tr>
        <td style="width: 5%"> {{  $p->id }} </td>
        <td style="width: 10%"> {{  $p->folio }} </td>
        <td > {{  $p->created_at->format('d-m-Y') }} </td>
        <td > {{  $p->tramite->nombre_tramite }} </td>
        <td > {{  $p->student->email }} </td>
        <td > {{  $p->estatus }} </td>
        <td>
            <div class="d-flex justify-content-between align-items-center">
                <div class="col-md-4">

                    <a class="text-primary" onclick="seguimientoTramite({{$p->id}})"  style="cursor: pointer;">
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Detalles">
                            <i class="fas fa-eye"></i>
                         </span>
                    </a>
                </div>

                <div class="col-md-4">

                {{-- href="{{route('tramites.archivar', $p->id)}}" --}}
                    <a onclick="archivarTramite({{$p->id}})" class="text-secondary td_archivarT" id="ar_{{$p->id}}" style="cursor: pointer;" >
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Archivar trámite">
                            <i class="fas fa-folder"></i>
                         </span>
                    </a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
    </tbody>
</table>

<div class="d-flex mt-2 justify-content-center">
    {{ $pendientes->links() }}
</div>

