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
            <div class="page-title">Historial de ventas</div>
        </div>

        <div class="page-header pull-right">
            <div class="page-toolbar">
              <div class="row ">
                @include('admin.estadisticas.contenidoFormBusqueda')
              </div>
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
                    <div class="row ">
                      @if ($cantidadClientes == 0)
                        @include('admin.estadisticas.msjSinRegistros')
                      @endif
                      @include('admin.estadisticas.contenidoForm')
                      @include('admin.estadisticas.tablaVentas')
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
