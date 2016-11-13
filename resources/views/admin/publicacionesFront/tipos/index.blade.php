@extends('admin.partes.index')

@section('title')
    Tipos de Producciones Registradas
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.publicacionesFront.tipos.create')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Tipos
            </div>
        </div>
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <div class="btn-group" role="group" aria-label="...">
                    @include('admin.partes.botonesVistas')
                    @include('admin.partes.botonFiltrar')
                </div>
                <button data-placement="bottom" title="Registrar un nuevo tipo" type="button" data-hover="tooltip" data-toggle="modal" data-target="#modal-crear"  class="btn btn-blue">
                    <i class="fa fa-plus-circle"> Registrar Tipo</i>
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
                @include('admin.publicacionesFront.tipos.cabeceraTabla')
                <div class="tablaResultados">
                    @include('admin.publicacionesFront.tipos.tablaLogos')
                </div>                                                                       
                @include('admin.publicacionesFront.tipos.tablaRegistros')
            </div>
         </div>        
    </div>       
@endsection
@section('script') 
    <script src="{{ asset('js/tipos.js') }}"></script>
    <script>
        var route = "/admin/tipos";
        var listSidebar = "li5";
    </script>
@endsection