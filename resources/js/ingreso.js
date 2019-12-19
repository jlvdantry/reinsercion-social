$(document).ready(function() {
      $(function() {
          $('.selectpicker').selectpicker();
      });

     setTimeout(function(){
                $('#msgModal').modal('hide');
                resolve();
       }, 60000);


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
})

