function enviar ()
{	
	$.ajax({
		url:route,
		data:{
			nombre: $('#bus-nombre').val(),
			idrubro: $('#bus-rubro').val(),
			idorigen: $('#bus-origen').val()
		},
		type: 'GET',
		dataType: 'json',
		success: function(data){
			$(".tablaResultados").html(data);			
			$('#input-filtro').select();
		}
	});
}


var h_a_m = $('#h_a_m').val();
var h_c_m = $('#h_c_m').val();
var h_a_t = $('#h_a_t').val();
var h_c_t = $('#h_c_t').val();

$('#registrarProveedor-btn').click(function(){
	alert('Se apreto el boton!');
	if(h_a_m > h_c_m){
		alert('La hora de cierre a la mañana no puede ser antes que la hora de apertura');
	}
	if(h_a_t > h_c_t){
		alert('La hora de cierre a la tarde no puede ser antes que la hora de apertura');
	}
});

//alert('Si, se entra a proveedores.js');

/*
$("#h_c_m").keypress(function () {
}).keyup(function () {
	var horaCierre_Mañana = $("#h_a_m option:selected").val();
	validarHorario("horaCierre_Mañana", horaCierre_Mañana);
});
*/


//$('#h_c_m').rules('add', { mayorQue: "#h_a_m" });


/** Validar que la hora de cierre (Mañana) es mayor a la de apertura **/
/*
jQuery.validator.addMethod("mayorQue",
	function(value, element, params) {
		if (!/Invalid|NaN/.test(new Date(value))) {
			return new Date(value) > new Date($(params).val());
		}
		return isNaN(value) && isNaN($(params).val())
			|| (Number(value) > Number($(params).val()));
	},'Debe ser mayor a {0}.');
	*/
/*********************************************************************/
