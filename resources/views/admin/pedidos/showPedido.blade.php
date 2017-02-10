@extends('admin.partes.index')

@section('title')
Pedidos - Detalle de un pedido
@endsection

@section('sidebar')
@include('admin.partes.sidebar')
@endsection

@section('content')
@include('admin.pedidos.confirmar')
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        @if (($pedido->pagado)&&($pedido->entregado))
        <div class="page-title">Historial de ventas / Detalle del presupuesto</div>
        @else
        <div class="page-title">Pedidos / Detalle del presupuesto</div>
        @endif
    </div>
    <div class="page-header pull-right">
        <div class="page-toolbar">
            <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.pedidos.index') }}" title="Volver a los registros de pedidos"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
            @if (!$pedido->entregado)
                <button type="button"  data-hover="tooltip"  data-toggle="modal" data-target="#modal-confirmar"  title="Confirmar acciones sobre el pedido." class="btn btn-success"><span class="fa fa-money" aria-hidden="true"></span> Acciones</button>
            @endif
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
            <div class=" col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel ">
                            <div class="panel-body">
                                <h3>Datos del cliente</h3>
                                <br>
                                @include('flash::message')
                                <div class="row mtl">
                                    <div class="col-md-4">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                <tr>
                                                    <td><h4 class="box-heading">Apellido y nombre:</h4></td>
                                                    <td><h4 id="nombreCliente">{{ $pedido->cliente->apellido }},  {{ $pedido->cliente->nombre }}</h4></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                <tr>
                                                    @if ($pedido->cliente->cuit)                                                      
                                                    <td><h4 class="box-heading">Cuit:</h4></td>
                                                    <td><h4 id="cuit">{{ $pedido->cliente->cuit }}</h4></td>                                                      
                                                    @else
                                                    <td><h4 class="box-heading">Dni:</h4></td>
                                                    <td><h4 id="cuit">{{ $pedido->cliente->dni }}</h4></td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                <tr>                                                
                                                    <td><h4 class="box-heading">Resposabilidad:</h4></td>
                                                    <td><h4 id="cuit">{{ $pedido->cliente->responiva->nombre }}</h4></td>                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row mtl">
                                    <div class="col-md-4">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                <tr class="info">
                                                    <td><h4 class="box-heading">Teléfono:</h4></td>
                                                    @if ($pedido->cliente->telefono)
                                                    <td><h4>{{ $pedido->cliente->telefono }}</h4></td>
                                                    @else
                                                    <td><h4>No se registró</h4></td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                <tr class="warning">
                                                    <td><h4 class="box-heading">Email:</h4></td>
                                                    @if ($pedido->cliente->email)
                                                    <td><h4>{{  $pedido->cliente->email }}</h4></td>
                                                    @else
                                                    <td><h4>No se registró</h4></td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                                <tr class="warning">
                                                    <td><h4 class="box-heading">Dirección:</h4></td>
                                                    @if ($pedido->cliente->direccion)
                                                    <td><h4 id="direccion">{{$pedido->cliente->direccion}}</h4></td>
                                                    @else
                                                    <td><h4 id="direccion">No se registró</h4></td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <span class="hide" id="iva">{{$pedido->cliente->responiva->iva}}</span>
                                    <span class="hide" id="factura">{{$pedido->cliente->responiva->factura}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel ">
                            @if (($pedido->pagado)&&($pedido->entregado))
                            @include('admin.pedidos.panelShowVenta')
                            @else
                            @include('admin.pedidos.panelShowPedidos')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.articuloVenta.tablaRegistrosDetallePedido')
        </div>
    </div>
</div>
@endsection



<script type="text/javascript">
    var id_cliente_pedidosPendientes = '<?php echo $pedido->cliente->id;?>';    //OK!
</script>
