@extends('admin.partes.index')
@section('script')
    <script src="{{ URL::asset('js/pluginsRoles.js') }}"></script>
    <script>
        var listSidebar = "li8";
        var elemFaltante = "nada";
    </script>
@endsection
@section('title')
    Roles registrados
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
@include('admin.roles.create')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Roles</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <button data-placement="bottom" title="Registrar un nuevo rol de usuario" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-config"  class="btn btn-blue">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Rol
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
                <div class="col-lg-12 center" >
                    <div class="row center">
                        <div class="col-lg-12" >
                            <div class="panel panel-info">
                                <div class="panel-heading">Roles registrados</div>
                                <div class="panel-body">  
                                    @include('admin.partes.msjError')
                                    @include('flash::message')
                                    <table class="dataTable display table table-hover table-striped" >
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nombre</th>
                                                <th>Modulos accesibles</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $rol)
                                            <tr>
                                                <td class="text-dark">  {{ $rol->nombre }}</td>
                                                <td class="text-dark"> {{$rol->modulos}} </td>
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.roles.show', $rol->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
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
        var listSidebar = "li2";
        var elemFaltante = "nada";
    </script>
@endsection
