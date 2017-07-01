@extends('admin.partes.index')

@section('title')
    Cuentas Corrientes
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.cuentasCorrientes.movimientos.create')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
         <div class="page-header pull-right">
            <div class="page-toolbar">
                <button data-placement="bottom" title="Registrar un nuevo movimiento de en la caja actual" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-movimiento-cc"  class="btn btn-green">
                    <i class="fa fa-arrow-v" aria-hidden="true"></i> Registrar movimiento CC
                </button>
                <button data-placement="bottom" title="Imprimir un reporte de la cuenta corriente y sus movimientos" type="button" data-hover="tooltip" onclick="reporte_cc_cliente()" class="btn btn-grey">
                    <i class="fa fa-print" aria-hidden="true"></i> Imprimir reporte Cuenta
                </button>
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.ccorrientes.index') }}" title="Volver a los registros de Cuentas Corrientes"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
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
                                        Cuenta de<h2> {{ $cuentacorriente->cliente->nombre }} {{ $cuentacorriente->cliente->apellido}}</h2>
                                        <br>
                                        <div class="row mtl">
                                            <div class="col-md-4">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td><h4 class="box-heading">Usuario apertura:</h4></td>
                                                            <td><h4>{{ $cuentacorriente->usuarioApertura->name }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td><h4 class="box-heading">Fecha y hora de apertura:</h4></td>
                                                            <td><h4>{{ $cuentacorriente->fecha_apertura }} - {{ $cuentacorriente->hora_apertura }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                    <tr class="danger">
                                                        <td><h4 class="box-heading">Cheques por cobrar:</h4></td>
                                                        <td><h4>${{ \App\Cheque::sinCobrar($cuentacorriente) }}</h4></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row mtl">
                                            <div class="col-md-2">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td><h4 class="box-heading">Debe:</h4></td>
                                                        <td><h4>$ {{ $cuentacorriente->debe_cc(($cuentacorriente)) }}</h4></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-2">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td><h4 class="box-heading">Haber:</h4></td>
                                                            <td><h4>$ {{ $cuentacorriente->haber_cc($cuentacorriente) }}</h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-2">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                          <tr>
                                                            <td><h4 class="box-heading">Estado:</h4></td>
                                                              @if($cuentacorriente->activa)
                                                                <td class="text-green"><h4>Activa</h4></td>
                                                              @else
                                                                <td><h4>Inactiva</h4></td>
                                                              @endif
                                                          </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-2">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                    <tr class="info">
                                                        <td><h4 class="box-heading">Saldo inicial:</h4></td>
                                                        <td><h4>${{ $cuentacorriente->saldo_inicial }}</h4></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <table class="table table-striped table-hover">
                                                    <tbody>
                                                    <tr class="info">
                                                        <td><h4 class="box-heading">Saldo final:</h4></td>
                                                        <td class="text-dark"><h4>$ {{ $cuentacorriente->totalMovimientos() }}</h4></td>
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
                {{-- Movimientos que impactan en Cuentas Corrientes --}}
                <div id="tab-lista" class="tablaResultados2 col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">Movimientos en Cuenta Corriente</div>
                                <div class="panel-body">
                                    <br>
                                    @include('admin.partes.msjError')
                                    @include('flash::message')
                                    <table id="tab-movimientosCC" class="dataTable display table table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">N°</th>
                                            <th class="text-center">Concepto</th>
                                            <th class="text-center">Fecha y hora</th>
                                            <th class="text-center">Tipo</th>
                                            <th class="text-center">Monto</th>
                                            <th class="text-center">Usuario</th>
                                            <th class="text-center">Detalle de Movimiento</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cuentacorriente->movimientos as $movimiento)
                                            <tr>
                                                <td class="text-center">{{ $movimiento->id }}</td>
                                                <td class="text-center">{{ $movimiento->concepto }}</td>
                                                <td class="text-center">{{ $movimiento->fecha }} - {{ $movimiento->hora }}</td>
                                                <td class="text-center">{{ $movimiento->tipo }}</td>
                                                <td class="text-center">${{ $movimiento->monto }}</td>
                                                <td class="text-center">{{ $movimiento->user->name}}</td>
                                                @if($movimiento->venta)
                                                    <td class="text-center">
                                                        <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá tener acceso al detalle de la venta que fue efectuada" href="{{ route('admin.pedidos.edit', $movimiento->venta) }}" class="btn"> <span class="" aria-hidden="true">📑</span></a>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <a data-toggle="tooltip" data-placement="top" title="El movimiento no esta relacionado directamente a un pedido/venta" href="" class=""> -</a>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @section('script')
                    <script src="{{ asset('js/pluginsCajas.js') }}"></script>
                @endsection
                {{-- --}}
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
