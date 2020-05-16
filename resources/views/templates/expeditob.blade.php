<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>reporte</title>
</head>
<style>     
    .centrartabla{
          margin: auto;
      }
    .altoBoton
    {
      padding: 2px 6px; 
      font-size: 11px;
    }
    .subir{
      padding: 2px 30px;
      background-color: rgba(170, 220, 250, 1);
      color:#000;
      border:0px solid #fff;
  
      border-radius: 131px 131px 131px 131px;
      -moz-border-radius: 131px 131px 131px 131px;
      -webkit-border-radius: 131px 131px 131px 131px;
      border: 0px solid #000000;
    }
   
    .subir:hover{
      color:#fff;
      background: #f7cb15;
    }
    .blanco
    {
      color: #ffffff;
    }
   
    .t10
    {
      font-size: 10px;
    }
    .t11
    {
      font-size: 11px;
    }
    .t12
    {
      font-size: 12px;
    }
    .t13
    {
      font-size: 13px;
    }
    .t14
    {
      font-size: 14px;
    }
    .t15
    {
      font-size: 15px;
    }
    .centrar
    {
        text-align: center;
    }
    .left
    {
        text-align: left;
    }
    .fondo
    {
        background-color: darkgray;
    }
  </style>
<body >
    <div>
        <h1 class="centrar">REPORTE EXPEDITOS BACHILLER</h1>
        <hr>
        <table class="centrartabla centrar t13" border="1" cellspacing=0 cellspadding=0>
            <tr class="fondo">
                <td>BACHILLER</td>
                <td>TOMO</td>
                <td>FOLIO</td>
                <td>ASIENTO</td>
                <td>NÚMERO DE SESIÓN</td>
                <td>FECHA DE SESIÓN</td>
                <td>TIPO DE SESIÓN</td>
            </tr>
            @foreach ($expeditos as $item)
            <tr>
                <td class="left">{{$item->Nombre}} {{$item->Paterno}} {{$item->Materno}}</td>
                <td>{{$item->Tomo}}</td>
                <td>{{$item->Folio}}</td>
                <td>{{$item->Asiento}}</td>
                <td>{{$item->NumSesion}}</td>
                <td>{{$item->Fecha}}</td>
                <td>{{$item->Tipo}}</td>
            </tr>    
            @endforeach
        </table>
        @php
            
        @endphp
    </div>
    <script src='js/app.js'></script>
</body>

</html>