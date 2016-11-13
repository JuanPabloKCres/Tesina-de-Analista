
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">Ventas realizadas</div>
                                <div class="panel-body">
                                  @include('admin.partes.msjError')
                                  @include('flash::message')
                                  <table class="display dataTable table table-hover table-striped">
                                      <thead>
                                          <tr>
                                              <th>Cliente</th>
                                              <th>Fecha y hora de pedido</th>
                                              <th>Fecha y hora de la venta</th>
                                              <th>Importe</th>
                                              <th>Cantidad señada</th>
                                              <th>Usuario que tomó el pedido</th>
                                              <th>Usuario que realizó la venta</th>
                                              <th class="text-center">Acciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($pedidos as $pedido)
                                          <tr>
                                              <td>{{ $pedido->cliente->apellido }} {{ $pedido->cliente->nombre }}</td>
                                              <td>{{ $pedido->fecha_pedido }} - {{ $pedido->hora_pedido }}</td>
                                              <td>{{ $pedido->fecha_venta }} - {{ $pedido->hora_venta }}</td>
                                              <td>${{ $pedido->importe() }}</td>
                                              @if ($pedido->senado == $pedido->importe())
                                                  <td>Se abonó la totalidad</td>
                                              @else
                                                  <td>${{ $pedido->senado }}</td>
                                              @endif
                                              <td>{{ $pedido->usuarioPedido->name }}</td>
                                              <td>{{ $pedido->usuarioVenta->name }}</td>
                                              <td class="text-center">
                                                  <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá tener acceso al detalle de la venta que fue efectuada" href="{{ route('admin.pedidos.edit', $pedido->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                                              </td>
                                          </tr>
                                      @endforeach
                                      </tbody>
                                  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
