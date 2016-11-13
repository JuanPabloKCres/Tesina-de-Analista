<form role="form" id="form-pedido">
    <div class="form-horizontal">
        <div class="row">
            <div class="col-lg-12">
                <div id="divCliente">
                    @include('admin.pedidos.clienteSelect')
                </div>
                <div class="form-group hide"><label class="col-sm-3 control-label">Usuario</label>
                    <div class="col-sm-9 controls">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-icon right">
                                    <i class="fa fa-map-marker"></i>
                                    <input class="form-control" value="{!! Auth::user()->id !!}" id="usuarioPedido" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label">IVA (%)</label>
                    <div class="col-sm-9 controls">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-icon right">
                                    <select class="form-control selectBoot" data-live-search="true" id="iva" required>
                                        <option value='21'>21%</option>
                                        <option value='10.5'>10.5%</option>
                                        <option value='0'>0%</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="divSena" class="form-group hide animated pulse">
                    <label class="col-sm-3 control-label">Seña</label>
                    <div class="col-sm-9 controls">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-icon right">
                                    <i class="fa fa-usd"></i>
                                    <input class="form-control" type="number" step="any" id="sena" data-parsley-type="number"  min="0" max="1000000" placeholder="campo requerido" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input class="hide" id="botonMandar" type="submit" value="Submit">
</form>
<button id="botonModalidad" class="btn btn-primary btn-block"> Señar el pedido</button>
