<h3>Detalles del registro</h3>
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
<br>
<hr/>
<br>
<h3>Descripción</h3>
<br>
<div class="form-group">
    <div class="col-sm-12 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'campo opcional - máx. 500 carácteres']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<hr/>
<br>
