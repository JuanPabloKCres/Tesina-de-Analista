<div id="tab-lista" class="tablaResultados2 col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">Insumos</div>
                <div class="panel-body">
                    <br>
                    <table id="tblListaItems" class="dataTable display table table-hover table-striped">
                        <thead>
                            <tr>
                              <th>Insumo</th>
                              <th>Cantidad (unidades)</th>
                              <th>Precio unitario</th>
                              <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cimpra->insumos_compras as $insumoCompra)
                            <tr>
                                <td>{{ $insumoCompra->insumo->nombre }}</td>
                                <td>{{ $insumoCompra->cantidad }} </td>
                                <td>${{ $insumoCompra->costo_unitario }} </td>
                                <td>${{ $insumoCompra->compra->importe() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
