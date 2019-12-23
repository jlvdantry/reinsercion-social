<?php

namespace App\Http\Controllers;

use App\actividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ActividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $filtro=array();
      if ($request->has('descripcion')) {
        Log::debug('ActividadesController index tiene descripcion');
        if (strlen($request->descripcion)>0) {
           array_push($filtro,['descripcion', 'like',"%$request->descripcion%"]);
        }
      }
      Log::debug('ActividadesController index filtro='.print_r($filtro,true));
      $datos = actividades::select('*',DB::Raw(
                                      'coalesce((select descripcion from grupo_actividades ga where ga.id=actividades.idgrupo),\'\')  desgrupo '
                      ))->where($filtro)->orderby('id','DESC')->get();
      return response()->json($datos);

    }

    public function indexporgrupo($id)
    {
       $datos = actividades::getActividadesporgrupo($id);
       return response()->json($datos);
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
      Log::debug('ActividadesControlle store request=');
      if ($request->get('descripcion')=="") {
                return response()->json([ 'errors' => ['descripcion' => 'Falta teclear el nombre de la actividad']],428);
      }
      if ($request->get('idgrupo')=="" || $request->get('idgrupo')=="0") {
                return response()->json([ 'errors' => ['idgrupo' => 'No se ha seleccionado un grupo de actividades']],428);
      }

      $inmu=actividades::where(     ['descripcion' => $request->descripcion]
                          )->get();
      if ($inmu->count()>0) {
            return response()->json([ 'errors' => ['descripcion' => 'Ya existe una actividad con el nombre <b>'.$request->descripcion]],429);
      }

      $dato = new actividades(
         [ 'descripcion' => $request->get('descripcion'),
           'idgrupo' => $request->get('idgrupo') ]
         );
        try {
            $dato->save();
            return response()->json($dato,200);
        } catch (\Exception $e) {
            Log::debug('ActividadesController storage='.$e->getMessage());
            return response()->json($e->getMessage(),400);
        };

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function show(actividades $actividades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function edit(actividades $actividades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, actividades $actividades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
               $inmu=actividades::where('id','=',$id)->get();
               if ($inmu->count()>0) {
                       $inmu[0]->delete();
                       return response()->json([ 'data' => ['id' => 'La actividad fue borrado']],200);
               } else {
                   return response()->json([ 'data' => ['id' => 'el ID de la actividad no existe']],401);
               }

    }
}
