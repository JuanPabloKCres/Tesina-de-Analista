<h3>Detalles del registro</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Nombre</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '3', 'required']) !!}

                    {!! Form::select('nombre_ejemplo', array('Consumidor Final'=>'Consumidor Final','Monotributista'=>'Monotributista','Responsable Inscripto'=>'Responsable Inscripto','Excento'=>'Excento'),
                      ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">IVA (%)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('iva', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '3', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Factura emitida al cliente:</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('factura', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '1', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr/>
<br>
