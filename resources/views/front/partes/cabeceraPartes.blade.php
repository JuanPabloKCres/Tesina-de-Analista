<header class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-xs-5 col-sm-4 header-logo">
				<br>
				<a href="index.html"> 
					<h1 class="logo">GN Soluciones <span class="logo-head"></span></h1>
				</a>
			</div>
			<div class="col-md-8 col-md-offset-1 col-xs-7">
				<nav class="navbar navbar-default">
				  	<div class="container-fluid nav-bar">
					    <div class="navbar-header">
					      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						        <span class="sr-only"> </span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
					      	</button>
					    </div>
					    <div class="collapse navbar-collapse navbar-def" id="bs-example-navbar-collapse-1">
					      
					      	<ul  class="nav navbar-nav navbar-right">
					        	<li >
									<a href="" onclick="redirigir('/');"><i class="fa fa-home"></i> Inicio</a>
								</li>
								<li>
									<a href="" onclick="redirigir('/institucional');"><i class="fa fa-bookmark"></i> Acerca de nosotros</a>
								</li>
								<li>
									<a href="" onclick="redirigir('{{ route('tipos.index') }}');"><i class="fa fa-registered"></i> Tipos</a>
								</li>
								<li>
									<a href="" onclick="redirigir('{{ route('productos.index') }}');"><i class="fa fa-shopping-cart"></i> Productos</a>
								</li>										
								<li>
									<a href="" onclick="redirigir('/contacto');"><i class="fa fa-phone"></i> Contacto</a>
								</li>
								<li>
									<a href="" onclick="redirigir('{{ route('admin.auth.login') }}');"><i class="fa fa-sign-in"></i> Ingresar</a>
								</li>
								<li>

								</li>
					      	</ul>
					    </div>
				  	</div>
				</nav>
			</div>
		</div>
	</div>
</header>