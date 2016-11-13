@extends('admin.partes.index')

@section('title')
    Localidades Registradas
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
@include('admin.localidades.create')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Localidades</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar"> 
                <div class="btn-group" role="group" aria-label="...">
                    <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.paises.index') }}" title="Visualizar los registros de países"  class="btn btn-info"> <span class="fa fa-flag" aria-hidden="true"></span> Países</a>             
                    <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.provincias.index') }}" title="Visualizar a los registros de provincias"  class="btn btn-info"> <span class="fa fa-flag" aria-hidden="true"></span> Provincias</a> 
                </div> 
                <button data-placement="bottom" title="Registrar una nueva localidad" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-config"  class="btn btn-blue">            
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Registrar Localidad
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
                            <div class="panel panel-yellow">
                                <div class="panel-heading">Localidades registradas</div>
                                <div class="panel-body">
                                    @include('admin.partes.msjError')
                                    @include('flash::message')                           
                                    <table class="dataTable table table-hover table-striped">
                                        <thead>
                                            <tr>                                                
                                                <th>Nombre</th>                
                                                <th>País perteneciente</th>
                                                <th>Provincia perteneciente</th>                                      
                                                <th class="text-center">Acciones</th>
                                            </tr>                                           
                                        </thead>
                                        <tbody>
                                        @foreach($localidades as $localidad)
                                            <tr>                                                
                                                <td>{{ $localidad->nombre }}</td> 
                                                <td>{{ $localidad->provincia->pais->nombre }}</td>                                                   
                                                <td>{{ $localidad->provincia->nombre }}</td>                                                   
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.localidades.show', $localidad->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
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