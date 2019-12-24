if ($('main')[0].id=='altahorario') {
  fechas=$("div[name='fechas']");
  fechas.addClass('d-none');
  $("#idgrupo").focus();
  $(".boton-regresar").removeClass('d-none');
  $("#boton-regresar").attr("href", "./horarios");

  $("#idgrupo").change(function(e){
    $.ajax({
      type: 'get',
      url: mipath()+'api/actividades/0/'+$('#idgrupo')[0].value,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: '',
      success: function(data){
          $('#idactividad').children('option').remove();
          for(var x in data) {
             $('<option>').val(data[x].id).text(data[x].descripcion).appendTo('#idactividad');
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

  $("#sesiones").change(function(e){
      fechas=$("div[name='fechas']");
      fechas.addClass('d-none');
      fechas.map( function (index) {
          if (index<$("#sesiones")[0].value) { $(this).removeClass('d-none')  }
      });
  });

  $("#creahorario").click(function(e){
    e.preventDefault();
    var forms = document.getElementsByClassName('needs-validation-alcaldia');
    if (forms[0].checkValidity() === false) {
      forms[0].classList.add('was-validated');
      return;
    }

    var Data1 = {
      idgrupo: $('#idgrupo')[0].value,
      idactividad: $('#idactividad')[0].value,
      grupo: $('#grupo')[0].value,
      horade: $('#horade')[0].value,
      horahasta: $('#horahasta')[0].value,
      idtallerista :  $('#idtallerista')[0].value,
      cupo :  $('#cupo')[0].value,
      sesiones :  $('#sesiones')[0].value,
      fecha01 :  $('#fecha01')[0].value,
      fecha02 :  $('#fecha02')[0].value,
      fecha03 :  $('#fecha03')[0].value,
      fecha04 :  $('#fecha04')[0].value,
      fecha05 :  $('#fecha05')[0].value,
      fecha06 :  $('#fecha06')[0].value,
      fecha07 :  $('#fecha07')[0].value,
      fecha08 :  $('#fecha08')[0].value,
      fecha09 :  $('#fecha09')[0].value,
      fecha10 :  $('#fecha10')[0].value,
      calle_h :  $('#calle_h')[0].value,
      exterior_h :  $('#exterior_h')[0].value,
      cp_h :  $('#cp_h')[0].value,
      colonia_h :  $('#cp_h')[0].value,
      id_alcaldia_h :  $('#id_alcaldia_h')[0].value,
      estatus :  $('#estatus')[0].value,
    };

    $.ajax({
      type: 'post',
      url: mipath()+'api/horarios',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: Data1,
      success: function(data){
        crearMensaje(true,"Atención", 'Registro exitoso del horario',0).then(function() {
             $("#boton-regresar")[0].click()
        });
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
}
