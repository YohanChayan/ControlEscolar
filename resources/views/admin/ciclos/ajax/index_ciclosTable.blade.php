@foreach($ciclos as $c)
{{-- class="table-primary" --}}
<tr id="tr_ciclo_{{$c->id}}" class="{{$c->selected ? 'table-primary' : ''}}">
    <td>{{$c->semestre}}</td>
    <td>${{$c->matricula}}</td>
    <td>
        <div class="d-flex justify-content-evenly align-items-center">
            <a class="text-primary" style="cursor: pointer;">
                <span data-bs-toggle="tooltip" onclick="edit({{$c->id}},{{$c->matricula}})" data-bs-placement="top" title="Editar matricula">
                    <i class="fas fa-edit"></i>
                 </span>
            </a>

            <a class="text-danger" onclick="remove_fromCiclo({{$c->id}})" style="cursor: pointer;" >
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar ciclo">
                    <i class="fas fa-trash"></i>
                 </span>
            </a>
        </div>
    </td>

</tr>
@endforeach
