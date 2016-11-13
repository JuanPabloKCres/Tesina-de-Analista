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