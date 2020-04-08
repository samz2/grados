<?php

namespace App\Http\Controllers;

use App\comision;
use Illuminate\Http\Request;

class ComisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comisiones =   Comision::join("docentes AS d","comision.Presidente","d.DNI")
                        ->join("docentes AS do","comision.Miembro1","do.DNI")
                        ->join("docentes AS doc","comision.Miembro2","doc.DNI")
                        ->select("comision.*",\DB::raw("concat_ws(' ',d.Apellidos,d.Nombres) as auxPresidente"),\DB::raw("concat_ws(' ',do.Apellidos,do.Nombres) as auxMiembro1"),\DB::raw("concat_ws(' ',doc.Apellidos,doc.Nombres) as auxMiembro2"),\DB::raw("date_format(FechaInicio,'%d-%m-%Y') AS FechaInicioAux"),\DB::raw("date_format(FechaFin,'%d-%m-%Y') AS FechaFinAux"))
                        ->get();    
        return compact("comisiones");
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
        $comision = new Comision();
        $comision->Semestre     = mb_strtoupper($request->comision["semestre"]);
        $comision->Presidente   = $request->comision["presidente"];
        $comision->Miembro1     = $request->comision["miembro1"];
        $comision->Miembro2     = $request->comision["miembro2"];
        $comision->Estado       = $request->comision["estado"];
        $comision->FechaInicio  = $request->comision["inicio"];
        $comision->FechaFin     = $request->comision["fin"];
        $comision->save();
        $type   = "success";
        //$title  = "Bien";
        $text   = "Comisión creada con éxito";
        return compact("type","title","text");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function show(comision $comision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function edit(comision $comision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $comision = Comision::where("IDComision",$request->comision["idcomision"])->update([
            "Semestre"      => mb_strtoupper($request->comision["semestre"]),
            "Presidente"    => $request->comision["presidente"],
            "Miembro1"      => $request->comision["miembro1"],
            "Miembro2"      => $request->comision["miembro2"],
            "Estado"        => $request->comision["estado"],
            "FechaInicio"   => $request->comision["inicio"],
            "FechaFin"      => $request->comision["fin"],
        ]);
        if($comision)
        {
            $type   = "success";
            //$title  = "Bien";
            $text   = "Comisión editada con éxito";
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
     * @param  \App\comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function destroy(comision $comision)
    {
        //
    }
}
