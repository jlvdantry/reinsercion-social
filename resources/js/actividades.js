     if ($('main')[0].id=='actividades') {
        $("#buscar").click(function(e){
             e.preventDefault();
             var Data1 = {
                  descripcion : $('#descripcionb')[0].value,
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/actividades',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                    var dis = { id : { header : 'id', 'class' : 'd-none' }
                                               , desgrupo : { header : 'Grupo', 'class' : '' }
                                               , descripcion : { header : 'Actividad', 'class' : '' }
                                               , ver : { header : 'Eliminar', 'boton' : true ,'classb' : 'btn-eliminar', 'funcion' : 'eli_a' }
                                             }
                                  armadatagrid(data,dis,'dg_usuarios',true);
                            } else {
                                  crearMensaje(true,"Atención", ' No se encontraron registros').then( function () {
                                                $('#descripcionb')[0].focus();
                                            });
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

        $("#crear").click(function(e){
             e.preventDefault();
             var Data1 = {
                  descripcion : $('#descripcion')[0].value,
                  idgrupo     : $('#idgrupo')[0].value,
                 };
                  $.ajax({
                            type: 'post',
                            url: mipath()+'api/actividades',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            //if (data.length>0) {
                                 $("#buscar").trigger("click");
                                 $("#altaga")[0].reset();
                            //} 
                         },
                            error: function( jqXhr, textStatus, errorThrown ){
                                  var errores=jqXhr.responseJSON.errors;
                                  for (var x in errores) {
                                        crearMensaje(true,"Error", errores[x]).then( function() {
                                                 $('#'+x)[0].focus()
                                               });
                                        break;
                                 }
                       }
                  });
             });

        $("#buscar").trigger("click");

        window.eli_a = function (ren){  
          console.log(ren);
          $.ajax({
                            type: 'delete',
                            url:  mipath()+'api/actividades/'+ren.getElementsByTagName('td')[0].innerText,  
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
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
