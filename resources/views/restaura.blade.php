@extends('layouts.layout')
@section('content')
  <div class="pleca">
  </div>

  <main id="restaura">
    <div class="container mt-lg-5">
      <div class="row d-flex justify-content-around align-items-center">
        <div class="col-lg-8">
          <h1 class="text-center text-lg-left">Sistema de Información y Seguimiento del Instituto de Reinserción Social de la Ciudad de México</h1>
        </div>

        <div class="col-lg-4">
          <form class="needs-validation seccion" novalidate>

            <label class="form-label-custom" for="password">Contraseña nueva</label>
            <input autofocus type="password" class="form-control form-control-custom" id="password" placeholder="Escriba su nueva contraseña" required>
            <div class="invalid-feedback">
              La nueva contraseña no es válida
            </div>


            <label class="form-label-custom" for="password">Confirma tu contraseña nueva</label>
            <input type="password" class="form-control form-control-custom" id="password_confirmation" placeholder="Escribe de nuevo su contraseña " required>
            <div class="invalid-feedback">
              Asegúrate de introducir correctamente tu contraseña
            </div>

          </form>
        </div>
      </div>
            <div class="contenedor-boton justify-content-end seccion">
              <button class="btn-01" type="submit" name="button" id="btn_restaura">Aceptar</button>
    </div>
  </main>
  @endsection
