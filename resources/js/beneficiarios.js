     if ($('main')[0].id=='beneficiarios') {
        $("#nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#buscar").click(function(e){
             e.preventDefault();
             var Data1 = {
                  nombres: $('#nombres')[0].value,
                  curp :  $('#curp')[0].value,
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/beneficiarios',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                    var dis = { id : { header : 'id', 'class' : 'd-none' }
                                     , nombrecompleto : { header : 'Nombres', 'class' : '' }
                                     , genero :  { header : 'Genero', 'class' : '' }
                                     , edad : { header : 'Edad', 'class' : '' }
                                     , created_at : { header : 'Fecha de registro', 'class' : '' }
                                     , curp : { header : 'CURP', 'class' : '' }
                                     , desactivo1 : { header : 'Nuevo  expediente','boton' : true ,'classb' : 'btn-agregar', 'funcion' :  'altaexpediente' }
                                     , ver :       { header : 'Ver', 'boton' : true ,'classb' : 'btn-editar', 'funcion' : 'editar_b' }
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
     window.altaexpediente = function(x) {
            location.href = base_url+"/expedientes/"+x.dataset.id;
     }
     window.editar_b = function(x) {
            location.href = base_url+"/beneficiarios/"+x.dataset.id;
     }


