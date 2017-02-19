<div id="tab-lista" class="tablaResultados2 col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-green">
                <div class="panel-heading">Insumos comprados</div>
                <div class="panel-body">
                    <br>
                    <table id="tblListaItems" class="dataTable display table table-hover table-striped">
                        <thead>
                            <tr>
                              <th class="text-center">Insumo</th>
                                <th class="text-center">Proveedor</th>
                              <th class="text-center">Cantidad (unidades)</th>
                              <th class="text-center">Precio unitario</th>
                              <th class="text-center">Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($compra->insumos_compras as $insumoCompra)
                            <tr>
                                <td class="text-center">{{ $insumoCompra->insumo->nombre }}</td>
                                <td class="text-center">{{ $insumoCompra->proveedor->nombre }}</td>
                                <td class="text-center">{{ $insumoCompra->cantidad }} </td>
                                <td class="text-center">${{ $insumoCompra->precio_unitario }} </td>
                                <td class="text-center">${{ $insumoCompra->compra->importe }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
