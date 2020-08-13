<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oficio</title>
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
        <div class="center subrayado negrita arial">INFORME No  <b class="t17">{{"      "}}</b> –UNU-FIS e IC-CGyT.</div>
        <br>
        <table>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>A</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>Bach. {{str_replace(","," y ",$proyecto["egresado"])}}</b></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>DE</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>{{"Ing. Mg. Diana Margarita Díaz Estrada"}}</b></td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b></b></td>
                <td width="40" class="arriba"><b></b></td>
                <td class="justificado" style="line-height : 20px;">{{"Presidente de la Comisión de Grados y Títulos"}}</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>ASUNTO</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>{{"Inf. Observaciones del Docente Evaluador"}}</b></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>Ref.</b></td>
                <td width="40" class="arriba"><b></b></td>
                <td class="justificado subrayado" style="line-height : 20px;"><b>{{"MEMO No              - UNU - FIS e IC - C.G y T."}}</b></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>FECHA</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>Pucallpa, {{$dia}} de {{$mes}} del {{$year}}</b></td>
            </tr>
        </table>
        <hr>
        <p class="justificado t15 arial" style="line-height : 20px;">              Es grato dirigirme a usted, en atención al informe de observaciones recibido por 
            parte del docente evaluador de la Tesis titulada: 
        <b>{{'"'.mb_strtoupper($proyecto["NombreTesis"]).'"  '}}</b>, de la carrera profesional de {{$proyecto["Escuela"]}}.
        
        <p class="justificado t15 arial">              Se informa que <a class="subrayado negrita">tiene Observaciones</a> y para poder continuar con los trámites 
            correspondientes, deberán subsanar y/o responder al docente evaluador a través de un informe y presentación de correciones. Cabe indicar que cuenta(n) con 
            <a class="subrayado">20 días calendarios</a> para la presentación del levantamiento de sus observaciones.
        </p>  
        <p class="justificado t15 arial">Sin otro particular y agradeciendo la atención a la presente quedo de usted(es).
        </p>   
        <br><br>
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
                <td class="center" style="font-size: 7px"><p>UNIVERSIDAD NACIONAL DE UCAYALI
                    <br>FACULTAD DE INGENIERIA DE SISTEMAS E INGENIERIA CIVIL
                    <br>COMISION DE GRADOS Y TITULOS
                </p></td>
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
                <td class="center negrita" style="font-size: 11px">Ing. Mg. {{"Diana Margarita Díaz Estrada"}}</td>
                
            </tr>            
        </table>
        <div class="center t10 arial">{{"Presidente"}}</div>
        {{-- @php
            print_r($base64 ?? '');
        @endphp --}}
    </div>

</body>
</html>