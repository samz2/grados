<?php

namespace App\Http\Controllers;

use App\documentos;
use App\expeditob;
use App\decano;
use App\comision;
use App\Mail\GradosyTitulos;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documentos::join("egresado AS e","documentos.Codigo","e.Codigo")
        ->join("escuela AS es","e.IDEscuela","es.IDEscuela")
        ->select("e.*","documentos.*","es.*")
        ->get();
        return compact("documentos");
    }
    public function fechas()
    {
        $inicio = 1997;
        $final  = (int) date("Y");
        $anios = array();
        for ($i=$inicio; $i <= $final ; $i++) { 
            $anios[$i] = $i;
        }
        return compact("anios");
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
    public function oficio($id)
    {
        
        $expeditosb =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
                        ->join("sesion AS s","expedito.NumSesion","s.NumSesion")
                        ->join("escuela AS esc","e.IDEscuela","esc.IDEscuela")
                        ->select("expedito.*","s.*","e.Paterno as Paterno","e.Materno as Materno", "e.Nombre","esc.Escuela")
                        ->where("expedito.IDExpedito",$id)->get();
        
        $decanitos = Decano::join("docentes AS d","decano.CodDocente","d.DNI")
                        ->select(\DB::raw("concat_ws(' ',d.Nombres,d.Apellidos) as Nombre"))
                        ->where("decano.Estado","ACTIVO")
                        ->get();

        $comisiones =   Comision::join("docentes AS d","comision.Presidente","d.DNI")
                        ->select(\DB::raw("concat_ws(' ',d.Nombres,d.Apellidos) as Presidente"))
                        ->where("comision.Estado","ACTIVO")
                        ->get(); 

        $dato = $expeditosb[0];
        $dato2 = $decanitos[0];
        $dato3 = $comisiones[0];
        $anio = substr($dato->Fecha,0,4);
        $mes  = $this->mes(substr($dato->Fecha,5,2));
        $mes2  = substr($dato->Fecha,5,2) ;
        $dia  = substr($dato->Fecha,8,2);
        $pdf = PDF::loadView('templates.oficio',compact("dato3","dato2","dato","anio","mes","mes2","dia"));
        return $pdf->stream('oficio.pdf');
    }

    public function oficio2($id)
    {
        $expeditosb =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
                        ->join("sesion AS s","expedito.NumSesion","s.NumSesion")
                        ->join("escuela AS esc","e.IDEscuela","esc.IDEscuela")
                        ->join("titulacion AS t","expedito.CodigoAlumno","t.CodAlumno")
                        ->join("modalidad AS m","t.IDModalidad","m.IDModalidad")
                        ->select("expedito.*","m.Modalidad","s.*","e.Paterno as Paterno","e.Materno as Materno", "e.Nombre","esc.Escuela")
                        ->where("expedito.IDExpedito",$id)->get();

        $decanitos = Decano::join("docentes AS d","decano.CodDocente","d.DNI")
                        ->select(\DB::raw("concat_ws(' ',d.Nombres,d.Apellidos) as Nombre"))
                        ->where("decano.Estado","ACTIVO")
                        ->get();

        $comisiones =   Comision::join("docentes AS d","comision.Presidente","d.DNI")
                        ->select(\DB::raw("concat_ws(' ',d.Nombres,d.Apellidos) as Presidente"))
                        ->where("comision.Estado","ACTIVO")
                        ->get(); 
                
        $dato = $expeditosb[0];
        $dato2 = $decanitos[0];
        $dato3 = $comisiones[0];
        $anio = substr($dato->Fecha,0,4);
        $mes  = $this->mes(substr($dato->Fecha,5,2)) ;
        $mes2  = substr($dato->Fecha,5,2) ;
        $dia  = substr($dato->Fecha,8,2);
        $pdf = PDF::loadView('templates.oficio2',compact("dato3","dato2","dato","anio","mes","mes2","dia"));
        return $pdf->stream('oficio.pdf');
    }

    public function mes($indice)
    {
        $meses["01"]   = "enero";
        $meses["02"]   = "febrero"; 
        $meses["03"]   = "marzo"; 
        $meses["04"]   = "abril"; 
        $meses["05"]   = "mayo"; 
        $meses["06"]   = "junio"; 
        $meses["07"]   = "julio"; 
        $meses["08"]   = "agosto"; 
        $meses["09"]   = "setiembre"; 
        $meses["10"]  = "octubre"; 
        $meses["11"]  = "noviembre"; 
        $meses["12"]  = "diciembre";
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
        $hoy = date("Y-m-d");
        $documento = new Documentos();
        $documento->TipoDocumento   = $request->documentos["tipo"];
        $documento->Numero          = $request->documentos["num"];
        $documento->Codigo          = $request->documentos["alumno"];
        $documento->Fecha           = $request->documentos["fecha"];
        $documento->Sesion          = $request->documentos["sesion"];
        $documento->Tomo            = $request->documentos["tomo"];
        $documento->Folio           = $request->documentos["folio"];
        $documento->Asiento         = $request->documentos["asiento"];
        $documento->created_at      = $hoy;
        $documento->save();
        return "OK";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function reportBachiller($inicio,$final,$carrera)
    {
        $expeditos =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
                        ->join("sesion AS s","expedito.NumSesion","s.NumSesion")
                        //->join("titulacion AS t","expedito.CodigoAlumno","t.CodAlumno")
                        ->select("expedito.*","s.*","e.Paterno as Paterno","e.Materno as Materno", "e.Nombre")
                        ->where([
                            ["expedito.Tipo","BACHILLER"],
                            ["expedito.FechaIngreso",">=",$inicio],
                            ["expedito.FechaIngreso","<=",$final],
                            ["e.IDEscuela",$carrera],
                            ["expedito.Estado",3]
                            ])->get();
        $pdf = PDF::loadView('templates.expeditob',compact("expeditos"));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('reporte.pdf');
        // return view("templates.expeditob");
    }
    public function reportTitulo($inicio,$final,$carrera)
    {
        $expeditos =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
                        ->join("sesion AS s","expedito.NumSesion","s.NumSesion")
                        ->join("titulacion AS t","expedito.CodigoAlumno","t.CodAlumno")
                        ->select("expedito.*","s.*","e.Paterno as Paterno","e.Materno as Materno", "e.Nombre")
                        ->where([
                            ["expedito.Tipo","TITULO"],
                            ["expedito.FechaIngreso",">=",$inicio],
                            ["expedito.FechaIngreso","<=",$final],
                            ["e.IDEscuela",$carrera],
                            ["expedito.Estado",3]
                            ])->get();
        $pdf = PDF::loadView('templates.expeditot',compact("expeditos"));
        $pdf->setPaper('A4','landscape');
        return $pdf->stream('reporte.pdf');
        // return view("templates.expeditob");
    }
    public function reportBachillerg($inicio,$final)
    {
        // $num        = array();
            $sistemas =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
                                ->where([
                                ["expedito.Tipo","BACHILLER"],
                                ["expedito.FechaIngreso",">=",$inicio],
                                ["expedito.FechaIngreso","<=",$final],
                                ["e.IDEscuela",1],
                                ["expedito.Estado",3],
                            ])->get()->count();
        $civil =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
                            ->where([
                            ["expedito.Tipo","BACHILLER"],
                            ["expedito.FechaIngreso",">=",$inicio],
                            ["expedito.FechaIngreso","<=",$final],
                            ["e.IDEscuela",2],
                            ["expedito.Estado",3]
                            ])->get()->count();                    
        $nsistemas  = isset($sistemas) ? $sistemas : 0;                    
        $ncivil     = isset($civil) ? $civil : 0;                    
        $num[0]     = $nsistemas;    
        $num[1]     = $ncivil;    
        return compact('num');
        // return view("templates.expeditob");
    }
    public function reportTitulog($inicio,$final)
    {
        // $num        = array();
        $sistemas =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
                            ->where([
                            ["expedito.Tipo","TITULO"],
                            ["expedito.FechaIngreso",">=",$inicio],
                            ["expedito.FechaIngreso","<=",$final],
                            ["e.IDEscuela",1],
                            ["expedito.Estado",3]
                            ])->get()->count();
        $civil =   Expeditob::join("egresado AS e","expedito.CodigoAlumno","e.Codigo")
                            ->where([
                            ["expedito.Tipo","TITULO"],
                            ["expedito.FechaIngreso",">=",$inicio],
                            ["expedito.FechaIngreso","<=",$final],
                            ["e.IDEscuela",2],
                            ["expedito.Estado",3]
                            ])->get()->count();                    
        $nsistemas  = isset($sistemas) ? $sistemas : 0;                    
        $ncivil     = isset($civil) ? $civil : 0;                    
        $num[0]     = $nsistemas;    
        $num[1]     = $ncivil;    
        return compact('num');
        // return view("templates.expeditob");
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function edit(documentos $documentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, documentos $documentos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\documentos  $documentos
     * @return \Illuminate\Http\Response
     */
    public function directorio($url)
    {
        $carpetas = scandir(public_path()."/Archivos"."/$url");
        return compact("carpetas");
        // $dirs = array(public_path()."/Archivos/$url");
        // $carpetas = documentos::scan($dirs, "pdf");
        // return compact("carpetas");
    }

    public function sendMail(Request $request)
    {
        $to         = $request->correo["to"];
        $subject    = $request->correo["subject"];
        $attach     = $request->adjuntos;
        $mensaje    = $request->correo["mensaje"];
        // dd($attach);
        // \Mail::to("aldairmonrroy@hotmail.com")->send(new GradosyTitulos());
        \Mail::to("$to")->send(new GradosyTitulos($subject,$attach,$mensaje));
        return "ok";
    }
    public function informe()
    {
        $pdf = PDF::loadView('templates.informe');
        file_put_contents('guardadasalvaje.pdf', $pdf->output());
     
    }
    public function memo()
    {
        $pdf = PDF::loadView('templates.memoProyecto');
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('reporte.pdf');
    }
    public function oficioProyecto()
    {
        $pdf = PDF::loadView('templates.oficioProyecto');
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('reporte.pdf');
    }

    public function informeTesista()
    {
        $pdf = PDF::loadView('templates.informeTesista');
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('reporte.pdf');
    }

    public function memoAsesor()
    {
        $pdf = PDF::loadView('templates.memoAsesor');
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('reporte.pdf');
    }

    public function oficioAsesor()
    {
        $pdf = PDF::loadView('templates.oficioAsesor');
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('reporte.pdf');
    }

    public function oficioConformidad()
    {
        $pdf = PDF::loadView('templates.oficioConformidad');
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('reporte.pdf');
    }
}
