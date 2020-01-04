<?php

namespace App\Http\Controllers;

use App\demandas;
use App\tipodemandas;
use Illuminate\Http\Request;

class DemandasController extends Controller
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

    /**
     * Display the specified resource.
     *
     * @param  \App\demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function show(demandas $demandas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function edit(demandas $demandas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, demandas $demandas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\demandas  $demandas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
               $inmu=demandas::where('id','=',$id)->get();
               if ($inmu->count()>0) {
                       $inmu[0]->delete();
                       $td = new tipodemandas();
                       $falta=$td->gettipodemandasfaltantes($inmu[0]["idexpediente"]);
                       return response()->json([ 'data' => ['id' => 'La demanda fue borrada'], 'tipodemandas' => $falta ],200);
               } else {
                   return response()->json([ 'data' => ['id' => 'el ID de expediente no existe']],401);
               }
    }
}
