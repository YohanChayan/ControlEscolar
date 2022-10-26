@foreach($rechazados as $r)
    <tr>
        <td> {{$r->id}} </td>
        <td> {{$r->folio}} </td>
        <td> {{$r->tramite->nombre_tramite}} </td>
        <td> {{$r->student->apellidos}} {{$r->student->name}} </td>
        <td> {{$r->student->email}} </td>
        <td> {{$r->student->clave_carrera}} - {{$r->student->nombre_carrera}} </td>
    </tr>
@endforeach
