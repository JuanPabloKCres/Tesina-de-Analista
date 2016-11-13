<div id="modal-actualizar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Actualizar registro: {{ $usuario->nombre }}</h4>
            </div>
            <div class="modal-body"> 
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <strong>¡Atención!</strong> 
                        <ul>
                            @foreach($errors->all() as $error)
                                @if ($error!='El password actual que ha ingresado es incorrecto.')
                                    @if  ($error!='El campo confirmación de password no coincide.')
                                        @if  ($error!='El campo password debe contener al menos 6 caracteres.')
                                            @if  ($error!='El campo password actual es obligatorio.')
                                                @if  ($error!='El campo password es obligatorio.')
                                                    <li>
                                                        {{ $error }}
                                                    </li>
                                                @endif                    
                                            @endif                    
                                        @endif                 
                                    @endif
                                @endif
                            @endforeach
                        </ul>                        
                    </div>
                @else
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <strong>Tip:</strong> 
                        Si no especificas un nuevo archivo para la foto de perfil, este no se actualizará y en consecuencia seguirá siendo el mismo.                
                    </div>
                @endif                        
{!! Form::open(['route' => ['admin.usuarios.update', $usuario], 'method' => 'PUT', 'id' =>'form-actualizar', 'class' => 'form-horizontal', 'files' => true]) !!}
                       <h3>Detalles de la cuenta</h3>
                      <br>
                        <div class="form-group"><label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-envelope"></i>
                                            {!! Form::text('email', $usuario->email, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'required' ]) !!}                                                                
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
                        <div class="form-group"><label class="col-sm-3 control-label">Nombre/s y apellido</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                    {!! Form::text('name', $usuario->name, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'required']) !!}                                                                  
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <div class="form-group"><label class="col-sm-3 control-label">Imagen de perfil</label>
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
                        {!! Form::submit('Actualizar Registro', ['class' => 'btn btn-warning btn-block']) !!}  
                        <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>                        
                {!! Form::close() !!}
            </div>                        
        </div>
    </div>
</div>