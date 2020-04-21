<?php

namespace App\Http\Controllers;

use App\expeditob;
use App\titulacion;
use Illuminate\Http\Request;

class ExpeditobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expeditosb =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
                        ->join("sesion AS s","expedito.NumSesion","s.NumSesion")
                        ->join("estados AS es","expedito.Estado","es.Posicion")
                        ->join("escuela AS esc","e.IDEscuela","esc.IDEscuela")
                        ->select("expedito.*",\DB::raw("concat_ws('/',expedito.Tomo,expedito.Folio,expedito.Asiento) AS Acta"),\DB::raw("date_format(expedito.FechaIngreso,'%d/%m/%Y') AS FechaIngresoAux"),\DB::raw("date_format(expedito.FechaComienzo,'%d/%m/%Y') AS FechaComienzoAux"),\DB::raw("date_format(s.Fecha,'%d/%m/%Y') AS FechaAux"),"esc.Escuela","s.*","es.Estado",\DB::raw("concat_ws(' ',e.Nombre,e.Paterno,e.Materno) as Alumno"),"e.DNI")
                        ->where("expedito.Tipo","BACHILLER")->get();
        
        $expeditost =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
        ->join("sesion AS s","expedito.NumSesion","s.NumSesion")
        ->join("estados AS es","expedito.Estado","es.Posicion")
        ->join("escuela AS esc","e.IDEscuela","esc.IDEscuela")
        ->join("titulacion AS t","expedito.CodigoAlumno","t.CodAlumno")
        ->join("modalidad AS m","t.IDModalidad","m.IDModalidad")
        ->join("calificacion AS c","t.IDCalificacion","c.IDCalificacion")
        ->select("m.*","t.Asesor","t.NombreTesis","c.*","t.Fecha AS FechaT","expedito.*",\DB::raw("concat_ws('/',expedito.Tomo,expedito.Folio,expedito.Asiento,m.Modalidad) AS Acta"),\DB::raw("date_format(expedito.FechaIngreso,'%d/%m/%Y') AS FechaIngresoAux"),\DB::raw("date_format(expedito.FechaComienzo,'%d/%m/%Y') AS FechaComienzoAux"),\DB::raw("date_format(s.Fecha,'%d/%m/%Y') AS FechaAux"),"esc.Escuela","s.*","es.Estado",\DB::raw("concat_ws(' ',e.Nombre,e.Paterno,e.Materno) as Alumno"),"e.DNI")
        ->where("expedito.Tipo","TITULO")->get();
        
        return compact("expeditosb","expeditost");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hoy = date("Y-m-d");
        $expedito = new Expeditob();
        $numEgresado = Expeditob::where("CodigoAlumno",$request->expedito["codigo"])->where("Tipo","BACHILLER")->get()->count();
        if($numEgresado == 0)
        {
            $expedito->Tipo             = $request->expedito["tipo"];
            $expedito->CodigoAlumno     = $request->expedito["codigo"];
            $expedito->Tomo             = $request->expedito["tomo"];
            $expedito->Folio            = $request->expedito["folio"];
            $expedito->Asiento          = $request->expedito["asiento"];
            $expedito->NumSesion        = $request->expedito["sesion"];
            $expedito->FechaIngreso     = $request->expedito["ingreso"];
            $expedito->FechaComienzo    = $request->expedito["comienzo"];
            $expedito->Estado           = 1;
            $expedito->created_at       = $hoy;
            $objMatricula  = explode(",",$request->archivos["matricula"]);
            $objEgresado   = explode(",",$request->archivos["egresado"]);
            $objFoto       = explode(",",$request->archivos["foto"]);
            $matricula  = base64_decode($objMatricula[1]);
            $egresado   = base64_decode($objEgresado[1]);
            $foto       = base64_decode($objFoto[1]);
            $matriculaNombre    = "CM035_".$request->expedito["dni"]."_B.pdf";
            $egresadoNombre     = "CE035_".$request->expedito["dni"]."_B.pdf";
            $fotoNombre         = "F035_".$request->expedito["dni"]."_B.jpg";
            $rutaMatricula  = public_path()."/".$matriculaNombre;
            $rutaEgresado   = public_path()."/".$egresadoNombre;
            $rutaFoto       = public_path()."/".$fotoNombre;
            file_put_contents($rutaMatricula,$matricula);
            file_put_contents($rutaEgresado,$egresado);
            file_put_contents($rutaFoto,$foto);
            $expedito->save();
            $type = "success";
            //$title = "OK";
            $text = "Expedito creado con éxito";
        }else
        {
            $type = "warning";
            //$title = "Advertencia";
            $text = "Egresado ya cuenta con un expedito";
        }
        
        return compact("type","text");
    }

    public function storeTitulo(Request $request)
    {
        $hoy = date("Y-m-d");
        $year = date("Y");
        $expedito = new Expeditob();
        $titulacion = new Titulacion();
        $numEgresado = Expeditob::where("CodigoAlumno",$request->expedito["codigo"])->where("Tipo","TITULO")->get()->count();
        if($numEgresado == 0)
        {
            $expedito->Tipo             = $request->expedito["tipo"];
            $expedito->CodigoAlumno     = $request->expedito["codigo"];
            $expedito->Tomo             = $request->expedito["tomo"];
            $expedito->Folio            = $request->expedito["folio"];
            $expedito->Asiento          = $request->expedito["asiento"];
            $expedito->NumSesion        = $request->expedito["sesion"];
            $expedito->FechaIngreso     = $request->expedito["ingreso"];
            $expedito->FechaComienzo    = $request->expedito["comienzo"];
            $expedito->Estado           = 1;
            $expedito->created_at       = $hoy;
            $titulacion->CodAlumno      = $request->expedito["codigo"];
            $titulacion->Asesor         = $request->expedito["asesor"];
            $titulacion->IDModalidad    = $request->expedito["modalidad"];
            $titulacion->NombreTesis    = mb_strtoupper($request->expedito["tesis"]);
            $titulacion->IDCalificacion   = $request->expedito["calificacion"];
            $titulacion->Fecha          = $request->expedito["sustentacion"];
            $titulacion->created_at     = $hoy;
            $titulacion->save();
            $objMatricula  = explode(",",$request->archivos["matricula"]);
            $objEgresado   = explode(",",$request->archivos["egresado"]);
            $objFoto       = explode(",",$request->archivos["foto"]);
            $objTesis      = explode(",",$request->archivos["tesis"]);
            $objWord       = explode(",",$request->archivos["word"]);
            $matricula  = base64_decode($objMatricula[1]);
            $egresado   = base64_decode($objEgresado[1]);
            $foto       = base64_decode($objFoto[1]);
            $tesis      = base64_decode($objTesis[1]);
            $word       = base64_decode($objWord[1]);
            $matriculaNombre    = "CM035_".$request->expedito["dni"]."_T.pdf";
            $egresadoNombre     = "CE035_".$request->expedito["dni"]."_T.pdf";
            $fotoNombre         = "F035_".$request->expedito["dni"]."_T.jpg";
            $tesisNombre        = "T035_".$request->expedito["dni"]."_T.pdf";
            $WordNombre         = "T035_".$request->expedito["dni"]."_T.docx";
            $rutaMatricula  = public_path()."/".$matriculaNombre;
            $rutaEgresado   = public_path()."/".$egresadoNombre;
            $rutaFoto       = public_path()."/".$fotoNombre;
            $rutaTesis      = public_path()."/".$tesisNombre;
            $rutaWord       = public_path()."/".$WordNombre;
            file_put_contents($rutaMatricula,$matricula);
            file_put_contents($rutaEgresado,$egresado);
            file_put_contents($rutaFoto,$foto);
            file_put_contents($rutaTesis,$tesis);
            file_put_contents($rutaWord,$word);
            $expedito->save();
            $type = "success";
            //$title = "OK";
            $text = "Expedito creado con éxito";
        }else
        {
            $type = "warning";
            //$title = "Advertencia";
            $text = "Egresado ya cuenta con un expedito";
        }
        
        return compact("type","text");
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\expeditob  $expeditob
     * @return \Illuminate\Http\Response
     */
    public function show(expeditob $expeditob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expeditob  $expeditob
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $hoy = date("Y-m-d");
        $IDExpedito = $request->expedito["idexpedito"];
        $expedito = Expeditob::where("IDExpedito",$IDExpedito)->update(
        [
            "Tipo"          => $request->expedito["tipo"],
            "CodigoAlumno"  => $request->expedito["codigo"],
            "Tomo"          => $request->expedito["tomo"],
            "Folio"         => $request->expedito["folio"],
            "Asiento"       => $request->expedito["asiento"],
            "NumSesion"     => $request->expedito["sesion"],
            "FechaIngreso"  => $request->expedito["ingreso"],
            "FechaComienzo" => $request->expedito["comienzo"],
            "updated_at"    => $hoy,
            
        ]);
        if($expedito)
        {
            $type = "success";
            $text = "Expedito editado con éxito";  
        }else
        {
            $type = "success";
            $text = "Expedito editado con éxito";  
        }
        return compact("type","text");
    }
    public function editTitulo(Request $request)
    {
        
        $hoy = date("Y-m-d");
        $IDExpedito = $request->expedito["idexpedito"];
        try {
            $expedito = Expeditob::where("IDExpedito",$IDExpedito)->update(
                [
                    "Tipo"          => $request->expedito["tipo"],
                    "CodigoAlumno"  => $request->expedito["codigo"],
                    "Tomo"          => $request->expedito["tomo"],
                    "Folio"         => $request->expedito["folio"],
                    "Asiento"       => $request->expedito["asiento"],
                    "NumSesion"     => $request->expedito["sesion"],
                    "FechaIngreso"  => $request->expedito["ingreso"],
                    "FechaComienzo" => $request->expedito["comienzo"],
                    "updated_at"    => $hoy,
                    
                ]);
            $titulacion = Titulacion::where("CodAlumno",$request->expedito["codigo"])->update(
                [
                    "Asesor"        => $request->expedito["asesor"],
                    "IDModalidad"   => $request->expedito["modalidad"],
                    "NombreTesis"   => mb_strtoupper($request->expedito["tesis"]),
                    "IDCalificacion"  => $request->expedito["calificacion"],
                    "Fecha"         => $request->expedito["sustentacion"],
                ]
            );
            $type = "success";
            $text = "Expedito editado con éxito";  
        } catch (\Throwable $th) {
            $type = "success";
            $text = $th;  
        }
       
        // if($expedito && $titulacion)
        // {
        //     $type = "success";
        //     $text = "Expedito editado con éxito";  
        // }else
        // {
        //     $type = "warning";
        //     $text = "Comuniquese con un administrador";  
        // }
        return compact("type","text");
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\expeditob  $expeditob
     * @return \Illuminate\Http\Response
     */
    public function update($IDExpedito,$tipo)
    {
        $hoy = date("Y-m-d");
        if($tipo == 1)
        {
            $expedito   = Expeditob::where("IDExpedito",$IDExpedito)->update(
                [
                    "Estado"    => 2,
                    "FechaComienzo"    => $hoy,
                ]);
        }else {
            $expedito   = Expeditob::where("IDExpedito",$IDExpedito)->update(
                [
                    "Estado"    => 3,
                ]);
        }
        if($expedito)
        {
            return "OK";
        }else
        {
            return "fail";
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expeditob  $expeditob
     * @return \Illuminate\Http\Response
     */
    public function destroy(expeditob $expeditob)
    {
        //
    }
}
