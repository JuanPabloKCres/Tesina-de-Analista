function enviar ()
{	
	$.ajax({
		url:route,
		data:{
			nombre: $('#bus-nombre').val(),
			//idempresa: $('#bus-empresa').val(),
			estado: $('#bus-estado').val()
		},
		type: 'GET',
		dataType: 'json',
		success: function(data){
			$(".tablaResultados").html(data);			
			$('#input-filtro').select();
		}
	});
}