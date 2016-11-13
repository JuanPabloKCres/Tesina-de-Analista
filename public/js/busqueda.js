$(document).ready(function () {
    constructorTabla();
    constructorSelect();
    verificarVacio();
    $("#"+listSidebar).addClass("active");
    $('#form-crear').parsley();
    $('#form-actualizar').parsley();
    $('#form-pass').parsley();


    $('#idFechaAuditoriaInicio').datepicker.dates['es'] = {
         days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "SÃ¡bado"],
         daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "SÃ¡b"],
         daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
         months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
         monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
         today: "Hoy",
         clear: "Borrar"
     };
     $('#idFechaAuditoriaInicio').datepicker({
         language: 'es',
         todayHighlight: true,
         format: "dd-mm-yyyy",
         todayBtn: "linked",
         startDate: "01-01-2016",
         endDate: "1d"
     });


     $('#idFechaAuditoriaFin').datepicker.dates['es'] = {
         days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "SÃ¡bado"],
         daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "SÃ¡b"],
         daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
         months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
         monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
         today: "Hoy",
         clear: "Borrar"
     };

     $('#idFechaAuditoriaFin').datepicker({
         language: 'es',
         todayHighlight: true,
         format: "dd-mm-yyyy",
         todayBtn: "linked",
         endDate: "1d"
     });


});



function cambio() {
     if (($('#idFechaAuditoriaInicio').val() !== "") && ($('#idFechaAuditoriaFin').val() === "")) {
          $('#idFechaAuditoriaFin').val($('#idFechaAuditoriaInicio').val());
      } else if (($('#idFechaAuditoriaFin').val() !== "") && ($('#idFechaAuditoriaInicio').val() === "")) {
          $('#idFechaAuditoriaInicio').val($('#idFechaAuditoriaFin').val());
      }
      $('#idFechaAuditoriaFin').datepicker('setStartDate', $('#idFechaAuditoriaInicio').val());
      $('#idFechaAuditoriaInicio').datepicker('setEndDate', $('#idFechaAuditoriaFin').val());
  }



function cambiarVista(vista)
{
	if (vista == 2)
	{
		$('#tab-lista').removeClass("hide");
		$('#tab-logos').addClass("hide");
		$('#bot-mostrar').addClass("hide");
		$('#busqueda').addClass("hide");
    $('#bot-buscar').html('<i class="fa fa-search" aria-hidden="true"></i>  Mostrar Filtros');
	}
	else
	{
     	$('#tab-logos').removeClass("hide");
     	$('#bot-mostrar').removeClass("hide");
	  	$('#tab-lista').addClass("hide");
	}
}

function ocultarBusqueda()
{
	if ($('#busqueda').hasClass('hide')){
		  $('#bot-buscar').html('<i  class="fa fa-search" aria-hidden="true"></i> Ocultar filtros');
   		$('#busqueda').removeClass("hide");
    }else{
     	$('#busqueda').addClass("hide");
     	$('#bot-buscar').html('<i  class="fa fa-search" aria-hidden="true"></i> Mostrar filtros');
    }
}

function verificarVacio() // este metodo lanza el modal para crear un registro para el lugar ingresado cando se detecta que no existen elementos de ese tipo.
{
    if(elemFaltante !== 'nada'){
        $('.elementoFaltante').html(elemFaltante);
        $('#botonmodal').html('<i class="fa fa-plus-circle" aria-hidden="true"></i> Registrar '+elemFaltante);
        $('#botonmodal').click();
    }
}
