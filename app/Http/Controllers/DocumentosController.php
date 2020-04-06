<?php

namespace App\Http\Controllers;

use App\documentos;
use App\expeditob;
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
                        ->select("expedito.*","s.*",\DB::raw("concat(e.Paterno,' ',e.Materno) as Apellido"),\DB::raw("concat(upper(left(e.Nombre, 1)), lower(substring(e.Nombre, 2))) as Nombre"),"esc.Escuela")
                        ->where("expedito.IDExpedito",$id)->get();
        // $datos = Documentos::join("egresado AS e","documentos.Codigo","e.Codigo")                      CONCAT(UPPER(LEFT(, 1)), LOWER(SUBSTRING(, 2))) ----- \DB::raw("ucwords(e.Nombre,' ') as Nombre")
        // ->join("escuela AS es","e.IDEscuela","es.IDEscuela")
        // ->select("e.*","documentos.*","es.*")
        // ->where("IDDocumento",$id)->get();
        $dato = $expeditosb[0];
        $anio = substr($dato->Fecha,0,4);
        $mes  = $this->mes(substr($dato->Fecha,5,2)) ;
        $dia  = substr($dato->Fecha,8,2);
        $pdf = PDF::loadView('templates.oficio',compact("dato","anio","mes","dia"));
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
    public function show(documentos $documentos)
    {
        //
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
    public function destroy(documentos $documentos)
    {
        //
    }
}
