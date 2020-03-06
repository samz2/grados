<?php

namespace App\Http\Controllers;

use App\docentes;
use Illuminate\Http\Request;

class DocentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes = Docentes::join("escuela AS e","docentes.IDEscuela","=","e.IDEscuela")->select("docentes.*","e.Escuela")->get();
        return compact("docentes");
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
        $docente    = new Docentes();
        $hoy        = date("Y-m-d");
        $objDocente = Docentes::select("*")->where("DNI",$request->docente["dni"])->get();
        if(count($objDocente) == 0)
        {
            $docente->DNI           = $request->docente["dni"];
            $docente->Nombres       = strtoupper($request->docente["nombres"]);
            $docente->Apellidos     = strtoupper($request->docente["apellidos"]);
            $docente->Celular       = $request->docente["celular"];
            $docente->IDEscuela     = $request->docente["escuela"];
            $docente->Dedicacion    = $request->docente["dedicacion"];
            $docente->Categoria     = $request->docente["categoria"];
            $docente->Codigo        = $request->docente["codigo"];
            $docente->created_at    = $hoy;
            $docente->save();
            $type   = "success";
            $title  = "Bien";
            $text   = "Docente agregado con éxito";
        }else
        {
            $type   = "error";
            $title  = "Error";
            $text   = "Docente ya existe";
        }
        return compact("type","title","text");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function show(docentes $docentes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function edit(docentes $docentes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $docente = Docentes::where("DNI",$request->docente["dni"])->update([
            "DNI"           => $request->docente["dni"],
            "Nombres"       => ucwords($request->docente["nombres"]),
            "Apellidos"     => ucwords($request->docente["apellidos"]),
            "Celular"       => $request->docente["celular"],
            "IDEscuela"     => $request->docente["escuela"],
        ]);
        return "ok";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function destroy(docentes $docentes)
    {
        //
    }
}
