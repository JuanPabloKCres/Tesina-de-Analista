<div id="modal-editar-progreso" class="modal fade" data-keyboard=”false” data-backdrop=”static”>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Editar el estado del progreso del pedido</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info"><h4 class="box-heading">Ingrese el estado de progreso de este pedido (#{{$pedido->id}})</h4>
                    <p id="mensajeAFIP"></p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <strong>¡Atención!</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/admin/pedidos/update" method="GET" >
                    <input id="token-edit" type="hidden" name="token" value="{{ csrf_token() }}"> {{-- Invisible--}}
                    <input type="hidden" name="pedido_id" id="pedido_id" value="{{ $pedido->id }}"> {{-- Invisible--}}

                    <br>
                    <div class="form-group">
                        <div class="col-sm-10 controls">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="input-icon right">
                                        <label>Progreso:</label>
                                        <input name="progreso" type="number" min="0" max="100" id="progreso" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="button" value="" onclick="actualizarProgreso()" class="btn btn-success">Actualizar progreso</button>
                    </div>
                </form>
                <br>
            </div>

        </div>
    </div>
</div>

