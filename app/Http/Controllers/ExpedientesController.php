<?php

namespace App\Http\Controllers;

use App\expedientes;
use App\demandas;
use App\tipodemandas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpedientesController extends Controller
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
      //Log::debug('ExpedientesController store request='.print_r($request,true));
      if (!$request->has('carnet')) {
                return response()->json([ 'errors' => ['carnet' => 'Debe de teclear primer el número de carnet ']],428);
      }

      $inmu=expedientes::where(     ['carnet' => $request->carnet])->get();
      if ($inmu->count()>0) {
            return response()->json([ 'errors' => ['carnet' => 'Ya existe un carnet con el numero <b>'.$request->carnet, 'seccion' => 'expediente']],429);
      }

      if (!$request->has('idbeneficiario')) {
                return response()->json([ 'errors' => ['carnet' => 'No esta identificado el beneficiario']],428);
      }

      $dato = new expedientes(
         [
        'carnet' => $request->get('carnet'),
        'idbeneficiario' => $request->get('idbeneficiario'),
        'created_at' => \Auth::user()->id
      ]
         );
        try {
            $dato->save();
            //return $this->update($request,$dato['id']);  /* despues de queda de alta el inmueble dentro del rfc lo actualiza */
            return response()->json($dato,200);
        } catch (\Exception $e) {
            Log::debug('ExpedientesController error'.$e->getMessage());
            return response()->json($e->getMessage(),400);
        };

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\expedientes  $expedientes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $datos = expedientes::getExpedientescatalogos($id);
       $de = new demandas();
       $falta=$de->getdemandasbyexpediente($datos[0]->id);
       if (count($falta)>0) {
          $datos[0]->demandas=$falta;
       }
       $td = new tipodemandas();
       $falta=$td->gettipodemandasfaltantes($datos[0]->id);
       if (count($falta)>0) {
          $datos[0]->tipodemandas=$falta;
       }

       return response()->json($datos);
    }


    public function indexporusuario($id)
    {
       $datos = expedientes::getExpedientesporusuario($id);
       return response()->json($datos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expedientes  $expedientes
     * @return \Illuminate\Http\Response
     */
    public function edit(expedientes $expedientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\expedientes  $expedientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $data = array();
      $inmu=expedientes::where('id','=',$id)->get();
      if ($inmu->count()==0) {
            return response()->json([ 'errors' => ['carnet' => 'La identificación del expdiente no existe']],429);
      }
      if ($request->has('estatus')) {
         if ($request->estatus==1) {
             Log::debug('ExpedientesController inmu tienacta'.print_r($inmu[0]['tieneacta'],true));
             if ($inmu[0]['idsituacionjuridica']=="") {
                      return response()->json([ 'errors' => ['idsituacionjuridica' => 'Falta seleccionar la situación juridica', 'seccion' => 'primercontacto']],430);
             }
             if ($inmu[0]['idtipodesituacion']=="") {
                      return response()->json([ 'errors' => ['idtipodesituacion' => 'Falta seleccionar el tipo de situación', 'seccion' => 'primercontacto']],430);
             }
             if ($inmu[0]['delito']=="") {
                      return response()->json([ 'errors' => ['delito' => 'Falta escribir el delito', 'seccion' => 'primercontacto']],430);
             }
             if ($inmu[0]['proceso']=="") {
                      return response()->json([ 'errors' => ['proceso' => 'Falta escribir el número de proceso', 'seccion' => 'primercontacto']],430);
             }
             if ($inmu[0]['sentencia']=="") {
                      return response()->json([ 'errors' => ['sentencia' => 'Falta escribir la sentencia', 'seccion' => 'primercontacto']],430);
             }
             if ($inmu[0]['idcentro']=="") {
                      return response()->json([ 'errors' => ['idcentro' => 'Falta seleccionar el centro o comunidad privativa de la libertad de egreso'
                                                            , 'seccion' => 'primercontacto']],430);
             }
             if ($inmu[0]['egreso']=="") {
                      return response()->json([ 'errors' => ['egreso' => 'Falta escribir la Fecha de egreso del sistema de justicia penal'
                                                            , 'seccion' => 'primercontacto']],430);
             }
             if (
                   ($inmu[0]['sustanciasalcohol']=="" || $inmu[0]['sustanciasalcohol']=="0") && ($inmu[0]['relacionales']=="" || $inmu[0]['relacionales']=="0")
                && ($inmu[0]['enfermedades']=="" || $inmu[0]['enfermedades']=="0") && ($inmu[0]['laboral']=="" || $inmu[0]['laboral']=="0")
                && ($inmu[0]['psiquiatricos']=="" || $inmu[0]['psiquiatricos']=="0") && ($inmu[0]['violencia']=="" || $inmu[0]['violencia']=="0")
                && ($inmu[0]['educativo']=="" || $inmu[0]['educativo']=="0") && ($inmu[0]['derivacion']=="" || $inmu[0]['derivacion']=="0")
                && ($inmu[0]['conductuales']=="" || $inmu[0]['conductuales']=="0") && ($inmu[0]['pobreza']=="" || $inmu[0]['pobreza']=="0")
                && ($inmu[0]['capacitacion']=="" || $inmu[0]['capacitacion']=="0") && ($inmu[0]['otras']=="" )
                ) {
                      return response()->json([ 'errors' => ['sustanciasalcohol' => 'Al menos debe seleccionar una situación que origina el contacto'
                                                            , 'seccion' => 'primercontacto']],430);
             }
             if (
                   ($inmu[0]['ap_mujeres']=="" || $inmu[0]['ap_mujeres']=="0") && ($inmu[0]['ap_personaindigena']=="" || $inmu[0]['ap_personaindigena']=="0")
                && ($inmu[0]['ap_personavih']=="" || $inmu[0]['ap_personavih']=="0") && ($inmu[0]['ap_lgbttti']=="" || $inmu[0]['ap_lgbttti']=="0")
                && ($inmu[0]['ap_situacioncalle']=="" || $inmu[0]['ap_situacioncalle']=="0") && ($inmu[0]['ap_personamayor']=="" || $inmu[0]['ap_personamayor']=="0")
                && ($inmu[0]['ap_personadisca']=="" || $inmu[0]['ap_personadisca']=="0") && ($inmu[0]['ap_ninguno']=="" || $inmu[0]['ap_ninguno']=="0")
                && ($inmu[0]['ap_migrante']=="" || $inmu[0]['ap_migrante']=="0") 
                ) {
                      return response()->json([ 'errors' => ['ap_mujeres' => 'Al menos debe seleccionar una opción de atención prioritaria'
                                                            , 'seccion' => 'primercontacto']],430);
             }
             if (is_null($inmu[0]['tieneacta'])) {
                      return response()->json([ 'errors' => ['tieneactasi' => 'Falta indicar si tiene acta de nacimiento'
                                                            , 'seccion' => 'primercontacto']],430);
             }
             if (is_null($inmu[0]['tieneid'])) {
                      return response()->json([ 'errors' => ['tieneidsi' => 'Falta indicar si tiene identificación oficial'
                                                            , 'seccion' => 'primercontacto']],430);
             }
             if (is_null($inmu[0]['tienecurp'])) {
                      return response()->json([ 'errors' => ['tienecurpsi' => 'Falta indica si tiene CURP'
                                                            , 'seccion' => 'primercontacto']],430);
             }
             $de = new demandas();
             $falta=$de->getdemandasbyexpediente($inmu[0]['id']);
             if (count($falta)<1) {
                          return response()->json([ 'errors' => ['iddemanda' => "Por lo menos se debe de registrar una demanda"
                                                            , 'seccion' => 'demandas']],430);
             }
         }
      }

      if ($request->has('demandas')) {
          if ($request->de_sedacita=='' && $request->de_canalizacion=='' && $request->de_sedainformacion=='' 
              && $request->de_escucha=='' && $request->de_consejo=='' && $request->de_otro=='') {
              return response()->json([ 'errors' => ['de_sedacita' => "Por lo menos se debe de eligir un tipo de respuesta"]],430);
          }
          $quef='0';
          $dato = new demandas ( [
          'idexpediente'=>$id,
          'iddemanda'=>$request->iddemanda,
          'idresultado'=>$request->idresultado,
          'resultado'=>$request->resultado,
          'de_sedacita'=> $request->de_sedacita,
          'de_canalizacion'=> $request->de_canalizacion,
          'de_sedainformacion'=> $request->de_sedainformacion,
          'de_escucha'=> $request->de_escucha,
          'de_consejo'=> $request->de_consejo,
          'de_otro'=> $request->de_otro,
          ]);
          try {
            $dato->save();
            $demandas=array($dato->getdemandabyid($dato["id"]));
            $td = new tipodemandas();
            $falta=$td->gettipodemandasfaltantes($dato["idexpediente"]);
            if (count($falta)>0) {
               $demandas["tipodemandas"]=$falta;
            }
            //Log::debug('ExpedientesControlle despues de grabar una demanda='.print_r($dato["id"],true));
            return response()->json($demandas,200);
          } catch (\Exception $e) {
            Log::debug('InmueblesControler storage='.$e->getMessage());
            return response()->json($e->getMessage(),400);
          };
      }


      Log::debug('BoletasControler '.print_r($request->all(),true));
      //$data['updatedby']=\Auth::user()->id;
      $dato = $inmu[0]->update($request->all());
      $dato = $inmu[0]->update($data);
      Log::debug('ExpedientesController Despues de realizar el update='.print_r($dato,true)." tipo de inmu=".gettype($inmu[0]));
      if ($dato==0) {
          return response()->json([ 'errors' => ['cambio' => 'Hubo problemas al actualizar el inmueble']],430);
      } else {
          return response()->json($inmu[0],200);
      }


        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expedientes  $expedientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
               $inmu=expedientes::where('id','=',$id)->get();
               if ($inmu->count()>0) {
                       $inmu[0]->delete();
                       return response()->json([ 'data' => ['id' => 'El expediente fue borrado']],200);
               } else {
                   return response()->json([ 'data' => ['id' => 'el ID de expediente no existe']],401);
               }

    }
}
