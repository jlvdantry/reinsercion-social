<?php

namespace App\Http\Controllers;

use App\tiposituaciones;
use Illuminate\Http\Request;

class TiposituacionesController extends Controller
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
        //
    }


    public function indexporsituacion($id)
    {
       $datos = tiposituaciones::getTiposituacionesporsituacion($id);
       return response()->json($datos);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\tiposituaciones  $tiposituaciones
     * @return \Illuminate\Http\Response
     */
    public function show(tiposituaciones $tiposituaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tiposituaciones  $tiposituaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(tiposituaciones $tiposituaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tiposituaciones  $tiposituaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tiposituaciones $tiposituaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tiposituaciones  $tiposituaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(tiposituaciones $tiposituaciones)
    {
        //
    }
}
