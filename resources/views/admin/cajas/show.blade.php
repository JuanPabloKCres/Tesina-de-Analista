@extends('admin.partes.index')

@section('title')
    Detalle de la caja
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">Caja</div>
        </div>
         <div class="page-header pull-right">
            <div class="page-toolbar">
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.cajas.registrosCajas') }}" title="Volver a los registros de cajas"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
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
                                        <h3>Detalle de caja</h3>
                                        <br>
                                        <div class="row mtl">
                                            <div class="col-md-4">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td><h4 class="box-heading">Usuario apertura:</h4></td>
                                                            <td><h4>{{ $caja->usuarioApertura->name }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td><h4 class="box-heading">Fecha y hora de apertura:</h4></td>
                                                            <td><h4>{{ $caja->fecha_apertura }} - {{ $caja->hora_apertura }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-2">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr class="info">
                                                            <td><h4 class="box-heading">Saldo inicial:</h4></td>
                                                            <td><h4>${{ $caja->saldo_inicial }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-2">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr class="warning">
                                                            <td><h4 class="box-heading">Total ingresado:</h4></td>
                                                            <td><h4>${{ $caja->totalEntrada() }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row mtl">
                                            <div class="col-md-4">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td><h4 class="box-heading">Usuario cierre:</h4></td>
                                                            <td><h4>{{ $caja->usuarioApertura->name }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                          <tr>
                                                            <td><h4 class="box-heading">Fecha y hora de cierre:</h4></td>
                                                            <td><h4>{{ $caja->fecha_apertura }} - {{ $caja->hora_apertura }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-2">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr class="danger">
                                                            <td><h4 class="box-heading">Total retirado:</h4></td>
                                                            <td><h4>${{ $caja->totalSalida() }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-2">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr class="success">
                                                            <td><h4 class="box-heading">Saldo final:</h4></td>
                                                            <td><h4>${{ $caja->totalMovimientos() }}</h4></td>
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
                @include('admin.movimientos.tablaRegistros')
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script>
        var listSidebar = "li10";
        var elemFaltante = "nada";
    </script>
@endsection
