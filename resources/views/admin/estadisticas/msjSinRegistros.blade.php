<div class="col-lg-12">
	<div class="note note-warning">
		<h2 class="box-heading">¡No hay ventas!</h2>
				@if ($fecha1 == $fecha2)
					<h4><p>No se registraron pedidos entregados (y pagados) en la fecha: <b class="elementoFaltante">{{ $fecha1 }}</b></p></h4>
				@else
					<h4><p>No se hallaron pedidos entregados (y cobrados) dentro del intervalo de fechas que va desde el  <b class="elementoFaltante">{{ $fecha1 }}</b> hasta el <b class="elementoFaltante">{{ $fecha2 }}</b></p></h4>
				@endif
	</div>
</div>
