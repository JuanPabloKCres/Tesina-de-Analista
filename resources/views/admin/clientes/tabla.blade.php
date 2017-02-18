@extends('admin.partes.index')

@section('title')
    Clientes registrados
@endsection

@section('sidebar')
    @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.clientes.create')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                Clientes</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <button data-placement="left" title="Registrar un nuevo Cliente" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-config"  class="btn btn-blue">
                    <span class="fa fa-user-plus" aria-hidden="true"></span> Registrar cliente
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
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-red">
                                <div class="panel-heading">Clientes registrados</div>
                                <div class="panel-body">
                                    @include('admin.partes.msjError')
                                    @include('flash::message')
                                    <table class="display dataTable table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Responsabilidad ante IVA</th>
                                                <th class="text-center">Representante</th>
                                                <th class="text-center">CUIT</th>
                                                <th class="text-center">DNI</th>
                                                <th class="text-center">Localidad y dirección</th>
                                                <th class="text-center">Teléfono</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($clientes as $cliente)
                                            <tr>
                                                @if ( $cliente->empresa)
                                                    <td class="text-center text-dark">{{ $cliente->empresa }}</td>
                                                @else
                                                    <td class="text-center">{{ $cliente->apellido }}, {{ $cliente->nombre }}</td>
                                                @endif

                                                <td class="text-center">{{ $cliente->responiva->nombre }}</td>
                                                @if ( $cliente->empresa)
                                                    <td class="text-center">{{ $cliente->apellido }}, {{ $cliente->nombre }}</td>
                                                @else
                                                    <td class="text-center">{{ "-" }}</td>
                                                @endif

                                                  @if ( $cliente->cuit)
                                                     <td class="text-center">{{ $cliente->cuit }}</td>
                                                  @else
                                                     <td class="text-center">{{ "No se registró" }}</td>
                                                  @endif
                                                  @if ( $cliente->dni)
                                                     <td class="text-center">{{ $cliente->dni }}</td>
                                                  @else
                                                     <td class="text-center">{{ "No se registró" }}</td>
                                                  @endif
                                                <td class="text-center">{{ $cliente->localidad->nombre}} -
                                                  @if ( $cliente->direccion)
                                                     {{ $cliente->direccion }}
                                                  @else
                                                        {{ "No se registró" }}
                                                  @endif
                                                </td>
                                                  @if ( $cliente->telefono)
                                                     <td class="text-center">{{ $cliente->telefono }}</td>
                                                  @else
                                                     <td class="text-center">{{ "No se registró" }}</td>
                                                  @endif
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.clientes.show', $cliente->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
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
    <script src="{{ asset('js/pluginsClientes.js') }}"></script>
    <script>
        var listSidebar = "li7";
        var elemFaltante = "nada";
    </script>
@endsection
