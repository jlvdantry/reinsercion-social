
     if ($('main')[0].id=='restaura') {
        $("#btn_restaura").click(function(e){
             e.preventDefault();
             if ($('#password')[0].value=='') {
                crearMensaje(true,"Atención", ' Debe teclear su nueva contraseña');
                return;
             }
             if ($('#password_confirmation')[0].value=='') {
                crearMensaje(true,"Atención", ' Debe teclear la confirmación de su nueva contraseña');
                return;
             }
             if ($('#password')[0].value!=$('#password_confirmation')[0].value) {
                crearMensaje(true,"Atención", ' No coinciden las contraseñas');
                return;
             }

             console.log('Entró en olvido contraseña');
             var Data1 = {
                     cambiocontra: window.location.pathname.substr(window.location.pathname.indexOf('restaura')+9),
                     password: $('#password')[0].value,
                     password_confirmation: $('#password_confirmation')[0].value,
                     //api_token: document.head.querySelector('meta[name="api_token"]').content

             };
                  var uri = location.href.substr(0,(location.href.indexOf('public')+7))+'api/restacontra';
                  $.ajax({
                      type: 'post',
                      url: uri,
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: Data1,
                      success: function(data){
                                    crearMensaje(false,"Atención", ' Se cambió su contraseña');
                                    location.href = base_url+"/cambio-contra";
                                    return;
                                },
                      error: function( jqXhr, textStatus, errorThrown ){
                             if (typeof(jqXhr.responseJSON)=='object') {
                                var errores=jqXhr.responseJSON.errors;
                                for (var x in errores) {
                                    crearMensaje(true,"Error ", errores[x]);
                                    break;
                                }
                             } else {
                               crearMensaje(true,"Error ", jqXhr.responseJSON);
                             }
                      }
                 });
        });
     }

