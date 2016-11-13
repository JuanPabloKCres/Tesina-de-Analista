<div id="modal-actualizarPass" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">Actualizar contraseña</h4>
            </div>
            <div class="modal-body">   
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <strong>¡Atención!</strong> 
                        <ul>
                        @foreach($errors->all() as $error)
                            @if ($error!='El campo name debe contener menos de 30 caracteres.')
                                @if  ($error!='El campo email debe contener menos de 40 caracteres.')
                                    @if  ($error!='El campo name es obligatorio.')
                                        @if  ($error!='El campo email es obligatorio.')
                                            @if  ($error!='El campo email no corresponde con una dirección de e-mail válida.')                                         
                                                 @if  ($error!='El campo imagen debe ser una imagen.')
                                                    @if  ($error!='El archivo imagen debe pesar menos de 3072 kilobytes.')
                                                    <li>
                                                        {{ $error }}
                                                    </li>         
                                                    @endif                    
                                                @endif 
                                            @endif                    
                                        @endif                    
                                    @endif                 
                                @endif
                            @endif
                        @endforeach
                        </ul>                        
                    </div>
                @endif                        
{!! Form::open(['route' => ['usuario.actpass', $usuario], 'method' => 'PUT', 'id' =>'form-pass', 'class' => 'form-horizontal', 'files' => true]) !!}                       
                      <br>
                        <div class="form-group"><label class="col-sm-3 control-label">Password actual</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-lock"></i>
                                             {!! Form::password('password_actual', ['class' => 'form-control', 'placeholder' => 'campo requerido', 'required' ]) !!}                                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Password nuevo</label>
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
                        <div class="form-group"><label class="col-sm-3 control-label">Confirmar Password nuevo</label>
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
                        {!! Form::submit('Actualizar Registro', ['class' => 'btn btn-warning btn-block']) !!}  
                        <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>                        
                {!! Form::close() !!}
            </div>                        
        </div>
    </div>
</div>