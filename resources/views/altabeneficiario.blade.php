@extends('layouts.layout')
@section('content')

  <main id="altabeneficiario" >
    <section id="alcaldia-container" class="container">
      <div class="Usuarios mb-0">Alta de beneficiario</div>
      <p>Los campos marcados con asterisco son obligatorios</p>
      <form class="needs-validation-alcaldia seccion" novalidate>
        <div class="row">
          <div class="col-md-12 mb-3" id="nom">
           <legend class="form-label-custom">Tipo de alta:</legend>
           <div class="form-check-inline col-md-4 ">
            <input class="form-check-input ml-2" type="radio" name="tipodealta" id="pes" value="1" >
            <label class="form-check-label label-custom-check" for="pes">
              Persona egresada del Sistema de Justicia Penal
            </label>
           </div>
           <div class="form-check-inline col-md-4">
            <input class="form-check-input ml-2" type="radio" name="tipodealta" id="pc" value="0" >
            <label class="form-check-label label-custom-check" for="pc">
              Prevención en comunidades 
            </label>
           </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="idperfil">*Modalidad de acercamiento:</label>
            <select class="form-control form-control-custom" id="idacercamiento" name="idacercamiento" required>
              <option disabled value="" selected hidden>Selecciona uno</option>
                      @foreach ($data['acercamientos'] as $acercamiento)
                      <option value="{{ $acercamiento->id }}">{{ $acercamiento->descripcion }}</option>
                      @endforeach
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="identeros">*¿Cómo se enteró del Instituto o del programa?</label>
            <select class="form-control form-control-custom" id="identeros" name="identeros" required>
              <option disabled value="" selected hidden>Selecciona uno</option>
                      @foreach ($data['comoseenteros'] as $entero)
                      <option value="{{ $entero->id }}">{{ $entero->descripcion }}</option>
                      @endforeach
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
          <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="curp">*CURP:</label>
                    <input class="form-control form-control-custom" type="text" name="curp" id="curp" value="" placeholder="AAAA112233BCD22" pattern="^([A-ZÑ\x26]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])(M|H)([A-ZÑx26]{2})([A-ZÑx26]{3})(\d{2}))?$" maxlength="18" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir correctamente tu CURP
                    </div>
          </div>

        </div>


        <div class="Lugar-de-imparticin mt-3 mb-0">Datos generales</div>
        <div class="row">
          <div class="col-md-4 mb-3" id="nom">
            <label class="form-label-custom" for="alc-nombres" >*Nombre(s):</label>
            <input autofocus type="text" class="form-control form-control-custom names" id="alc-nombres" maxlength="50" placeholder="Escribe el nombre" required>
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4 mb-3" id="apa">
            <label class="form-label-custom" for="alc-ape_pat">*Primer apellido:</label>
            <input type="text" class="form-control form-control-custom names" id="alc-ape_pat" maxlength="30" placeholder="Escribe el primer apellido " required>
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4 mb-3" id="ama">
            <label class="form-label-custom" for="alc-ape_mat">Segundo apellido:</label>
            <input type="text" class="form-control form-control-custom names" id="alc-ape_mat" maxlength="30" placeholder="Escribe el segundo apellido">
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3" id="nom">
            <label class="form-label-custom" for="nacimiento" >*Fecha de nacimiento:</label>
            <input autofocus type="date" class="form-control form-control-custom " id="nacimiento" maxlength="10"  required>
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="idetnia">*Pertenencia étnica</label>
            <select class="form-control form-control-custom" id="idetnia" name="idetnia" required>
              <option disabled value="" selected hidden>Selecciona uno</option>
                      @foreach ($data['etnicas'] as $etnia)
                      <option value="{{ $entero->id }}">{{ $etnia->descripcion }}</option>
                      @endforeach
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="idestudio">*Grado máximo de estudios</label>
            <select class="form-control form-control-custom" id="idestudio" name="idestudio" required>
              <option disabled value="" selected hidden>Selecciona uno</option>
                      @foreach ($data['estudios'] as $estudio)
                      <option value="{{ $estudio->id }}">{{ $estudio->descripcion }}</option>
                      @endforeach
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="idetnia">*Ocupación</label>
            <select class="form-control form-control-custom" id="idocupacion" name="idocupacion" required>
              <option disabled value="" selected hidden>Selecciona uno</option>
                      @foreach ($data['ocupaciones'] as $ocupacion)
                      <option value="{{ $entero->id }}">{{ $ocupacion->descripcion }}</option>
                      @endforeach
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
          <div class="col-md-4 mb-3" id="nom">
           <legend class="form-label-custom">Sexo*:</legend>
           <div class="form-check-inline">
            <input class="form-check-input ml-2" type="radio" name="sexo" id="mas" value="M" >
            <label class="form-check-label label-custom-check" for="mas">
              Masculino
            </label>
           </div>
           <div class="form-check-inline">
            <input class="form-check-input ml-2" type="radio" name="sexo" id="fem" value="F" >
            <label class="form-check-label label-custom-check" for="fem">
              Femenino
            </label>
           </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="idestudio">*Lugar de registro</label>
            <select class="form-control form-control-custom" id="identidad" name="identidad" required>
              <option disabled value="" selected hidden>Selecciona uno</option>
                      @foreach ($data['entidades'] as $entidad)
                      <option value="{{ $entidad->id }}">{{ $entidad->descripcion }}</option>
                      @endforeach
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="idetnia">*Estado civil</label>
            <select class="form-control form-control-custom" id="idecivil" name="idecivil" required>
              <option disabled value="" selected hidden>Selecciona uno</option>
                      @foreach ($data['eciviles'] as $ecivil)
                      <option value="{{ $ecivil->id }}">{{ $ecivil->descripcion }}</option>
                      @endforeach
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
          <div class="col-md-2 mb-3">
                    <label class="form-label-custom" for="hijos">Número de hijos:</label>
                    <input class="form-control form-control-custom number" type="text" name="be_curp" id="hijos" value="" placeholder="00" maxlength="2" >
                    <div class="invalid-feedback">
                      Asegúrate de introducir correctamente tu CURP
                    </div>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label-custom" for="edades">Edad de los hijos (Escribe las edades separadas por comas):</label>
            <input class="form-control form-control-custom number" type="text" name="edades" id="edades" value="" placeholder="1,2,3,4" maxlength="50" >
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-3">
            <label class="form-label-custom" for="alias">Otro nombre o alias:</label>
            <input class="form-control form-control-custom names-all" type="text" name="alias" id="alias" value="" placeholder="Escribe el nombre o alias" maxlength="100" >
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
        </div>

        <div class="Lugar-de-imparticin mt-3 mb-0">Residencia en la Ciudad de México</div>

        <div class="row mt-2">
          <div class="col-md-12 mb-3" id="nom">
           <legend class="form-label-custom">*Tipo:</legend>
           <div class="form-check-inline col-md-2 ">
            <input class="form-check-input ml-2" type="radio" name="tiporesidencia" id="dp" value="1" >
            <label class="form-check-label label-custom-check" for="dp">
              Domicilio particular
            </label>
           </div>
           <div class="form-check-inline col-md-1">
            <input class="form-check-input ml-2" type="radio" name="tiporesidencia" id="ab" value="2" >
            <label class="form-check-label label-custom-check" for="ab">
              Albergue
            </label>
           </div>
           <div class="form-check-inline col-md-2">
            <input class="form-check-input ml-2" type="radio" name="tiporesidencia" id="sc" value="3" >
            <label class="form-check-label label-custom-check" for="sc">
              Situación de calle
            </label>
           </div>
          </div>
        </div>

                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="calle_b">Calle*:</label>
                    <input autofocus type="text" name="calle_b" id="calle_b" class="form-control form-control-custom street-names" maxlength="30" value="" placeholder="Escribe la calle" autofocus >
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="exterior_b">Numero exterior*:</label>
                    <input type="text" name="exterior_b" id="exterior_b" class="form-control form-control-custom street-names" maxlength="10" value="" placeholder="00" >
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="interior_b">Numero interior:</label>
                    <input type="text" name="interior_b" id="interior_b" class="form-control form-control-custom street-names" maxlength="10" value="" placeholder="00">
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="cp_b">Código postal*:</label>
                    <input type="text" name="cp_b" id="cp_b" class="form-control form-control-custom numbers" maxlength="5" value="" placeholder="00000" pattern="^[0-9]{4,5}$" >
                    <div class="invalid-feedback">
                      Ingresa los cuatro o cinco dígitos de tu código postal
                    </div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="colonia_b">Colonia*:</label>
                    <input type="text" name="colonia_b" id="colonia_b" class="form-control form-control-custom street-names" maxlength="30" value="" placeholder="Escribe la colonia" >
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="id_alcaldia_b">Alcaldía*:</label>
                    <select class="form-control form-control-custom" id="id_alcaldia_b" name="id_alcaldia_b" >
                      <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['alcaldias'] as $alcaldia)
                      <option value="{{ $alcaldia['id_cat_alcaldia'] }}">{{ $alcaldia->descripcion}}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">
                      Selecciona una opción
                    </div>
                  </div>
                </div>

        <div class="row">
          <div class="col-md-12 mb-3">
            <label class="form-label-custom" for="alias">Unidad territorial:</label>
            <input class="form-control form-control-custom names-all" type="text" name="unidad" id="unidad" value="" placeholder="Escribe la unidad territorial" maxlength="100" >
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
        </div>

        <div class="Lugar-de-imparticin mt-3 mb-0">Información de contacto del beneficiario</div>


        <div class="row">
          <div class="col-md-4 mb-3" id="apa">
            <label class="form-label-custom " for="telfijo">Télefono particular:</label>
            <input type="text" class="form-control form-control-custom numer" id="telfijo" maxlength="10" placeholder="55 5555 5555" >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4 mb-3" id="apa">
            <label class="form-label-custom " for="num_telefono">*Télefono celular:</label>
            <input type="text" class="form-control form-control-custom numer" id="num_telefono" maxlength="10" placeholder="55 5555 5555" >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="alc-email">*Email:</label>
            <input type="email" class="form-control form-control-custom" id="alc-email" placeholder="correo@dominio.com" >
            <div class="invalid-feedback">
              Asegúrate de introducir correctamente tu correo electrónico
            </div>
          </div>
        </div>

        <div class="Lugar-de-imparticin mt-3 mb-0">Personas de contacto o de confianza</div>

        <div class="row">
          <div class="col-md-4 mb-3" id="nom">
            <label class="form-label-custom" for="nombres_c" >Nombre:</label>
            <input autofocus type="text" class="form-control form-control-custom names" id="nombres_c" maxlength="50" placeholder="Escribe el nombre" >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4 mb-3" id="apa">
            <label class="form-label-custom" for="ttrentesco_c">Parentesco:</label>
            <input type="text" class="form-control form-control-custom names" id="parentesco_c" maxlength="30" placeholder="Escribe el parentesco " >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4 mb-3" id="apa">
            <label class="form-label-custom " for="tel_c">Télefono:</label>
            <input type="text" class="form-control form-control-custom numer" id="tel_c" maxlength="10" placeholder="55 5555 5555" >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
        </div>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="calle_c">Calle*:</label>
                    <input autofocus type="text" name="calle_c" id="calle_c" class="form-control form-control-custom street-names" maxlength="30" value="" placeholder="Escribe la calle" autofocus >
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="exterior_c">Numero exterior*:</label>
                    <input type="text" name="exterior_c" id="exterior_c" class="form-control form-control-custom street-names" maxlength="10" value="" placeholder="00">
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="interior_c">Numero interior:</label>
                    <input type="text" name="interior_c" id="interior_c" class="form-control form-control-custom street-names" maxlength="10" value="" placeholder="00">
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="cp_c">Código postal*:</label>
                    <input type="text" name="cp_c" id="cp_c" class="form-control form-control-custom numbers" maxlength="5" value="" placeholder="00000" pattern="^[0-9]{4,5}$" >
                    <div class="invalid-feedback">
                      Ingresa los cuatro o cinco dígitos de tu código postal
                    </div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="colonia_c">Colonia*:</label>
                    <input type="text" name="colonia_c" id="colonia_c" class="form-control form-control-custom street-names" maxlength="30" value="" placeholder="Escribe la colonia" >
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="id_alcaldia_c">Alcaldía*:</label>
                    <select class="form-control form-control-custom" id="id_alcaldia_c" name="id_alcaldia_c" >
                      <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['alcaldias'] as $alcaldia)
                      <option value="{{ $alcaldia['id_cat_alcaldia'] }}">{{ $alcaldia->descripcion}}</option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">
                      Selecciona una opción
                    </div>
                  </div>
                </div>




        <div class="d-flex justify-content-end">
          <div class="btn-01" name="button" id="crea-beneficiario" >Guardar beneficiario</div>
        </div>
      </form>
    </section>
  </main>
  @endsection
