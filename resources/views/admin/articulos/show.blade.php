@extends('admin.partes.index')

@section('title')
    Detalle del artículo
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.articulos.editar')
    @include('admin.articulos.confirmarEliminacion')
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
                                                                <td><h4 class="box-heading">Material:</h4></td>
                                                                @if($articulo->material)
                                                                    <td><h4>{{ $articulo->material->nombre}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "No se registro"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Talle:</h4></td>
                                                                @if($articulo->talle->nombre!='Ninguno')
                                                                    <td><h4>{{ $articulo->talle->talle}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "-"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Alto:</h4></td>
                                                                @if ($articulo->alto)
                                                                    <td><h4>{{ $articulo->alto }}</h4></td>
                                                                @else
                                                                    <td><h4>-</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Ancho:</h4></td>
                                                                @if ($articulo->ancho)
                                                                    <td><h4>{{ $articulo->ancho }}</h4></td>
                                                                @else
                                                                    <td><h4>-</h4></td>
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
                                                                <td><h4 class="box-heading">Costo en insumos:</h4></td>
                                                                @if($articulo->costo)
                                                                    <td><h4>$ {{ $articulo->costo}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "-"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Margen:</h4></td>
                                                                @if($articulo->margen)
                                                                    <td><h4>{{ $articulo->margen}}%</h4></td>
                                                                @else
                                                                    <td><h4>{{ "No se pudo calcular"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Ganancias por unidad vendida:</h4></td>
                                                                @if($articulo->ganancia)
                                                                    <td><h4>$ {{ $articulo->ganancia}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "No se pudo calcular"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">IVA:</h4></td>
                                                                @if($articulo->iva)
                                                                    <td><h4>{{ $articulo->iva->iva}}% (${{$articulo->montoIva}})</h4></td>
                                                                @else
                                                                    <td><h4>{{ "No corresponde"}}</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Precio Venta:</h4></td>
                                                                @if($articulo->precioVta)
                                                                    <td><h4>{{ $articulo->precioVta}}</h4></td>
                                                                @else
                                                                    <td><h4>{{ "Todavia no esta disponible para venta"}}</h4></td>
                                                                @endif
                                                            </tr>


                                                            <tr>
                                                                <td><h4 class="box-heading">Cantidad de ventas asociadas:</h4></td>
                                                                <td><h4 class="box-heading">{{ $articulo->articulos_venta->count() }}</h4></td>
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
                                                <button type="button"  data-hover="tooltip"  data-toggle="modal" data-target="#modal-confirmarEliminacion"  title="Confirmar eliminación de datos." class="btn btn-danger">Eliminar registro</i></button>
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
        <!-- TABLA de DETALLE -->
        <div id="tab-lista2" class="tablaResultados2">
            <div class="panel panel-info">
                <div class="panel-heading">Listado de Insumos del Articulo</div>
                <div class="panel-body">
                    <br>
                    <table id="tblListaInsumos" class="display table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Insumo</th>
                            <th>Cantidad</th>
                            <th>Unidad de cantidad</th>
                            <th>Precio unitario</th>
                            <th>Importe total</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        @foreach($articulo->insumos_articulos as $insumo)
                         <tr>
                            <td class="text-center">{{ $insumo->insumo->id }}</td>
                            <td class="text-center">{{ $insumo->insumo->nombre }}</td>
                            <td class="text-center">{{ $insumo->cantidad }}</td>
                            <td class="text-center">{{ $insumo->insumo->unidad_medida->unidad }}</td>
                            <td class="text-center">{{ $insumo->insumo->costo }}</td>
                            <td class="text-center">{{ $insumo->insumo->costo * $insumo->cantidad }}</td>
                         </tr>
                        @endforeach
                    </table>
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
