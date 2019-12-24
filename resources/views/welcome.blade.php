<!DOCTYPE html>
@extends('layouts.layout')
@section('content')

  <main id="ingreso" class="" >
  <div class="container Rectangle-Copy-img d-flex justify-content-center align-items-center">
            <img class="Rectangle-Copy mt-2 mb-2" src="{{url('')}}/src/img/Group 23.svg" alt="">
  </div>
  <div class="container coolaborador coolaborador d-flex align-items-center justify-content-center">
     <div class="Si-eres-colaborador">
Si eres colaborador del Instituto de Reinserción Social ingresa aquí
     </div>
  </div>

    <div class="container mt-lg-5 mt-md-3">
      <div class="d-flex justify-content-around align-items-center">
          <div class="col-lg-12 ">
          <form class="needs-validation seccion mb-0" novalidate>
           <div class="row col-lg-12 justify-content-center align-items-center">

            <div class="col-lg-3">
               <label class="form-label-custom" for="email">Usuario</label>
               <input type="mail" class="form-control form-control-custom" id="email" placeholder="correo@dominio.com" autofocus required>
               <div class="invalid-feedback">
                  El correo electrónico no es válido
               </div>
            </div>


            <div class="col-lg-3">
              <label class="form-label-custom" for="password">Contraseña</label>
               <input type="password" class="form-control form-control-custom bg-transparent" id="password" placeholder="Escribe tu contraseña" required>
               <div class="invalid-feedback">
                Asegúrate de introducir correctamente tu contraseña
               </div>
            </div>

            <div class="col-lg-2">
              <div class="">
              <button class="btn-01" type="submit" name="button" id="login">Entrar</button>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
          <div class="col-lg-12 d-flex justify-content-between">
             <div class="offset-lg-4 col-lg-3 enlaces-ingreso d-flex justify-content-end">
              <a href="#" id="olvidocontra" class="Olvidaste-tu-contra">¿Olvidaste tu contrase&#241;a?</a>
             </div>
          </div>

  </main>
  @endsection
