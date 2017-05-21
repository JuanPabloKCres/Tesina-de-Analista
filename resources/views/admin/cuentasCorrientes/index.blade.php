@extends('admin.partes.index')

@section('title')
    Detalle de la caja
@endsection

@section('sidebar')
    @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.cuentascorrientes.create')
    {{--@include('admin.cuentascorrientes.editar')--}}
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                Cuentas Corrientes</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <button data-placement="bottom" title="Registrar un nuevo movimiento de en la caja actual" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-crearCC"  class="btn btn-blue">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva Cuenta Corriente

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
                <div class=" col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel ">
                                <div class="panel-body">
                                    <h3>Detalle de Cuentas Corrientes</h3>
                                    <br>
                                    <div class="row mtl">
                                        <div class="col-md-6">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    <td><h4 class="box-heading">Debe:</h4></td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    <td><h4 class="box-heading">Haber:</h4></td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mtl">
                                        <div class="col-md-3">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr class="info">
                                                    <td><h4 class="box-heading">Debe:</h4></td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr class="warning">
                                                    <td><h4 class="box-heading">Haber:</h4></td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr class="danger">
                                                    <td><h4 class="box-heading">Saldo:</h4></td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr class="success">
                                                    <td><h4 class="box-heading">Cuentas Activas:</h4></td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.cuentasCorrientes.tablaRegistros')
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/pluginsCajas.js') }}"></script>
    {{--
    <script>
        var listSidebar = "li11";
        var elemFaltante = "nada";
    </script
    --}}
@endsection