$(document).ready(function() {
      $(function() {
          $('.selectpicker').selectpicker();
      });

     console.log('entro');
     setTimeout(function(){
                $('#msgModal').modal('hide');
                resolve();
       }, 60000);


     $("input[type=file][id^='s_id_'").change(function(e){
                  $("#l_"+this.id)[0].innerHTML=this.files[0].name;
     });

     $("input[type=file][id^='id_'").change(function(e){
                  var nombre=this.files[0].name;
                  var id=this.id;
                  var quediv=$($("#l_" + this.id)[0].closest('div'));
                  var archivo=$("#l_" + this.id)[0].id.split('_')[3];
                  formi=this.closest('form');
                  var Data1 = {
                        file : this.files[0],
                  };
                  var fd = new FormData();
                  fd.append(this.id,this.files[0]);
                  var formdd = $('form[id="f_boleta"]')[0];
                  if ('id' in formdd.dataset) {
                         var idb=formdd.dataset.id;
                  } else { var idb=''; }

                    $.ajax({
                       type: 'post',
                       url: mipath()+'api/infractores/'+formdd.dataset.id+'/'+formi.dataset.id,
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       contentType: false,
                       processData: false,
                       cache:       false,
                       data : fd,
                       success: function(data){
                             if (formi.dataset.id=='' && data.id!='') {
                                 formi.dataset.id=data.id;
                             }
                             $("#l_"+id)[0].innerHTML=nombre;
                             crearBotonDescarga(data.filesystem['filesystem_'+archivo],quediv);

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

     if ($('form[id="f_motivo"]')[0]!=undefined && $('form[id="f_motivo"]')[0].id=='f_motivo') {
        var formi = $('form[id="f_motivo"]')[0];
        $('form[id="f_motivo"] :input').on('change', function(e) {
             cambia_dato(e);
        });
        $('#b_motivo').on('click', function(e) {
             $('#horahechos').focus();
        });
     }

     if ($('form[id="f_quienfirma"]')[0]!=undefined && $('form[id="f_quienfirma"]')[0].id=='f_quienfirma') {
        var formi = $('form[id="f_quienfirma"]')[0];
        $('form[id="f_quienfirma"] :input').on('change', function(e) {
             cambia_dato(e);
        });
     }


     if ($('form[id="f_infractores"]')[0]!=undefined && $('form[id="f_infractores"]')[0].id=='f_infractores') {
        var formb = $('form[id="f_infractores"]')[0];
        $('form[id="f_infractores"] :input').on('change', function(e) {
             cambia_dato_infra(e);
        });

        $('div[name="opciones"]').on('click', function(e) {
              $('div[name="tabi"]').addClass('d-none'); 
              $('div[name="opciones"]').removeClass('tst1'); 
              $("#"+e.currentTarget.dataset.href).removeClass('d-none'); 
              $('#'+e.target.id).addClass('tst1');
        });

        $("#curp").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); });
        $("#nombre_i").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); 
                                $("#nombredelinfractor")[0].innerHTML=e.currentTarget.value+' '+$("#primer_apellido_i")[0].value+' '+$("#segundo_apellido_i")[0].value;
                                         })
        $("#primer_apellido_i").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); 
                                $("#nombredelinfractor")[0].innerHTML=$("#nombre_i")[0].value+' '+e.currentTarget.value+' '+$("#segundo_apellido_i")[0].value;
                                         })
        $("#segundo_apellido_i").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); 
                                $("#nombredelinfractor")[0].innerHTML=$("#nombre_i")[0].value+' '+$("#primer_apellido_i")[0].value+' '+e.currentTarget.value;
                                         })
        $("#idinfraccion").on('change',function(e){
               muestra_textos(e.currentTarget.options,this.options.selectedIndex)
               $('#sancionaplicada')[0].value=0;
               $('input:radio[name=tiposancion]').each(function () { $(this).prop('checked', false); });
         })
     }

     if ($('form[id="f_boleta"]')[0]!=undefined && $('form[id="f_boleta"]')[0].id=='f_boleta') {
        var formb = $('form[id="f_boleta"]')[0];
        $('form[id="f_boleta"] :input').on('change', function(e) {
             cambia_dato(e);
        });

        $("#boleta_remision").keyup(function(){
              $("#des_expediente").text('Boleta-'+this.value);
        });

        $("#nombre_1").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#primer_apellido_1").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#segundo_apellido_1").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })

        $("#nombre_2").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#primer_apellido_2").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#segundo_apellido_2").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
 
        if (window.location.href.split('/').length==6) {    /*  muestra una boleta */
           if (window.location.href.split('/')[5]!='') {
                  var Data1 = {
                    };

                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/boletas/'+window.location.href.split('/')[5],
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                formb.dataset.id=data[0].id;
                                $('#des_expediente')[0].innerHTML='Boleta-'+data[0].boleta_remision;
                                muestradatos($('form[id="f_boleta"]')[0],data[0]);
                                muestradatos($('form[id="f_motivo"]')[0],data[0]);
                                muestradatos($('form[id="f_quienfirma"]')[0],data[0]);
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


        $("div[name='agregarinfractor']").click(function(e){
            var formi = $('form[id="f_infractores"]')[0]; 
            formi.dataset.id="" ;
            formi.reset();
            $('#nombredelinfractor')[0].innerHTML='Nuevo infractor';
            $('#c_infractor').addClass("active");
            $('#c_infractor').addClass("show");
            $('#c_infractores').removeClass("active");
            $('#c_infractores').removeClass("show");
            $('#datosgenerales').trigger("click");
            $('#nombre_i').focus();
        });

        $("#mostrarinfractores").click(function(e){
            $('#infractores').trigger("click"); 
        });

        $("#infractores").click(function(e){
             e.preventDefault();
             var formdd = $('form[id="f_boleta"]')[0];
             if ('id' in formdd.dataset) {
                         var id=formdd.dataset.id;
             } else { var id=''; }

             if (id=='') {
                 crearMensaje(true,"Atención", 'Primero tiene que registrar una boleta');
                 return;
             }
             var Data1 = {
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/infractores/'+id,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>1) {
                                   var dis = {
                                                 id       : { header    : 'ID',  'class' : 'd-none'}
                                               , nombre_completo : { header : 'Nombre infractor', 'class' : 'font-weight-bold' }
                                               , edad :  { header : 'Edad', 'class' : 'font-weight-bold' }
                                               , sexon :  { header : 'Sexo', 'class' : 'font-weight-bold' }
                                               , desentidad :  { header : 'Lugar de nacimiento', 'class' : 'font-weight-bold' }
                                               , ver : { header : 'Editar', 'boton' : true ,'classb' : 'btn-editar', 'funcion' : 'infra_ed' }
                                               , Eliminar : { header : 'Eliminar', 'boton' : true ,'classb' : 'btn-eliminar', 'funcion' : 'infra_el' }
                                             }
                                  armadatagrid(data,dis,'dg_infractores',true);
                                  var formi = $('form[id="f_infractores"]')[0];
                                  formi.dataset.id="" ;
                                  formi.reset();
                            } else {
                                  $('#c_infractor').addClass("active")
                                  $('#c_infractor').addClass("show")
                                  $('#c_infractores').removeClass("active")
                                  $('#c_infractores').removeClass("show")
                                  $('#nombre_i').focus()
                                  $('#datosgenerales').trigger('click');
                                  if (data.length==1) {
                                     var formi = $('form[id="f_infractores"]')[0];
                                     formi.dataset.id=data[0].id;
                                     $('#datosgenerales').addClass('tst1');
                                     muestradatos($('form[id="f_infractores"]')[0],data[0]);
                                     $('#nombredelinfractor')[0].innerHTML=$('#nombre_i')[0].value+' '+$('#primer_apellido_i')[0].value
                                                                                                  +' '+$('#segundo_apellido_i')[0].value;
                                  }
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
        });

        $("button[name='guardarexpediente']").click(function(e){
                  e.preventDefault();
                  var formdd = $('form[id="f_boleta"]')[0];
                  var Data1 = {
                        estatus : '1'
                    };
                    $.ajax({
                       type: 'put',
                       url: mipath()+'api/boletas/'+formdd.dataset.id,
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

     //Editar perfil
     if ($('main')[0].id=='editarperfil') {
        $("#guardarcambios").click(function(e){
                  e.preventDefault();
                  var forms = document.getElementsByClassName('needs-validation');
                  if (forms[0].checkValidity() === false) {
                    forms[0].classList.add('was-validated');
                    return;
                  }
                 var checked = $("input[type=checkbox]:checked").length;

                 if(!checked && $('#queperfil')[0].innerText=='Tercero Acreditado') {
                      crearMensaje(true,"Error ", "Al menos debe seleccionar una actividad registrada");
                      $("#cb").focus();
                      return false;
                 }

                  if ($('#queperfil')[0].innerText=='Tercero Acreditado') {
                  var Data1 = {
                        nombres: $('#nombres')[0].value,
                        ape_pat: $('#ape_pat')[0].value,
                        ape_mat: $('#ape_mat')[0].value,
                        rfc: $('#rfc')[0].value,
                        sgirpc: $('#sgirpc')[0].value,
                        id_nivel: $('#id_nivel')[0].value,
                        vigencia: $('#vigencia')[0].value,
                        stps: $('#stps')[0].value,
                        calle: $('#calle')[0].value,
                        exterior: $('#exterior')[0].value,
                        interior: $('#interior')[0].value,
                        colonia: $('#colonia')[0].value,
                        id_alcaldia: $('#id_alcaldia')[0].value,
                        cp: $('#cp')[0].value,
                        num_telefono: $('#num_telefono')[0].value,
                        tipopersona :  $("input[name='tipo_persona']:checked").val(),
                        cb : ($('#cb')[0].checked ? 1 : 0),
                        epmr : ($('#epmr')[0].checked ? 1 : 0),
                        erv : ($('#erv')[0].checked ? 1 : 0),
                        rpar : ($('#rpar')[0].checked ? 1 : 0)
                        }
                    } else {
                  var Data1 = {
                        nombres: $('#nombres')[0].value,
                        ape_pat: $('#ape_pat')[0].value,
                        ape_mat: $('#ape_mat')[0].value
                        }
                    }

                    $.ajax({
                      type: 'put',
                      url: mipath()+'api/users/'+$('#editarperfil')[0].dataset.id,
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       data: Data1,
                       success: function(data){
                             location.href = base_url+"/informacion-actualizada";
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

        $('input[type="radio"]').on('change', function(e) {
             if (e.target.value=="M") {
                 $('#lnombres').text("Razon social*");
                 $('#nombres').attr("placeholder","Escribe la razón social");
                 $('#apa').hide();
                 $('#nom').attr("class","col-lg-12 mb-3");
                 $('#ama').hide();
                 $('#ape_pat').attr("required",false);
             }
             if (e.target.value=="F") {
                 $('#lnombres').text("Nombres(s)*");
                 $('#nombres').attr("placeholder","Escribe tu(s) nombre(s)");
                 $('#apa').show();
                 $('#nom').attr("class","col-lg-4");
                 $('#ama').show();
                 $('#ape_pat').attr("required",true);
             }

        });

     }

     if ($('main')[0].id=='notienecuenta') {
        $("#nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#ape_pat").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#ape_mat").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#alc-nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#alc-ape_pat").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#alc-ape_mat").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#alc-nombres").focus();
        $("#creacuenta").click(function(e){
//                console.log('Va a crear cuenta');
                  e.preventDefault();
                  var forms = document.getElementsByClassName('needs-validation');
                  if (forms[0].checkValidity() === false) {
                    forms[0].classList.add('was-validated');
                    return;
                  }
                 var checked = $("input[type=checkbox]:checked").length;

                 if(!checked) {
                      crearMensaje(true,"Error ", "Al menos debe seleccionar una actividad registrada");
                      $("#cb").focus();
                      return false;
                 }


                  var Data1 = {
                        nombres: $('#nombres')[0].value,
                        email: $('#email')[0].value,
                        ape_pat: $('#ape_pat')[0].value,
                        ape_mat: $('#ape_mat')[0].value,
                        rfc: $('#rfc')[0].value,
                        sgirpc: $('#sgirpc')[0].value,
                        id_nivel: $('#id_nivel')[0].value,
                        vigencia: $('#vigencia')[0].value,
                        stps: $('#stps')[0].value,
                        calle: $('#calle')[0].value,
                        exterior: $('#exterior')[0].value,
                        interior: $('#interior')[0].value,
                        colonia: $('#colonia')[0].value,
                        id_alcaldia: $('#id_alcaldia')[0].value,
                        cp: $('#cp')[0].value,
                        num_telefono: $('#num_telefono')[0].value,
                        tipopersona :  $("input[name='tipo_persona']:checked").val(),
                        password :  $('#password')[0].value,
                        password_confirmation :  $('#password_confirma')[0].value,
                        cb : ($('#cb')[0].checked ? 1 : 0),
                        epmr : ($('#epmr')[0].checked ? 1 : 0),
                        erv : ($('#erv')[0].checked ? 1 : 0),
                        rpar : ($('#rpar')[0].checked ? 1 : 0)
                    };

                    $.ajax({
                       type: 'post',
                       url: mipath()+'api/register?tercero',
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       data: Data1,
                       success: function(data){
                             location.href = base_url+"/registro-exitoso";
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

        $('input[type="radio"]').on('change', function(e) {
             if (e.target.value=="M") {
                 $('#lnombres').text("Razón social*");
                 $('#nombres').attr("placeholder","Escribe la razón social");
                 $('#apa').hide();
                 $('#nom').attr("class","col-lg-12 mb-3");
                 $('#ama').hide();
                 $('#ape_pat').attr("required",false);
             }
             if (e.target.value=="F") {
                 $('#lnombres').text("Nombres(s)*");
                 $('#nombres').attr("placeholder","Escribe tu(s) nombre(s)");
                 $('#apa').show();
                 $('#nom').attr("class","col-lg-4");
                 $('#ama').show();
                 $('#ape_pat').attr("required",true);
             }

        });

     }



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

     if ($('main')[0].id=='ingreso') {
        $("#login").click(function(e){
        e.preventDefault();
        var forms = document.getElementsByClassName('needs-validation');
        if (forms[0].checkValidity() === false) {
          forms[0].classList.add('was-validated');
          return;
        }

             var Data1 = {
                  email: $('#email')[0].value,
                  password :  $('#password')[0].value,
                 };
                  $.ajax({
                      type: 'post',
                    url: mipath()+'api/login',
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: Data1,
                      success: function(data){
                                if (data.data.activo!=1) {
                                    crearMensaje(true,"Atención", ' El usuario aún no está autorizado para utilizar el aplicativo');
                                    return;
                                }
                                for (var x in data) {
                                     console.log('que tiene='+data[x]);
                                     if (x=='menus') {
                                         var eleme= data[x].find(function (element) { return element.mdefault==1} ) ;
                                         if (eleme==undefined) {
                                                crearMensaje(true,"Error ", "No hay menu por default para el usuario");
                                                return;
                                         } else {
                                                location.href = base_url+"/" + eleme.componente + "?_token="+$('meta[name="csrf-token"]').attr('content');
                                                return;
                                         }
                                     }
                                }
                                crearMensaje(true,"Error ", "El usuario no tiene un perfil asignado");
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

        $("#olvidocontra").click(function(e){
             e.preventDefault();
             if ($('#email')[0].value=='') {
                crearMensaje(false,"Atención", ' El email es obligatorio para que recupere la contraseña');
                return;
             }
             console.log('Entró en olvido contraseña');
             var Data1 = {
                  email: $('#email')[0].value,
             };
                  $.ajax({
                      type: 'put',
                      url: mipath()+'api/userso/'+$('#email')[0].value,
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: Data1,
                      success: function(data){
                                    crearMensaje(false,"Cambio de contraseña", ' Se envió un email a su bandeja para poder cambiar su contraseña');
                                    return;
                                },
                      error: function( jqXhr, textStatus, errorThrown ){
                             //var errores=jqXhr.responseJSON.errors;
                             //for (var x in errores) {
                               crearMensaje(true,"Error ", jqXhr.responseJSON);
                               //break;
                             //}
                      }
                 });
        });

     }

     if ($('main')[0].id=='usuarios') {
        $("#nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#buscar").click(function(e){
             e.preventDefault();
             if ($('#nombres')[0].value=="" && $('#email')[0].value=="" && $('#perfiles')[0].value==""
                               && $('#estatus')[0].value=="") {
                crearMensaje(true,"Atención", ' Al menos debe introducir un dato en la búsqueda');
                return;
             }
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
                                    var dis = { id : { header : 'id', 'class' : 'font-weight-bold' }
                                               , nombrecompleto : { header : 'Nombres', 'class' : 'font-weight-bold' }
                                               , desperfil : { header : 'Perfil', 'class' : 'font-weight-bold' }
                                               , email :  { header : 'email', 'class' : 'font-weight-bold' }
                                               //, rfc : { header : 'rfc','class' : 'font-weight-bold' }
                                               , desactivo : { header : 'Estatus','class' : 'font-weight-bold' }
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

     if ($('main')[0].id=='expedientes-registrados') {
        //$("#rfc").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#buscar").click(function(e){
             e.preventDefault();
             var Data1 = {
                  nombres: $('#nombres')[0].value,
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/boletas',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                   var dis = { 
                                                 id       : { header    : 'ID',  'class' : 'd-none'}
                                               , idinfractor : { header    : 'ID',  'class' : 'd-none'}
                                               , diahechoss : { header : 'Fecha', 'class' : 'font-weight-normal' }
                                               , horahechoss : { header : 'Hora', 'class' : 'font-weight-normal' }
                                               , nombres : { header : 'Nombre infractor', 'class' : 'font-weight-normal' }
                                               , noexpediente : { header : 'Expediente', 'class' : 'font-weight-normal' }
                                               , edad :  { header : 'edad', 'class' : 'font-weight-normal' }
                                               , sexo :  { header : 'sexo', 'class' : 'font-weight-normal' }
                                               , boleta_remision :  { header : 'boleta', 'class' : 'font-weight-bold' }
                                               , desestatus :  { header : 'Estatus', 'class' : 'estatusclase(campos[y])' }
                            /*                   , constancia :  { header : 'Constancia Hechos', 'boton' : true , 'classb' : 'btn-editar', 'funcion' : 'consta' } */
                                               , ver : { header : 'Editar', 'boton' : true ,'classb' : 'queboton(tr)', 'funcion' : 'bole_ed' }
                                             }
                                  armadatagrid(data,dis,'dg_boletas',true);
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
             });
        $("#buscar").trigger("click");
        $('#crearexpediente').on('click', function() {
             window.location = mipath() + 'crearexpediente/';
        });

     }

     if ($('main')[0].id=='establecimientos-registrados-todos') {
        $("#rfc").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#buscart").click(function(e){
             e.preventDefault();
             var Data1 = {
                  nombres: $('#nombres')[0].value,
                  rfc :  $('#rfc')[0].value,
                  //email_acreditado : $('#nombre-usuario').data('email')
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/establecimientos',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                   var dis = { 
                                                 terceroacreditado : { header : 'Tercero Acreditado', 'class' : 'font-weight-bold' }
                                               , nombres : { header : 'Solicitante', 'class' : 'font-weight-bold' }
                                               , rfc :  { header : 'rfc', 'class' : 'font-weight-bold' }
                                               //, ver : { header : 'Ver perfil', 'boton' : true ,'classb' : 'btn-ver', 'funcion' : 'ver_e' }
                                               , numinmuebles : { header : 'numinmuebles', 'class' : 'font-weight-bold', 'funcion' : 'inmuebles_e', 'boton' : true , 'classb' : 'btn-mostrar','funcion' : 'ver_it'}
                                               ,email_acreditado : { header : 'Email Acreditado', 'class' : 'font-weight-bold d-none' }
                                             }
                                  armadatagrid(data,dis);
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
             });
        $("#buscart").trigger("click");
     }

     if ($('main')[0].id=='inmuebles-registrados-todos') {
        $("#rfc").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#alias").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#buscart").click(function(e){
             e.preventDefault();
             var Data1 = {
                  alias: $('#alias')[0].value,
                  rfc :  $('#rfc')[0].value,
                  calle :  $('#calle')[0].value,
                  id_alcaldia :  $('#id_alcaldia')[0].value,
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/inmuebles',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                   var dis = {
                                                 idesta    : { header    : 'ID', 'class' : 'd-none' }
                                               , alias : { header : 'Alias', 'class' : 'font-weight-bold' }
                                               , rfc :  { header : 'rfc', 'class' : 'font-weight-bold' }
                                               , desalcaldia : { header : 'Alcaldia', 'class' : 'font-weight-bold' }
                                               , calle_completa : { header : 'Calle', 'class' : 'font-weight-bold' }
                                               , desestatus : { header : 'Estatus', 'class' : 'font-weight-bold' }
                                               , nivel_riesgo  : { header : 'Riesgo'}
                                               , Ver      : { header    : 'Ver Inmueble', 'boton' : true ,'classb' : 'btn-ver', 'funcion' : 'inmu_ver' }
                                             }
                                  armadatagrid(data,dis);
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
             });
        $("#buscart").trigger("click");
     }

     if ($('main')[0].id=='estadistica-acreditados') {
        $("#rfc").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#buscart").click(function(e){
             e.preventDefault();
             var Data1 = {
                  nombres: $('#alias')[0].value,
                  email :  $('#email')[0].value,
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/users/estadistica',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                   var dis = {
                                                 idesta    : { header    : 'ID', 'class' : 'd-none' }
                                               , nombrecompleto : { header : 'Nombre', 'class' : 'font-weight-bold' }
                                               , email :  { header : 'Correo electrnico', 'class' : 'font-weight-bold' }
                                               , estable : { header : 'Establecimientos', 'class' : 'font-weight-bold' }
                                               , inmu : { header : 'Inmuebles', 'class' : 'font-weight-bold' }
                                               , capturando : { header : 'Capturando', 'class' : 'font-weight-bold' }
                                               , capturados : { header : 'Capturados', 'class' : 'font-weight-bold' }
                                               //, Ver      : { header    : 'Ver Inmueble', 'boton' : true ,'classb' : 'btn-ver', 'funcion' : 'inmu_ver' }
                                             }
                                  armadatagrid(data,dis);
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
             });
        $("#buscart").trigger("click");
    }


     if ($('main')[0].id=='inmuebles-registrados') {
        $("#buscar").click(function(e){
             e.preventDefault();
             if ($('#nombres')[0].value=="" && $('#rfc')[0].value==""
                     ) {
                crearMensaje(true,"Atención", ' Al menos debe introducir un dato en la búsqueda');
                return;
             }
             var Data1 = {
                  nombres: $('#nombres')[0].value,
                  rfc :  $('#rfc')[0].value,
                  email_acreditado : $('#nombre-usuario').data('email')
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/establecimientos',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                   var dis = { numinmuebles : { header : 'numinmuebles', 'class' : 'font-weight-bold', 'funcion' : 'inmuebles_e', 'boton' : true , 'classb' : 'btn-ver','funcion' : 'ver_i'}
                                               , nombres : { header : 'Solicitante', 'class' : 'font-weight-bold' }
                                               , rfc :  { header : 'rfc', 'class' : 'font-weight-bold' }
                                               , ver : { header : 'Ver perfil', 'boton' : true ,'classb' : 'btn-ver', 'funcion' : 'ver_e' }
                                               , editar : { header : 'Editar', 'boton' : true ,'classb' : 'btn-editar', 'funcion' : 'editar_e' }
                                               , eliminar : { header : 'Eliminar', 'boton' : true ,'classb' : 'btn-eliminar', 'funcion' : 'eliminar_e' }
                                             }
                                  armadatagrid(data,dis);
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
             });
        $("#buscar").trigger("click");
     }




    if ($('main')[0].id=='autorizacion_pone') {
      $("button[id^='aceptarcambio']").on('click', function(e) {
        e.preventDefault();
        if ($("input[name='estatus']:checked").val()==2 && $("#rechazo")[0].value=="") {
          crearMensaje(true,"¡Atención !", ' Debe de indicar cual es el motivo del rechazo');
          return;
        }
        if ($("input[name='estatus']:checked").val()==1 ) {
          if ($("#idjuzgado").val()=="" ) {
             crearMensaje(true,"¡Atención !", ' Debe de seleccionar el juzgado').then(function() {
                  location.reload();
             });
             return;
          }
          if ($("#idperfil").val()=="" || $("#idperfil").val()=="0") {
             crearMensaje(true,"¡Atención !", ' Debe de seleccionar el perfil del usuario').then(function() {
                  location.reload();
             });
             return;
          }
        }

        $('#confirmacionModalr').modal('hide');
        $('#confirmacionModal').modal('hide');
        var Data1 = {
          activo: $("input[name='estatus']:checked").val(),
          rechazo: $("#rechazo")[0].value,
          idperfil: $("#idperfil")[0].value,
          idjuzgado : $("#idjuzgado")[0].value
        };
        $.ajax({
          type: 'put',
          url: '../api/users/'+$('#autorizacion_pone').data("id"),
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          contentType: 'application/json',
          data: JSON.stringify(Data1),
          dataType: 'json',
          success: function(data){
            $("#rechazo")[0].value=="";
            crearMensaje(false,"¡Cambio exitoso!", ' Se cambió el estatus del usuario');
            return;
          },
          error: function( jqXhr, textStatus, errorThrown ){
            crearMensaje(true,"Error ",jqXhr.responseJSON.message);
          }
        });

      });
      var cc=""; // varable para cancelar el cambio de estatus
      $("button[id^='cancelarcambio']").on('click', function(e) {
        //$('#confirmacionModal').modal('hide');
        location.reload();
      });
    }

  $('.btn-ver-inmuebles').on('click', function() {
    var rfc = $(this).parent().siblings('.rfc').html();
    window.location = mipath() + 'inmuebles-registrados/' + rfc;
  });

  $('.btn-perfil-establecimiento').on('click', function() {
    var id = $(this).data('id');
    window.location = mipath() + 'inmuebles-registrados-secretaria/' + id;
  });

  $('.btn-ver-establecimientos').on('click', function(e) {
    e.preventDefault();
    window.location = mipath() + 'establecimientos-registrados-todos-secretaria/';
  });

  $('#v-pills-analisis-tab').on('click', function(e) {
    var name = $('#a_riesgos_filesystem').html();
    if (name !== '') {
      $('#analisis-riesgos').attr('href', mipath() + 'storage/' + name);
    }
  });

  $('#v-pills-reduccion-tab').on('click', function(e) {
    var name = $('#a_reduccion_filesystem').html();
    if (name !== '') {
      $('#reduccion-riesgos').attr('href', mipath() + 'storage/' + name);
    }
  });

  $('#v-pills-contingencias-tab').on('click', function(e) {
    var name = $('#a_contingencias_filesystem').html();
    if (name !== '') {
      $('#plan-contingencias').attr('href', mipath() + 'storage/' + name);
    }
  });

  $('#v-pills-continuidad-tab').on('click', function(e) {
    var name = $('#a_continuidad_filesystem').html();
    if (name !== '') {
      $('#continuidad-op').attr('href', mipath() + 'storage/' + name);
    }
  });

  // Extras
  $('#v-pills-documentos-tab').on('click', function(e) {
    for (var i = 6; i <= 39; i++) {
      var name = $('#a_' + i + '_filesystem').html();
      if (name !== '') {
        $('#' + i + '-anexos').attr('href', mipath() + 'storage/' + name);
      }
    }
  });

  $('.hide').hide();

  $('#tercer-add-establecimiento').on('click', function(e) {
    e.preventDefault();
    $('#aviso-check').prop("checked", false);
    $('#aviso-btn-accept').prop("disabled", true);
    $('#modalAviso').modal('show');
  });

  $('#aviso-check').on('change', function() {
    if (this.checked) {
      $('#aviso-btn-accept').prop("disabled", false);
    } else {
      $('#aviso-btn-accept').prop("disabled", true);
    }
  });

  $('#aviso-btn-accept').on('click', function() {
    window.location = window.mipath() + 'registrar-establecimiento';
  });

  $('#input_search').on('click', function() {
    var name = $('#input_search_name').val();
    var rfc = $('#input_search_rfc').val();
    $.ajax({
      type: 'GET',
      url:  mipath() + 'api/establecimientos-search/' + name + '/' + rfc
    })
    .done(function(response) {
      alert( "success" );
      console.log(response);
    })
    .fail(function(response) {
      alert( "error" );
      console.log(response);
    });
  });

  // Registro de alcaldía
  //$('#tercer-acreditado-container').hide();

  $("input[name=tipo_cuenta]").change(function () {   
    var tipo_cuenta = $(this).val();
    if (tipo_cuenta === 'T') {
      $('#alcaldia-container').hide();
      $('#tercer-acreditado-container').show();
    }
    if (tipo_cuenta === 'A') {
      $('#alcaldia-container').show();
      $('#tercer-acreditado-container').hide(); 
    }
  });

  $("#creacuenta-alcaldia").click(function(e){
    e.preventDefault();
    var forms = document.getElementsByClassName('needs-validation-alcaldia');
    if (forms[0].checkValidity() === false) {
      forms[0].classList.add('was-validated');
      return;
    }

    var Data1 = {
      nombres: $('#alc-nombres')[0].value,
      email: $('#alc-email')[0].value,
      ape_pat: $('#alc-ape_pat')[0].value,
      ape_mat: $('#alc-ape_mat')[0].value,
      idjuzgado: $('#idjuzgado')[0].value,
      password :  $('#alc-password')[0].value,
      password_confirmation :  $('#alc-password_confirma')[0].value
    };

    $.ajax({
      type: 'post',
      url: mipath()+'api/register?alcaldia',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: Data1,
      success: function(data){
        crearMensaje(true,"Atención", 'Registro exitoso con el correo <br><b>'+$('#alc-email')[0].value+'</b><br>Le va a llegar un email con instrucciones',0).then(function() {
            location.href = base_url+"/";
        });
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
});

window.crearMensaje = function (error,titulo,mensaje,tiempo=2000) {
  return new Promise(function (resolve, reject) {
      $('#titleMsgModal').html(titulo);
      $('#bodyMsgModal').html(mensaje);
      $('#msgModal').modal('show');
      $('button[class="close"]').on('click', function(e) {
             resolve();
      });
      if (tiempo!=0) {
        setTimeout(function(){
                $('#msgModal').modal('hide');
                resolve();
        }, tiempo);
     }
   })
}



 /*
 *              parametro1 =json del armado de columnas
 *              parametro2 =cuando es una subtabla indica sobre cual renglon pone la nueva tabla
 *              parametro3 =sobre que nodo se agrega la tabla
                 */

     window.armadatagrid_titulos = function (dis,trp,quedg) {
         var dg=$('#__sd');
         if (dg[0]!=undefined) {
            var pn=dg[0].parentNode;
            pn.removeChild(dg[0])
         }
          tr=document.createElement('tr'); /* crea tr para un sub data grid */
          tr.setAttribute('id','__sd');
          tr.setAttribute('data-pnid',trp.id);   /* id del node parent */
          thp=document.createElement('th');
          thp.setAttribute('colspan','6');

          ta=document.createElement('table');
          ta.setAttribute('class','tabla-inmuebles');
          thead=document.createElement('thead');
          tbody=document.createElement('tbody');
          tbody.setAttribute('id',quedg+'_body');
          trx=document.createElement('tr');

          for (var y in dis) {
              th=document.createElement('th');
              tdCelda = document.createTextNode(dis[y].header);
              if ('class' in dis[y]) {
                           th.setAttribute("class", dis[y].class);
              }
              th.appendChild(tdCelda);
              trx.appendChild(th);
          }

          //thead.appendChild(trx);
          thead.appendChild(trx);
          if (!trp) {
             var dg=$('#'+quedg); 
             dg.empty();
             dg[0].appendChild(thead);
             dg[0].appendChild(tbody);
          } else {
            ta.appendChild(thead);
            ta.appendChild(tbody);
            thp.appendChild(ta);
            tr.appendChild(thp);
            $(tr).insertAfter(trp);
          }
          return $(tbody);
     };

     window.estatusclase = function (x) {
         //console.log('x='+x);
         return x=='Capturando' ? 'font-weight-normal' : 'font-weight-bold text-success' ;
     }
     /*
         parametro 1=arreglo de registrso a desplegar
         parametro 2=json del armado de columnas
         parametro 3=id del elemento donde va a crear la tabla
         parametro 4=indica si arma los titulos
         parametro 5=cuando es una subtabla indica sobre cual renglon pone la nueva tabla
         
     */
     window.armadatagrid = function (regs,dis=null,quedg='dg_autorizacion',titulos=false,ren=false) {
           if (titulos) {
               dg=armadatagrid_titulos(dis,ren,quedg)
           } else {
             var dg=$('#'+quedg+" tbody");
             while (dg[0].firstChild) {
                  dg[0].removeChild(dg[0].firstChild);
             }
           }
           var tr='';
           var td='';
           var campos='';
           var rx=0;
           for (var x in regs) {  /* arma los renglones detalle del datagrid */
               rx+=1;
               console.log(regs[x]);
               tr=document.createElement('tr');
               tr.setAttribute('id','_'+regs[x].id+'_'+quedg+'_'+rx);
               tr.setAttribute('data-id',regs[x].id);
               dg[0].appendChild(tr)
               campos=regs[x];
               for (var y in dis) {
                    if (campos.hasOwnProperty(y)) {
                        //console.log('va a armar el campo'+y);
                        td=document.createElement('td');
                        p=document.createElement('p');
                        tdCelda = document.createTextNode(campos[y]);
                        if ('class' in dis[y]) {
                           td.setAttribute("class", dis[y].class.indexOf('(')==-1 ? dis[y].class : eval(dis[y].class) );
                           p.setAttribute("class", dis[y].class.indexOf('(')==-1 ? dis[y].class : eval(dis[y].class) );
                        }
                        p.appendChild(tdCelda);
                        td.appendChild(p);
                        tr.appendChild(td);
                        if ('boton' in dis[y]) {
                           //td=document.createElement('td');
                           bt=document.createElement('button');
                           bt.setAttribute('type', 'button');
                           if ('classb' in dis[y]) {
                              bt.setAttribute("class", dis[y].classb.indexOf('(')==-1 ? dis[y].classb : eval(dis[y].classb) );
                           }
                           bt.setAttribute('onclick', dis[y].funcion+'('+tr.id+')');
                           td.appendChild(bt);
                           //tr.appendChild(td);
                        }
                    } else {
                        if ('boton' in dis[y]) {
                           //console.log('va a armar un boton'+y);
                           td=document.createElement('td');
                           bt=document.createElement('button');
                           bt.setAttribute('type', 'button');
                           if ('classb' in dis[y]) {
                              bt.setAttribute("class", dis[y].classb.indexOf('(')==-1 ? dis[y].classb : eval(dis[y].classb));
                           }
                           bt.setAttribute('onclick', dis[y].funcion+'('+tr.id+')');
                           td.appendChild(bt);
                           tr.appendChild(td);
                        }
                    }
               }
           }
     }
/* muestra los datos 
 * el tercer parametro indica si para validar utiliza el checkvalidity */
     window.muestradatos = function (forma,datos,cv=0){
                                var lee=false;
                                if (datos.estatus==1) {
                                   lee=true;
                                }
                                var inputs=forma.getElementsByTagName('input');
                                var textarea=forma.getElementsByTagName('textarea');
                                var selects=forma.getElementsByTagName('select');
                                var ai=$('div[name="agregarinfractor"]');
                                for (var x in ai) {
                                    ai[x].hidden=lee;
                                }
                                var ai=$('button[name="guardarexpediente"]');
                                for (var x in ai) {
                                    ai[x].hidden=lee;
                                }
                                for (var x in inputs) {
                                    if (inputs[x].type=='text' || inputs[x].type=='number' || inputs[x].type=='date' || inputs[x].type=='email' ) {

                                        inputs[x].value=datos[inputs[x].id.replace('wl_','')];
                                    }
                                    if (inputs[x].type=='radio' ) {
                                       if (inputs[x].value==datos[inputs[x].name.replace('wl_','')]) {
                                           inputs[x].checked=true;
                                       }
                                    }
                                    if (inputs[x].type=='checkbox') {
                                       if (inputs[x].value==datos[inputs[x].id]) {
                                           inputs[x].checked=true;
                                       }
                                    }
                                    if (inputs[x].type=='file') {
                                       if (datos[inputs[x].name]!=null) {
                                           var quediv=$($(inputs[x])[0].closest('div'));
                                           crearBotonDescarga(datos['filesystem_'+inputs[x].id.split('_')[2]],quediv);
                                       }
                                       inputs[x].disabled=lee;
                                    }
                                    inputs[x].readOnly=lee;
                                }
                                for (var x in selects) {
                                    if (typeof(selects[x])=='object') {
                                       if ($(selects[x]).hasClass('selectpicker')) {
                                          selects[x].value=datos[selects[x].id.replace('wl_','')];
                                          $($(selects[x])[0].parentNode).find('.filter-option-inner-inner')[0].innerHTML=selects[x][selects[x].selectedIndex].innerHTML;
                                       } else {
                                          selects[x].value=datos[selects[x].id.replace('wl_','')];
                                          if (selects[x].id=="idinfraccion") {
                                               console.log('que hacemos aqui');
                                               muestra_textos(selects[x].options,selects[x].options.selectedIndex);
                                          }
                                       }
                                    }
                                    selects[x].disabled=lee;
                                }

                                for (var x in textarea) {
                                    if (typeof(textarea[x])=='object') {
                                     textarea[x].value=datos[textarea[x].id.replace('wl_','')];
                                    }
                                    textarea[x].readOnly=lee;
                                }

/*
                               if (cv==0) {
                                   if (forma.checkValidity()==true) {
                                      $('#v-pills-'+forma.id.replace('f_','')+'-tab').children()[0].classList.remove('d-none')
                                   }
                               }
                               if (cv==1) {
                                   if (validaarchivos(forma.id)==true) {
                                      $('#v-pills-'+forma.id.replace('f_','')+'-tab').children()[0].classList.remove('d-none')
                                   }
                               }
                               if (cv==3) {
                                  var checkedpcd = $('input[type="checkbox"][name="pcd"]:checked').length;
                                  if (validaarchivos(forma.id)==true & checkedpcd>0) {
                                      $('#v-pills-'+forma.id.replace('f_','')+'-tab').children()[0].classList.remove('d-none')
                                  }
                               }
*/
     }

     window.ver3 = function (ren){
          console.log(ren);
          location.href = "./detalle-usuario/"+ren.id.split('_')[1]; /* en el id contiene el numero de acreditado */
     }

     window.ver_e = function (ren){
          console.log(ren);
          location.href = "registrar-establecimiento/"+ren.id.split('_')[1];  /* en el id contiene el numero de establecimiento */
     }

     window.eliminar_e = function (ren){
            $('#siacepto').click(function(e){
                 $('#d_siacepto')[0].classList.add('d-none');
                 $('#msgModal').modal('hide');
                 console.log('entro a eliminar el establecimiento'+ren);
                 eliminar_e_aceptado(ren);
            });
            $('#d_siacepto')[0].classList.remove('d-none');
            
            crearMensaje(true,"Atención", " Esta seguro de eliminar el establecimiento?",0);
     }

     window.eliminar_e_aceptado = function (ren){
          console.log(ren);
          $.ajax({
                            type: 'delete',
                            url:  'api/establecimientos/'+ren.getElementsByTagName('td')[2].innerText+'/'+$('#nombre-usuario').data('email'),   /* obtiene el numero de RFC */
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                                  crearMensaje(true,"Atención", ' El establecimiento junto con sus inmuebles fueron borrados');
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

     window.queboton = function (ren){  /* edita un inmueble */
          if (ren.getElementsByTagName('td')[9].getElementsByTagName('p')[0].innerHTML=="Capturando") {
                return 'btn-editar';
          } else {
                return 'btn-ver';
          }
     }

     window.bole_ed = function (ren){  /* edita un inmueble */
          if (ren.getElementsByTagName('td')[9].getElementsByTagName('p')[0].innerHTML=="Capturando") {
             location.href = "crearexpediente/"+ren.dataset.id;
          } else {
             window.open("pdf/"+ren.getElementsByTagName('td')[1].getElementsByTagName('p')[0].innerHTML,'_blank');
          }
       
     }

/*
     window.consta_ed = function (ren){  
          location.href = "pdf/"+ren.dataset.id;
     }
*/

     window.infra_ed = function (ren){  /* edita un inmueble */
             var Data1 = {
                 };
                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/infractores/0/'+ren.dataset.id,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                                     var formi = $('form[id="f_infractores"]')[0];
                                     formi.dataset.id=data[0].id;
                                     muestradatos($('form[id="f_infractores"]')[0],data[0]);
                                     $('#datosgenerales').trigger("click");
                                     $('#nombredelinfractor')[0].innerHTML=$('#nombre_i')[0].value+' '+$('#primer_apellido_i')[0].value
                                                                                                  +' '+$('#segundo_apellido_i')[0].value;
                                     $('#nombre_i').focus();
                                     $('#c_infractor').addClass("active")
                                     $('#c_infractor').addClass("show")
                                     $('#c_infractores').removeClass("active")
                                     $('#c_infractores').removeClass("show")
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

     window.inmu_ver = function (ren){  /* consulta un inmueble */
          console.log(ren);
          //ides=ren.closest('#__sd').dataset.pnid.split('_')[1];  // id del establecimiento
          idin=ren.id.split('_')[1];   // id el inmueble
          location.href = mipath()+"inmuebles-registrados-secretaria/"+idin;
     }


     window.infra_el = function (ren){  /* elimina un infractor */
            $('#siacepto').click(function(e){
                 $('#d_siacepto')[0].classList.add('d-none');
                 $('#msgModal').modal('hide');
                 console.log('entro a eliminar un infractor'+ren);
                 infra_el_aceptado(ren);
            });
            $('#d_siacepto')[0].classList.remove('d-none');

            crearMensaje(true,"Atención", " Esta seguro de eliminar el infractor?",0);

     }
     window.infra_el_aceptado = function (ren){  /* elimina el infractor */
          console.log(ren);
          $.ajax({
                            type: 'delete',
                            url:  mipath()+'api/infractores/'+ren.getElementsByTagName('td')[0].innerText,   /* obtiene el numero de RFC */
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                                  //crearMensaje(true,"Atención", ' El inmueble fue borrado');
                                  var pn=ren.parentNode;
                                  //$("#"+pn.parentNode.parentNode.parentNode.dataset.pnid)[0].getElementsByTagName('td')[0].getElementsByTagName('p')[0].innerText=pn.getElementsByTagName('tr').length-2;
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


     window.ver_i = function (ren){  /* boton para ver los inmuebles de un establecimiento */
          $.ajax({
                            type: 'get',
                            url: 'api/inmuebles/'+ren.getElementsByTagName('td')[2].innerText+'/'+$('#nombre-usuario').data('email'),
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                            +ren.getElementsByTagName('button')[0].classList.add('active');
                            if (data.length>0) {
                                    var dis = {  id       : { header    : 'ID',  'class' : 'd-none'}
                                               , alias    : { header    : 'Alias'}
                                               , desalcaldia    : { header    : 'Alcaldia' }
                                               , calle_completa    : { header    : 'Calle'}
                                               , desestatus  : { header : 'Estatus'}
                                               , Ver      : { header    : 'Editar', 'boton' : true ,'classb' : 'btn-editar', 'funcion' : 'inmu_ed' }
                                               , Eliminar : { header    : 'Eliminar', 'boton' : true ,'classb' : 'btn-eliminar', 'funcion' : 'inmu_el' }
                                             }
                                  armadatagrid(data,dis,'dg_hija',true,ren);
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

     }

     window.ver_it = function (ren){  /* boton para ver los inmuebles de un establecimiento */
          ren.getElementsByTagName('button')[0].classList.toggle('active');
          if (ren.getElementsByTagName('button')[0].classList.contains('active')) {
              $.ajax({
                            type: 'get',
                            url: mipath()+'api/inmuebles/'+ren.getElementsByTagName('td')[2].innerText+'/'+ren.getElementsByTagName('td')[4].innerText,
                            headers: {'X-C1GSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data){
                            if (data.length>0) {
                                    var dis = {  id       : { header    : 'ID', 'class' : 'd-none' }
                                               , alias    : { header    : 'Alias'}
                                               , desalcaldia    : { header    : 'Alcaldia' }
                                               , calle_completa    : { header    : 'Calle'}
                                               , desestatus  : { header : 'Estatus'}
                                               , nivel_riesgo  : { header : 'Riesgo'}
                                               , Ver      : { header    : 'Ver Inmueble', 'boton' : true ,'classb' : 'btn-ver', 'funcion' : 'inmu_ver' }
                                          }
                                  armadatagrid(data,dis,'dg_hija',true,ren);
                            } else {
                                  crearMensaje(true,"Atención", ' No se encontraron inmuebles');
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


        /*window.crearMensaje = function (error,titulo,mensaje,tiempo=3000){
                var clase_mensaje = error==true?"avisos-alerta":"alert-success";
                var mensaje_alert = '<div class="avisos-alerta msj_js '+clase_mensaje+'">';
                mensaje_alert += '<p id="mensaje_negritas">'+titulo+'<span id="mensaje">' +mensaje+'</span></p>';
                mensaje_alert += '</div>';
                $("body").append(mensaje_alert);
                $(".msj_js").show();
        setTimeout(function(){
                $(".msj_js").remove();
        }, tiempo);
        }*/


        window.crearBotonDescarga = function (filesystem,quediv) {
                              if (quediv.hasClass('col-md-8')) {
                                 quediv.next()[0].getElementsByTagName('a')[0].href=mipath()+'storage/'+filesystem;
                              } else {
                              quediv[0].getElementsByTagName('input')[0].innerHTML=filesystem;
                              //quediv[0].getElementsByTagName('input')[0].value=filesystem;
                              quediv[0].getElementsByTagName('input')[0].setAttribute('data-archivo',filesystem)
                              quediv.addClass('col-md-8');
                              div = document.createElement('div');
                              div.setAttribute('class','col-md-4');
                              div.setAttribute('id',filesystem);
                              a=document.createElement('a');
                              a.setAttribute('href',mipath()+'storage/'+filesystem);
                              a.setAttribute('target','_blank');
                              a.setAttribute('class','btn-descargar');
                              tdCelda = document.createTextNode('Ver archivo')
                              a.appendChild(tdCelda);
                              div.appendChild(a);
                              quediv[0].parentNode.appendChild(div);
                              }
        }

   window.mipath = function () {
      var path = window.location.pathname;
      var pathName = path.substring(0, path.lastIndexOf('public/') + 7);
      return window.location.protocol+'//'+window.location.host+pathName;
   }
   window.apaga_pills = function () {
                          pills=$('a[id^="v-pills-"]');
                          for (var x in pills) {
                             console.log('pills'+pills[x].id);
                             if (pills[x].id!=undefined) {
                                pills[x].classList.remove('active');
                                pills[x].classList.remove('show');
                             }
                          }
                          pills=$('div[id^="v-pills-"]');
                          for (var x in pills) {
                             console.log('pills'+pills[x].id);
                             if (pills[x].id!=undefined) {
                                pills[x].classList.remove('active');
                                pills[x].classList.remove('show');
                             }
                          }

   }
   window.prende_pills = function (que) {
                    $('#v-pills-'+que)[0].classList.add('active');
                    $('#v-pills-'+que)[0].classList.add('show')
                    $('#v-pills-'+que+'-tab')[0].classList.add('active')
                    queparent=$('#v-pills-'+que+'-tab')[0].closest('div').parentNode;
                    $('a[href^="#'+queparent.id+'"]')[0].classList.add('active');
                    $('a[href^="#'+queparent.id+'"]')[0].classList.add('show');
                    queparent.classList.add('show');
   }

   window.cambia_dato = function (e) {
                  e.preventDefault();
                  var formdd = $('form[id="f_boleta"]')[0];
                  if ('id' in formdd.dataset) {
                         var id=formdd.dataset.id;
                  } else { var id=''; }
                  quedato=e.currentTarget.id.replace('wl_','');
                  quedato1=e.currentTarget;
                  if (e.currentTarget.type=='radio') {
                     quedato=e.currentTarget.name.replace('wl_','');
                  }
                  var Data1 = {};
                        Data1[quedato] = e.currentTarget.value;
                    $.ajax({
                       type: 'put',
                       url:  mipath()+'api/boletas/'+id,
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       data: Data1,
                       success: function(data){
                             if (formdd.dataset.id=='' && data.id!='') {
                                 formdd.dataset.id=data.id;
                             }
                       },
                       error: function( jqXhr, textStatus, errorThrown ){
                          quedato1.value=quedato1.defaultValue;
                          var errores=jqXhr.responseJSON.errors;
                          for (var x in errores) {
                                     crearMensaje(true,"Error ", errores[x]);
                                     if ('seccion' in errores) {
                                        $('#'+errores[x].seccion).trigger('click');
                                     }
                                     quedato1.focus();
                                     return false;
                          }
                       }
                    });
   }

   window.cambia_dato_infra = function (e) {
                  e.preventDefault();
                  var formdd = $('form[id="f_boleta"]')[0];
                  if ('id' in formdd.dataset) {
                         var id=formdd.dataset.id;
                  } 
                  if (id=="") { 
                    crearMensaje(true,"Error ", "El primer dato que debe de registrar es el número de boleta");
                    return;
                  }
                 
                  var formi = $('form[id="f_infractores"]')[0];
                  if ('id' in formi.dataset) {
                         var id_i=formi.dataset.id;
                  } else { var id_i=''; }
                  quedato=e.currentTarget.id.replace('wl_','');
                  quedato1=e.currentTarget;
                  if (e.currentTarget.type=='radio') {
                     quedato=e.currentTarget.name.replace('wl_','');
                  }
                  valor=e.currentTarget.value;
                  if (e.currentTarget.type=="checkbox") {
                     valor=e.currentTarget.checked;
                  }
                  var Data1 = {};
                        Data1[quedato] = valor;
                    $.ajax({
                       type: 'put',
                       url:  mipath()+'api/infractores/'+id+'/'+id_i,
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       data: Data1,
                       success: function(data){
                             if (formi.dataset.id=='' && data.id!='') {
                                 formi.dataset.id=data.id;
                             }
                       },
                       error: function( jqXhr, textStatus, errorThrown ){
                          quedato1.value=quedato1.defaultValue;
                          var errores=jqXhr.responseJSON.errors;
                          var x=0;
                          for (x in errores) {
                                     crearMensaje(true,"Error ", errores[x]).then(function() {
                                        if ('seccion' in errores) {
                                           $('#'+errores.seccion).trigger('click');
                                           $('div[name="opciones"]').removeClass('tst1');
                                           $('#'+errores.seccion).addClass('tst1');
                                        }
                                        $('#'+x).focus();
                                     });
                                     return false;
                          }
                       }
                    });
   }

   /* valida que ya se hubiese subido los archivos  en una forma */
   window.validaarchivos = function (forma) {
        console.log('entro en validar archivos');
        inputs=$('#'+forma)[0].getElementsByTagName('input');
        for (var x in inputs) {
             if (inputs[x].type=='file') {
                if ('archivo' in inputs[x].dataset) { }
                else {return false };
             }
        }
        return true;
   }

   window.validasimulacros = function (forma) {
     if ($("div[id^='simulacros_']").length>0) {
         $('#v-pills-simulacros-tab').children()[0].classList.remove('d-none')
     } else {
         $('#v-pills-simulacros-tab').children()[0].classList.add('d-none')
     }
   }

   window.validapuntos = function (forma) {
     if ($("div[id^='puntos_']").length>0) {
         $('#v-pills-punto-tab').children()[0].classList.remove('d-none')
     } else {
         $('#v-pills-punto-tab').children()[0].classList.add('d-none')
     }
   }


   /* marca que puestos ya fueron registrados 
           si valor es diferente de cero busca la figura*/
   window.marcapuesto = function (valor) {
         figura=$("#id_figuras option[value='" + valor + "']")[0].innerHTML.split("-")[0];
         //if ($("#id_figuras option[value='"+valor+"']")[0].dataset.unapersona==1) {   /*el puesto de una sola persona */
            //if ($('a[id^="v-pills"]:contains("' + figura + '")').children().hasClass('d-none')) {
              $('a[id^="v-pills"]:contains("'+figura+'")').children()[0].classList.remove('d-none');
            //} else {  $('a[id^="v-pills"]:contains("'+figura+'")').children()[0].classList.add('d-none'); }
         //}
   }

   /* marca el puesto por la descripcion del puesto */
   window.marcapuestoxdes = function (figura) {
            //if ($('a[id^="v-pills"]:contains("' + figura + '")').children().hasClass('d-none')) {
              try { $('a[id^="v-pills"]:contains("'+figura+'")').children()[0].classList.remove('d-none'); } catch (err) { };
            //((} else {  $('a[id^="v-pills"]:contains("'+figura+'")').children()[0].classList.add('d-none'); }
   }

   window.desmarcapuesto = function (figura,unapersona) {
         figurasp=figura.split("-")[0];
         if (unapersona==1) {
            if ($('a[id^="v-pills"]:contains("' + figurasp + '")').children().hasClass('d-none')) {
            } else {  $('a[id^="v-pills"]:contains("'+figurasp+'")').children()[0].classList.add('d-none'); }
         } else {
           if ($('p:contains("'+figura+'")').length==0) {
              $('a[id^="v-pills"]:contains("'+figurasp+'")').children()[0].classList.add('d-none');
           }
         }
   }

   window.cambiapersona = function (tipo) {
             if (tipo=="M") {
                 $('#lnombres').text("Razón social*");
                 $('#nombres').attr("placeholder","Escribe la razón social");
                 $('#apa').hide();
                 $('#nom').attr("class","col-md-12 mb-3");
                 $('#ama').hide();
                 $('#ape_pat').attr("required",false);
             }
             if (tipo=="F") {
                 $('#lnombres').text("Nombres(s)*");
                 $('#nombres').attr("placeholder","Escribe tu(s) nombre(s)");
                 $('#apa').show();
                 $('#nom').attr("class","col-lg-4");
                 $('#ama').show();
                 $('#ape_pat').attr("required",true);
             }

   }

/* muestra los textos de acuerdo al articulo y fraccion
 *     recibe las copiones y la opcioon seleccionada
 */
   window.muestra_textos = function (opciones,opcion) {
          if (opcion!=-1) {
               $("#textos").removeClass('d-none');
               $("#l_infraccion")[0].innerHTML=opciones[opcion].dataset.infraccion;
               $("#l_descripcion")[0].innerHTML=opciones[opcion].dataset.descripcion;
               if (opciones[opcion].dataset.conciliacion!="") {
                  $("#l_conciliacion")[0].innerHTML=opciones[opcion].dataset.conciliacion;
               }
               if (opciones[opcion].dataset.aplicarsi!="") {
                  $("#l_aplicarsi")[0].innerHTML=opcines[opcion].dataset.aplicarsi;
               }
               $("#l_tipo_sancion")[0].innerHTML='Tipo '+opciones[opcion].dataset.tipo_sancion;

               if (opciones[opcion].dataset.uc_desde!="") {
                  $("#l_uc")[0].innerHTML=" Unidad de cuenta desde "+opciones[opcion].dataset.uc_desde;
               }
               if (opciones[opcion].dataset.uc_hasta!="") {
                  $("#l_uc")[0].innerHTML+=" hasta "+opciones[opcion].dataset.uc_hasta;
               }

               if (opciones[opcion].dataset.servicio_desde!="") {
                  $("#l_hs")[0].innerHTML=" Horas de servicio desde "+opciones[opcion].dataset.servicio_desde;
               }
               if (opciones[opcion].dataset.servicio_hasta!="") {
                  $("#l_hs")[0].innerHTML+=" hasta "+opciones[opcion].dataset.servicio_hasta;
               }

               if (opciones[opcion].dataset.arresto_desde!="") {
                  $("#l_ha")[0].innerHTML=" Horas de arresto desde "+opciones[opcion].dataset.arresto_desde;
               }
               if (opciones[opcion].dataset.arresto_hasta!="") {
                  $("#l_ha")[0].innerHTML+=" hasta "+opciones[opcion].dataset.arresto_hasta;
               }
         } 
   }

   window.cambiapersona_l = function (tipo) {
             if (tipo=="M") {

                 $('#nombres_rl').attr("required",false);
                 $('#ape_pat_rl').attr("required",false);
                 $('#email_rl').attr("required",false);
                 $('#id_identificacion').attr("required",false);
                 $('#folioIdentificacion').attr("required",false);
                 $('#id_nacionalidad').attr("required",false);

                 $('#razon_social_rl').attr("required",true);
                 $('#folioacta_rl').attr("required",true);
                 $('#fechadeotorgamiento').attr("required",true);
                 $('#nombreexpide').attr("required",true);
                 $('#numeronotario_el').attr("required",true);
                 $('#id_entidad').attr("required",true);

                 $('[id^=fisi_').hide();
                 $('[id^=mora_').show();
             }
             if (tipo=="F") {
                 $('#nombres_rl').attr("required",true);
                 $('#ape_pat_rl').attr("required",true);
                 $('#email_rl').attr("required",true);
                 $('#id_identificacion').attr("required",true);
                 $('#folioIdentificacion').attr("required",true);
                 $('#id_nacionalidad').attr("required",true);

                 $('#razon_social_rl').attr("required",false);
                 $('#folioacta_rl').attr("required",false);
                 $('#fechadeotorgamiento').attr("required",false);
                 $('#nombreexpide').attr("required",false);
                 $('#numeronotario_el').attr("required",false);
                 $('#id_entidad').attr("required",false);

                 $('[id^=mora_').hide();
                 $('[id^=fisi_').show();
             }
   }
