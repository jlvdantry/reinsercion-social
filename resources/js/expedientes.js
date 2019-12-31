if ($('main')[0].id=='expedientes') {
        $("#nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#ape_pat").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#ape_mat").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#alias").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#curp").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#carnet").focus();
        $(".boton-regresar").removeClass('d-none');
        $("#boton-regresar").attr("href", mipath()+"beneficiarios");
        $('div[name="opciones"]').on('click', function(e) {
              $('div[name="tabi"]').addClass('d-none');
              $('div[name="opciones"]').removeClass('tst1');
              $("#"+e.currentTarget.dataset.href).removeClass('d-none');
              $('#'+e.target.id).addClass('tst1');
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


        if (window.location.href.split('/').length==6) {    /*  muestra una boleta */
           if (window.location.href.split('/')[5]!='') {
              ID=window.location.href.split('/')[5];
              $("#titulo").text("Cambio de beneficiario");
              $("#f_altabeneficiario").data("id",ID);
                  var Data1 = {
                    };

                  $.ajax({
                            type: 'get',
                            url: mipath()+'api/beneficiarios/'+ID,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: Data1,
                            success: function(data){
                            if (data.length>0) {
                                //formb.dataset.id=data[0].id;
                                //$('#des_expediente')[0].innerHTML='Boleta-'+data[0].boleta_remision;
                                muestradatos($('form[id="f_altabeneficiario"]')[0],data[0]);
                                //muestradatos($('form[id="f_motivo"]')[0],data[0]);
                                //muestradatos($('form[id="f_quienfirma"]')[0],data[0]);
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

  $("#crea-beneficiario").click(function(e){
    e.preventDefault();
    var forms = document.getElementsByClassName('needs-validation-alcaldia');
    if (forms[0].checkValidity() === false) {
      forms[0].classList.add('was-validated');
      return;
    }
    if ($("#pes")[0].checked==false && $("#pc")[0].checked==false) {
        crearMensaje(true,"Atención", 'Debe de seleccionar el tipo de alta').then(function() {
             $('#pes').focus();
        });
        return;
    }
    if ($("#dp")[0].checked==false && $("#ab")[0].checked==false && $("#sc")[0].checked==false) {
        crearMensaje(true,"Atención", 'Seleccione el tipo de residencia').then(function() {
             $('#dp').focus();
        });
        return;
    }
    if ($("#mas")[0].checked==false && $("#fem")[0].checked==false) {
        crearMensaje(true,"Atención", 'Seleccione el sexo').then(function() {
             $('#mas').focus();
        });
        return;
    }
    var Data1 = {
      tipodealta: $("input[name='tipodealta']:checked").val(),
      idacercamiento: $("#idacercamiento")[0].value,
      identeros: $("#identeros")[0].value,
      curp: $("#curp")[0].value,
      nombres: $('#nombres')[0].value,
      ape_pat: $('#ape_pat')[0].value,
      ape_mat: $('#ape_mat')[0].value,
      nacimiento: $('#nacimiento')[0].value,
      idetnia: $('#idetnia')[0].value,
      idestudio: $('#idestudio')[0].value,
      idocupacion: $('#idocupacion')[0].value,
      sexo: $("input[name='sexo']:checked").val(),
      identidad: $("#identidad")[0].value,
      idecivil: $("#idecivil")[0].value,
      hijos: $("#hijos")[0].value,
      edades: $("#edades")[0].value,
      alias: $("#alias")[0].value,
      tiporesidencia: $("input[name='tiporesidencia']:checked").val(),
      calle_b: $("#calle_b")[0].value,
      exterior_b: $("#exterior_b")[0].value,
      interior_b: $("#interior_b")[0].value,
      cp_b: $("#cp_b")[0].value,
      colonia_b: $("#colonia_b")[0].value,
      id_alcaldia_b: $("#id_alcaldia_b")[0].value,
      unidad: $("#unidad")[0].value,
      telfijo: $("#telfijo")[0].value,
      num_telefono :  $('#num_telefono')[0].value,
      email: $('#email')[0].value,
      telfijo: $("#telfijo")[0].value,
      nombres_c: $('#nombres_c')[0].value,
      parentesco_c :  $('#parentesco_c')[0].value,
      tel_c :  $('#tel_c')[0].value,
      calle_c: $("#calle_c")[0].value,
      exterior_c: $("#exterior_c")[0].value,
      interior_c: $("#interior_c")[0].value,
      cp_c: $("#cp_c")[0].value,
      colonia_c: $("#colonia_c")[0].value,
      id_alcaldia_c: $("#id_alcaldia_c")[0].value,
      activo :  1
    };

    if  ($("#f_altabeneficiario").data("id")=="") {
      $.ajax({
      type: 'post',
      url: mipath()+'api/beneficiarios',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: Data1,
      success: function(data){
        crearMensaje(true,"Atención", 'El beneficiario <b>'+Data1.nombres+'</b> ha sido dado de alta con exito.<br>'+
                                      'Si registraste un correo electrónico le llegará uno con información para que pueda teclear su contraseña',0).then(function() {
             $("#boton-regresar")[0].click()
        });
      },
      error: function( jqXhr, textStatus, errorThrown ){
        var errores=jqXhr.responseJSON.errors;
        for (var x in errores) {
          crearMensaje(true,"Error ", errores[x]);
          break;
        }
      }
      }) 
   } else {
      $.ajax({
      type: 'put',
      url: mipath()+'api/beneficiarios/'+$("#f_altabeneficiario").data("id"),
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: Data1,
      success: function(data){
        crearMensaje(true,"Atención", 'El beneficiario <b>'+Data1.nombres+'</b> ha sido actualizado con exito.<br>'
                                      ,0).then(function() {
             $("#boton-regresar")[0].click()
        });
      },
      error: function( jqXhr, textStatus, errorThrown ){
        var errores=jqXhr.responseJSON.errors;
        for (var x in errores) {
          crearMensaje(true,"Error ", errores[x]);
          break;
        }
      }
      })
   }

  });
}
