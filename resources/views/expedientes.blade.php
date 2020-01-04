@extends('layouts.layout')
@section('content')

  <main id="expedientes">
    <section class="container ">
      <div class="row d-flex justify-content-between align-items-center seccion" >
           <div class="col-lg-3 Nuevo-expediente"></span> <span id="des_expediente" data-id="">Nuevo expediente</span></div>
                    <div class="col-lg-6 d-flex justify-content-end   pl-0 pr-0 -Datos-Generales-  flex-wrap">
                      <div class="pl-1 border-bottom border-success" id="primercontacto" name="opciones" data-href="c_primercontacto" >Primer contacto</div>
                      <div class="pl-1 border-bottom border-success" id="demandas" name="opciones" data-href="c_demandas" >| Demandas</div>
                      <div class="pl-1 border-bottom border-success" id="diagnostica" name="opciones" data-href="c_diagnostica" >| Entrevista diagnóstica</div>
                      <div class="pl-1 border-bottom border-success" id="agenta" name="opciones" data-href="c_agent" >| Agenda</div>
                    </div>

      </div>
    <div id='Primercontacto'>
      <div class="flex-nowrap row col-md-12 d-flex justify-content-between pr-0 mr-0">
                    <div class="row col-lg-5 d-flex justify-content-start pr-0 -Datos-Generales-">
                         <div class="nombredelbeneficiario" data-id={{ $data['beneficiario']->id }} >{{ $data['beneficiario']->nombrecompleto }} </div>
                    </div>
      </div>
      <div class="row col-lg-12 campos-obligatorios d-flex justify-content-start">Los campos marcados con asterisco son obligatorios</div>
      <div id="c_primercontacto" name="tabi" class="d-none">
          <form id="f_expediente" data-id=''>
             <div class="Lugar-de-imparticin mt-2 mb-2">Datos generales</div>
             <div class="row col-md-12">
                  <div class="col-md-4 pl-0">
                    <label class="form-label-custom" for="carnet">*Número de carnet:</label>
                    <input type="text" name="carnet" id="carnet" class="form-control form-control-custom street-names" maxlength="20" value="" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
             </div>

             <div class="row col-md-12">
               <div class="col-md-3 mb-3 pl-0">
                  <label class="form-label-custom" for="idsituacionjuridica">*Situación juridica:</label>
                  <select class="form-control form-control-custom" id="idsituacionjuridica" name="idsituacionjuridica" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['situacionesjuridicas'] as $situacion)
                          <option value="{{ $situacion->id }}">{{ $situacion->descripcion }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Selecciona una opción
                  </div>
               </div>
               <div class="col-md-3 mb-3">
                  <label class="form-label-custom" for="idtipodesituacion">*Tipo situación:</label>
                  <select class="form-control form-control-custom" id="idtipodesituacion" name="idtipodesituacion" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['tiposituaciones'] as $tipo)
                          <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Selecciona una opción
                  </div>
               </div>
                  <div class="col-md-3 pl-0">
                    <label class="form-label-custom" for="delito">*Delito:</label>
                    <input type="text" name="delito" id="delito" class="form-control form-control-custom street-names" placeholder="Escribe el delito" maxlength="20" value="" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-3 pl-0">
                    <label class="form-label-custom" for="proceso">*Número de proceso:</label>
                    <input type="text" name="proceso" id="proceso" class="form-control form-control-custom street-names"  placeholder="Escribe el número de proceso" maxlength="20" value="" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
             </div>

             <div class="row col-md-12">
                  <div class="col-md-4 pl-0">
                    <label class="form-label-custom" for="delito">*Sentencia:</label>
                    <input type="text" name="sentencia" id="sentencia" class="form-control form-control-custom street-names" placeholder="Escribe la sentencia" maxlength="30" value="" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
               <div class="col-md-8 mb-3">
                  <label class="form-label-custom" for="idcentro">*Centro o comunidad privativa de la libertad de egreso:</label>
                  <select class="form-control form-control-custom" id="idcentro" name="idcentro" required>
                      <option value="" selected >Selecciona</option>
                      @foreach ($data['centros'] as $centro)
                          <option value="{{ $centro->id }}">{{ $centro->descripcion }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Selecciona una opción
                  </div>
               </div>
             </div>

             <div class="row col-md-12">
                  <div class="col-md-4 pl-0">
                    <label class="form-label-custom" for="egreso">*Fecha de egreso del sistema de justicia penal:</label>
                    <input type="date" name="egreso" id="egreso" class="form-control form-control-custom street-names" maxlength="10" max="{{ date('Y-m-d') }}" value="" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
             </div>

             <div class="Lugar-de-imparticin mt-3 mb-2">Situaciones que originan el contacto</div>

             <div class="col-md-12  mb-3 d-flex align-items-center justify-content-between flex-wrap pl-1">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sustanciasalcohol" id="sustanciasalcohol" value="1" >
                <label class="form-check-label label-custom-check" for="sustanciasalcohol" id="l_sustanciasalcohol">
                                       Sustancias/alcohol 
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="relacionales" id="relacionales" value="1" >
                <label class="form-check-label label-custom-check" for="relacionales" id="l_relacionales">
                                       Relacionales
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="enfermedades" id="enfermedades" value="1" >
                <label class="form-check-label label-custom-check" for="enfermedades" id="l_enfermedades">
                                       Enfermedades
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="laboral" id="laboral" value="1" >
                <label class="form-check-label label-custom-check" for="laboral" id="l_laboral">
                                       Laboral
                </label>
               </div>
             </div>

             <div class="col-md-12  mb-3 d-flex align-items-center justify-content-between flex-wrap pl-1">
               <div class=" col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="psiquiatricos" id="psiquiatricos" value="1" >
                <label class="form-check-label label-custom-check" for="psiquiatricos" id="l_psiquiatricos">
                                       Psiquiátricos
                </label>
               </div>
               <div class=" col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="violencia" id="violencia" value="1" >
                <label class="form-check-label label-custom-check" for="violencia" id="l_violencia">
                                       Violencia
                </label>
               </div>
               <div class=" col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="educativo" id="educativo" value="1" >
                <label class="form-check-label label-custom-check" for="educativo" id="l_educativo">
                                       Educativo
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="derivacion" id="derivacion" value="1" >
                <label class="form-check-label label-custom-check" for="derivacion" id="l_derivacion">
                                       Derivación judicial
                </label>
               </div>
             </div>

             <div class="col-md-12  mb-3 d-flex align-items-center justify-content-between flex-wrap pl-1">
               <div class=" col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="conductuales" id="conductuales" value="1" >
                <label class="form-check-label label-custom-check" for="conductuales" id="l_conductuales">
                                       Conductuales
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="pobreza" id="pobreza" value="1" >
                <label class="form-check-label label-custom-check" for="pobreza" id="l_pobreza">
                                       Pobreza
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="capacitacion" id="capacitacion" value="1" >
                <label class="form-check-label label-custom-check" for="capacitacion" id="l_capacitacion">
                                       Capacitacion y formación
                </label>
               </div>
                  <div class="col-md-3 pl-0">
                    <!-- <label class="form-label-custom" for="delito">Otra:</label> -->
                    <input type="text" name="otras" id="otras" class="form-control form-control-custom street-names" maxlength="30" value="" 
                                 placeholder="Especifique otra situación" >
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

             </div>

             <div class="Lugar-de-imparticin mt-2 mb-2">Atención prioritaria</div>

             <div class="col-md-12  mb-3 d-flex align-items-center justify-content-between flex-wrap pl-1">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="ap_mujeres" id="ap_mujeres" value="1" >
                <label class="form-check-label label-custom-check" for="ap_mujeres" id="l_ap_mujeres">
                                       Mujeres
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="ap_personaindigena" id="ap_personaindigena" value="1" >
                <label class="form-check-label label-custom-check" for="relacionales" id="l_ap_personaindigena">
                                       Persona indígena
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="ap_personavih" id="ap_personavih" value="1" >
                <label class="form-check-label label-custom-check" for="ap_personavih" id="l_ap_personavih">
                                       Persona con VIH
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="ap_lgbttti" id="ap_lgbttti" value="1" >
                <label class="form-check-label label-custom-check" for="ap_lgbttti" id="l_ap_lgbttti">
                                       LGBTTTI
                </label>
               </div>
             </div>

             <div class="col-md-12  mb-3 d-flex align-items-center justify-content-between flex-wrap pl-1">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="ap_situacioncalle" id="ap_situacioncalle" value="1" >
                <label class="form-check-label label-custom-check" for="ap_situacioncalle" id="l_ap_situacioncalle">
                                       Situación de calle
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="ap_personamayor" id="ap_personamayor" value="1" >
                <label class="form-check-label label-custom-check" for="ap_personamayor" id="l_ap_personamayor">
                                       Persona adulta mayor
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="ap_personadisca" id="ap_personadisca" value="1" >
                <label class="form-check-label label-custom-check" for="ap_personadisca" id="l_ap_personadisca">
                                       Persona con discapacidad
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="ap_ninguno" id="ap_ninguno" value="1" >
                <label class="form-check-label label-custom-check" for="ap_ninguno" id="l_ap_ninguno">
                                       Ninguno
                </label>
               </div>
             </div>
             <div class="col-md-12  mb-3 d-flex align-items-center justify-content-between flex-wrap pl-1">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="ap_migrante" id="ap_migrante" value="1" >
                <label class="form-check-label label-custom-check" for="ap_migrante" id="l_ap_migrante">
                                      Migrante 
                </label>
               </div>
             </div>

             <div class="Lugar-de-imparticin mt-2 mb-2">Documentos de identidad</div>


             <div class="row col-md-12  mb-3 d-flex ">
		  <div class="col-md-3 mb-3 pl-0 pt-1" id="nom">
		   <legend class="form-label-custom">¿Cuenta con acta de nacimiento?</legend>
		   <div class="form-check-inline">
		    <input class="form-check-input ml-2" type="radio" name="tieneacta" id="tieneactasi" value="1" >
		    <label class="form-check-label label-custom-check" for="tieneactasi">
		      Si
		    </label>
		   </div>
		   <div class="form-check-inline">
		    <input class="form-check-input ml-2" type="radio" name="tieneacta" id="tieneactano" value="0" >
		    <label class="form-check-label label-custom-check" for="tieneactano">
		      No
		    </label>
		   </div>
		  </div>

                 <div class="col-md-9 pl-0" id="nom">
                     <label class="form-label-custom" for="anotaacta" >Anotaciones:</label>
                     <input type="text" class="form-control form-control-custom street-names" id="anotaacta" maxlength="100" placeholder="Escribe las anotaciones del acta de nacimiento" >
                     <div class="invalid-feedback">
                             Asegúrate de introducir la información correctamente
                    </div>
                 </div>
             </div>

             <div class="row col-md-12  mb-3 d-flex ">
                  <div class="col-md-3 mb-3 pl-0 pt-1" id="nom">
                   <legend class="form-label-custom">¿Cuenta con alguna identificación?</legend>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="tieneid" id="tieneidsi" value="1" >
                    <label class="form-check-label label-custom-check" for="tieneidsi">
                      Si
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="tieneid" id="tieneidno" value="0" >
                    <label class="form-check-label label-custom-check" for="tieneidno">
                      No
                    </label>
                   </div>
                  </div>

                 <div class="col-md-9 pl-0 pt-1" id="nom">
                     <label class="form-label-custom" for="anotaid" >Anotaciones:</label>
                     <input type="text" class="form-control form-control-custom street-names" id="anotaid" maxlength="100" placeholder="Escribe las anotaciones de la identificación oficial" >
                     <div class="invalid-feedback">
                             Asegúrate de introducir la información correctamente
                    </div>
                 </div>
             </div>

             <div class="row col-md-12  mb-3 d-flex ">
                  <div class="col-md-3 mb-3 pl-0 pt-1" id="nom">
                   <legend class="form-label-custom">¿Cuenta con CURP?</legend>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="tienecurp" id="tienecurpsi" value="1" >
                    <label class="form-check-label label-custom-check" for="tienecurpsi">
                      Si
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="tienecurp" id="tienecurpno" value="0" >
                    <label class="form-check-label label-custom-check" for="tienecurpno">
                      No
                    </label>
                   </div>
                  </div>

                 <div class="col-md-9 pl-0" id="nom">
                     <label class="form-label-custom" for="anotacurp" >Anotaciones:</label>
                     <input type="text" class="form-control form-control-custom street-names" id="anotacurp" maxlength="100" placeholder="Escribe la CURP del beneficiario" >
                     <div class="invalid-feedback">
                             Asegúrate de introducir la información correctamente
                    </div>
                 </div>
             </div>
             <div class="row col-md-12 d-flex justify-content-end">
                  <div class="btn-01" name="button" id="crear-expediente" >Crear expediente</div>
             </div>

         </form>
      </div>

      <div id="c_demandas" name="tabi" class="d-none">
          <form id="f_demandas" data-id=''>
             <div class="row col-md-12">
               <div class="col-md-3 mb-3 pl-0">
                  <label class="form-label-custom" for="iddemanda">*Tipo de demanda:</label>
                  <select class="form-control form-control-custom" id="iddemanda" name="iddemanda" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['tipodemandas'] as $demanda)
                          <option value="{{ $demanda->id }}">{{ $demanda->descripcion }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Selecciona una opción
                  </div>
               </div>
             </div>

             <div class="form-label-custom mt-2 mb-2">Tipos de respuestas</div>

             <div class="col-md-12  mb-3 d-flex align-items-center justify-content-between flex-wrap">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="de_sedacita" id="de_sedacita" value="" >
                <label class="form-check-label label-custom-check" for="de_sedacita" id="l_de_sedacita">
                                       Se da una cita
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="de_canalizacion" id="de_canalizacion" value="" >
                <label class="form-check-label label-custom-check" for="de_canalizacion" id="l_de_canalizacion">
                                       Canalización-orientación
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="de_sedainformacion" id="de_sedainformacion" value="" >
                <label class="form-check-label label-custom-check" for="de_canalizacion" id="l_de_sedainformacion">
                                       Se da información
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="dde_escucha" id="de_escucha" value="" >
                <label class="form-check-label label-custom-check" for="de_escucha" id="l_de_escucha">
                                       Escucha-manejo de crisis
                </label>
               </div>

             </div>

             <div class="col-md-12  mb-3 d-flex align-items-center justify-content-start flex-wrap">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="de_consejo" id="de_consejo" value="" >
                <label class="form-check-label label-custom-check" for="de_consejo" id="l_de_consejo">
                                       Consejo-orientación
                </label>
               </div>
               <div class="col-md-3 pl-0 " id="nom">
                     <!-- <label class="form-label-custom" for="de_otro" >Otro:</label> -->
                     <input type="text" class="form-control form-control-custom street-names" id="de_otro" maxlength="50" placeholder="Especifique que otra respuesta" >
                     <div class="invalid-feedback">
                             Asegúrate de introducir la información correctamente
                    </div>
                </div>
             </div>
             <div class="row col-md-12">
               <div class="col-md-3 mb-3 pl-0">
                  <label class="form-label-custom" for="iddemanda">Resultado:</label>
                  <select class="form-control form-control-custom" id="idresultado" name="idresultado" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['resultados'] as $resultado)
                          <option value="{{ $resultado->id }}">{{ $resultado->descripcion }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Selecciona una opción
                  </div>
               </div>
                  <div class="col-md-9 ">
                    <label class="form-label-custom" for="resultado">Observaciones y anotaciones de la persona operadora técnica:</label>
                    <textarea type="text" name="resultado" id="resultado" class="form-control form-control-custom street-names" placeholder="Escribe tus observaciones y anotaciones" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

             </div>
      <div class="row col-md-12 d-flex justify-content-end mt-3 mb-3 align-items-center">
           <div class="Usuarios mb-0"></div>
           <div id="crearexpediente">
                 <a href="" id="crear-demanda" >Agregar demanda</a>
                 <img class="Crear-expediente-svg" type="img" src="https://adipjc.soluint.com/public/src/img/agregarexpediente.svg">
            </div>
      </div>

             <div class="row col-md-12 d-flex justify-content-end">
                  <div class="btn-01" name="button" id="crear-expediente" >Crear expediente</div>
             </div>
         </form>
      </div>



      <div  id="c_diagnostica" name="tabi" class="d-flex d-none">
        <div class="col-lg-4">

          <a class="btn-registro active" id="policias" data-toggle="tab" href="#c_trabajo" role="button">TRABAJO</a>
          <a class="btn-registro" id="infractores" data-toggle="tab" href="#c_infractores" role="button">EDUCACIÓN</a>
          <a class="btn-registro" id="b_motivo" data-toggle="tab" href="#c_motivo" role="button">SALUD</a>
          <a class="btn-registro" id="b_quienfirma" data-toggle="tab" href="#c_quienfirma" role="button">RED FAMILIAR</a>
          <a class="btn-registro" id="b_quienfirma" data-toggle="tab" href="#c_quienfirma" role="button">RED SOCIAL E INSTITUCIONAL</a>
          <a class="btn-registro" id="b_quienfirma" data-toggle="tab" href="#c_quienfirma" role="button">CULTURA RECREACIÓN Y DEPORTE</a>
          <a class="btn-registro" id="b_quienfirma" data-toggle="tab" href="#c_quienfirma" role="button">RESUMEN DE ATENCIÓN</a>
          <a class="btn-registro" id="b_quienfirma" data-toggle="tab" href="#c_quienfirma" role="button">VARIABLES DIAGNÓSTICAS</a>


        </div> <!-- Cerrar columna lateral -->

        <!-- Inica columna derecha -->
        <div class="col-lg-8">
          <div class="tab-content" id="v-pills-tabContent">

            <!-- Inicia tab-pane Información -->

        <div class="tab-pane fade show active" id="c_trabajo" ">
      <form id="f_trabajo" data-id="" data-usuario="{{{ Auth::user()->email }}}">
             <div class="Lugar-de-imparticin mt-2 mb-2">1. Experiencia laboral</div>
             <div class="incisos">a) Señalar su último empleo anterior a la privación de la libertad:</div>
        <div class="row">
          <div class="col-md-12 mb-3" id="nom">
           <legend class="form-label-custom">Tipo:</legend>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_esformal" id="tr_esformalsi" value="1" >
            <label class="form-check-label label-custom-check" for="pes">
              Formal
            </label>
           </div>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_esformal" id="tr_esformalno" value="0" >
            <label class="form-check-label label-custom-check" for="pc">
              Informal
            </label>
           </div>
          </div>
        </div>

        <div class="row  mb-1">
          <div class="col-md-4" id="nom">
            <label class="form-label-custom" for="tr_puesto" >Puesto:</label>
            <input type="text" class="form-control form-control-custom street-names" id="tr_puesto" maxlength="30" placeholder="Escribe el puesto" required>
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4" id="apa">
            <label class="form-label-custom" for="tr_sueldo">Sueldo:</label>
            <input type="text" class="form-control form-control-custom names" id="tr_sueldo" maxlength="30" placeholder="Escribe el sueldo" required>
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4" id="ama">
            <label class="form-label-custom" for="tr_duracion">Duración:</label>
            <input type="text" class="form-control form-control-custom names" id="tr_duracion" maxlength="30" placeholder="Escribe la duración">
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
               <label class="form-label-custom" for="tr_motivo">Motivo de salida:</label>
               <textarea type="text" class="form-control form-control-custom street-names" id="tr_motivo" maxlength="1000" placeholder="Escribe el motivo de salida" ></textarea>
               <div class="invalid-feedback">
                           Asegúrate de introducir la información correctamente
               </div>
             </div>
        </div>

        <div class="incisos">b) ¿Cuenta con algún oficio?</div>
        <div class="row">
          <div class="col-md-12 mb-3" id="nom">
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_tieneunoficio" id="tr_tieneunoficiosi" value="1" >
            <label class="form-check-label label-custom-check" for="tr_tieneunoficiosi">
              Si
            </label>
           </div>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_tieneunoficio" id="tr_tieneunoficiono" value="0" >
            <label class="form-check-label label-custom-check" for="tr_tieneunoficiono">
              No
            </label>
           </div>
          </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
               <label class="form-label-custom" for="tr_donde">¿Cuál? ¿Dónde lo aprendió?</label>
               <textarea type="text" class="form-control form-control-custom street-names" id="tr_donde" maxlength="1000" placeholder="Escribe el motivo de salida" ></textarea>
               <div class="invalid-feedback">
                           Asegúrate de introducir la información correctamente
               </div>
             </div>
        </div>

        <div class="incisos">c) Experiencia laboral adquirida en el centro penitenciario</div>
        <div class="row d-flex align-items-baseline">
          <div class="col-md-4 mb-3" id="nom">
           <legend class="form-label-custom">¿Laboró durante su sentencia?</legend>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_laboro" id="tr_laborosi" value="1" >
            <label class="form-check-label label-custom-check" for="tr_laborosi">
              Si
            </label>
           </div>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_laboro" id="tr_laborono" value="0" >
            <label class="form-check-label label-custom-check" for="tr_laboro">
              No
            </label>
           </div>
          </div>
             <div class="col-md-8">
               <label class="form-label-custom" for="tr_laboroenque">¿En que? </label>
               <input type="text" class="form-control form-control-custom street-names" id="tr_laboroenque" maxlength="1000" placeholder="Escribe en que laboro" >
               <div class="invalid-feedback">
                           Asegúrate de introducir la información correctamente
               </div>
             </div>

        </div>
        <div class="row d-flex align-items-baseline">
          <div class="col-md-4 mb-3" id="nom">
           <legend class="form-label-custom">¿Recibió alguna capacitación laboral durante el cumplimiento de la sentencia?</legend>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_secapacito" id="tr_secapacitosi" value="1" >
            <label class="form-check-label label-custom-check" for="tr_secapacitosi">
              Si
            </label>
           </div>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_secapacito" id="tr_secapacitono" value="0" >
            <label class="form-check-label label-custom-check" for="tr_secapacito">
              No
            </label>
           </div>
          </div>
             <div class="col-md-8">
               <label class="form-label-custom" for="tr_secapacitoenque">¿En que? </label>
               <input type="text" class="form-control form-control-custom street-names" id="tr_secapacitoenque" maxlength="1000" placeholder="Escribe en que recibió capacitación laboral" >
               <div class="invalid-feedback">
                           Asegúrate de introducir la información correctamente
               </div>
             </div>
        </div>

        <div class="row d-flex align-items-center">
          <div class="col-md-4 mb-3" id="nom">
           <legend class="form-label-custom">¿Estaba en nómina?</legend>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_ennomina" id="tr_ennominasi" value="1" >
            <label class="form-check-label label-custom-check" for="tr_ennominasi">
              Si
            </label>
           </div>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_ennomina" id="tr_ennominano" value="0" >
            <label class="form-check-label label-custom-check" for="tr_ennomina">
              No
            </label>
           </div>
          </div>
          <div class="col-md-4 mb-3" id="nom">
           <legend class="form-label-custom">¿Generó fondo de ahorro?</legend>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_fondoahorro" id="tr_fondoahorrosi" value="1" >
            <label class="form-check-label label-custom-check" for="tr_fondoahorrosi">
              Si
            </label>
           </div>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_fondoahorro" id="tr_fondoahorrono" value="0" >
            <label class="form-check-label label-custom-check" for="tr_fondoahorro">
              No
            </label>
           </div>
          </div>
        </div>

        <div class="incisos">d) ¿Actualmente cuenta con un empleo?</div>

        <div class="row">
          <div class="col-md-12 mb-3" id="nom">
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_conempleo" id="tr_conempleosi" value="1" >
            <label class="form-check-label label-custom-check" for="tr_conempleosi">
              Si
            </label>
           </div>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_conempleo" id="tr_conempleono" value="0" >
            <label class="form-check-label label-custom-check" for="tr_conempleono">
              No
            </label>
           </div>
          </div>
        </div>

        <div class="row d-flex align-items-baseline">
          <div class="col-md-4 mb-3" id="nom">
           <legend class="form-label-custom">Tipo:</legend>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_empleoformal" id="tr_empleoformalsi" value="1" >
            <label class="form-check-label label-custom-check" for="tr_empleoformalsi">
              Si
            </label>
           </div>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tr_empleoformal" id="tr_empleoformalno" value="0" >
            <label class="form-check-label label-custom-check" for="tr_empleoformal">
              No
            </label>
           </div>
          </div>
             <div class="col-md-8">
               <label class="form-label-custom" for="tr_queempleo">¿En que? </label>
               <input type="text" class="form-control form-control-custom street-names" id="tr_queempleo" maxlength="1000" placeholder="Escribe el empleo" >
               <div class="invalid-feedback">
                           Asegúrate de introducir la información correctamente
               </div>
             </div>

        </div>

        <div class="row  mb-1">
          <div class="col-md-3" id="nom">
            <label class="form-label-custom" for="tr_ingreso" >Ingreso mensual:</label>
            <input type="text" class="form-control form-control-custom numbers" id="tr_ingreso" maxlength="30" placeholder="Escribe el ingreso" >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4" id="apa">
            <label class="form-label-custom" for="tr_tempodesempleo">Tiempo de estar desempleado:</label>
            <input type="text" class="form-control form-control-custom names" id="tr_tempodesempleo" maxlength="30" placeholder="Escribe el tiempo" >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-5" id="ama">
            <label class="form-label-custom" for="tr_intentos">Número de intentos en la búsqueda de trabajo:</label>
            <input type="text" class="form-control form-control-custom numbers" id="tr_intentos" maxlength="2" placeholder="00">
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
               <label class="form-label-custom" for="tr_donde">Describa las funciones y/o actividades que realiza:</label>
               <textarea type="text" class="form-control form-control-custom street-names" id="tr_funciones" maxlength="1000" placeholder="Escribe las funciones y/o actividades que realiza" ></textarea>
               <div class="invalid-feedback">
                           Asegúrate de introducir la información correctamente
               </div>
             </div>
        </div>

             <div class="Lugar-de-imparticin mt-2 mb-2">2. Espectativas laborales</div>
        <div class="row mb-4">
            <div class="col-md-12">
               <label class="form-label-custom" for="tr_expectativas">Señalar expectativas laborales a corto y largo plazo:</label>
               <textarea type="text" class="form-control form-control-custom street-names" id="tr_expectativas" maxlength="1000" placeholder="Escribe las expectactivas laborales a corto y largo plazo" ></textarea>
               <div class="invalid-feedback">
                           Asegúrate de introducir la información correctamente
               </div>
             </div>
        </div>

             <div class="Lugar-de-imparticin mt-2 mb-2">3. Observaciones</div>
        <div class="row mb-4">
            <div class="col-md-12">
               <label class="form-label-custom" for="tr_observaciones">Observaciones del/la entrevistador/a:</label>
               <textarea type="text" class="form-control form-control-custom street-names" id="tr_observaciones" maxlength="1000" placeholder="Escribe las observaciones" ></textarea>
               <div class="invalid-feedback">
                           Asegúrate de introducir la información correctamente
               </div>
             </div>
        </div>







                <div class="contenedor-boton justify-content-end seccion">
                  <button class="btn-01" type="submit" name="guardarexpediente" >Crear expediente</button>
                </div>
              </form>
            </div> <!-- Finaliza tabPane información general -->

            <div class="tab-pane fade" id="c_quienfirma" >
              <form id="f_quienfirma" >
        <div class="row">
          <div class="col-md-8 mb-3">
            <label class="form-label-custom" for="idjuez">*Juez</label>
            <select class="form-control form-control-custom" id="idjuez" name="idjuez" required>
              <option disabled value="" selected hidden>Selecciona una</option>
{{--
                      @foreach ($data['jueces'] as $juez)
                      <option value="{{ $juez->id }}">{{ $juez->nombrecompleto }}</option>
                      @endforeach
--}}
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8 mb-3">
            <label class="form-label-custom" for="idsecretario">*Secretario</label>
            <select class="form-control form-control-custom" id="idsecretario" name="idsecretario" required>
              <option disabled value="" selected hidden>Selecciona una</option>
{{--
                      @foreach ($data['secretarios'] as $secretario)
                      <option value="{{ $secretario->id }}">{{ $secretario->nombrecompleto }}</option>
                      @endforeach
--}}
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
        </div>

                <div class="contenedor-boton justify-content-end seccion">
                  <button class="btn-01" type="submit" name="guardarexpediente" >Crear expediente</button>
                </div>



              </form>
            </div>


            <div class="tab-pane fade" id="c_motivo" >
              <form id="f_motivo" >
            <!-- Pan-Pane Domicilio -->
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label-custom" for="diahechos">*Fecha en que ocurrieron los hechos:</label>
                    <input type="date" name="diahechos" id="diahechos" class="form-control form-control-custom street-names" maxlength="12" value="{{ date('Y-m-d') }}" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label-custom" for="horahechos">*Hora en que ocurrieron los hechos:</label>
                    <input type="text" name="horahechos" id="horahechos" class="form-control form-control-custom" maxlength="5" value="" placeholder="00:00" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                </div>


                <h2 class="mb-0">Lugar de la detención</h2>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="calle_h">Calle:</label>
                    <input autofocus type="text" name="calle_h" id="calle_h" class="form-control form-control-custom street-names" maxlength="30" value="" placeholder="Escribe la calle" autofocus required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="exterior_h">No. exterior:</label>
                    <input type="text" name="exterior_h" id="exterior_h" class="form-control form-control-custom street-names" maxlength="10" value="" placeholder="00" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="interior_h">No. interior:</label>
                    <input type="text" name="interior_h" id="interior_h" class="form-control form-control-custom street-names" maxlength="10" value="" placeholder="00">
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="cp_h">Código postal:</label>
                    <input type="text" name="cp_h" id="cp_h" class="form-control form-control-custom numbers" maxlength="5" value="" placeholder="00000" pattern="^[0-9]{4,5}$" required>
                    <div class="invalid-feedback">
                      Ingresa los cuatro o cinco dígitos de tu código postal
                    </div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="colonia_h">Colonia:</label>
                    <input type="text" name="colonia_h" id="colonia_h" class="form-control form-control-custom street-names" maxlength="30" value="" placeholder="Escribe la colonia" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="id_alcaldia_h">*Alcaldía:</label>
                    <select class="form-control form-control-custom" id="id_alcaldia_h" name="id_alcaldia_h" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
{{--
                      @foreach ($data['alcaldias'] as $alcaldia)
                      <option value="{{ $alcaldia['id_cat_alcaldia'] }}">{{ $alcaldia->descripcion}}</option>
                      @endforeach
--}}
                    </select>
                    <div class="invalid-feedback">
                      Selecciona una opción
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label-custom" for="entrecalle_h">Entre que calle:</label>
                    <input type="text" name="cp_h" id="entrecalle_h" class="form-control form-control-custom street-names" maxlength="100" value="" placeholder="Escribe entre que calle" pattern="^[0-9]{4,5}$" >
                    <div class="invalid-feedback">
                      Ingresa los cuatro o cinco dígitos de tu código postal
                    </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label-custom" for="ycalle_h">Y que calle:</label>
                    <input type="text" name="colonia_h" id="ycalle_h" class="form-control form-control-custom street-names" maxlength="100" value="" placeholder="Escribe y que calle" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                </div>


                <h2 class="mb-0">Motivo</h2>
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label-custom" for="motivo">*Datos de la probable infracción:</label>
                    <textarea name="motivo" id="motivo" class="form-control form-control-custom street-names" maxlength="130" value="" placeholder="Detallar el motivo por el que se realiza la presentación" required></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label-custom" for="objetos">Objeto(s) recogido(s) con la(s) probable(s) infracción(es):</label>
                    <textarea name="objetos" id="objetos" class="form-control form-control-custom street-names" maxlength="2000" value="" placeholder="Describir los objetos" required></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                </div>

                <div class="contenedor-boton justify-content-end seccion">
                  <button class="btn-01" type="submit" name="guardarexpediente" id="grabamotivo" >Crear expediente</button>
                </div>
              </form>
            </div> <!-- Finaliza tab-Panel Domicilio -->


            <div class="tab-pane fade" id="c_infractores" >

              <div class="overflow-auto">
                <table id="dg_infractores" class="tabla seccion mt-0">
                </table>
                  <button class="row col-md-12 mb-3  d-flex justify-content-end align-items-end">
                    <div name='agregarinfractor'>
                        <label class="Crear-expediente mb-0 py-2" name="button" >Agregar infractor</label>
                        <img class="Crear-expediente-svg" type="img" src="{{url('')}}/src/img/agregarexpediente.svg" />
                    </div>
                  </button>
                <div class="contenedor-boton justify-content-end seccion">
                  <button class="btn-01" type="submit" name="guardarexpediente" id="grabamotivo" >Crear expediente</button>
                </div>
              </div>
            </div>
  
            <div class="tab-pane fade" id="c_infractor" >

              <form id="f_xxxxxx" data-id=''>
      <div id="c_medico" name="tabi" class="">
             <div class="row col-md-12  mb-3">
               <div class="form-check-inline col-md-12">
                <input class="form-check-input" type="checkbox" name="aplicacertificado" id="aplicacertificado" value="1" >
                <label class="form-check-label label-custom-check" for="aplicacertificado" id="l_aplicacertificado">
                                        No aplica
                </label>
               </div>
             </div>

                <div class="row col-md-12">
                  <div class="col-md-6 pl-0">
                    <label class="form-label-custom" for="dia_examen">*Fecha del examen médico:</label>
                    <input type="date" name="dia_examen" id="dia_examen" class="form-control form-control-custom street-names" maxlength="10" value="" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label-custom" for="hora_examen">*Hora en que se realizo el examen médico:</label>
                    <input type="text" name="hora_examen" id="hora_examen" class="form-control form-control-custom" maxlength="5" value="" placeholder="00:00" pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                </div>

             <div class="row col-md-12  mb-3 d-flex align-items-center justify-content-between">
               <div class="form-check-inline col-md-2 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="conlesiones" id="conlesiones" value="1" >
                <label class="form-check-label label-custom-check" for="conlesiones" id="l_conlesiones">
                                        Con lesiones?
                </label>
               </div>
               <div class="col-md-3">
                    <label class="form-label-custom" for="edad_clinica">*Edad clinica:</label>
                    <input type="text" name="edad_clinica" id="edad_clinica" class="form-control form-control-custom numbers" maxlength="3" value="" placeholder="000" pattern="^[0-9]{4,5}$" required>
                    <div class="invalid-feedback">
                      Ingresa los cuatro o cinco dígitos de tu código postal
                    </div>
                </div>
                 <div class="col-md-6" id="nom">
                     <label class="form-label-custom" for="otro" >Otro:</label>
                     <input type="text" class="form-control form-control-custom street-names" id="otro" maxlength="50" placeholder="Escribe si se detecto otro problema" >
                     <div class="invalid-feedback">
                             Asegúrate de introducir la información correctamente
                    </div>
                </div>
             </div>

             <div class="row col-md-12  mb-3">
               <div class="form-check-inline col-md-12">
                <input class="form-check-input" type="checkbox" name="acepto_examen" id="acepto_examen" value="1" >
                <label class="form-check-label label-custom-check" for="acepto_examen" id="l_acepto_examen">
                                        El probable infractor acepto que se le realizara un examén médico?
                </label>
               </div>
             </div>
             <div class="row col-md-12  mb-3 d-flex align-items-center">
                 <div class="col-md-12 pl-0" id="nom">
                     <label class="form-label-custom" for="nombres_autorizzo" >Nombre:</label>
                     <input type="text" class="form-control form-control-custom street-names" id="nombres_autorizzo" maxlength="100" placeholder="Persona que acepto el examen médico en caso de ser menor de edad el presunto responsable" >
                     <div class="invalid-feedback">
                             Asegúrate de introducir la información correctamente
                    </div>
                 </div>
             </div>

                  <div class="row col-md-12 mb-3">
                    <label class="form-label-custom" for="resultado">*Exploración médico legal:</label>
                    <textarea autofocus name="sancionaplicada" id="resultadox" class="form-control form-control-custom street-names" maxlength="1000" value="" placeholder="Escribe la exploración médico legal" autofocus required></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="row col-md-12 mb-3">
                    <label class="form-label-custom" for="prescripcion">*Clasificación provisional de lesiones y/o conclusiones:</label>
                    <textarea autofocus name="sancionaplicada" id="prescripcion" class="form-control form-control-custom street-names" maxlength="1000" value="" placeholder="Escribe la clasificación provisional de lesiones y/o conclusiones:" autofocus required></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

        <div class="row  col-md-12 mb-3">
          <div class="col-md-8 pl-0" id="nom">
            <label class="form-label-custom" for="nombremedico" >*Médico:</label>
            <input type="text" class="form-control form-control-custom street-names" id="nombremedico" maxlength="30" placeholder="Escribe el nombre del médico" >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4" id="nom">
            <label class="form-label-custom" for="cedulaprofesinal" >*Cédula profesional:</label>
            <input type="text" class="form-control form-control-custom street-names" id="cedulaprofesinal" maxlength="10" placeholder="Escribe el número de cédula profesional" >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
        </div>
        <div class="row  col-md-12 mb-3">
          <div class="col-md-4 pl-0" id="nom">
            <label class="form-label-custom" for="tirilla" >*Número de tirilla:</label>
            <input type="text" class="form-control form-control-custom street-names" id="tirilla" maxlength="30" placeholder="Escribe el número de tirilla" >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
        </div>

             <div class="row col-md-12  mb-3">
               <div class="form-check-inline col-md-12">
                <input class="form-check-input" type="checkbox" name="procesosupendido" id="procesosupendido" value="1" >
                <label class="form-check-label label-custom-check" for="procesosupendido" id="l_estatus">
                                        El proceso queda suspendido
                </label>
               </div>
             </div>







      </div>

      <div id="c_datosgenerales" name="tabi" class="">
        <div class="Policias-remitentes mt-3">Datos personales</div>
        <div class="row  mb-1">
          <div class="col-md-4" id="nom">
            <label class="form-label-custom" for="nombre_i" >*Nombre(s):</label>
            <input type="text" class="form-control form-control-custom street-names" id="nombre_i" maxlength="30" placeholder="Escribe el nombre(s)" required>
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>

          <div class="col-md-4" id="apa">
            <label class="form-label-custom" for="primer_apellido_i">*Primer apellido:</label>
            <input type="text" class="form-control form-control-custom names" id="primer_apellido_i" maxlength="30" placeholder="Escribe el primer apellido" required>
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>

          <div class="col-md-4" id="ama">
            <label class="form-label-custom" for="segundo_apellido_i">Segundo Apellido:</label>
            <input type="text" class="form-control form-control-custom names" id="segundo_apellido_i" maxlength="30" placeholder="Escribe el segundo apellido">
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
        </div>

        <div class="row  mb-1">
                  <div class="col-md-4 ">
                    <label class="form-label-custom" for="sexo">*Sexo:</label>
                    <select class="form-control form-control-custom" id="sexo" name="sexo" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
                      <option value="F">FEMENINO</option>
                      <option value="M">MASCULINO</option>
                    </select>
                    <div class="invalid-feedback">
                      Selecciona una opción
                    </div>
                  </div>

          <div class="col-md-4" id="apa">
            <label class="form-label-custom" for="curp">Curp:</label>
            <input type="text" class="form-control form-control-custom " id="curp" maxlength="18" placeholder="AAAA111111BBBBBB22" 
                        pattern="^([A-ZÑ\x26]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])(M|H)([A-ZÑx26]{2})([A-ZÑx26]{3})([0-9A-Z]{1}[0-9]{1}))?$"
            >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>

                  <div class="col-md-4">
                    <label class="form-label-custom" for="identidad">Lugar de nacimiento:</label>
                    <select class="form-control form-control-custom" id="identidad" name="identidad" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
{{--
                      @foreach ($data['entidades'] as $entidad)
                      <option value="{{ $entidad['id'] }}">{{ $entidad['descripcion'] }}</option>
                      @endforeach
--}}
                    </select>
                    <div class="invalid-feedback">
                      Selecciona una opción
                    </div>
                  </div>

        </div>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="nacimiento">Fecha de nacimiento:</label>
                    <input type="date" name="nacimiento" id="nacimiento" class="form-control form-control-custom street-names" maxlength="12" value="" placeholder="dd/mm/aaaa" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="ocupacion">Ocupación:</label>
                    <input type="text" name="ocupacion" id="ocupacion" class="form-control form-control-custom street-names" maxlength="40" value="" placeholder="Escribe la ocupación" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="identificacion">Identificación:</label>
                    <input type="text" name="identificacion" id="identificacion" class="form-control form-control-custom street-names" maxlength="40" value="" placeholder="Escribe la identificación" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

                </div>

        <div class="Policias-remitentes mt-3">Domicilio</div>
                <div class="row">
                  <div class="col-md-4">
                    <label class="form-label-custom" for="calle_i">Calle:</label>
                    <input autofocus type="text" name="calle_i" id="calle_i" class="form-control form-control-custom street-names" maxlength="30" value="" placeholder="Escribe la calle" autofocus required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label-custom" for="exterior_i">No. exterior:</label>
                    <input type="text" name="exterior_i" id="exterior_i" class="form-control form-control-custom street-names" maxlength="10" value="" placeholder="00" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label-custom" for="interior_i">No. interior:</label>
                    <input type="text" name="interior_i" id="interior_i" class="form-control form-control-custom street-names" maxlength="10" value="" placeholder="00">
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="cp_i">Código postal:</label>
                    <input type="text" name="cp_i" id="cp_i" class="form-control form-control-custom numbers" maxlength="5" value="" placeholder="00000" pattern="^[0-9]{4,5}$" required>
                    <div class="invalid-feedback">
                      Ingresa los cuatro o cinco dígitos de tu código postal
                    </div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="colonia_i">Colonia:</label>
                    <input type="text" name="colonia_i" id="colonia_i" class="form-control form-control-custom street-names" maxlength="30" value="" placeholder="Escribe la colonia" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="id_alcaldia_i">Alcaldía:</label>
                    <select class="form-control form-control-custom" id="id_alcaldia_i" name="id_alcaldia_i" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
{{--
                      @foreach ($data['alcaldias'] as $alcaldia)
                      <option value="{{ $alcaldia['id_cat_alcaldia'] }}">{{ $alcaldia->descripcion}}</option>
                      @endforeach
--}}
                    </select>
                    <div class="invalid-feedback">
                      Selecciona una opción
                    </div>
                  </div>

                </div>

        <div class="row  mb-5">
          <div class="row col-md-6 ml-0" id="nom">
            <legend class="form-label-custom mb-1" for="id_file_0001" >Fotografía:</legend>
            <div class=" d-flex flex-nowrap">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="id_file_0001"  id="id_file_0001" accept=".png, .jpg, .jpeg" maxlength="30" placeholder="Selecciona un archivo JPG o PNG" >
                <label class="custom-file-label" for="l_id_file_0001">
                              <p class="texto" id="l_id_file_0001">Selecciona un archivo PDF</p>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="Policias-remitentes mt-3">Declaración</div>
                  <div class="row col-md-12 mb-3">
                    <label class="form-label-custom" for="declaracion">*Declaración:</label>
                    <textarea autofocus name="sancionaplicada" id="declaracion" class="form-control form-control-custom street-names" maxlength="1000" value="" placeholder="Escribe la declaración" autofocus ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

      </div> <!-- fin datos personales -->

      <div id="c_infraccionesysancion" name="tabi" class="d-none">
        <div class="Policias-remitentes mt-3">Infracción y sanción</div>
        <div class="row  mb-2">
                  <div class="col-md-6 mb-3">
                    <label class="form-label-custom" for="idinfraccion">Infracción:</label>
                    <select class="form-control form-control-custom" id="idinfraccion" name="idinfraccion" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
{{--
                      @foreach ($data['infracciones'] as $infraccion)
                      <option 
                             data-infraccion="{{ $infraccion->infraccion }}" 
                             data-descripcion="{{ $infraccion->descripcion }}" 
                             data-conciliacion="{{ $infraccion->conciliacion }}" 
                             data-aplicarsi="{{ $infraccion->aplicarsi }}" 
                             data-tipo_sancion="{{ $infraccion->tipo_sancion }}" 
                             data-uc_desde="{{ $infraccion->uc_desde }}" 
                             data-uc_hasta="{{ $infraccion->uc_hasta }}" 
                             data-servicio_desde="{{ $infraccion->servicio_desde }}" 
                             data-servicio_hasta="{{ $infraccion->servicio_hasta }}" 
                             data-arresto_desde="{{ $infraccion->arresto_desde }}" 
                             data-arresto_hasta="{{ $infraccion->arresto_hasta }}" 
                           value="{{ $infraccion->id }}">{{ 'Articulo '.$infraccion->articulo.' Fraccion '.$infraccion->fraccion }}</option>
                      @endforeach
--}}
                    </select>
                    <div class="invalid-feedback">
                      Selecciona una opción
                    </div>
                  </div>
        </div>
        <div class="row " id="textos" >
             <div class="col-md-12  mb-0">
                 <label class="Crear-expediente pb-0 mb-0 " name="button" id="l_infraccion" ></label>
             </div>
             <div class="col-md-12  mb-2">
                 <label class="II-Poseer-animales mb-0 py-2" name="button" id="l_descripcion" ></label>
             </div>
             <div class="col-md-12 mb-0">
                 <label class="Crear-expediente pb-0 mb-0 " name="button"  >Conciliación:</label>
             </div>
             <div class="col-md-12  mb-2">
                 <label class="II-Poseer-animales mb-0 py-2" name="button" id='l_conciliacion' >No aplica</label>
             </div>
             <div class="col-md-12  mb-0">
                 <label class="Crear-expediente pb-0 mb-0 " name="button"  >Aplica si:</label>
             </div>
             <div class="col-md-12  mb-2">
                 <label class="II-Poseer-animales mb-0 py-2" name="button" id='l_aplicarsi' >No aplica</label>
             </div>
             <div class="col-md-12  mb-2">
                 <label class="Crear-expediente pb-0 mb-0 " name="button"  id='l_tipo_sancion'></label>
             </div>
             <div class="col-md-12  mb-0">
                 <label class="Crear-expediente pb-0 mb-0 " name="button"  id='l_tipo_sancion'>*Tipo de sanción:</label>
             </div>
             <div class="col-md-12  mb-2">
               <div class="form-check-inline col-md-12">
                <input class="form-check-input" type="radio" name="tiposancion" id="uc" value="2" required="">
                <label class="form-check-label label-custom-check" for="uc" id="l_uc">
                                        Unidad de cuenta 
                </label>
               </div>
               <div class="form-check-inline col-md-12">
                <input class="form-check-input" type="radio" name="tiposancion" id="hs" value="3"  required="">
                <label class="form-check-label label-custom-check" for="hs" id="l_hs">
                                        Horas de servicio comunitario
                </label>
               </div>
               <div class="form-check-inline col-md-12">
                <input class="form-check-input" type="radio" name="tiposancion" id="ha" value="4"  required="">
                <label class="form-check-label label-custom-check" for="ha" id="l_ha">
                                        Horas de arresto
                </label>
               </div>
             </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-label-custom" for="sancionaplicada">*Sanción:</label>
                    <input autofocus type="number" name=""sancionaplicada"" id="sancionaplicada" class="form-control form-control-custom street-names" maxlength="2" value="" placeholder="Escribe la sanción a aplicar de acuerdo al rango del tipo de sanción" autofocus required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label-custom" for="observaciones">Observaciones:</label>
                    <textarea autofocus name=""sancionaplicada"" id="observaciones" class="form-control form-control-custom street-names" maxlength="1000" value="" placeholder="Escribe una observacion a la sanción aplicada" autofocus required></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
        </div>
      </div> <!-- fin de infraccionysancion -->

                  <div class="row col-md-12 mb-3  mr-0 pr-0 d-flex justify-content-between align-items-center">
                    <div id='mostrarinfractores' class="col-md-4">
                        <img class="Triangle" type="img" src="{{url('')}}/src/img/triangle.svg" />
                        <img class="Triangle" type="img" src="{{url('')}}/src/img/triangle.svg" />
                        <label class="Infractores-del-expe mb-0 py-2" name="button" >Infractores del expediente</label>
                    </div>

                    <div name='agregarinfractor' class="col-md-4 d-flex align-items-center justify-content-end">
                        <label class="Crear-expediente mb-0 py-2" name="button" >Agregar infractor</label>
                        <img class="Crear-expediente-svg ml-2" type="img" src="{{url('')}}/src/img/agregarexpediente.svg" />
                    </div>
                  </div>

                  <div class="contenedor-boton justify-content-end seccion">
                        <button class="btn-01" type="submit" name="guardarexpediente" >Crear expediente</button>
                  </div>

              </form>
            </div> <!-- Finaliza tab-Panel c_infractor -->

          </div> <!-- Cierra tabContent -->
        </div> <!-- Cerrar columna derecha -->
      </div> <!-- Cerrar contenido -->
    </section>
  </main>
  @endsection
