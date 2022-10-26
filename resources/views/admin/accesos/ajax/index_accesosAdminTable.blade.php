<table id="AdminTable" class="table text-start align-middle table-bordered table-hover mb-0">
    <thead>
        <tr class="text-dark">
            <th scope="col">Fecha de registro</th>
            <th scope="col">Nombres y Apellidos</th>
            <th scope="col">Correo</th>
            <th scope="col">Estatus</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="adminAccess_Tbody">


     @foreach($admins as $a)
        <tr>
            <td> {{  $a->created_at->diffForHumans() }} </td>
            <td> {{$a->name}} {{$a->apellidos}} </td>
            <td> {{$a->email}} </td>
            <td> {{$a->estatus}} </td>
            <td>
                <div class="d-flex justify-content-evenly align-items-center">
                    @if($a->estatus != 'Activo')
                        <div class="col-md-4">
                            <a onclick="grantAdmin({{$a->id}})" class="text-success" style="cursor: pointer;">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Otorgar acceso">
                                    <i class="fas fa-key mx-2"></i>
                                 </span>
                            </a>
                        </div>
                    @endif

                    {{-- @if($a->estatus == 'Activo')
                        <div class="col-md-4">
                            <a  class="text-danger td_revokeaccess" id="rv_{{$a->id}}" style="cursor: pointer;">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Revocar acceso">
                                    <i class="fas fa-ban mx-2"> </i>
                                 </span>
                            </a>
                        </div>
                    @endif --}}

                    <div class="col-md-4">
                        <a onclick="removeAdmin({{$a->id}})" class="text-danger" style="cursor: pointer;">
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar usuario">
                                <i class="fas fa-trash mx-2"> </i>
                             </span>
                        </a>
                    </div>
                </div>
            </td>
        </tr>

    @endforeach
</tbody>
</table>
