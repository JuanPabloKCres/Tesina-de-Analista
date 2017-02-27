<div id="modal-confirmarVenta" class="modal fade modalCV" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">Confirmar pedido o venta</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                    <h3 class="box-heading">¡Atención!</h3>
                    <p><h4>Está a punto de registrar un nuevo pedido, también se ha detectado que el pedido ha sido pagado en su totalidad.
                        Puede optar por entregar el pedido y registrar como una venta a este pedido o proseguir y registrar el pedido para su producción.</h4></p>
                </div>
                <div class="form-group">
                    <h4>                       
                        <label class="col-sm-4 control-label">Generar factura electrónica</label>
                        <div class="col-sm-4 controls">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="input-icon right">
                                        {!! Form::checkbox('factura', '1') !!}
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
                    Registrar como pedido
                </button>
                <button type="button" data-dismiss="modal" class="btn btn btn-info" onclick="enviarPedido(true, true);">
                    Registrar como venta
                </button>
            </div>

        </div>
    </div>
</div>
