<?php

namespace App\Http\Controllers;

use App\decano;
use Illuminate\Http\Request;

class DecanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $decanos =   Decano::join("docentes AS d","decano.CodDocente","d.DNI")
                        ->select("decano.*",\DB::raw("concat_ws(' ',d.Nombres,d.Apellidos) as auxDecano"),\DB::raw("date_format(PeriodoInicio,'%d-%m-%Y') AS FechaInicioAux"),\DB::raw("date_format(PeriodoFin,'%d-%m-%Y') AS FechaFinAux"))
                        ->get();    
        return compact("decanos");
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
        $numDecano  = Decano::where("PeriodoInicio","<=",$request->decano["inicio"])->where("PeriodoFin",">=",$request->decano["inicio"])->get()->count();
        if($numDecano == 0)
        {
            $decano = new Decano();
            $decano->CodDocente     = $request->decano["decano"];
            $decano->PeriodoInicio  = $request->decano["inicio"];
            $decano->PeriodoFin     = $request->decano["fin"];
            $decano->Estado         = $request->decano["estado"];
            $decano->save();
            $type   = "success";
            $title  = "¡Buen trabajo!";
            $text   = "Decano creado con éxito";
        }else{
            $type   = "warning";
            $title  = "Ha ocurrido un error";
            $text   = "Ya existe un decano para este periodo de tiempo";
        }
        return compact("type","title","text");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\decano  $decano
     * @return \Illuminate\Http\Response
     */
    public function show(decano $decano)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\decano  $decano
     * @return \Illuminate\Http\Response
     */
    public function edit(decano $decano)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\decano  $decano
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $decano = Decano::where("IDDecano",$request->decano["iddecano"])->update([
            "CodDocente"  => $request->decano["decano"],
            "PeriodoInicio"  => $request->decano["inicio"],
            "PeriodoFin"  => $request->decano["fin"],
            "Estado"  => $request->decano["estado"],
        ]);

        if($decano)
        {
            $type   = "success";
            $title  = "¡Buen trabajo!";
            $text   = "Decano guardado con éxito";
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
     * @param  \App\decano  $decano
     * @return \Illuminate\Http\Response
     */
    public function destroy(decano $decano)
    {
        //
    }
}
