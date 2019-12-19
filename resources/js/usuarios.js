     if ($('main')[0].id=='usuarios') {
        $("#nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#buscar").click(function(e){
             e.preventDefault();
             var Data1 = {
                  nombres: $('#nombres')[0].value,
                  email :  $('#email')[0].value,
                  idperfil :  $('#perfiles')[0].value,
                  activo :  $('#estatus')[0].value,
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/users',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                    var dis = { id : { header : 'id', 'class' : 'd-none' }
                                               , nombrecompleto : { header : 'Nombres', 'class' : '' }
                                               , email :  { header : 'Email', 'class' : '' }
                                               , desperfil : { header : 'Tipo de usuario', 'class' : '' }
                                               , created_at : { header : 'Fecha de registro', 'class' : '' }
                                               , desactivo : { header : 'Estatus','class' :  'estatususuario(campos[y])' }
                                               , ver : { header : 'Ver', 'boton' : true ,'classb' : 'btn-ver', 'funcion' : 'ver3' }
                                             }
                                  armadatagrid(data,dis,'dg_usuarios',true);
                            } else {
                                  crearMensaje(true,"Atención", ' No se encontraron registros');
                                  return;
                            }
                         },
                            error: function( jqXhr, textStatus, errorThrown ){
                                  var errores=jqXhr.responseJSON.errors;
                                  for (var x in errores) {
                                        crearMensaje(true,"Error", errores[x]);
                                        break;
                                 }
                       }
                  });
             });
        $("#buscar").trigger("click");
     }
