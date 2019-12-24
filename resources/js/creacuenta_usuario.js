if ($('main')[0].id=='notienecuenta') {
        $("#alc-nombres").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#alc-ape_pat").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#alc-ape_mat").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#puesto").keyup(function(e){ e.currentTarget.value=e.currentTarget.value.toLocaleUpperCase(); })
        $("#alc-nombres").focus();
  $(".boton-regresar").removeClass('d-none');
  $("#creacuenta-usuario").click(function(e){
    e.preventDefault();
    var forms = document.getElementsByClassName('needs-validation-alcaldia');
    if (forms[0].checkValidity() === false) {
      forms[0].classList.add('was-validated');
      return;
    }
    if ($('#alc-email')[0].value!=$('#alc-email-confirma')[0].value) {
        crearMensaje(true,"Atención", 'La confirmación del email es incorrecta').then(function() {
             $('#alc-email-confirma')[0].focus();
        });
        return;
    }
    if ($('#alc-password')[0].value!=$('#alc-password_confirma')[0].value) {
        crearMensaje(true,"Atención", 'La confirmación de la contraseña es incorrecta').then(function() {
             $('alc-password_confirma')[0].focus();
        });
        return;
    }
    var Data1 = {
      nombres: $('#alc-nombres')[0].value,
      email: $('#alc-email')[0].value,
      ape_pat: $('#alc-ape_pat')[0].value,
      ape_mat: $('#alc-ape_mat')[0].value,
      idperfil: $('#idperfil')[0].value,
      password :  $('#alc-password')[0].value,
      puesto :  $('#puesto')[0].value,
      num_telefono :  $('#num_telefono')[0].value,
      activo :  $("input[name='activo']:checked").val(),
      idperfiltallerista :  $('#idperfiltallerista')[0].value,
      password_confirmation :  $('#alc-password_confirma')[0].value
    };

    $.ajax({
      type: 'post',
      url: mipath()+'api/register?usuario',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: Data1,
      success: function(data){
        crearMensaje(true,"Atención", 'Registro exitoso de el usuario con el correo <br><b>'+$('#alc-email')[0].value+'</b><br>Al usuario le va a llegar un email con instrucciones',0).then(function() {
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
    });
  });
}
