@extends('admin.partes.index')

@section('title')
Compras - Detalle de la compra
@endsection

@section('sidebar')
@include('admin.partes.sidebar')
@endsection

@section('content')
{{--@include('admin.compras.confirmar')--}}
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        @if (($compra->pagado)&&($compra->entregado))
        <div class="page-title">Historial de ventas / Detalle del presupuesto</div>
        @else
        <div class="page-title">Pedidos / Detalle del presupuesto</div>
        @endif
    </div>
    <div class="page-header pull-right">
        <div class="page-toolbar">
            <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.compras.index') }}" title="Volver a los registros de compras"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
            @if (!$compra->entregado)
            <button type="button"  data-hover="tooltip"  data-toggle="modal" data-target="#modal-confirmar"  title="Confirmar acciones sobre el compra." class="btn btn-success"><span class="fa fa-money" aria-hidden="true"></span> Acciones</button>
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
                            @include('admin.compras.panelShowCompras')
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.insumoCompra.tablaRegistrosDetalleCompra')
        </div>
    </div>
</div>
@endsection
