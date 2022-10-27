<table id="carreraTable" class="table text-start align-middle table-bordered table-hover mb-0">
    <thead>
        <tr class="text-dark">
            <th scope="col">Nombre de carrera</th>
            <th scope="col">Clave carrera</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="carreraTbody">

@foreach($carreras as $c)
    <tr id="ca_{{$c->wrapperID}}">
        <td> {{ $c->nombre }} </td>
        <td>
            {{$c->claves}}
         </td>
        <td>
            <div class="d-flex justify-content-evenly align-items-center">
                <div class="col-md-4">
                    <a onclick="editCareer({{$c->wrapperID}})" class="text-primary" style="cursor: pointer;">
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Carrera">
                            <i class="fas fa-edit mx-2"></i>
                         </span>
                    </a>
                </div>

                @if($c->wrapperID > 84)
                    <div class="col-md-4">
                        <a onclick="removeCareer({{$c->wrapperID}})"  class="text-danger" style="cursor: pointer;">
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Carrera">
                                <i class="fas fa-trash mx-2"> </i>
                             </span>
                        </a>
                    </div>
                @endif
            </div>
        </td>
    </tr>
@endforeach
</tbody>
</table>
