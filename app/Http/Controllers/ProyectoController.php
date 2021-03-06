<?php

namespace App\Http\Controllers;

use App\proyecto;
use App\egresado;
use App\historialproyecto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\logs;
use File;
DEFINE("HOY",date("Y-m-d"));

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *SELECT pt.IDProyecto, h.Estado,h.SubEstado FROM proyecto_tesis pt LEFT JOIN historial h ON pt.IDProyecto = h.IDProyecto WHERE h.id=(SELECT max(id) FROM historial ) 
     *OR h.IDProyecto is null GROUP BY h.IDProyecto ORDER BY h.id DESC
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos  =   Proyecto::join("escuela AS e","proyecto_tesis.IDCarrera","e.IDEscuela")
                        ->join("egresado AS eg","proyecto_tesis.Codigo","eg.Codigo")
                        ->select("proyecto_tesis.*",\DB::raw("GROUP_CONCAT(eg.DNI) AS Codigos"),\DB::raw("GROUP_CONCAT(concat(eg.Nombre,' ',eg.Paterno,' ',eg.Materno)) AS Tesistas"),"e.Escuela AS Carrera",\DB::RAW("DATE_FORMAT(proyecto_tesis.FechaRegistro,'%d-%m-%Y') AS Fecha"))
                        // ->where("proyecto_tesis.Estado","1")
                        ->groupBy("proyecto_tesis.IDProyecto")
                        ->get();
                
        return compact("proyectos");                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        // dd($request->sesion);
        $sesion     = $request->sesion;
        $dia        = substr(HOY,8,2);
        $mes        = $this->mes(substr(HOY,5,2));
        $year       = substr(HOY,0,4);
        $orgDate    = $sesion["fecha"];
        $fecha      = date("d-m-Y", strtotime($orgDate));
        Proyecto::where("IDProyecto",$request->sesion["idproyecto"])
                ->update(
                    [
                     "CodDocente"   => $request->sesion["docente"],
                     "EstadoTramite"   => 2,
                     "FechaAsignacion"   => HOY,
                     "IDSesion"     => $sesion["sesion"],
                    ]);

            $log = new Logs();
            $log->Descripcion   = "Se cambia a estado En Proceso y se crea el Memorandum y Oficio al docente evaluador.";
            $log->Fecha         = HOY;
            $log->idProyecto    = $request->sesion["idproyecto"];
            $log->save();

        try {
            $pdf = PDF::loadView('templates.memoProyecto',compact("sesion","fecha","dia","mes","year"));
            $pdf1 = PDF::loadView('templates.oficioProyecto',compact("sesion","fecha","dia","mes","year"));
            $path = public_path('Archivos/' . $request->sesion["idproyecto"] . '/');
            if(!is_dir($path))
            {
                \File::makeDirectory($path, 0777, true, true);
            }                
            file_put_contents($path."memo.pdf", $pdf->output());
            file_put_contents($path."oficio.pdf", $pdf1->output());
            $type = "success";
            $title = "¡Buen trabajo!";
            $text = "Archivos generados con éxito";
        } catch (\Throwable $th) {
            $type = "error";
            $title = "¡Error!";
            $text = "$th";
        }
        return compact("type","title","text");
    }
    public function mes($indice)
    {
        $meses["01"]    = "enero";
        $meses["02"]    = "febrero"; 
        $meses["03"]    = "marzo"; 
        $meses["04"]    = "abril"; 
        $meses["05"]    = "mayo"; 
        $meses["06"]    = "junio"; 
        $meses["07"]    = "julio"; 
        $meses["08"]    = "agosto"; 
        $meses["09"]    = "setiembre"; 
        $meses["10"]    = "octubre"; 
        $meses["11"]    = "noviembre"; 
        $meses["12"]    = "diciembre";
        $mes = $meses[$indice];
        return $mes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nroProyecto = Proyecto::all()->last();
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
                $tema       = $request->proyecto["tesis"];
                $codigo   = $key[0]["codigo"];
                $proyecto = new Proyecto();
                $proyecto->IDProyecto   = $nro;
                $proyecto->Codigo       = $codigo;
                $proyecto->IDCarrera    = $request->proyecto["carrera"];
                $proyecto->NombreTesis  = $tema;
                $proyecto->IDLinea      = $request->proyecto["linea"];
                $proyecto->CodDocente   = $request->proyecto["docente"];
                $proyecto->FechaRegistro   = $request->proyecto["fecha"];
                $proyecto->Porcentaje   = $request->proyecto["porcentaje"];
                $proyecto->created_at   = HOY;
                $proyecto->save();
                $objPY                  = explode(",",$request->proyecto["archivo"]);
                $proyecto               = base64_decode($objPY[1]);
                $proyecto_tesis        = "SISTEMAS_PT_".$nro."_V1.pdf";
                $log = new Logs();
                $log->Descripcion   = "Se crea el proyecto de tesis para el tesista con código universitario: $codigo.";
                $log->Fecha         = HOY;
                $log->idProyecto    = $nro;
                $log->save();

                // $path = public_path('Archivos bachiller/' . $dni . '/');
                // if(!Storage::exists(public_path()."proyecto_tesis/$codigo")) {
                //     Storage::makeDirectory(public_path()."proyecto_tesis/$codigo", 0775, true);
                // }
                $path = public_path('Archivos/'.$nro.'/');
                File::makeDirectory($path, 0777, true, true);
                $rutaProyecto  = public_path('Archivos/'.$nro)."/".$proyecto_tesis ;
                file_put_contents($rutaProyecto,$proyecto);
                
                $type = "success";
                $title = "¡Buen trabajo!";
                $text = "Proyecto de tesis guardado con éxito"; 
            }else
            {
                $type = "error";
                $title = "¡Ocurrió un problema!";
                $text = "Ya existe un trámite con este(os) tesista(s)"; 
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
                     "updated_at"    => HOY,
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
                                "updated_at"    => HOY,
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
                $proyecto->created_at   = HOY;
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

    public function finalizar(Request $request)
    {
            $log = new Logs();
            $log->Descripcion   = "Se registra el número y fecha de resolución; y se da por Finalizado el proyecto de tesis.";
            $log->Fecha         = HOY;
            $log->idProyecto    = $request->proyecto["idproyecto"];
            $log->save();

        try {
            proyecto::where("ID",$request->proyecto["idproyecto"])->update(
                [
                    "numeroResolucion"  =>  $request->proyecto["numresolucion"],
                    "FechaResolucion"   =>  $request->proyecto["fecharesolucion"],
                    "EstadoTramite"            =>  3
                ]
            );

            $type="success";
            $title = "¡Buen trabajo!";
            $text="Proyecto finalizado con éxito";
        } catch (\Throwable $th) {
            $type="error";
            $title = "¡Buen trabajo!";
            $text="error: $th";
        }
        return compact("type","title","text");
    } 
    
}
