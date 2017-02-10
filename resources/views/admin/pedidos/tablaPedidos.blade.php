@extends('admin.partes.index')

@section('title')
    Pedidos registrados
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Pedidos</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.pedidos.create') }}" title="Registrar un nuevo pedido o venta de uno o mas producto"  class="btn btn-blue"> <span class="fa fa-plus-circle" aria-hidden="true"></span> Armar Pedido</a>
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
                                <div class="panel-heading">Pedidos solicitados</div>
                                <div class="panel-body">
                                  @include('admin.partes.msjError')
                                  @include('flash::message')
                                  <table class="display dataTable table table-hover table-striped">
                                      <thead>
                                          <tr>
                                              <th class="text-center">Cliente</th>
                                              <th>Fecha y hora de pedido</th>
                                              <th class="text-center">Importe</th>
                                              <th class="text-center">Cantidad señada</th>
                                              <th class="text-center">Usuario que tomó pedido</th>
                                              <th class="text-center">Modalidad pago</th>
                                              <th class="text-center">Fecha tentativa de entrega</th>
                                              <th class="text-center">Acciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($pedidos as $pedido)
                                          <tr>
                                              <td class="text-center">{{ $pedido->cliente->apellido }} {{ $pedido->cliente->nombre }}</td>
                                              <td class="text-center">{{ $pedido->fecha_pedido }} - {{ $pedido->hora_pedido }}</td>
                                              <td class="text-center">${{ $pedido->importe() }}</td>
                                              @if ($pedido->senado == $pedido->importe())
                                                  <td class="text-center">Se abonó la totalidad</td>
                                              @else
                                                  <td class="text-center">${{ $pedido->senado }}</td>
                                              @endif
                                              <td class="text-center">{{ $pedido->usuarioPedido->name }}</td>
                                              <td class="text-center">efectivo</td>
                                              <td class="text-center"> {{  $pedido->fecha_entrega_estimada }}</td>
                                              <th class="text-center">
                                                  <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá señar la totalidad del pedido o realizar la entrega del pedido" href="{{ route('admin.pedidos.edit', $pedido->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                                              </th>
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
        var listSidebar = "li8";
        var elemFaltante = "nada";
    </script>
@endsection
