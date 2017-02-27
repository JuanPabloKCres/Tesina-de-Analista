@extends('admin.partes.index')

@section('title')
Detalle del cliente
@endsection

@section('sidebar')
@include('admin.partes.sidebar')
@endsection

@section('content')
@include('admin.clientes.editar')
@include('admin.clientes.confirmar')
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">
            Cliente:   @if($cliente->empresa)
                         {{ $cliente->empresa }} (representante: {{ $cliente->apellido }}, {{ $cliente->nombre}})
                       @else
                        {{ $cliente->apellido }}, {{ $cliente->nombre }} ({{ $cliente->responiva->nombre }})
                       @endif
        </div>
    </div>
    <div class="page-header pull-right">
        <div class="page-toolbar">
            <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.clientes.index') }}" title="Volver a los Registros de Clientes."  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>
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
                                                        @if($cliente->empresa)
                                                            <tr>
                                                                <td><h4 class="box-heading text-dark">Empresa:</h4></td>
                                                                <td><h4 class="text-dark">{{ $cliente->empresa }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">CUIT:</h4></td>
                                                                @if ( $cliente->cuit)
                                                                    <td><h4>{{ $cliente->cuit }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Responsabilidad Tributaria:</h4></td>
                                                                @if ( $cliente->responiva->nombre)
                                                                    <td><h4>{{ $cliente->responiva->nombre }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Representante:</h4></td>
                                                                <td><h4>{{ $cliente->nombre }} {{ $cliente->apellido }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Localidad y dirección:</h4></td>
                                                                <td><h4>
                                                                        @if ( $cliente->direccion)
                                                                            {{ $cliente->direccion }}  ({{ $cliente->localidad->nombre}} - {{$cliente->localidad->provincia->nombre}})
                                                                        @else
                                                                            No se registró
                                                                        @endif
                                                                    </h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Teléfono:</h4></td>
                                                                @if ($cliente->telefono )
                                                                    <td><h4>{{ $cliente->telefono }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Email:</h4></td>
                                                                @if ( $cliente->email)
                                                                    <td><h4>{{ $cliente->email }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>

                                                                @endif
                                                            </tr>

                                                            <tr>
                                                                <td><h4 class="box-heading">Descripcion:</h4></td>
                                                                @if ( $cliente->descripcion)
                                                                    <td><h4>{{ $cliente->descripcion }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>

                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Cantidad de pedidos o ventas asociadas:</h4></td>
                                                                <td><h4>{{$cliente->ventas->count()}}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Cantidad de dinero invertido por este cliente:</h4></td>
                                                                <td><h4 class="text-google-plus">${{$cliente->importeVentasRealizadas_sinRestarIva()}}</h4>  <h4 class="text-green">(${{$cliente->importeVentasRealizadas()}} pesos limpios)</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha de la última compra:</h4></td>
                                                                <td><h4>{{$cliente->ventas->last()->updated_at->diffForHumans() }}</h4></td>
                                                                <td>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha de alta del cliente:</h4></td>
                                                                <td><h4>{{ $cliente->created_at->diffForHumans() }}</h4></td>
                                                            </tr>


                                                        @else
                                                            <tr>
                                                                <td><h4 class="box-heading">Apellido:</h4></td>
                                                                <td><h4>{{ $cliente->apellido}}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Nombres:</h4></td>
                                                                <td><h4>{{ $cliente->nombre }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">CUIT:</h4></td>
                                                                @if ( $cliente->cuit)
                                                                <td><h4>{{ $cliente->cuit }}</h4></td>
                                                                @else
                                                                <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">DNI:</h4></td>
                                                                @if ( $cliente->dni)
                                                                <td><h4>{{ $cliente->dni }}</h4></td>
                                                                @else
                                                                <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Localidad y dirección:</h4></td>
                                                                <td><h4>{{ $cliente->localidad->nombre}} -

                                                                        @if ( $cliente->direccion)
                                                                        {{ $cliente->direccion }}
                                                                        @else
                                                                        No se registró
                                                                        @endif
                                                                    </h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Teléfono:</h4></td>
                                                                @if ($cliente->telefono )
                                                                <td><h4>{{ $cliente->telefono }}</h4></td>
                                                                @else
                                                                <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Email:</h4></td>
                                                                @if ( $cliente->email)
                                                                <td><h4>{{ $cliente->email }}</h4></td>
                                                                @else
                                                                <td><h4>No se registró</h4></td>

                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Responsabilidad Tributaria:</h4></td>
                                                                @if ( $cliente->responiva->nombre)
                                                                    <td><h4>{{ $cliente->responiva->nombre }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Descripcion:</h4></td>
                                                                @if ( $cliente->descripcion)
                                                                    <td><h4>{{ $cliente->descripcion }}</h4></td>
                                                                @else
                                                                    <td><h4>No se registró</h4></td>

                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Cantidad de pedidos o ventas asociadas:</h4></td>
                                                                <td><h4>{{$cliente->ventas->count()}}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Cantidad de dinero en producciones solicitadas por este cliente:</h4></td>
                                                                <td><h4 class="text-google-plus">${{$cliente->importeVentasRealizadas_sinRestarIva()}}</h4>  <h4 class="text-green">${{$cliente->importeVentasRealizadas()}} pesos netos ingresados</h4></td>
                                                            </tr>
                                                                <td><h4 class="box-heading">Fecha de la última compra:</h4></td>
                                                                <td><h4>{{$cliente->ventas->last()->updated_at->diffForHumans() }}</h4></td>
                                                                <td>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha de alta del cliente:</h4></td>
                                                                <td><h4>{{ $cliente->created_at->diffForHumans() }}</h4></td>
                                                            </tr>
                                                         @endif
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
<script src="{{ asset('js/pluginsClientes.js') }}"></script>
<script>
var listSidebar = "li7";
var elemFaltante = "nada";
</script>
@endsection