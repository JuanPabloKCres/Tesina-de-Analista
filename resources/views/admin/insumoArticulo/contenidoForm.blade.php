<form class="form-horizontal" id="form-agregar">
    <div class="row">
        <div class="col-lg-12">
            <h3>Añadir Insumos del Articulo</h3>
            <br>
            <div class="form-group "><label class="col-sm-3 control-label">Insumo</label>
                <div class="col-sm-9 controls">
                    <div class="row"><i class="fa fa-search"></i>
                        <div class="col-xs-10" align="left">
                            <div class="input-icon right">
                                <i class="fa fa-search"></i>
                                {!! Form::select('insumo_id', $insumos, null, ['class' => 'form-control selectBoot', 'id' => 'insumo_select','data-live-search' => 'true', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label">Cantidad</label>
                <div class="col-sm-3 controls" align="left"><label class="col-sm-3 control-label"></label>
                    <div class="row">
                        <div class="col-xs-9" align="left">
                            <div class="input-icon right">
                                <i class="fa fa-pencil"></i>
                                <input class="form-control" type="number" id="cantidad_number" name="number" min="0.01" max="1000000" step="0.01" data-parsley-type="number" placeholder="campo requerido" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Unidad Medida de la cantidad -->
                <div class="col-sm-6 controls" align="right"><label class="col-sm-3 control-label">Unidad Medida</label>
                    <div class="row">
                        <div class="col-xs-6" align="right">
                            <div class="input-icon right">
                                <i class="fa fa-pencil"></i>
                                <input class="form-control" type="text" readonly="readonly" id="unidad_text" tooltip="Unidad de medida por la que se compra el insumo" min="1" max="1000000" data-parsley-type="text" placeholder="campo requerido" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group"><label class="col-sm-3 control-label">Costo unitario</label>
                <div class="col-sm-9 controls">
                    <div class="row">
                        <div class="col-xs-10" align="left">
                            <div class="input-icon right">
                                <i class="fa fa-usd"></i>
                                <input class="form-control" type="number" step="any" readonly="readonly" id="costo_number" name="number" min="0" max="1000000" data-parsley-type="number" placeholder="campo requerido" keypress="completarPrecio()" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label">Costo cantidad Insumo</label>
                <div class="col-sm-9 controls">
                    <div class="row">
                        <div class="col-xs-10" align="left">
                            <div class="input-icon right">
                                <i class="fa fa-usd"></i>
                                <input class="form-control" type="number" step="any" readonly="readonly" id="d4" name="number" min="0" max="1000000" data-parsley-type="number" placeholder="campo requerido" keypress="completarPrecio()" required/>
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


@section('script')
    <script src="{{ URL::asset('js/pluginsArticulos.js') }}"></script>
    <script>
        var listSidebar = "li6";
        var elemFaltante = "nada";
    </script>
@endsection