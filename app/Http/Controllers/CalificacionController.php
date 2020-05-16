<?php

namespace App\Http\Controllers;

use App\calificacion;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calificaciones = Calificacion::all();
        return compact("calificaciones");
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
        $calificacion = new Calificacion();
        try {
            $calificacion->Calificacion = mb_strtoupper($request->calificacion["calificacion"]);
            $calificacion->save();
            $type   = "success";
            $title  = "¡Buen trabajo!";
            $text   = "Calificación creada con éxito";
        } catch (\Throwable $th) {
            $type   = "error";
            $title  = "Ha ocurrido un error";
            $text   = $th->errorInfo[2];
        }
        
        
        return compact("type","title","text");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    public function show(calificacion $calificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(calificacion $calificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $calificacion = Calificacion::where("IDCalificacion",$request->calificacion["idcalificacion"])->update([
            "Calificacion"  => mb_strtoupper($request->calificacion["calificacion"])
        ]);

        if($calificacion)
        {
            $type   = "success";
            $title  = "¡Buen trabajo!";
            $text   = "Calificación guardada con éxito";
        }else{
            $type   = "warning";
            $title  = "Ha ocurrido un error";
            $text   = "Comuníquese con un administrador";
        }
        return compact("type","title","text");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\calificacion  $calificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(calificacion $calificacion)
    {
        //
    }
}
