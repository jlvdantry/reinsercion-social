
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

     window.estatususuario = function (x) {
         return x=='Activo' ? 'font-weight-normal text-success' : 'font-weight-bold text-danger' ;
     }

     window.estatushorario = function (x) {
         return x=='Activo' ? 'font-weight-normal text-success' : 'font-weight-bold text-danger' ;
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


   window.mipath = function () {
      var path = window.location.pathname;
      var pathName = path.substring(0, path.lastIndexOf('public/') + 7);
      return window.location.protocol+'//'+window.location.host+pathName;
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

