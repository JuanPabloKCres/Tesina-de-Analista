@extends('admin.partes.index')

@section('title')
    Detalle del auditoria
@endsection

@section('sidebar')
    @include('admin.partes.sidebar')
@endsection

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                Registro de auditoria N°  {{ $auditoria->id }}:
                (Tabla {{ $auditoria->tabla }}, id {{ $auditoria->elemento_id }})</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.auditorias.index') }}" title="Volver a los Registros de Clientes."  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
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
                                                                <td><h4 class="box-heading">Tabla</h4></td>
                                                                <td><h4 class="text-dark">{{ $auditoria->tabla}}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">id elemento:</h4></td>
                                                                <td><h4>{{ $auditoria->elemento_id }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Acción:</h4></td>
                                                                @if ( $auditoria->accion)
                                                                    @if($auditoria->accion == 'alta')
                                                                        <td><h4 class="text-green">{{ $auditoria->accion }}</h4></td>
                                                                    @elseif($auditoria->accion == 'modificacion')
                                                                        <td><h4 class="text-yellow">{{ $auditoria->accion }}</h4></td>
                                                                    @elseif($auditoria->accion == 'eliminacion')
                                                                        <td><h4 class="text-danger">{{ $auditoria->accion }}</h4></td>
                                                                    @endif
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Dato Nuevo:</h4></td>
                                                                @if ( $auditoria->dato_nuevo)
                                                                    <td><h4>{{ $auditoria->dato_nuevo }}</h4></td>
                                                                @else
                                                                    <td><h4>-</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Dato Anterior:</h4></td>
                                                                @if ( $auditoria->dato_anterior)
                                                                    <td><h4>{{ $auditoria->dato_anterior }}</h4></td>
                                                                @else
                                                                    <td><h4>-</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha creación del registro:</h4></td>
                                                                <td><h4>{{ $auditoria->created_at}} ({{ $auditoria->created_at->diffForHumans()}})</td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha en que se modificó el registro:</h4></td>
                                                                @if ($auditoria->updated_at )
                                                                    <td><h4>{{ $auditoria->updated_at }} ({{ $auditoria->updated_at->diffForHumans() }})</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
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
        var listSidebar = "li12";
        var elemFaltante = "nada";
    </script>
@endsection