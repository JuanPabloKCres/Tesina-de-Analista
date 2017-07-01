@extends('admin.partes.index')

@section('title')
    Detalle de la caja
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.movimientos.create')
    @include('admin.cajas.editar')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
               Caja</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <button data-placement="bottom" title="Registrar un nuevo movimiento de en la caja actual" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-config"  class="btn btn-blue">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Registrar movimiento
                </button>
                <button data-placement="bottom" title="Imprimir un reporte de la caja y sus movimientos" type="button" data-hover="tooltip" onclick="reporte_caja()" class="btn btn-grey">
                    <i class="fa fa-print" aria-hidden="true"></i> Imprimir reporte Caja
                </button>
                <button data-placement="bottom" title="Realizar el cierre de la caja actual" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-actualizar"  class="btn btn-warning">
                    <i class="fa fa-times" aria-hidden="true"></i> Cerrar caja
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
                                        {{-- <h3>Detalle de caja</h3> --}}
                                        <br>
                                            <div class="row mtl">
                                                <div class="col-md-6">
                                                    <table class="table table-striped table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <td><h4 class="box-heading">Usuario:</h4></td>
                                                                <td><h4>{{ $caja->usuarioApertura->name }}</h4></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table table-striped table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha y hora de apertura:</h4></td>
                                                                <td><h4>{{ $caja->fecha_apertura }} - {{ $caja->hora_apertura }}</h4></td>
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
                                                                <td><h4 class="box-heading">Saldo inicial:</h4></td>
                                                                <td><h4>${{ $caja->saldo_inicial }}</h4></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <div class="col-md-3">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                          <tr class="warning">
                                                            <td><h4 class="box-heading">Total ingresado:</h4></td>
                                                            <td><h4>${{ $caja->totalEntrada()}}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-3">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr class="danger">
                                                            <td><h4 class="box-heading">Total retirado:</h4></td>
                                                            <td><h4>${{ $caja->totalSalida() }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-3">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr class="success">
                                                            <td><h4 class="box-heading">Saldo actual:</h4></td>
                                                            <td><h4>${{ $caja->totalMovimientos() }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{-- Este input es invisible porque solo lo necesito para mandar el id de caja a pluginsCajas.js --}}
                                                   <div>
                                                       <input class="form-control hide" type="text" id="caja_id" value="{{ $caja->id }}"/>
                                                   </div>
                                            {{-- Fin --}}
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
    <script src="{{ asset('js/pluginsCajas.js') }}"></script>
    {{--
    <script>
        var listSidebar = "li11";
        var elemFaltante = "nada";
    </script
    --}}
@endsection
