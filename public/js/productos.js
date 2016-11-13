
function enviar ()
{	
	$.ajax({
		url:route,
		data:{
			nombre: $('#bus-nombre').val(),
			idtipo: $('#bus-tipo').val(),
			estado: $('#bus-estado').val(),
		},
		type: 'GET',
		dataType: 'json',
		success: function(data){
			$(".tablaResultados").html(data);			
		}
	});
}