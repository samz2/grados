<?php

namespace App\Http\Controllers;

use App\linea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LineaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lineas =   Linea::join("Escuela AS e","Linea.Escuela","e.IDEscuela")
                    ->select("e.Escuela","e.IDEscuela","Linea.IDLinea","Linea.Linea")->get();
        return compact("lineas");            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $linea = new linea();
        $linea->Linea       = mb_strtoupper($request->linea["linea"]);
        $linea->Escuela     = $request->linea["escuela"];
        $linea->created_at  = $hoy;
        $linea->save();
        $type = "success";
        $title = "¡Buen trabajo!";
        $text = "Línea investigación guardado con éxito"; 
        return compact("type","title","text");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\linea  $linea
     * @return \Illuminate\Http\Response
     */
    public function show($escuela)
    {
        $lineas =   Linea::join("Escuela AS e","Linea.Escuela","e.IDEscuela")
                    ->select("e.Escuela","e.IDEscuela","Linea.IDLinea","Linea.Linea")
                    ->where("Linea.Escuela",$escuela)->get();
        return compact("lineas");     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\linea  $linea
     * @return \Illuminate\Http\Response
     */
    public function edit(linea $linea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\linea  $linea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $linea = Linea::where("IDLinea",$request->linea["idlinea"])->update([
            "Linea"  => mb_strtoupper($request->linea["linea"])
        ]);

        if($linea)
        {
            $type = "success";
            $title="¡Buen trabajo!";
            $text = "Línea investigación guardado con éxito";
        }else{
            $type = "success";
            $title="¡Buen trabajo!";
            $text = "Línea investigación guardado con éxito";
        }
        return compact("type","title","text");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\linea  $linea
     * @return \Illuminate\Http\Response
     */
    public function destroy(linea $linea)
    {
        //
    }
}
