<?php

namespace App\Http\Controllers;

use App\historialproyecto;
use App\Http\Controllers\Controller;
use App\proyecto;
use Illuminate\Http\Request;
use File;
use App\logs;
use Barryvdh\DomPDF\Facade as PDF;
DEFINE("HOY",date("Y-m-d"));

class HistorialproyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $objHistorial   = historialproyecto::where("IDProyecto",$request->proyecto["id"])->get()->count();
        $subestado      = $request->proyecto["subestado"];
        $comentario     = $request->proyecto["comentario"];
        // dd($request->proyecto["tipo"]);
        if($request->proyecto["tipo"] == 2)
        {
            $log = new Logs();
            $log->Descripcion   = "se actualizó al proyecto de tesis";
            $log->Fecha         = HOY;
            $log->idProyecto    = $request->proyecto["id"];
            $log->save();
            try {
                historialproyecto::where("id",$request->proyecto["id"])->update(
                    [
                        "Comentario"        =>   $comentario,
                        "SubEstado"         =>   $request->proyecto["subestado"],
                        "Fecha_Entrega_doc" =>   $request->proyecto["dingreso"],
                        "Fecha_Dev_doc"     =>   $request->proyecto["ddevolucion"],
                        "Fecha_Entrega_alu" =>   $request->proyecto["aingreso"],
                        "Fecha_Dev_alu"     =>   $request->proyecto["adevolucion"],
                    ]
                    ); 
                $type = "success";
                $title = "¡Buen trabajo!";
                $text = "Revisión actualizada con éxito";
            } catch (\Throwable $th) {
                $title = "Error";
                $type = "error";
                $text = "$th";
            }
             
        }else
        {
            $historial = new historialproyecto();
            $historial->IDProyecto          =   $request->proyecto["id"];
            $historial->Comentario          =   $comentario;
            $historial->Estado              =   $request->proyecto["estado"];
            $historial->SubEstado           =   $request->proyecto["subestado"];
            $historial->Fecha_Entrega_doc   =   $request->proyecto["dingreso"];
            $historial->Fecha_Dev_doc       =   $request->proyecto["ddevolucion"];
            $historial->docenteAsesor       =   $request->proyecto["docenteasesor"];
            $historial->Fecha_Entrega_alu   =   $request->proyecto["aingreso"];
            $historial->Fecha_Dev_alu       =   $request->proyecto["adevolucion"];
            $historial->created             =   HOY;
            $historial->save();
            try {
                $proyecto = proyecto::where("IDProyecto",$request->proyecto["id"])
                            ->join("egresado AS e","proyecto_tesis.Codigo","e.codigo")
                            ->join("escuela AS es","e.IDEscuela","es.IDEscuela")
                            ->select("es.Escuela",\DB::raw("GROUP_CONCAT(concat_ws(' ',e.Nombre,e.Paterno,e.Materno)) AS egresado"),"proyecto_tesis.NombreTesis")
                            ->groupby("IDProyecto")
                            ->first();
                
                $dia    = substr(HOY,8,2);
                $mes    = $this->mes(substr(HOY,5,2));
                $year   = substr(HOY,0,4);
                if($request->proyecto["subestado"] == "OBSERVADO")
                {
                    $log = new Logs();
                    $log->Descripcion   = "se ingresó una nueva revisión con estado Observado, con comentario: $comentario, se generó el archivo de informe";
                    $log->Fecha         = HOY;
                    $log->idProyecto    = $request->proyecto["id"];
                    $log->save();

                    $pdf    = PDF::loadView('templates.informeTesista',compact("proyecto","dia","mes","year"));
                    $path   = public_path('Archivos/' . $request->proyecto["id"] . '/');
                    if(!is_dir($path))
                    {
                        \File::makeDirectory($path, 0777, true, true);
                    }                
                    if(file_exists($path."informeObservaciones.pdf"))
                    {
                        if(file_exists($path."informeObservaciones1.pdf"))
                        {
                            file_put_contents($path."informeObservaciones2.pdf", $pdf->output());
                        }else{
                            file_put_contents($path."informeObservaciones1.pdf", $pdf->output());
                        }
                    }else
                    {
                        file_put_contents($path."informeObservaciones.pdf", $pdf->output());
                    }
                }else if($request->proyecto["subestado"] == "CONFORME")
                {
                    $objDocente = historialproyecto::join("docentes AS d","historial.docenteAsesor","d.DNI")->select(\DB::raw("concat_ws(' ',d.Nombres,d.Apellidos) AS docente"))->where("historial.IDProyecto",$request->proyecto["id"])->first();
                    $docente = $objDocente->docente;

                    $sesion  = proyecto::join("sesion AS s","proyecto_tesis.IDSesion","s.IDSesion")->select("s.*",\DB::raw("date_format(s.Fecha,'%d/%m/%Y') AS zFecha"))->where("proyecto_tesis.IDProyecto",$request->proyecto["id"])->first();
                 
                    $log = new Logs();
                    $log->Descripcion   = "se ingresó una nueva revisión con estado CONFORME, con comentario: $comentario, se asigna como asesor al Ing. $docente, y se generó los archivos: memo, oficio y oficio de conformidad";
                    $log->Fecha         = HOY;
                    $log->idProyecto    = $request->proyecto["id"];
                    $log->save();

                    $pdf1    = PDF::loadView('templates.memoAsesor',compact("docente","sesion","proyecto","dia","mes","year"));
                    $pdf2    = PDF::loadView('templates.oficioAsesor',compact("docente","sesion","proyecto","dia","mes","year"));
                    $pdf3    = PDF::loadView('templates.oficioConformidad',compact("docente","sesion","proyecto","dia","mes","year"));
                    $path   = public_path('Archivos/' . $request->proyecto["id"] . '/');
                    if(!is_dir($path))
                    {
                        \File::makeDirectory($path, 0777, true, true);
                    }                
                
                    file_put_contents($path."memoAsesor.pdf", $pdf1->output());
                    file_put_contents($path."oficioAsesor.pdf", $pdf2->output());
                    file_put_contents($path."oficioConformidad.pdf", $pdf3->output());
                }
                
                
                $type = "success";
                $title = "¡Buen trabajo!";
                $text = "Revisión creada con éxito";
            } catch (\Throwable $th) {
                $title = "Error";
                $type = "error";
                $text = "$th";
            }
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
     * Display the specified resource.
     *
     * @param  \App\historialproyecto  $historialproyecto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historial = historialproyecto::where("IDProyecto",$id)->get();
        return compact("historial");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\historialproyecto  $historialproyecto
     * @return \Illuminate\Http\Response
     */
    public function edit(historialproyecto $historialproyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\historialproyecto  $historialproyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, historialproyecto $historialproyecto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\historialproyecto  $historialproyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(historialproyecto $historialproyecto)
    {
        //
    }
}
