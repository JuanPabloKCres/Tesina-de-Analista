@extends('admin.partes.index')

@section('title')
    Detalle del artículo
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.articulos.editar')
    @include('admin.articulos.confirmar')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Artículo: {{ $articulo->nombre}}</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.articulos.index') }}" title="Volver a los Registros de Articulos."  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
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
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <h3>Detalles del registro</h3>
                                    <br>
                                    @include('admin.partes.msjError')
                                    @include('flash::message')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mtl">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">
                                                    <table class="table table-striped table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <td><h4 class="box-heading">Nombre:</h4></td>
                                                                <td><h4>{{ $articulo->nombre }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Proveedor:</h4></td>
                                                                <td><h4>{{ $articulo->proveedor->nombre}}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Material:</h4></td>
                                                                @if($articulo->material)
                                                                    <td><h4>{{ $articulo->material->nombre}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "No se registro"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Tipo:</h4></td>
                                                                <td><h4>{{ $articulo->tipo->nombre}}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Talle:</h4></td>
                                                                @if($articulo->talle)
                                                                    <td><h4>{{ $articulo->talle->nombre}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "No corresponde"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Alto:</h4></td>
                                                                @if ($articulo->alto)
                                                                    <td><h4>{{ $articulo->alto }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Ancho:</h4></td>
                                                                @if ($articulo->ancho)
                                                                    <td><h4>{{ $articulo->ancho }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Color:</h4></td>
                                                                @if($articulo->color)
                                                                    <td><h4>{{ $articulo->color->nombre}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "No corresponde"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Stock actual:</h4></td>
                                                                <td><h4>{{ $articulo->stock}} unidades</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Stock mínimo:</h4></td>
                                                                <td><h4>{{ $articulo->stockMinimo}} uniddades</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Cantidad de ventas asociadas:</h4></td>
                                                                <td><h4 class="box-heading"></h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha de alta:</h4></td>
                                                                <td><h4>{{ $articulo->created_at->diffForHumans() }}</h4></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr/>
                                            <br>
                                            <div class="pull-right">
                                                <button type="button"  data-hover="tooltip"  data-toggle="modal" data-target="#modal-actualizar"  title="Visualizar la pantalla de actualización de datos. En ella podrá actualizar los datos pertinentes al registro."  class="btn btn-warning">  Actualizar datos</i></button>
                                                <button type="button"  data-hover="tooltip"  data-toggle="modal" data-target="#modal-confirmar"  title="Confirmar eliminación de datos." class="btn btn-danger">Eliminar registro</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script src="{{ asset('js/pluginsArticulos.js') }}"></script>
    <script>
        var listSidebar = "li6";
        var elemFaltante = "nada";
    </script>
@endsection
