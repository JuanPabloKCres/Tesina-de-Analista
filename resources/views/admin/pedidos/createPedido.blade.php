@extends('admin.partes.index')

@section('script')
<script src="{{ URL::asset('js/pluginsPedidos.js') }}"></script>
<script>
var listSidebar = "li8";
var elemFaltante = "nada";
</script>
@endsection


@section('title')
Pedidos - Generar presupuesto
@endsection

@section('sidebar')
@include('admin.partes.sidebar')
@endsection

@section('content')

@include('admin.pedidos.msjOperacionExitosa')
@include('admin.pedidos.createCliente')
@include('admin.pedidos.createCheque')
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Pedidos / Generar presupuesto</div>
    </div>
    <div class="page-header pull-right">
        <div class="page-toolbar">
            <a data-toggle="tooltip" data-placement="bottom" href="{{  route('admin.pedidos.index') }}" title="Volver a los registros de pedidos"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
            <button data-placement="bottom" title="Registrar un nuevo cliente" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-create"  class="btn btn-blue">
                <span class="fa fa-user-plus" aria-hidden="true"></span> Registrar Cliente
            </button>
            <a data-toggle="tooltip" data-placement="bottom" href="{{  route('admin.articulos.create') }}" title="Ir a la pantalla de confacci�n de articulo, util para armar prespuesto"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Presupuestar Articulo</a>
            <a data-toggle="tooltip" data-placement="bottom" href="{{  route('admin.insumos.index') }}" title="Ir a la pantalla de compra de insumos"  class="btn btn-blue"> <span class="fa fa-puzzle-piece" aria-hidden="true"></span>  Insumos</a>

            <button data-placement="bottom" title="Cargar un cheque" id="btn-pagarConCheque" type="button" data-hover="tooltip" onclick="rellenarModalCheque()" data-toggle="modal"   class="btn btn-blue">
                <span class="fa fa-money" aria-hidden="true"></span> Paga con Cheque
            </button>
            <a data-toggle="tooltip" data-placement="bottom" href="javascript:$('#botonMandar').click()" title="Registrar pedido o venta"  class="btn btn-success"> <span class="fa fa fa-plus-circle" aria-hidden="true"></span> Registrar pedido</a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="page-content" align="center">
    <div id="tab-general">
        <div class="row mbl">
            <div class="col-lg-10">
                <div class="col-md-10">
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="col-md-3">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td><h4 class="box-heading"><label>Fecha:</label></h4></td>
                                            <td><h4><b>{!! \Carbon\Carbon::now('America/Buenos_Aires')->format('d/m/Y') !!}</b></h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr>
                                            <td><h4 class="box-heading"><label>Hora:</label></h4></td>
                                            <td><h4><b>{!! \Carbon\Carbon::now('America/Buenos_Aires')->format('H:i') !!} Hs</b></h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr class="info">
                                            <td><h4 class="box-heading"><label>Monto neto:</label></h4></td>
                                            <td><h4>   <i class="fa fa-usd"></i> <b id="mp">0</b></h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                        <tr class="info">
                                            <td><h4 class="box-heading"><label>Monto total:</label></h4></td>
                                            <td><h4>   <i class="fa fa-usd"></i> <b id="mt">0</b></h4></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <div class="row">
                    <div class="row mtl">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-12" align="right">
                                    <div class="panel">
                                        <div class="panel-body">
                                            @include('admin.pedidos.contenidoFormClienteySena')
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-body">
                                            @include('admin.articuloVenta.contenidoForm')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            @include('admin.pedidos.msjTablaVacia')
                            @include('admin.pedidos.msjSenaExepcion')
                            @include('admin.pedidos.msjStockExepcion')
                            @include('admin.articuloVenta.tablaRegistros')
                            <button id="botonExito" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-exito"  class="btn hide"></button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('admin.pedidos.confirmarPedido')
@include('admin.pedidos.confirmarVenta')
@endsection


