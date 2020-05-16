<?php

namespace App\Http\Controllers;

use App\modalidad;
use Illuminate\Http\Request;

class ModalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modalidades = Modalidad::all();
        return compact("modalidades");
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
        $modalidad = new Modalidad();
        try {
            $modalidad->Modalidad = mb_strtoupper($request->modalidad["modalidad"]);
            $modalidad->save();
            $type   = "success";
            $title  = "Buen trabajo";
            $text   = "Modalidad creada con éxito";
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
     * @param  \App\modalidad  $modalidad
     * @return \Illuminate\Http\Response
     */
    public function show(modalidad $modalidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modalidad  $modalidad
     * @return \Illuminate\Http\Response
     */
    public function edit(modalidad $modalidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modalidad  $modalidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $modalidad = Modalidad::where("IDModalidad",$request->modalidad["idmodalidad"])->update([
            "Modalidad"  => mb_strtoupper($request->modalidad["modalidad"])
        ]);

        if($modalidad)
        {
            $type   = "success";
            $title  = "¡Buen trabajo!";
            $text   = "Modalidad guardada con éxito";
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
     * @param  \App\modalidad  $modalidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(modalidad $modalidad)
    {
        //
    }
}
