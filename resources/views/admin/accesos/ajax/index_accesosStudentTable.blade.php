<table id="StudentTable" class="table text-start align-middle table-bordered table-hover mb-0">
    <thead>
        <tr class="text-dark">
            {{-- <th scope="col">#</th> --}}
            <th scope="col">Fecha de registro</th>
            <th scope="col">Nombres y Apellidos</th>
            <th scope="col">Correo</th>
            <th scope="col">Estatus</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="studentAccess_Tbody">
        @foreach($students as $s)
            <tr id="{{$s->id}}">
                <td> {{  $s->created_at->diffForHumans() }} </td>
                <td> {{$s->name}} {{$s->apellidos}} </td>
                <td> {{$s->email}} </td>
                <td> {{$s->estatus}} </td>
                <td>
                    <div class="d-flex justify-content-evenly align-items-center">
                        <a class="text-primary" onclick="previewStudent({{$s}})" id="gr_{{$s->id}}" style="cursor: pointer;">
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Detalles">
                                <i class="fas fa-eye mx-2"></i>
                             </span>
                        </a>

                        {{-- <a class="text-success" onclick="grantAccessStudent({{$s->id}})" id="gr_{{$s->id}}" style="cursor: pointer;">
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Otorgar acceso">
                                <i class="fas fa-key mx-2"></i>
                             </span>
                        </a>

                        <a class="text-danger" onclick="revokeAccessStudent({{$s->id}})" id="rv_{{$s->id}}" style="cursor: pointer;">
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="revocar acceso">
                                <i class="fas fa-ban mx-2"></i>
                             </span>
                        </a> --}}
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex mt-2 justify-content-center">
    {{ $students->links() }}
</div>

<a class="d-none" id="action_grant_revoke" href="#"> Otorgar o revocar </a>
