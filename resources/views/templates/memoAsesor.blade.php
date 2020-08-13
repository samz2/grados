<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Memo</title>
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
        <div class="center subrayado negrita arial">MEMO No  <b class="t17">{{"      "}}</b> – UNU - FIS e IC - C.GyT.</div>
        <br>
        <table>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>DESTINO</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>Ing. {{$docente}}</b></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>ASUNTO</b></td>
                <td width="40" class="arriba"><b>:</b></td>
                <td class="justificado" style="line-height : 20px;"><b>DESIGNACIÓN COMO ASESOR DE TESIS</b></td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="izquierdo t15 arial">
                <td width="80" class="arriba"><b>REFERENCIA</b></td>
                <td width="40" class="arriba"><b>:</b></td>
            <td class="justificado" style="line-height : 20px;"><b>ACTA DE {{$sesion->Tipo}} N° {{$sesion->NumSesion}}
                Comisión de Grados y Títulos de la FIS e IC ({{$sesion->zFecha}})</b></td>
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
        <p class="justificado t15 arial" style="line-height : 20px;">Mediante el presente le comunico
            a usted, que en sesión de fecha <b>{{$sesion->zFecha}}</b> de la Comisión de Grados y Títulos de la
            FIS e IC, ha sido designado como Asesor de la Tesis titulada:
        <b>{{'"'.mb_strtoupper($proyecto["NombreTesis"]).'"  '}}</b>, presentado por los bachilleres: <b>Bach. {{str_replace(","," y ",$proyecto["egresado"])}}</b>;
        de la <b>Carrera Profesional de {{$proyecto["Escuela"]}}.</b>

        <p class="justificado t15 arial">Así mismo de Acuerdo al Art. 28 del Reglamento de Grados y Títulos de la FISeIC, las funciones como Asesor son las siguientes:</p>
        
            <table>
                <tr>
                    <td class="justificado t15 arial">a.</td>
                    <td class="justificado t15 arial">Orientar, corregir y evaluar la Tesis tanto en su 
                        diseño, como en la ejecución y presentación.</td>
                </tr>
                <tr>
                    <td class="justificado t15 arial">b.<br><br></td>
                    <td class="justificado t15 arial">Supervisar permanentemente la ejecución o desarrollo 
                        de la Tesis y dar el visto bueno al proyecto e informe final de la tesis.</td>
                </tr>
                <tr>
                    <td class="justificado t15 arial">c.</td>
                    <td class="justificado t15 arial"><b class="subrayado">Exigir cada treinta (30) días 
                        el informe del avance del Trabajo de la Tesis.</b></td>
                </tr>
                <tr>
                    <td class="justificado t15 arial">d.<br><br><br></td>
                    <td class="justificado t15 arial">En el caso de incumplimiento del punto (a) por negligencia comprobada, por un lapso de sesenta
                        (60) días, una vez iniciada la ejecución del mismo, el Asesor será reemplazado por otro docente
                        nombrado previo informe a la Decanatura.</td>
                </tr>
                <tr>
                    <td class="justificado t15 arial">e.</td>
                    <td class="justificado t15 arial">Dar el visto bueno y verificación en el sistema 
                        antiplagio del informe final de la tesis.</td>
                </tr>
            </table>
        
        <br><br>
        <table class="centrartabla t15 arial">
            <tr>
                <td class="center">Atentamente,</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="center" style="font-size: 7px"><p>FACULTAD DE INGENIERIA DE SISTEMAS E INGENIERIA CIVIL
                    <br>COMISION DE GRADOS Y TITULOS
                </p></td>
            </tr>
            <tr>
                <td >&nbsp;</td>
            </tr>
            <tr>
                <td class="center">______________________________</td>
            </tr>
            <tr>
                <td class="center negrita" style="font-size: 11px">Ing. Mg. {{"DIANA MARGARITA DIAZ ESTRADA"}}</td>

            </tr>
        </table>
        <div class="center t10 arial">{{"PRESIDENTE"}}</div>
        <!--<br><br>
        <table class="centrartabla" style="width: 100%;">            
            <tr>
                <td class="t8" style="color:blue">Cc.</td>
                <td class="derecho"></td>
            </tr>
            <tr>
                <td class="t8" style="color:blue">Jurado</td>
                <td class="derecho"></td>
            </tr>
            <tr>
                <td class="t8" style="color:blue">Archivo</td>
                <td class="derecho t9" style="font-style: italic;">DMDE</td>
            </tr>
        </table>-->
        {{-- @php
            print_r($base64 ?? '');
        @endphp --}}
    </div>

</body>
</html>