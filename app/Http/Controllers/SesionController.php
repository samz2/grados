<?php

namespace App\Http\Controllers;

use App\sesion;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sesiones = Sesion::all();
        return compact("sesiones");
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
        $sesion = new Sesion();
        $sesion->NumSesion  = $request->sesion["sesion"];
        $sesion->Fecha      = $request->sesion["fecha"];
        $sesion->Tipo       = $request->sesion["tipo"];
        $sesion->save();
        $type   = "success";
        $title  = "Bien";
        $text   = "Sesión creada con éxito";
        return compact("type","title","text");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function show(sesion $sesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function edit(sesion $sesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sesion = Sesion::where("IDSesion",$request->sesion["idsesion"])->update([
            "NumSesion"  => $request->sesion["sesion"],
            "Fecha"  => $request->sesion["fecha"],
            "Tipo"  => $request->sesion["tipo"],
        ]);

        if($sesion)
        {
            $type   = "success";
            $title  = "Bien";
            $text   = "Sesion actualizada con éxito";
        }else{
            $type   = "warning";
            $title  = "Ups";
            $text   = "Ocurrió un problema";
        }
        return compact("type","title","text");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(sesion $sesion)
    {
        //
    }
}
