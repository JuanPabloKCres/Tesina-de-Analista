@extends('admin.partes.index')

@section('title')
    Detalle del insumo
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.insumos.editar')
    @include('admin.insumos.confirmar')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Insumo: {{ $insumo->nombre}}</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.insumos.index') }}" title="Volver a los Registros de Articulos."  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
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
                                                                <td><h4>{{ $insumo->nombre }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Costo en ult compra:</h4></td>
                                                                <td><h4>${{ $insumo->costo }}</h4></td>
                                                            </tr>

                                                            <tr>
                                                                <td><h4 class="box-heading">Material:</h4></td>
                                                                @if($insumo->material)
                                                                    <td><h4>{{ $insumo->material->nombre}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "No se registro"}}</h4></td>
                                                                @endif
                                                            </tr>

                                                            <tr>
                                                                <td><h4 class="box-heading">Talle:</h4></td>
                                                                @if($insumo->talle)
                                                                    <td><h4>{{ $insumo->talle->nombre}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "-"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Alto:</h4></td>
                                                                @if ($insumo->alto)
                                                                    <td><h4>{{ $insumo->alto }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Ancho:</h4></td>
                                                                @if ($insumo->ancho)
                                                                    <td><h4>{{ $insumo->ancho }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Color:</h4></td>
                                                                @if($insumo->color)
                                                                    <td><h4>{{ $insumo->color->nombre}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "No corresponde"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Stock actual:</h4></td>
                                                                <td><h4>{{ $insumo->stock}} unidades</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Stock mínimo:</h4></td>
                                                                <td><h4>{{ $insumo->stockMinimo}} uniddades</h4></td>
                                                            </tr>
                                                            {{--
                                                            <tr>
                                                                <td><h4 class="box-heading">Cantidad de ventas asociadas:</h4></td>
                                                                @if($insumo->insumos_articulo)
                                                                    <td><h4 class="box-heading">{{ $insumo->insumos_articulo->articulos_venta->count() }}</h4></td>
                                                                    @if($insumo)
                                                                        <td><h4 class="box-heading">{{ $insumo }}</h4></td>
                                                                    @else
                                                                        <td><h4 class="box-heading">No hay ventas asociadas al insumo</h4></td>
                                                                    @endif
                                                                @else
                                                                    <td><h4 class="box-heading">Ni siquiera existen articulos comercializables relacionadas a este insumo</h4></td>
                                                                @endif
                                                            </tr>
                                                            --}}
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha de alta:</h4></td>
                                                                <td><h4>{{ $insumo->created_at->diffForHumans() }}</h4></td>
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
        var listSidebar = "li14";
        var elemFaltante = "nada";
    </script>
@endsection
