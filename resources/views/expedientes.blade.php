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
                      <div class="pl-1 border-bottom border-success" id="agenta" name="opciones" data-href="c_agenda" >| Agenda</div>
                    </div>

      </div>
    <div id='Primercontacto'>
      <div class="row col-md-12 d-flex justify-content-between pr-0 mr-0">
                    <div class="row col-lg-5 d-flex justify-content-start pr-0 -Datos-Generales-">
                         <div class="nombredelbeneficiario" data-id={{ $data['beneficiario']->id }} >{{ $data['beneficiario']->nombrecompleto }} </div>
                    </div>
                    <div class="row col-lg-7 campos-obligatorios d-flex justify-content-end">Los campos marcados con asterisco son obligatorios</div>
      </div>
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
                  <div class="btn-01" name="crear-expediente" >Crear expediente</div>
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
                  <div class="btn-01" name="crear-expediente" >Crear expediente</div>
             </div>
         </form>
      </div>



      <div  id="c_diagnostica" name="tabi" class="d-none">
       <div class="d-flex col-lg-12 flex-wrap">
        <div class="col-lg-4">
          <a class="btn-registro active" id="b_trabajo" data-toggle="tab" href="#c_trabajo" role="button">TRABAJO</a>
          <a class="btn-registro" id="b_educacion" data-toggle="tab" href="#c_educacion" role="button">EDUCACIÓN</a>
          <a class="btn-registro" id="b_salud" data-toggle="tab" href="#c_salud" role="button">SALUD</a>
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
            <input type="text" class="form-control form-control-custom numbers" id="tr_sueldo" maxlength="30" placeholder="Escribe el sueldo" required>
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
            <input type="text" class="form-control form-control-custom names-all" id="tr_tempodesempleo" maxlength="30" placeholder="Escribe el tiempo" >
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
                   <div class="btn-01" name="crear-expediente" >Crear expediente</div>
                </div>
              </form>
        </div> <!-- Finaliza tabPane información general -->

            <div class="tab-pane fade" id="c_educacion" >
              <form id="f_educacion" >
            <!-- Pan-Pane Domicilio -->
             <div class="Lugar-de-imparticin mt-2 mb-2">1. Nivel de estudios</div>
             <div class="incisos">a) Escolaridad:</div>
              <div class="row d-flex align-items-baseline ml-1">
               <div class="col-md-5 mb-3">
                  <select class="form-control form-control-custom" id="ed_idescolaridad" name="ed_idescolaridad" >
                      <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['escolaridades'] as $escolaridad)
                          <option value="{{ $escolaridad->id }}">{{ $escolaridad->descripcion }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Selecciona una opción
                  </div>
               </div>
                  <div class="col-md-6 mb-3 pl-0 pt-1" id="nom">
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="ed_escolaridadtrunca" id="ed_escolaridadtruncasi" value="1" >
                    <label class="form-check-label label-custom-check" for="ed_escolaridadtruncasi">
                      Trunca 
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="ed_escolaridadtrunca" id="ed_escolaridadtruncano" value="0" >
                    <label class="form-check-label label-custom-check" for="ed_escolaridadtruncano">
                      Completa
                    </label>
                   </div>
                  </div>
              </div>
             <div class="incisos">b) Motivo de deserción:</div>
             <div class="row col-md-12">
                  <div class="col-md-12 ">
                    <textarea type="text" name="ed_motivodeser" id="ed_motivodeser" class="form-control form-control-custom street-names" placeholder="Escribe el motivo de deserción" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

             </div>
             <div class="Lugar-de-imparticin mt-2 mb-2">2. ¿Realizó actividades educativas en el centro penitenciario? ¿Cuáles?</div>
             <div class="row col-md-12">
                  <div class="col-md-12 ">
                    <textarea type="text" name="ed_actividadesedu" id="ed_actividadesedu" class="form-control form-control-custom street-names" placeholder="Escribe las actividades educativas" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

             </div>
             <div class="Lugar-de-imparticin mt-2 mb-2">3. ¿Desea continuar con sus estudios?</div>
              <div class="row d-flex align-items-baseline pl-4">
                  <div class="col-md-6 mb-3 pl-0 pt-1" id="nom">
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="ed_deseacontinuar" id="ed_deseacontinuarsi" value="1" >
                    <label class="form-check-label label-custom-check" for="ed_deseacontinuarsi">
                      Si
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="ed_deseacontinuar" id="ed_deseacontinuarno" value="0" >
                    <label class="form-check-label label-custom-check" for="ed_deseacontinuarno">
                      No
                    </label>
                   </div>
                  </div>
              </div>
             <div class="row col-md-12">
                  <div class="col-md-12 ">
                    <label class="form-label-custom" for="resultado">En caso de querer continuar ¿Qué le gustaría estudiar?:</label>
                    <textarea type="text" name="ed_quelegustaria" id="ed_quelegustaria" class="form-control form-control-custom street-names" placeholder="Escribe que le gustaría estudiar" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

             </div>
             <div class="Lugar-de-imparticin mt-2 mb-2">4. Observaciones del/la entrevistador/a:</div>
             <div class="row col-md-12">
                  <div class="col-md-12 ">
                    <textarea type="text" name="ed_observaciones" id="ed_observaciones" class="form-control form-control-custom street-names" placeholder="Escribe las observaciones" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

             </div>
                <div class="contenedor-boton justify-content-end seccion">
                   <div class="btn-01" name="crear-expediente" >Crear expediente</div>
                </div>

              </form>
            </div> <!-- Finaliza tab-Panel Domicilio -->

            <div class="tab-pane fade" id="c_salud" >
              <form id="f_salud" >
                 <div class="Lugar-de-imparticin mt-2 mb-2">1. Acceso y atención a los servicios de salud</div>
                 <div class="incisos">a) ¿Actualmente cuenta con algún servicio que le brinde atención médica? </div>
             <div class="col-md-12  d-flex align-items-center justify-content-start flex-wrap pl-3">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_ser_ninguno" id="sa_ser_ninguno" value="1" >
                <label class="form-check-label label-custom-check" for="sa_ser_ninguno" id="l_sa_ser_ninguno">
                                       Ninguno
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_ser_imss" id="sa_ser_imss" value="1" >
                <label class="form-check-label label-custom-check" for="sa_ser_imss" id="l_sa_ser_imss">
                                       IMSS
                </label>
               </div>
             </div>

             <div class="col-md-12  d-flex align-items-center justify-content-start flex-wrap pl-3">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_ser_isste" id="sa_ser_isste" value="1" >
                <label class="form-check-label label-custom-check" for="sa_ser_isste" id="l_sa_ser_isste">
                                       ISSSTTE
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="" id="sa_ser_privado" value="1" >
                <label class="form-check-label label-custom-check" for="sa_ser_privado" id="l_sa_ser_privado">
                                       Privado
                </label>
               </div>
             </div>

             <div class="col-md-12  mb-3 d-flex align-items-center justify-content-start flex-wrap pl-3">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_ser_popular" id="sa_ser_popular" value="1" >
                <label class="form-check-label label-custom-check" for="sa_ser_popular" id="l_sa_ser_popular">
                                       POPULAR
                </label>
               </div>
               <div class="col-md-3 pl-0 " id="nom">
                     <!-- <label class="form-label-custom" for="de_otro" >Otro:</label> -->
                     <input type="text" class="form-control form-control-custom street-names" id="sa_ser_otro" maxlength="50" placeholder="Especifique otro" >
                     <div class="invalid-feedback">
                             Asegúrate de introducir la información correctamente
                    </div>
                </div>
             </div>
                 <div class="Lugar-de-imparticin mt-2 mb-2">2. Estado de salud</div>
                 <div class="incisos">a) ¿Cómo considera su estado de salud? </div>
             <div class="row col-md-12   d-flex ">
                  <div class="col-md-8 mb-1 pl-0 pt-1" id="nom">
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_estadosalud" id="bueno" value="1" >
                    <label class="form-check-label label-custom-check" for="bueno">
                      Bueno
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_estadosalud" id="regular" value="2" >
                    <label class="form-check-label label-custom-check" for="tieneactano">
                      Regular
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_estadosalud" id="malo" value="3" >
                    <label class="form-check-label label-custom-check" for="malo">
                      Regular
                    </label>
                   </div>
                  </div>
             </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label-custom" for="sa_porque">¿Por qué?</label>
                    <textarea type="text" name="resultado" id="sa_porque" class="form-control form-control-custom street-names" placeholder="Escribe la razón" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                 <div class="incisos">b) ¿Tiene algún problema de salud?</div>
             <div class="row col-md-12  d-flex ">
                  <div class="col-md-8 mb-1 pl-0 pt-1" id="nom">
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_tieneproblema" id="sa_tieneproblemasi" value="1" >
                    <label class="form-check-label label-custom-check" for="sa_tieneproblemasi">
                      Si
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_tieneproblema" id="sa_tieneproblemano" value="2" >
                    <label class="form-check-label label-custom-check" for="sa_tieneproblemano">
                      No
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_tieneproblema" id="sa_tieneproblemade" value="3" >
                    <label class="form-check-label label-custom-check" for="sa_tieneproblemade">
                      Desconoce
                    </label>
                   </div>
                  </div>
             </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label-custom" for="sa_cual">En caso de contestar afirmativamente, ¿cuál?</label>
                    <textarea type="text" name="resultado" id="sa_cual" class="form-control form-control-custom street-names" placeholder="Escribe cual" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                 <div class="incisos">c) ¿Cuenta con tratamiento médico?</div>
             <div class="row col-md-12  d-flex ">
                  <div class="col-md-8 mb-1 pl-0 pt-1" id="nom">
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_tratamiento" id="sa_tratamientosi" value="1" >
                    <label class="form-check-label label-custom-check" for="sa_tratamientosi">
                      Si
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_tratamiento" id="sa_tratamientono" value="0" >
                    <label class="form-check-label label-custom-check" for="sa_tratamientono">
                      No
                    </label>
                   </div>
                  </div>
             </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label-custom" for="sa_tratamientocual">En caso de contestar afirmativamente, ¿cuál?</label>
                    <textarea type="text" name="resultado" id="sa_tratamientocual" class="form-control form-control-custom street-names" placeholder="Escribe cual" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

                 <div class="incisos">d) ¿Desea asistir a valoración médica?</div>
             <div class="row col-md-12  d-flex ">
                  <div class="col-md-8 mb-1 pl-0 pt-1" id="nom">
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_quierevaloracion" id="sa_quierevaloracionsi" value="1" >
                    <label class="form-check-label label-custom-check" for="sa_quierevaloracionsi">
                      Si
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_quierevaloracion" id="sa_quierevaloracionno" value="0" >
                    <label class="form-check-label label-custom-check" for="sa_quierevaloracionno">
                      No
                    </label>
                   </div>
                  </div>
             </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label-custom" for="sa_tratamientocual">En caso de contestar negativamente, ¿por qué?</label>
                    <textarea type="text" name="sa_quierevaloracionporque" id="sa_quierevaloracionporque" class="form-control form-control-custom street-names" placeholder="Escribe cual" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                 <div class="incisos">e) ¿Vive con alguna discapacidad?  </div>
             <div class="row col-md-12  d-flex ">
                  <div class="col-md-8 mb-1 pl-0 pt-1" id="nom">
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_discapacidad" id="sa_discapacidadsi" value="1" >
                    <label class="form-check-label label-custom-check" for="sa_discapacidadsi">
                      si
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_discapacidad" id="sa_discapacidadno" value="0" >
                    <label class="form-check-label label-custom-check" for="sa_discapacidadno">
                      no
                    </label>
                   </div>
                  </div>
             </div>
             <div class="col-md-12  d-flex align-items-center justify-content-between flex-wrap pl-3">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_visual" id="sa_visual" value="1" >
                <label class="form-check-label label-custom-check" for="sa_visual" id="l_sa_visual">
                                      Visual 
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_intelectual" id="sa_intelectual" value="1" >
                <label class="form-check-label label-custom-check" for="sa_intelectual" id="l_sa_intelectual">
                                       Intelectual
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_lenguaje" id="sa_lenguaje" value="1" >
                <label class="form-check-label label-custom-check" for="sa_lenguaje" id="l_sa_lenguaje">
                                       Lenguaje
                </label>
               </div>
             </div>

             <div class="col-md-12  d-flex align-items-center justify-content-between flex-wrap pl-3">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_auditiva" id="sa_auditiva" value="1" >
                <label class="form-check-label label-custom-check" for="sa_auditiva" id="l_sa_auditiva">
                                      Auditiva
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_cuidadopersonal" id="sa_cuidadopersonal" value="1" >
                <label class="form-check-label label-custom-check" for="sa_intelectual" id="l_sa_cuidadopersonal">
                                      Cuidado personal 
                </label>
               </div>
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_emocional" id="sa_emocional" value="1" >
                <label class="form-check-label label-custom-check" for="sa_emocional" id="l_sa_emocional">
                                      Emocional 
                </label>
               </div>
             </div>

             <div class="col-md-12  mb-3 d-flex align-items-center justify-content-between flex-wrap pl-3">
               <div class="col-md-3 d-flex align-items-center pr-0">
                <input class="form-check-input" type="checkbox" name="sa_motora" id="sa_motora" value="1" >
                <label class="form-check-label label-custom-check" for="sa_motora" id="l_sa_motora">
                                      Motora
                </label>
               </div>
             </div>
                 <div class="incisos">f) Dificultad  </div>
             <div class="row col-md-12  mb-3 d-flex ">
                  <div class="col-md-12 mb-1 pl-0 pt-1" id="nom">
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_dificultad" id="sa_dificultadsi" value="1" >
                    <label class="form-check-label label-custom-check" for="sa_discapacidadsi">
                      Poca
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_dificultad" id="sa_dificultadno" value="2" >
                    <label class="form-check-label label-custom-check" for="sa_dificultadno">
                      Mucha
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_dificultad" id="sa_dificultadnp" value="3" >
                    <label class="form-check-label label-custom-check" for="sa_dificultadnp">
                      No puede hacerlo
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_dificultad" id="sa_dificultadsd" value="4" >
                    <label class="form-check-label label-custom-check" for="sa_dificultadsd">
                      Sin dificultad
                    </label>
                   </div>
                  </div>
             </div>
                 <div class="incisos">g) Causa </div>
             <div class="row col-md-12  d-flex ">
                  <div class="col-md-12 pl-0 pt-1 d-flex" id="nom">
                   <div class="form-check-inline col-lg-4">
                    <input class="form-check-input ml-2" type="radio" name="sa_causa" id="sa_causa1" value="1" >
                    <label class="form-check-label label-custom-check" for="sa_causa1">
                      Enfermedad
                    </label>
                   </div>
                   <div class="form-check-inline col-lg-4">
                    <input class="form-check-input ml-2" type="radio" name="sa_causa" id="sa_causa2" value="2" >
                    <label class="form-check-label label-custom-check" for="sa_causa2">
                      Sin dificultad
                    </label>
                   </div>
                   <div class="form-check-inline col-lg-4">
                    <input class="form-check-input ml-2" type="radio" name="sa_causa" id="sa_causa3" value="3" >
                    <label class="form-check-label label-custom-check" for="sa_causa3">
                      Accidente
                    </label>
                   </div>
                  </div>
             </div>

             <div class="row col-md-12  d-flex ">
                  <div class="col-md-12 pl-0 pt-1 d-flex" id="nom">
                   <div class="form-check-inline col-lg-4">
                    <input class="form-check-input ml-2" type="radio" name="sa_causa" id="sa_causa4" value="4" >
                    <label class="form-check-label label-custom-check" for="sa_causa4">
                      Congénita
                    </label>
                   </div>
                   <div class="form-check-inline col-lg-4">
                    <input class="form-check-input ml-2" type="radio" name="sa_causa" id="sa_causa5" value="5" >
                    <label class="form-check-label label-custom-check" for="sa_causa5">
                      Edad
                    </label>
                   </div>
                   <div class="form-check-inline col-lg-4">
                    <input class="form-check-input ml-2" type="radio" name="sa_causa" id="sa_causa6" value="6" >
                    <label class="form-check-label label-custom-check" for="sa_causa6">
                      Otra
                    </label>
                   </div>
                  </div>
             </div>

             <div class="row col-md-12  mb-3 d-flex ">
                  <div class="col-md-12 pl-0 pt-1 d-flex" id="nom">
                   <div class="form-check-inline col-lg-4">
                    <input class="form-check-input ml-2" type="radio" name="sa_causa" id="sa_causa7" value="7" >
                    <label class="form-check-label label-custom-check" for="sa_causa7">
                      Violencia
                    </label>
                   </div>
                  </div>
             </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label-custom" for="sa_tratamientocual">Diagnóstico</label>
                    <textarea type="text" name="sa_diagnostico" id="sa_diagnostico" class="form-control form-control-custom street-names" placeholder="Escribe el diagnóstico" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
             <div class="row col-md-12  d-flex ">
                  <div class="col-md-8 mb-1 pt-1" id="nom">
                   <legend class="form-label-custom">¿Se indica tratamiento?</legend>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_indicatratamiento" id="sa_indicatratamiento1" value="1" >
                    <label class="form-check-label label-custom-check" for="sa_indicatratamiento">
                      si
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_indicatratamiento" id="sa_indicatratamiento0" value="0" >
                    <label class="form-check-label label-custom-check" for="sa_indicatratamiento0">
                      no
                    </label>
                   </div>
                  </div>
             </div>
             <div class="row col-md-12  d-flex ">
                  <div class="col-md-8 mb-1 pt-1" id="nom">
                   <legend class="form-label-custom">¿Se realiza canalización a servicio médico?  </legend>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_secanaliza" id="sa_secanaliza1" value="1" >
                    <label class="form-check-label label-custom-check" for="sa_secanaliza">
                      si
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_secanaliza" id="sa_secanaliza0" value="0" >
                    <label class="form-check-label label-custom-check" for="sa_secanaliza0">
                      no
                    </label>
                   </div>
                  </div>
             </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label-custom" for="sa_tratamientocuales">¿Cúal es?</label>
                    <textarea type="text" name="sa_secanalizacuales" id="sa_secanalizacuales" class="form-control form-control-custom street-names" placeholder="Escribe a cuál servicio médico" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label-custom" for="sa_observacionessalud">Observaciones</label>
                    <textarea type="text" name="sa_observacionessalud" id="sa_observacionessalud" class="form-control form-control-custom street-names" placeholder="Escribe las observaciones" maxlength="1000" value="" ></textarea>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
              </form>
              <form id="f_salud_sustancias" >
                 <div class="Lugar-de-imparticin mt-2 mb-2">3. Relación con las sustancias psicoactivas</div>
             <div class="incisos">a) Abuso y dependencia de alcohol y otras sustancias</div>
        <div class="row pl-3">
          <div class="col-md-12 mb-3" id="nom">
           <legend class="form-label-custom">¿En los últimos 12 meses, tomó alguna de estas sustancias, en más de una ocasión, para sentirse mejor o para cambiar su estado de ánimo?</legend>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="sa_tomodrogas" id="sa_tomodrogas1" value="1" >
            <label class="form-check-label label-custom-check" for="sa_tomodrogas1">
              Si
            </label>
           </div>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="sa_tomodrogas" id="sa_tomodrogas0" value="0" >
            <label class="form-check-label label-custom-check" for="sa_tomodrogas0">
              No
            </label>
           </div>
          </div>
        </div>

             <div class="row col-md-12 mb-2">
               <div class="col-md-4 ">
                  <label class="form-label-custom" for="sa_idtiposustancia">Tipo de sustancia:</label>
                  <select class="form-control form-control-custom" id="sa_idtiposustancia" name="sa_idtiposustancia" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['tiposustancias'] as $tipo)
                          <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Selecciona una opción
                  </div>
               </div>
                  <div class="col-md-4 ">
                    <label class="form-label-custom" for="delito">Edad de inicio:</label>
                    <input type="text" name="delito" id="delito" class="form-control form-control-custom numbers" placeholder="00" maxlength="2" value="" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

               <div class="col-md-4 ">
                  <label class="form-label-custom" for="idtipodesituacion">Frecuencia:</label>
                  <select class="form-control form-control-custom" id="sa_idfrecuencia" name="sa_idfrecuencia" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['frecuencias'] as $tipo)
                          <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Selecciona una opción
                  </div>
               </div>
             </div>
             <div class="row col-md-12 mb-2">
                  <div class="col-md-12 ">
                    <label class="form-label-custom" for="sa_cuando">Cuándo fue el primer contacto con la sustancia:</label>
                    <input type="text" name="delito" id="sa_cuando" class="form-control form-control-custom numbers" placeholder="Escribe cuando" maxlength="100" value="" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
             </div>

             <div class="row col-md-12 mb-3">
                  <div class="col-md-6">
                    <label class="form-label-custom" for="sa_tiempo">Tiempo de uso:</label>
                    <input type="text" name="sa_tiempo" id="sa_tiempo" class="form-control form-control-custom numbers" placeholder="Escribe tiempo de uso" maxlength="100" value="" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-6 mb-1 pt-1" id="nom">
                   <legend class="form-label-custom">¿Ha tratado de reducir o dejar su consumo?</legend>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_intentado" id="sa_intentado1" value="1" >
                    <label class="form-check-label label-custom-check" for="sa_intentado1">
                      si
                    </label>
                   </div>
                   <div class="form-check-inline">
                    <input class="form-check-input ml-2" type="radio" name="sa_intentado" id="sa_intentado0" value="0" >
                    <label class="form-check-label label-custom-check" for="sa_intentado0">
                      no
                    </label>
                   </div>
                  </div>
             </div>
             <div class="incisos">b) Experiencias terapéuticas para la atención de farmacodependencias</div>
             <div class="row col-md-12 mb-2">
               <div class="col-md-4 ">
                  <label class="form-label-custom" for="sa_idtipodeatencion">Tipo de atención:</label>
                  <select class="form-control form-control-custom" id="sa_idtipodeatencion" name="sa_idtipodeatencion" required>
                      <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['tipodeatenciones'] as $tipo)
                          <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">
                    Selecciona una opción
                  </div>
               </div>
                  <div class="col-md-8 ">
                    <label class="form-label-custom" for="sa_duracion">Duración de la experiencia:</label>
                    <input type="text" name="sa_duracion" id="sa_duracion" class="form-control form-control-custom numbers" placeholder="00" maxlength="2" value="" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
             </div>
        <div class="row pl-3">
          <div class="col-md-12 mb-3" id="nom">
           <legend class="form-label-custom">Reincidencia en el consumo</legend>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="sa_recaido" id="sa_recaido1" value="1" >
            <label class="form-check-label label-custom-check" for="sa_recaido1">
              Si
            </label>
           </div>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="sa_recaido" id="sa_recaido0" value="0" >
            <label class="form-check-label label-custom-check" for="sa_recaido0">
              No
            </label>
           </div>
          </div>
        </div>
             <div class="incisos">c) Observaciones</div>
        <div class="row mb-4 ml-1">
            <div class="col-md-12">
               <textarea type="text" class="form-control form-control-custom street-names" id="sa_observacionesdrogas" maxlength="1000" placeholder="La persona entrevistadora deberá indagar si el tema de consumo es un acto permitido y/o normalizado dentro del núcleo familiar, las actitudes o acciones que los integrantes de la familia han realizado con respecto al tema.  De igual manera se deberá describir la representación social que tiene el usuario/a sobre “consumir” beneficios/problemas, etc. " ></textarea>
               <div class="invalid-feedback">
                           Asegúrate de introducir la información correctamente
               </div>
             </div>
        </div>






              </form>

            </div> <!-- Finaliza tab-Panel educacion -->

      </div>



          </div> <!-- Cierra tabContent -->
        </div> <!-- Cerrar columna derecha -->
       </div> <!-- termina flexbox -->
      </div> <!-- Cerrar contenido -->
    </section>
  </main>
  @endsection
