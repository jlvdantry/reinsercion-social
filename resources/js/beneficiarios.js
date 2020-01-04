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
                                     , expedientes :       { 'header' : 'Expedientes', 'boton' : true ,'class' : 'font-weight-bold d-flex justify-content-center align-items-center'
                                                            ,'classb' : 'btn-mostrar ml-2', 'funcion' : 'verexpedientes' }
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
            location.href = base_url+"/expedientes/0/"+x.dataset.id;
     }

     window.verexpediente = function(x) {
            location.href = base_url+"/expedientes/"+x.dataset.id+"/"+x.cells[1].innerText;
     }

     window.editar_b = function(x) {
            location.href = base_url+"/beneficiarios/"+x.dataset.id;
     }

     window.verexpedientes = function (ren){  /* boton para ver los inmuebles de un establecimiento */
          ren.getElementsByTagName('button')[0].classList.toggle('active');
          if (ren.getElementsByTagName('button')[0].classList.contains('active')) {
              $.ajax({
                            type: 'get',
                            url: mipath()+'api/expedientes/0/'+ren.dataset.id,
                            headers: {'X-C1GSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                            if (data.length>0) {
                                    var dis = {  id       : { header    : 'ID', 'class' : 'd-none' }
                                               , idbeneficiario : { header    : 'idbeneficiario', 'class' : 'd-none' }
                                               , carnet    : { header    : 'Carnet'}
                                               , dessituacionjur    : { header    : 'Situación juridica' }
                                               , desestatus  : { header : 'Estatus'}
                                               , Ver      : { header    : 'Ver Expediente', 'boton' : true ,'classb' : 'btn-ver', 'funcion' : 'verexpediente' }
                                               , Bajas      : { header    : 'Eliminar', 'boton' : true ,'classb' : 'btn-eliminar', 'funcion' : 'bajaexpediente' }
                                          }
                                  armadatagrid(data,dis,'dg_hija',true,ren);
                            } else {
                                  crearMensaje(true,"Atención", ' No se encontraron expedientes');
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
           }
           else {
                var dg=$('#__sd');
                if (dg[0]!=undefined) {
                   var pn=dg[0].parentNode;
                   pn.removeChild(dg[0])
                }

           }
     }

     window.bajaexpediente = function (ren){  /* elimina un infractor */
            $('#siacepto').click(function(e){
                 $('#d_siacepto')[0].classList.add('d-none');
                 $('#msgModal').modal('hide');
                 console.log('entro a eliminar un infractor'+ren);
                 bajaexpediente_aceptado(ren);
            });
            $('#d_siacepto')[0].classList.remove('d-none');

            crearMensaje(true,"Atención", " Esta seguro de eliminar el expediente?",0);

     }
     window.bajaexpediente_aceptado = function (ren){  /* elimina el infractor */
          console.log(ren);
          $.ajax({
                            type: 'delete',
                            url:  mipath()+'api/expedientes/'+ren.getElementsByTagName('td')[0].innerText,   /* obtiene el numero de RFC */
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                                  var pn=ren.parentNode;
                                  pn.removeChild(ren);
                                  crearMensaje(true,"Atención", " El expediente fue eliminado ");
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


