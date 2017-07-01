
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
                                              <th class="text-center">id</th>
                                              <th class="text-center">Cliente</th>
                                              <th class="text-center">Fecha y hora de pedido</th>
                                              <th class="text-center">Fecha y hora de la venta</th>
                                              <th class="text-center">Importe</th>
                                              <th class="text-center">Cantidad señada</th>
                                              <th class="text-center">Forma de pago</th>
                                              <th class="text-center">Usuario que tomó el pedido</th>
                                              <th class="text-center">Usuario que concretó la venta</th>
                                              <th class="text-center">Ver</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($pedidos as $pedido)

                                          <tr>
                                              <td class="text-center">{{ $pedido->id }}</td>
                                              <td>{{ $pedido->cliente->apellido }} {{ $pedido->cliente->nombre }}</td>
                                              <td class="text-center">{{ $pedido->fecha_pedido }} - {{ $pedido->hora_pedido }}hs</td>
                                              <td class="text-center">{{ $pedido->fecha_venta }} - {{ $pedido->hora_venta }}hs</td>
                                              <td class="text-center">${{ $pedido->importe() }}</td>
                                              @if ($pedido->senado == $pedido->importe())
                                                  <td class="text-center">Se abonó la totalidad</td>
                                              @else
                                                  <td class="text-center">${{ $pedido->senado }}</td>
                                              @endif
                                              <td class="text-center">{{ $pedido->forma_pago}}</td>
                                              <td class="text-center">{{ $pedido->usuarioPedido->name }}</td>
                                              <td class="text-center">{{ $pedido->usuarioVenta->name }}</td>
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
