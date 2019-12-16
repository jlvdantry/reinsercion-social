
$('.btn-submenu').on('click', function() {
  $('.btn-submenu').removeClass('active');
  $('.btn-registro').removeClass('active');
  $('.btn-arrow').removeClass('active');

})

$('.btn-submenu01').on('click', function() {
  $('#menu-informacion').addClass('active');
  $('#btn-informacion').addClass('active');


})

$('.btn-submenu02').on('click', function() {
  $('#menu-inmueble').addClass('active');
  $('#btn-inmueble').addClass('active');

})

$('.btn-submenu03').on('click', function() {
  $('#menu-acciones').addClass('active');
  $('#btn-acciones').addClass('active');

})

$('.btn-submenu04').on('click', function() {
  $('#menu-comite').addClass('active');
  $('#btn-comite').addClass('active');

})

$('.btn-registro').on('click', function() {
  $('.btn-registro').removeClass('active');
  $('.btn-submenu').removeClass('active');
  $('.btn-arrow').removeClass('active');
})

$('.btn-mostrar').on('click', function() {
  $('.btn-mostrar').addClass('active');
})
