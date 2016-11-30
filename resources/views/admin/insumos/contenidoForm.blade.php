
<h3>Detalles del Insumo</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Nombre</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Unidad de Medida para procesar</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::select('unidad_medida_id', $unidades_medidas, null,['class' => 'form-control selectBoot','id'=>'unidad_medida_id', 'placeholder' =>'Seleccione la unidad de medida..', 'data-live-search' => 'true', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">Tipo</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::select('tipo_id', $tipos, null,['class' => 'form-control selectBoot','id'=>'tipo_id', 'placeholder' =>'Seleccione un tipo de insumo..', 'data-live-search' => 'true', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Material</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::select('material_id', $materiales, null, ['class' => 'form-control selectBoot', 'id'=>'material_id','placeholder' =>'Seleccione material..','data-live-search' => 'true']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">Talle</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::select('talle_id', $talles, null, ['class' => 'form-control selectBoot', 'id'=>'talle_id', 'data-live-search' => 'true' , 'placeholder' => 'Si está registrando ropa, seleccione el talle..']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Alto</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::number('alto', null, ['class' => 'form-control','id'=>'alto', 'placeholder'=>'campo no obligatrio']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Ancho</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::number('ancho', null, ['class' => 'form-control','id'=>'ancho', 'placeholder'=>'campo no obligatrio']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Color</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-paint-brush"></i>
                    {!! Form::select('color_id', $colores, null, ['class' => 'form-control selectBoot', 'placeholder'=>'Seleccione un color..','id'=>'color_id','data-live-search' => 'true']) !!}

                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Stock actual</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::number('stock', null, ['class' => 'form-control', 'placeholder'=>'campo requerido', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Stock mínimo</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::number('stockMinimo', null, ['class' => 'form-control', 'placeholder'=>'campo requerido', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Costo</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-money"></i>
                    {!! Form::number('costo', null, ['class' => 'form-control', 'placeholder'=>'campo requerido (el costo se actualiza al comprar insumo)']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr/>
<br>