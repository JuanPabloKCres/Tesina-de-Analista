<!DOCTYPE html>
<html class="noIE" lang="es-AR">
	<head>
		<title>GN Soluciones Gráficas - Resistencia-Chaco</title>
		@include('front.partes.estilos')
	</head>
	<body>
		@include('front.partes.cabeceraPartes')
		<div id="modalProducto"></div>		
		<div class="content-block parallax" id="parallax"></div>
		<div id="wrapper">
			<div class="content-block" id="portfolio">
				<div class="container portfolio-sec">
					<header class="block-heading cleafix">
						<a  onclick="ocultarBusqueda();" class="btn btn-o btn-lg pull-right"><i id="bot-buscar" class="fa fa-search"> Mostrar Filtros</i></a>
						<div class="title-page">
							<p class="main-header">Gran variedad! </p>
						    <p class="sub-header">Heche un vistazo a los rubros con los que trabajamos</p>
					    </div>
					</header>	
					@include('front.tipos.cabeceraTabla')
					@include('front.tipos.contenidoTabla')
				</div>
			</div>
			<button id="boton-modal" class="hide" data-toggle="modal" data-target=".bs-example-modal-lg"></button>
			@include('front.partes.pie')
		</div>
		@include('front.partes.scripts')
	    <script src="{{ asset('js/tipos.js') }}"></script>
	    <script>
	        var route = "/tipos";
	    </script>
	</body>
</html>