$(document).ready(function() {
if ($('main')[0].id=='expedientes') {
        $("#nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#ape_pat").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#ape_mat").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#alias").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#curp").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $(".boton-regresar").removeClass('d-none');
        $("#boton-regresar").attr("href", mipath()+"beneficiarios");
        $('div[name="opciones"]').on('click', function(e) {
              $('div[name="tabi"]').addClass('d-none');
              $('div[name="opciones"]').removeClass('tst1');
              $("#"+e.currentTarget.dataset.href).removeClass('d-none');
              $('#'+e.target.id).addClass('tst1');
              if (e.target.id=='primercontacto') { $("#carnet").focus(); }
              if (e.target.id=='demandas') { $("#iddemanda").focus(); }
        });
        $("#primercontacto").trigger('click');
        $("#carnet").keyup(function(){
              $("#des_expediente").text('Expediente-'+this.value);
        });

        $('form[id="f_expediente"] :input').on('change', function(e) {
             cambia_dato(e);
        });
        $('form[id="f_trabajo"] :input').on('change', function(e) {
             cambia_dato(e);
        });
        $('form[id="f_educacion"] :input').on('change', function(e) {
             cambia_dato(e);
        });


        $("#idsituacionjuridica").change(function(e){
          $.ajax({
	      type: 'get',
	      url: mipath()+'api/tiposituaciones/0/'+$('#idsituacionjuridica')[0].value,
	      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	      data: '',
	      success: function(data){
		  $('#idtipodesituacion').children('option').remove();
		  for(var x in data) {
		     $('<option>').val(data[x].id).text(data[x].descripcion).appendTo('#idtipodesituacion');
		  }
	      },
	      error: function( jqXhr, textStatus, errorThrown ){
		var errores=jqXhr.responseJSON.errors;
		for (var x in errores) {
		  crearMensaje(true,"Error ", errores[x]);
		  break;
		}
	      }
         });
       });


        if (window.location.href.split('/').length==7) {    /*  muestra una expediente */
           if (window.location.href.split('/')[5]!='0') {
              ID=window.location.href.split('/')[5];
              $("#titulo").text("Cambio de beneficiario");
              $("#f_expediente")[0].dataset.id=ID;
                  var Data1 = {
                    };

                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/expedientes/'+ID,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                //formb.dataset.id=data[0].id;
                                $('#des_expediente')[0].innerHTML='Expediente-'+data[0].carnet;
                                muestradatos($('form[id="f_expediente"]')[0],data[0]);
                                muestradatos($('form[id="f_trabajo"]')[0],data[0]);
                                muestradatos($('form[id="f_educacion"]')[0],data[0]);
                                if ('demandas' in data[0]) {
                                   for (si in data[0].demandas) {
                                           armagridhorizontal($('form[id="f_demandas"]')[0],jsonf,data[0].demandas[si])
                                   }
                                }
                                if ('tipodemandas' in data[0]) {
                                   $('#iddemanda').children('option').remove();
                                   $('<option>').val("").text("Seleccione una").appendTo('#iddemanda');
                                   demandas=data[0].tipodemandas;
                                   for(var x in demandas) {
                                       $('<option>').val(demandas[x].id).text(demandas[x].descripcion).appendTo('#iddemanda');
                                   }
                                }
                            } else {
                                crearMensaje(true,"Atención", ' No se encontraron registros');
                                return;
                            }
                         },
                            error: function( jqXhr, textStatus, errorThrown ){
                                  var errores=jqXhr.responseJSON.errors;
                                  for (var x in errores) {
                                        crearMensaje(true,"Error ", errores[x]);
                                        break;
                                 }
                       }
                  });
           }
      }
     window.jsonf = {
            'filas' : {
                  row_1 : { "div1" : {
                                    'destipodemanda'           : { 'label' : 'Tipo demanda', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                    'class'           : 'col-md-6'
                                     },
                            'class' : 'row'
                        },
                  row_2 : {
                            "div0" : {
                                     'tipoderespuesta'  : { 'label' : 'Tipo de respuesta', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'        : 'col-lg-12 '
                                     },
                            "div1" : {
                                     'de_sedacita'  : { 'label' : 'Se da una cita', 'class' : 'label-custom-check', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'        : 'col-lg-3 '
                                     },
                            "div2" : {
                                     'de_canalizacion'  : { 'label' : 'Canalización-orientación', 'class' : 'label-custom-check', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'        : 'col-lg-3 '
                                     },
                            "div3" : {
                                     'de_sedainformacion'  : { 'label' : 'Se da información', 'class' : 'label-custom-check', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'        : 'col-lg-3 '
                                     },
                            "div4" : {
                                     'de_escucha'  : { 'label' : 'Escucha-manejo de crisis', 'class' : 'label-custom-check', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'        : 'col-lg-3 '
                                     },

                            'class' : 'row'
                        },
                  row_3 : {
                            "div1" : {
                                     'de_consejo'  : { 'label' : 'Consejo-orientación', 'class' : 'label-custom-check', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'        : 'col-lg-3 '
                                     },
                            "div2" : {
                                     'de_otro'  : { 'label' : 'Otro tipo de respuesta', 'class' : 'label-custom-check', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'        : 'col-lg-9 '
                                     },
                            'class' : 'row'
                        },
                  row_4 : {
                            "div1" : {
                                     'desresultado'  : { 'label' : 'Resultado', 'class' : 'form-label-custom', 'classv' : "font-weight-bold", 'type' : 'label' },
                                     'class'         : 'col-lg-3' ,
                                     },
                            "div2" : {
                                     'resultado'  : { 'label' : 'Observaciones y anotaciones de la persona operadora técnica', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'        : 'col-lg-9 '
                                     },
                            'class' : 'row'
                        },
                  row_5 : {
                            "div2" : {
                                    'BajaSimulacro'   : { 'label' : 'Eliminar', 'class' : 'form-label-custom','classv' : 'btn-eliminar', 'funcion' : 'baja_demanda',  'type' : 'label' , 'stype':'button'},
                                    'class'           : 'col-md-6 mb-3'
                                     },
                            'class' : 'row'
                        },
                      },
             'titulo' : { 'label' : 'Demanda', 'class' : "my-0" , 'type' : 'h2' },
             //'pie'    : { 'label' : 'Demanda', 'class' : "my-0" , 'type' : 'h2' },
             'class'  : 'demandas',
             'id'     : 'simulacros'
          }

     window.baja_demanda = function (id,dg=null) {
          $.ajax({
                            type: 'delete',
                            url:  mipath()+'api/demandas/'+id,   /* obtiene el numero de RFC */
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                                  crearMensaje(true,"Atención:", 'La demanda se dio de baja');
                                  var pn=dg.parentNode;
                                  pn.removeChild(dg);
                                  if ('tipodemandas' in data) {
                                     $('#iddemanda').children('option').remove();
                                     $('<option>').val("").text("Seleccione una").appendTo('#iddemanda');
                                     demandas=data.tipodemandas;
                                     for(var x in demandas) {
                                       $('<option>').val(demandas[x].id).text(demandas[x].descripcion).appendTo('#iddemanda');
                                     }
                                  }

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



        $("#crear-demanda").click(function(e){
                  var formsi = $('form[id="f_demandas"]')[0];
                  var formdd = $('form[id="f_expediente"]')[0];
                  e.preventDefault();
                  if (formsi.checkValidity() === false) {
                    formsi.classList.add('was-validated');
                    return;
                  }
                  var fd = new FormData();
                  //fd.append(this.id,this.files[0]);
                  fd.append('iddemanda',$('#iddemanda')[0].value);
                  fd.append('pantalla',this.closest('form').id);
                  fd.append('idresultado',$('#idresultado')[0].value);
                  fd.append('resultado',$('#resultado')[0].value);
                  fd.append('de_sedacita',$('#de_sedacita')[0].checked ? '1' : '' );
                  fd.append('de_canalizacion',$('#de_canalizacion')[0].checked ? '1' : '' );
                  fd.append('de_sedainformacion',$('#de_sedainformacion')[0].checked ? '1' : '' );
                  fd.append('de_escucha',$('#de_escucha')[0].checked ? '1' : '' );
                  fd.append('de_consejo',$('#de_consejo')[0].checked ? '1' : '' );
                  fd.append('de_otro',$('#de_otro')[0].value);


                    $.ajax({
                       type: 'post',
                       url: mipath()+'api/expedientes/'+formdd.dataset.id+'?demandas',
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       contentType: false,
                       processData: false,
                       cache:       false,
                       data : fd,
                       success: function(data){
                             armagridhorizontal($('form[id="f_demandas"]')[0],jsonf,data[0]);
                             crearMensaje(false,"Atención", ' Se agregó una demanda');
                             formsi.reset();
                                if ('tipodemandas' in data) {
                                   $('#iddemanda').children('option').remove();
                                   demandas=data.tipodemandas;
                                   $('<option>').val("").text("Seleccione una").appendTo('#iddemanda');
                                   for(var x in demandas) {
                                       $('<option>').val(demandas[x].id).text(demandas[x].descripcion).appendTo('#iddemanda');
                                   }
                                }
                       },
                       error: function( jqXhr, textStatus, errorThrown ){
                          var errores=jqXhr.responseJSON.errors;
                          for (var x in errores) {
                                     crearMensaje(true,"Error: ", errores[x]).then(function() {
                                        if ('subseccion' in errores) {
                                           $('#'+errores.subseccion).trigger('click');
                                        }
                                        $('#'+x)[0].focus();
                                     });
                                     break;
                          }
                       }
                    });
        });

  $('div[name="crear-expediente"]').click(function(e){
                  e.preventDefault();
                  var formdd = $('form[id="f_expediente"]')[0];
                  var Data1 = {
                        estatus : '1'
                    };
                    $.ajax({
                       type: 'put',
                       url: mipath()+'api/expedientes/'+formdd.dataset.id,
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       data: Data1,
                       success: function(data){
                             if (formdd.dataset.id=='' && data.id!='') {
                                 formdd.dataset.id=data.id;
                             }
                             crearMensaje(false,"Atención:", ' Se creo un expediente',0);
                             $("#f_poblacion :input:not([readonly='readonly']):not([disabled='disabled'])").first().focus();
                       },
                       error: function( jqXhr, textStatus, errorThrown ){
                          var errores=jqXhr.responseJSON.errors;
                          for (var x in errores) {
                                     if ('seccion' in errores) {
                                        $('#'+errores.seccion).trigger('click');
                                     }
                                     crearMensaje(true,"Error ", errores[x]).then(function() {
                                        if ('subseccion' in errores) {
                                           $('#'+errores.subseccion).trigger('click');
                                        }
                                        $('#'+x)[0].focus();
                                     });
                                     break;
                          }
                       }
                    });
   });
}
   });
