<?php

namespace App\Http\Controllers;

use App\sesion;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sesiones = Sesion::select("sesion.*",\DB::raw("date_format(Fecha,'%d-%m-%Y') AS FechaAux"))->get();
        return compact("sesiones");
        /**$sesiones = Sesion::all();
        return compact("sesiones");**/
    }
    public function sessions()
    {
        $sesiones = Sesion::select("NumSesion")->orderBy("NumSesion","DESC")->get();
        return compact("sesiones");
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
        $sesion = new Sesion();
        $sesion->NumSesion  = $request->sesion["sesion"];
        $sesion->Fecha      = $request->sesion["fecha"];
        $sesion->Tipo       = $request->sesion["tipo"];
        $sesion->save();
        $type   = "success";
        $title  = "¡Buen trabajo!";
        $text   = "Sesión creada con éxito";
        return compact("type","title","text");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function show($num)
    {
        $objSesion  = Sesion::select("Fecha","Tipo")->where("NumSesion",$num)->get();
        $fecha  = "";
        $tipo   = "";
        if(count($objSesion) > 0)
        {
            $val = true;
            $fecha = $objSesion[0]->Fecha;
            $tipo = $objSesion[0]->Tipo;
        }
        else $val = false;
        
        return compact("val","fecha","tipo");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function edit(sesion $sesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sesion = Sesion::where("IDSesion",$request->sesion["idsesion"])->update([
            "NumSesion"  => $request->sesion["sesion"],
            "Fecha"  => $request->sesion["fecha"],
            "Tipo"  => $request->sesion["tipo"],
        ]);

        if($sesion)
        {
            $type   = "success";
            $title  = "¡Buen trabajo!";
            $text   = "Sesión guardada con éxito";
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
     * @param  \App\sesion  $sesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(sesion $sesion)
    {
        //
    }
}
