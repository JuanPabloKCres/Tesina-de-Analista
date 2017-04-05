    <div id="modal-config" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                        &times;</button>
                    <h4 class="modal-title">
                        Apertura de caja</h4>
                </div>
                <div class="modal-body">  
                    @include('admin.cajas.msjAbrirCaja')             
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
    {!! Form::open(['route' => 'admin.cajas.store', 'method' => 'POST', 'id' =>'form-crear', 'class' => 'form-horizontal']) !!}
                            <h3>Detalles de apertura</h3>
                            <br>
                            <div class="form-group"><label class="col-sm-3 control-label">Fecha de apertura</label>
                                <div class="col-sm-9 controls">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="input-icon right">
                                                <i class="fa fa-calendar"></i>
                                                {!! Form::text('fecha_apertura', \Carbon\Carbon::now('America/Buenos_Aires')->format('d-m-Y'), ['class' => 'form-control', 'readonly' => 'readonly' ]) !!}                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                            <div class="form-group"><label class="col-sm-3 control-label">Hora de apertura</label>
                                <div class="col-sm-9 controls">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="input-icon right">
                                                <i class="fa fa-clock-o"></i>
                                                {!! Form::text('hora_apertura', \Carbon\Carbon::now('America/Buenos_Aires')->format('H:i'), ['class' => 'form-control', 'readonly' => 'readonly']) !!}                                                            
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
                                                 {!! Form::text('userApertura_id', Auth::user()->id, ['class' => 'form-control']) !!} 
                                            </div>                            
                                        </div>
                                    </div>
                                </div>
                            </div>



                    <div class="form-group"><label class="col-sm-3 control-label">Monto inicial</label>
                                <div class="col-sm-9 controls">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="input-icon right">
                                                <i class="fa fa-usd"></i>
                                                 {!! Form::text('saldo_inicial', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'required']) !!} 
                                            </div>                            
                                        </div>
                                    </div>
                                </div>
                            </div>                   
                            <br>
                            <hr/>
                            <br>                          
                            {!! Form::submit('Abrir Caja', ['class' => 'btn btn-green btn-block']) !!}  
                            <button type="button" data-dismiss="modal" onclick="reporte_caja()" class="btn btn-white btn-block">
                        Cerrar</button>                        
                    {!! Form::close() !!}
                </div>                        
            </div>
        </div>
    </div>