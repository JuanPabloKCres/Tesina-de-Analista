<h3>Información General</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Nombre de la empresa</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'required']) !!}                                
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Responsabilidad ante el IVA</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::select('responiva_id', $responIva, null, ['class' => 'form-control', 'placeholder'=>'campo requerido', 'data-live-search' => 'true', 'required', 'id' => 'responiva_id']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Cuit de la empresa</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('cuit', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'required']) !!}                                
                </div>
            </div>
        </div>
    </div>
</div>                                         
<div class="form-group"><label class="col-sm-3 control-label">Logo</label>
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
<h3>Dirección</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Localidad</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
            {!! Form::select('localidad_id', $localidades, null, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'required']) !!}                                                                   
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Avenida/Calle</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-map-marker"></i>
                     {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'required']) !!} 
                </div>                            
            </div>
        </div>
    </div>
</div>
<br>
<hr/>
<br> 
<h3>Detalles de Contacto</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Teléfono</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-phone"></i>
                    {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'campo opcional']) !!}                                
                </div>
            </div>
        </div>
    </div>
</div>                      
<div class="form-group"><label class="col-sm-3 control-label">Email</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-envelope"></i>
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'campo opcional']) !!}                                
                </div>
            </div>
        </div>
    </div>
</div><br>
<div class="form-group"><label class="col-sm-3 control-label">Permitir pago c/ cheque a Consumidor Final</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">

                    <input type="checkbox" data-toggle="toggle" value="1" name="permitir_cheque_cf" id="permitir_cheque_cf" data-on="Si" data-off="No">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Permitir venta de articulos sin stock de insumos</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon left">
                    <input type="checkbox" data-toggle="toggle" value="1" name="ventas_sin_stock" id="ventas_sin_stock" data-on="Si" data-off="No">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Permitir ingresar precio venta articulos en toma de pedidos a cliente</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">

                        <input type="checkbox" data-toggle="toggle" value="1" name="permitir_ingresar_precio" id="permitir_ingresar_precio" data-on="Si" data-off="No">
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr/>
<br>        