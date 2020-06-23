<?php

namespace App\Http\Controllers;

use App\historialproyecto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistorialproyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $historial = new historialproyecto();
        $historial->IDProyecto          =   $request->proyecto["id"];
        $historial->Comentario          =   $request->proyecto["comentario"];
        $historial->Estado              =   $request->proyecto["estado"];
        $historial->SubEstado           =   $request->proyecto["subestado"];
        $historial->Fecha_Entrega_doc   =   $request->proyecto["dingreso"];
        $historial->Fecha_Dev_doc       =   $request->proyecto["ddevolucion"];
        $historial->Fecha_Entrega_alu   =   $request->proyecto["aingreso"];
        $historial->Fecha_Dev_alu       =   $request->proyecto["adevolucion"];
        $historial->created             =   $hoy;
        $historial->save();
        $type = "success";
        $title = "¡Buen trabajo!";
        $text = "Revisión creada con éxito";
        return compact("type","title","text");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\historialproyecto  $historialproyecto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historial = historialproyecto::where("IDProyecto",$id)->get();
        return compact("historial");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\historialproyecto  $historialproyecto
     * @return \Illuminate\Http\Response
     */
    public function edit(historialproyecto $historialproyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\historialproyecto  $historialproyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, historialproyecto $historialproyecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\historialproyecto  $historialproyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(historialproyecto $historialproyecto)
    {
        //
    }
}
