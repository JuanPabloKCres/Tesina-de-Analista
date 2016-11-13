<form class="form-horizontal" id="form-agregar">
    <div class="row">
        <div class="col-lg-12">
            <h3>Artículos</h3>
            <br>
            <div class="form-group "><label class="col-sm-3 control-label">Artículo</label>
                <div class="col-sm-9 controls">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="input-icon right">
                                <i class="fa fa-pencil"></i>
                                {!! Form::select('articulo_id', $articulos, null, ['class' => 'form-control selectBoot', 'id' => 'd1','data-live-search' => 'true', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label">Cantidad</label>
                <div class="col-sm-9 controls">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="input-icon right">
                                <i class="fa fa-pencil"></i>
                                <input class="form-control" type="number" id="d2" name="number" min="1" max="1000000" data-parsley-type="number" placeholder="campo requerido" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label">Precio unitario</label>
                <div class="col-sm-9 controls">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="input-icon right">
                                <i class="fa fa-usd"></i>
                                <input class="form-control" type="number" step="any" id="d3" name="number" min="0" max="1000000" data-parsley-type="number" placeholder="campo requerido" keypress="completarPrecio()" required/>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label">Importe neto</label>
                <div class="col-sm-9 controls">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="input-icon right">
                                <i class="fa fa-usd"></i>
                                <input class="form-control" type="number" step="any" id="d4" name="number" min="0" max="1000000" data-parsley-type="number" placeholder="campo requerido" keypress="completarPrecio()" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
        </div>
    </div>
    <button type="submit" class="btn btn-orange btn-block"> Agregar</button>
</form>
