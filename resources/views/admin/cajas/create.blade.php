@extends('admin.partes.index')

@section('title')
    Detalle de la caja
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
@include('admin.cajas.modalCreate')
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Detalle de caja</div>
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
            <div class="page-content">
                <div class="page-toolbar">
                    @include('admin.cajas.msjSinCaja')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        var listSidebar = "li11";
        var elemFaltante = "caja";
    </script>
@endsection
