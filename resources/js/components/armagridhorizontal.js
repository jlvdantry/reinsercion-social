
     window.jsonf = {
            'filas' : {
                  row_1 : { "div1" : {
                                    'fecha'           : { 'label' : 'Fecha*', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                    'class'           : 'col-md-6 mb-3'
                                     },
                            "div2" : {
                                    'destiposimulacro'   : { 'label' : 'Tipo*', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold',  'type' : 'label' },
                                    'class'           : 'col-md-6 mb-3'
                                     },
                            'class' : 'row'
                        },
                  row_2 : {
                            "div1" : {
                                     'hipotesis'     : { 'label' : 'Hipotesis*', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'         : 'col-lg-12 '
                                     },
                            'class' : 'row'
                        },
                  row_3 : {
                            "div1" : {
                                     'filesystem'  : { 'label' : 'Constancia de simulacros* (PDF)', 'class' : 'form-label-custom', 'classv' : "btn-descargar", 'type' : 'label' , 'stype':'file'}, 
                                     'class'         : 'col-md-6 mb-3'
                                     },
                            "div2" : {
                                    'BajaSimulacro'   : { 'label' : 'Eliminar', 'class' : 'form-label-custom','classv' : 'btn-eliminar', 'funcion' : 'baja_simulacro',  'type' : 'label' , 'stype':'button'},
                                    'class'           : 'col-md-6 mb-3'
                                     },

                            'class' : 'row'
                        },
                      },
             'titulo' : { 'label' : 'Simulacro', 'class' : "my-0" , 'type' : 'h2' },
             'pie'    : { 'label' : 'Simulacro', 'class' : "my-0" , 'type' : 'h2' },
             'class'  : 'simulacros',
             'id'     : 'simulacros'
          }

     window.jsonpunto = {
            'filas' : {
                  row_0 : { "div1" : {
                                    'pr_ubicacion'           : { 'label' : 'Ubicacion', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                    'class'           : 'col-md-12'
                                     },
                            'class' : 'row'
                        },
                  row_1 : { "div1" : {
                                    'des_pr_tipo'           : { 'label' : 'Tipo', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                    'class'           : 'col-md-6'
                                     },
                            "div2" : {
                                    'pr_otro'   : { 'label' : 'Otro', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold',  'type' : 'label' },
                                    'class'           : 'col-md-6 mb-3'
                                     },
                            'class' : 'row'
                        },
                  row_2 : {
                            "div1" : {
                                     'pr_m2_superficie'     : { 'label' : 'Metros cuadrados de superficie', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'         : 'col-lg-6 '
                                     },
                            "div2" : {
                                     'pr_capacidad'  : { 'label' : 'Capacidad contemplada de personas', 'class' : 'form-label-custom', 'classv' : "font-weight-bold", 'type' : 'label' },
                                     'class'         : 'col-lg-6 mb-3'
                                     },
                            'class' : 'row'
                        },
                  row_3 : {
                            "div1" : {
                                     'lat_pr'     : { 'label' : 'Latitud', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'         : 'col-lg-6 '
                                     },
                            "div2" : {
                                     'long_pr'  : { 'label' : 'Longitud', 'class' : 'form-label-custom', 'classv' : "font-weight-bold", 'type' : 'label' },
                                     'class'         : 'col-lg-6 mb-3'
                                     },
                            'class' : 'row'
                        },

                  row_4 : {
                            "div2" : {
                                    'BajaPunto'   : { 'label' : 'Eliminar', 'class' : 'form-label-custom','classv' : 'btn-eliminar', 'funcion' : 'baja_puntor',  'type' : 'label' , 'stype':'button'},
                                    'class'           : 'col-md-12 mb-3'
                                     },
                            'class' : 'row'
                        },
                      },
             'titulo' : { 'label' : 'Puntos de reunión', 'class' : "my-0" , 'type' : 'h2' },
             'pie'    : { 'label' : 'Simulacro', 'class' : "my-0" , 'type' : 'h2' },
             'class'  : 'puntos',
             'id'     : 'puntos'
          }

     window.jsonp = {
            'filas' : {
                  row_0 : {
                            "div2" : {
                                    'descomites'   : { 'label' : 'Puesto', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold',  'type' : 'label' },
                                    'class'       : 'col-md-12'
                                     },
                            'class' : 'row'
                        },

                  row_1 : { "div1" : {
                                    'nombres'           : { 'label' : 'Nombres', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                    'class'           : 'col-md-6'
                                     },
                            "div2" : {
                                    'ape_pat'   : { 'label' : 'Primer apellido', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold',  'type' : 'label' },
                                    'class'           : 'col-md-6'
                                     },
                            'class' : 'row'
                        },
                  row_11 : { "div1" : {
                                    'ape_mat'           : { 'label' : 'Segundo Apellido', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                    'class'           : 'col-md-6'
                                     },
                            "div2" : {
                                    'cargo'   : { 'label' : 'Cargo', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold',  'type' : 'label' },
                                    'class'           : 'col-md-6'
                                     },
                            'class' : 'row'
                        },

                  row_2 : {
                            "div1" : {
                                     'curp'     : { 'label' : 'Curp', 'class' : 'form-label-custom', 'classv' : 'font-weight-bold', 'type' : 'label' },
                                     'class'         : 'col-md-6'
                                     },
                            "div2" : {
                                     'filesystem'  : { 'label' : 'Constancia de simulacros* (PDF)', 'class' : 'form-label-custom  d-block', 'classv' : "btn-descargar-grid", 'type' : 'label' , 'stype':'file'}, /* classv clase para el valor */
                                     'class'         : 'col-md-6'
                                     },

                            'class' : 'row'
                        },
                  row_3 : {
                            "div1" : {
                                     'vacio'  : { 'label' : '', 'class' : 'form-label-custom', 'classv' : "btn-descargar", 'type' : 'label' , }, /* classv clase para el valor */
                                     'class'         : 'col-md-6'
                                     },
                            "div2" : {
                                    'BajaComites'   : { 'label' : 'Eliminar', 'class' : 'form-label-custom','classv' : 'btn-eliminar', 'funcion' : 'baja_comites',  'type' : 'label' , 'stype':'button'},
                                    'class'           : 'col-md-6'
                                     },

                            'class' : 'row'
                        },
                      },
             'titulo' : { 'label' : 'Comité interno', 'class' : "my-0" , 'type' : 'h2' },
             'pie'    : { 'label' : 'Simulacro', 'class' : "my-0" , 'type' : 'h2' },
             'class'  : 'comites p-3',
             'id'     : 'comites'
          }

/* idforma = nodo al que posterior a este se agrga el grid
 * jsonf   = json que indica como se va a formatear cada elemento de datos
 * datos   = arreglo de los datos
    */
     window.armagridhorizontal = function (idforma,jsonf,datos) {
          divp=document.createElement('div');
          if ('class' in jsonf) {
             divp.setAttribute('class',jsonf.class);
          }
          if ('id' in jsonf) { divp.setAttribute('id',jsonf.id+"_"+datos.id); }
          divh=document.createElement(jsonf['titulo'].type);
          divh.setAttribute('class',jsonf['titulo'].class);
          tdCelda = document.createTextNode(jsonf['titulo'].label)
          divh.appendChild(tdCelda);
          divp.appendChild(divh);
          //for (var x in datos) {  /* arma los renglones detalle del datagrid */
           //if (typeof(datos[x])=='object') {
               console.log(datos);
               filas=jsonf['filas'];
               for ( var ren in filas) { /* renglones */
                  div=document.createElement('div');
                  if ('class' in filas[ren]) {
                     div.setAttribute('class',filas[ren].class);
                  }
                  pp=filas[ren];
                  for ( var ca in pp ) { /* divisiones del renglon */
                   if (typeof(pp[ca])=="object") {
                      div1=document.createElement('div');
                      if ('class' in pp[ca]) {
                         div1.setAttribute('class',pp[ca].class);
                      }
                      pp1=pp[ca];
                      for ( var ca1 in pp1) {
                         if (typeof(pp1[ca1])=="object") {
                            if (('stype' in  pp1[ca1]) && (pp1[ca1].stype=='file') && (datos[ca1]==0 || datos[ca1]=='' || datos[ca1]==null )) {
                               continue;
                            }
                            div2=document.createElement(pp1[ca1].type);
                            if ('label' in pp1[ca1]) {
                               $(div2).text(pp1[ca1].label)
                            }
                            if ('class' in pp1[ca1]) {
                               div2.setAttribute('class',pp1[ca1].class)
                            }
                            div1.appendChild(div2);
                            if (('stype' in  pp1[ca1]) && (pp1[ca1].stype=='file')) {
                              a=document.createElement('a');
                              a.setAttribute('href',mipath()+'storage/'+datos[ca1]);
                              a.setAttribute('target','_blank');
                              if ('classv' in pp1[ca1]) {
                                 a.setAttribute('class',pp1[ca1].classv)
                              }
                              tdCelda = document.createTextNode('Descargar archivo')
                              a.appendChild(tdCelda);
                              div1.appendChild(a);
                              break;
                            }

                            if (('stype' in  pp1[ca1]) && (pp1[ca1].stype=='button')) {
                              p=document.createElement('p');
                              a=document.createElement(pp1[ca1].stype);
                              if ('classv' in pp1[ca1]) {
                                 a.setAttribute('class',pp1[ca1].classv)
                              }
                              if ('funcion' in pp1[ca1]) {
                                 a.setAttribute('class',pp1[ca1].classv)
                                 a.setAttribute('onclick',pp1[ca1].funcion+'('+datos.id+','+divp.id+')')
                              }
                              p.appendChild(a);
                              div1.appendChild(p);
                              break;
                            }

                            if (('type' in  pp1[ca1]) && (pp1[ca1].type=='label') ) {
                              p=document.createElement('p');
                              if (datos[ca1]!=undefined) {
                                 tdCelda = document.createTextNode(datos[ca1])
                                 p.appendChild(tdCelda);
                              }
                              div1.appendChild(p);
                            }
                         }
                      }
                      div.appendChild(div1);
                    }
                  }
                  divp.appendChild(div);
                  if ('pie' in jsonf) {
                       pie=document.createElement(jsonf.pie.type);
                       divp.appendChild(pie);
                  }
               }
          $(divp).insertAfter(idforma);
     };

     window.baja_simulacro = function (id,dg=null) {
          $.ajax({
                            type: 'delete',
                            url:  mipath()+'api/simulacros/'+id,   /* obtiene el numero de RFC */
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                                  crearMensaje(true,"Atención:", ' El simulacro se dio de baja');
                                  var pn=dg.parentNode;
                                  pn.removeChild(dg);
                                  validasimulacros();
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

     window.baja_puntor = function (id,dg=null) {
          $.ajax({
                            type: 'delete',
                            url:  mipath()+'api/puntor/'+id,   /* obtiene el numero de RFC */
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                                  crearMensaje(true,"Atención:", ' El punto de reunión se dio de baja');
                                  var pn=dg.parentNode;
                                  pn.removeChild(dg);
                                  validasimulacros();
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


     window.baja_comites = function (id,dg=null) {
          $.ajax({
                            type: 'delete',
                            url:  mipath()+'api/comites/'+id,   /* obtiene el numero de RFC */
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                                  crearMensaje(true,"Atención:", ' El puesto del comite interno se dio de baja');
                                  unapersona=data.data.figu[0].unapersona ? 1 : 0 ;
                                  if (unapersona==1) {
                                      x= new Option(data.data.figu[0].descripcion, data.data.figu[0].id);
                                      x.setAttribute("data-unapersona", data.data.figu[0].unapersona ? "1" : "0" )
                                      $('#id_figuras').append(x);
                                  }
                                  var pn=dg.parentNode;
                                  pn.removeChild(dg);
                                  desmarcapuesto(data.data.figu[0].descripcion,unapersona)
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
