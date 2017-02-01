<form role="form" id="form-pedido">
    <div class="form-horizontal">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group hide"><label class="col-sm-3 control-label">Usuario</label>
                    <div class="col-sm-9 controls">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-icon right">
                                    <i class="fa fa-map-marker"></i>
                                    <input class="form-control" value="{!! Auth::user()->id !!}" id="usuarioAltaArticulo" required/>
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
<button id="botonModalidad" class="hide btn btn-primary btn-block"> </button>
