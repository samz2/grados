<?php

namespace App\Http\Controllers;

use App\estados;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estados::all();
        return compact("estados");
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
        $NumEstado = Estados::where("Posicion",$request->estado["posicion"])->get()->count();

        if($NumEstado == 0)
        {
            $estado = new Estados();
            $estado->Posicion   = $request->estado["posicion"];
            $estado->Estado     = strtoupper($request->estado["estado"]);
            $estado->save();
            $type   = "success";
            $title  = "Bien";
            $text   = "Estado ingresado con éxito";
        }else{
            $type   = "success";
            $title  = "Ups...";
            $text   = "Ya existe un Estado con esa posición";
        }
        return compact("type","title","text");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\estados  $estados
     * @return \Illuminate\Http\Response
     */
    public function show(estados $estados)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\estados  $estados
     * @return \Illuminate\Http\Response
     */
    public function edit(estados $estados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\estados  $estados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $NumEstado = Estados::where("Posicion",$request->estado["posicion"])->where("IDEstado","!=",$request->estado["idestado"])->get()->count();

        if($NumEstado == 0)
        {
            $estado     = Estados::where("IDEstado",$request->estado["idestado"])->update([
                            "Posicion"  => $request->estado["posicion"],
                            "Estado"    => strtoupper($request->estado["estado"]),
            ]);
            $type   = "success";
            $title  = "Bien";
            $text   = "Estado actualizado con éxito";
        }else{
            $type   = "warning";
            $title  = "Ups...";
            $text   = "Ya existe un Estado con esa posición";
        }
        return compact("type","title","text");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\estados  $estados
     * @return \Illuminate\Http\Response
     */
    public function destroy(estados $estados)
    {
        //
    }
}
