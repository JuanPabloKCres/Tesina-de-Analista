
<h2 class="text-center">Propiedades del nuevo articulo de venta</h2>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Nombre</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required', 'id'=>'nombreArticulo_text']) !!}
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
                    {!! Form::select('tipo_id', $tipos, null,['class' => 'form-control selectBoot','id'=>'tipo_id', 'placeholder' =>'Seleccione un tipo de articulo..', 'data-live-search' => 'true', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!--
<div class="form-group"><label class="col-sm-3 control-label">Material</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {{--
                    {!! Form::select('material_id', $materiales, null, ['class' => 'form-control selectBoot', 'id'=>'material_id','placeholder' =>'Seleccione material..','data-live-search' => 'true']) !!}
                    --}}
                </div>
            </div>
        </div>
    </div>
</div>
-->

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
<div class="form-group"><label class="col-sm-3 control-label">Alto (cm)</label>
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
<div class="form-group"><label class="col-sm-3 control-label">Ancho (cm)</label>
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
                    {!! Form::select('color_id', $colores, 0, ['class' => 'form-control selectBoot', 'id'=>'color_id','data-live-search' => 'true']) !!}

                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">Costo ($)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-money"></i>
                    {!! Form::number('costo', null, ['class' => 'form-control', 'placeholder'=>'-', 'readonly', 'id'=>'costoArticulo_text']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">% Ganancia</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-percent"></i>
                    {!! Form::number('margen', null, ['class' => 'form-control', 'placeholder'=>'campo requerido', 'id'=>'gananciaPorcent_number']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Ganancia por unidad ($)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-money"></i>
                    {!! Form::number('ganancia', null, ['class' => 'form-control', 'placeholder'=>'-', 'readonly', 'id'=>'gananciaDinero_text']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group"><label class="col-sm-3 control-label">IVA aplicado al Articulo (%)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    {{--
                    {!! Form::select('iva', array('3' => '0%', '2' => '10.5%', '1'=>'21%'),1, ['class' => 'form-control', 'id'=>'iva_select']) !!}
                    --}}
                    {!! Form::select('iva', $ivas, null, ['class' => 'form-control selectBoot', 'id'=>'iva_select','data-live-search' => 'true']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Monto IVA ($)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-money"></i>
                    {!! Form::number('montoIva', null, ['class' => 'form-control', 'placeholder'=>'-', 'readonly', 'id'=>'montoIva_number']) !!}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="form-group"><label class="col-sm-3 control-label">Precio Venta ($)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-money"></i>
                    {!! Form::number('precioVta', null, ['class' => 'form-control', 'placeholder'=>'-', 'readonly', 'id'=>'precioVta_text']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr/>
<br>