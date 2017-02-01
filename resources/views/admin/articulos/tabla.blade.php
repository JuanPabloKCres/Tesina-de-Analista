@extends('admin.partes.index')

@section('title')
    Articulos Producidos
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Producciones</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.articulos.create') }}" title="Registrar un nuevo pedido o venta de uno o mas producto"  class="btn btn-blue"> <span class="fa fa-plus-circle" aria-hidden="true"></span> Generar presupuesto</a>
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
                            <div class="panel panel-yellow">
                                <div class="panel-heading">Produccion de Articulos</div>
                                <div class="panel-body">
                                    @include('admin.partes.msjError')
                                    @include('flash::message')
                                    <table class="display dataTable table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Tipo</th>
                                                <th>Talle</th>
                                                <th>Alto</th>
                                                <th>Ancho</th>
                                                <th>Color</th>
                                                <th>Costo materiales</th>
                                                <th>% Gancia</th>
                                                <th>Gan. x uni.</th>
                                                <th>Precio Venta</th>

                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($articulos as $articulo)
                                            <tr>
                                                <td class="text-dark text-uppercase">{{ $articulo->nombre }}</td>

                                                @if($articulo->tipo)
                                                    <td class="text-center">{{ $articulo->tipo->nombre}}</td>
                                                @else
                                                    <td class="text-center">{{ "Ninguno" }}</td>
                                                @endif

                                                @if($articulo->talle)
                                                    <td class="text-center">{{ $articulo->talle->talle}}</td>
                                                @else
                                                    <td class="text-center">{{ "Ninguno" }}</td>
                                                @endif

                                                @if($articulo->alto)
                                                    <td class="text-center">{{ $articulo->alto}}cm</td>
                                                @else
                                                    <td class="text-center">{{ "Ninguno" }}</td>
                                                @endif
                                                @if($articulo->ancho)
                                                    <td class="text-center">{{ $articulo->ancho}}cm</td>
                                                @else
                                                    <td class="text-center">{{ "Ninguno" }}</td>
                                                @endif

                                                @if($articulo->color)
                                                    <td class="text-center ">{{ $articulo->color->nombre }}</td>
                                                @else
                                                    <td>{{ "Ninguno" }}</td>
                                                @endif

                                                <!--StockMinimo-->
                                                <td class="text-center">$ {{ $articulo->costo }}</td>
                                                <td class="text-center">{{ $articulo->margen }}%</td>
                                                <td class="text-center">$ {{ $articulo->ganancia }}</td>
                                                <td class="text-center badge-dark text-white">$ {{ $articulo->precioVta}}</td>
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.articulos.show', $articulo->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
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
    <script>
        var listSidebar = "li6";
        var elemFaltante = "nada";
    </script>
@endsection
