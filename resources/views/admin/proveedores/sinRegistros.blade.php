@extends('admin.partes.index')

@section('title')
    Proveedores registrados
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
@include('admin.proveedores.create')
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Proveedores</div>
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
                    @include('admin.partes.msjSinRegistros')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script') 
    <script>
        var listSidebar = "li5";
        var elemFaltante = "proveedor";
    </script>
@endsection
