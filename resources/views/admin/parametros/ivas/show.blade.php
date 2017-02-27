@extends('admin.partes.index')

@section('title')
    Detalles de IVA
@endsection

@section('sidebar')
    @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.parametros.ivas.editar')
    @include('admin.parametros.ivas.confirmar')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                IVA
            </div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                @include('admin.parametros.botonera')
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.ivas.index') }}" title="Volver a los registros de ivas"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
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
                                                                <td><h4 class="box-heading">Porcentaje:</h4></td>
                                                                <td class="text-center"><h4>{{ $iva->iva}}%</h4></td>
                                                            </tr>

                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha de registro:</h4></td>
                                                                <td class="text-center"><h4>{{ $iva->created_at->diffForHumans() }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Cantidad de articulos para la venta que asociados a este impuesto:</h4></td>
                                                                <td class="text-center"><h4>{{ $iva->articulos->count() }}</h4></td>
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
    <script>
        var listSidebar = "li7";
        var elemFaltante = "nada";
    </script>
@endsection
