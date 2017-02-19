@extends('admin.partes.index')

@section('script')
<script src="{{ URL::asset('js/pluginsArticulos.js') }}"></script>
<script>
var listSidebar = "li6";
var elemFaltante = "nada";
</script>
@endsection


@section('title')
Articulos - Registrar Articulo
@endsection

@section('sidebar')
@include('admin.partes.sidebar')
@endsection

@section('content')
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Confección de un Articulo para su comercialización</div>
    </div>
    <div class="page-header pull-right">
        <div class="page-toolbar">
            <a data-toggle="tooltip" data-placement="bottom" href="{{  route('admin.articulos.index') }}" title="Volver a los registros de articulos"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
            <a data-toggle="tooltip" data-placement="bottom" href="{{  route('admin.insumos.index') }}" title="Registrar un insumo (para confexionar un articulo)"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Registrar Insumo</a>
            <a data-toggle="tooltip" data-placement="bottom" href="javascript:$('#botonMandar').click()" title="Registrar un producto para la venta"  class="btn btn-success"> <span class="fa fa fa-plus-circle" aria-hidden="true"></span> Registrar Articulo</a>
            <!--  -->
            <!--
            <a data-toggle="tooltip" data-placement="bottom" href="botonModalidad" title="Registrar un producto para la venta"  class="btn btn-success"> <span class="fa fa fa-plus-circle" aria-hidden="true"></span> Registrar Articulo</a>
            -->
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
                    <div class="row mtl">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-body">
                                            @include('admin.articulos.contenidoForm_invisible')
                                            @include('admin.insumoArticulo.contenidoForm')

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
                @include('admin.articulos.msjTablaVacia')
                @include('admin.insumoArticulo.tablaRegistros')
                <button id="botonExito" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-exito"  class="btn hide"></button>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            @include('admin.articulos.contenidoForm')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.articulos.confirmarAltaArticulo')
@endsection


