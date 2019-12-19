<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="{{ url('dist/app.css') }}">
  <title>Ingreso de Programas Internos de Protección Civil</title>
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
        <td><img style="padding: 2rem; max-width: 100%;" src="{{ url('src/img/logo-juzgados-civicos.svg') }}" alt=""></td>
      </tr>


      <tr>
        <td><h2 style="padding: 0 2rem; margin:0; color: #0f4c42; font-size: 1.3rem; margin-top: 0;">
          Estimado <span>{{$user->nombres.' '.$user->ape_pat.' '.$user->ape_mat}}</span>,</h2></td>
      </tr>

      <tr>
        <td><h1 style="padding: 0 2rem; margin:0; color: #00b140; text-align: center; margin-top: 0; font-size: 2rem;">Ha solicitado un cambio de contraseña</h1></td>
      </tr>


          <tr><td>
            <p style="padding: 2rem 2rem 0; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Nombre: <span style="font-weight: normal;">{{$user->nombres}}</span> </p>

            <p style="padding: 0 2rem; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Apellido paterno: <span style="font-weight: normal;">{{$user->ape_pat}}</span> </p>
            <p style="padding: 0 2rem; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Apellido materno: <span style="font-weight: normal;">{{$user->ape_mat}}</span> </p>
            <p style="padding: 0 2rem; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Juzgado: <span style="font-weight: normal;">{{$user->desjuzgado}}</span></p>
            <p style="padding: 0 2rem; font-size: .9rem; color: #5d5d5d; text-align: left; font-weight: bold;">Juzgado dirección: <span style="font-weight: normal;">{{$user->dirjuzgado}}</span></p>
          </td>
        </tr>

        <!-- Tabla anidada -->

        <tr>
          <td>
            <table style="background-color: #f0f0f0;border-radius: .8rem; margin: 2rem auto; width: 80%">
                <tbody>
                  <tr>
                    <td><h3 style="color: #0f4c42; font-size: 1rem; font-weight: bold; text-align: center; padding: 1.5rem 1.5rem .5rem; margin: 0;">Información importante </h3></td>
                  </tr>

                  <tr>
                    <td><p style="font-size: .9rem; font-weight: bold; line-height: 1.4rem; padding: .5rem 1.5rem .5rem; text-align: center; text-decoration: none; color: #5d5d5d; line-height: 1rem;">En caso de haber solicitado el cambio de contraseña, favor de hacer clic en el siguiente botón</p></td>
                  </tr>
                  <tr>
                    <td style="text-align: center; padding: .5rem 1rem 1rem;">
                      <a style="display: inline-block; background-color: #00b140; border-radius: .5rem; padding: .8rem 2.5rem; font-size: .875rem; line-height: 1.1875rem; color: white; font-weight: bold; text-align: center; margin: .5rem 0; text-decoration:none;" href="{{ url('').'/restaura/'.$user->cambiocontra }}" target="_blank">Da clic aquí</a>
                    </td>
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
                        <p style="font-size: .7rem; line-height: .75rem; color: #fff; margin-bottom: 0;">Nueva Cultura Cívica de la Ciudad de México</p>
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
                        <p style="font-size: .7rem; line-height: .75rem; color: #fff; margin-bottom: 0;">Nueva Cultura Cívica de la Ciudad de México</p>
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
