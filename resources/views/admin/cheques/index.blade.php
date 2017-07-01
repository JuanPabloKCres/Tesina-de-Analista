@extends('admin.partes.index')

@section('title')
    Cheques |
@endsection

@section('sidebar')
    @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.cuentascorrientes.create')
    @include('admin.cheques.editar-cheque')
    {{--@include('admin.cuentascorrientes.editar')--}}
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                Cartera de Cheques</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">

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
                                    <br>
                                    {{--
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
                                    --}}
                                    <div class="row mtl">
                                        <div class="col-md-3">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr class="success">
                                                    <td class="text-center"><h4 class="box-heading">Cantidad de Cheques:  &nbsp;&nbsp;  {{ $cheques->count() }}</h4></td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr class="info">
                                                    <td class="text-center"><h4 class="box-heading">Cobrados:  &nbsp;&nbsp;  {{ \App\Cheque::where('cobrado',1)->count() }}</h4></td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-4">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr class="danger">
                                                    <td class="text-center"><h4 class="box-heading">No Cobrados:  &nbsp;&nbsp;  {{ \App\Cheque::where('cobrado',0)->count() }} (${{ \App\Cheque::totalDineroChequesSinCobrar() }} en total)</h4></td>

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
                @include('admin.cheques.tablaRegistros')
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