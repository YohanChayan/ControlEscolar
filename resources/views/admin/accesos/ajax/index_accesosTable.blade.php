 @foreach($users as $u)
    <tr>
        <td> {{  $u->created_at->diffForHumans() }} </td>
        <td> {{$u->name}} {{$u->apellidos}} </td>
        <td> {{$u->email}} </td>
        <td> Administrativo </td>
        <td> {{$u->estatus}} </td>
        <td>
            <div class="d-flex justify-content-evenly align-items-center">
                <div class="col-md-4">
                    <a onclick="grantAccess({{$u->id}})" class="text-success" style="cursor: pointer;">
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Otorgar acceso">
                            <i class="fas fa-key mx-2"></i>
                         </span>
                    </a>
                </div>

                <div class="col-md-4">
                    <a onclick="revokeAccess({{$u->id}})" class="text-danger" style="cursor: pointer;">
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Revocar acceso">
                            <i class="fas fa-ban mx-2"> </i>
                         </span>
                    </a>
                </div>


            </div>
        </td>
    </tr>
@endforeach
