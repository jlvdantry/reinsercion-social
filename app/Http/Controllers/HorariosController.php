<?php

namespace App\Http\Controllers;

use App\horarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
           array_push($filtro,['desactividad', 'like',"%$request->descripcion%"]);
        }
      }

      if ($request->has('estatus')) {
        if (strlen($request->idperfil)!='') {
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
