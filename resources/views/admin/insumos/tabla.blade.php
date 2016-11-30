@extends('admin.partes.index')

@section('title')
    Insumos registrados
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
@include('admin.insumos.create')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Insumos</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <button data-placement="bottom" title="Registrar un nuevo producto de la gráfica" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-config"  class="btn btn-blue">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Registrar Insumo
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
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-grey">
                                <div class="panel-heading">Insumos registrados</div>
                                <div class="panel-body">
                                    @include('admin.partes.msjError')
                                    @include('flash::message')
                                    <table class="display dataTable table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Material</th>
                                                <th>Tipo</th>
                                                <th>Talle</th>
                                                <th>Alto</th>
                                                <th>Ancho</th>
                                                <th>Color</th>
                                                <th>Stock actual</th>
                                                <!--StockMinimo-->
                                                <th>Costo ult/compra.</th>


                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($insumos as $insumo)
                                            <tr>
                                                <td>{{ $insumo->nombre }}</td>
                                                @if($insumo->material)
                                                    <td>{{ $insumo->material->nombre }}</td>
                                                @else
                                                    <td>{{ "Ninguno" }}</td>
                                                @endif
                                                @if($insumo->tipo)
                                                    < class="text-center">{{ $insumo->tipo->nombre}}</td>
                                                @else
                                                    <td class="text-center">{{ "Otros" }}</td>
                                                @endif

                                                @if($insumo->talle)
                                                    <td class="text-center">{{ $insumo->talle->talle}}</td>
                                                @else
                                                    <td class="text-center">{{ "Ninguno" }}</td>
                                                @endif
                                                @if($insumo->alto)
                                                    <td class="text-center">{{ $insumo->alto}}</td>
                                                @else
                                                    <td class="text-center">{{ "-" }}</td>
                                                @endif

                                                @if($insumo->ancho)
                                                    <td class="text-center">{{ $insumo->ancho}}</td>
                                                @else
                                                    <td class="text-center">{{ "-" }}</td>
                                                @endif

                                                @if($insumo->color)
                                                    <td class="text-center">{{ $insumo->color->nombre }}</td>
                                                @else
                                                    <td class="text-center">{{ "Ninguno" }}</td>
                                                @endif
                                                <td class="text-center">{{ $insumo->stock }}</td>
                                                <!--StockMinimo-->
                                                <td class="text-center">{{ $insumo->costo }}</td>
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.insumos.show', $insumo->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
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
    <script src="{{ asset('js/pluginsInsumos.js') }}"></script>
    <script>
        var listSidebar = "li14";
        var elemFaltante = "nada";
    </script>
@endsection
