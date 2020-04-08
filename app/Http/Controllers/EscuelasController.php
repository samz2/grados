<?php

namespace App\Http\Controllers;

use App\escuelas;
use Illuminate\Http\Request;

class EscuelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escuelas = Escuelas::select("*")->get();
        return compact("escuelas");
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
        $escuela = new Escuelas();
        $escuela->Escuela       = mb_strtoupper($request->carrera["carrera"]);
        //$escuela->Escuela       = $request->carrera["carrera"];
        $escuela->created_at    = $hoy;
        $escuela->save();
        $type   = "success";
        //$title  = "Bien";
        $text   = "Carrera creada con éxito";
        return compact("type","title","text");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function show(escuelas $escuelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function edit(escuelas $escuelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $escuela = Escuelas::where("IDEscuela",$request->carrera["idcarrera"])->update([
            "Escuela"        => mb_strtoupper($request->carrera["carrera"]),
            //"Escuela"        => $request->carrera["carrera"],
        ]);
        if($escuela)
        {
            $type   = "success";
            //$title  = "Bien";
            $text   = "Carrera editada con éxito";
        }else{
            $type   = "warning";
            //$title  = "Ups";
            $text   = "Ocurrió un problema";
        }
        return compact("type","title","text");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Escuela = Escuelas::where("IDEscuela","=",$id)->delete();
        return "OK";
    }
}
