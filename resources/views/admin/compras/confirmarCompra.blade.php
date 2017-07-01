<div id="modal-confirmarCompra" class="modal fade modalCV" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">Confirmar pedido o venta</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                    <h4 class="box-heading">¡Atención!</h4>
                    <p>Está a punto de registrar la compra de insumos.
                        Puede optar por entregar el pedido y registrar como una venta a este pedido o proseguir y registrar el pedido para su producción.</p>
                </div>
                <div class="form-group hide">
                    <h4>                       
                        <label class="col-sm-4 control-label">Emitir comprobante interno de compra</label>
                        <div class="col-sm-4 controls">
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="input-icon right">
                                        {!! Form::checkbox('factura', '1') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </h4>
                </div>
                <br><br>
                <div class="form-group">
                    <h4>
                        <label class="col-sm-4 control-label">Ya recibida</label>
                        <div class="col-sm-2 controls">
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="input-icon right">
                                        {!! Form::checkbox('recibido', '1') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </h4>
                </div>
                <div class="form-group">
                    <h4>
                        <label class="col-sm-4 control-label">No actualizar stock</label>
                        <div class="col-sm-2 controls">
                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="input-icon right">
                                        {!! Form::checkbox('no_act_stock', '1') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </h4>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-white">
                    Cerrar
                </button>
                <button type="button" data-dismiss="modal" class="btn btn btn-success" onclick="enviarPedido(true, false);">
                    Registrar como pedido de compra
                </button>
                <button type="button" data-dismiss="modal" class="btn btn btn-info" onclick="enviarPedido(true, true);">
                    Registrar como compra
                </button>
            </div>

        </div>
    </div>
</div>
