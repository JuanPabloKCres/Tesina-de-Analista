<div id="modal-exito" class="modal fade" data-keyboard=”false” data-backdrop=”static”>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true"  class="close">&times;</button>
                <h4 class="modal-title">
                    Estado de la operación</h4>
            </div>
            <div class="modal-body">               
                <div class="note note-success"><h4 class="box-heading">Operación realizada con éxito</h4>
                    <p id="mensajeExito"></p>
                </div>                                     
            </div>   
                <div class="modal-footer">
                    <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.compras.index') }}" title="Ir al resumen de compras"  class="btn btn-white"> <span aria-hidden="true"></span> Cerrar</a>
                </div>
        </div>
    </div>
</div>

