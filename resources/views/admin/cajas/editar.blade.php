<div id="modal-actualizar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Cerrar caja</h4>
            </div>
            <div class="modal-body">   
            
                    @include('admin.cajas.msjCerrarCaja')
                                   
{!! Form::model($caja, ['route' => ['admin.cajas.update', $caja], 'id' =>'form-actualizar', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        <h3>Detalles del cierre</h3>
                        <br>       
                            <div class="form-group"><label class="col-sm-3 control-label">Fecha de cierre</label>
                                <div class="col-sm-9 controls">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="input-icon right">
                                                <i class="fa fa-calendar"></i>                                               
                                                {!! Form::text('fecha_cierre', \Carbon\Carbon::now('America/Buenos_Aires')->format('d-m-Y'), ['class' => 'form-control', 'readonly' => 'readonly','id'=>'fecha_cierre']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <div class="form-group"><label class="col-sm-3 control-label">Hora de cierre</label>
                                <div class="col-sm-9 controls">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="input-icon right">
                                                <i class="fa fa-clock-o"></i>                                                
                                                {!! Form::text('hora_cierre', \Carbon\Carbon::now('America/Buenos_Aires')->format('H:i'), ['class' => 'form-control', 'readonly' => 'readonly','id'=>'hora_cierre']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>          
                            </div> 

                        <div class="form-group hide"><label class="col-sm-3 control-label">Usuario</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-map-marker"></i>
                                             {!! Form::text('userCierre_id', Auth::user()->id, ['class' => 'form-control', 'id'=>'userCierre_id']) !!}
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>                  
                        <br>
                        <hr/>
                        <br>                    
                        {!! Form::submit('Cerrar caja', ['class' => 'btn btn-warning btn-block', 'id' =>'form-submit']) !!}
                        <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                        Volver</button>                                                                                                    
                {!! Form::close() !!}
            </div>                        
        </div>
    </div>
</div>
@section('script')
    <script src="{{ asset('js/pluginsCajas.js') }}"></script>
@endsection