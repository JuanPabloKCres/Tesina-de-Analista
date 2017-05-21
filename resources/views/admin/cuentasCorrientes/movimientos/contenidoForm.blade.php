<h3>Descripción</h3>
<br>
<div class="form-group hide"><label class="col-sm-3 control-label">Usuario</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('user_id', Auth::user()->id, ['class' => 'form-control']) !!}                                
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="form-group hide"><label class="col-sm-3 control-label">CC</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('cc_id', $cuentacorriente->id, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="form-group"><label class="col-sm-3 control-label">Concepto</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('concepto', null, ['class' => 'form-control', 'required', 'placeholder' => 'campo requerido (máximo 255 caracteres)' ]) !!}                                
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="form-group"><label class="col-sm-3 control-label">Fecha</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right date">
                    <i class="fa fa-calendar"></i>
                    {!! Form::text('fecha', \Carbon\Carbon::now('America/Buenos_Aires')->format('d-m-Y'), ['class' => 'form-control', 'readonly' => 'readonly']) !!}                                                     
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="form-group"><label class="col-sm-3 control-label">Hora</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-clock-o"></i>
                    {!! Form::text('hora', \Carbon\Carbon::now('America/Buenos_Aires')->format('H:i'), ['class' => 'form-control', 'readonly' => 'readonly']) !!}                                           
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="form-group"><label class="col-sm-3 control-label">Tipo</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
            {!! Form::select('tipo', array( 'entrada' => 'Entrada', 'salida' => 'Salida'), null, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'required']) !!}                                    
            </div>                                    
        </div>
    </div>                            
</div>      
<div class="form-group"><label class="col-sm-3 control-label">Monto</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-usd"></i>
                    {!! Form::number('monto', null, ['class' => 'form-control', 'placeholder' => 'campo requerido'/*, 'min' => '0.01'*/,'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>  
<br>
<hr/>
<br> 