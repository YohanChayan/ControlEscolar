<table id="TcambioCarreras" class="table text-start align-middle table-bordered table-hover mb-0">
    <thead>
        <tr class="text-dark">
            <th scope="col">Fecha de solicitud</th>
            <th scope="col">Código</th>
            <th scope="col">Carrera actual</th>
            <th scope="col">Nueva carrera solicitada</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody id="TcambioCarrerasTbody">

        @foreach($solicitudes as $s)
            <tr>
                <td>{{$s->created_at->format('d-m-Y')}}</td>
                <td>{{$s->student->codigo}}</td>
                {{-- <td>{{$s->student->email}}</td> --}}
                <td>{{$s->student->clave_carrera }} - {{$s->student->nombre_carrera}} </td>
                <td>{{$s->new_clave_carrera }} - {{$s->new_nombre_carrera}} </td>
                <td>

                    <div class="d-flex justify-content-evenly align-items-center">
                        <div class="col-md-4">

                            <a onclick="allowChangeCareer({{$s->id}})" class="text-success" style="cursor: pointer;">
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Permitir cambio de carrera">
                                    <i class="fas fa-exchange-alt"></i>
                                 </span>
                            </a>
                        </div>

                        <div class="col-md-4">

                            <a onclick="denyChangeCareer({{$s->id}})" class="text-danger" style="cursor: pointer;" >
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="No permitir cambio">
                                    <i class="fas fa-ban"></i>
                                 </span>
                            </a>
                        </div>
                    </div>

                </td>
            </tr>
        @endforeach

    </tbody>
</table>
