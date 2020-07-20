<?php

namespace App\Http\Controllers;

use App\egresado;
use App\proyecto;
use App\docentes;
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
                        ->select("egresado.*","escuela.Escuela",\DB::raw("concat_ws(' ',egresado.Nombre,egresado.Paterno,egresado.Materno) as NombreAux"))->get();
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
            $egresado->Nombre       = mb_strtoupper($request->egresado["nombre"]);
            $egresado->Paterno      = mb_strtoupper($request->egresado["paterno"]);
            $egresado->Materno      = mb_strtoupper($request->egresado["materno"]);
            $egresado->Celular      = $request->egresado["celular"];
            $egresado->Genero       = $request->egresado["genero"];
            $egresado->Ingreso      = $request->egresado["ingreso"];
            $egresado->Egreso       = $request->egresado["egreso"];
            $egresado->DNI          = $request->egresado["dni"];
            $egresado->Correo       = $request->egresado["correo"];
            $egresado->IDEscuela    = $request->egresado["escuela"];
            $egresado->created_at   = $hoy;
            $egresado->save();
            $title  = "¡Buen trabajo!";
            $msj    = "Egresado creado con éxito";
            $val    = "success";    
        }else {
            $title  = "Ha ocurrido un error";
            $msj    = "Egresado actualmente ya existe";
            $val    = "warning";
        }
        return compact("msj","title","val");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\egresado  $egresado
     * @return \Illuminate\Http\Response
     */
    public function show($d,$c,$a)
    {
        $alumnos = \DB::select("SELECT eg.Codigo,eg.DNI,concat_ws(' ',eg.Nombre,eg.Paterno,eg.Materno) AS Nombres,
        e.Escuela AS Carrera 
        FROM egresado eg
        JOIN escuela e ON eg.IDEscuela = e.IDEscuela
        WHERE (eg.Paterno LIKE '$a%') 
        OR (eg.DNI = '$d') OR (eg.Codigo LIKE '%$c%')");
        return compact("alumnos");
    }

    public function getTesistas($d,$c)
    {
        $tesistas   = [];
        $ID         = "";
        $docente    = "";
        $dni        = "";
        $fechaasignacion = "";
        $objTesistas =  proyecto::join("egresado AS e","proyecto_tesis.Codigo","e.Codigo")
                        ->join("escuela AS es","e.IDEscuela","es.IDEscuela")
                        ->select("proyecto_tesis.IDProyecto","proyecto_tesis.FechaAsignacion")
                        ->where([["proyecto_tesis.Estado",1],["proyecto_tesis.EstadoTramite",2]])
                        ->where(function ($query) use ($c, $d) {
                            $query->where('e.DNI', $d)
                              ->orWhere("e.Codigo","LIKE","%$c%");
                    })->first();

        if(isset($objTesistas))
        {
            $fechaasignacion = $objTesistas->FechaAsignacion; 
            $ID         = $objTesistas->IDProyecto;
            $tesistas   =   proyecto::join("egresado AS e","proyecto_tesis.Codigo","e.Codigo")
                            ->join("escuela AS es","e.IDEscuela","es.IDEscuela")
                            ->select(\DB::raw("concat_ws(' ',e.Nombre,e.Paterno,e.Materno) AS Nombres"),\DB::raw("es.Escuela AS Carrera"))
                            ->where([["IDProyecto",$ID],["proyecto_tesis.Estado",1]])->get();
            $objDocente =   proyecto::join("docentes AS d","proyecto_tesis.CodDocente","d.DNI")
                        ->select(\DB::raw("concat_ws(' ',d.Nombres,Apellidos) AS docente"),"d.DNI")
                        ->where("proyecto_tesis.IDProyecto",$ID)
                        ->first();
            if(isset($objDocente))
            {
                $docente    = $objDocente->docente;
                $dni        = $objDocente->DNI;
            }
        }            
        return compact("tesistas","ID","docente","dni","fechaasignacion");
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
            "Nombre"    => mb_strtoupper($request->egresado["nombre"]),
            "Paterno"   => mb_strtoupper($request->egresado["paterno"]),
            "Materno"   => mb_strtoupper($request->egresado["materno"]),
            "Celular"   => $request->egresado["celular"],
            "Genero"    => $request->egresado["genero"],
            "Ingreso"   => $request->egresado["ingreso"],
            "Egreso"    => $request->egresado["egreso"],
            "DNI"       => $request->egresado["dni"],
            "Correo"    => $request->egresado["correo"],
            "IDEscuela" => $request->egresado["escuela"],
        ]);
        $title  = "¡Buen trabajo!";
        $msj    = "Egresado guardado con éxito";
        $val    = "success";   
        return compact("msj","title","val");
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

    public function tesistas(Request $request)
    {
        $tesistas = array();
        foreach ($request->tesistas as $key) {
            $egresado = Egresado::select("DNI","Codigo AS codigo",\DB::raw("concat_ws(' ',Nombre,Paterno,Materno) AS nombre"))
                        ->where("DNI",$key)->get();
            if(count($egresado) >=1)
            {
                array_push($tesistas,$egresado);
            }
        }
        return compact("tesistas");
    }
}
