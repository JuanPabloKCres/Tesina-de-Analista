<h3>Información General</h3>
<br>
<div class="form-group"><label class="col-sm-3 control-label">Nombre</label>
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
<div class="form-group"><label class="col-sm-3 control-label">Tipo</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">                            

                  {!! Form::select('tipo_publicado_id', $tipos /*nombres , id tipos traidos del TipoComposer*/, null, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'placeholder' => 'campo requerido', 'required', 'id' => 'tipo_publicado_id']) !!}

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