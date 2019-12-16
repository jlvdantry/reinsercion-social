<!DOCTYPE html>
@extends('layouts.layout')
@section('content')

  <main id="ingreso" class="backlogin" >
    <div class="container mt-lg-5 mt-md-3">
      <div class="row d-flex justify-content-around align-items-center">
        <div class="col-lg-12 d-flex justify-content-center">
          <h1 class="text-center text-lg-left">Nueva Cultura Cívica de la Ciudad de México</h1>
          {{-- <h3>Si aún no has creado tu cuenta da <a href="./notienecuenta">clic aquí</a></h3> --}}
        </div>

        <div class="col-lg-12 d-flex justify-content-center pt-lg-5 pb-lg-5">
          <div class="col-lg-4 LoginRectangle">
          <form class="needs-validation seccion" novalidate>

            <label class="form-label-custom" for="email">Usuario</label>
            <input type="mail" class="form-control form-control-custom" id="email" placeholder="correo@dominio.com" autofocus required>
            <div class="invalid-feedback">
              El correo electrónico no es válido
            </div>


            <label class="form-label-custom" for="password">Contraseña</label>
            <input type="password" class="form-control form-control-custom bg-transparent" id="password" placeholder="Escribe tu contraseña de nuevo" required>
            <div class="invalid-feedback">
              Asegúrate de introducir correctamente tu contraseña
            </div>

            <div class="contenedor-boton justify-content-end seccion">
              <button class="btn-01" type="submit" name="button" id="login">Ingresar</button>
            </div>
            <div class="d-flex justify-content-between">
             <div class="enlaces-ingreso d-flex justify-content-end">
              <a href="./notienecuenta" >¿No tienes cuenta?</a>
             </div>
             <div class="enlaces-ingreso d-flex justify-content-end">
              <a href="#" id="olvidocontra" >¿Olvidaste tu contrase&#241;a?</a>
             </div>
            </div>
          </form>
         </div>
        </div>
      </div>
    </div>
  </main>
  @endsection
