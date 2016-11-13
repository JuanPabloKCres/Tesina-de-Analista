<div id="modal-crear" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Crear Registro</h4>
            </div>
            <div class="modal-body">        
                @include('admin.partes.listaErrores')
{!! Form::open(['route' => 'admin.tipos.store', 'method' => 'POST',  'id' =>'form-crear', 'class' => 'form-horizontal form-crear', 'files' => true]) !!}
                        @include('admin.publicacionesFront.tipos.contenidoForm')
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
                        <br>
                        <hr/>
                        <br>                                      
                        {!! Form::submit('Crear Registro', ['class' => 'btn btn-green btn-block']) !!}  
                        <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>                        
                {!! Form::close() !!}
            </div>                        
        </div>
    </div>
</div>
