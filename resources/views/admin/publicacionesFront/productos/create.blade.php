<div id="modal-config" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Registrar Producto</h4>
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
                {!! Form::open(['route' => 'admin.productos.store', 'id' =>'form-crear', 'method' => 'POST', 'class' => 'form-horizontal', 'files' => true]) !!}
                        @include('admin.publicacionesFront.productos.contenidoForm')
                        <div class="form-group"><label class="col-sm-3 control-label">Estado</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                                <i class="fa fa-check"></i>
                                            {!! Form::checkbox('estado', '1',true) !!}                                                                   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>  
                        <br>                                         
                        <h3>Descripción</h3>
                        <br>
                        <div class="form-group">                      
                            <div class="col-sm-12 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-pencil"></i>
                                            {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'campo opcional - máx. 1000 carácteres']) !!}                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                    
                        <br>
                        <hr/>
                        <br>                                     
                        {!! Form::submit('Registrar Producto', ['class' => 'btn btn-green btn-block']) !!}  
                        <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>                        
                {!! Form::close() !!}
            </div>                        
        </div>
    </div>
</div>

