<section class="block-body tablaResultados">
	<div class="row">
		@if (count($tipos) === 0)
	        @include('front.partes.sinResultados')
	    @else
			@foreach($tipos as $tipo)
		        @if ($tipo->imagen === "sin imagen")
		            <div class="col-sm-4">
						<a class="recent-work " href="{{ route('tipos.show', $tipo->id) }}" style="background-image:url({{ asset('imagenes/tpos/sin-logo.jpg') }})">
							<span class="btn btn-o-white">Ver los productos de esta clase
                                <?php 
                                    if (strlen($tipo->nombre)>20) {
                                       echo (substr($tipo->nombre , 0, 20)."...");
                                    }                                                                                   
                                    else {
                                      echo ($tipo->nombre);
                                    }
                                ?>
							</span>
						</a>
					</div>							
		    	@else
		            <div class="col-sm-4">
						<a class="recent-work" href="{{ route('tipos.show', $tipo->id) }}" style="background-image:url({{ asset('imagenes/tipos/' . $tipo->imagen) }})">
							<span class="btn btn-o-white">Ver todos los productos de esta clase
                                <?php 
                                    if (strlen($tipo->nombre)>20) {
                                       echo (substr($tipo->nombre , 0, 20)."...");
                                    }                                                                                   
                                    else {
                                      echo ($tipo->nombre);
                                    }
                                ?>
							</span>
						</a>
					</div>
		    	@endif   
			@endforeach  				
	    @endif  
	</div>
</section>