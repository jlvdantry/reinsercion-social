<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    html{box-sizing: border-box;}
    html,body{margin: 0; padding: 0;}
    body{font-family: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;}

    *, *:before, *:after{box-sizing: inherit;}
    .container{max-width: 50rem;}

    .ocultar-sm{display: none;}
    .mostrar-sm{display: block;}

    @media screen and (min-width: 768px){
      .mostrar{display: block;}
      .ocultar{display: none;}
      }
      img{width: 100%;}
    @media (min-width: 768px){
      img{width: auto;}
      }
  </style>
</head>

<body style="background-color: #fafafa;">
  <table class="container" style="margin: 0 auto; background: #fff;">
    <tbody>
      <tr>
        <td><img style="padding: 2rem; max-width: 100%;" src="{{ url('src/img/logo-reinsercion.svg') }}" alt=""></td>
      </tr>


      <tr>
        <td><h1 style="padding: 0 2rem; margin:0; color: #00b140; text-align: center; margin-top: 0; font-size: 2rem;">¡Su registro se ha realizado exitosamente!</h1></td>
      </tr>
          <tr><td>
            <p style="padding: 2rem 2rem 0; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Nombre: <span style="font-weight: normal;">{{$user->nombres}}</span> </p>

            <p style="padding: 0 2rem; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Apellido paterno: <span style="font-weight: normal;">{{$user->ape_pat}}</span> </p>
            <p style="padding: 0 2rem; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Apellido materno: <span style="font-weight: normal;">{{$user->ape_mat}}</span> </p>
            <p style="padding: 0 2rem; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Puesto: <span style="font-weight: normal;">{{$user->puesto}}</span></p>
            <p style="padding: 0 2rem; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Télefono: <span style="font-weight: normal;">{{$user->num_telefono}}</span></p>
            <p style="padding: 0 2rem; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Tipo de usuario: <span style="font-weight: normal;">{{$user->desperfil}}</span></p>
          </td>
        </tr>

        <!-- Tabla anidada -->

        <tr>
          <td>
            <table style="background-color: #f0f0f0;border-radius: .8rem; padding: 1.5rem; margin: auto; width: 80%">
                <tbody>
                  <tr>
                    <td><h3 style="color: #0f4c42; font-size: 1rem; font-weight: bold; text-align: center; padding: .5rem 1.5rem .5rem; margin: 0;">Información importante </h3></td>
                  </tr>

                  <tr>
                    <td><p style="font-size: .9rem; font-weight: bold; text-align: center; text-decoration: none; color: #5d5d5d; line-height: 1.4rem;">Usted podra ingresar con sus datos al <a style="text-decoration: none; color: #00b140;" href="{{ url('/') }}">Sistema de información y seguimiento del instituto de reinserción social de la ciudad de méxcio.</a></p></td>
                  </tr>
                </tbody>
          </table>
        </td>
        </tr>
          <!-- Termina tabla anidada uno -->

          <!-- Inicia tabla anidada dos footer -->

          <!-- Oculta responsive muestra grande -->

          <tr class="ocultar-sm mostrar" style="background-color: #2e2e32; min-height: 4.625rem; bottom: 0; margin-top: 2rem; padding: 1rem;">
            <td>
              <table>
                  <tbody>
                    <tr>
                      <td><img src="{{ url('src/img/gobierno-y-adip.svg') }}" alt=""></td>
                      <td class="mostrar" style="color: #fff; margin-left: 1rem;">
                        <p style="font-size: .7rem; line-height: .75rem; color: #fff; margin-bottom: 0;">Sistema de información y seguimiento del instituto de reinserción social de la ciudad de méxico.</p>
                        <p style="font-size: .7rem; line-height: .75rem; color: #fff; margin-top:0; font-weight:bold;">Diseñado y operado por la Agencia Digital de Innovación Pública</p>
                      </td>
                    </tr>
                  </tbody>
              </table>
            </td>
          </tr>

          <!-- Oculta footer grande -->

          <tr class="ocultar mostrar-sm" style="background-color: #2e2e32; min-height: 4.625rem; bottom: 0; margin-top: 2rem; padding: 1rem;">
            <td>
              <table style="text-align:center;">
                  <tbody>
                    <tr>
                      <td><img src="{{ url('src/img/gobierno-y-adip.svg') }}" alt=""></td>
                    </tr>

                    <tr>
                      <td class="mostrar" style="color: #fff;">
                        <p style="font-size: .7rem; line-height: .75rem; color: #fff; margin-bottom: 0;">Plataforma Digital para Ingreso del Programa Interno de Protección Civil</p>
                        <p style="font-size: .7rem; line-height: .75rem; color: #fff; margin-top:0; font-weight:bold;">Diseñado y operado por la Agencia Digital de Innovación Pública</p>
                      </td>
                    </tr>
                  </tbody>
              </table>
            </td>
          </tr>

    </tbody>
  </table><!-- Termina tabla anidada dos -->

</body>
</html>
