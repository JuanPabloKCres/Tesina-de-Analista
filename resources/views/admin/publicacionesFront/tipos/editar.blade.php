<div id="modal-actualizar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Actualizar Registro: {{ $tipo->nombre }}</h4>
            </div>
            <div class="modal-body">   
                @if ($errors->any())
                    @include('admin.partes.listaErrores')
                @else
                    @include('admin.partes.msgLogoActualizar')
                @endif                        
{!! Form::model($tipo, ['route' => ['admin.tipos.update', $tipo], 'method' => 'PUT', 'id' =>'form-actualizar',  'class' => 'form-horizontal', 'files' => true]) !!}
                        @include('admin.publicacionesFront.tipos.contenidoForm')
                        <div class="form-group"><label class="col-sm-3 control-label">Estado</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-check"></i>
                                            @if ($tipo->estado)
                                                {!! Form::checkbox('estado', '1',true) !!} 
                                            @else
                                                {!! Form::checkbox('estado', '1') !!}                                                   
                                            @endif                                                                  
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