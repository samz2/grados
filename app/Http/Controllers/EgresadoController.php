<?php

namespace App\Http\Controllers;

use App\egresado;
use Illuminate\Http\Request;

class EgresadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $egresados  =   Egresado::join("escuela","egresado.IDEscuela","escuela.IDEscuela")
                        ->select("egresado.*","escuela.Escuela")->get();
        return compact("egresados");
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
        
        $objEgresado            = Egresado::select("*")->where("Codigo",$request->egresado["codigo"])->get();

        if(count($objEgresado) == 0)
        {
            $egresado = new Egresado();
            $egresado->Codigo       = $request->egresado["codigo"];
            $egresado->Nombre       = strtoupper($request->egresado["nombre"]);
            $egresado->Paterno      = strtoupper($request->egresado["paterno"]);
            $egresado->Materno      = strtoupper($request->egresado["materno"]);
            $egresado->Celular      = $request->egresado["celular"];
            $egresado->Genero       = $request->egresado["genero"];
            $egresado->Ingreso      = $request->egresado["ingreso"];
            $egresado->Egreso       = $request->egresado["egreso"];
            $egresado->DNI          = $request->egresado["dni"];
            $egresado->Correo       = strtolower($request->egresado["correo"]);
            $egresado->IDEscuela    = $request->egresado["escuela"];
            $egresado->created_at   = $hoy;
            $egresado->save();
            $title  = "OK";
            $msj    = "Egresado registrado correctamente";
            $val    = "success";    
        }else {
            $title  = "Error";
            $msj    = "Egresado ya Existe";
            $val    = "warning";
        }
        return compact("title","msj","val");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\egresado  $egresado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumnos = \DB::select("SELECT IDEgresado,Codigo, concat_ws(' ',Nombre,Paterno,Materno) AS Nombres FROM egresado WHERE (Paterno LIKE '$id%') 
        OR (Materno LIKE '$id%') OR (Nombre LIKE '$id%')");
        return compact("alumnos");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\egresado  $egresado
     * @return \Illuminate\Http\Response
     */
    public function edit(egresado $egresado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\egresado  $egresado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $egresado = Egresado::where("IDEgresado",$request->egresado["IDEgresado"])->update([
            "Codigo"    => $request->egresado["codigo"],
            "Nombre"    => strtoupper($request->egresado["nombre"]),
            "Paterno"   => strtoupper($request->egresado["paterno"]),
            "Materno"   => strtoupper($request->egresado["materno"]),
            "Celular"   => $request->egresado["celular"],
            "Genero"    => $request->egresado["genero"],
            "Ingreso"   => $request->egresado["ingreso"],
            "Egreso"    => $request->egresado["egreso"],
            "DNI"       => $request->egresado["dni"],
            "Correo"    => strtolower($request->egresado["correo"]),
            "IDEscuela" => $request->egresado["escuela"],
        ]);
        $title  = "OK";
        $msj    = "Egresado registrado correctamente";
        $val    = "success";   
        return compact("title","msj","val");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\egresado  $egresado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $egresado = Egresado::where("IDEgresado","=",$id)->delete();
        return "OK";
    }

    public function alumnos()
    {
        $egresados  = Egresado::select("Codigo AS code",\DB::raw("concat_ws(' ',Nombre,Paterno,Materno) AS label"))->get();
        return compact("egresados");
    }
}
