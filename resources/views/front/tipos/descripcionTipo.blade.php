<div class="content-block parallax" id="services">
	<section class="block-body">
		<div class="row">
			<div class="row">
			    <div class="col-md-12">
			        <div class="row mtl">
			            <div class="col-md-4">
			                @if ($tipo->imagen === "sin imagen")
			                    <div class="form-group">
			                        <div class="text-center mbl"><img src="{{ asset('tipos') }}" alt="" style="width:550px;height:350px" class="img-thumbnail"/></div>
			                    </div>  
			                @else
			                    <div class="form-group">
			                        <div class="text-center mbl"><img src="{{ asset('imagenes/tipos/' . $tipo->imagen) }}" alt="" style="width:350px;height:350px" class="img-thumbnail"/></div>
			                    </div>                                   
			                @endif                                                 
			            </div>
			            <div class="col-md-7"> 
			            <a  href="#portfolio" onclick="ocultarProductos();" class="btn btn-o btn-lg pull-right"><i id="bot-buscar2" class="fa fa-list"> Mostrar sus Productos</i></a>     
			            	<div class="title-page">
								<p class="main-header">{{ $tipo->nombre }} </p>
								<p class="sub-header">Etcetera</p>
							</div>           
							<br><br><br><br>                   
			                <table class="table table-striped table-hover">
			                    <tbody> 

			                        <tr>
			                            <td><h4 class="box-heading">Nombre:</h4></td>
			                            <td><h4>{{ $tipo->nombre }}</h4></td>
			                        </tr> 

			                            <td><h4 class="box-heading">Cantidad de productos que disponemos:</h4></td>
			                            <td><h4>{{ $productos->count() }} productos</h4></td>
			                        </tr>                                                                                         
			                    </tbody>
			                </table>                            
			            </div>
			        </div>  
			    </div>                          
			</div>
		</div>
	</section>		
</div>
<div class="content-block hide animated pulse" id="portfolio">
	<div class="container portfolio-sec">
		{!! Form::select('bus-tipo', array($tipo->id => 'tipo seleccionado'), $tipo->id, ['class' => 'hide', 'id' => 'bus-tipo']) !!}
		<header class="block-heading cleafix">
			<a  onclick="ocultarBusqueda();" class="btn btn-o btn-lg pull-right"><i id="bot-buscar" class="fa fa-search"> Mostrar Filtros</i></a>
			<div class="title-page">
				<p class="main-header">Productos  </p>
			    <p class="sub-header">Heche un vistazo a los Productos que contamos de este rubro</p>
		    </div>
		</header>	
		@include('front.tipos.cabeceraProductoTipo')
		@include('front.productos.contenidoTabla')
	</div>
</div>