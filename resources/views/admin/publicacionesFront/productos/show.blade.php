@extends('admin.partes.index')

@section('title')
    Detalle del Producto
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.publicacionesFront.productos.editar')
    @include('admin.publicacionesFront.productos.confirmar')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Producto: {{ $producto->nombre }}</div>
        </div>        
        <div class="page-header pull-right">
            <div class="page-toolbar">         
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.productos.index') }}" title="Volver a los registros de productos"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>                         
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
                                    <h3>Detalles del Registro</h3>
                                    <br>
                                    @include('admin.partes.msjError')
                                    @if (!($producto->estado))                                           
                                        @include('admin.partes.recordatorioEstado')                                             
                                    @endif                                    
                                    @include('flash::message') 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mtl">
                                                <div class="col-md-1">                                                                                                                                                 
                                                </div>
                                                <div class="col-md-4">
                                                    @if ($producto->imagen === "sin imagen")
                                                        <div class="form-group">
                                                            <div class="text-center mbl"><img src="{{ asset('imagenes/productos/sin-logo.jpg') }}" alt="" style="width:400px;height:300px" class="img-thumbnail"/></div>
                                                        </div>  
                                                    @else
                                                        <div class="form-group">
                                                            <div class="text-center mbl"><img src="{{ asset('imagenes/productos/' . $producto->imagen) }}" alt="" style="width:400px;height:300px" class="img-thumbnail"/></div>
                                                        </div>                                   
                                                    @endif                                                                                                      
                                                </div>
                                                <div class="col-md-6">                                    
                                                     <div class="col-lg-12"><h4 class="box-heading">Descripción</h4>
                                                      <p class="text-justify">{{ $producto->descripcion }} </p>                                   
                                                        <br>                       
                                                    </div>
                                                </div>  
                                            </div>                          
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row mtl">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">                                                                                  
                                                        <table class="table table-striped table-hover">
                                                            <tbody>                                                       
                                                                <tr>
                                                                    <td class="text-center"><h4 class="box-heading">Nombre:</h4></td>
                                                                    <td class="text-center"><h4>{{ $producto->nombre }}</h4></td>                                                   
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center"><h4 class="box-heading">Tipo de Producto:</h4></td>         
                                                                    <td class="text-center"><h4>{{ $producto->tipoproducto/*->nombreTipo*/ }}</h4></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center"><h4 class="box-heading">Estado:</h4></td>                                                         
                                                                    @if ($producto->estado)
                                                                       <td class="text-center"><h4>Activo  <span class="label label-success"><i class="fa fa-thumbs-o-up"></i></span></h4></td>
                                                                    @else
                                                                       <td class="text-center"><h4>Inactivo  <span class="label label-warning"><i class="fa fa-exclamation-triangle"></i></span></h4></td>                                               
                                                                    @endif 
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center"><h4 class="box-heading">Costo:</h4></td>
                                                                     @if ($producto->costo)
                                                                        <td class="text-center"><h4>{{ $producto->costo }}</h4></td>
                                                                    @else
                                                                        <td class="text-center"><h4>No se registró</h4></td>
                                                                    @endif                                                                 
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center"><h4 class="box-heading">Precio:</h4></td>             
                                                                    @if ($producto->precio)
                                                                        <td class="text-center"><h4>{{ $producto->precio }}</h4></td>
                                                                    @else
                                                                        <td class="text-center"><h4>No se registró</h4></td>
                                                                    @endif                                                                 
                                                                </tr> 
                                                                <tr>
                                                                    <td class="text-center"><h4 class="box-heading">Fecha de Alta:</h4></td>                             
                                                                    <td class="text-center"><h4>{{ $producto->created_at->diffForHumans() }}</h4></td>
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
                                                    <button type="button"  data-hover="tooltip"  data-toggle="modal" data-target="#modal-actualizar"  title="Visualizar la pantalla de actualización de datos. En ella podrá actualizar los datos pertinentes al registro."  class="btn btn-warning">  Actualizar Datos</i></button>                                                                          
                                                    <button type="button"  data-hover="tooltip" title="Confirmar eliminación de datos. " data-toggle="modal" data-target="#modal-confirmar"  class="btn btn-danger">Eliminar Registro</i></button>
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
        var listSidebar = "li7";
    </script>
@endsection