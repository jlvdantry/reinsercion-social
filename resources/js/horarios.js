     if ($('main')[0].id=='horarios') {
        $("#nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#buscar").click(function(e){
             e.preventDefault();
             var Data1 = {
                  descripcion: $('#descripcion')[0].value,
                  estatus :  $('#estatus')[0].value,
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/horarios',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                    var dis = { id : { header : 'id', 'class' : 'd-none' }
                                               , desgrupo : { header : 'Grupo de actividades', 'class' : '' }
                                               , desactividad :  { header : 'Actividad', 'class' : '' }
                                               , fechas : { header : 'Fechas', 'class' : '' }
                                               , horario : { header : 'Horario', 'class' : '' }
                                               , desestatus : { header : 'Estatus','class' :  'estatushorario(campos[y])' }
                                              /* , ver : { header : 'Ver', 'boton' : true ,'classb' : 'btn-ver', 'funcion' : 'ver3' } */
                                               , baja : { header : 'Eliminar', 'boton' : true ,'classb' : 'btn-eliminar', 'funcion' : 'eli_h' }
                                             }
                                  armadatagrid(data,dis,'dg_usuarios',true);
                            } else {
                                  crearMensaje(true,"Atención", ' No se encontraron horarios');
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

     window.eli_h = function (ren){
            $('#siacepto').click(function(e){
                 $('#d_siacepto')[0].classList.add('d-none');
                 $('#msgModal').modal('hide');
                 eli_h_aceptado(ren);
            });
            $('#d_siacepto')[0].classList.remove('d-none');

            crearMensaje(true,"Atención", " Esta seguro de eliminar el horario?",0);
     }


        window.eli_h_aceptado = function (ren){
          console.log(ren);
          $.ajax({
                            type: 'delete',
                            url:  mipath()+'api/horarios/'+ren.getElementsByTagName('td')[0].innerText,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                                  crearMensaje(true,"Atención", ' El horario fue borrado');
                                  var pn=ren.parentNode;
                                  pn.removeChild(ren);
                                  return;
                         },
                            error: function( jqXhr, textStatus, errorThrown ){
                                  var errores=jqXhr.responseJSON.errors;
                                  for (var x in errores) {
                                        crearMensaje(true,"Error", errores[x]);
                                        break;
                                 }
                       }
                  });
        }

     }
