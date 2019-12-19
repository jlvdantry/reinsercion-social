<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
        <td><img style="padding: 2rem; max-width: 100%;" src="{{ url('src/img/logo-encabezado.svg') }}" alt=""></td>
      </tr>

        <!-- Tabla anidada -->

        <tr>
          <td>
            <table style="background-color: #fff; border: solid 1px #00b140; border-radius: .8rem; padding: 1.5rem; margin: auto; width: 80%">
                <tbody>

                  <tr>
                    <td>
                      <h1 style="padding: 0 2rem; margin:0; color: #00b140; text-align: center; margin-top: 0; font-size: 2rem;">Notificación de Registro</h1>
                      <p style="font-size: .9rem; font-weight: 400; text-align: left; text-decoration: none; color: #5d5d5d; line-height: 1.4rem;">En atención a su solicitud de registro de <b>Programa Interno de Protección Civil</b>, y una vez que fue presentada la información y documentación necesaria para su realización de conformidad con lo establecido en los artículos <b>56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 71, 71, de la Ley de Gestión Integral de Riesgos y Protección Civil, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55 y 56</b> de su Reglamento, Términos de Referencia y demás disposiciones legales aplicables, relativo al establecimiento denominado

                      
                      <b>{{ $inmueble->alias }}</b> ubicado en
                      <b> {{ $inmueble->calle.' '.$inmueble->exterior.' '.$inmueble->interior.' '.$inmueble->colonia }} </b>
                      

                      el mismo <b>ha sido registrado en la Plataforma Digital de Programa Interno de Protección Civil</b>, cumpliendo con lo establecido en los artículos 66 de la Ley de Gestión Integral de Riesgos y Protección Civil, 40 de su Reglamento, y demás aplicables.</p>

                      <p style="font-size: .9rem; font-weight: 400; text-align: left; text-decoration: none; color: #5d5d5d; line-height: 1.4rem;">Asimismo, para la revalidación del Programa Interno de Protección Civil, <b>deberá apegarse a lo establecido por el artículo 56</b> de la Ley de Gestión Integral de Riesgos y Protección Civil.</p>

                      <p style="font-size: .9rem; font-weight: 400; text-align: left; text-decoration: none; color: #5d5d5d; line-height: 1.4rem;">Finalmente, los Programas Internos deberán actualizarse en un plazo <b>no mayor a 30 días hábiles contados a partir de la realización de la modificación</b>, cuando se modifique el Comité Interno, existan riesgos internos o externos diferentes a los ya analizados, nombre, denominación o razón social, giro o actividad económica, tecnología utilizada o procesos de producción, así como cuando existan modificaciones estructurales en el inmueble, siendo la autoridad competente quien realizará la revisión y, en su caso, dará por atendida la actualización del programa.
                    </p></td>
                  </tr>

                  <tr>
                    <td style="text-align:center; font-size: .9rem; font-weight: bold; text-decoration: none; color: #5d5d5d; line-height: 1.4rem;">Folio No. SGIRPC-PIPC-<span>{{ $inmueble->id }} </span>-<span> {{ substr($inmueble->updated_at,0,4) }} </span></td>
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
                        <p style="font-size: .7rem; line-height: .75rem; color: #fff; margin-bottom: 0;">Plataforma Digital para Ingreso del Programa Interno de Protección Civil</p>
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
