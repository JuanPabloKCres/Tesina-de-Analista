<div id="modal-editar-cheque" class="modal fade" xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Cheque</h4>
            </div>
            <div class="modal-body">
                  <br>
                <div class="note note-info">

                    <input class="hide" name="cheque_id" id="cheque_id" value=""/> {{-- el value viene cuando se hace click en este modal --}}
                    <h3 class="box-heading">¿Desea modificar el estado del cheque a 'Cobrado'?</h3>
                </div>
               <br>
               <hr/>
               <br>
                <button type="button" onclick="registrarPagoCheque($('#cheque_id').val())" data-dismiss="modal" class="btn btn-green btn-block">Registrar cobranza</button>
               <button type="button" data-dismiss="modal" class="btn btn-white btn-block">Cerrar</button>
            </div>
        </div>
    </div>
</div>
