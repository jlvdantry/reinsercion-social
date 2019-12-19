<?php

namespace App\Http\Controllers;

use App\grupo_actividades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GrupoActividadesController extends Controller
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
        Log::debug('GrupoActividadesControlle index tiene descripcion');
        if (strlen($request->descripcion)>0) {
           array_push($filtro,['descripcion', 'like',"%$request->descripcion%"]);
        }
      }
      Log::debug('GrupoActividadesControlle index filtro='.print_r($filtro,true));
      $datos = grupo_actividades::select('*')->where($filtro)->orderby('id','DESC')->get();
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
      Log::debug('GrupoActividadesControlle store request=');
      if (!$request->has('descripcion')) {
                return response()->json([ 'errors' => ['descripcion' => 'Debe de teclear la descripción ']],428);
      }

      $inmu=grupo_actividades::where(     ['descripcion' => $request->descripcion]
                          )->get();
      if ($inmu->count()>0) {
            return response()->json([ 'errors' => ['descripcion' => 'Ya existe un grupo con el nombre <b>'.$request->descripcion]],429);
      }

      $dato = new grupo_actividades(
         [ 'descripcion' => $request->get('descripcion') ]
         );
        try {
            $dato->save();
            return response()->json($dato,200);
        } catch (\Exception $e) {
            Log::debug('BoletasControler storage='.$e->getMessage());
            return response()->json($e->getMessage(),400);
        };

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\grupo_actividades  $grupo_actividades
     * @return \Illuminate\Http\Response
     */
    public function show(grupo_actividades $grupo_actividades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\grupo_actividades  $grupo_actividades
     * @return \Illuminate\Http\Response
     */
    public function edit(grupo_actividades $grupo_actividades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\grupo_actividades  $grupo_actividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, grupo_actividades $grupo_actividades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\grupo_actividades  $grupo_actividades
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
               $inmu=grupo_actividades::where('id','=',$id)->get();
               if ($inmu->count()>0) {
                       $inmu[0]->delete();
                       return response()->json([ 'data' => ['id' => 'el grupo de actividades fue borrado']],200);
               } else {
                   return response()->json([ 'data' => ['id' => 'el ID del grupo de actividades no existe']],200);
               }
    }
}
