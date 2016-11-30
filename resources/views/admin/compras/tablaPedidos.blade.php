@extends('admin.partes.index')

@section('title')
    Compras registradas
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Compras</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.compras.create') }}" title="Registrar una nueva compra o compra de compra de insumo"  class="btn btn-blue"> <span class="fa fa-plus-circle" aria-hidden="true"></span> Comprar Insumos</a>
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
                            <div class="panel panel-yellow">
                                <div class="panel-heading">Compras solicitadas</div>
                                <div class="panel-body">
                                  @include('admin.partes.msjError')
                                  @include('flash::message')
                                  <table class="display dataTable table table-hover table-striped">
                                      <thead>
                                          <tr>
                                              <th>Proveedor</th>
                                              <th>Fecha y hora de compra</th>
                                              <th>Importe</th>
                                              <th>Se pagó</th>
                                              <th>Usuario que tomó el compra</th>
                                              <th class="text-center">Acciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($compras as $compra)
                                          <tr>
                                              <td>{{ $compra->proveedor->nombre }}</td>
                                              <td>{{ $compra->fecha_compra }} - {{ $compra->hora_compra }}</td>
                                              <td>${{ $compra->importe() }}</td>
                                              @if ($compra->pagado)
                                                  <td>Si</td>
                                              @else
                                                  <td>No</td>
                                              @endif
                                              <td>{{ $compra->usuarioPedido->name }}</td>
                                              <td class="text-center">
                                                  <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá señar la totalidad del compra o realizar la entrega del compra" href="{{ route('admin.compras.edit', $compra->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
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
        var listSidebar = "li14";
        var elemFaltante = "nada";
    </script>
@endsection
