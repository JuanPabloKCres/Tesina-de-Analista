@extends('admin.partes.index')

@section('title')
    Países registrados
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
@include('admin.paises.create')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Países</div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <div class="btn-group" role="group" aria-label="...">
                    <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.provincias.index') }}" title="Visualizar los registros de provincias"  class="btn btn-info"> <span class="fa fa-flag" aria-hidden="true"></span> Provincias</a> 
                    <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.localidades.index') }}" title="Visualizar a los registros de localidades"  class="btn btn-info"> <span class="fa fa-map-marker" aria-hidden="true"></span> Localidades</a>                                   
                </div>                                  
                <button data-placement="bottom" title="Registrar un nuevo país" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-config"  class="btn btn-blue">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Registrar país
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
                        <div class="col-lg-6" >
                            <div class="panel panel-grey">
                                <div class="panel-heading">Países registrados</div>
                                <div class="panel-body">  
                                    @include('admin.partes.msjError')
                                    @include('flash::message')
                                    <table class="dataTable display table table-hover table-striped" >
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($paises as $pais)
                                            <tr>
                                                <td>  {{ $pais->nombre }}</td>
                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.paises.show', $pais->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
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
