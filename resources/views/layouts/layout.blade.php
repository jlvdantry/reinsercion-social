<!DOCTYPE html>
<html class="html-custom" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="content-language" content="es-MX">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>SIRS</title>
        <link rel="shortcut icon" href="{{url('')}}/src/img/favicon.png" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="{{url('')}}/dist/app.css">
    </head>
    <body class="body-custom">
      <header class="container my-3">
        <div class="row d-flex justify-content-between mx-0 align-items-center">
         <div class="d-flex align-items-center" >
          <div class="imagen-encabezado">
            <a href="{{url('')}}"><img src="{{url('')}}/src/img/logo_header.svg" alt="Logotipo del Gobierno de la Ciudad de México"></a>
          </div>
          <div class="SISTEMA-DEL-INSTITUT ml-1">
SISTEMA DE INFORMACIÓN Y SEGUIMIENTO DEL INSTITUTO<br>
DE REINSERCIÓN SOCIAL DE LA CIUDAD DE MÉXICO
          </div>
         </div>
        @if (Auth::check())
          <div class="col-lg-4 datos-usuario">
              <a class="usuario dropdown-toggle" href="#" id="menu_usuario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <img src="{{url('')}}/src/img/usuario.svg" alt="">
                 <!-- <p class="nombre-usuario" id="nombre-usuario">{{{ Auth::user()->nombres }}}</p> -->
                 <p class="nombre-usuario" id="nombre-usuario" data-email='{{{ Auth::user()->email }}}' >{{{ Auth::user()->nombres }}}</p>
              </a>
              <p>{{{ Auth::user()->getperfiles()->desperfil }}}</p>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menu_usuario">
                  <a class="dropdown-item-custom" href="{{ url('') }}/editar_perfil/{{{ Auth::user()->id }}}">Mi perfil</a>
                  <a class="dropdown-item-custom" href="{{ url('') }}">Cerrar sesión</a>
              </div>
           </div>
          </div>
        @endif
      </header>
  <div class="pleca mb-2">
    <div class="container justify-content-between">
      @if (Auth::check())
     <div class="pl-0 d-flex col-lg-12">
        <div class="pl-0 pr-0 col-lg-3 d-flex justify-content-between align-items-center ">
           <div class="boton-regresar d-none">
                <a id="boton-regresar" href="./usuarios-registrados"><img src="src/img/flecha-before.svg" alt=""> Regresar</a>
           </div>
        </div>
        <div class="col-lg-9 d-flex justify-content-end">
         <ul class="nav justify-content-end">
          @foreach (Auth::user()->getmenuspadres(Auth::user()->getperfiles()->idperfil) as $menu)
             <li class="nav-item dropdown">
                <a {{ $menu->idh!='' ? 'id='.$menu->idh : '' }} 
                    @if ($menu->componente=='') 
                          class="nav-link dropdown-toggle Padres" 
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                          href="#"
                    @else
                          class="nav-link Padres" 
                          href="{{ url('').'/'.$menu->componente }}"
                    @endif
                    >
                   {{ $menu->desmenu }}  
                </a>
                @if ($menu->componente=='')
                    <div class="dropdown-menu">
                    @foreach (Auth::user()->getmenushijos(Auth::user()->getperfiles()->idperfil,$menu->idmenu) as $menuh)
                       <a {{ $menuh->id!='' ? 'id='.$menuh->id : '' }}
                          class="dropdown-item Hijos"
                          href="{{ url('') }}/{{ $menuh->componente }}">{{ $menuh->desmenu }}
                      </a>
                    @endforeach
                    </div>
                @endif
             </li>
          @endforeach
         </ul>
        </div>
      @endif
     </div>
    </div>
  </div>
            @yield('content')
            <!-- Modal messages -->
            <div class="modal fade" id="msgModal" tabindex="-1" role="dialog" data-focus=false aria-labelledby="titleMsgModal" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header pb-0">
                    <h1 class="modal-title" id="titleMsgModal"></h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div id="bodyMsgModal" class="modal-body"></div>
                  <div class="modal-footer pt-0 d-none" id='d_siacepto' >
                            <button type="button" class="btn btn-02" data-dismiss="modal" id='siacepto' >Aceptar</button>
                  </div>
                </div>
              </div>
            </div>
  <!-- Modal -->
  <div class="modal fade" id="modalAviso" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body pb-0">
          <h1 class="mt-1">Información importante</h1>
          <p class="text-md-left"><b>Bajo protesta de decir verdad</b>, en mi calidad de Tercero Acreditado con número de registro para tal efecto, manifiesto que <b>la información y documentación ingresada para el registro en la Plataforma Digital de Programa Interno de Protección Civil, es verídica,</b> de conformidad con los artículos <b>66 de la Ley de Gestión Integral de Riesgos y Protección Civil, 40 de su Reglamento, y demás relativos y aplicables</b>.</p>
          <p class="text-md-left mt-3">Tengo conocimiento de que dicha información podrá ser verificada en cualquier momento y servirá de base para la realización de la visita de verificación administrativa en términos <b>del 97, 98, 99, 100, 101, 102, 103, 104 y 105 de la Ley de Procedimiento Administrativo de la Ciudad de México</b>.</p>
          <p class="text-md-left mt-3">Asimismo, soy sabedor de las sanciones y penas en que incurren las personas que declaran falsamente ante las autoridades, en términos de los artículos <b>234 de la Ley de Gestión Integral de Riesgos y Protección Civil, 225 de su Reglamento y 311 del Código Penal para el Distrito Federal</b>.</p>
          <div class="form-group form-check mt-3">
            <input type="checkbox" class="form-check-input" id="aviso-check">
            <label class="form-check-label label-custom-check mt-0" for="aviso-check">Estoy de acuerdo</label>
          </div>
        </div>
        <div class="modal-footer pt-0">
          <button type="button" class="btn btn-02" data-dismiss="modal" id='aviso-btn-accept' disabled>Aceptar</button>
        </div>
      </div>
    </div>
  </div>


            @include('layouts._footer')

            <script src="{{url('')}}/dist/app.js"></script>
            <script type="text/javascript">
                  var base_url = "{{url('')}}"
            </script>
    </body>
</html>
