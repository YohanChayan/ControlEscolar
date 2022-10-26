@foreach($finalizados as $f)
    <tr>
        <td> {{$f->id}} </td>
        <td> {{$f->folio}} </td>
        <td> {{$f->tramite->nombre_tramite}} </td>
        <td> {{$f->student->apellidos}} {{$f->student->name}} </td>
        <td> {{$f->student->email}} </td>
        <td> {{$f->student->clave_carrera}} - {{$f->student->nombre_carrera}} </td>
    </tr>
@endforeach
