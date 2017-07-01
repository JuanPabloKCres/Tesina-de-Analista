@extends('admin.partes.index')
@section('script')
    <script src="{{ URL::asset('js/pluginsPedidos.js') }}"></script>
    <script>
        var listSidebar = "li8";
        var elemFaltante = "nada";
    </script>
@endsection

@section('title')
    Pedidos registrados pendientes de entraga
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
        <?php
        $array_fecha = getdate();
        $año = $array_fecha['year'];
        $mes = $array_fecha['mon'];
        $dia = $array_fecha['mday'];

        if(strlen ($mes)==1){                       #si mes tiene un digito anteponer un 0 al mes
            if(strlen ($dia)==1){                       #si dia tambien tiene un digito anteponer un 0 al dia
                //$fecha_hoy = $año.'-0'.$mes.'-0'.$dia;
                $fecha_hoy = '0'.$dia.'/0'.$mes.'/'.$año;
            }else{
                $fecha_hoy = $dia.'/0'.$mes.'/'.$año;
            }
        }else{
            if(strlen ($dia)==1){                       #si dia tiene un digito anteponer un 0 al dia
                $fecha_hoy = '0'.$dia.'/'.$mes.'/0'.$año;
            }else{
                $fecha_hoy = $dia.'/'.$mes.'/'.$año;
            }
        }
        ?>
        <div class="page-header pull-left">
            <div class="page-toolbar">
                <div class="row ">
                    @include('admin.pedidos.contenidoFormBusqueda')
                </div>
            </div>
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
                                <div class="panel-heading">Pedidos solicitados pendientes de entrega</div>
                                <div class="panel-body">
                                  @include('admin.partes.msjError')
                                  @include('flash::message')
                                  <table id="example" class="display dataTable table table-hover table-striped" cellspacing="0" width="100%">
                                      <thead>
                                          <tr>
                                              <th class="text-center">#</th>
                                              <th class="text-center">Cliente</th>
                                              <th class="text-center">Fecha y hora de pedido</th>
                                              <th class="text-center">Importe</th>
                                              <th class="text-center">Cantidad señada</th>
                                              <th class="text-center">Usuario que tomó pedido</th>
                                              <th class="text-center">Modalidad pago</th>
                                              <th class="text-center">Fecha tentativa de entrega</th>
                                              <th class="text-center">Ver</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($pedidos as $pedido)
                                          <tr>
                                              <td class="text-center">{{ $pedido->id }}</td>
                                              @if($pedido->cliente->empresa)
                                                  <td class="text-center text-facebook text">{{ $pedido->cliente->empresa }}</td>
                                              @else
                                              <td class="text-center">{{ $pedido->cliente->apellido }} {{ $pedido->cliente->nombre }}</td>
                                              @endif
                                              <td class="text-center">{{ $pedido->fecha_pedido }} - {{ $pedido->hora_pedido }}</td>
                                              <td class="text-center">${{ $pedido->importe() }}</td>
                                              @if ($pedido->senado == $pedido->importe())
                                                  <td class="text-center text-green">Se abonó la totalidad 👍</td>
                                              @else
                                                  <td class="text-center">${{ $pedido->senado }}</td>
                                              @endif
                                              <td class="text-center">{{ $pedido->usuarioPedido->name }}</td>
                                              <td class="text-center">{{ $pedido->forma_pago }}</td>

                                              <?php
                                                $fecha_entrega = \Carbon\Carbon::createFromFormat('d/m/Y', $pedido->fecha_entrega_estimada);
                                                $fecha_hoy = \Carbon\Carbon::now('America/Buenos_Aires');
                                              ?>

                                              @if( ($fecha_entrega < $fecha_hoy))
                                                  <td class="text-center"> {{ $pedido->fecha_entrega_estimada}} ⛔️</td>
                                              @else
                                                  <td class="text-center"> {{ $pedido->fecha_entrega_estimada}}</td>
                                              @endif
                                              <th class="text-center">
                                                  <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá señar la totalidad del pedido o realizar la entrega del pedido" href="{{ route('admin.pedidos.edit', $pedido->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                                              </th>
                                          </tr>
                                      @endforeach
                                      </tbody>
                                      <tfoot>
                                          <tr>
                                              <th class="text-center"></th>
                                              <th class="text-center">Cliente</th>
                                              <th class="text-center">Fecha Pedido</th>
                                              <th class="text-center">Cliente</th>

                                          </tr>
                                      <tfoot>
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