<div class="col-lg-12">
	<div class="note note-warning">
		<h3 class="box-heading">¡No hay nada!</h3>
				@if ($fecha1 == $fecha2)
					<p>No se registraron ventas en la fecha: <b class="elementoFaltante">{{ $fecha1 }}</b></p>
				@else
					<p>No se hallaron ventas registradas dentro del rango de fechas que va desde el  <b class="elementoFaltante">{{ $fecha1 }}</b> hasta el <b class="elementoFaltante">{{ $fecha2 }}</b></p>
				@endif
	</div>
</div>
