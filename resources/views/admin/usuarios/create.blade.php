<div id="modal-config" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Registrar usuario</h4>
            </div>
            <div class="modal-body">               
                @if ($errors->any())
                     <div class="alert alert-warning alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <strong>¡Atención!</strong> 
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>                        
                    </div>
                @endif
{!! Form::open(['route' => 'admin.usuarios.store', 'id' =>'form-crear', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}
                    <h3>Detalles de la Cuenta</h3>
                      <br>
                        <div class="form-group"><label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-envelope"></i>
                                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '100', 'required']) !!}                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-lock"></i>
                                             {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'campo requerido', 'required']) !!}                                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Confirmar Password</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-lock"></i>
                                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'campo requerido', 'required']) !!}                                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr/>  
                        <br>                                         
                        <h3>Detalles del perfil</h3>
                        <br>
                        <div class="form-group"><label class="col-sm-3 control-label">Nombre/s</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required']) !!}                                                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Apellido</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        {!! Form::text('apellido', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required']) !!} 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Imagen de Perfil</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                                <i class="fa fa-upload"></i>
                                            {!! Form::file('imagen', ['class' => 'form-control']) !!}                                                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <br>
                        <hr/>
                        <br>                                      
                        {!! Form::submit('Registrar Usuario', ['class' => 'btn btn-green btn-block']) !!}  
                        <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>                        
                {!! Form::close() !!}
            </div>                        
        </div>
    </div>
</div>

