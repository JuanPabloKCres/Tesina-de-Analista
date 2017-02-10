<div id="modal-create-cheque" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Registrar Cheque</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['method' => 'POST', 'id' =>'form-crear', 'class' => 'form-horizontal']) !!}
                    <div class="form-group"><label class="col-sm-3 control-label">Nro Serie</label>
                        <div class="col-sm-9 controls">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-icon right">
                                        <i class="fa fa-pencil"></i>
                                        {!! Form::text('nro_serie', null, ['class' => 'form-control', 'id'=>'nro_serie', 'maxlength' => '50', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-3 control-label">Monto ($)</label>
                        <div class="col-sm-9 controls">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-icon right">
                                        <i class="fa fa-pencil"></i>
                                        {!! Form::text('monto_cheque', null, ['class' => 'form-control', 'id' => 'monto_cheque', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required', 'readonly']) !!}
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
                                        {!! Form::text('nombre', null, ['class' => 'form-control', 'id'=>'nombre_cheque', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required', 'readonly']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-3 control-label">Apellido</label>
                        <div class="col-sm-9 controls">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-icon right">
                                        <i class="fa fa-pencil"></i>
                                        {!! Form::text('apellido', null, ['class' => 'form-control', 'id'=>'apellido_cheque', 'placeholder' => 'campo requerido', 'maxlength' => '50', 'required', 'readonly']) !!}
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
                                        {!! Form::text('empresa', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'maxlength' => '50', 'id'=>'empresa_cheque']) !!}
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
                                        {!! Form::text('cuit', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'id'=>'cuit_cheque', 'maxlength' => '11', 'readonly']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-3 control-label">Banco</label>
                        <div class="col-sm-9 controls">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-icon right">
                                        <i class="fa fa-bank"></i>
                                        {!! Form::select('banco', $bancos, null, ['class' => 'form-control', 'data-live-search' => 'true', 'id'=>'banco']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-3 control-label">Sucursal</label>
                        <div class="col-sm-9 controls">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-icon right">
                                        {!! Form::number('sucursal', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'id'=>'sucursal', 'maxlength' => '11']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-3 control-label">Fecha Emision</label>
                        <div class="col-sm-9 controls">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-icon right">
                                        <i class="fa fa-pencil"></i>
                                        {!! Form::date('fecha_emision',null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'id'=>'fecha_emision', 'maxlength' => '11']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-3 control-label">Fecha Cobro</label>
                        <div class="col-sm-9 controls">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-icon right">
                                        <i class="fa fa-pencil"></i>
                                        {!! Form::date('fecha_cobro', null, ['class' => 'form-control', 'placeholder' => 'campo opcional', 'id'=>'fecha_cobro', 'maxlength' => '11']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
            </div>
        </div>
    </div>
                {!! Form::submit('Crear registro', ['class' => 'btn btn-green btn-block']) !!}
                <button type="button" data-dismiss="modal" class="btn btn-white btn-block" onclick="validarFormCheque()">Cerrar</button>
                {!! Form::close() !!}
</div>









