<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Orden de pago </title>

    <link rel="stylesheet" href="{{asset('css/certificados_actas/styles.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>


</head>
<body>

    <div class="main">
        <div class="square1">

            <!-- logos, referencia, monto -->
            <div class="section1">

                <div class="container_logoUdg">
                    <img class="logoUdg" src="{{asset('custom/formatos_assets/udg.png')}}" alt="Udg logo" style="height: 90px;">
                </div>

                <div class="container_logoCucsh">
                    <img class="logoCucsh" src="{{asset('custom/formatos_assets/cucsh.png')}}" alt="Cucsh logo">
                </div>

                <div class="container_datosPagos">

                    <p class="p_formatoPago">Formato único de pago</p>
                    <div class="container_ref_monto">
                        <div class="container_referencia">
                            <p class="p_referencia">Referencia</p>
                            {{-- <p class="p_referencia_value">9 000 000 2775</p> --}}
                            <p class="p_referencia_value">{{$data['tr_referencia']}}</p>
                        </div>
                        <div class="container_monto">
                            <p class="p_monto">Monto</p>
                            {{-- <p class="p_monto_value">$ 91.00</p> --}}
                            <p class="p_monto_value" id="tr_monto">${{$data['tr_monto']}}</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="section2">

                <div class="container_banks">
                    <p class="paguese"> Páguese </p>
                    <div class="banks_logos">

                        <div class="bank">
                            <img class="logoBank" src="{{asset('custom/formatos_assets/banks/banorte.jpeg')}}" alt="Banorte banco">
                            <p class="logoBank_desc"> EMISORA 03169 </p>
                        </div>
                        <div class="bank">
                            <img class="logoBank" src="{{asset('custom/formatos_assets/banks/santander.png')}}" alt="Banorte banco">
                            <p class="logoBank_desc"> 51908041805 </p>
                        </div>
                        <div class="bank">
                            <img class="logoBank" src="{{asset('custom/formatos_assets/banks/banamex.png')}}" alt="banamex banco">
                            <p class="logoBank_desc">PA: </p>
                        </div>
                        <div class="bank">
                            <img class="logoBank" src="{{asset('custom/formatos_assets/banks/bancomer.png')}}" alt="Banorte banco">
                            <p class="logoBank_desc">
                                CONVENIO
                                CIE 588313
                            </p>
                        </div>
                        <div class="bank">
                            <img class="logoBank" src="{{asset('custom/formatos_assets/banks/Hsbc.png')}}" alt="Banorte banco">
                            <p class="logoBank_desc">
                                CLAVE 4038
                                OPTRXN5503
                            </p>

                        </div>
                    </div>

                    <div class="arancel_container">
                        <p class="arancel_vigente">ARANCEL VIGENTE</p>
                        <p class="arancel_anio">2022</p>
                    </div>
                </div>

                <div class="container_subSquare">
                    {{-- <p class="tramite_nombre"> CERTIFICADO PARCIAL DE ESTUDIO </p> --}}
                    <p class="tramite_nombre"> {{$data['tr_nombre_tramite']}} </p>
                    <div class="form_info">
                        <div class="form_item">
                            <p class="label">Código: </p>
                            {{-- <p class="student_value" id="student_codigo"> _______________ </p> --}}
                            <p class="student_value" id="student_codigo"> {{$data['usr_codigo']}} </p>
                        </div>

                        <div class="form_item">
                            <p class="label">Nombres: </p>
                            <p class="student_value" id="student_nombresApellidos"> {{$data['usr_apellidos']}} {{$data['usr_nombres']}} </p>
                            {{-- <p class="student_value" id="student_nombresApellidos"> _______________________________________________________________ </p> --}}
                        </div>

                        <div class="label_help">
                            <p class="label_help_item">Apellido Paterno</p>
                            <p class="label_help_item">Apellido Materno</p>
                            <p class="label_help_item">Nombre (s)</p>
                        </div>

                        <div class="form_item">
                            <p class="label">Clave de carrera: </p>
                            <p class="student_value" id="student_claveCarrera" style="margin-right: 50px;"> {{$data['usr_clave_carrera']}}</p>

                            <p class="label">Ciclo de admisión: </p>
                            <p class="student_value" id="student_cicloAdmision"> {{$data['usr_ciclo_admision']}} </p>
                        </div>

                        <div class="form_item">
                            <p class="label">Núm de telefono celular: </p>
                            <p class="student_value" id="student_telefono"> {{$data['usr_telefono']}} </p>
                        </div>

                        <div class="form_item">
                            <p class="label">Correo electrónico: </p>
                            <p class="student_value" id="student_email"> {{$data['usr_email']}} </p>
                        </div>

                        <div class="form_item form_Enditem" >
                            <p class="label">Fecha de solicitud: </p>
                            <p class="student_value" id="student_fechaSolicitud"> {{$data['usr_created_at']}} </p>
                            <p class="label" style="margin-left: 15px;">Recibió: </p>
                            <p class="student_value" id="student_estatus"> _________________ </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="after_square1">
        <div class="student_specifications">
            <p class="doPayment"> REALIZA TU PAGO EN EL BANCO DE TU ELECCIÓN, PRESENTA LLENA LA SOLICITUD </p>
            <p class="enVentanilla">EN VENTANILLA 4</p>
            <p class="axenar">ANEXA EL COMPROBANTE DE PAGO DEL BANCO, ADEMÁS:</p>
            <ul class="personal_requirements">

            @if( ($data['tr_requerimientos'][0] == ''))
                <li>En espera</li>
            @else
                @foreach($data['tr_requerimientos'] as $req)
                    <li>
                        @if($req[0] == '_')
                            (Virtual) {{  substr($req, 1)   }}
                        @else
                            {{$req}}
                        @endif
                    </li>
                @endforeach
            @endif
            </ul>
        </div>

        <div class="qr_and_folioNumber">
            {{QrCode::size(120)->generate($data['tr_folio'])}}
            <p style="margin: 0;">Folio: {{$data['tr_folio']}}</p>
        </div>
    </div>


    <div class="lineCut_division" style="margin-top: -45px;">
        <img class="img_scissor" src="{{asset('custom/formatos_assets/scissor.png')}}" alt="Cortar">
        <hr style="border-top: dotted 1px;">
    </div>

    <div class="before_square2">
        <p class="recogetuTramite">RECOGE TU TRÁMITE EN *90 DÍAS HÁBILES* EN VENTANILLA 3 </p>
        <p class="antesDel_1995">
            *Si egresaste antes del año de 1995 ó tus calificaciones son anteriores al sistema de SIIAU tu trámite durará <strong>100 días HÁBILES</strong> y <span style="font-weight: bold; text-decoration: underline;">se tramitan ante la Coordinación de Carrera correspondiente</span>.
        </p>

        <p class="si_autorizas">
            *Si autorizas a otra persona para recoger tu trámite, favor de presentar: comprobante del trámite, carta poder simple, copia de
            IFE por ambos lados del apoderado y de quien concede el poder.*
        </p>

    </div>

    <div class="container_square2">
        <div class="square2">
            <div class="square2_section1">
                <div class="container_logoUdg2">
                    <img class="logoUdg2" src="{{asset('custom/formatos_assets/udg.png')}}" alt="Udg logo" width="100" height="100" style="width: 100%; margin-top: 10px; margin-left: 15px;">
                </div>

                <div class="MainTitle">
                    <h4>UNIVERSIDAD DE GUADALAJARA</h4>
                    <p style="margin: 0;">COORDINACIÓN DE CONTROL ESCOLAR</p>
                </div>

                <div class="container_logoCucsh2">
                    <img class="logoCucsh2" src="{{asset('custom/formatos_assets/cucsh.png')}}" alt="Cucsh logo" width="100" height="100" style="margin-top: 15px;">
                </div>
            </div>

            <div style="width: 90%; margin: 0 auto;">
                <hr style="border: 1px solid">
            </div>

            <div class="square2_section2">
                <!-- ?? -->
                <h4 style="font-style: italic;"> Vale por 1 {{$data['tr_nombre_tramite']}} </h4>

                <div class="form_info" style="width: 50%; margin: 25px auto; text-align: center; ">
                    <div class="form_item">
                        <p class="label">Código: </p>
                        <p class="student_value" > {{$data['usr_codigo']}} </p>
                    </div>

                    <div class="form_item">
                        <p class="label">Nombre: </p>
                        <p class="student_value"> {{$data['usr_apellidos']}} {{$data['usr_nombres']}} </p>
                    </div>

                    <div class="form_item">
                        <p class="label">Clave de carrera: </p>
                        <p class="student_value"> {{$data['usr_clave_carrera']}} </p>
                    </div>

                    <div class="form_item" style="width: 400px;">
                        <p class="label">Fecha de solicitud: </p>
                        <p class="student_value" id="student_fechaSolicitud"> {{$data['usr_created_at']}} </p>
                        <p class="label" style="margin-left: 20px;">Recibió: </p>
                        <p class="student_value" id="student_email"> ____________ </p>
                    </div>

                </div>

                <h3 style="color: red; margin: 0;">Sí no recoges tu trámite en la fecha señalada, se resguardará por 60 días, después será destruido.
                     </h3>
            </div>
        </div>
        <div class="side_miniSquare">
            <p class="side_text"> C O M P R O B A N T E </p>
            <p class="side_text">  A L U M N O </p>
        </div>

        <div class="qr_and_folioNumber" style="margin-left: 20px; margin-top: 50px;">
            {{QrCode::size(120)->generate($data['tr_folio'])}}
            <p style="margin: 0;">Folio: {{$data['tr_folio']}}</p>
        </div>
    </div>
    </div>

    <script>
        let monto = @json($data['tr_monto']);
        if(monto == 0)
            document.querySelector('#tr_monto').innerText = 'Gratuito';
    </script>

    <script>
        var element = document.querySelector('.main');
        html2pdf(element);
    </script>

</body>
</html>


