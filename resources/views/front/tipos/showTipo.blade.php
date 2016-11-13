<!DOCTYPE html>
<html class="noIE" lang="es-AR">
	<head>
		<title>GN Soluciones - Resistencia-Chaco</title>
		@include('front.partes.estilos')
	</head>
	<body>
		@include('front.partes.cabeceraPartes')
		<div id="modalProducto"></div>		
		<div class="content-block parallax" id="parallax"></div><!-- #parallax -->
		<div id="wrapper">
			@include('front.tipos.descripcionTipo')
			
		</div>
		<button id="boton-modal" class="hide" data-toggle="modal" data-target=".bs-example-modal-lg"></button>
		@include('front.partes.pie')
		@include('front.partes.scripts')
	    <script src="{{ asset('js/productos.js') }}"></script>
	    <script>
	        var route = "/productos";
	    </script>
	</body>
</html>