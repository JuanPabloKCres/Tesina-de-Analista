@extends('admin.partes.index')

@section('title')
    Detalle de la provincia
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.provincias.editar')
    @include('admin.provincias.confirmar')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Provincia: {{ $provincia->nombre }}</div>
        </div>        
        <div class="page-header pull-right">
            <div class="page-toolbar">
                <div class="btn-group" role="group" aria-label="...">
                    <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.paises.index') }}" title="Visualizar los registros de países"  class="btn btn-info"> <span class="fa fa-flag" aria-hidden="true"></span> Países</a>             
                    <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.localidades.index') }}" title="Visualizar a los registros de localidades"  class="btn btn-info"> <span class="fa fa-map-marker" aria-hidden="true"></span> Localidades</a>                                   
                </div>
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.provincias.index') }}" title="Volver a los Registros de Provincias"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>             
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
                                                                <td><h4 class="box-heading">Nombre:</h4></td>
                                                                <td><h4>{{ $provincia->nombre }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">País perteneciente:</h4></td>
                                                                <td><h4>{{ $provincia->pais->nombre }}</h4></td>
                                                            </tr>                                                             
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha de alta:</h4></td>
                                                                <td><h4>{{ $provincia->created_at->diffForHumans() }}</h4></td>
                                                            </tr> 
                                                            <tr>
                                                                <td><h4 class="box-heading">Cantidad de localidades asociadas:</h4></td>
                                                                <td><h4>{{ $provincia->localidades->count() }}</h4></td>
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
    <script>
        var listSidebar = "li2";
        var elemFaltante = "nada";
    </script>
@endsection