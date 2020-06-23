<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe</title>
</head>
<style>
    .opaco
    {
        color: rgb(163, 158, 158);
    }
    .negrita
    {
        font-weight: bold;
    }
    .center
    {
        text-align: center;
        text-justify: inter-word;
    }
    .timesnewroman{
        font-family: "Times New Roman", Times, serif;
    }
    .arial {
        font-family: Arial, Helvetica, sans-serif;
    }
    .negrita
    {
        font-weight: bold;
    }
    .derecho
    {
        text-align: right;
        text-justify: inter-word;
    }
    .izquierdo
    {
        text-align: left;
        text-justify: inter-word;
    }
    .subrayado
    {
        text-decoration: underline;
    }
    .justificado
    {
        text-align: justify;
        /* text-justify: inter-word; */
    }
    .vacio
    {
        color: white;
    }
    .container 
    {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    .centrartabla{
        margin: auto;
    }
    .arriba
    {
        vertical-align:text-top;
    }
    #oscurecer
    {
        background-color: rgba(0,0,0,0.8);
        filter:brightness(0.4);
    }
    #ocurecer::after {
        content:"";
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.6);
        z-index:-1;
        }
    .t7{font-size: 7px;}
    .t8{font-size: 8px;}
    .t9{font-size: 9px;}
    .t10{font-size: 10px;}
    .t11{font-size: 11px;}
    .t12{font-size: 12px;}
    .t13{font-size: 13px;}
    .t14{font-size: 14px;}
    .t15{font-size: 15px;}
    .t16{font-size: 16px;}
    .t17{font-size: 17px;}
    .t18{font-size: 18px;}
    .t19{font-size: 19px;}
    .t20{font-size: 20px;}
    .t21{font-size: 21px;}
    .t22{font-size: 22px;}
    .t23{font-size: 23px;}
    .t24{font-size: 24px;}
    .t25{font-size: 25px;}
</style>
<body>
    @php
        // var_dump($Anio);
        // var_dump($numMes);
        // var_dump($dia);
    @endphp
    <div class="container">
        <table class="centrartabla">
            <tr>
                <td rowspan="3"><img id="oscurecer" style="vertical-align: text-top" src="img/unu1.png" height="90" width="65"></td>
                <td class="t24 negrita timesnewroman center opaco">UNIVERSIDAD NACIONAL DE UCAYALI</td>
                <td rowspan="3"><img class="oscurecer" src="img/logo1.png" height="90" width="80"></td>
            </tr>
            <tr>
                <td class="center t16 negrita arial opaco">FACULTAD DE INGENIERÍA DE SISTEMAS E INGENIERÍA CIVIL</td>
            </tr>
            <tr>
                <td class="center t16 arial opaco">COMISIÓN DE GRADOS y TÍTULOS - FISeIC</td>
            </tr>
        </table>
        
        <br>
        <div class="center subrayado negrita arial">OFICIO  No  {{"0000"}}<b class="t17">/</b> – UNU-FISeIC-CGyT</div>
        <br>
        <table>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>A</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;">{{"NombreBachiller"}}</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>DE</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>{{"Presidente"}}</b> <br> Presidente de la Comisión de Grados y Títulos</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>ASUNTO</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>Inf. de Obervaciones de Jurados de Tesis</b></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>Ref.</b></td>
                <td width="40" class="arriba"><b>&nbsp;</b></td>
                <td class="justificado" style="line-height : 20px;"><b>MEMO MÚLTIPLE No  {{"028/ 2019"}} – UNU - FIS e IC  – C.G y T.</b></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>FECHA</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>{{"Fecha"}}</b></td>
            </tr>
        </table>
        <hr>
        <p class="justificado t15 arial" style="line-height : 20px;">               Es grato dirigirme a usted, en atención al informe de observaciones recibido por parte de los Jurados de la Tesis titulada: 
            <b>{{"Tema"}}</b>, de la carrera profesional de {{"Carrera"}}.  </p>
        <p  class="justificado t15 arial" style="line-height : 20px;">               Se informa que <b class="subrayado">{{"tienen Observaciones"}}</b> y para poder continuar con los trámites 
            correspondientes, deberán subsanar y/o responder al Jurado a través de un informe y 
            presentación correcciones. Cabe indicar que cuentan con <b class="subrayado">{{"20 días calendarios"}}</b> 
            para la presentación del levantamiento de sus observaciones.
        </p> 
        <br><br><br><br><br><br>
        <table class="centrartabla t15 arial">
            <tr>
                <td class="center">Atentamente,</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="center" style="font-size: 7px"><b>FACULTAD DE INGENIERIA DE SISTEMAS E INGENIERIA CIVIL
                    <br>COMISION DE GRADOS Y TITULOS
                    </b></td>
            </tr>
            <tr>
                <td >&nbsp;</td>
            </tr>
            <tr>
                <td >&nbsp;</td>
            </tr>
            <tr>
                <td class="center">______________________________</td>
            </tr>
            <tr>
                <td class="center negrita" style="font-size: 11px">Ing. Mg.</td>
                
            </tr>            
        </table>
        <div class="center t10 arial">{{"PRESIDENTE"}}</div>
        {{-- @php
            print_r($base64 ?? '');
        @endphp --}}
    </div>

</body>
</html>