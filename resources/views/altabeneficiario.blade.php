@extends('layouts.layout')
@section('content')

  <main id="notienecuenta" >
    <section id="alcaldia-container" class="container">
      <div class="Usuarios mb-0">Alta de beneficiario</div>
      <p>Los campos marcados con asterisco son obligatorios</p>
      <form class="needs-validation-alcaldia seccion" novalidate>
        <div class="row">
          <div class="col-md-12 mb-3" id="nom">
           <legend class="form-label-custom">Tipo de alta:</legend>
           <div class="form-check-inline col-md-4 ">
            <input class="form-check-input ml-2" type="radio" name="tipodealta" id="pes" value="1" checked>
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
                    <label class="form-label-custom" for="be_curp">*CURP:</label>
                    <input class="form-control form-control-custom" type="text" name="be_curp" id="be_curp" value="" placeholder="AAAA112233BCD22" pattern="^([A-ZÑ\x26]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])(M|H)([A-ZÑx26]{2})([A-ZÑx26]{3})(\d{2}))?$" maxlength="18" required>
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
            <label class="form-label-custom" for="puesto" >*Puesto:</label>
            <input autofocus type="text" class="form-control form-control-custom names" id="puesto" maxlength="50" placeholder="Escribe el puesto" required>
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4 mb-3" id="apa">
            <label class="form-label-custom " for="num_telefono">*Télefono:</label>
            <input type="text" class="form-control form-control-custom numer" id="num_telefono" maxlength="10" placeholder="55 5555 5555" required>
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="alc-email">*Email:</label>
            <input type="email" class="form-control form-control-custom" id="alc-email" placeholder="correo@dominio.com" required>
            <div class="invalid-feedback">
              Asegúrate de introducir correctamente tu correo electrónico
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="alc-email-confirma">*Confirmar email:</label>
            <input type="text" class="form-control form-control-custom" id="alc-email-confirma" placeholder="correo@dominio.com" required>
            <div class="invalid-feedback">
              Asegúrate de introducir correctamente tu correo electrónico
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="alc-password">Contraseña*</label>
            <input type="password" class="form-control form-control-custom" id="alc-password" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;" minlength="8" max-maxlength="30" required>
            <div class="invalid-feedback">
              La contraseña debe tener por lo menos ocho dígitos
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="alc-password_confirma">Confirmación contraseña*</label>
            <input type="password" class="form-control form-control-custom" id="alc-password_confirma" placeholder="Escribe tu contraseña de nuevo" required>
            <div class="invalid-feedback">
              Asegúrate introducir correctamente la contraseña establecida
            </div>
          </div>
        </div>



        <div class="row">
{{--
          <div class="col-md-4 mb-3">
            <label class="form-label-custom" for="idperfil">*Tipo de usuario:</label>
            <select class="form-control form-control-custom" id="idperfil" name="idperfil" required>
              <option disabled value="" selected hidden>Selecciona una</option>
                      @foreach ($perfiles as $perfil)
                      <option value="{{ $perfil->id }}">{{ $perfil->descripcion }}</option>
                      @endforeach
            </select>
            <div class="invalid-feedback">
              Selecciona una opción
            </div>
          </div>
--}}
          <div class="col-md-4 mb-3" id="nom">
            <label class="form-label-custom" for="idperfiltallerista" >Perfil:</label>
            <input autofocus type="text" class="form-control form-control-custom names" id="idperfiltallerista" maxlength="50" placeholder="Escribe el perfil" >
            <div class="invalid-feedback">
              Asegúrate de introducir la información correctamente
            </div>
          </div>
          <div class="col-md-4 mb-3" id="nom">
           <legend class="form-label-custom">Estatus:</legend>
           <div class="form-check-inline">
            <label class="form-check-label label-custom-check" for="activo">
              Activo
            </label>
            <input class="form-check-input ml-2" type="radio" name="activo" id="activo" value="1" checked>
           </div>
           <div class="form-check-inline">
            <label class="form-check-label label-custom-check" for="inactivo">
              Inactivo
            </label>
            <input class="form-check-input ml-2" type="radio" name="activo" id="inactivo" value="0" >
           </div>

          </div>



        </div>

        <div class="contenedor-boton justify-content-center seccion">
          <div class="btn-01" name="button" id="creacuenta-usuario" >Guardar</div>
        </div>
      </form>
    </section>
  </main>
  @endsection
