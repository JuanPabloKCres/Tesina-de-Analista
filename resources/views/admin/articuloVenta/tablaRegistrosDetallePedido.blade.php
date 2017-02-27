<div id="tab-lista" class="tablaResultados2 col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">Detalle de Articulos comprados</div>
                <div class="panel-body">
                    <br>
                    <table id="tblListaItems" class="dataTable display table table-hover table-striped">
                        <thead>
                            <tr>
                              <th class="text-center">Artículo</th>
                              <th class="text-center">Cantidad (unidades)</th>
                              <th class="text-center">Precio unitario</th>
                              <th class="text-center">Importe de Producción</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pedido->articulos_ventas as $articuloPedido)
                            <tr>
                                <td class="text-center">{{ $articuloPedido->articulo->nombre }}</td>
                                <td class="text-center">{{ $articuloPedido->cantidad }} </td>
                                <td class="text-center">${{ $articuloPedido->precio_unitario }} </td>
                                <td class="text-center">{{ $articuloPedido->cantidad * $articuloPedido->precio_unitario }} </td>
                                {{--<td>${{ $articuloPedido->venta->senado }}</td>
                                --}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
