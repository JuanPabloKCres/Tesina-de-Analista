<section class="block-body tablaResultados">
	<div class="row">
		@if (count($productos) === 0)
	        @include('front.partes.sinResultados')
	    @else
    		@foreach($productos as $producto)
		        @if ($producto->imagen === "sin imagen")
		            <div class="col-sm-4">
						<a class="recent-work " onclick="cargarModal({{ $producto->id }})" style="background-image:url({{ asset('imagenes/productos/sin-logo.jpg') }})">
							<span class="btn btn-o-white"> ver detalle - 
                                <?php 
                                    if (strlen($producto->nombre)>20) {
                                       echo (substr($producto->nombre , 0, 20)."...");
                                    }                                                                                   
                                    else {
                                      echo ($producto->nombre);
                                    }
                                ?>
                            </span>
						</a>
					</div>							
		    	@else
		            <div class="col-sm-4">
						<a class="recent-work" onclick="cargarModal({{ $producto->id }})" style="background-image:url({{ asset('imagenes/productos/' . $producto->imagen) }})">
							<span class="btn btn-o-white"> ver detalle -
                                <?php
                                    if (strlen($producto->nombre)>20) {
                                       echo (substr($producto->nombre , 0, 20)."...");
                                    }
                                    else {
                                      echo ($producto->nombre);
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