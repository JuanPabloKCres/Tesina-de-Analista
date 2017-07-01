
<h2 class="text-center">Propiedades del nuevo articulo de venta</h2>
<br>

<div class="col-md-12" align="center">

<div class="form-group"><label class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-9 controls">
        <div class="row text-center">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required', 'id'=>'nombreArticulo_text']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group"><label class="col-sm-2 control-label">Tipo</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::select('tipo_id', $tipos, null,['class' => 'form-control selectBoot','id'=>'tipo_id', 'placeholder' =>'Seleccione un tipo de articulo..', 'data-live-search' => 'true', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!--
<div class="form-group"><label class="col-sm-2 control-label">Material</label>
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

<div class="form-group"><label class="col-sm-2 control-label">Talle</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::select('talle_id', $talles, null, ['class' => 'form-control selectBoot', 'id'=>'talle_id', 'data-live-search' => 'true' , 'placeholder' => 'Si está registrando ropa, seleccione el talle..']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">Alto (cm)</label>
    <div class="col-sm-9 ">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('alto', null, ['class' => 'form-control', 'id'=>'alto', 'step'=>'any', 'min'=>'0', 'placeholder'=>'campo no obligatrio']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">Ancho (cm)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('ancho', null, ['class' => 'form-control','id'=>'ancho', 'step'=>'any', 'min'=>'0', 'placeholder'=>'campo no obligatrio']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">Color</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-paint-brush"></i>
                    {!! Form::select('color_id', $colores, 0, ['class' => 'form-control selectBoot', 'step'=>'any', 'id'=>'color_id','data-live-search' => 'true']) !!}

                </div>
            </div>
        </div>
    </div>
</div>

{{--Nuevo--}}
<div class="form-group"><label class="col-sm-2 control-label">Tiempo Produccion Aprox.</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-clock-o"></i>
                    {!! Form::text('horas_produccion', null, ['class' => 'form-control', 'placeholder'=>'2', 'step'=>0.01, 'min'=>'0', 'id'=>'horas_produccion']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
{{----}}
<br>
<div class="form-group"><label class="col-sm-2 control-label">Costo ($)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-money"></i>
                    {!! Form::text('costo', null, ['class' => 'form-control', 'placeholder'=>'-', 'step'=>'any', 'readonly', 'id'=>'costoArticulo_text']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">% Ganancia</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-percent"></i>
                    {!! Form::text('margen', null, ['class' => 'form-control', 'placeholder'=>'campo requerido', 'step'=>'any', 'id'=>'gananciaPorcent_number']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">Ganancia por unidad ($)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-money"></i>
                    {!! Form::text('ganancia', null, ['class' => 'form-control', 'placeholder'=>'-', 'step'=>'any', 'readonly', 'id'=>'gananciaDinero_text']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group"><label class="col-sm-2 control-label">IVA aplicado al Articulo (%)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    {{--
                    {!! Form::select('iva', array('3' => '0%', '2' => '10.5%', '1'=>'21%'),1, ['class' => 'form-control', 'id'=>'iva_select']) !!}
                    --}}
                    {!! Form::select('iva', $ivas, null, ['class' => 'form-control selectBoot', 'step'=>'any', 'id'=>'iva_select','data-live-search' => 'true']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-2 control-label">Monto IVA ($)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-money"></i>
                    {!! Form::text('montoIva', null, ['class' => 'form-control', 'step'=>'any', 'placeholder'=>'-', 'readonly', 'id'=>'montoIva_number']) !!}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="form-group"><label class="col-sm-2 control-label">Precio Venta ($)</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-icon right">
                    <i class="fa fa-money"></i>
                    {!! Form::text('precioVta', null, ['class' => 'form-control', 'step'=>'any', 'placeholder'=>'-', 'readonly', 'id'=>'precioVta_text']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr/>
<br>
</div>
