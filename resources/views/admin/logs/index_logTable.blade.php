<table id="Tlogs" class="table text-start align-middle table-bordered table-hover mb-0">
    <thead>
        <tr class="text-dark">
            <th scope="col">Fecha de creación</th>
            <th scope="col">Código</th>
            <th scope="col">Usuario responsable</th>
            <th scope="col">Acción</th>
            <th scope="col">Objetivo</th>
        </tr>
    </thead>
    <tbody id="TlogsTbody">
        @foreach($records as $r)
            <tr>
                <td>{{$r->created_at->diffForHumans()}}</td>
                <td>{{$r->user->codigo}}</td>
                <td>{{$r->user->name}} {{$r->user->apellidos}}</td>
                <td>{{$r->action}}</td>
                <td>{{$r->target}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex mt-2 justify-content-center">
    {{ $records->links() }}
</div>
