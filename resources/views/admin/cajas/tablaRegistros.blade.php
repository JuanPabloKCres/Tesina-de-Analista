@extends('admin.partes.index')

@section('title')
     Registros de caja
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Registros de cajas</div>
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
                                <div class="panel-heading">Historial de registros</div>
                                <div class="panel-body">
                                    @include('admin.partes.msjError')
                                    @include('flash::message')
                                    <table class="dataTable display table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha y hora apertura</th>
                                                <th>Saldo inicial</th>
                                                <th>Usuario apertura</th>
                                                <th>Fecha y hora cierre</th>
                                                <th>Total ingresado</th>
                                                <th>Total retirado</th>
                                                <th>Saldo final</th>
                                                <th>Usuario cierre</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cajas as $caja)
                                            <tr>
                                                <td>{{ $caja->fecha_apertura }} - {{ $caja->hora_apertura }}</td>
                                                <td>${{ $caja->saldo_inicial }}</td>
                                                <td>{{ $caja->usuarioApertura->name }}</td>
                                                <td>{{ $caja->fecha_cierre }} - {{ $caja->hora_cierre }}</td>
                                                <td>${{ $caja->totalEntrada() }}</td>
                                                <td>${{ $caja->totalSalida() }}</td>
                                                <td>${{ $caja->totalMovimientos() }}</td>
                                                <td>{{ $caja->usuarioCierre->name }}</td>
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder a todos los movimientos del mismo." href="{{ route('admin.cajas.show', $caja->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
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
        var listSidebar = "li10";
        var elemFaltante = "nada";
    </script>
@endsection
