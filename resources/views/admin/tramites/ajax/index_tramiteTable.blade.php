@foreach($tramites as $t)
    <tr>
        <td> {{  $t->nombre_tramite }} </td>
        <td> {{  $t->monto }} </td>
        <td> {{  $t->requerimientos }} </td>
        <td>
            <div class="d-flex justify-content-center align-items-center">
                <div class="col-md-4">
                    <a class="text-primary" onclick="edit({{$t}})" style="cursor: pointer;">
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                            <i class="fas fa-edit"></i>
                         </span>
                    </a>
                </div>

                <div class="col-md-4">
                    <a class="text-danger" style="cursor: pointer;" onclick="removeTramite({{$t->id}})">
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                            <i class="fas fa-trash"></i>
                         </span>
                    </a>
                </div>
            </div>
        </td>
    </tr>
@endforeach
