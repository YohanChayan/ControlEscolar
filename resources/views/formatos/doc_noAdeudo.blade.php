<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No adeudo</title>
    <link rel="stylesheet" href="{{asset('css/constanciaNoAdeudo/doc_noAdeudo.css')}}">
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td style="padding-right: 10px;">
                    <img src="{{asset('custom/formatos_assets/gray_udg_logo.png')}}" class="udgLogo" alt="logo">
                </td>
                <td style="padding-left: 10px;">
                    <p class="udg_header">UNIVERSIDAD DE GUADALAJARA</p>
                    <p class="udg_subheder">CENTRO UNIVERSITARIO DE CIENCIAS SOCIALES Y HUMANIDADES</p>
                    <p class="udg_subheder">SECRETARIA ADAMINISTRATIVA/COORDINACIÓN DE CONTROL ESCOLAR</p>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="student_data">
        <p class="cod_ref_num">CÓDIGO: <span class="student_codigo">{{$usr_codigo}}</span></p>
        <p class="cod_ref_num" style="word-wrap: break-word;"> REFERENCIA: Constancia de no adeudo económico y de documentos
        </p>
        <p class="cod_ref_num">NÚMERO: {{$id}}/<span id="currentYear">{{$tr_year}}</span></p>
    </div>


    <div class="announcement_container">
        <p class="a_quien_corresponda">A QUIEN CORRESPONDA: </p>
        <p class="por_medio_del_presente">Por medio del presente hago constar que el (la) C. <span id="student_nombres" style="text-transform: uppercase; text-decoration: underline; font-weight: bold;">{{$usr_apellidos_nombres}}</span>, Código <span id="student_codigo" style="text-transform: uppercase; text-decoration: underline;font-weight: bold;">{{$usr_codigo}}</span>, de la carrera de <span id="student_carrera" style="text-transform: uppercase; text-decoration: underline;font-weight: bold;">{{$usr_carrera}}</span>, actualmente está al corriente de sus pagos y sin adeudo en documentos.</p>

        <p class="se_extiende_la_presente">Se extiende la presente para los fines que a él (ella) convenga.</p>

        <p class="ce atentamente" style="margin-top: -15px;">A T E N T A M E N T E</p>
        <p class="ce piensa_y_trabaja" style="margin-top: -20px;">"PIENSA Y TRABAJA"</p>
        <div class="anio_gdl_fecha" style="margin-top: -20px;">
            <p class="ce">“
            <span id="anio">{{$currentYear}}</span>, Guadalajara, hogar de la Feria Internacional del Libro y Capital Mundial del Libro” Guadalajara, Jal; a <span id="fecha"><span id="currentDay">{{$currentDay}}</span> de <span id="currentMonth">{{$currentMonth}}</span> de <span id="currentYear">{{$currentYear}}</span></span>.</p>
        </div>

        <div class="att_coordinador" style="margin-top: 150px;">
            <p class="ce">MTRA. OLGA LIDIA GARCÍA ZAMBRANO COORDINADORA </p>
        </div>

        {{-- <p class="firma" style="margin: 0; text-align:center;">OLGZ/pbp</p> --}}
        <div style="text-align:center; margin-top: -20px;">
            <img class="firmaImg" src="{{asset('custom/formatos_assets/firma_olga.png')}}" alt="firma Olga">
         </div>


        <p class="footer_direccion">Calle Guanajuato 1045, edificio G, planta baja, Col. La Normal, C.P. 44260 Guadalajara Jal., México <span style="display: block;">Tel. y Fax: (33) 3819-33-00 Ext. 23413, 23414, 23388</span> <span style="display: block;"> www.cucsh.udg.mx </span>
        </p>
    </div>

</body>
</html>
