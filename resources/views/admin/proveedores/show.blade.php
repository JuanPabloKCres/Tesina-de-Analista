@extends('admin.partes.index')

@section('title')
    Detalle de la Empresa
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.proveedores.editar')
    @include('admin.proveedores.confirmar')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Proveedor: {{ $proveedor->nombre }}</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.proveedores.index') }}" title="Volver a los Registros de Proveedores"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
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
                                                <div class="col-md-4">
                                                    @if ($proveedor->imagen=== "sin imagen")
                                                        <div class="form-group">
                                                            <div class="text-center mbl"><img src="{{ asset('imagenes/proveedores/sin-logo.jpg') }}" alt="" style="width:350px;height:250px" class="img-thumbnail"/></div>
                                                        </div>
                                                    @else
                                                        <div class="form-group">
                                                            <div class="text-center mbl"><img src="{{ asset('imagenes/proveedores/' . $proveedor->imagen) }}" alt="" style="width:350px;height:250px" class="img-thumbnail"/></div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-8">
                                                    <table class="table table-striped table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <td><h4 class="box-heading">Razón social:</h4></td>
                                                                <td><h4>{{ $proveedor->nombre }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">CUIT:</h4></td>
                                                                <td><h4>{{ $proveedor->cuit}}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Rubro:</h4></td>
                                                                <td><h4>{{ $proveedor->rubro->nombre }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Localidad:</h4></td>
                                                                <td><h4>{{ $proveedor->localidad->nombre }} </h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Horario de atención:</h4></td>
                                                                @if ($proveedor->horario_atencion)
                                                                    <td><h4>{{ $proveedor->horario_atencion }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td ><h4 class="box-heading">Web:</h4></td>
                                                                 @if ($proveedor->web)
                                                                    <td><h4>{{ $proveedor->web }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Dirección:</h4></td>
                                                                <td><h4>{{ $proveedor->calle}} {{ $proveedor->altura}}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Teléfono:</h4></td>
                                                                 @if ($proveedor->telefono)
                                                                    <td><h4>{{ $proveedor->telefono }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td ><h4 class="box-heading">Celular:</h4></td>
                                                                @if ($proveedor->celular)
                                                                    <td><h4>{{ $proveedor->celular }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td ><h4 class="box-heading">Email:</h4></td>
                                                                 @if ($proveedor->email)
                                                                   <td><h4>{{ $proveedor->email }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha de alta:</h4></td>
                                                                <td><h4>{{ $proveedor->created_at->diffForHumans() }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Estado:</h4></td>
                                                                <td><h4>{{ $proveedor->estado }}</h4></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr/>
                                            <br>
                                            <div class="pull-right">
                                                <button type="button"  data-hover="tooltip"  data-toggle="modal" data-target="#modal-actualizar"  title="Visualizar la pantalla de actualización de datos. En ella podrá actualizar los datos pertinentes al registro."  class="btn btn-warning">  Actualizar datos</i></button>
                                                <button type="button"  data-hover="tooltip" title="Confirmar eliminación de datos. " data-toggle="modal" data-target="#modal-confirmar"  class="btn btn-danger">Eliminar registro</i></button>
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
        var listSidebar = "li5";
        var elemFaltante = "nada";
    </script>
@endsection
