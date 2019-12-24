@extends('layouts.layout')
@section('content')

  <main id="altahorario" >
    <section id="alcaldia-container" class="container">
      <div class="Usuarios mb-0">Alta de horarios</div>
      <p>Los campos marcados con asterisco son obligatorios</p>
      <form class="needs-validation-alcaldia seccion" novalidate>
        <div class="row">
          <div class="col-md-4 mb-3" id="nom">
            <label class="form-label-custom" for="alc-nombres" >*Grupo de actividades:</label>
            <select class="form-control form-control-custom" id="idgrupo" name="idgrupo" required>
              <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($data['grupos'] as $grupo)
                      <option value="{{ $grupo->id }}">{{ $grupo->descripcion }}</option>
                      @endforeach
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
          <div class="col-md-4 mb-3" id="apa">
            <label class="form-label-custom" for="alc-ape_pat">*Nombre de actividad:</label>
            <select class="form-control form-control-custom" id="idactividad" name="idactividad" required>
              <option disabled value="" selected hidden>Selecciona una</option>
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
          <div class="col-md-4 mb-3" id="ama">
            <label class="form-label-custom" for="alc-ape_mat">*Grupo:</label>
            <input type="text" class="form-control form-control-custom numbers"" id="grupo" maxlength="3" placeholder="00" required>
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4 d-flex justify-content-between align-items-center pr-0 pl-0 mb-3" id="nom">
           <div class="col-md-6">
            <label class="form-label-custom" for="horade" >*Horario / De:</label>
            <input autofocus type="text" class="form-control form-control-custom horas" id="horade" maxlength="5" placeholder="00:00" required
                              pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}">
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
           </div>
           <div class="col-md-6">
            <label class="form-label-custom" for="horahasta" >*A:</label>
            <input autofocus type="text" class="form-control form-control-custom horas" id="horahasta" maxlength="5" placeholder="00:00" required
                              pattern="([0-1]{1}[0-9]{1}|20|21|22|23):[0-5]{1}[0-9]{1}">
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
           </div>
          </div>

          <div class="col-md-4 mb-3" id="apa">
            <label class="form-label-custom " for="idtallerista">*Responsable:</label>
            <select class="form-control form-control-custom" id="idtallerista" name="idtallerista" required>
              <option disabled value="" selected hidden>Seleccione un responsable</option>
                      @foreach ($data['talleristas'] as $tallerista)
                      <option value="{{ $tallerista->id }}">{{ $tallerista->nombrecompleto }}</option>
                      @endforeach
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
          <div class="col-md-4 mb-3" id="ama">
            <label class="form-label-custom" for="cupo">*Cupo:</label>
            <input type="text" class="form-control form-control-custom numbers" id="cupo" maxlength="2" placeholder="00">
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>

        </div>

        <div class="row border-bottom">
          <div class="col-md-2 mb-3 d-flex">
           <div>
            <label class="form-label-custom" for="alc-email">*Número de sesiones:</label>
              <select class="form-control form-control-custom" name="sesiones" id="sesiones">
                <option value="" selected="selected">Selecciona </option>
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3">03</option>
                <option value="4">04</option>
                <option value="5">05</option>
                <option value="6">06</option>
                <option value="7">07</option>
                <option value="8">08</option>
                <option value="9">09</option>
                <option value="10">10</option>
              </select>
              </select>
           </div>
           <div class="Rectangle ml-4">
           </div>
          </div>
          <div class="col-md-2 mb-3" name="fechas">
            <label class="form-label-custom" for="fecha01">*Fecha de sesión 01:</label>
            <input type="date" name="diahechos" id="fecha01" min="{{ date('Y-m-d') }}" class="form-control form-control-custom street-names" maxlength="10" value="" >
            <div class="invalid-feedback">
              La fecha debe ser igual o mayor al dia de hoy
            </div>

          </div>
          <div class="col-md-2 mb-3" name="fechas">
            <label class="form-label-custom" for="fecha02">*Fecha de sesión 02:</label>
            <input type="date" name="diahechos" id="fecha02" class="form-control form-control-custom street-names" maxlength="10" value="" >
          </div>
          <div class="col-md-2 mb-3" name="fechas">
            <label class="form-label-custom" for="fecha03">*Fecha de sesión 03:</label>
            <input type="date" name="diahechos" id="fecha03" class="form-control form-control-custom street-names" maxlength="10" value="" >
          </div>
          <div class="col-md-2 mb-3" name="fechas">
            <label class="form-label-custom" for="fecha04">*Fecha de sesión 04:</label>
            <input type="date" name="diahechos" id="fecha04" class="form-control form-control-custom street-names" maxlength="10" value="" >
          </div>
          <div class="col-md-2 mb-3" name="fechas">
            <label class="form-label-custom" for="fecha05">*Fecha de sesión 05:</label>
            <input type="date" name="diahechos" id="fecha05" class="form-control form-control-custom street-names" maxlength="10" value="" >
          </div>
          <div class="col-md-2 mb-3" name="fechas">
            <label class="form-label-custom" for="fecha06">*Fecha de sesión 06:</label>
            <input type="date" name="diahechos" id="fecha06" class="form-control form-control-custom street-names" maxlength="10" value="" >
          </div>
          <div class="col-md-2 mb-3" name="fechas">
            <label class="form-label-custom" for="fecha07">*Fecha de sesión 07:</label>
            <input type="date" name="diahechos" id="fecha07" class="form-control form-control-custom street-names" maxlength="10" value="" >
          </div>
          <div class="col-md-2 mb-3" name="fechas">
            <label class="form-label-custom" for="fecha08">*Fecha de sesión 08:</label>
            <input type="date" name="diahechos" id="fecha08" class="form-control form-control-custom street-names" maxlength="10" value="" >
          </div>
          <div class="col-md-2 mb-3" name="fechas">
            <label class="form-label-custom" for="fecha09">*Fecha de sesión 09:</label>
            <input type="date" name="diahechos" id="fecha09" class="form-control form-control-custom street-names" maxlength="10" value="" >
          </div>
          <div class="col-md-2 mb-3" name="fechas">
            <label class="form-label-custom" for="fecha10">*Fecha de sesión 10:</label>
            <input type="date" name="diahechos" id="fecha10" class="form-control form-control-custom street-names" maxlength="10" value="" >
          </div>


        </div>
        <div class="Lugar-de-imparticin mt-3 mb-0">Lugar de impartición</div>
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="calle_h">Calle*:</label>
                    <input autofocus type="text" name="calle_h" id="calle_h" class="form-control form-control-custom street-names" maxlength="30" value="" placeholder="Escribe la calle" autofocus required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="exterior_h">Numero exterior*:</label>
                    <input type="text" name="exterior_h" id="exterior_h" class="form-control form-control-custom street-names" maxlength="10" value="" placeholder="00" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="interior_h">Numero interior:</label>
                    <input type="text" name="interior_h" id="interior_h" class="form-control form-control-custom street-names" maxlength="10" value="" placeholder="00">
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="cp_h">Código postal*:</label>
                    <input type="text" name="cp_h" id="cp_h" class="form-control form-control-custom numbers" maxlength="5" value="" placeholder="00000" pattern="^[0-9]{4,5}$" required>
                    <div class="invalid-feedback">
                      Ingresa los cuatro o cinco dígitos de tu código postal
                    </div>
                  </div>

                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="colonia_h">Colonia*:</label>
                    <input type="text" name="colonia_h" id="colonia_h" class="form-control form-control-custom street-names" maxlength="30" value="" placeholder="Escribe la colonia" required>
                    <div class="invalid-feedback">
                      Asegúrate de introducir la información correctamente
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-custom" for="id_alcaldia_h">Alcaldía*:</label>
                    <select class="form-control form-control-custom" id="id_alcaldia_h" name="id_alcaldia_h" required>
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
          <div class="col-md-4 mb-3" id="nom">
           <legend class="form-label-custom">Estatus:</legend>
           <div class="form-check-inline">
            <label class="form-check-label label-custom-check" for="estatus">
              Activo
            </label>
            <input class="form-check-input ml-2" type="checkbox" name="estatus" id="estatus" value="0" >
           </div>
          </div>
        </div>

        <div class="contenedor-boton justify-content-center seccion">
          <div class="btn-01" name="button" id="creahorario" >Guardar</div>
        </div>
      </form>
    </section>
  </main>
  @endsection
