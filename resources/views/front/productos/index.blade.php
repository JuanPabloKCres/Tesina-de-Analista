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
			<div class="content-block" id="portfolio">
				<div class="container portfolio-sec">
					<header class="block-heading cleafix">
						<a  onclick="ocultarBusqueda();" class="btn btn-o btn-lg pull-right"><i id="bot-buscar" class="fa fa-search"> Mostrar Filtros</i></a>
						<div class="title-page">
							<p class="main-header">Productos </p>
						    <p class="sub-header">Heche un vistazo a los productos con los que trabajamos</p>
					    </div>
					</header>	
					@include('front.productos.cabeceraTabla')
					@include('front.productos.contenidoTabla')
				</div>
			</div>
			<button id="boton-modal" class="hide" data-toggle="modal" data-target=".bs-example-modal-lg"></button>
			@include('front.partes.pie')
		</div>		
		@include('front.partes.scripts')
	    <script src="{{ asset('js/productos.js') }}"></script>
	    <script>
	        var route = "/productos";
	    </script>
	</body>
</html>