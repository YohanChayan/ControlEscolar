<style>
  body{
      min-width: 1450px;
      max-width: 1500px;
      /* min-width: 100%;
      max-width: 100%; */
      margin: 0 auto;
  }
  .main{
      width: 90%;
      margin: 0 auto;
      margin-top: 50px;
  }

  .square1{
      border: 1px solid green;
      padding: 10px;
  }

  /* row */

  .section1{
      display: flex;
      height: 40%;
  }

  /* Logo UDG */
  .container_logoUdg{
      width: 30%;
      margin-top: 30px;
  }

  .logoUdg{
      width: 100%;
  }
          /* --- */

          /* Logo Cucsh */
  .container_logoCucsh{
      width: 20%;
      margin-top: 30px;
  }

  .logoCucsh{
      width: 100%;

  }
          /* --- */

          /* formato pago */

  .container_datosPagos{
      width: 50%;
  }

  .p_formatoPago{
      font-weight: bold;
      text-align: center;
      font-size: 2em;
  }

  .container_ref_monto{
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 50px;

  }

  .container_referencia{
      border: 1px solid black;
      /* padding: 0 5px; */
      width: 35%;
  }

  .p_referencia{
      text-align: center;
      font-size: 30px;
      margin: 5px 0;
  }

  .p_referencia_value{
      text-align: center;
      font-size: 30px;
      font-weight: bold;
      margin: 5px 0;
  }

  .container_monto{
      border: 1px solid black;
      padding: 0 20px;
      width: 35%;
  }

  .p_monto{
      text-align: center;
      font-size: 30px;
      margin: 5px 0;
  }
  .p_monto_value{
      text-align: center;
      font-size: 30px;
      font-weight: bold;
      margin: 5px 0;
  }


          /* Banks  */

  .section2{
      display: flex;
      margin-top: 15px;
      margin-left: 50px;
  }

  .container_banks{
      width: 25%;
      /* background-color: lightgray; */
  }

  .paguese{
      text-align: center;
  }

  .banks_logos{
      display: flex;
      flex-direction: column;
  }

  .bank{
      max-width: 100%;
      display: flex;
      margin: 3px 5px;
  }

  .logoBank{
      width: 140px;
      height: 55px;
  }

  .logoBank_desc{
      padding: 0 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      /* margin: 0 auto; */
  }

  .arancel_container{
      border: 2px solid black;
      width: 70%;
      padding: 5px 20px;
      margin: 0 auto;
      text-align: center;
      color: red;
  }
  .arancel_vigente{
      font-size: 20px;
      margin: 0;
  }
  .arancel_anio{
      font-size: 30px;
      margin: 0;
      font-weight: bold
  }

          /*  sub square: info  */


  .container_subSquare{
      /* background-color: lightblue; */
      width: 70%;
      margin: 0 auto;
      border: 2px solid black;
  }

  .tramite_nombre{
      font-size: 1.8em;
      padding-left: 2%;
      font-weight: bold;
  }

  .form_info{
      padding: 0 10px;
      display: flex;
      flex-direction: column;
  }

  .form_item{
      display: flex;
      margin: 0 5px;
      font-size: 20px;
      font-weight: bold;
  }

  .form_Enditem{
      border: 2px solid black;
      margin: 20px 5px 5px 0px;
      padding-top: 20px;
      padding-left: 20px;
  }

  .label{
      margin: 0;
      margin-right: 5px;
      margin-bottom: 25px;
  }

  .student_value{
      margin: 0;
      font-weight: normal;
      /* font-size: 15px;
      font-size: 1.2vw;
      margin-top: 30px; */
  }

  .label_help{
      width: 50%;
      margin-left: 100px;
      display: flex;
      justify-content: space-around;
      align-items: flex-start;
      font-weight: normal;
  }

  .label_help_item{
      margin: 0;
      margin-bottom: 25px;
      font-size: 18px;
  }

      /* Student specifications */

  .after_square1{
      display: flex;
      /* background-color: lightblue; */
      margin-bottom: 30px;
      width: 90%;
      margin: 0 auto;
  }

  .student_specifications{
      width: 60%;
      text-align: center;
      /* background-color: lightsalmon; */
      font-weight: bold;
      font-size: 15px;
  }

  .enVentanilla{
      font-size: 25px;
  }
  .axenar{
      font-weight: normal;
  }

  .qr_and_folioNumber{
      width: 30%;
      text-align: center;
      /* background-color: lightgray; */
      margin: 0 auto;
  }


      /* division scissor */
  .lineCut_division{
      width: 95%;
      margin: 0 auto;
  }

  .img_scissor{
      width: 40px;
      /* height: 40px;	 */
      position: relative;
      top: 33px;
      left: 50px;
  }


      /* before square2 */

  .before_square2{
      width: 90%;
      margin: 0 auto;
      text-align: center;
  }

  .recogetuTramite{
      font-weight: bold;
      font-size: 20px;
  }

  .antesDel_1995{
      font-size: 20px;
  }

  .si_autorizas{
      font-size: 20px;
      color: red;
  }

      /* square2 */

  .container_square2{
      display: flex;
      width: 75%;
      margin: 0 auto;
      margin-bottom: 20px;
  }

  .side_miniSquare{
      width: 50px;
      margin-left: 1px;
      border: 1px solid;
      text-align: center;
      display: flex;
      justify-content: space-between;
      flex-direction: column;
  }

  .side_text{
      padding: 20px;
      font-size: 20px;
      writing-mode: vertical-rl;
      text-orientation: upright;
  }

  .square2{
      border: 2px solid;
  }

  .square2_section1{
      display: flex;
      padding: 5px;
      justify-content: space-around;
  }

  .container_logoUdg2{
      width: 25%;
  }

  .MainTitle{
      width: 40%;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
  }
  .container_logoCucsh2{
      width: 25%;
  }

  .logoUdg2{
      width: 100%;
      height: 100%;
  }

  .logoCucsh2{
      width: 100%;
      height: 100%;
  }


      /* square2 section2 */
  .square2_section2{
      text-align: center;
  }
</style>
