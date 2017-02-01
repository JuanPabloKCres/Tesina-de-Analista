@extends('admin.partes.index')

@section('title')
    Impuestos al Valor Agregado Registrados
@endsection

@section('sidebar')
    @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.parametros.ivas.create')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                Talles</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                @include('admin.parametros.botonera')
                <button data-placement="bottom" title="Registrar un nuevo talle" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-config"  class="btn btn-blue">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Registrar IVA
                </button>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="tab-general">
            <div class="row mbl">
                <div class="col-lg-5">
                    <div class="col-md-5">
                        <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="panel panel-white">
                                <div class="panel-heading">Impuestos</div>
                                <div class="panel-body">
                                    @include('admin.partes.msjError')
                                    @include('flash::message')
                                    <table class="dataTable display table table-hover table-striped" >
                                        <thead>
                                        <tr>
                                            <th class="text-center">IVA</th>
                                            <th class="text-center">Editar</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ivas as $iva)
                                            <tr>
                                                <td class="text-center">{{ $iva->iva}} %</td>
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como actualización y eliminación del mismo" href="{{ route('admin.ivas.show', $iva->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
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
   //aca deberia ir el javascript si se necesita
    <script>
        var listSidebar = "li7";
        var elemFaltante = "nada";
    </script>
@endsection


