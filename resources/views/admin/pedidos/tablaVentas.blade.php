@extends('admin.partes.index')

@section('title')
    Historial de ventas
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Historial de ventas</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.pedidos.create') }}" title="Registrar un nuevo pedido o venta de uno o mas producto"  class="btn btn-blue"> <span class="fa fa-plus-circle" aria-hidden="true"></span> Generar presupuesto</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="tab-general">
            <div class="row mbl">
                <div class="col-lg-12">
                    <div class="col-md-12">
                        <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-green">
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
                                              <th>Forma de pago</th>
                                              <th class="text-center">Usuario que tomó el pedido</th>
                                              <th class="text-center">Usuario que concreto venta</th>
                                              <th class="text-center">Ver</th>
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
            </div>
         </div>
    </div>
@endsection
@section('script')
    <script>
        var listSidebar = "li9";
        var elemFaltante = "nada";
    </script>
@endsection
