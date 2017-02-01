<div class="content-block" id="footer">
	<div class="container">
		<div class="row">
			<br>
			<br>
			<br>
			<div class="col-sm-4 blog-post">				
				<h2 class="footer-block">Tiene preguntas, consultas?</h2>
				<p>Dejenos su email o teléfono de contacto y le adjuntaremos un catalogo de productos a la brevedad.</p><p> </p><p> </p>
				<p> </p>
				<p> </p><p>



				</p><p>
				<h3 class="modal-content thumbnail" style="background-color: #f5e79e"><p><b>HORARIO DE ATENCIÓN:</b></p>
					<p>Lunes a Viernes de 8 a 12hs y 17 a 20:30hs</p>
					<p> </p></h3>

			</div>

			<div class="col-sm-4 blog-post">
				<h2 class="footer-block">Dejenos su mensaje</h2>
							<div class="form-group">
								<!--<div class="panel-heading"><h3 class="panel-title"></h3></div>-->
								<div class="panel-body">
									{!! Form::open(['route' => 'mail.store', 'method' => 'post']) !!}
									<div class="form-group">
										{!! Form::text('name', null ,array('class' => 'form-control', 'placeholder' => 'Su nombre..')) !!}
									</div>
									<div class="form-group">
										{!! Form::email('email', null ,array('class' => 'form-control', 'placeholder' => 'Su email..')) !!}
									</div>
									<div class="form-group">
										{!! Form::tel('telefono', null, array('class' => 'form-control', 'placeholder' => 'Su telefono (no obligatorio)')) !!}
									</div>
									<div class="form-group">
										{!! Form::textarea('mensaje', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Mensaje' ]) !!}
									</div>

									<div class="form-group">
										{!! Form::submit('Enviar', ['class' => 'btn btn-o-white' ] ) !!}
									</div>
									{!! Form::close() !!}
								</div>
							</div>
			</div>


			<div class="col-sm-4 blog-post">
				<h2 class="footer-block">Detalles de Contacto</h2>
				<ul>
					<li class="address-sub"><i class="fa fa-map-marker"></i>Direccion de Oficinas</li>
						<p>
							Arbo y Blanco 789 - Resistencia Chaco, Argentina)
						</p>
					<li class="address-sub"><i class="fa fa-phone"></i>Teléfonos de Contacto</li>
						<p>
							Local: 3624-xxxxxx<br>
							Celular: 3624-xxxxxx
						</p>
					<li class="address-sub"><i class="fa fa-envelope-o"></i>Correo Electronico</li>
						<p>
							<a href="mailto: info.gnsoluciones@gmail.com" target="info.gnsoluciones@gmail.com"></a>
						</p>
				</ul>
			</div>
		</div>
	</div>
@include('front.partes.mapa')


</div>