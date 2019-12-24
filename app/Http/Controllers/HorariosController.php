<?php

namespace App\Http\Controllers;

use App\horarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use DateTime;

class HorariosController extends Controller
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
        if (strlen($request->descripcion)>0) {
           array_push($filtro,['acti.descripcion', 'like',"%$request->descripcion%"]);
        }
      }

      if ($request->has('estatus')) {
        if (strlen($request->estatus)!='') {
           array_push($filtro,['estatus', '=',$request->estatus]);
        }
      }

      $datos = horarios::getconCatalogos($filtro);
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

      if ($request->get('sesiones')=="") { 
                   return response()->json([ 'errors' => ['sesiones' => 'Debe de seleccionar la cantidad de sesiones ']],403);
      }
      if ($request->get('horahasta')<$request->get('horade')) { 
                   return response()->json([ 'errors' => ['horahasta' => 'El horario registrado esta erroneo']],403);
      }

      $datos = 
         [  
                 'idgrupo' => $request->get('idgrupo') ,
                 'idactividad' => $request->get('idactividad') ,
                 'grupo' => $request->get('grupo') ,
                 'horade' => $request->get('horade') ,
                 'horahasta' => $request->get('horahasta') ,
                 'idtallerista' => $request->get('idtallerista') ,
                 'cupo' => $request->get('cupo') ,
                 'sesiones' => $request->get('sesiones') ,
                 'calle_h' => $request->get('calle_h') ,
                 'exterior_h' => $request->get('exterior_h') ,
                 'interior_h' => $request->get('interior_h') ,
                 'colonia_h' => $request->get('colonia_h') ,
                 'id_alcaldia_h' => $request->get('id_alcaldia_h') ,
                 'cp_h' => $request->get('cp_h') ,
                 'estatus' => $request->get('estatus')
         ];

        if ($request->get('fecha01')!="") { $datos['fecha01']=$request->get('fecha01'); }
        if ($request->get('fecha02')!="") { $datos['fecha02']=$request->get('fecha02'); }
        if ($request->get('fecha03')!="") { $datos['fecha03']=$request->get('fecha03'); }
        if ($request->get('fecha04')!="") { $datos['fecha04']=$request->get('fecha04'); }
        if ($request->get('fecha05')!="") { $datos['fecha05']=$request->get('fecha05'); }
        if ($request->get('fecha06')!="") { $datos['fecha06']=$request->get('fecha06'); }
        if ($request->get('fecha07')!="") { $datos['fecha07']=$request->get('fecha07'); }
        if ($request->get('fecha08')!="") { $datos['fecha08']=$request->get('fecha08'); }
        if ($request->get('fecha09')!="") { $datos['fecha09']=$request->get('fecha09'); }
        if ($request->get('fecha10')!="") { $datos['fecha10']=$request->get('fecha10'); }

        for ($i = 1; $i <= $request->get('sesiones'); $i++) {
            $quefecha='fecha'.str_pad($i,2,'0',STR_PAD_LEFT);
            if ($request->get($quefecha)=='') {
                   return response()->json([ 'errors' => [$quefecha => 'la fecha '.$i.' no ha sido tecleada']],403);
            }
            if ($quefecha=="fecha01") {
                      $datetime1 = date("y-m-d", strtotime("today"));
                      $datetime2 = new DateTime($request->get($quefecha));
                      Log::debug('HorariosControlle fecha1='.print_r($datetime1,true).' fecha2='.print_r($datetime2,true));
                      if ($datetime2 < $datetime1) {
                         return response()->json([ 'errors' => [$quefecha => 'La fecha '.$i.' debe ser igual o mayor al dia de hoy']],430);
                      }
           } else {
                      $quefechaant='fecha'.str_pad($i-1,2,'0',STR_PAD_LEFT);
                      $datetime1 = new DateTime($request->get($quefechaant));
                      $datetime2 = new DateTime($request->get($quefecha));
                      Log::debug('HorariosControlle fecha1='.print_r($datetime1,true).' fecha2='.print_r($datetime2,true));
                      if ($datetime2 < $datetime1) {
                         return response()->json([ 'errors' => [$quefecha => 'La fecha '.$i.' debe ser igual o mayor que la fecha '.($i-1)]],430);
                      }
           }
        }


        $dato = new horarios($datos);

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
     * @param  \App\horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function show(horarios $horarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function edit(horarios $horarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, horarios $horarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\horarios  $horarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
               $inmu=horarios::where('id','=',$id)->get();
               if ($inmu->count()>0) {
                       $inmu[0]->delete();
                       return response()->json([ 'data' => ['id' => 'El horario fue borrado']],200);
               } else {
                   return response()->json([ 'data' => ['id' => 'el ID de horario no existe']],401);
               }

    }
}
