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
        $docentes = Docentes::join("escuela AS e","docentes.IDEscuela","=","e.IDEscuela")->select("docentes.*","e.Escuela",\DB::raw("concat_ws(' ',docentes.Nombres,docentes.Apellidos) as NombreAux"))->get();
        return compact("docentes");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function docentes($id)
    {
        $docentes = Docentes::select("DNI",
                    \DB::raw("concat_ws(' ',Nombres,Apellidos) as Docente"))
                    ->where("IDEscuela",$id)->get();
        return compact("docentes");
    }

    public function docente($dni)
    {
        $docentes = Docentes::select(\DB::raw("concat_ws(' ',Nombres,Apellidos) as Docente"))
                    ->where("DNI",$dni)->first();
        $docente  = isset($docentes) ? $docentes->Docente : "";
        return compact("docente");
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
            $docente->Nombres       = mb_strtoupper($request->docente["nombres"]);
            $docente->Apellidos     = mb_strtoupper($request->docente["apellidos"]);
            $docente->Celular       = $request->docente["celular"];
            $docente->Correo       = $request->docente["correo"];
            $docente->IDEscuela     = $request->docente["escuela"];
            $docente->Dedicacion    = $request->docente["dedicacion"];
            $docente->Categoria     = $request->docente["categoria"];
            $docente->Codigo        = $request->docente["codigo"];
            $docente->created_at    = $hoy;
            $docente->save();
            $type   = "success";
            $title  = "¡Buen trabajo!";
            $text   = "Docente creado con éxito";
        }else
        {
            $type   = "error";
            $title  = "Ha ocurrido un error";
            $text   = "Docente actualmente ya existe";
        }
        return compact("type","title","text");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\docentes  $docentes
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $docentes = Docentes::select("*")->where("Categoria","PRINCIPAL")->get();
        return compact("docentes");
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
            "Nombres"       => mb_strtoupper($request->docente["nombres"]),
            "Apellidos"     => mb_strtoupper($request->docente["apellidos"]),
            "Celular"       => $request->docente["celular"],
            "Correo"       => $request->docente["correo"],
            "IDEscuela"     => $request->docente["escuela"],
            "Dedicacion"    => $request->docente["dedicacion"],
            "Categoria"     => $request->docente["categoria"],
            "Codigo"        => mb_strtoupper($request->docente["codigo"]),
        ]);

        if($docente)
        {
            $type   = "success";
            $title  = "¡Buen trabajo!";
            $text   = "Docente guardado con éxito";
        }else{
            $type   = "warning";
            $title  = "Ha ocurrido un error";
            $text   = "Contáctese con un administrador";
        }
        return compact("type","title","text");
        //return compact("type","text");
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
