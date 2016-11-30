<div id="modal-confirmarPedido" class="modal fade modalCP" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">Confirmar pedido</h4>
            </div>
            <div class="modal-body">
              <div class="note note-info">
                  <h4 class="box-heading">¡Atención!</h4>
                  <p>Está por registrar de un nuevo pedido de insumos. De encontrarse seguro puede proseguir presionando el boton "Registrar".</p>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" data-dismiss="modal" class="btn btn-white"> Cerrar</button>
              <button type="button" data-dismiss="modal" class="btn btn btn-success" onclick="enviarPedido(false, false, false);"> Registrar pedido</button>
            </div>
        </div>
    </div>
</div>
