<?php

namespace App\Http\Controllers;

use App\escuelas;
use Illuminate\Http\Request;

class EscuelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escuelas = Escuelas::select("*")->get();
        return compact("escuelas");
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function show(escuelas $escuelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function edit(escuelas $escuelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, escuelas $escuelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\escuelas  $escuelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(escuelas $escuelas)
    {
        //
    }
}
