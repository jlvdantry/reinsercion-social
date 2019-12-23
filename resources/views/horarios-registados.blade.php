<!DOCTYPE html>
@extends('layouts.layout')
@section('content')

  <main id="horarios">
    <section class="container">
      <div class="d-flex justify-content-between mt-3  align-items-center">
           <div class="Usuarios mb-0">Horarios</div>
           <div id="crearexpediente">
                 {{-- <label class="Nuevo-usuario mb-0 py-2" name="button" id="nuevousuario">Nuevo usuario</label> --}}
                 <a href="./altahorario" >Nuevo horario</a>
                 <img class="Crear-expediente-svg" type="img" src="https://adipjc.soluint.com/public/src/img/agregarexpediente.svg">
            </div>
      </div>

      <form class="seccion" action="index.html" method="post">
        <div class="row d-flex align-items-center">
          <div class="col-md-7 mb-3">
            <label class="form-label-custom" for="nombre_solicitante">Búsqueda por nombre de actividad</label>
            <input autofocus type="text" class="form-control form-control-custom" name="nombre_solicitante" value="" placeholder="Escribe el nombre de la actividad" id="descripcion" >
          </div>

          <div class="col-md-3 mb-3 ">
            <label class="form-label-custom" for="estatus">Búsqueda por Estatus</label>
              <select class="form-control form-control-custom" name="estatus" id="estatus">
                <option value="" selected="selected">Selecciona </option>
                <option value="0" >Inactivo</option>
                <option value="1">Activo</option>
              </select>
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

    </section>
  </main>
  @endsection
