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
                        ->select("expedito.*","s.*","es.Estado",\DB::raw("concat_ws(' ',e.Nombre,e.Paterno,e.Materno) as Alumno"))->get();
        
        // $expeditost = \DB::select("SELECT ex.FechaSesion,ex.FechaRecepcion,ex.IDExpedito,
        // concat_ws(' ',e.Nombre,e.Paterno,e.Materno) as Alumno,ex.Estado 
        // FROM egresado e 
        // JOIN expedito ex ON e.Codigo = ex.CodigoAlumno  WHERE ex.Tipo='TITULO'");
        
        // return compact("expeditosb","expeditost");
        return compact("expeditosb");
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
        $expedito->save();
        return "ok";
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
        if($tipo == 1)
        {
            $expedito   = Expeditob::where("IDExpedito",$IDExpedito)->update(
                [
                    "Estado"    => "EN PROCESO",
                ]);
        }else {
            $expedito   = Expeditob::where("IDExpedito",$IDExpedito)->update(
                [
                    "Estado"    => "FINALIZADO",
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
