<?php

namespace App\Http\Controllers;

use App\expeditob;
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
                        ->select("expedito.*",\DB::raw("concat_ws('-',expedito.Tomo,expedito.Folio,expedito.Asiento) AS Acta"),"esc.Escuela","s.*","es.Estado",\DB::raw("concat_ws(' ',e.Nombre,e.Paterno,e.Materno) as Alumno"))
                        ->where("expedito.Tipo","BACHILLER")->get();
        
        $expeditost =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
        ->join("sesion AS s","expedito.NumSesion","s.NumSesion")
        ->join("estados AS es","expedito.Estado","es.Posicion")
        ->join("escuela AS esc","e.IDEscuela","esc.IDEscuela")
        ->select("expedito.*",\DB::raw("concat_ws('-',expedito.Tomo,expedito.Folio,expedito.Asiento) AS Acta"),"esc.Escuela","s.*","es.Estado",\DB::raw("concat_ws(' ',e.Nombre,e.Paterno,e.Materno) as Alumno"))
        ->where("expedito.Tipo","TITULO")->get();
        // $expeditost = \DB::select("SELECT ex.FechaSesion,ex.FechaRecepcion,ex.IDExpedito,
        // concat_ws(' ',e.Nombre,e.Paterno,e.Materno) as Alumno,ex.Estado 
        // FROM egresado e 
        // JOIN expedito ex ON e.Codigo = ex.CodigoAlumno  WHERE ex.Tipo='TITULO'");
        
        // return compact("expeditosb","expeditost");
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
        $numEgresado = Expeditob::where("CodigoAlumno",$request->expedito["codigo"])->get()->count();
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
            $matriculaNombre    = "CM_".$request->expedito["codigo"].".pdf";
            $egresadoNombre     = "CE_".$request->expedito["codigo"].".pdf";
            $fotoNombre         = $request->expedito["codigo"].".jpg";
            $rutaMatricula  = public_path()."/".$matriculaNombre;
            $rutaEgresado   = public_path()."/".$egresadoNombre;
            $rutaFoto       = public_path()."/".$fotoNombre;
            file_put_contents($rutaMatricula,$matricula);
            file_put_contents($rutaEgresado,$egresado);
            file_put_contents($rutaFoto,$foto);
            $expedito->save();
            $type = "success";
            $title = "OK";
            $text = "Expedito creado satisfactoriamente";
        }else
        {
            $type = "warning";
            $title = "Advertencia";
            $text = "Egresado ya tiene un expedito";
        }
        
        return compact("type","title","text");
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
    public function edit(expeditob $expeditob)
    {
        //
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
