<?php

namespace App\Http\Controllers;

use App\proyecto;
use App\egresado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos  =   Proyecto::join("escuela AS e","proyecto_tesis.IDCarrera","e.IDEscuela")
                        ->join("egresado AS eg","proyecto_tesis.Codigo","eg.Codigo")
                        ->select("proyecto_tesis.*",\DB::raw("GROUP_CONCAT(eg.DNI) AS Codigos"),\DB::raw("GROUP_CONCAT(concat(eg.Nombre,' ',eg.Paterno,' ',eg.Materno)) AS Tesistas"),"e.Escuela AS Carrera",\DB::RAW("DATE_FORMAT(proyecto_tesis.FechaRegistro,'%d-%m-%Y') AS Fecha"))
                        ->where("proyecto_tesis.Estado","1")
                        ->groupBy("proyecto_tesis.IDProyecto")
                        ->get();
        return compact("proyectos");                
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
        $nroProyecto = Proyecto::all()->last();
        //$nroProyecto = Proyecto::select("IDProyecto")->all();
        if(isset($nroProyecto))
        {
            $nro = $nroProyecto->IDProyecto + 1; 
        }else
        {
            $nro = 1;
        }
        foreach ($request->tesistas as $key) {
            $objProyecto = Proyecto::where("Codigo",$key[0]["codigo"])->get()->count();
            if($objProyecto == 0)
            {
                $proyecto = new Proyecto();
                $proyecto->IDProyecto   = $nro;
                $proyecto->Codigo       = $key[0]["codigo"];
                $proyecto->IDCarrera    = $request->proyecto["carrera"];
                $proyecto->NombreTesis  = $request->proyecto["tesis"];
                $proyecto->IDLinea      = $request->proyecto["linea"];
                $proyecto->CodDocente   = $request->proyecto["docente"];
                $proyecto->FechaRegistro   = $request->proyecto["fecha"];
                $proyecto->Porcentaje   = $request->proyecto["porcentaje"];
                $proyecto->created_at   = $hoy;
                $proyecto->save();
                $type = "success";
                $title = "¡Buen trabajo!";
                $text = "Proyecto de tesis guardado con éxito"; 
            }else
            {
                $type = "error";
                $title = "¡Ocurrió un problema!";
                $text = "Ya existe un trámite con este(os) tesistas"; 
            }
        }         
        return compact("type","title","text"); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit(proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $hoy = date("Y-m-d");
        if(isset($request->tesista))
        {
            $objEgresado = Egresado::select("Codigo")->where("DNI",$request->tesista)->first();
            if(isset($objEgresado))
            {
                $codigo = $objEgresado->Codigo;
                Proyecto::where("Codigo",$codigo)
                ->where("IDProyecto",$request->proyecto["idproyecto"])
                ->update(
                    [
                     "Estado"        => 0,
                     "updated_at"    => $hoy,
                    ]);
            }
            
           
        }
        $n = 0;
        foreach ($request->tesistas as $key => $val) {
            $proAux      =  Proyecto::where("Codigo",$val[0]["codigo"])
                            ->where("IDProyecto",$request->proyecto["idproyecto"])->get()->count();
            if($proAux > 0)
            {
                $objProyecto = Proyecto::where("Codigo",$val[0]["codigo"])
                           ->where("IDProyecto",$request->proyecto["idproyecto"])
                           ->update(
                               [
                                "IDCarrera"     => $request->proyecto["carrera"],
                                "NombreTesis"   => mb_strtoupper($request->proyecto["tesis"]),
                                "IDLinea"       => $request->proyecto["linea"],
                                "CodDocente"    => $request->proyecto["docente"],
                                "FechaRegistro" => $request->proyecto["fecha"],
                                "Porcentaje"    => $request->proyecto["porcentaje"],
                                "updated_at"    => $hoy,
                               ]);
            }else{
                $proyecto = new Proyecto();
                $proyecto->IDProyecto   = $request->proyecto["idproyecto"];
                $proyecto->Codigo       = $val[0]["codigo"];
                $proyecto->IDCarrera    = $request->proyecto["carrera"];
                $proyecto->NombreTesis  = $request->proyecto["tesis"];
                $proyecto->IDLinea      = $request->proyecto["linea"];
                $proyecto->CodDocente   = $request->proyecto["docente"];
                $proyecto->FechaRegistro   = $request->proyecto["fecha"];
                $proyecto->Porcentaje   = $request->proyecto["porcentaje"];
                $proyecto->created_at   = $hoy;
                $proyecto->save();
            }
                        $type = "success";
                        $title = "¡Buen trabajo!";
                        $text = "Proyecto de tesis actualizado con éxito"; 
                        
                        
           
        }
        return compact("type","title","text"); 
        //return compact("msj","val");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(proyecto $proyecto)
    {
        //
    }
}
