<form class="form-horizontal" id="form-agregar">
    <?php
        $array_fecha = getdate();
        $fecha_hoy =$array_fecha['year'].'-0'.$array_fecha['mon'].'-'.$array_fecha['mday'];
    ?>
    <div class="row text-center">
        <div class="col-lg-12">
            <h3>Artículos</h3>
            <br>
            <div class="form-group "><label class="col-sm-3 control-label">Artículo</label>
                <div class="col-sm-9 controls">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="input-icon right">
                                <i class="fa fa-pencil"></i>
                                {!! Form::select('articulo_id', $articulos, null, ['class' => 'form-control selectBoot', 'id' => 'articulo_select','data-live-search' => 'true', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label">Cantidad</label>
                <div class="col-sm-9 controls">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="input-icon right">
                                <i class="fa fa-pencil"></i>
                                <input class="form-control" type="number" id="cantidad_number" name="number" min="1" max="1000000" data-parsley-type="number" placeholder="campo requerido" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label">Precio unitario</label>
                <div class="col-sm-9 controls">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="input-icon right">
                                <i class="fa fa-usd"></i>
                                <input class="form-control" type="text" id="precioU_number" name="number" min="0" max="1000000" data-parsley-type="number"  required/>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label">Importe</label>
                <div class="col-sm-9 controls">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="input-icon right">
                                <i class="fa fa-usd"></i>
                                <input class="form-control" type="number" step="any" id="importe_number" name="number" min="0" max="1000000" data-parsley-type="number" placeholder="campo requerido" keypress="completarPrecio()" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-5 control-label">FECHA ENTREGA ESTIMADA:</label>
                <div class="col-sm-12 controls">

                        <div class="col-xs-19">
                            <div class="input-icon right">
                                {!! Form::date('fecha_entrega_tentativa',\Carbon\Carbon::now() , ['id'=>'fecha_entrega_date','min'=>$fecha_hoy])!!}
                            </div>
                        </div>

                </div>
            </div>
            <hr/>
        </div>
    </div>
    <button type="submit" class="btn btn-orange btn-block"> Agregar</button>
</form>
