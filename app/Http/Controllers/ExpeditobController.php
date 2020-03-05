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
        $expeditosb = \DB::select("SELECT ex.FechaSesion,ex.FechaRecepcion,ex.IDExpedito,
        concat_ws(' ',e.Nombre,e.Paterno,e.Materno) as Alumno,ex.Estado 
        FROM egresado e 
        JOIN expedito ex ON e.Codigo = ex.CodigoAlumno  WHERE ex.Tipo='BACHILLER'");
        
        $expeditost = \DB::select("SELECT ex.FechaSesion,ex.FechaRecepcion,ex.IDExpedito,
        concat_ws(' ',e.Nombre,e.Paterno,e.Materno) as Alumno,ex.Estado 
        FROM egresado e 
        JOIN expedito ex ON e.Codigo = ex.CodigoAlumno  WHERE ex.Tipo='TITULO'");
        
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
        
        $expedito->CodigoAlumno     = $request->expedito["alumno"];
        $expedito->FechaSesion      = $request->expedito["sesion"];
        $expedito->FechaRecepcion   = $request->expedito["recepcion"];
        $expedito->created_at       = $hoy;
        $expedito->Estado           = "PENDIENTE";
        if($request->expedito["tipo"] == 1)
        {
            $expedito->Tipo         = "BACHILLER";
        }else{
            $expedito->Tipo         = "TITULO";
        }
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
