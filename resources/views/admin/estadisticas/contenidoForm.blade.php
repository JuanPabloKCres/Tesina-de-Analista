
<div class="row">
  <div class="col-lg-12">
    <div class="col-md-12">
      <div class="panel">
          <div class="panel-body">
            <h3>Resumen general</h3>
            <br>
              <div class="col-md-4">
                  <table class="table table-striped table-hover">
                      <tbody>
                          <tr>
                              <td><h4 class="box-heading"><label>Total de ventas realizadas:</label></h4></td>
                              <td><h4><b>{{ count($pedidos) }}</b></h4></td>
                          </tr>
                      </tbody>
                  </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <td><h4 class="box-heading"><label>Total de artículos vendidos:</label></h4></td>
                                <td><h4><b>{{ $articulosVendidos }}</b></h4></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                <div class="col-md-4">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr class="info">
                                <td><h4 class="box-heading"><label>Total recaudado:</label></h4></td>
                                <td><h4><b>${{ $totalRecaudado }}</b></h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <td><h4 class="box-heading"><label>Cantidad de clientes diferentes en este periodo:</label></h4></td>
                                <td><h4><b>{{ $cantidadClientes }}</b></h4></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                <div class="col-md-6">
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr class="info">
                                <td><h4 class="box-heading"><label>Cantidad de artículos diferentes comercializados:</label></h4></td>
                                <td><h4><b>{{ $cantidadArticulos }}</b></h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
          </div>
       </div>
  </div>
  <div class="col-md-6">
      <div class="panel">
          <div class="panel-body">
            <h4 class="box-heading">Ranking de clientes <small>se muestran los 5 clientes que más invirtieron</small></h4>
              <div class="list-group">
                @foreach($rankingClientes as $cliente)
                    @if ($cliente == $rankingClientes->first())
                      <a href="{{ route('admin.clientes.show', $cliente->id) }}" class="list-group-item active">
                          @if($cliente->empresa)
                              <h4 class="list-group-item-heading">{{ $cliente->empresa}} (rep: {{ $cliente->nombreCompleto }}) </h4>
                          @else
                              <h4 class="list-group-item-heading">{{ $cliente->nombreCompleto }}</h4>
                          @endif
                      <p class="list-group-item-text"> Cantidad de compras realizadas: {{ $cliente->cantCompras }}. Total invertido por el cliente: ${{ $cliente->valorCompras }}</p></a>
                    @else
                      <a href="{{ route('admin.clientes.show', $cliente->id) }}" class="list-group-item"><h4 class="list-group-item-heading">{{ $cliente->nombreCompleto }}</h4>
                      <p class="list-group-item-text"> Cantidad de compras realizadas: {{ $cliente->cantCompras }}. Total invertido por el cliente: ${{ $cliente->valorCompras }}</p></a>
                    @endif
                @endforeach
              </div>
          </div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="panel">
          <div class="panel-body">
            <h4 class="box-heading">Artículos más vendidos <small>se muestran los 5 artículos que mas se vendieron</small></h4>
              <div class="list-group">
                @foreach($rankingArticulos as $articulo)
                    @if ($articulo == $rankingArticulos->first())
                      <a href="{{ route('admin.articulos.show', $articulo->id) }}" class="list-group-item active"><h4 class="list-group-item-heading">{{ $articulo->nombre }}</h4>
                      <p class="list-group-item-text"> Se comercializaron {{ $articulo->cantidad }} unidades de este producto. Por un importe de: ${{ $articulo->importe }}</p></a>
                    @else
                      <a href="{{ route('admin.articulos.show', $articulo->id) }}" class="list-group-item"><h4 class="list-group-item-heading">{{ $articulo->nombre }}</h4>
                      <p class="list-group-item-text"> Se comercializaron {{ $articulo->cantidad }} unidades de este producto. Por un importe de: ${{ $articulo->importe }}</p></a>
                    @endif
                @endforeach
                </div>
          </div>
      </div>
  </div>
</div>
</div>
