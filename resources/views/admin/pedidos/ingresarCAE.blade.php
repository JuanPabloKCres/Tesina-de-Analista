<div id="modal-ingresar-cae" class="modal fade" data-keyboard=”false” data-backdrop=”static”>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Registrar datos proporcionads desde AFIP</h4>
            </div>
            <div class="modal-body">
                <div class="note note-success"><h4 class="box-heading">Por favor, ingrese los datos proporcionados por AFIP</h4>
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
                <form action="/admin/pedidos/update" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <br>
                    <div class="form-group">
                        <div class="col-sm-10 controls">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="input-icon right">
                                        <label>N° CAE</label>
                                        <input name="cae" type="number" id="cae" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="input-icon right">
                                        <label>Fecha de vencimiento:</label>
                                        <input name="fecha_vencimiento_cae" id="fecha_vencimiento_cae"  type="date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br>
                </form>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardar_data_afip()">Registrar Factura</button>
            </div>
        </div>
    </div>




{{--

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true"  class="close">&times;</button>
                <h4 class="modal-title">
                    Estado de la operación</h4>
            </div>
            <div class="modal-body">               
                <div class="note note-success"><h4 class="box-heading">Por favor, ingrese los datos proporcionados por AFIP</h4>
                    <p id="mensajeAFIP"></p>
                </div>

            </div>   
            <div class="modal-footer">
                   <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.pedidos.index') }}" title="Ir al resumen de pedidos"  class="btn btn-white"> <span aria-hidden="true"></span> Terminar con el pedido</a>
            </div>  
        </div>
    </div>
    --}}
</div>

