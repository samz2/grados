<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oficio</title>
</head>
<style>
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
    .oscurecer
    {
        filter:alpha(opacity=90);
        opacity:.90;
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
        <table>
            <tr>
                <td><img class="oscurecer" src="img/facu.jpg" height="90" width="80"></td>
                <td width="157">&nbsp;</td>
                <td><img class="oscurecer" src="img/unu.png" height="80" width="80"></td>
                <td width="157">&nbsp;</td>
                <td><img class="oscurecer" src="img/sistemas.png" height="90" width="80"></td>
            </tr>
        </table>
        <div class="center t24 negrita timesnewroman">UNIVERSIDAD NACIONAL DE UCAYALI</div>
        <div class="center t16 negrita arial" >FACULTAD DE INGENIERÍA DE SISTEMAS E INGENIERÍA CIVIL</div>
        <div class="center t16 arial">COMISIÓN DE GRADOS y TÍTULOS - FIS e IC</div><br>
        <p class="derecho t15 arial">Pucallpa, {{$dia}} {{"de"}} {{$mes}} del {{$anio}}</p>
        <div class="izquierdo subrayado negrita arial">OFICIO  No        <b class="t17">/{{$anio}}</b> – UNU-FIS e IC-CG y T</div>
        <div class="izquierdo t15 arial">Señor {{"Ing. Mg."}}</div>
        <div class="izquierdo t15 arial">{{"ROMEL PINEDO RIOS"}}</div>
        <div class="izquierdo t15 arial">Decano de la Facultad de Ingeniería de Sistemas e Ingeniería Civil – UNU</div>
        
        <p class="subrayado t15 arial">Presente.-</p>

        <table>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>ASUNTO</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>DECLARACIÓN DE EXPEDITO PARA OBTENCIÓN DEL GRADO ACADÉMICO DE BACHILLER EN {{$dato->Escuela}}</b></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>REFERENCIA</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>ACTA DE {{$dato->Tipo}} N° {{$dato->NumSesion}} Comisión de Grados y Títulos de la FIS e IC</b></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td class="t15 arial">Estimado señor:</td>
            </tr>
        </table>
        <p class="justificado t15 arial" style="line-height : 20px;"><b class="vacio justificado">aaaaaaaaaaaaaaiaaaaaa</b>Mediante el presente remito adjunto el expediente del Ex alumno:
            <b class="justificado">{{$dato->Paterno}} {{$dato->Materno}}, {{ucwords(strtolower($dato->Nombre))}};</b> de la <b class="justificado">Carrera Profesional de {{$dato->Escuela}}</b> en condición de EXPEDITO, 
            para que se le dé el trámite correspondiente a fin de otorgarle el<b class="justificado"> Grado Académico de  
            Bachiller en {{$dato->Escuela}}</b>, cuyo registro en el libro de Grados de la Facultad es el siguiente: </p>
        <table class="center centrartabla t15 arial" border="1" cellspacing=0 cellspadding=0>
            <tr>
                <td width=30 style="padding-top: 20px;"><b>N°</b></td>
                <td width=150 style="padding-top: 20px;"><b>GRADUANDO</b></td>
                <td width=60 style="padding-top: 20px;"><b>N° TOMO</b></td>
                <td width=60 style="padding-top: 20px;"><b>N° FOLIO</b></td>
                <td width=90 style="padding-top: 20px;"><b>N° ASIENTO</b></td>
            </tr>
            <tr>
                <td width=30 style="margin: 13px; padding: 13px;"><b>01</b></td>
                <td width=150 style="margin: 13px; padding: 13px;"><b>{{$dato->Paterno}} {{$dato->Materno}}, {{ucwords(strtolower($dato->Nombre))}}</b></td>
                <td width=60 style="margin: 13px; padding: 13px;"><b>{{$dato->Tomo}}</b></td>
                <td width=60 style="margin: 13px; padding: 13px;"><b>{{$dato->Folio}}</b></td>
                <td width=90 style="margin: 13px; padding: 13px;"><b>{{$dato->Asiento}}</b></td>
            </tr>
        </table>  
        <br>
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
                <td class="center negrita" style="font-size: 11px">{{"Ing. Mg. DIANA MARGARITA DIAZ ESTRADA"}}</td>
                
            </tr>            
        </table>
        <div class="center t10 arial">{{"PRESIDENTE"}}</div>
        <table class="centrartabla" style="width: 100%;">            
            <tr>
                <td class="t7">Cc.</td>
                <td class="derecho"></td>
            </tr>
            <tr>
                <td class="t7">Decanatura</td>
                <td class="derecho"></td>
            </tr>
            <tr>
                <td class="t7">ARCHIVO</td>
                <td class="derecho t9" style="font-style: italic;">DMDE</td>
            </tr>
        </table>
    </div>

</body>
</html>