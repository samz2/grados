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
                <td><img class="oscurecer" src="img/facu.jpg" height="100" width="80"></td>
                <td width="157">&nbsp;</td>
                <td><img class="oscurecer" src="img/unu.png" height="80" width="80"></td>
                <td width="157">&nbsp;</td>
                <td><img class="oscurecer" src="img/sistemas.png" height="100" width="80"></td>
            </tr>
        </table>
        <h1 class="center">UNIVERSIDAD NACIONAL DE UCAYALI</h1>
        <h3 class="center">FACULTAD DE INGENIERÍA DE SISTEMAS E INGENIERÍA CIVIL</h3>
        <h4 class="center">COMISIÓN DE GRADOS y TÍTULOS - FIS e IC</h4>
        <h5 class="derecho">Pucallpa, {{$dia}} {{"de"}} {{$mes}} del {{$anio}}</h5>
        <h5 class="izquierdo subrayado">OFICIO  No {{$dato->Numero}}/{{$anio}}– UNU-FIS e IC-CG y T</h5>
        Señor {{"Ing. Mg."}}
        <br>
        {{"ROMEL PINEDO RIOS"}}
        <br>
        Decano de la Facultad de Ingeniería de Sistemas e Ingeniería Civil – UNU
        <br>
        <p class="subrayado">Presente.-</p>
        <br>
        <table>
            <tr class="izquierdo">
                <td width="80" class="arriba"><b>Asunto</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td><b>DECLARACIÓN DE EXPEDITO PARA OBTENCIÓN DEL GRADO ACADÉMICO DE BACHILLER EN {{$dato->Escuela}}</b></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="izquierdo">
                <td width="80" class="arriba"><b>REFERENCIA</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td><b>ACTA DE SESIÓN ORDINARIA N° {{$dato->Sesion}} Comisión de Grados y Títulos de la FIS e IC</b></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td>Estimado señor:</td>
            </tr>
        </table>
        <p class="justificado"><b class="vacio justificado">aaaaaaaaaaaaaaaaaaaaa</b>Mediante el presente remito adjunto el expediente del Ex alumno: 
            <b>{{$dato->Paterno}} {{$dato->Materno}}{{","}} {{$dato->Nombre}}</b>; de la <b>Carrera Profesional de {{$dato->Escuela}}</b> en condición de EXPEDITO, 
            para que se le dé el trámite correspondiente a fin de otorgarle el <b> Académico de  
            Bachiller en {{$dato->Escuela}}  </b>, 
            cuyo registro en el libro de Grados de la Facultad es el siguiente: </p>
        <table class="center centrartabla" border="1" cellspacing=0 cellspadding=0>
            <tr>
                <td width=30><b>N°</b></td>
                <td width=150><b>GRADUANDO</b></td>
                <td width=60><b>N° TOMO</b></td>
                <td width=60><b>N° FOLIO</b></td>
                <td width=90><b>N° ASIENTO</b></td>
            </tr>
            <tr>
                <td width=30><b>01</b></td>
                <td width=150><b>{{$dato->Paterno}} {{$dato->Materno}}{{","}} {{$dato->Nombre}}</b></td>
                <td width=60><b>{{$dato->Tomo}}</b></td>
                <td width=60><b>{{$dato->Folio}}</b></td>
                <td width=90><b>{{$dato->Asiento}}</b></td>
            </tr>
        </table>  
        <br>
        <table class="centrartabla">
            <tr>
                <td  class="center">Atentamente,</td>
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
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>--------------------------------------</td>
            </tr>
            <tr>
                <td class="center" style="font-size: 10px">{{"Ing. Mg. Diana Margarita Diaz Estrada"}}<br>{{"PRESIDENTE"}}</td>
            </tr>
        </table>
    </div>

</body>
</html>