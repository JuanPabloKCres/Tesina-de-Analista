<h3>Detalles del registro</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Unidad</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-tachometer"></i>
                     {!! Form::select('unidad', array('decimetro cubico'=>'dmᶟ','centimetro cubico'=>'cmᶟ','milimetro cubico'=>'mmᶟ','metro cubico'=>'mᶟ', 'Cantidad en Unidad'=>'Cantidad'), ['class' => 'form-control', 'placeholder' => 'campo requerido' , 'id' => 'unidad_id' ,  'maxlength' => '50', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">Nombre Unidad</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa "></i>
                    {!! Form::text('nombre',null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required', 'id' => 'nombre_id']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">Descripcion</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('detalle', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'maxlength' => '50', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr/>
<br>
