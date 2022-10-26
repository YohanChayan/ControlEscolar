@foreach($tramites as $t)
    <tr id="tr_{{$t->id}}">
        {{-- <td> {{  $t->id }} </td> --}}
        <td> {{  $t->nombre_tramite }} </td>
        <td>
            @if($t->monto == 0)
                Gratuito
            @else
                ${{$t->monto}}
            @endif
         </td>
        <td style="width:40%;"> {{  str_replace('|', ',', $t->requerimientos)  }} </td>
        <td>
            @if($t->disponible)
                <p class="fw-bold text-center text-success">Disponible</p>
            @else
                <p class="fw-bold text-center text-danger">No disponible</p>
            @endif

         </td>
        <td> {{  $t->aviso }} </td>
        <td>
            <div class="d-flex justify-content-evenly align-items-center">
                <a class="text-primary td_tramite_edit" onclick="edit({{$t}})" id="ed_{{$t->id}}" style="cursor: pointer;">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tramite">
                        <i class="fas fa-edit"></i>
                     </span>
                </a>

                {{-- evitar que eliminen los primeros 5 tramites --}}
                @if($t->id > 5)
                    <a class="text-danger td_tramite_delete" id="del_{{$t->id}}" style="cursor: pointer;" >
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar trámite">
                            <i class="fas fa-trash"></i>
                         </span>
                    </a>
                @endif
            </div>
        </td>
    </tr>
@endforeach
