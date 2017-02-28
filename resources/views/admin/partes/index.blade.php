<!DOCTYPE html>

<html>
<head>
	<?php
	header("Access-Control-Allow-Origin: *");
	?>
	<title>@yield('title','Default') | GN Soluciónes</title>
	@include('admin.partes.estilos')  {{ csrf_field() }}
</head>
<body>{{ csrf_field() }}
	<a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
	@include('admin.partes.navTop') 	
	<div id="wrapper">
	@yield('sidebar')
        <div id="page-wrapper">                      
            <section>            	
				@yield('content')
			</section>
			@include('admin.partes.pie')
        </div>				
	</div>
	@include('admin.partes.scripts')
	@yield('script')
</body>
</html>