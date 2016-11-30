<div id="tab-lista" class="tablaResultados2 col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">Artículos</div>
                <div class="panel-body">
                    <br>
                    <table id="tblListaItems" class="dataTable display table table-hover table-striped">
                        <thead>
                            <tr>
                              <th>Artículo</th>
                              <th>Cantidad (unidades)</th>
                              <th>Precio unitario</th>
                              <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pedido->articulos_ventas as $articuloPedido)
                            <tr>
                                <td>{{ $articuloPedido->articulo->nombre }}</td>
                                <td>{{ $articuloPedido->cantidad }} </td>
                                <td>${{ $articuloPedido->precio_unitario }} </td>
                                <td>${{ $articuloPedido->venta->importe() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
