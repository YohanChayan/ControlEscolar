<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Formato</title>
    <link rel="stylesheet" href="{{asset('css/constanciaNoAdeudo/styles.css')}}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>

    <div class="main">
        <div class="square1">

            <!-- logos, referencia, monto -->
            <div class="section1">

                <div class="container_logoUdg">
                    <img class="logoUdg" src="{{asset('custom/formatos_assets/small_udg.png')}}" width="100" alt="Udg logo">
                </div>

                <div class="container_direccion_finanzas">
                    <span class="universidad_finanzas"> Universidad de Guadalajara <span> Dirección de Finanzas </span> </span>
                    <hr style="width: 80%;">
                </div>

                <div class="container_datosPagos">

                    <p class="p_formatoPago">Formato único de pago</p>
                    <div class="container_ref_monto">
                        <div class="container_referencia">
                            <p class="p_referencia">Referencia</p>
                            <p class="p_referencia_value">9 000 000 2775</p>
                        </div>
                        <div class="container_monto">
                            <p class="p_monto">Monto</p>
                            <p class="p_monto_value">$ {{$data['tr_total_a_pagar']}}</p>
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

                </div>

                <div class="container_subSquare">
                    <p class="tramite_nombre"> MATRICULAS PENDIENTES Y CONSTANCIA DE NO ADEUDO </p>
                    <div class="form_info">
                        <div class="form_item">
                            <p class="label">Código: </p>
                            <p class="student_value" id="student_codigo"> {{$data['usr_codigo']}} </p>
                        </div>

                        <div class="form_item">
                            <p class="label">Nombres: </p>
                            <p class="student_value" id="student_nombresApellidos"> {{$data['usr_apellidos']}}  {{$data['usr_nombres']}}</p>
                        </div>

                        <div class="label_help">
                            <p class="label_help_item">Apellido Paterno</p>
                            <p class="label_help_item">Apellido Materno</p>
                            <p class="label_help_item">Nombre (s)</p>
                        </div>

                        <div class="form_item">
                            <p class="label">Carrera: </p>
                            <p class="student_value" id="student_claveCarrera" style="margin-right: 50px;"> {{$data['usr_clave_carrera']}} </p>

                            <p class="label">Calendario de Ingreso: </p>
                            <p class="student_value" id="student_cicloAdmision"> {{$data['usr_ciclo_admision']}} </p>
                        </div>


                        <div class="form_item_flex">
                            <div class="form_item">
                                <p class="label">Matriculas pendientes: </p>
                                <p class="student_value" id="student_email"> <strong> {{$data['tr_matriculas_pendientes']}}</strong> </p>

                                <p class="label" style="margin-left: 70px; ">Desde: </p>
                                <p class="student_value" id="student_cicloAdmision"> {{$data['tr_ultima_matricula_pagada']}} </p>

                                <p class="label" style="margin-left: 25px;">Hasta: </p>
                                <p class="student_value" id="student_cicloAdmision"> {{$data['ci_currentCiclo']}}</p>
                            </div>
                            <div class="form_item" style="margin-left: 250px;">
                                <p class="label" style="margin-left: 25px;">Constancia de No Adeudo <span>{{$data['tr_monto']}}$</span> </p>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

            <div class="container_arancel_bottom">

                <div class="arancel_container">
                    <p class="arancel_vigente">ARANCEL VIGENTE</p>
                    <p class="arancel_anio">{{$data['ci_currentCiclo']}}</p>
                </div>

                <div class="cajas_finanzas">
                    <p class="no_se_acepta">No se acepta el pago en cajas de finanzas </p>
                </div>

                <div class="container_certificacion_banco">
                    <p class="cerf_banco">Certificación Banco </p>
                </div>
            </div>
        </div>
    </div>

    <div class="qr_and_folioNumber">
        {{QrCode::size(150)->generate($data['tr_folio'])}}
        <p style="margin: 0;">Folio: {{$data['tr_folio']}}</p>
    </div>

    <script>
        var element = document.querySelector('.main');
        html2pdf(element);
    </script>

    {{-- <script defer> window.print() </script> --}}
</body>
</html>
