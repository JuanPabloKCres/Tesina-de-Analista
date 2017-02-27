<h3>Información general</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Apellido/s</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('apellido', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Nombre/s</label>
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
<div class="form-group"><label class="col-sm-3 control-label">Empresa</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('empresa', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'maxlength' => '50', 'id'=>'empresa_text']) !!}
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
                    {!! Form::select('responiva_id', $responIva, null, ['class' => 'form-control selectBoot', 'placeholder'=>'campo requerido', 'data-live-search' => 'true', 'required', 'id' => 'responiva_id']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">CUIT</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('cuit', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'id'=>'cuit', 'maxlength' => '11']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">DNI</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('dni', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'id'=>'dni', 'maxlength' => '8']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr>
<br>
<h3>Dirección</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Pais</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                {!! Form::select('pais_id', $paises, null, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'required', 'id' => 'pais_select', 'placeholder' =>'seleccione un pais..']) !!}
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Provincia</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                {!! Form::select('provincia_id', ['placeholder' => 'campo requerido..'], null, ['id'=>'provincia_select','class' => 'form-control selectBoot']) !!}
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Localidad</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                {!! Form::select('localidad_id', ['placeholder' => 'campo requerido..'], null, ['id'=>'localidad_select','class' => 'form-control selectBoot','required']) !!}
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Dirección</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'maxlength' => '50']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr>
<br>
<h3>Detalles de contacto</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Teléfono</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'maxlength' => '50']) !!}
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
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'maxlength' => '50']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr>
<br>
<h3>Descripción</h3>
<br>
<div class="form-group">
    <div class="col-sm-12 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'campo opcional - máx. 500 carácteres', 'id' => 'descripcion']) !!}
                </div>
            </div>
        </div>
    </div>
</div>




