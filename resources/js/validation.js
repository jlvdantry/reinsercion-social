/*
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);

})();
*/

//Validación por medio de expresiones regulares
//Nombres y apellidos
$(document).ready(function() {
    $(".names").bind("keypress", function(event) {
        if (event.charCode != 0) {
            var regex = new RegExp("^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s. ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });

//Números como telefónicos o campos exclusivamente llenados con números
    $(".numbers").bind("keypress", function(event) {
        if (event.charCode != 0) {
            var regex = new RegExp("^[0-9-]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });

//Permite carácteres propios del RFC y del CURP
//(sin carácteres especiales)
    $(".rfc-curp").bind("keypress", function(event) {
        if (event.charCode != 0) {
            var regex = new RegExp("^[a-zA-Z\-0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });

//Permite letras y números, pues sirven para los nombres de calles
//y números exteriores e interiores, permite algunos carácteres
//especiales como - . #
    $(".street-names").bind("keypress", function(event) {
        if (event.charCode != 0) {
            var regex = new RegExp("^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9-. ]*$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });

//Restringe carácteres no propios de los correos
//electrónicos, como espacios y signos, exceptuando
//punto y guiones
		$(".email").bind("keypress", function(event) {
        if (event.charCode != 0) {
            var regex = new RegExp("^[a-zA-Z0-9@.-_]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });


    //Números como telefónicos o campos exclusivamente llenados con números
        $(".coords").bind("keypress", function(event) {
            if (event.charCode != 0) {
                var regex = new RegExp("^[0-9-.]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            }
        });

});

//Permite letras y números, pues sirven para los nombres de calles
//y números exteriores e interiores, permite algunos carácteres
//especiales como - . # / ( )
    $(".names-all").bind("keypress", function(event) {
        if (event.charCode != 0) {
            var regex = new RegExp("^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9-!@#$&()\\-`. +,/\"]*$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });

