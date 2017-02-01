<script src="{{ asset('plantillas/jonthornton-jquery-timepicker/jquery.timepicker.css') }}"></script>
<script src="{{ asset('plantillas/jonthornton-jquery-timepicker/jquery.timepicker.min.js') }}"></script>

<h3>Información General</h3>
                      <br>
                        <div class="form-group"><label class="col-sm-3 control-label">Razón social</label>
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

                        <div class="form-group"><label class="col-sm-3 control-label">CUIT</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-barcode"></i>
                                            {!! Form::number('cuit', null, ['class' => 'form-control', 'placeholder' => 'campo requerido', 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-3 control-label">Rubro</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        {!! Form::select('rubro_id', $rubros, null, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Horario de atención mañana</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-icon right">
                                            <i class="fa fa-clock-o"></i>
                                            {!! Form::time('hora_a_manana', null, ['class' => 'form-control', 'id'=>'h_a_m', 'placeholder' => '']) !!}
                                        </div>

                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-icon right">
                                            <i class="fa fa-clock-o"></i>
                                            {!! Form::time('hora_c_manana', null, ['class' => 'form-control', 'id'=>'h_c_m', 'placeholder' => '']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Horario de atención tarde</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-icon right">
                                            <i class="fa fa-clock-o"></i>
                                            {!! Form::time('hora_a_tarde', null, ['class' => 'form-control', 'id'=>'h_a_t', 'placeholder' => '']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-icon right">
                                            <i class="fa fa-clock-o"></i>
                                            {!! Form::time('hora_c_tarde', null, ['class' => 'form-control', 'id'=>'h_c_t', 'placeholder' => '']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Web</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-at"></i>
                                            {!! Form::text('web', null, ['class' => 'form-control', 'id'=>'web_text', 'placeholder' => 'campo opcional']) !!}
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
                        <div class="form-group"><label class="col-sm-3 control-label">Avenida/calle</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-map-marker"></i>
                                             {!! Form::text('calle', null, ['class' => 'form-control', 'placeholder' => 'campo opcional']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Altura</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-map-marker"></i>
                                            {!! Form::number('altura', null, ['class' => 'form-control', 'placeholder' => 'campo opcional']) !!}
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
                                            {!! Form::number('telefono', null, ['class' => 'form-control', 'placeholder' => 'campo opcional']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-3 control-label">Celular</label>
                            <div class="col-sm-9 controls">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-icon right">
                                            <i class="fa fa-mobile"></i>
                                            {!! Form::number('celular', null, ['class' => 'form-control', 'placeholder' => 'campo opcional']) !!}
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
                        </div>
                        <br>
                        <hr/>
                        <br>
