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
            <div class="page-title">
              Proveedores
            </div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <div class="btn-group" role="group" aria-label="...">
                    @include('admin.partes.botonesVistas')
                    @include('admin.partes.botonFiltrar')
                </div>
                <a data-toggle="tooltip"  data-placement="bottom" title="Gestionar roles de proveedores" type="button" data-hover="tooltip"  href="{{ route('admin.rubros.index') }}" class="btn btn-blue">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Rubros
                </a>

                <button data-placement="bottom" title="Registrar una nueva empresa proveedora" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-config"  class="btn btn-blue">
                      <i class="fa fa-plus-circle" aria-hidden="true"></i> Registrar proveedor
                </button>
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
                @include('admin.proveedores.cabeceraTabla')
                <div class="tablaResultados">
                @include('admin.proveedores.tablaLogos')
                </div>
                @include('admin.proveedores.tablaRegistros')
            </div>
         </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('proveedores.js') }}"></script>
    <script>
        var route = "/admin/proveedores";
        var listSidebar = "li5";
        var elemFaltante = "nada";
    </script>
@endsection
