<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OFICIO</title>
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
        <p class="derecho t15 arial">Pucallpa, {{$dia}} de {{$mes}} del {{$year}}</p>
        <br>
        <div class="izquierdo subrayado negrita arial">OFICIO  No  <b class="t17">{{"      "}}</b> – UNU-FISeIC-CGyT</div>
        <div class="izquierdo arial">{{"Sr. Ing. Mg."}}</div>
        <div class="izquierdo negrita arial">{{"ROMEL PINEDO RIOS"}}</div>
        <div class="izquierdo arial">{{"Decano de la facultad de Ingeniería de Sistemas e Ingeniería Civil - UNU"}}</div>
        <div class="izquierdo subrayado arial">{{"Presente.-"}}</div>
        <br>
        <table>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>ASUNTO</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>{{"DESIGNACIÓN COMO DOCENTE EVALUADOR DEL PROYECTO DE TESIS"}}</b></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>REFERENCIA</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>ACTA DE {{$sesion["tipo"]}} N° {{$sesion["sesion"]}} Comisión de Grados y   
                    Títulos de la FIS e IC {{$fecha}}
                    </b></td>
            </tr>
        </table>
        <br>
        <br>
        <p class="justificado t15 arial" style="line-height : 20px;">                                         Mediante el presente informo a su despacho que de acuerdo al art. 
            15 del Reglamento de Grados y Títulos de la FISeIC, el(la) {{$sesion["zdocente"]}} ha sido designado como
            <a class="subrayado">Docente Evaluador</a>  para la revisión del Proyecto de tesis titulado: 
            <b>{{'"'.mb_strtoupper($sesion["nombretesis"]).'"  '}}</b>, presentado por el(los) bachiller(es): 
            <b>{{str_replace(","," y ",$sesion["tesistas"])}}</b>,  de la Carrera profesional de 
            <b>{{$sesion["carrera"]}}</b></p>
        
        <p class="justificado t15 arial">Por lo que solicito su reconocimiento mediante Comité de planeamiento.
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
                <td class="center negrita" style="font-size: 11px">Mg. {{"Diana Margarita Diaz Estrada"}}</td>
                
            </tr>            
        </table>
        <div class="center t10 arial">{{"PRESIDENTE"}}</div>
    </div>

</body>
</html>