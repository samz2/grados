<?php

namespace App\Http\Controllers;

use App\tramite;
use Illuminate\Http\Request;

class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tramites = \DB::select("SELECT t.IDTramite,e.Codigo,concat_ws(' ',e.Nombre,e.Paterno,e.Materno) as Alumno,
        concat_ws(' ',d.Nombres,d.Apellidos) as Docente,t.FechaRecepcion,es.Escuela,t.Tema,t.Tipo,t.Estado 
        FROM tramite t JOIN egresado e ON t.CodigoAlumno = e.Codigo 
        JOIN escuela es ON e.IDEscuela = es.IDEscuela 
        LEFT JOIN docentes d ON t.DNIDocente = d.DNI");
        return compact("tramites");
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
        $tramite    = new Tramite();
        $tramite->CodigoAlumno      = $request->tramite["alumno"];
        $tramite->DNIDocente        = $request->tramite["docente"];
        $tramite->FechaRecepcion    = $request->tramite["fechar"];
        $tramite->Tema              = strtoupper($request->tramite["tema"]);
        $tramite->Tipo              = $request->tramite["tipo"];
        $tramite->Estado            = "RECIBIDO";
        $tramite->save();
        return "OK";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function show(tramite $tramite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function edit(tramite $tramite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->tramite["accion"] == 1)
        {
            $estado = Tramite::where("IDtramite",$request->tramite["id"])->update([
                "Estado" =>"ACEPTADO",
                "FechaAceptacion" =>$request->tramite["fechaa"],

            ]);
        }else if($request->tramite["accion"] == 2)
        {
            $estado = Tramite::where("IDtramite",$request->tramite["id"])->update([
                "Estado" =>"OBSERVADO",
                "FechaEntrega" =>$request->tramite["fechae"],

            ]);
        }else if($request->tramite["accion"] == 3)
        {
            $estado = Tramite::where("IDtramite",$request->tramite["id"])->update([
                "Estado" =>"RECHAZADO",
            ]);
        }
        return "ok";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function destroy(tramite $tramite)
    {
        //
    }
}
