@if(count($users) == 0)
<tr>
    <td colspan="7" class="text-center"> No se encontraron registros </td>
</tr>
@else
    @foreach($users as $u)
        @php $isStudent = strlen($u->codigo) == 9 @endphp
        <tr id="tr_usr_{{$u->id}}">
            <td>
                @if($isStudent)
                    Estudiante
                @else
                    Administrativo
                @endif
            </td>
            <td>
                @if($u->estatus == 'Activo')
                    <span class="fw-bold text-success">{{$u->estatus}}</span>
                @else
                    <span class="fw-bold text-secondary">{{$u->estatus}}</span>
                @endif
            </td>
            <td>{{$u->name}}</td>
            <td>{{$u->apellidos}}</td>
            <td>{{$u->codigo}}</td>
            <td>{{$u->email}}</td>
            <td class="text-center">
                @if(!$isStudent && $u->estatus == 'Activo' && $u->codigo != auth()->user()->codigo)
                    <a href="#" class="link-danger" onclick="revokeAdmin({{$u->id}})">
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Revocar Acceso">
                            <i class="fas fa-ban"></i>
                         </span>
                    </a>
                @else
                    -
                @endif
            </td>
        </tr>
    @endforeach
@endif
