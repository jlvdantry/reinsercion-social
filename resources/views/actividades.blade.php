<!DOCTYPE html>
@extends('layouts.layout')
@section('content')

  <main id="actividades">
    <section class="container">
      <div class="d-flex justify-content-between mt-3  align-items-center">
           <div class="Usuarios mb-0">Catálogo de actividades</div>
      </div>

      <form class="seccion" action="index.html" method="post">
        <div class="row d-flex align-items-center">
          <div class="col-md-10 mb-3">
            <label class="form-label-custom" for="descripcion">Busqueda por nombre</label>
            <input autofocus type="text" class="form-control form-control-custom" name="descripcionb" value="" placeholder="Escribe el nombre de la actividad" id="descripcionb" >
          </div>

          <div class="col-md-2 mt-lg-3">
            <button class="btn-01 py-2 px-0 mb-lg-3 mb-0 w-100" type="submit" name="buscar" id="buscar">Buscar</button>
          </div>
        </div>
      </form>

      <div class="overflow-auto">
        <table id="dg_usuarios" class="tabla seccion mt-0">
        </table>
      </div>

      <div class="d-flex justify-content-between mt-3  align-items-center">
           <div class="Usuarios mb-0">Alta de grupo</div>
      </div>
      <form id="altaga" class="seccion mt-0" action="index.html" method="post">
        <div class="row d-flex align-items-center">
          <div class="col-md-3 mb-3">
            <label class="form-label-custom" for="descripcion">Grupo</label>
              <select class="form-control form-control-custom" name="perfiles" id="perfiles">
                <option value="" selected value="" >Seleccione uno </option>
                      @foreach ($perfiles as $perfil)
                      <option value="{{ $perfil['id'] }}">{{ $perfil->descripcion}}</option>
                      @endforeach

              </select>
          </div>
          <div class="col-md-3 mb-3">
            <label class="form-label-custom" for="descripcion">Nombre de actividad</label>
            <input autofocus type="text" class="form-control form-control-custom" name="descripcion" value="" placeholder="Escribe el nombre del nuevo grupo" id="descripcion" >
          </div>

          <div class="col-md-2 mt-lg-3">
            <button class="btn-01 py-2 px-0 mb-lg-3 mb-0 w-100" type="submit" name="crear" id="crear">Crear</button>
          </div>
        </div>
      </form>


    </section>
  </main>
  @endsection
